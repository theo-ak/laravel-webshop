<x-layout>
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
                    <form action="/" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </td>
            </tr>
        </tbody>
    @endforeach
</x-layout>

