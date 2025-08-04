<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-3 sm:space-y-0">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    Edit Resource
                </h2>
                <p class="text-sm text-gray-600 mt-1">Update your study resource</p>
            </div>
            <a href="{{ route('dashboard.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg font-medium text-sm text-gray-700 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Dashboard
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6">
                    <form action="{{ route('resources.update', $resource) }}" method="POST"
                        enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Title -->
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                Resource Title *
                            </label>
                            <input type="text" id="title" name="title" value="{{ old('title', $resource->title) }}"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('title') border-red-300 @enderror"
                                placeholder="Enter a descriptive title for your resource" required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Course Name -->
                        <div>
                            <label for="course_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Course Name *
                            </label>
                            <input type="text" id="course_name" name="course_name"
                                value="{{ old('course_name', $resource->course_name) }}"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm @error('course_name') border-red-300 @enderror"
                                placeholder="e.g., Computer Science, Mathematics, Physics" required>
                            @error('course_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                Description *
                            </label>
                            <textarea id="description" name="description" rows="4"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm resize-none @error('description') border-red-300 @enderror"
                                placeholder="Provide a detailed description of your resource, what it covers, and how it can help other students..."
                                required>{{ old('description', $resource->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Current File Info -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Current File
                            </label>
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg border border-gray-200">
                                <div class="flex-shrink-0 mr-3">
                                    @php
                                        $extension = strtolower(pathinfo($resource->file_path, PATHINFO_EXTENSION));
                                    @endphp
                                    @if($extension === 'pdf')
                                        <svg class="w-8 h-8 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    @elseif(in_array($extension, ['ppt', 'pptx']))
                                        <svg class="w-8 h-8 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    @elseif(in_array($extension, ['jpg', 'jpeg', 'png', 'gif']))
                                        <svg class="w-8 h-8 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    @else
                                        <svg class="w-8 h-8 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">{{ basename($resource->file_path) }}
                                    </p>
                                    <p class="text-xs text-gray-500 uppercase">{{ $extension }} file</p>
                                </div>
                                <a href="{{ asset('storage/' . $resource->file_path) }}" target="_blank"
                                    class="inline-flex items-center px-3 py-1 bg-blue-50 text-blue-700 text-xs font-medium rounded hover:bg-blue-100 transition-colors">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                        </path>
                                    </svg>
                                    View
                                </a>
                            </div>
                        </div>

                        <!-- File Upload (Optional for Update) -->
                        <div>
                            <label for="file" class="block text-sm font-medium text-gray-700 mb-2">
                                Replace File (Optional)
                            </label>
                            <div
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition-colors">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="file"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span>Upload a new file</span>
                                            <input id="file" name="file" type="file" class="sr-only"
                                                accept=".pdf,.pptx,.jpg,.jpeg,.png,.gif">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">
                                        PDF, PPTX, PNG, JPG, GIF up to 10MB
                                    </p>
                                </div>
                            </div>
                            @error('file')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-xs text-gray-500">
                                <strong>Note:</strong> Only upload a new file if you want to replace the existing one.
                                Leave empty to keep the current file.
                            </p>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200">
                            <a href="{{ route('dashboard.index') }}"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                Cancel
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-6 py-2 bg-blue-600 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-blue-700 focus:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                Update Resource
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fileInput = document.getElementById('file');
            const fileLabel = fileInput.parentNode;

            fileInput.addEventListener('change', function (e) {
                const file = e.target.files[0];
                if (file) {
                    fileLabel.innerHTML = `<span>Selected: ${file.name}</span>`;
                    fileLabel.classList.add('text-green-600');
                    fileLabel.classList.remove('text-blue-600');
                } else {
                    fileLabel.innerHTML = '<span>Upload a new file</span>';
                    fileLabel.classList.add('text-blue-600');
                    fileLabel.classList.remove('text-green-600');
                }
            });
        });
    </script>
</x-app-layout>