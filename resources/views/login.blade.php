<x-layout>
    <form method="post" action="/login" class="text-white">
        @csrf

        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{ old('email') }}">

            @error('email')
            <p>{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</x-layout>
