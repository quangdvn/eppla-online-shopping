@extends('layout')

@section('title', 'Search Results')

@section('extra-css')

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/instantsearch.css@7.3.1/themes/reset-min.css"
    integrity="sha256-t2ATOGCtAIZNnzER679jwcFcKYfLlw01gli6F6oszk8=" crossorigin="anonymous">

<link rel="stylesheet" type="text/css"
    href="https://cdn.jsdelivr.net/npm/instantsearch.css@7.3.1/themes/algolia-min.css"
    integrity="sha256-HB49n/BZjuqiCtQQf49OdZn63XuKFaxcIHWf0HNKte8=" crossorigin="anonymous">

@endsection

@section('content')

@component('components.breadcrumbs')

<a href="/">Home</a>
<i class="fa fa-chevron-right breadcrumb-separator"></i>
<span>Search</span>

@endcomponent

<div class="container">
    @include('partials.alert')
</div>

<div class="container">
    <div class="search-results-container-algolia my-4">
        <div class="left">
            <h2>Search Results</h2>
            <div id="searchbox">

            </div>
            <div id="stats">

            </div>
            <br>
            <h2>Categories</h2>
            <div id="refinement-list">

            </div>
        </div>

        <div class="right">
            <div id="hits">

            </div>
            <div id="pagination">

            </div>
        </div>

    </div> <!-- end search-section -->
</div>

@endsection

@section('extra-js')

<!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
<script src="https://cdn.jsdelivr.net/npm/algoliasearch@3.35.1/dist/algoliasearchLite.min.js"
    integrity="sha256-5rOQwvvJdM9oDYQYCGzaJuuTy6SUALjma3OtzEGyJM0=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/instantsearch.js@4.0.0/dist/instantsearch.production.min.js"
    integrity="sha256-6S7q0JJs/Kx4kb/fv0oMjS855QTz5Rc2hh9AkIUjUsk=" crossorigin="anonymous"></script>

<script src="{{ asset('js/algoliaAutoComplete.js') }}"></script>

<script src="{{ asset('js/algoliaInstantSearch.js') }}"></script>

@endsection
