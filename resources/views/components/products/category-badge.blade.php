@props(['category'])
<x-badge wire:navigate href="{{ route('products.list', ['category' => $category->slug])}}"
    :textColor="$category->text_color" :bgColor="$category->bg_color"> 
    {{ $category->title }}
</x-badge>