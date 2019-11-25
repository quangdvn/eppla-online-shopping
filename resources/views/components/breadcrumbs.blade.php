<div class="breadcrumbs">
    <div class="breadcrumbs-container container">
        <div>
            {{ $slot }}
        </div>
        <div>
            @include('partials.algolia-auto-complete')
        </div>
    </div>
</div> <!-- end breadcrumbs -->