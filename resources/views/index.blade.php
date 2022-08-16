<x-layout>
    <a href="{{ route('cart.index') }}">
        <button class="btn btn-primary my-3">{{ __('labels.To Cart') }}</button>
    </a>

    <a href="{{ route('products.index') }}">
        <button class="btn btn-primary my-3">{{ __('labels.To Products Page') }}</button>
    </a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('labels.Title') }}</th>
            <th scope="col">{{ __('labels.Description') }}</th>
            <th scope="col">{{ __('labels.Price') }}</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
{{--        @foreach ($products as $product)--}}
{{--            <tr>--}}
{{--                <th scope="row">{{ $product->id }}</th>--}}
{{--                <td>{{ $product->title }}</td>--}}
{{--                <td>{{ $product->description }}</td>--}}
{{--                <td>{{ $product->price }}</td>--}}
{{--                <td><img src="{{ asset('storage/' . $product->img) }}" alt="album image"></td>--}}
{{--                <td>--}}
{{--                    <form action="{{ route('index') }}" method="post">--}}
{{--                        @csrf--}}
{{--                        <input type="hidden" name="id" value="{{ $product->id }}">--}}
{{--                        <button type="submit" class="btn btn-primary">{{ __('labels.Add to cart') }}</button>--}}
{{--                    </form>--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
        </tbody>
    </table>

    @section('scripts')
        <script>
            $(document).ready(function () {
                fetchProducts();

                function fetchProducts() {
                    $('tbody').html('');
                    $.ajax({
                        type: 'get',
                        url: '/fetch-products',
                        dataType: 'json',
                        success: function (response) {
                            $.each(response.products, function (key, item) {
                               $('tbody').append(
                                   `<tr>
                                       <th scope="row">` + item.id + `</th>
                                       <th scope="row">` + item.title + `</th>
                                       <th scope="row">` + item.description + `</th>
                                       <th scope="row">` + item.price + `</th>
                                       <td>
                                           <button type="submit" value="` + item.id + `" class="btn btn-primary add-to-cart">{{ __('labels.Add to cart') }}</button>
                                       </td>
                                   </tr>`
                               )
                            });
                        }
                    });
                }

                $(document).on('click', '.add-to-cart', function (e) {
                    e.preventDefault();

                    var productId = $(this).val();

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: 'post',
                        url: '/add-to-cart/' + productId,
                        success: function(response) {
                            fetchProducts();
                        }
                    });
                });
            });
        </script>
    @endsection
</x-layout>

