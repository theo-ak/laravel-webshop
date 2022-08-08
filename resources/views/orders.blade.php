<x-layout>
    <a href="/">
        <button class="btn btn-primary my-3">To Index</button>
    </a>

    <a href="/cart">
        <button class="btn btn-primary my-3">To Cart</button>
    </a>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Contact</th>
            <th scope="col">Comments</th>
            <th scope="col">Total</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <th scope="row">{{ $order->id }}</th>
                <td>{{ $order->name }}</td>
                <td>{{ $order->contact }}</td>
                <td>{{ $order->comments }}</td>
                <td>{{ $order->products->sum('price') }}</td>
                <td>
                    <a href="/order/{{ $order->id }}">
                        <button type="button" class="btn btn-primary my-3">View Order</button>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
</x-layout>

