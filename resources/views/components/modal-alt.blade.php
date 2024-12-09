@props([
    'name',
    'open' => false,
    'maxWidth' => 'xl'
])

@php
$maxWidth = [
    'sm' => 'sm:max-w-sm',
    'md' => 'sm:max-w-md',
    'lg' => 'sm:max-w-lg',
    'xl' => 'sm:max-w-xl',
    '2xl' => 'sm:max-w-2xl',
][$maxWidth];
@endphp

<div
    x-data="{
        open: false,
        objectId: null
    }"
    x-show="open"
    @keydown.escape.window="open = false"
    @open-modal-{{ $name }}.window="
        objectId = $event.detail.id;
        open = true
    "
    class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900 bg-opacity-50"
    style="display: none;"
>
    <div
        x-show="open"
        class="fixed inset-0 transform transition-all"
        x-on:click="open = false"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>

    <div
        x-show="open"
        class="mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full {{ $maxWidth }} sm:mx-auto"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    >
        <div class="max-h-[90vh] overflow-y-auto">
            {{ $slot }}
        </div>
    </div>
</div>
