<x-login-required />

@auth()

    <a href="#product">
        <button type="button" class="btn btn-primary add-product">
            {{ __('labels.Add new product') }}
        </button>
    </a>

    <table class="table list"></table>
@endauth
