<?php

namespace App\Http\Livewire\Shop;

use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class Checkout extends Component
{
    public ?Product $product;
    public $quantity;
    public $amount;
    public $shippingDetails = [];
    public $canBuy = false;
    public ?Order $order;
    public $addresses;
    public $addressId;

    public function mount(Request $request)
    {
        \abort_unless($request->has('product') && $request->has('quantity'), 404, 'Product not available!');
        $this->product = Product::findOrFail($request->product);
        $this->quantity = $this->product->type === 'download' ? 1 : $request->quantity;

        $this->addresses = auth()->user()
            ->addresses()
            ->limit(10)
            ->orderBy('id', 'DESC')
            ->get();

        $this->shippingDetails['name'] = \auth()->user()->name;
        $this->shippingDetails['email'] = \auth()->user()->email;
        if ($this->addresses->isNotEmpty()) {
            $this->addressId = $this->addresses->first()->id;
            $this->setAddress($this->addresses->first());
        }

        \abort_if(($this->product->type === 'deliver' && $request->quantity > $this->product->stock)
            || !$this->product->in_stock, 404);

        $this->canBuy = !(empty($this->shippingDetails['name'])
            || empty($this->shippingDetails['contact'])
            || empty($this->shippingDetails['city'])
            || empty($this->shippingDetails['state'])
            || empty($this->shippingDetails['address']));

        $this->amount = ($this->product->final_price * $this->quantity);
        if ($this->product->type === 'deliver') {
            $this->shippingDetails['shipping_cost'] =
                optional(Setting::where('key', 'shipping_cost')->first())->value ?? 0;
            $this->amount += (int) $this->shippingDetails['shipping_cost'];
        }
    }

    public function render()
    {
        return view('components.shop.checkout');
    }

    public function setAddress($address)
    {
        $this->shippingDetails['contact'] = $address->contact;
        $this->shippingDetails['address'] = $address->address;
        $this->shippingDetails['city'] = $address->city;
        $this->shippingDetails['state'] = $address->state;
        $this->shippingDetails['pin_code'] = $address->pin_code;
        $this->shippingDetails['shipping_notes'] = $address->shipping_notes;
    }

    public function updatingAddressId($value)
    {
        $this->setAddress($this->addresses->firstWhere('id', (int)$value));
    }

    public function startCheckout()
    {
        $key = \env('RAZOR_KEY');
        $secret = \env('RAZOR_SECRET');
        $api = new Api($key, $secret);
        $orderData = [
            'amount' => $this->amount * 100,
            'currency' => 'INR',
            'notes' => $this->shippingDetails,
        ];

        $razorpayOrder = $api->order->create($orderData);

        $this->order = new Order();
        $this->order->fill([
            'order_id' => $razorpayOrder->id,
            'status' => $razorpayOrder->status,
            'amount' => $razorpayOrder->amount / 100,
            'details' => $razorpayOrder->notes->toArray(),
            'user_id' => auth()->id(),
            'product_id' => $this->product->id,
            'quantity' => $this->quantity,
        ])->save();

        $this->dispatchBrowserEvent('order-placed', [
            'options' => [
                "key" => $key,
                "amount" => $razorpayOrder->amount,
                "name" => "TaxGlobe.in",
                "description" => "Buying " . $this->product->name,
                "prefill" => [
                    "name" => $this->shippingDetails['name'],
                    "email" => $this->shippingDetails['email'],
                    "contact" => $this->shippingDetails['contact'],
                ],
                "order_id" => $razorpayOrder->id,
            ],
        ]);
    }

    public function finalizeOrder($paymentId, $signatureId)
    {
        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));
        $this->order->pay_id = $paymentId;
        try {
            $attributes = array(
                'razorpay_order_id' => $this->order->order_id,
                'razorpay_payment_id' => $paymentId,
                'razorpay_signature' => $signatureId,
            );
            $api->utility->verifyPaymentSignature($attributes);
            $this->order->status = 'success';
        } catch (SignatureVerificationError $e) {
            $this->order->status = 'failure';
            $this->order->details = \array_merge($this->order->details, [
                'error' => $e->getMessage(),
            ]);
        }
        $this->order->save();
        return \redirect()->route('shop.order.status', [
            'order' => $this->order->id,
        ]);
    }

    public function downloadFreeProduct()
    {
        \abort_unless($this->product->type === 'download' && $this->product->final_price === 0, 403);
        $item = $this->product->getMedia('download')->first();
        $this->product->increment('download_count');
        return \response()->download($item->getPath(), $item->name);
    }
}
