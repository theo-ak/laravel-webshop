<x-layout>
    <a href="/products">
        <button class="btn btn-primary my-3">{{ __('labels.To Products Page') }}</button>
    </a>

    <form method="post" action="/{{ $request->path() }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">{{ __('labels.Title') }}</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="{{ __('labels.Enter title') }}"
                   value="{{ $product->title ?? '' }}">

            @error('title')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">{{ __('labels.Description') }}</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="{{ __('labels.Enter description') }}"
            >{{ $product->description ?? '' }}</textarea>

            @error('description')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">{{ __('labels.Price') }}</label>
            <input type="number" step=".01" class="form-control" id="price" name="price" placeholder="{{ __('labels.Enter price') }}"
                   value="{{ $product->price ?? ''}}">

            @error('price')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="img">{{ __('labels.Upload an image') }}:</label>
            <input type="file" class="form-control-file" id="img" name="img">

            @if(isset($product->img))
                <p>Current image:</p>
                <img src="{{ asset('storage/' . $product->img) }}" alt="product image">
            @endif

            @error('img')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <input type="hidden" name="id" value="{{ $product->id ?? ''}}">

        <button type="submit" class="btn btn-primary">{{ __('labels.Submit') }}</button>
    </form>
</x-layout>

