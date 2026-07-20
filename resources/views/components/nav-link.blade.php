@props(['active' => false, 'href' => '#'])

@php
$classes = ($active ?? false)
    ? 'flex items-center px-3 py-2.5 text-sm font-semibold text-emerald-700 bg-emerald-50 rounded-lg transition-colors'
    : 'flex items-center px-3 py-2.5 text-sm font-medium text-gray-600 hover:text-emerald-700 hover:bg-gray-50 rounded-lg transition-colors';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
