<x-layout>

    <!-- Success message -->
    <div id="success-message" class="alert alert-success alert-dismissible fade show" style="display: none">
        <div id="success-text"></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <!-- The index page -->
    <div class="page index">
        <table class="table list"></table>

        <a href="#cart" class="btn btn-primary button">Go to cart</a>
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
    @include('orders')

    @section('scripts')
        <script>
            $(document).ready(function () {
                function renderList(products) {
                    html = [
                        '<thead>',
                        '<tr>',
                        '<th scope="col">Title</th>',
                        '<th scope="col">Description</th>',
                        '<th scope="col">Price</th>',
                        '</tr>',
                        '</thead>',
                        '<tbody>'
                    ].join('');

                    $.each(products, function (key, product) {
                        html += [
                            '<tr>',
                            '<td>' + product.title + '</td>',
                            '<td>' + product.description + '</td>',
                            '<td>' + product.price + '</td>',
                            '<td class="action-buttons">',
                            '<button type="submit" value="' + product.id + '" class="btn btn-primary mb-2 add-remove"></button>',
                            '<a href="#product"><button type="submit" value="' + product.id + '" class="btn btn-primary edit-product"></button></a>',
                            '</td>',
                            '</tr>'
                        ].join('');
                    });

                    html += '</tbody>';

                    return html;
                }

                function renderOrderList(orders) {
                    html = [
                        '<thead>',
                        '<tr>',
                        '<th scope="col">ID</th>',
                        '<th scope="col">Contact</th>',
                        '<th scope="col">Comments</th>',
                        '<th scope="col">Total</th>',
                        '<th scope="col">Actions</th>',
                        '</tr>',
                        '</thead>',
                        '<tbody>'
                    ].join('');

                    $.each(orders, function (key, order) {
                        html += [
                            '<tr>',
                            '<td>' + order.id + '</td>',
                            '<td>' + order.contact + '</td>',
                            '<td>' + order.comments + '</td>',
                            '<td>' + order.total + '</td>',
                            '<td class="action-buttons">',
                            '<button type="submit" value="' + order.id + '" class="btn btn-primary mb-2 view-order"></button>',
                            '</td>',
                            '</tr>'
                        ].join('');
                    });

                    html += '</tbody>';

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
                        success: function () {
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
                        success: function () {
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
                                $('.name-error').text(response.errors.name ? response.errors.name : '');
                                $('.contact-error').text(response.errors.contact ? response.errors.contact : '');
                            } else {
                                window.location.hash = '#';
                                $('#name').val('');
                                $('#contact').val('');
                                $('#comments').val('');
                                $('#success-message')
                                    .append(response.message)
                                    .show();
                            }
                        }
                    });
                });

                $(document).on('click', '.login-store', function (e) {
                    e.preventDefault();

                    data = {
                        'email': $('#email').val(),
                        'password': $('#password').val()
                    }

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'post',
                        url: '/login',
                        data: data,
                        dataType: 'json',
                        success: function (response) {
                            $('.email-error').html('');
                            $('.password-error').html('');
                            if (response.status === 400) {
                                $('.email-error').text(response.errors.email ? response.errors.email : '');
                                $('.password-error').text(response.errors.password ? response.errors.password : '');
                            } else if (response.status === 401) {
                                $('.email-error').text(response.message ? response.message : '');
                                $('#password').val('');
                            } else {
                                $('#products')
                                    .html('')
                                    .load(document.URL + ' #products');
                                $('#navbar').load(document.URL + ' #navbar');
                                window.location = '#products';
                                $('#success-message')
                                    .append(response.message)
                                    .show();
                            }
                        }
                    });
                });

                $(document).on('click', '.delete-product', function (e) {
                    e.preventDefault();

                    productId = $(this).val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'post',
                        url: '/delete/' + productId,
                        success: function (response) {
                            window.onhashchange();
                            $('#success-text')
                                .text(response.message);
                            $('#success-message').show();
                        }
                    });
                });

                $(document).on('click', '.add-product', function () {
                    $('#product .action-button')
                        .text(' {{ __('labels.Add') }} ')
                        .removeClass('update-product')
                        .addClass('store-product');
                });

                $(document).on('click', '.store-product', function (e) {
                    e.preventDefault();

                    data = {
                        'title': $('#title').val(),
                        'description': $('#description').val(),
                        'price': $('#price').val()
                    }

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'post',
                        url: '/add/',
                        data: data,
                        dataType: 'json',
                        success: function (response) {
                            if (response.status === 400) {
                                $('.title-error').text(response.errors.title ? response.errors.title : '');
                                $('.description-error').text(response.errors.description ? response.errors.description : '');
                                $('.price-error').text(response.errors.price ? response.errors.price : '');
                            } else {
                                $('#success-text').text(response.message);
                                $('#success-message').show();
                                window.location = '#products';
                            }
                        }
                    });
                });

                $(document).on('click', '.edit-product', function () {
                    productId = $(this).val();

                    $('#product .action-button')
                        .text(' {{ __('labels.Edit') }} ')
                        .removeClass('store-product')
                        .addClass('update-product');
                    $.ajax({
                        type: 'get',
                        url: '/edit-product/' + productId,
                        dataType: 'json',
                        success: function (response) {
                            if (response.status === 404) {
                                $('#title').val('');
                                $('#description').val('');
                                $('#price').val('');
                            } else {
                                $('#title').val(response.product.title);
                                $('#description').val(response.product.description);
                                $('#price').val(response.product.price);
                                $('#id').val(productId);
                            }
                        }
                    });
                });

                $(document).on('click', '.update-product', function (e) {
                    e.preventDefault();

                    productId = $('#id').val();

                    data = {
                        'title': $('#title').val(),
                        'description': $('#description').val(),
                        'price': $('#price').val()
                    };

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'post',
                        url: '/update-product/' + productId,
                        data: data,
                        dataType: 'json',
                        success: function (response) {
                            if (response.status === 400) {
                                $('#productEditModal .title-error').text(response.errors.title ? response.errors.title : '');
                                $('#productEditModal .description-error').text(response.errors.description ? response.errors.description : '');
                                $('#productEditModal .price-error').text(response.errors.price ? response.errors.price : '');
                            } else {
                                $('#title').val('');
                                $('#description').val('');
                                $('#price').val('');
                                $('#success-text').text(response.message);
                                $('#success-message').show();
                                window.location = '#products';
                            }
                        }
                    });
                });

                $(document).on('click', '.view-order', function (e) {
                    e.preventDefault();

                    orderId = $(this).val();

                    $('#orderModal #products').html('');

                    $.ajax({
                        type: 'get',
                        url: '/order/' + orderId,
                        dataType: 'json',
                        success: function (response) {
                            $('#orderModal #name').text(response.order.name);
                            $('#orderModal #contact').text(response.order.contact);
                            $('#orderModal #comments').text(response.order.comments);
                            $.each(response.orderProducts, function (key, orderProduct) {
                                $('#orderModal #products')
                                    .append('<li>' + orderProduct.title + ' - ' + orderProduct.price + '</li>');
                            });
                            $('#orderModal #total').text(response.order.total);
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
                                type: 'get',
                                url: '/fetch-cart-products',
                                dataType: 'json',
                                success: function (response) {
                                    $('.cart .list').html(renderList(response.products));
                                    $('.action-buttons .add-remove')
                                        .text('{{ __('labels.Remove') }}')
                                        .addClass('remove-from-cart');
                                    $('.action-buttons .edit-product').hide();
                                }
                            });
                            break;
                        case '#login':
                            $('.login').show();
                            break;
                        case '#products':
                            $('.products').show();
                            $.ajax({
                                type: 'get',
                                url: '/fetch-all-products',
                                dataType: 'json',
                                success: function (response) {
                                    $('.products .list').html(renderList(response.products));
                                    $('.action-buttons .add-remove').text('{{ __('labels.Delete product') }}').addClass('delete-product');
                                    $('.action-buttons .edit-product').text('{{ __('labels.Edit') }}');
                                }
                            });
                            break;
                        case '#product':
                            $('.product').show();
                            $('#product .error').text('');
                            $('#product input').val('');
                            break;
                        case '#orders':
                            $('.orders').show();
                            $.ajax({
                                type: 'get',
                                url: '/fetch-orders',
                                dataType: 'json',
                                success: function (response) {
                                    $('.orders .list').html(renderOrderList(response.orders));
                                    $('.view-order')
                                        .text('{{ __('labels.View order') }}')
                                        .attr({
                                            'data-bs-toggle': 'modal',
                                            'data-bs-target': '#orderModal'
                                        });
                                }
                            });
                            break;
                        default:
                            $('.index').show();
                            $.ajax({
                                type: 'get',
                                url: '/fetch-products',
                                dataType: 'json',
                                success: function (response) {
                                    $('.index .list').html(renderList(response.products));
                                    $('.action-buttons .add-remove')
                                        .text('{{ __('labels.Add to cart') }}')
                                        .addClass('add-to-cart');
                                    $('.action-buttons .edit-product').hide();
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

