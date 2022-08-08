<x-layout>
    <a href="/">
        <button class="btn btn-primary my-3">{{ __('labels.To Index') }}</button>
    </a>

    <a href="/cart">
        <button class="btn btn-primary my-3">{{ __('labels.To Cart') }}</button>
    </a>

    <a href="/orders">
        <button class="btn btn-primary my-3">{{ __('labels.To Orders Page') }}</button>
    </a>

    <a href="/product/add">
        <button class="btn btn-primary my-3">{{ __('labels.Add new product') }}</button>
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
                    <form action="/products" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <button type="submit" class="btn btn-primary">{{ __('labels.Delete product') }}</button>
                    </form>
                    <a href="/product/edit/{{ $product->id }}">
                        <button type="button" class="btn btn-primary my-3">{{ __('labels.Edit') }}</button>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-layout>

