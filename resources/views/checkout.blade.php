@extends('layout')

@section('title', 'Checkout')

@section('extra-css')

@endsection

@section('extra-js-header')

<script src="https://js.stripe.com/v3/"></script>

@endsection

@section('content')

<div class="container">

    <h1 class="checkout-heading stylish-heading">Checkout</h1>

    @include('partials.alert')

    <div class="checkout-section">
        <div>
            <form id="payment-form" action="{{ route('checkout.store')}}" method="POST">

                @csrf

                <h2>Billing Details</h2>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}"
                        readonly>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}"
                        readonly>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address"
                        value="{{ old('address') ?? '' }}" required>
                </div>

                <div class="half-form">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" value="{{ old('city') ?? '' }}"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="province">Province</label>
                        <input type="text" class="form-control" id="province" name="province"
                            value="{{ old('province') ?? '' }}" required>
                    </div>
                </div> <!-- end half-form -->

                <div class="half-form">
                    <div class="form-group">
                        <label for="postalcode">Postal Code</label>
                        <input type="text" class="form-control" id="postalcode" name="postalcode"
                            value="{{ old('postalcode') ?? '' }}" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone"
                            value="{{ old('phone') ?? ''  }}" required>
                    </div>
                </div> <!-- end half-form -->

                <div class="spacer"></div>

                <h2>Payment Details</h2>

                <div class="form-group">
                    <label for="name_on_card">Name on Card</label>
                    <input type="text" class="form-control" id="name_on_card" name="name_on_card"
                        value="{{ old('name_on_card') ?? '' }}" required>
                </div>

                <div class="form-group">
                    <label for="card-element">
                        Credit or debit card
                    </label>
                    <div id="card-element">
                        <!-- A Stripe Element will be inserted here. -->
                    </div>

                    <!-- Used to display form errors. -->
                    <div id="card-errors" role="alert"></div>
                </div>

                <div class="spacer"></div>

                <button type="submit" id="complete-order" class="button-primary full-width">Complete Order</button>

            </form>
        </div>

        <div class="checkout-table-container">
            <h2>Your Order</h2>

            <div class="checkout-table">

                @foreach (Cart::instance('shopping')->content() as $readyItem)

                <div class="checkout-table-row">
                    <div class="checkout-table-row-left">
                        <img src="{{ asset("storage/{$readyItem->model->image}") }}" alt="item" class="checkout-table-img">
                        <div class="checkout-item-details">
                            <div class="checkout-table-item">{{ $readyItem->model->name }}</div>
                            <div class="checkout-table-description">{{ $readyItem->model->details }}</div>
                            <div class="checkout-table-price">{{ $readyItem->model->setPrice() }}</div>
                        </div>
                    </div> <!-- end checkout-table -->

                    <div class="checkout-table-row-right">
                        <div class="checkout-table-quantity">{{ $readyItem->qty }}</div>
                    </div>
                </div> <!-- end checkout-table-row -->

                @endforeach

            </div> <!-- end checkout-table -->

            <div class="checkout-totals">
                <div class="checkout-totals-left">
                    Subtotal <br>
                    Tax ({{ $taxConst * 100 }}%) <br>
                    <span class="checkout-totals-total">Total</span>

                </div>

                <div class="checkout-totals-right">
                    {{ presentPrice($newSubtotal) }} <br>

                    {{ presentPrice($newTax) }} <br>

                    <span class="checkout-totals-total">
                        {{ presentPrice($newTotal) }}
                    </span>

                </div>
            </div> <!-- end checkout-totals -->

            <div class="checkout-back">
                <div class="spacer"></div>
                <a class="font-weight-bold" href="{{ route('cart.index') }}"> >> Back to Cart </a>
                <div class="spacer"></div>
                <a class="font-weight-bold" href="{{ route('shop.index') }}"> >> Back to Shop </a>
            </div>

        </div>

    </div> <!-- end checkout-section -->
</div>

@endsection

@section('extra-js')

<script src="{{ asset('js/stripe.js') }}"></script>

@endsection
