<div class="flex flex-row gap-4 items-center">
    <div class="w-[48px]">
        <img
        class="w-16 mx-auto" 
        src="/storage/{{ $aboutChatSupport->img }}" 
        alt="{{ $aboutChatSupport->title }}" >
        {{-- <img class="w-auto h-auto " src="{{ $service->img }}" alt=""> --}}
    </div>
    <div>
        <h1 class="text-2xl font-black">{{$aboutChatSupport->title}}</h1>
    
    <span class="font-light text-base">@markdown($aboutChatSupport->description)</span>

    </div>

    

</div>
