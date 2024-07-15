@props(['product'])
<div class="w-full  py-2 px-2 mb-5 rounded-xl border border-opacity-10 p-2 shadow-lg bg-white hover:bg-gray-100 border-blue-800">
    <div class="grid grid-cols-2 md:flex md:flex-col gap-x-5 text-balance" wire:navigate href="{{ route('products.show', $product->slug) }}">
        
        <div class="col-span-1 mx-auto">
            @if ($product->product_img === null)
            <tr>
                <td><img src="{{asset('/Product_Default.png')}}" alt="Product Image" class="w-auto h-auto max-h-[120px] max-w-[180px]"></td>
            </tr>
            @endif
            <img class="w-auto h-auto max-h-[120px] max-w-[180px]" src="/storage/{{ $product->product_img }}" alt="">
        </div>
        <div class="col-span-1 w-full flex flex-col p-2">
            
		<span class="font-bold text-lg">
        <a wire:navigate href="{{ route('products.show', $product->slug) }}">{{ $product->title}}</a>
        </span>
        <span class="font-light text-sm">{{ $product->product_brand?->name}}</span>

        <div class="topics flex flex-wrap justify-start gap-1 my-auto">
            @if ($category = $product->product_categories()->first())
            <x-badge wire:navigate href="{{ route('products.list', ['category' => $category->slug])}}"
            :textColor="$category->text_color" :bgColor="$category->bg_color">
            
            {{ $category->title }}
            
            </x-badge>
            @endif
        
        </div>
        </div>
       
        
    
    </div>

</div>