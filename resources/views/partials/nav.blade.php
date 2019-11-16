<header>
    <div class="top-nav container">
        <div class="top-nav-left">
            <div class="logo">
                <a href="/">Eppla</a>
            </div>
            @if (!request()->is('checkout'))

            @include('partials.menus.top-nav-left')

            @endif
        </div>
        <div class="top-nav-right">
            @if (!request()->is('checkout'))

            @include('partials.menus.top-nav-right')

            @endif

        </div>
    </div> <!-- end top-nav -->
</header>
