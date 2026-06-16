@props([
    'lable' => 'lable',
    'name' => 'name',
    'type' => 'text',
    'extra' => '',
])
<div class="space-y-2">
    <label for="{{ $name }}" class="label">{{ $lable }}:</label>    
    <input name="{{ $name }}" id="{{ $name }}" type="{{ $type }}" class="input" {{ $extra }} value="{{ old($name) }}">
    @error($name)
        <p class="error">{{ $message }}</p>
    @enderror
</div>