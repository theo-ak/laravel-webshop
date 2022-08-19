
    @guest()
        <p id="login-message">You must be logged in to see the products</p>
    @endguest

    @auth()
        <button type="submit" class="btn btn-primary add-product" data-bs-toggle="modal" data-bs-target="#productModal">
            {{ __('labels.Add new product') }}
        </button>

        <x-add-product-modal />
        <x-edit-product-modal />

        <table class="table list"></table>
    @endauth

    <a href="#" class="btn btn-primary button">Go to index</a>
