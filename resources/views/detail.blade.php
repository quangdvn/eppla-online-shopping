@extends('layout')

@section('title', $product->name)

@section('extra-css')

@endsection

@section('content')

<div class="breadcrumbs">
    <div class="container">
        <a href="#">Home</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>Shop</span>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>{{$product->name}}</span>
    </div>
</div> <!-- end breadcrumbs -->

<div class="product-section container">
    <div class="product-section-image">
        <img src="{{ asset("img/products/{$product->slug}.jpg") }}" alt="product">
    </div>
    <div class="product-section-information">
        <h1 class="product-section-title">{{$product->name}}</h1>
        <div class="product-section-subtitle">{{$product->details}}</div>
        <div class="product-section-price">{{$product->setPrice()}}</div>
        <p>
            {{$product->description}}
        </p>

        <p>&nbsp;</p>



        @if ($duplicateProduct->isNotEmpty())

        <a href="{{ route('cart.index') }}" class="button button-yellow">
            <i class="fa fa-arrow-right fa-fw"></i> See your Cart
        </a>

        @else

        <form action="{{ route('cart.store') }}" method="POST">

            @csrf

            <input type="hidden" name="id" value="{{ $product->id }}">
            <input type="hidden" name="name" value="{{ $product->name }}">
            <input type="hidden" name="price" value="{{ $product->price }}">

            <button type="submit" class="button button-yellow">
                <i class="fa fa-cart-plus fa-lg fa-fw"></i> Add to Cart
            </button>

        </form>

        @endif

    </div>
</div> <!-- end product-section -->

@include('partials.might-like')


@endsection
