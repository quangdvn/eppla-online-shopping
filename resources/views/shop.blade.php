@extends('layout')

@section('title', 'Products')

@section('extra-css')
@endsection

@section('content')

@component('components.breadcrumbs')

<a href="/">Home</a>
<i class="fa fa-chevron-right breadcrumb-separator"></i>
<span>Shop</span>

@endcomponent

<div class="products-section container">
    <div class="sidebar">
        <h3>By Category</h3>
        <ul>
            @foreach ($categories as $category)

            <li class="{{ setActive(request()->cat, $category->slug) }}">
                <a href=" {{ route('shop.index', ['cat' => $category->slug]) }}">
                    {{ $category->name }}
                </a>
            </li>

            @endforeach

        </ul>

        <h3>By Price</h3>
        <ul>
            <li><a href="#">$0 - $700</a></li>
            <li><a href="#">$700 - $2500</a></li>
            <li><a href="#">$2500+</a></li>
        </ul>
    </div> <!-- end sidebar -->

    <div>
        <div class="products-header">
            <h1 class="stylish-heading">{{ $categoryName  }}</h1>
            <div>
                <strong class="font-weight-bold">Price:</strong>
                <a class="{{ setActive(request()->sort, 'asc')  }}"
                    href="{{ route('shop.index', ['cat' => request()->cat, 'sort' => 'asc']) }}">
                    Low to High
                </a> |
                <a class="{{ setActive(request()->sort, 'desc')  }}"
                    href="{{ route('shop.index', ['cat' => request()->cat, 'sort' => 'desc']) }}">
                    High to Low
                </a>
            </div>
        </div>
        <div class="products text-center">

            @forelse ($products as $product)

            <div class="product">
                <a href="{{ route('shop.show',$product->slug) }}">
                    <img src="{{ productImage($product->image) }}" alt="product">
                </a>
                <a href="{{ route('shop.show',$product->slug) }}">
                    <div class="product-name">{{ $product->name }}</div>
                </a>
                <div class="product-price">{{ $product->setPrice() }}</div>
            </div>

            @empty

            <div class="text-left">No product found !!</div>

            @endforelse

        </div> <!-- end products -->
        <div class="spacer"></div>

        {{ $products->appends(request()->input())->links() }}
    </div>
</div>

@endsection

@section('extra-js')

<!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
<script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>

<script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>

<script src="{{ asset('js/algoliaAutoComplete.js') }}"></script>

@endsection
