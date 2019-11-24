@extends('layout')

@section('title', 'Search Results')

@section('extra-css')

@endsection

@section('content')

@component('components.breadcrumbs')

<a href="/">Home</a>
<i class="fa fa-chevron-right breadcrumb-separator"></i>
<span>Search</span>

@endcomponent

<div class="search-results-container container">
    <div class="container">
        @include('partials.alert')
    </div>
    <h1>Search Results</h1>
    <p class="search-results-count">
        {{ $searchProducts->total() }} result(s) for '{{ request()->input('query') }}'
    </p>
    <div class="my-2">
        <table class="table table-border table-striped table-inverse table-responsive">
            <thead class="thead-inverse">
                <tr>
                    <th>Name</th>
                    <th>Details</th>
                    <th>Description</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($searchProducts as $product)

                <tr>
                    <td>
                        <a href="{{ route('shop.show', $product->slug) }}">
                            {{ $product->name }}
                        </a>
                    </td>
                    <td>{{ $product->details }}</td>
                    <td>{{ str_limit($product->description, 80) }}</td>
                    <td>{{ $product->setPrice() }}</td>
                </tr>

                @endforeach
            </tbody>
        </table>

        {{ $searchProducts->appends(request()->input())->links() }}
    </div>


</div> <!-- end search-section -->


@endsection

@section('extra-js')

@endsection
