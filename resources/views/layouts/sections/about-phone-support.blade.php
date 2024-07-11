<div class="flex flex-row gap-4 items-center">
    <div class="w-[48px]">
        <img
        class="w-16 mx-auto" 
        src="/storage/{{ $aboutPhoneSupport->img }}" 
        alt="{{ $aboutPhoneSupport->title }}" >
        {{-- <img class="w-auto h-auto " src="{{ $service->img }}" alt=""> --}}
    </div>
    <div class="">
        <h1 class="text-2xl font-black">{{$aboutPhoneSupport->title}}</h1>
    
    <span class="font-light text-base">@markdown($aboutPhoneSupport->description)</span>

    </div>

    

</div>
