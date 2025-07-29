<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <a href="{{ route('resources.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Upload Resource
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>

            @if (session('status'))
                <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('status') }}</span>
                </div>
            @endif

            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
    @forelse ($resources as $resource)
        <div class="p-6 flex space-x-4">
            <div class="flex-1">
                <div class="flex justify-between items-center">
                    <div>
                        <span class="text-gray-800 font-bold">{{ $resource->user->name }}</span>
                        <small class="ml-2 text-sm text-gray-600">{{ $resource->created_at->format('j M Y, g:i a') }}</small>
                    </div>
                </div>
                <p class="mt-4 text-lg text-gray-900 font-bold">{{ $resource->title }}</p>
                <p class="text-sm text-gray-700">Course: {{ $resource->course_code }}</p>
                <p class="mt-2 text-gray-800">{{ $resource->description }}</p>

                @if(in_array(pathinfo($resource->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                    <div class="mt-4">
                        <img src="{{ asset('storage/' . $resource->file_path) }}" alt="{{ $resource->title }}" class="rounded-lg max-w-sm">
                    </div>
                @endif
                </div>
        </div>
    @empty
        <div class="p-6">
            <p>No resources uploaded yet.</p>
        </div>
    @endforelse
</div>
        </div>
    </div>
</x-app-layout>