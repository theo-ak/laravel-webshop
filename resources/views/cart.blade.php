<div class="page cart" id="cart">
    <table class="table list"></table>

    <a href="#" class="btn btn-primary button">{{ __('labels.To Index') }}</a>

    <!-- The checkout form -->
    <div class="form-group">
        <label for="name">{{ __('labels.Name') }}</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="{{ __('labels.Enter name') }}"
               value="{{ old('name') }}"
        >

        <p class="text-danger name-error small"></p>
    </div>

    <div class="form-group">
        <label for="contact">{{ __('labels.Contact details') }}</label>
        <input type="text" class="form-control" id="contact" name="contact" placeholder="{{ __('labels.Enter contact details') }}"
               value="{{ old('contact') }}"
        >

        <p class="text-danger contact-error small"></p>
    </div>

    <div class="form-group">
        <label for="comments">{{ __('labels.Comments') }}</label>
        <input type="text" class="form-control" id="comments" name="comments" placeholder="{{ __('labels.Enter comments') }}"
               value="{{ $order->comments ?? '' }}">
    </div>

    <button type="submit" class="btn btn-primary checkout">{{ __('labels.Checkout') }}</button>
</div>
