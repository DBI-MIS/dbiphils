<div class="w-full md:w-2/3 mx-auto">
  
    @if ($show)
    <div>
       
        <livewire:create-main-response />
        
    </div>
    <div class="text-right">
        <button wire:click="closeModal"
        class="mt-3 inline-flex items-center justify-center h-10 px-4 font-medium tracking-wide text-white transition duration-200 bg-red-600 rounded-lg hover:bg-red-800 focus:shadow-outline focus:outline-none">
        Close
    </button>
    </div>
    
    @endif
</div>
