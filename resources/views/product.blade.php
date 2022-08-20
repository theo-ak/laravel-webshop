<div class="form-group mb-3">
    <label for="title">{{ __('labels.Title') }}</label>
    <input type="text" class="form-control" id="title" name="title" placeholder="{{ __('labels.Enter title') }}"
    >

    <p class="text-danger error title-error small"></p>
</div>

<div class="form-group mb-3">
    <label for="description">{{ __('labels.Description') }}</label>
    <input type="text" class="form-control" id="description" name="description" placeholder="{{ __('labels.Enter description') }}"
    >

    <p class="text-danger error description-error small"></p>
</div>

<div class="form-group mb-3">
    <label for="price">{{ __('labels.Price') }}</label>
    <input type="number" class="form-control" id="price" name="price" placeholder="{{ __('labels.Enter price') }}"
    >

    <p class="text-danger error price-error small"></p>
</div>

<input type="hidden" name="id" id="id">

<div class="product-footer">
    <a href="#products">
        <button type="button" class="btn btn-secondary">{{ __('labels.Back') }}</button>
    </a>
    <button type="submit" class="btn btn-primary action-button store-product">{{ __('labels.Add') }}</button>
</div>
