@props([
    'name' => 'required'
])

@error($name)
    <p class="text-error text-xs mt-1">{{ $message }}</p>
@enderror