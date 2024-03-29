<x-layout>
    <a href="{{ route('cart.index') }}">
        <button class="btn btn-primary my-3">{{ __('labels.To Cart') }}</button>
    </a>

    @auth()
        <a href="{{ route('products.index') }}">
            <button class="btn btn-primary my-3">{{ __('labels.Admin page') }}</button>
        </a>
    @endauth

    @guest()
        <a href="{{ route('login') }}">
            <button class="btn btn-primary my-3">{{ __('labels.Login') }}</button>
        </a>
    @endguest

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
        @foreach ($products as $product)
            <tr>
                <th scope="row">{{ $product->id }}</th>
                <td>{{ $product->title }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }}</td>
                <td><img src="{{ asset('storage/' . $product->img) }}" alt="{{ __('labels.album image') }}"></td>
                <td>
                    <form action="{{ route('cart.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <button type="submit" class="btn btn-primary">{{ __('labels.Add to cart') }}</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-layout>

