<x-layout>

    @auth()
        <a href="#products">
            <button type="button" class="btn btn-primary my-3">
                {{ __('labels.To Products Page') }}
            </button>
        </a>
    @else
    <!-- Button trigger modal -->
        <x-modal-button target="#loginModal">
            {{ __('labels.To Products Page') }}
        </x-modal-button>
    @endauth

    <!-- Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">{{ __('labels.Login') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="email">{{ __('labels.Email') }}</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="{{ __('labels.Enter email') }}"
                        >

                        <p class="text-danger email-error small"></p>
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">{{ __('labels.Password') }}</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="{{ __('labels.Enter password') }}"
                        >

                        <p class="text-danger password-error small"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('labels.Close') }}</button>
                    <button type="submit" class="btn btn-primary login">{{ __('labels.Login') }}</button>
                </div>
            </div>
        </div>
    </div>

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
    <div class="page cart" id="cart">
        <table class="table list"></table>

        <a href="#" class="btn btn-primary button">Go to index</a>

        <!-- The checkout form -->
        <div class="form-group">
            <label for="name">{{ __('labels.Name') }}</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('labels.Enter name') }}"
                   value="{{ old('name') }}"
            >

            <p class="text-danger name-error small"></p>
        </div>

        <div class="form-group">
            <label for="contact">{{ __('labels.Contact details') }}</label>
            <input type="text" class="form-control" id="contact" name="contact" placeholder="{{ __('labels.Enter contact details') }}"
                   value="{{ old('contact') }}"
            >

            <p class="text-danger contact-error small"></p>
        </div>

        <div class="form-group">
            <label for="comments">{{ __('labels.Comments') }}</label>
            <input type="text" class="form-control" id="comments" name="comments" placeholder="{{ __('labels.Enter comments') }}"
                   value="{{ $order->comments ?? '' }}">
        </div>

        <button type="submit" class="btn btn-primary checkout">{{ __('labels.Checkout') }}</button>
    </div>

    <!-- The products page -->
    <div class="page products" id="products">
        @guest()
            <p id="login-message">You must be logged in to see the products</p>
        @endguest

        @auth()
            <button type="submit" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal">
                {{ __('labels.Add new product') }}
            </button>

            <x-product-modal buttonType="add-product"/>
            <x-product-modal buttonType="edit-product"/>


                <table class="table list"></table>
        @endauth

        <a href="#" class="btn btn-primary button">Go to index</a>
    </div>

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
                                    '<button type="submit" value="' + product.id + '" class="btn btn-primary edit-product"></button>',
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

                $(document).on('click', '.login', function (e) {
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
                                $('#loginModal').modal('hide');
                                window.location = '#products';
                                location.reload();
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
                        success: function(response) {
                            window.onhashchange();
                            $('#success-text')
                                .text(response.message);
                            $('#success-message').show();
                        }
                    });
                });

                $(document).on('click', '.add-product', function (e) {
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
                                $('#title').val('');
                                $('#description').val('');
                                $('#price').val('');
                                $('#productModal').modal('hide');
                                $('#success-text').text(response.message);
                                $('#success-message').show();
                                window.onhashchange();
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
                                    $('.cart .list').html(renderList(response.products));
                                    $('.action-buttons .add-remove')
                                        .text('{{ __('labels.Remove') }}')
                                        .addClass('remove-from-cart');
                                    $('.action-buttons .edit-product').hide();
                                }
                            });
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
                                   $('.action-buttons .edit-product')
                                       .text('{{ __('labels.Edit') }}')
                                       .attr({
                                           'data-bs-toggle': 'modal',
                                           'data-bs-target': '#productModal'
                                       });
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

