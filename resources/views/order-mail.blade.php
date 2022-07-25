<p>Customer Name: {{ $order->name }}</p>
<p>Contact details: {{ $order->contact }}</p>
<p>Contact details: {{ $order->comments }}</p>
<p>Items ordered:</p>
<ul>
    @foreach($order->products as $product)
        <li>{{ $product->title }}</li>
    @endforeach
</ul>
<p>Total: {{ $order->products->sum('price') }}</p>
