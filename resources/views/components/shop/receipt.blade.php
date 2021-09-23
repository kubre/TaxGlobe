@extends('layouts.app')

@push('styles')
    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            #printArea,
            #printArea * {
                visibility: visible;
            }

            #printArea {
                position: absolute;
                left: 0;
                top: 0;
                right: 0;
            }
        }

    </style>
@endpush

@section('content')
    <div>
        <x-common.news />

        <x-partials.grid :responsiveLeft="true">
            <div class="pb-4 w-full">
                <div id="printArea" class="p-4">
                    <div class="flex items-center justify-center gap-x-2">
                        <x-jet-application-logo class='h-12'></x-jet-application-logo>
                        <strong>{{ config('app.name') }}</strong>
                    </div>
                    <div>
                        <h3 class="text-indigo-700 text-center font-bold mt-2">Final Details of order
                            {{ $order->order_id }}
                        </h3>
                        <div class="my-2">
                            <p><strong>Order Placed: </strong>
                                {{ $order->created_at->setTimezone('Asia/Kolkata')->format('d-M-Y h:i a') }}
                            </p>
                            <p>
                                <strong>TaxGlobe Order ID: </strong> {{ $order->order_id }}
                            </p>
                            <p>
                                <strong>Order Total: </strong> ₹ <span class="font-mono">
                                    {{ \number_format($order->amount) }}</span> /- (Indian Ruppees) <br />
                                <strong>Order Status: </strong> {{ $order->readable_status }}
                            </p>
                        </div>
                        <div class="border-2 border-black">
                            <h3 class="p-2 text-lg text-center font-bold border-b-2 border-black">Details</h3>
                            <div>
                                <div class="flex justify-between">
                                    <div class="px-2">
                                        <div class="font-bold">
                                            Item Ordered
                                        </div>
                                        <div class="max-w-md">
                                            <em class="text-gray-700">{{ $order->product->title }} Lorem ipsum
                                                dolor</em>
                                            of quantity {{ $order->quantity }}.
                                        </div>
                                    </div>
                                    <p class="px-2">
                                        <strong class="block">
                                            Item Price (in ₹)
                                        </strong>
                                        <span class="text-gray-700 font-mono text-right block">
                                            {{ \number_format($order->amount - (int) ($order->details['shipping_cost'] ?? 0), 2) }}
                                            /-
                                        </span>
                                    </p>
                                </div>
                                <div class="flex justify-between">
                                    <p class="px-2 py-1">
                                        <em class=" text-gray-700">Shipping
                                            Cost</em>
                                    </p>
                                    <p class="px-2 py-1">
                                        <span
                                            class=" text-gray-700
                                        font-mono text-right block">
                                            {{ \number_format((int) ($order->details['shipping_cost'] ?? 0), 2) }}
                                            /-
                                        </span>
                                    </p>
                                </div>
                                <div class="flex justify-between">
                                    <p class="p-2">
                                        <strong class=" text-gray-700">Order Total</stro>
                                    </p>
                                    <p class="p-2">
                                        <span
                                            class=" text-gray-700
                                        font-mono text-right block">
                                            {{ \number_format($order->amount, 2) }}
                                            /-
                                        </span>
                                    </p>
                                </div>
                                <div class="
                                    border-t-2 border-black mt-2 p-2">
                                    <strong class="block">Billing Address</strong>
                                    <p>
                                        <strong>Name: </strong> {{ $order->details['name'] ?? '' }}<br>
                                        <strong>Mobile: </strong> {{ $order->details['contact'] ?? '' }}<br>
                                        <strong>Email: </strong> {{ $order->details['email'] ?? '' }}<br>
                                        <strong>Address: </strong> {{ $order->details['address'] ?? '' }}<br>
                                        <strong>City: </strong> {{ $order->details['city'] ?? '' }}<br>
                                        <strong>State: </strong> {{ $order->details['state'] ?? '' }}<br>
                                        <strong>PIN Code: </strong> {{ $order->details['pin_code'] ?? '' }}<br>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center items-center gap-x-2">
                    <x-jet-secondary-button onclick="history.back()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Go Back
                    </x-jet-secondary-button>
                    <x-jet-button onclick="print()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        {{ __('Print') }}
                    </x-jet-button>
                </div>
            </div>
        </x-partials.grid>
    </div>
@endsection
