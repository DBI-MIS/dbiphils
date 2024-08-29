<x-filament-widgets::widget>
    <x-filament::section>
        <div class="w-full flex min-h-[100px] items-center justify-between px-10 py-4">
            <h1 class="text-xl font-medium">Hi there <span class="capitalize">{{ $user->name }}</span>! </h1>
            <span class="font-medium text-xl">{{ $currentTime->format('l - M d, Y') }}</span>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
