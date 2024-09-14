<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()">
    <div class="flex items-center space-x-4">
        @foreach ($getOptions() as $color => $label)
            <button type="button" 
            class="rounded-lg px-3 py-2 text-[12px] text-left min-w-min text-pretty w-max {{ $color }} ">
                Sample Text
            </button>
        @endforeach
    </div>
</x-dynamic-component>
