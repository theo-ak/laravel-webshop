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
    <div class="page cart" id="cart">
        <table class="table list"></table>

        <a href="#" class="btn btn-primary button">{{ __('labels.To Index') }}</a>

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

    <!-- The login page -->
    <div class="page login" id="login">
        <div class="form-group mb-3">
            <label for="email">{{ __('labels.Email') }}</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="{{ __('labels.Enter email') }}"
            >

            <p class="text-danger error email-error small"></p>
        </div>

        <div class="form-group mb-3">
            <label for="password">{{ __('labels.Password') }}</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="{{ __('labels.Enter password') }}"
            >

            <p class="text-danger error password-error small"></p>
        </div>

        <div class="login-footer">
            <button type="submit" class="btn btn-primary login-store">{{ __('labels.Login') }}</button>
        </div>
    </div>

    <!-- The products page -->
    <div class="page products" id="products">
        <a href="#product">
            <button type="button" class="btn btn-primary add-product">
                {{ __('labels.Add new product') }}
            </button>
        </a>

        <table class="table list"></table>
    </div>

    <!-- The product page -->
    <div class="page product" id="product">
        <div class="form-group mb-3">
            <label for="title">{{ __('labels.Title') }}</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="{{ __('labels.Enter title') }}"
            >

            <p class="text-danger error title-error small"></p>
        </div>

        <div class="form-group mb-3">
            <label for="description">{{ __('labels.Description') }}</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="{{ __('labels.Enter description') }}"
            >

            <p class="text-danger error description-error small"></p>
        </div>

        <div class="form-group mb-3">
            <label for="price">{{ __('labels.Price') }}</label>
            <input type="number" class="form-control" id="price" name="price" placeholder="{{ __('labels.Enter price') }}"
            >

            <p class="text-danger error price-error small"></p>
        </div>

        <input type="hidden" name="id" id="id">

        <div class="product-footer">
            <a href="#products">
                <button type="button" class="btn btn-secondary">{{ __('labels.Back') }}</button>
            </a>
            <button type="submit" class="btn btn-primary action-button store-product">{{ __('labels.Add') }}</button>
        </div>
    </div>

    <!-- The orders page -->
    <div class="page orders" id="orders">
        <table class="table list"></table>
    </div>

    <!-- The order page -->
    <div class="page order" id="order">
        <table class="table list"></table>
    </div>

    <script>
        console.log('{{ url()->full() }}');
        let checkAuth = '{{ auth()->check() }}';
        console.log(checkAuth);

        // translations array
        const translations = {
            'Title' : 'Titlu',
            'Description' : 'Descriere',
            'Price' : 'Pret',
            'To Cart' : 'Cart',
            'To Index' : 'Index',
            'To Products Page' : 'Pagina produse',
            'Add to cart' : 'Adauga in cart',
            'Name' : 'Nume',
            'Remove' : 'Stergeti',
            'Contact details' : 'Date contact',
            'Comments' : 'Comentarii',
            'Checkout' : 'Checkout',
            'Enter name' : 'Introduceti un nume',
            'Enter contact details' : 'Introduceti datele de contact',
            'Enter comments' : 'Introduceti comentariile',
            'Add new product' : 'Adaugati un nou produs',
            'Delete product' : 'Stergeti produsul',
            'Edit' : 'Editati',
            'Enter title' : 'Introduceti un titlu',
            'Enter description' : 'Introduceti o descriere',
            'Enter price' : 'Introduceti un pret',
            'Upload an image' : 'Incarcati o imagine',
            'Submit' : 'Adaugati',
            'Total' : 'Total',
            'Actions' : 'Actiuni',
            'View order' : 'Vizualizati comanda',
            'Products' : 'Produse',
            'Contact' : 'Contact',
            'Customer Name' : 'Nume client',
            'Items ordered' : 'Produse comandate',
            'Email address' : 'Adresa email',
            'Enter email' : 'Introduceti un email',
            'Password' : 'Parola',
            'Login' : 'Autentificare',
            'To Orders Page' : 'Pagina comenzi',
            'Order placed successfully' : 'Comanda plasata cu succes',
            'Email' : 'Email',
            'Enter password' : 'Introduceti parola',
            'Close' : "Inchideti",
            'Add' : 'Adaugati',
            'Admin' : 'Admin',
            'Index' : 'Index',
            'Cart' : 'Cart',
            'Orders' : 'Comenzi',
            'Back' : 'Inapoi',
            'ID' : 'ID',
            'Login successful' : 'Autentificare reusita',
            'Product added successfully' : 'Produs adaugat cu succes',
            'Product not found' : 'Produsul nu exista',
            'Product updated successfully' : 'Produs modificat cu succes',
            'Product deleted successfully' : 'Produs eliminat cu succes'
        }

        let language = navigator.language.slice(0, 2);

        function translate(label) {
            if (language === 'ro') {
                return translations[label];
            }

            return label;
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {

            function renderList(products) {
                html = [
                    `<thead>`,
                    `<tr>`,
                    `<th scope="col">${translate('Title')}</th>`,
                    `<th scope="col">${translate('Description')}</th>`,
                    `<th scope="col">${translate('Price')}</th>`,
                    `</tr>`,
                    `</thead>`,
                    `<tbody>`
                ].join('');

                $.each(products, function (key, product) {
                    html += [
                        `<tr>`,
                        `<td>${product.title}</td>`,
                        `<td>${product.description}</td>'`,
                        `<td>${product.price}</td>`,
                        `<td class="action-buttons">`,
                        `<button type="submit" value="${product.id}" class="btn btn-primary mb-2 add-remove"></button>`,
                        `<a href="#product"><button type="submit" value="${product.id}" class="btn btn-primary edit-product"></button></a>`,
                        `</td>`,
                        `</tr>`
                    ].join('');
                });

                html += '</tbody>';

                return html;
            }

            function renderProductsTable(products) {
                html = [
                    `<thead>`,
                    `<tr>`,
                    `<th scope="col">${translate('Title')}</th>`,
                    `<th scope="col">${translate('Description')}</th>`,
                    `<th scope="col">${translate('Price')}</th>`,
                    `</tr>`,
                    `</thead>`,
                    `<tbody>`
                ].join('');

                $.each(products, function (key, product) {
                    html += [
                        `<tr>`,
                        `<td>${product.title}</td>`,
                        `<td>${product.description}</td>'`,
                        `<td>${product.price}</td>`,
                        `<td class="action-buttons">`,
                        `<button type="submit" value="${product.id}" class="btn btn-primary mb-2 delete-product">${translate('Delete product')}</button>`,
                        `<a href="#product"><button type="submit" value="${product.id}" class="btn btn-primary edit-product">${translate('Edit')}</button></a>`,
                        `</td>`,
                        `</tr>`
                    ].join('');
                });

                html += '</tbody>';

                return html;
            }

            function renderOrderList(orders) {
                html = [
                    `<thead>`,
                    `<tr>`,
                    `<th scope="col" class="table-id">${translate('ID')}</th>`,
                    `<th scope="col" class="table-contact">${translate('Contact')}</th>`,
                    `<th scope="col" class="table-comments">${translate('Comments')}</th>`,
                    `<th scope="col" class="table-total">${translate('Total')}</th>`,
                    `<th scope="col" class="table-actions">${translate('Actions')}</th>`,
                    `</tr>`,
                    `</thead>`,
                    `<tbody>`
                ].join('');

                $.each(orders, function (key, order) {
                    html += [
                        `<tr>`,
                        `<td>${order.id}</td>`,
                        `<td>${order.contact}</td>`,
                        `<td>${order.comments}</td>`,
                        `<td>${order.total}</td>`,
                        `<td class="action-buttons">`,
                        `<a href="#order"><button type="submit" value="${order.id}" class="btn btn-primary mb-2 view-order"></button></a>`,
                        `</td>`,
                        `</tr>`
                    ].join('');
                });

                html += '</tbody>';

                return html;
            }

            function renderOrder(order) {
                let html = [
                    `<thead>`,
                    `<tr>`,
                    `<th scope="col" class="table-id">${translate('ID')}</th>`,
                    `<th scope="col" class="table-contact">${translate('Contact')}</th>`,
                    `<th scope="col" class="table-comments">${translate('Comments')}</th>`,
                    `<th scope="col" class="table-products">${translate('Products')}</th>`,
                    `<th scope="col" class="table-total">${translate('Total')}</th>`,
                    `</tr>`,
                    `</thead>`,
                    `<tbody>`,
                    `<tr>`,
                    `<td>${order.id}</td>`,
                    `<td>${order.contact}</td>`,
                    `<td>${order.comments}</td>`,
                    `<td>`
                ].join('');

                $.each(order.products, function (key, product) {
                    html += `<p>${product.title} - ${product.price}</p>`;
                });

                html += [
                    '</td>',
                    '<td>' + order.total + '</td>',
                    '</tbody>'
                ].join('');

                return html;
            }

            $(document).on('click', '.add-to-cart', function (e) {
                e.preventDefault();

                productId = $(this).val();

                $.ajax({
                    type: 'post',
                    url: '/cart/' + productId,
                    success: function () {
                        window.onhashchange();
                    }
                });
            });

            $(document).on('click', '.remove-from-cart', function (e) {
                e.preventDefault();

                productId = $(this).val();

                $.ajax({
                    type: 'delete',
                    url: '/cart/' + productId,
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

                $.ajax({
                    type: 'post',
                    url: '/orders',
                    data: data,
                    dataType: 'json',
                    success: function (response) {
                        window.location.hash = '#';
                        $('#name').val('');
                        $('#contact').val('');
                        $('#comments').val('');
                        $('#success-message')
                            .append(response.message)
                            .show();
                    },
                    error: function (response) {
                        $('.name-error')
                            .text(
                                response.responseJSON.errors.name ?
                                    response.responseJSON.errors.name :
                                    '');
                        $('.contact-error')
                            .text(
                                response.responseJSON.errors.contact ?
                                    response.responseJSON.errors.contact :
                                    '');
                    }
                });
            });

            $(document).on('click', '.login-store', function (e) {
                e.preventDefault();

                data = {
                    'email': $('#email').val(),
                    'password': $('#password').val()
                }

                $.ajax({
                    type: 'post',
                    url: '/login',
                    data: data,
                    dataType: 'json',
                    success: function (response) {
                        $('meta[name="csrf-token"]').attr('content', response.token);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': response.token
                            }
                        });
                        checkAuth = '1';
                        window.location = '#products';
                        window.onhashchange();
                        $('#success-message').show();
                        $('#success-text').text(response.message);
                    },
                    error: function (response) {
                        if (response.status === 422) {
                            $('.email-error')
                                .text(
                                    response.responseJSON.errors.email ?
                                        response.responseJSON.errors.email :
                                        '');
                            $('.password-error')
                                .text(
                                    response.responseJSON.errors.password ?
                                        response.responseJSON.errors.password :
                                        '');
                        }
                    }
                });
            });

            $(document).on('click', '.delete-product', function (e) {
                e.preventDefault();

                productId = $(this).val();

                $.ajax({
                    type: 'delete',
                    url: '/products/' + productId,
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

                $.ajax({
                    type: 'post',
                    url: '/products',
                    data: data,
                    dataType: 'json',
                    success: function (response) {
                        $('#success-text').text(response.message);
                        $('#success-message').show();
                        window.location = '#products';
                    },
                    error: function (response) {
                        $('.title-error')
                            .text(
                                response.responseJSON.errors.title ?
                                    response.responseJSON.errors.title :
                                    '');
                        $('.description-error')
                            .text(
                                response.responseJSON.errors.description ?
                                    response.responseJSON.errors.description :
                                    '');
                        $('.price-error')
                            .text(
                                response.responseJSON.errors.price ?
                                    response.responseJSON.errors.price :
                                    '');
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
                    url: '/products/' + productId + '/edit',
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

                $.ajax({
                    type: 'put',
                    url: '/products/' + productId,
                    data: data,
                    dataType: 'json',
                    success: function (response) {
                        $('#title').val('');
                        $('#description').val('');
                        $('#price').val('');
                        $('#success-text').text(response.message);
                        $('#success-message').show();
                        window.location = '#products';
                    },
                    error: function (response) {
                        $('.title-error')
                            .text(
                                response.responseJSON.errors.title ?
                                    response.responseJSON.errors.title :
                                    '');
                        $('.description-error')
                            .text(
                                response.responseJSON.errors.description ?
                                    response.responseJSON.errors.description :
                                    '');
                        $('.price-error')
                            .text(
                                response.responseJSON.errors.price ?
                                    response.responseJSON.errors.price :
                                    '');
                    }
                });
            });

            $(document).on('click', '.view-order', function () {
                orderId = $(this).val();

                $.ajax({
                    type: 'get',
                    url: '/orders/' + orderId,
                    dataType: 'json',
                    success: function (response) {
                        if (response.status === 200) {
                            $('.order .list').html(renderOrder(response.orders));
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
                        $.ajax({
                            type: 'get',
                            url: '/cart',
                            dataType: 'json',
                            success: function (response) {
                                $('.cart .list').html(renderList(response.products));
                                $('.action-buttons .add-remove')
                                    .text('{{ __('labels.Remove') }}')
                                    .addClass('remove-from-cart');
                                $('.action-buttons .edit-product').hide();
                            }
                        });
                        $('.cart').show();
                        break;
                    case '#login':
                        $('.login input').val('');
                        $('.login .error').text('');
                        $('.login').show();
                        break;
                    case '#products':
                        if (checkAuth === '1') {
                            $.ajax({
                                type: 'get',
                                url: '{{ route('products.index') }}',
                                dataType: 'json',
                                success: function (response) {
                                    $('.products .list').html(renderProductsTable(response.products));
                                    $('.action-buttons .add-remove').text('{{ __('labels.Delete product') }}').addClass('delete-product');
                                    $('.action-buttons .edit-product').text('{{ __('labels.Edit') }}');
                                }
                            });
                            $('.products').show();
                        } else {
                            window.location = '#login';
                        }
                        break;
                    case '#product':
                        $('#product .error').text('');
                        $('#product input').val('');
                        $('.product').show();
                        break;
                    case '#orders':
                        if (checkAuth === '1') {
                            $.ajax({
                                type: 'get',
                                url: '/orders',
                                dataType: 'json',
                                success: function (response) {
                                    $('.orders .list').html(renderOrderList(response.orders));
                                    $('.view-order').text('{{ __('labels.View order') }}');
                                }
                            });
                            $('.orders').show();
                        } else {
                            window.location = '#login';
                        }
                        break;
                    case '#order':
                        $('.order').show();
                        break;
                    default:
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
                        $('.index').show();
                        break;
                }
            }

            window.onhashchange();
        });
    </script>
</x-layout>

