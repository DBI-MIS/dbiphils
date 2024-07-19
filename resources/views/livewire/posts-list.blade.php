<div class=" px-3 lg:px-7 py-6">
    <div class="flex justify-between items-center border-b border-gray-100">
        <div class="text-gray-600">
            @if($search)
                <span class="ml-3">
                Searching <strong>{{ $search }}</strong>
                </span>
            @endif

            @if($this->search || $search)
                <button class="text-gray-500 text-xs mr-3" wire:click="clearFilters">x</button>
            @endif 
        </div>
        <div class="flex items-center space-x-4 font-light ">
            <button class="{{ $sort === 'desc' ? 'text-gray-900 border-b border-gray-700': 'text-gray-500' }} py-4" wire:click="setSort('desc')">Latest</button>
            <button class="{{ $sort === 'asc' ? 'text-gray-900 border-b border-gray-700': 'text-gray-500' }} py-4 " wire:click="setSort('asc')">Oldest</button>
            
        </div>
    </div>
    <div class="py-5 flex flex-col gap-4">
        @if ($this->posts->count() == 0)
        <tr>
            <td colspan="4">No News & Events to display.</td>
        </tr>
        @endif

        @foreach($this->posts as $post)
        <x-posts.post-item :post="$post"/>
        @endforeach
    </div>
    <div class="my-3">
        {{ $this->posts->onEachSide(1)->links() }}
    </div>
    

</div>