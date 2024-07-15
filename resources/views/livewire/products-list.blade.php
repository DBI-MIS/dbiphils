<div class=" px-3 lg:px-7 py-6">
    <div class="flex justify-between items-center border-b border-gray-100">
        <div class="text-gray-600">
            
            @if($this->activeCategory)
                <x-badge wire:navigate href="{{ route('products.list', ['category' => $this->activeCategory->slug])}}"
                :textColor="$this->activeCategory->text_color" :bgColor="$this->activeCategory->bg_color"> 
                {{ $this->activeCategory->title }}
                </x-badge>
            @elseif($search)
                <span class="ml-3">
                Searching <strong>{{ $search }}</strong>
                </span>
            @endif

            @if($this->activeCategory || $search)
                <button class="text-gray-500 text-xs mr-3" wire:click="clearFilters">x</button>
            @endif 
        </div>
        <div class="flex items-center space-x-4 font-light ">
            <button class="{{ $sort === 'desc' ? 'text-gray-900 border-b border-gray-700': 'text-gray-500' }} py-4" wire:click="setSort('desc')">Latest</button>
            <button class="{{ $sort === 'asc' ? 'text-gray-900 border-b border-gray-700': 'text-gray-500' }} py-4 " wire:click="setSort('asc')">Oldest</button>
            
        </div>
    </div>
    
    <div class="py-5 flex flex-col md:grid md:grid-cols lg:grid-cols-2">
        @if ($this->products->count() == 0)
        <tr>
            <td colspan="4">No Products to display.</td>
        </tr>
        @endif

        @foreach($this->products as $product)
        <x-products.product-item :product="$product"/>
        @endforeach
    </div>
    <div class="my-3">
        {{ $this->products->onEachSide(1)->links() }}
    </div>


</div>