<x-layout>
    <a href="/cart">
        <button class="btn btn-primary my-3">{{ __('labels.To Cart') }}</button>
    </a>

    <a href="/products">
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
        @foreach($products as $product)
            <tr>
                <th scope="row">{{ $product->id }}</th>
                <td>{{ $product->title }}</td>
                <td>{{ $product->description }}</td>
                <td>{{ $product->price }}</td>
                <td><img src="{{ asset('storage/' . $product->img) }}" alt="album image"></td>
                <td>
                    <form action="/" method="post">
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

