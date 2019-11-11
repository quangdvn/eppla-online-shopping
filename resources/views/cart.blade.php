@extends('layout')

@section('title', 'Shopping Cart')

@section('extra-css')

@endsection

@section('content')

<div class="breadcrumbs">
    <div class="container">
        <a href="/">Home</a>
        <i class="fa fa-chevron-right breadcrumb-separator"></i>
        <span>Shopping Cart</span>
    </div>
</div> <!-- end breadcrumbs -->

<div class="cart-section container">
    <div>
        @include('partials.alert')

        @if (Cart::instance('shopping')->count() > 0)

        {{-- Current Cart has Items --}}

        <h2>{{Cart::instance('shopping')->count()}} item(s) in Shopping Cart</h2>

        <div class="cart-table">

            @foreach (Cart::instance('shopping')->content() as $cartItem)

            <div class="cart-table-row">
                <div class="cart-table-row-left">
                    <a href=" {{ route('shop.show',$cartItem->model->slug)}} ">
                        <img src="{{ asset("img/products/{$cartItem->model->slug}.jpg") }}" alt="item"
                            class="cart-table-img">
                    </a>
                    <div class="cart-item-details">
                        <div class="cart-table-item">
                            <a href="{{ route('shop.show',$cartItem->model->slug) }}">
                                {{ $cartItem->model->name }}
                            </a>
                        </div>
                        <div class="cart-table-description">
                            {{ $cartItem->model->details }}
                        </div>
                    </div>
                </div>
                <div class="cart-table-row-right">
                    <div class="cart-table-actions">
                        <form action="{{ route('cart.destroy',$cartItem->rowId) }}" method="POST">

                            @csrf

                            @method('DELETE')

                            <button type="submit" class="cart-options">Remove</button>

                        </form>
                        <form action="{{ route('cart.moveToWishList',$cartItem->rowId) }}" method="POST">

                            @csrf

                            <button type="submit" class="cart-options">Add to WishList</button>

                        </form>
                    </div>
                    <div>
                        <select class="quantity" data-id={{ $cartItem->rowId }}>

                            @for ($i = 1; $i < 6; $i++) <option {{ $cartItem->qty == $i ? 'selected' : '' }}>
                                {{ $i }}
                                </option>
                                @endfor

                        </select>
                    </div>
                    <div>{{ presentPrice($cartItem->subtotal()) }}</div>
                </div>
            </div> <!-- end cart-table-row -->

            @endforeach

        </div> <!-- end cart-table -->

        <a href="#" class="have-code">Have a Code?</a>

        <div class="have-code-container">
            <form action="#">
                <input type="text">
                <button type="submit" class="button button-plain">Apply</button>
            </form>
        </div> <!-- end have-code-container -->


        <div class="cart-totals">
            <div class="cart-totals-left">
                Shipping is free because we’re awesome like that. Also because that’s additional stuff I don’t feel like
                figuring out :).
            </div>

            <div class="cart-totals-right">
                <div>
                    Subtotal <br>
                    Tax <br>
                    <span class="cart-totals-total">Total</span>
                </div>
                <div class="cart-totals-subtotal">
                    {{ presentPrice(Cart::instance('shopping')->subtotal()) }} <br>
                    {{ presentPrice(Cart::instance('shopping')->tax())}} <br>
                    <span class="cart-totals-total">{{ presentPrice(Cart::instance('shopping')->total())}}</span>
                </div>
            </div>
        </div> <!-- end cart-totals -->

        <div class="cart-buttons">
            <a href="{{ route('shop.index') }}" class="button">Continue Shopping</a>
            <a href="{{ route('checkout.index') }}" class="button-primary">Proceed to Checkout</a>
        </div>

        {{-- Current Cart doesn't have Item --}}
        @else

        <div>
            <h2>No items in Cart now !!</h2>
            <div class="spacer"></div>
            <a class="button-primary" href="{{ route('shop.index') }}">Go back and Shopping</a>
            <div class="spacer"></div>
        </div>

        @endif

        @if (Cart::instance('wishList')->count() > 0)

        <h2>{{ Cart::instance('wishList')->count() }} item(s) Saved For Later</h2>

        <div class="saved-for-later cart-table">

            @foreach (Cart::instance('wishList')->content() as $wishItem )

            <div class="cart-table-row">
                <div class="cart-table-row-left">
                    <a href=" {{ route('shop.show',$wishItem->model->slug) }} ">
                        <img src="{{ asset("img/products/{$wishItem->model->slug}.jpg") }} " alt="item"
                            class="cart-table-img">
                    </a>
                    <div class="cart-item-details">
                        <div class="cart-table-item">
                            <a href=" {{ route('shop.show',$wishItem->model->slug) }} ">
                                {{ $wishItem->model->name }}
                            </a>
                        </div>
                        <div class="cart-table-description">{{ $wishItem->model->details }}</div>
                    </div>
                </div>
                <div class="cart-table-row-right">
                    <div class="cart-table-actions">
                        <form action="{{ route('wishList.destroy',$wishItem->rowId) }}" method="POST">

                            @csrf

                            @method('DELETE')

                            <button type="submit" class="cart-options">Remove</button>

                        </form>
                        <form action="{{ route('wishList.moveToCart',$wishItem->rowId) }}" method="POST">

                            @csrf

                            <button type="submit" class="cart-options">Add to Cart</button>

                        </form>
                    </div>

                    <div>{{ $wishItem->model->setPrice() }}</div>
                </div>

            </div> <!-- end cart-table-row -->

            @endforeach

        </div> <!-- end wish-list -->

        @else

        <h2>You have no items in WishList !!</h2>

        @endif


    </div>

</div> <!-- end cart-section -->

@include('partials.might-like')

@endsection

@section('extra-js')

{{-- Load Axios to file --}}
<script src="{{ asset('js/app.js')}}"></script>

<script src="{{ asset('js/ajax.js') }}"></script>

@endsection
