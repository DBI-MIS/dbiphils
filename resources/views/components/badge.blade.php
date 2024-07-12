@props (['textColor','bgColor'])

@php
    $textColor = match ($textColor) {
        'gray' => 'text-gray-500',
        'blue' => 'text-blue-500',
        'red' => 'text-red-500',
        'yellow' => 'text-yellow-500',
        'green' => 'text-green-500',
        'white' => 'text-white',
        default => 'text-gray-500',
    };

    $bgColor = match ($bgColor) {
        'gray' => 'bg-gray-500',
        'blue' => 'bg-blue-500',
        'red' => 'bg-red-500',
        'yellow' => 'bg-yellow-500',
        'green' => 'bg-green-500',
        default => 'bg-blue-500',
    };
    
@endphp
<button {{ $attributes }} class=" {{$textColor}} {{$bgColor}} rounded-md px-1 text-[10px]">
            {{ $slot }}</button>