<div {{ $attributes->merge(['class' => 'modal fade' ]) }} id="productEditModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productModalLabel">{{ __('labels.Edit product') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label for="title">{{ __('labels.Title') }}</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="{{ __('labels.Enter title') }}"
                    >

                    <p class="text-danger title-error small"></p>
                </div>

                <div class="form-group mb-3">
                    <label for="description">{{ __('labels.Description') }}</label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="{{ __('labels.Enter description') }}"
                    >

                    <p class="text-danger description-error small"></p>
                </div>

                <div class="form-group mb-3">
                    <label for="price">{{ __('labels.Price') }}</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="{{ __('labels.Enter price') }}"
                    >

                    <p class="text-danger price-error small"></p>
                </div>

                <input type="hidden" name="id" id="id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('labels.Close') }}</button>
                <button type="submit" class="btn btn-primary update-product">{{ __('labels.Edit') }}</button>
            </div>
        </div>
    </div>
</div>
