<x-layout>
    <form method="post" action="/login">
        @csrf

        <div class="form-group">
            <label for="email">{{ __('labels.Email address') }}</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="{{ __('labels.Enter email') }}" value="{{ old('email') }}">

            @error('email')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">{{ __('labels.Password') }}</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="{{ __('labels.Password') }}">
        </div>
        <button type="submit" class="btn btn-primary">{{ __('labels.Login') }}</button>
    </form>
</x-layout>
