<x-app-layout>
    <x-slot name="title">Upload New Resource - StudyHive</x-slot>
    <x-slot name="metaDescription">Share your study resources with the StudyHive community. Upload PDFs, presentations,
        and other educational materials.</x-slot>

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    Upload New Resource
                </h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">
                    Share your study materials with the community
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
            <form method="POST" action="{{ route('resources.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Title -->
                <x-form-group label="Resource Title" required="true" :error="$errors->first('title')"
                    helpText="Enter a clear, descriptive title that summarizes your resource">
                    <x-text-input id="title" name="title" type="text" :value="old('title')"
                        placeholder="e.g., Data Structures and Algorithms Study Guide" required autofocus
                        class="@error('title') border-red-300 dark:border-red-600 @enderror" />
                </x-form-group>

                <!-- Course Name -->
                <x-form-group label="Course Name" required="true" :error="$errors->first('course_name')"
                    helpText="Specify the course or subject this resource belongs to">
                    <x-text-input id="course_name" name="course_name" type="text" :value="old('course_name')"
                        placeholder="e.g., Computer Science, Mathematics, Physics" required
                        class="@error('course_name') border-red-300 dark:border-red-600 @enderror" />
                </x-form-group>

                <!-- Description -->
                <x-form-group label="Description" required="true" :error="$errors->first('description')"
                    helpText="Provide a detailed description of your resource, what it covers, and how it can help other students">
                    <textarea id="description" name="description" rows="4"
                        class="block w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:border-blue-500 dark:focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all duration-200 resize-none @error('description') border-red-300 dark:border-red-600 @enderror"
                        placeholder="Describe what your resource covers, key topics, and how it can benefit other students..."
                        required>{{ old('description') }}</textarea>
                </x-form-group>

                <!-- File Upload -->
                <x-form-group label="Upload File" required="false" :error="$errors->first('file')"
                    helpText="Upload your study resource (optional). Supported formats: PDF, PPTX, PNG, JPG, DOC (max 10MB)">
                    <input id="file" name="file" type="file" accept=".pdf,.pptx,.ppt,.jpg,.jpeg,.png,.gif,.doc,.docx"
                        class="block w-full text-sm text-gray-900 dark:text-gray-100 border border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer bg-white dark:bg-gray-800 focus:border-blue-500 dark:focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all duration-200 @error('file') border-red-300 dark:border-red-600 @enderror
                        file:mr-4 file:py-2.5 file:px-4 file:rounded-l-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 dark:file:bg-blue-900/30 dark:file:text-blue-400 hover:file:bg-blue-100 dark:hover:file:bg-blue-900/50 file:cursor-pointer">
                    <p class="mt-2 text-xs text-gray-500 dark:text-gray-400">
                        Supported formats: PDF, PPTX, DOC, PNG, JPG, GIF (max 10MB) - Optional
                    </p>
                </x-form-group>

                <!-- Submit Buttons -->
                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <x-button href="{{ route('dashboard.index') }}" variant="secondary" type="button">
                        Cancel
                    </x-button>
                    <x-button type="submit" size="lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                            </path>
                        </svg>
                        Upload Resource
                    </x-button>
                </div>
            </form>
        </x-card>
    </x-page-container>
</x-app-layout>