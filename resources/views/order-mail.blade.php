<p>{{ __('labels.Customer Name') }}: {{ $order->name }}</p>
<p>{{ __('labels.Contact details') }}: {{ $order->contact }}</p>
<p>{{ __('labels.Comments') }}: {{ $order->comments }}</p>
<p>{{ __('labels.Items ordered') }}</p>
<ul>
    @foreach($order->products as $product)
        <li>{{ $product->title }}</li>
    @endforeach
</ul>
<p>{{ __('labels.Total') }}: {{ $order->products->sum('price') }}</p>
