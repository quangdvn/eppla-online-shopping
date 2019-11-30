<ul>

    @guest

    <li><a href="{{ route('register') }}">Sign Up</a></li>
    <li><a href="{{ route('login') }}">Log In</a></li>

    @else
    <li>
        <a href="{{ route('user.edit') }}">My account</a>
    </li>

    <li>
        <a href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
    </li>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">

        @csrf

    </form>

    @endguest

    <li>
        <a href="{{ route('cart.index') }}">
            Cart
            <span class="cart-count">
                @if (Cart::instance('shopping')->count() > 0)
                <span>
                    {{ Cart::instance('shopping')->count() }}
                </span>
                @endif
            </span>
        </a>
    </li>

</ul>
