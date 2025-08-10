@props(['label' => null, 'error' => null, 'required' => false, 'helpText' => null])

<div {{ $attributes->merge(['class' => 'space-y-2']) }}>
    @if($label)
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    {{ $slot }}

    @if($helpText)
        <p class="text-sm text-gray-500 dark:text-gray-400">
            {{ $helpText }}
        </p>
    @endif

    @if($error)
        <p class="text-sm text-red-600 dark:text-red-400 flex items-center space-x-1">
            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                    clip-rule="evenodd" />
            </svg>
            <span>{{ $error }}</span>
        </p>
    @endif
</div>