@props([
    'target'
])

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target={{ $target }}>
    {{ $slot }}
</button>

