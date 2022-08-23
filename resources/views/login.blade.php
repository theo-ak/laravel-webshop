@guest()
    <div class="page login" id="login">
        <div class="form-group mb-3">
            <label for="email">{{ __('labels.Email') }}</label>
            <input type="text" class="form-control" id="email" name="email" placeholder="{{ __('labels.Enter email') }}"
            >

            <p class="text-danger error email-error small"></p>
        </div>

        <div class="form-group mb-3">
            <label for="password">{{ __('labels.Password') }}</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="{{ __('labels.Enter password') }}"
            >

            <p class="text-danger error password-error small"></p>
        </div>

        <div class="login-footer">
            <button type="submit" class="btn btn-primary login-store">{{ __('labels.Login') }}</button>
        </div>
    </div>
@endguest
