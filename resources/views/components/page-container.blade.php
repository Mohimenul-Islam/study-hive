@props([
    'title' => null,
    'description' => null,
    'centered' => false,
    'maxWidth' => '7xl'
])

<div class="py-8 sm:py-12">
    <div class="max-w-{{ $maxWidth }} mx-auto px-4 sm:px-6 lg:px-8{{ $centered ? ' text-center' : '' }}">
        @if($title || $description)
            <div class="mb-8{{ $centered ? ' text-center' : '' }}">
                @if($title)
                    <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                        {{ $title }}
                    </h1>
                @endif
                
                @if($description)
                    <p class="text-lg text-gray-600 dark:text-gray-400 max-w-3xl{{ $centered ? ' mx-auto' : '' }}">
                        {{ $description }}
                    </p>
                @endif
            </div>
        @endif
        
        {{ $slot }}
    </div>
</div>
