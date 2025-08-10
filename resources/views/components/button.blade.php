@props([
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
    'type' => 'button'
])

@php
$baseClasses = 'inline-flex items-center justify-center font-medium transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';

$variants = [
    'primary' => 'bg-blue-600 text-white shadow-sm hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:ring-blue-500',
    'secondary' => 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:bg-gray-50 dark:focus:bg-gray-700 focus:ring-blue-500',
    'danger' => 'bg-red-600 text-white shadow-sm hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:ring-red-500',
    'success' => 'bg-green-600 text-white shadow-sm hover:bg-green-700 focus:bg-green-700 active:bg-green-800 focus:ring-green-500',
    'ghost' => 'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:bg-gray-100 dark:focus:bg-gray-800 focus:ring-blue-500',
];

$sizes = [
    'sm' => 'px-3 py-1.5 text-sm rounded-md',
    'md' => 'px-4 py-2.5 text-sm rounded-lg',
    'lg' => 'px-6 py-3 text-base rounded-lg',
    'xl' => 'px-8 py-4 text-lg rounded-xl',
];

$classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$size] ?? $sizes['md']);
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
