<x-layout>

    <!-- Success message -->
    <div id="success-message" class="alert alert-success alert-dismissible fade show" style="display: none">
        <div id="success-text"></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <!-- The index page -->
    <div class="page index">
        <table class="table list"></table>

        <a href="#cart" class="btn btn-primary button">{{ __('labels.To Cart') }}</a>
    </div>

    <!-- The cart page -->
    @include('cart')

    <!-- The login page -->
    @include('login')

    <!-- The products page -->
    <div class="page products" id="products">
        @include('products')
    </div>

    <!-- The product page -->
    <div class="page product" id="product">
        @include('product')
    </div>

    <!-- The orders page -->
    <div class="page orders" id="orders">
        @include('orders')
    </div>

    <!-- The order page -->
    <div class="page order" id="order">
        @include('order')
    </div>

</x-layout>

