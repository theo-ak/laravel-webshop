<x-layout>
    <a href="/cart">
        <button class="btn btn-primary my-3">To Cart</button>
    </a>

    <a href="/products">
        <button class="btn btn-primary my-3">To Products Page</button>
    </a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Price</th>
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
                <td><img src="{{ asset("img/$product->img") }}" alt="album image"></td>
                <td>
                    <form action="/" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <button type="submit" class="btn btn-primary">Add to cart</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
</x-layout>

