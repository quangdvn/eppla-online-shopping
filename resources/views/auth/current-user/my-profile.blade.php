@extends('layout')

@section('title', 'My Profile')

@section('extra-css')

{{-- <link rel="stylesheet" href="{{ asset('css/algolia.css') }}"> --}}

@endsection

@section('content')

@component('components.breadcrumbs')

<a href="/">Home</a>
<i class="fa fa-chevron-right breadcrumb-separator"></i>
<span>My Profile</span>

@endcomponent

<div class="container mt-2">

    @include('partials.alert')

</div>

<div class="products-section container">
    <div class="sidebar">
        <ul>
            <li class="active">
                <a href="{{ route('user.edit') }}">My Profile</a>
            </li>
            <li>
                <a href="{{ route('order.index') }}">My Orders</a>
            </li>
        </ul>
    </div> <!-- end sidebar -->
    <div class="my-profile">
        <div class="products-header">
            <h1 class="stylish-heading">My Profile</h1>
        </div>

        <div>
            <form action="{{ route('user.update') }}" method="POST">

                @method('PUT')

                @csrf

                <div class="form-box">
                    <input id="name" class="form-control" type="text" name="name" value="{{ old('name', $user->name) }}"
                        placeholder="Name" required>
                </div>
                <div class="form-box">
                    <input id="email" class="form-control" type="email" name="email" value="{{ $user->email }}"
                        readonly>
                </div>
                <div class="form-box">
                    <input id="password" class="form-control" type="password" name="password" placeholder="Password">
                    <div style="font-size:15px;">Leave password blank to keep current password</div>
                </div>
                <div class="form-box">
                    <input id="password-confirm" class="form-control" type="password" name="password_confirmation"
                        placeholder="Confirm Password">
                </div>
                <div>
                    <button type="submit" class="my-profile-button">Update Profile</button>
                </div>
            </form>
        </div>

        <div class="spacer"></div>
    </div>
</div>

@endsection

@section('extra-js')
<!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
{{-- <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
<script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
<script src="{{ asset('js/algolia.js') }}"></script> --}}
@endsection
