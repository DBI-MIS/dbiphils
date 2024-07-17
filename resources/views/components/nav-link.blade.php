@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-2 py-2 rounded-lg border border-dashed border-bottom border-blue-600 dark:border-blue-500 text-base font-medium leading-5 text-gray-900 dark:text-blue-600 focus:outline-none focus:border-blue-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-2 py-2 text-base font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-blue-600 hover:rounded-lg rounded-xl dark:hover:text-blue-600 hover:bg-gray-200/20 dark:hover:bg-gray-200/20 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
