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

        <a href="#" class="button">Add To Cart</a>
    </div>
</div> <!-- end product-section -->

@include('partials.might-like')


@endsection
