<x-app-layout>
    <x-slot name="title">Edit Resource - StudyHive</x-slot>
    <x-slot name="metaDescription">Update your study resource to share better content with the StudyHive
        community.</x-slot>

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    Edit Resource
                </h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">
                    Update your study resource
                </p>
            </div>
            <x-button href="{{ route('dashboard.index') }}" variant="secondary">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Dashboard
            </x-button>
        </div>
    </x-slot>

    <x-page-container maxWidth="2xl">
        <x-card>
            <form action="{{ route('resources.update', $resource) }}" method="POST" enctype="multipart/form-data"
                class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Title -->
                <x-form-group label="Resource Title" required="true" :error="$errors->first('title')"
                    helpText="Enter a clear, descriptive title that summarizes your resource">
                    <x-text-input id="title" name="title" type="text" :value="old('title', $resource->title)"
                        placeholder="Enter a descriptive title for your resource" required
                        class="@error('title') border-red-300 dark:border-red-600 @enderror" />
                </x-form-group>

                <!-- Course Name -->
                <x-form-group label="Course Name" required="true" :error="$errors->first('course_name')"
                    helpText="Specify the course or subject this resource belongs to">
                    <x-text-input id="course_name" name="course_name" type="text" :value="old('course_name', $resource->course_name)" placeholder="e.g., Computer Science, Mathematics, Physics" required
                        class="@error('course_name') border-red-300 dark:border-red-600 @enderror" />
                </x-form-group>

                <!-- Description -->
                <x-form-group label="Description" required="true" :error="$errors->first('description')"
                    helpText="Provide a detailed description of your resource, what it covers, and how it can help other students">
                    <textarea id="description" name="description" rows="4"
                        class="block w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:border-blue-500 dark:focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all duration-200 resize-none @error('description') border-red-300 dark:border-red-600 @enderror"
                        placeholder="Provide a detailed description of your resource, what it covers, and how it can help other students..."
                        required>{{ old('description', $resource->description) }}</textarea>
                </x-form-group>

                <!-- Current File Info -->
                <x-form-group label="Current File">
                    <div
                        class="flex items-center p-3 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
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
                            @elseif(in_array($extension, ['doc', 'docx']))
                                <svg class="w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
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
                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                {{ basename($resource->file_path) }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 uppercase">{{ $extension }} file</p>
                        </div>
                        <a href="{{ asset('storage/' . $resource->file_path) }}" target="_blank"
                            class="inline-flex items-center px-3 py-1.5 bg-blue-50 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 text-xs font-medium rounded-md hover:bg-blue-100 dark:hover:bg-blue-900/50 transition-colors">
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
                </x-form-group>

                <!-- File Upload (Optional for Update) -->
                <x-form-group label="Replace File (Optional)" :error="$errors->first('file')"
                    helpText="Only upload a new file if you want to replace the existing one. Leave empty to keep the current file.">
                    <div
                        class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg hover:border-gray-400 dark:hover:border-gray-500 transition-colors @error('file') border-red-300 dark:border-red-600 @enderror">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400 dark:text-gray-500" stroke="currentColor"
                                fill="none" viewBox="0 0 48 48">
                                <path
                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                <label for="file"
                                    class="relative cursor-pointer bg-white dark:bg-gray-800 rounded-md font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500 dark:hover:text-blue-300 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500 transition-colors">
                                    <span>Upload a new file</span>
                                    <input id="file" name="file" type="file" class="sr-only"
                                        accept=".pdf,.pptx,.ppt,.jpg,.jpeg,.png,.gif,.doc,.docx">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                PDF, PPTX, DOC, PNG, JPG, GIF up to 10MB
                            </p>
                        </div>
                    </div>
                </x-form-group>

                <!-- Submit Buttons -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <x-button href="{{ route('dashboard.index') }}" variant="secondary" type="button">
                        Cancel
                    </x-button>
                    <x-button type="submit" size="lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Update Resource
                    </x-button>
                </div>
            </form>
        </x-card>
    </x-page-container>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const fileInput = document.getElementById('file');
                const fileLabel = fileInput.parentNode;

                fileInput.addEventListener('change', function (e) {
                    const file = e.target.files[0];
                    if (file) {
                        fileLabel.innerHTML = `<span class="text-green-600 dark:text-green-400">Selected: ${file.name}</span>`;
                    } else {
                        fileLabel.innerHTML = '<span>Upload a new file</span>';
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>