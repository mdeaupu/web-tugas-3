@props(['type' => 'submit', 'variant' => 'primary'])

@php
    $classes = [
        'primary' => 'bg-indigo-600 hover:bg-indigo-700 text-white',
        'secondary' => 'bg-gray-500 hover:bg-gray-600 text-white',
        'danger' => 'bg-red-600 hover:bg-red-700 text-white',
    ][$variant];
@endphp

<button type="{{ $type }}"
    class="px-4 py-2 rounded-md text-sm font-medium {{ $classes }} focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
    {{ $slot }}
</button>