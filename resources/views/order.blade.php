<x-layout>
    <a href="{{ route('index') }}">
        <button class="btn btn-primary my-3">{{ __('labels.To Index') }}</button>
    </a>

    <a href="{{ route('cart.index') }}">
        <button class="btn btn-primary my-3">{{ __('labels.To Cart') }}</button>
    </a>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{ __('labels.Name') }}</th>
            <th scope="col">{{ __('labels.Contact') }}</th>
            <th scope="col">{{ __('labels.Comments') }}</th>
            <th scope="col">{{ __('labels.Products') }}</th>
            <th scope="col">{{ __('labels.Total') }}</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">{{ $order->id }}</th>
            <td>{{ $order->name }}</td>
            <td>{{ $order->contact }}</td>
            <td>{{ $order->comments }}</td>
            <td>
                @foreach ($order->products as $product)
                    <p>
                        @if (!$product->trashed())
                            <a href="{{ route('product.edit', ['product' => $product->id]) }}">{{ $product->title }}</a> - {{ $product->pivot->product_price }}
                        @else
                            {{ $product->title }}
                        @endif
                    </p>
                @endforeach
            </td>
            <td>{{ $order->products->sum('price') }}</td>
        </tr>
        </tbody>
</x-layout>

