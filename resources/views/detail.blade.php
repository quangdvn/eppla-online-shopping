@extends('layout')

@section('title', $product->name)

@section('extra-css')

@endsection

@section('content')

@component('components.breadcrumbs')

<a href="/">Home</a>
<i class="fa fa-chevron-right breadcrumb-separator"></i>
<span><a href="{{ route('shop.index') }}">Shop</a></span>
<i class="fa fa-chevron-right breadcrumb-separator"></i>
<span>{{ $product->name }}</span>

@endcomponent

<div class="product-section container">
    <div>
        <div class="product-section-image">
            <img src="{{ productImage($product->image) }}" class="active" alt="product" id="curImage">
        </div>
        <div class="product-section-extra-images">

            <div class="product-section-thumbnail selected">
                <img src="{{ productImage($product->image) }}" alt="thumbnail">
            </div>

            @if ($product->extra_images)
            @foreach ( json_decode($product->extra_images) as $image)

            <div class="product-section-thumbnail">
                <img src="{{ productImage($image) }}" alt="thumbnail">
            </div>

            @endforeach
            @endif
        </div>
    </div>
    <div class="product-section-information">
        <h1 class="product-section-title">{{$product->name}}</h1>
        <div class="product-section-subtitle">{{$product->details}}</div>
        <div>{!! $stockStatus !!}</div>
        <div class="product-section-price">{{$product->setPrice()}}</div>
        <p>
            {!! $product->description !!}
        </p>

        <p>&nbsp;</p>



        @if ($duplicateProduct->isNotEmpty())

        <a href="{{ route('cart.index') }}" class="button button-yellow">
            <i class="fa fa-arrow-right fa-fw"></i> See your Cart
        </a>

        @elseif ($product->quantity == 0)

        {{-- <form action="{{ route('cart.moveToWishList', $product->rowId) }}" method="POST">

        @csrf --}}

        <button type="submit" class="button button-yellow">
            <i class="fa fa-heart fa-lg fa-fw"></i>
        </button>

        {{-- </form> --}}


        @else

        <form action="{{ route('cart.store', $product) }}" method="POST">

            @csrf
            
            <button type="submit" class="button button-yellow">
                <i class="fa fa-cart-plus fa-lg fa-fw"></i> Add to Cart
            </button>

        </form>

        @endif

    </div>
</div> <!-- end product-section -->

@include('partials.might-like')

@endsection

@section('extra-js')

<!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
<script src="https://cdn.jsdelivr.net/npm/algoliasearch@3.35.1/dist/algoliasearchLite.min.js"
    integrity="sha256-5rOQwvvJdM9oDYQYCGzaJuuTy6SUALjma3OtzEGyJM0=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>

<script src="{{ asset('js/app.js') }}"></script>

<script src="{{ asset('js/thumbnail.js')}}"></script>

@endsection
