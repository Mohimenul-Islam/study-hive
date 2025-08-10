@props([
    'hover' => false,
    'padding' => 'p-6'
])

@php
    $classes = 'bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700';
    if ($hover) {
        $classes .= ' hover:shadow-md transition-shadow duration-200';
    }
    $classes .= ' ' . $padding;
@endphp

<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>
