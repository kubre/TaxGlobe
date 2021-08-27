<?php

namespace App\Http\Livewire\Shop;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Livewire\Component;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class Checkout extends Component
{
    public ?Product $product;
    public $quantity;
    public $shippingDetails = [];
    public $canBuy = false;
    public ?Order $order;

    public function mount(Request $request)
    {
        \abort_unless($request->has('product') && $request->has('quantity'), 404, 'Product not available!');
        $this->product = Product::findOrFail($request->product);
        $this->quantity = $this->product->type === 'download' ? 1 : $request->quantity;

        $this->shippingDetails['name'] = \auth()->user()->name;
        $this->shippingDetails['email'] = \auth()->user()->email;
        $this->shippingDetails['contact'] = \auth()->user()->contact;
        $this->shippingDetails['address'] = \auth()->user()->address;
        $this->shippingDetails['city'] = \auth()->user()->city;
        $this->shippingDetails['state'] = \auth()->user()->state;
        $this->shippingDetails['pin_code'] = \auth()->user()->pin_code;
        $this->shippingDetails['shipping_notes'] = \auth()->user()->shipping_notes;

        \abort_if(($this->product->type === 'deliver' && $request->quantity > $this->product->stock)
            || !$this->product->in_stock, 404);

        $this->canBuy = !(empty($this->shippingDetails['name'])
            || empty($this->shippingDetails['contact'])
            || empty($this->shippingDetails['city'])
            || empty($this->shippingDetails['state'])
            || empty($this->shippingDetails['address']));
    }

    public function render()
    {
        return view('components.shop.checkout');
    }

    public function startCheckout()
    {
        $key = \env('RAZOR_KEY');
        $secret = \env('RAZOR_SECRET');
        $api = new Api($key, $secret);
        $orderData = [
            'amount' => $this->product->final_price * $this->quantity * 100,
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
}
