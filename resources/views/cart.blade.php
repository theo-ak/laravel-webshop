<x-layout>
    <a href="{{ route('index.index') }}">
        <button class="btn btn-primary my-3">{{ __('labels.To Index') }}</button>
    </a>

    @auth()
        <a href="{{ route('products.index') }}">
            <button class="btn btn-primary my-3">{{ __('labels.Admin page') }}</button>
        </a>
    @endauth

    @guest()
        <a href="{{ route('login.create') }}">
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
                    <form action="{{ route('cart.destroy', $product->id) }}" method="post">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-primary">{{ __('labels.Remove') }}</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @error ('cart')
    <p>{{ $message }}</p>
    @enderror

    <form action="{{ route('orders.store') }}" method="post">
        @csrf

        <div class="form-group">
            <label for="name">{{ __('labels.Name') }}</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('labels.Enter name') }}"
                   value="{{ old('name') }}">

            @error ('name')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="contact">{{ __('labels.Contact details') }}</label>
            <input type="text" class="form-control" id="contact" name="contact" placeholder="{{ __('labels.Enter contact details') }}"
                   value="{{ old('contact') }}">

            @error ('contact')
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

