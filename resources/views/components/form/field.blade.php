@props([
    'lable' => false,
    'name' => 'name',
    'type' => 'text',
    'placeholder' => 'placeholder',
    'extra' => '',
])
<div class="space-y-2">
    @if ($lable)
        <label for="{{ $name }}" class="label">{{ $lable }}:</label>    
    @endif

    @if ($type === 'textarea')
        <textarea
            name="{{ $name }}" 
            id="{{ $name }}" 
            type="{{ $type }}" 
            placeholder="{{ $placeholder }}" 
            class="textarea" 
            {{ $extra }} 
        >{{ old($name) }}</textarea>
    @else
        <input 
            name="{{ $name }}" 
            id="{{ $name }}" 
            type="{{ $type }}" 
            placeholder="{{ $placeholder }}" 
            class="input" 
            value="{{ old($name) }}"
            {{ $extra }} 
        >
    @endif
    
    <x-form.error name="{{ $name }}" />
</div>