@extends('layout')

@section('title', 'My Orders')

@section('extra-css')
<link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
@endsection

@section('content')

@component('components.breadcrumbs')

<a href="/">Home</a>
<i class="fa fa-chevron-right breadcrumb-separator"></i>
<span>My Orders</span>

@endcomponent

<div class="container mt-2">

    @include('partials.alert')

</div>

<div class="products-section my-orders container">
    <div class="sidebar">

        <ul>
            <li>
                <a href="{{ route('user.edit') }}">My Profile</a>
            </li>
            <li class="active">
                <a href="{{ route('order.index') }}">My Orders</a>
            </li>
        </ul>
    </div> <!-- end sidebar -->
    <div class="my-profile">
        <div class="products-header">
            <h1 class="stylish-heading">My Orders</h1>
        </div>
        <div>
            @foreach ($orders as $order)
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
                            <div>
                                <a href="{{ route('order.show', $order->id) }}">Order Details</a>
                            </div>
                            <div>|</div>
                            <div><a href="#">Invoice</a></div>
                        </div>
                    </div>
                </div>
                <div class="order-products">
                    @foreach ($order->products as $product)
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
                                <strong>Product Price: </strong>{{ presentPrice($product->price) }}
                            </div>
                            <div>
                                <strong>Product quantity: </strong>{{ $product->pivot->quantity }}
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div> <!-- end order-container -->
            @endforeach
        </div>
        <div class="spacer"></div>
    </div>
</div>

@endsection

@section('extra-js')
<!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
<script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
<script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
<script src="{{ asset('js/algolia.js') }}"></script>
@endsection
