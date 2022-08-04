<x-layout>
    <a href="/products">
        <button class="btn btn-primary my-3">To Products Page</button>
    </a>

    <form method="post" action="/{{ $request->path() }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title" class="text-light">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title"
                   value="{{ $product->title }}">

            @error('title')
            <p class="text-white">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="description" class="text-light">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter description"
            >{{ $product->description }}</textarea>

            @error('description')
            <p class="text-white">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="price" class="text-light">Price</label>
            <input type="number" step=".01" class="form-control" id="price" name="price" placeholder="Enter price"
                   value="{{ $product->price }}">

            @error('price')
            <p class="text-white">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="img" class="text-light">Upload an image:</label>
            <input type="file" class="form-control-file" id="img" name="img">
        </div>

        <input type="hidden" name="id" value="{{ $product->id }}">

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</x-layout>

