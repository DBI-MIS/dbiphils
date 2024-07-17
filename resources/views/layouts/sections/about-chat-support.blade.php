<div class="flex flex-row gap-4 items-center border-t-2 pt-2 mt-2">
    <div class="w-[48px]">
        <img
        class="w-16 mx-auto" 
        src="/storage/{{ $aboutData['Chat Support']?->img }}" 
        alt="{{ $aboutData['Chat Support']->title }}" >
        {{-- <img class="w-auto h-auto " src="{{ $service->img }}" alt=""> --}}
    </div>
    <div>
        <h1 class="text-2xl font-black">{{$aboutData['Chat Support']->title}}</h1>
    
    <span class="font-light text-base">@markdown($aboutData['Chat Support']->description)</span>

    </div>


    

</div>
