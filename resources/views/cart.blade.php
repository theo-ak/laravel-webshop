<x-layout>
    <a href="/">
        <button class="btn btn-primary my-3">{{ __('labels.To Index') }}</button>
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
            <label for="name">{{ __('labels.Name') }}</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('labels.Enter name') }}"
                   value="{{ old('name') }}">

            @error('name')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="contact">{{ __('labels.Contact details') }}</label>
            <input type="text" class="form-control" id="contact" name="contact" placeholder="{{ __('labels.Enter contact details') }}"
                   value="{{ old('contact') }}">

            @error('contact')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="comments">{{ __('labels.Comments') }}</label>
            <input type="text" class="form-control" id="comments" name="comments" placeholder="{{ __('labels.Enter comments') }}"
                   value="{{ $order->comments ?? '' }}">
        </div>

        <button type="submit" class="btn btn-primary">{{ __('labels.Checkout') }}</button>
    </form>

</x-layout>

