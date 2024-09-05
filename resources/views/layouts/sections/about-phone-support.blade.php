<div class="flex flex-row gap-4 items-center border-t-2 pt-2 mt-2">
    <div class="w-[48px]">
        <img
        class="w-16 mx-auto" 
        src="/storage/{{ $aboutData['Customer Support']?->img }}" 
        alt="{{ $aboutData['Customer Support']->title }}" >
        {{-- <img class="w-auto h-auto " src="{{ $service->img }}" alt=""> --}}
    </div>
    <div class="">
        <h3 class="text-2xl font-black">{{$aboutData['Customer Support']->title}}</h3>
    
    <span class="font-light text-base">@markdown($aboutData['Customer Support']->description)</span>

    </div>

    

</div>
