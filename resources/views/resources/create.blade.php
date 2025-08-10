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
                <x-form-group label="Upload File" required="true" :error="$errors->first('file')"
                    helpText="Upload your study resource. Supported formats: PDF, PPTX, PNG, JPG, GIF (max 10MB)">
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
                                    <span>Upload a file</span>
                                    <input id="file" name="file" type="file" class="sr-only"
                                        accept=".pdf,.pptx,.ppt,.jpg,.jpeg,.png,.gif,.doc,.docx" required>
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                PDF, PPTX, DOC, PNG, JPG, GIF up to 10MB
                            </p>
                        </div>
                    </div>

                    <!-- File Preview -->
                    <div id="file-preview"
                        class="hidden mt-3 p-3 bg-gray-50 dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 mr-3">
                                <div id="file-icon" class="w-8 h-8"></div>
                            </div>
                            <div class="flex-1">
                                <p id="file-name" class="text-sm font-medium text-gray-900 dark:text-white"></p>
                                <p id="file-size" class="text-xs text-gray-500 dark:text-gray-400"></p>
                            </div>
                            <button type="button" id="remove-file"
                                class="text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
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

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const fileInput = document.getElementById('file');
                const filePreview = document.getElementById('file-preview');
                const fileName = document.getElementById('file-name');
                const fileSize = document.getElementById('file-size');
                const fileIcon = document.getElementById('file-icon');
                const removeFileBtn = document.getElementById('remove-file');
                const fileLabel = fileInput.parentNode;

                function formatFileSize(bytes) {
                    if (bytes === 0) return '0 Bytes';
                    const k = 1024;
                    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                    const i = Math.floor(Math.log(bytes) / Math.log(k));
                    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
                }

                function getFileIcon(extension) {
                    const iconClasses = 'w-8 h-8';
                    switch (extension.toLowerCase()) {
                        case 'pdf':
                            return `<svg class="${iconClasses} text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>`;
                        case 'ppt':
                        case 'pptx':
                            return `<svg class="${iconClasses} text-orange-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>`;
                        case 'doc':
                        case 'docx':
                            return `<svg class="${iconClasses} text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>`;
                        case 'jpg':
                        case 'jpeg':
                        case 'png':
                        case 'gif':
                            return `<svg class="${iconClasses} text-green-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path></svg>`;
                        default:
                            return `<svg class="${iconClasses} text-gray-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path></svg>`;
                    }
                }

                fileInput.addEventListener('change', function (e) {
                    const file = e.target.files[0];
                    if (file) {
                        const extension = file.name.split('.').pop();

                        fileName.textContent = file.name;
                        fileSize.textContent = formatFileSize(file.size);
                        fileIcon.innerHTML = getFileIcon(extension);

                        filePreview.classList.remove('hidden');

                        // Update the label text
                        fileLabel.innerHTML = `<span class="text-green-600 dark:text-green-400">File selected: ${file.name}</span>`;
                    } else {
                        filePreview.classList.add('hidden');
                        fileLabel.innerHTML = '<span>Upload a file</span>';
                    }
                });

                removeFileBtn.addEventListener('click', function () {
                    fileInput.value = '';
                    filePreview.classList.add('hidden');
                    fileLabel.innerHTML = '<span>Upload a file</span>';
                    fileLabel.classList.remove('text-green-600', 'dark:text-green-400');
                    fileLabel.classList.add('text-blue-600', 'dark:text-blue-400');
                });

                // Drag and drop functionality
                const dropZone = fileInput.parentNode.parentNode.parentNode;

                ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                    dropZone.addEventListener(eventName, preventDefaults, false);
                });

                function preventDefaults(e) {
                    e.preventDefault();
                    e.stopPropagation();
                }

                ['dragenter', 'dragover'].forEach(eventName => {
                    dropZone.addEventListener(eventName, highlight, false);
                });

                ['dragleave', 'drop'].forEach(eventName => {
                    dropZone.addEventListener(eventName, unhighlight, false);
                });

                function highlight(e) {
                    dropZone.classList.add('border-blue-500', 'dark:border-blue-400');
                }

                function unhighlight(e) {
                    dropZone.classList.remove('border-blue-500', 'dark:border-blue-400');
                }

                dropZone.addEventListener('drop', handleDrop, false);

                function handleDrop(e) {
                    const dt = e.dataTransfer;
                    const files = dt.files;

                    if (files.length > 0) {
                        fileInput.files = files;
                        fileInput.dispatchEvent(new Event('change'));
                    }
                }
            });
        </script>
    @endpush
</x-app-layout>