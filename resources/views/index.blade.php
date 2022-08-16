<x-layout>

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

        <!-- The checkout form -->
        <div class="form-group">
            <label for="name">{{ __('labels.Name') }}</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('labels.Enter name') }}"
                   value="{{ old('name') }}"
            >

            <p class="text-danger name-error"></p>
        </div>

        <div class="form-group">
            <label for="contact">{{ __('labels.Contact details') }}</label>
            <input type="text" class="form-control" id="contact" name="contact" placeholder="{{ __('labels.Enter contact details') }}"
                   value="{{ old('contact') }}"
            >

            <p class="text-danger contact-error"></p>
        </div>

        <div class="form-group">
            <label for="comments">{{ __('labels.Comments') }}</label>
            <input type="text" class="form-control" id="comments" name="comments" placeholder="{{ __('labels.Enter comments') }}"
                   value="{{ $order->comments ?? '' }}">
        </div>

        <button type="submit" class="btn btn-primary checkout">{{ __('labels.Checkout') }}</button>
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

                $(document).on('click', '.checkout', function (e) {
                    e.preventDefault();

                    data = {
                        'name': $('#name').val(),
                        'contact': $('#contact').val(),
                        'comments': $('#comments').val()
                    }

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'post',
                        url: '/checkout',
                        data: data,
                        dataType: 'json',
                        success: function (response) {
                            if (response.status === 400) {
                                $('.name-error').html('<p class="text-danger name-error small">' + response.errors.name ?? '' + '</p>');
                                $('.contact-error').html('<p class="text-danger name-error small">' + response.errors.contact ?? '' + '</p>');
                            } else {
                                window.location.hash = '#';
                                $('#name').val('');
                                $('#contact').val('');
                                $('#comments').val('');
                            }
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

