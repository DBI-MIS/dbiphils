<div class="w-full px-0 xl:px-24 py-8 border-t-2">
    <h1 class="text-3xl font-black mb-6">Our Core Values</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 items-start gap-4">
    <div class="flex flex-row items-start gap-1 max-w-md">
        <div class="min-w-10 m-1">
            <img
            class="w-full mx-auto" 
            src="/storage/{{ $aboutData['Customer Focus']->img ?? 'NA' }}" 
            alt="{{ $aboutData['Customer Focus']->title ?? 'NA'}}" >
            {{-- <img class="w-auto h-auto " src="{{ $service->img }}" alt=""> --}}
        </div>
        <div class="block">
            <span class="font-bold text-2xl">@markdown($aboutData['Customer Focus']->title ?? 'NA')</span>
            <span class="font-light text-base">@markdown($aboutData['Customer Focus']->description ?? 'NA')</span>
        </div>
   
    </div>

    <div class="flex flex-row items-start gap-1">
        <div class="min-w-10 m-1">
            <img
            class="w-full mx-auto" 
            src="/storage/{{ $aboutData['Trust and Integrity']->img ?? 'NA'}}" 
            alt="{{ $aboutData['Trust and Integrity']->title ?? 'NA'}}" >
            {{-- <img class="w-auto h-auto " src="{{ $service->img }}" alt=""> --}}
        </div>
        <div class="block">
            <span class="font-bold text-2xl">@markdown($aboutData['Trust and Integrity']->title ?? 'NA')</span>
            <span class="font-light text-base">@markdown($aboutData['Trust and Integrity']->description ?? 'NA')</span>
        </div>
        </div>

        <div class="flex flex-row items-start gap-1">
            <div class="min-w-10 m-1">
                <img
                class="w-full mx-auto" 
                src="/storage/{{ $aboutData['Teamwork']->img ?? 'NA'}}" 
                alt="{{ $aboutData['Teamwork']->title ?? 'NA'}}" >
                {{-- <img class="w-auto h-auto " src="{{ $service->img }}" alt=""> --}}
            </div>
            <div class="block">
                <span class="font-bold text-2xl">@markdown($aboutData['Teamwork']->title ?? 'NA')</span>
                <span class="font-light text-base">@markdown($aboutData['Teamwork']->description ?? 'NA')</span>
            </div>
            </div>

            <div class="flex flex-row items-start gap-1">
                <div class="min-w-10 m-1">
                    <img
                    class="w-full mx-auto" 
                    src="/storage/{{ $aboutData['Adaptability']->img ?? 'NA'}}" 
                    alt="{{ $aboutData['Adaptability']->title ?? 'NA'}}" >
                    {{-- <img class="w-auto h-auto " src="{{ $service->img }}" alt=""> --}}
                </div>
                <div class="block">
                    <span class="font-bold text-2xl">@markdown($aboutData['Adaptability']->title ?? 'NA')</span>
                    <span class="font-light text-base">@markdown($aboutData['Adaptability']->description ?? 'NA')</span>
                </div>
                </div>

                <div class="flex flex-row items-start gap-1">
                    <div class="min-w-10 m-1">
                        <img
                        class="w-full mx-auto" 
                        src="/storage/{{ $aboutData['Responsibility']->img ?? 'NA'}}" 
                        alt="{{ $aboutData['Responsibility']->title ?? 'NA' }}" >
                        {{-- <img class="w-auto h-auto " src="{{ $service->img }}" alt=""> --}}
                    </div>
                    <div class="block">
                        <span class="font-bold text-2xl">@markdown($aboutData['Responsibility']->title ?? 'NA')</span>
                        <span class="font-light text-base">@markdown($aboutData['Responsibility']->description ?? 'NA')</span>
                    </div>
                    </div>

                    <div class="flex flex-row items-start gap-1">
                        <div class="min-w-10 m-1">
                            <img
                            class="w-full mx-auto" 
                            src="/storage/{{ $aboutData['Product Solution Provider']->img ?? 'NA'}}" 
                            alt="{{ $aboutData['Product Solution Provider']->title ?? 'NA'}}" >
                            {{-- <img class="w-auto h-auto " src="{{ $service->img }}" alt=""> --}}
                        </div>
                        <div class="block">
                            <span class="font-bold text-2xl">@markdown($aboutData['Product Solution Provider']->title ?? 'NA')</span>
                            <span class="font-light text-base">@markdown($aboutData['Product Solution Provider']->description ?? 'NA')</span>
                        </div>
                        </div>

                        <div class="flex flex-row items-start gap-1">
                            <div class="min-w-10 m-1">
                                <img
                                class="w-full mx-auto" 
                                src="/storage/{{ $aboutData['Quality Product Leadership']->img ?? 'NA'}}" 
                                alt="{{ $aboutData['Quality Product Leadership']->title ?? 'NA'}}" >
                                {{-- <img class="w-auto h-auto " src="{{ $service->img }}" alt=""> --}}
                            </div>
                            <div class="block">
                                <span class="font-bold text-2xl">@markdown($aboutData['Quality Product Leadership']->title ?? 'NA')</span>
                                <span class="font-light text-base">@markdown($aboutData['Quality Product Leadership']->description ?? 'NA')</span>
                            </div>
                            </div>
    
                        </div>
                        
                          
   


</div>
