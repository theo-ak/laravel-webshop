<x-layout>
    <a href="{{ route('cart.index') }}">
        <button class="btn btn-primary my-3">{{ __('labels.To Cart') }}</button>
    </a>

    <a href="{{ route('products.index') }}">
        <button class="btn btn-primary my-3">{{ __('labels.To Products Page') }}</button>
    </a>

    <div class="page index">
        <table class="table list"></table>

        <a href="#cart" class="btn btn-primary button">Go to cart</a>
    </div>

    <!-- The cart page -->
    <div class="page cart" id="cart">
        <table class="table list"></table>

        <a href="#" class="btn btn-primary button">Go to index</a>
    </div>

    @section('scripts')
        <script>
            $(document).ready(function () {
                function renderList(products, buttonType) {
                    html = [
                        '<thead>',
                            '<tr>',
                                '<th scope="col">Title</th>',
                                '<th scope="col">Description</th>',
                                '<th scope="col">Price</th>',
                            '</tr>',
                        '</thead>'
                    ].join('');

                    $.each(products, function (key, product) {
                        html += [
                            '<tbody>',
                                '<tr>',
                                    '<td>' + product.title + '</td>',
                                    '<td>' + product.description + '</td>',
                                    '<td>' + product.price + '</td>',
                                    buttonType === 'add' ?
                                        '<td><button type="submit" value="' + product.id + '" class="btn btn-primary add-to-cart">Add to Cart</button></td>' :
                                        '<td><button type="submit" value="' + product.id + '" class="btn btn-primary remove-from-cart">Remove</button></td>',
                                '</tr>',
                            '</tbody>'
                        ].join('');
                    });

                    return html;
                }

                $(document).on('click', '.add-to-cart', function (e) {
                    e.preventDefault();

                    productId = $(this).val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'post',
                        url: '/add-to-cart/' + productId,
                        success: function() {
                            window.onhashchange();
                        }
                    });
                });

                $(document).on('click', '.remove-from-cart', function (e) {
                    e.preventDefault();

                    productId = $(this).val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'post',
                        url: '/remove-from-cart/' + productId,
                        success: function() {
                            window.onhashchange('#cart');
                        }
                    });
                });

                /**
                 * URL hash change handler
                 */
                window.onhashchange = function () {
                    $('.page').hide();

                    switch (window.location.hash) {
                        case '#cart':
                            $('.cart').show();
                            $.ajax({
                                type:'get',
                                url: '/fetch-cart-products',
                                dataType: 'json',
                                success: function (response) {
                                    $('.cart .list').html(renderList(response.products, 'remove'));
                                }
                            });
                            break;
                        default:
                            $('.index').show();
                            $.ajax({
                                type:'get',
                                url:'/fetch-products',
                                dataType: 'json',
                                success: function (response) {
                                    $('.index .list').html(renderList(response.products, 'add'));
                                }
                            });
                            break;
                    }
                }

                window.onhashchange();
            });
        </script>
    @endsection
</x-layout>

