<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div 
        x-data="{
        
        textContent: $wire.{{ $applyStateBindingModifiers("\$entangle('{$getStatePath('title')}')") }},
        textColor: $wire.{{ $applyStateBindingModifiers("\$entangle('{$getStatePath('text_color')}')") }},
        bgColor: $wire.{{ $applyStateBindingModifiers("\$entangle('{$getStatePath('bg_color')}')") }},
            {{-- textContent: $wire.$entangle('{{ $getStatePath('title') }}'),
            textColor: $wire.$entangle('{{ $getStatePath('text_color') }}'), 
            bgColor: $wire.$entangle('{{ $getStatePath('bg_color') }}'), --}}
            {{-- textColors: {
                'white': '#FFFFFF',
                'blue': '#0000FF',
                'red': '#FF0000',
                'yellow': '#FFFF00',
                'green': '#008000'
            },
            bgColors: {
                'white': '#FFFFFF',
                'blue': '#36c',
                'red': '#FF0000',
                'yellow': '#FFFF00',
                'green': '#008000',
                'gray': '#D3D3D3'
            } --}}
        }"
        class="flex justify-center px-4 py-16 "
        {{-- :style="{ backgroundColor: bgColor }" --}}
    >
        <div class="w-full text-center py-4 "
            :style="{ color: textColor, backgroundColor: bgColor }"
        >
            <p><span x-model="textContent"></span></p>
            {{-- <div>
                {{ $getRecord()->name ?? null }}
            </div> --}}
        </div>
    </div>
</x-dynamic-component>
