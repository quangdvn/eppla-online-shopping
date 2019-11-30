@extends('layout')

@section('title', 'My Order')

@section('extra-css')

@endsection

@section('content')

@component('components.breadcrumbs')

<a href="/">Home</a>
<i class="fa fa-chevron-right breadcrumb-separator"></i>
<span><a href="{{ route('order.index') }}">My Orders</a></span>
<i class="fa fa-chevron-right breadcrumb-separator"></i>
<span>Order {{ $order->id }}</span>

@endcomponent

<div class="container mt-2">

    @include('partials.alert')

</div>

<div class="products-section my-orders container">
    <div class="sidebar">

        <ul>
            <li><a href="{{ route('user.edit') }}">My Profile</a></li>
            <li class="active"><a href="{{ route('order.index') }}">My Orders</a></li>
        </ul>
    </div> <!-- end sidebar -->
    <div class="my-profile">
        <div class="products-header">
            <h1 class="stylish-heading">Order ID: {{ $order->id }}</h1>
        </div>

        <div>
            <div class="order-container">
                <div class="order-header">
                    <div class="order-header-items">
                        <div>
                            <div class="uppercase font-bold">Order Placed</div>
                            <div>{{ presentDate($order->created_at) }}</div>
                        </div>
                        <div>
                            <div class="uppercase font-bold">Order ID</div>
                            <div>{{ $order->id }}</div>
                        </div>
                        <div>
                            <div class="uppercase font-bold">Total</div>
                            <div>{{ presentPrice($order->billing_total) }}</div>
                        </div>
                    </div>
                    <div>
                        <div class="order-header-items">
                            <div><a href="#">Invoice</a></div>
                        </div>
                    </div>
                </div>
                <div class="order-products">
                    <table class="table" style="width:50%">
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td>{{ $order->customer->user->name }}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>{{ $order->billing_address }}</td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>{{ $order->billing_city }}</td>
                            </tr>
                            <tr>
                                <td>Subtotal</td>
                                <td>{{ presentPrice($order->billing_subtotal) }}</td>
                            </tr>
                            <tr>
                                <td>Tax</td>
                                <td>{{ presentPrice($order->billing_tax) }}</td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td>{{ presentPrice($order->billing_total) }}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div> <!-- end order-container -->

            <div class="order-container">
                <div class="order-header">
                    <div class="order-header-items">
                        <div>
                            Order Items
                        </div>

                    </div>
                </div>
                <div class="order-products">
                    @foreach ($products as $product)
                    <div class="order-product-item">
                        <div>
                            <a href="{{ route('shop.show', $product->slug) }}">
                                <img src="{{ asset("storage/$product->image") }}" alt="Product Image">
                            </a>
                        </div>
                        <div>
                            <div>
                                <strong>Product name: </strong>{{ $product->name }}
                            </div>
                            <div>
                                <strong>Product price: </strong>{{ presentPrice($product->price) }}
                            </div>
                            <div>
                                <strong>Product quantity: </strong>{{ $product->pivot->quantity }}
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div> <!-- end order-container -->
        </div>

        <div class="spacer"></div>
    </div>
</div>

@endsection

@section('extra-js')

@endsection
