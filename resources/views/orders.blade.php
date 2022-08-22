<x-layout>
    <a href="{{ route('index.index') }}">
        <button class="btn btn-primary my-3">{{ __('labels.To Index') }}</button>
    </a>

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
            <th scope="col">{{ __('labels.Name') }}</th>
            <th scope="col">{{ __('labels.Contact') }}</th>
            <th scope="col">{{ __('labels.Comments') }}</th>
            <th scope="col">{{ __('labels.Total') }}</th>
            <th scope="col">{{ __('labels.Actions') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($orders as $order)
            <tr>
                <th scope="row">{{ $order->id }}</th>
                <td>{{ $order->name }}</td>
                <td>{{ $order->contact }}</td>
                <td>{{ $order->comments }}</td>
                <td>{{ $order->total }}</td>
                <td>
                    <a href="{{ route('orders.show', $order->id) }}">
                        <button type="button" class="btn btn-primary my-3">{{ __('labels.View order') }}</button>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
</x-layout>

