<ul>
    @foreach($items as $menu_item)
    <li>
        <a href="{{ $menu_item->link() }}">
            {{ $menu_item->title }}

            @if ($menu_item->title === 'Cart')
            <span class="cart-count">
                @if (Cart::instance('shopping')->count() > 0)
                <span>
                    {{ Cart::instance('shopping')->count() }}
                </span>
                @endif
            </span>
            @endif
        </a>

    </li>
    @endforeach
</ul>

