<form action="{{ route('shop.search') }}" method="GET" class="search-form">
    <i class="fa fa-search search-icon"></i>
    <input type="text" name="query" id="query" class="search-box" placeholder="Search for product"
        value="{{ request()->input('query') }}">
</form>
