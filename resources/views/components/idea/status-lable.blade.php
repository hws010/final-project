@props(['status' => 'pending'])

@php
    $classes = 'inline-block rounded-full border px-2 py-1 text-xs font-medium';


    switch ($status) {
        case 'pending':
                $classes .= 'bg-yellow-500/10 text-yellow-500 border-yellow-500/20';
            break;
        
        case 'in_progress':
                $classes .= 'bg-blue-500/10 text-blue-500 border-blue-500/20';
            break;

        case 'completed':
                $classes .= 'bg-green-500/10 text-green-500 border-green-500/20';
            break;
    }
@endphp

<span class="{{ $classes }}">
    {{ $slot }}
</span>