<x-layout>
    <a href="/">
        <button class="btn btn-primary my-3">To Index</button>
    </a>

    <a href="/products">
        <button class="btn btn-primary my-3">To Products Page</button>
    </a>

    <table class="table text-light">
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
                    <form action="/cart" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <button type="submit" class="btn btn-primary">Remove</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @error('cart')
    <p>{{ $message }}</p>
    @enderror

    <form action="/cart/checkout" method="post">
        @csrf

        <div class="form-group">
            <label for="name" class="text-light">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name"
                   value="{{ old('name') }}">

            @error('name')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="contact" class="text-light">Contact details</label>
            <input type="text" class="form-control" id="contact" name="contact" placeholder="Enter contact details"
                   value="{{ old('contact') }}">

            @error('contact')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="comments" class="text-light">Comments</label>
            <input type="text" class="form-control" id="comments" name="comments" placeholder="Enter comments"
                   value="{{ $order->comments ?? '' }}">
        </div>

        <button type="submit" class="btn btn-primary">Checkout</button>
    </form>

</x-layout>

