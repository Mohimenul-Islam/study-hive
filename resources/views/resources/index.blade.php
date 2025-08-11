<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-3 sm:space-y-0">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    Study Resources
                </h2>
                <p class="text-sm text-gray-600 mt-1">Discover and share educational materials</p>
            </div>
            <a href="{{ route('resources.create') }}"
                class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Upload Resource
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Search and Filter Form -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 sm:p-6 mb-6">
                <form method="GET" action="{{ route('home') }}"
                    class="space-y-4 sm:space-y-0 sm:flex sm:items-end sm:space-x-4">
                    <!-- Search Input -->
                    <div class="flex-1">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2">
                            Search Resources
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" id="search" name="search" value="{{ $currentSearch }}"
                                class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                placeholder="Search by title or description...">
                        </div>
                    </div>

                    <!-- Course Filter Dropdown -->
                    <div class="sm:w-64">
                        <label for="course_name" class="block text-sm font-medium text-gray-700 mb-2">
                            Filter by Course
                        </label>
                        <select id="course_name" name="course_name"
                            class="block w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="">All Courses</option>
                            @foreach ($courseNames as $courseName)
                                <option value="{{ $courseName }}" {{ $currentCourse == $courseName ? 'selected' : '' }}>
                                    {{ $courseName }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex space-x-3 sm:flex-shrink-0">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2.5 bg-blue-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Search
                        </button>
                        @if ($currentSearch || $currentCourse)
                            <a href="{{ route('home') }}"
                                class="inline-flex items-center px-4 py-2.5 bg-gray-100 border border-gray-300 rounded-lg font-medium text-sm text-gray-700 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Clear
                            </a>
                        @endif
                    </div>
                </form>

                <!-- Search Results Info -->
                @if ($currentSearch || $currentCourse)
                    <div class="mt-4 pt-4 border-t border-gray-100">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-600">
                                @if ($currentSearch && $currentCourse)
                                    Showing results for "<strong>{{ $currentSearch }}</strong>" in
                                    <strong>{{ $currentCourse }}</strong>
                                @elseif ($currentSearch)
                                    Showing results for "<strong>{{ $currentSearch }}</strong>"
                                @elseif ($currentCourse)
                                    Showing results for course: <strong>{{ $currentCourse }}</strong>
                                @endif
                                <span class="ml-2 text-gray-500">({{ $resources->total() }}
                                    {{ Str::plural('result', $resources->total()) }})</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            @if (session('status'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4 rounded-r-lg shadow-sm">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-green-800 font-medium">{{ session('status') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="grid gap-4 sm:gap-6">
                @forelse ($resources as $resource)
                    <div
                        class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-200 overflow-hidden">
                        <div class="p-4 sm:p-6">
                            <!-- Header with user info and date -->
                            <div
                                class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 space-y-2 sm:space-y-0">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-medium text-sm">
                                            {{ strtoupper(substr($resource->user->name, 0, 2)) }}
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="text-sm font-medium text-gray-900">{{ $resource->user->name }}</h3>
                                        <p class="text-xs text-gray-500">{{ $resource->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <div class="text-xs sm:text-sm text-gray-500">
                                    {{ $resource->created_at->format('M d, Y') }}
                                </div>
                            </div>

                            <!-- Resource content -->
                            <div class="space-y-3">
                                <!-- Title -->
                                <h2 class="text-lg sm:text-xl font-bold text-gray-900 line-clamp-2">
                                    {{ $resource->title }}
                                </h2>

                                <!-- Course name badge -->
                                <div class="flex items-center justify-between">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                            </path>
                                        </svg>
                                        {{ $resource->course_name }}
                                    </span>

                                    <!-- Vote buttons -->
                                    @auth
                                        <div class="flex items-center space-x-1" data-resource-id="{{ $resource->id }}">
                                            <!-- Upvote button -->
                                            <button type="button"
                                                class="vote-btn upvote-btn flex items-center space-x-1 px-2 py-1 rounded-md text-xs font-medium transition-colors duration-200 {{ $resource->user_vote === 'up' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600 hover:bg-green-50 hover:text-green-600' }}"
                                                data-vote-type="up">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                                                </svg>
                                                <span class="upvotes-count">{{ $resource->upvotes->count() }}</span>
                                            </button>

                                            <!-- Vote score -->
                                            <span class="vote-score px-2 py-1 text-xs font-medium text-gray-700">
                                                {{ $resource->vote_score }}
                                            </span>

                                            <!-- Downvote button -->
                                            <button type="button"
                                                class="vote-btn downvote-btn flex items-center space-x-1 px-2 py-1 rounded-md text-xs font-medium transition-colors duration-200 {{ $resource->user_vote === 'down' ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-600 hover:bg-red-50 hover:text-red-600' }}"
                                                data-vote-type="down">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                                                </svg>
                                                <span class="downvotes-count">{{ $resource->downvotes->count() }}</span>
                                            </button>
                                        </div>
                                    @else
                                        <!-- Show vote counts for guests -->
                                        <div class="flex items-center space-x-1">
                                            <div class="flex items-center space-x-1 px-2 py-1 text-xs text-gray-500">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                                                </svg>
                                                <span>{{ $resource->upvotes->count() }}</span>
                                            </div>
                                            <span class="px-2 py-1 text-xs font-medium text-gray-700">
                                                {{ $resource->vote_score }}
                                            </span>
                                            <div class="flex items-center space-x-1 px-2 py-1 text-xs text-gray-500">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                                                </svg>
                                                <span>{{ $resource->downvotes->count() }}</span>
                                            </div>
                                        </div>
                                    @endauth
                                </div>

                                <!-- Description (truncated) -->
                                <p class="text-gray-700 text-sm sm:text-base line-clamp-3">
                                    {{ Str::limit($resource->description, 150) }}
                                </p>

                                <!-- File preview/info -->
                                <div class="pt-3 border-t border-gray-100">
                                    @if($resource->file_path && in_array(pathinfo($resource->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                        <div class="relative group">
                                            <img src="{{ asset('storage/' . $resource->file_path) }}"
                                                alt="{{ $resource->title }}"
                                                class="rounded-lg max-w-full h-48 sm:h-64 object-cover cursor-pointer hover:opacity-95 transition-opacity">
                                            <div
                                                class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all duration-200 rounded-lg">
                                            </div>
                                        </div>
                                    @elseif($resource->file_path)
                                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                            <div class="flex items-center space-x-3">
                                                <div class="flex-shrink-0">
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
                                                        <svg class="w-8 h-8 text-orange-500" fill="currentColor"
                                                            viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd"
                                                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
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
                                                <div>
                                                    <p class="text-xs text-gray-500 uppercase font-medium">
                                                        {{ $extension }} file
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <a href="{{ asset('storage/' . $resource->file_path) }}" target="_blank"
                                                    class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 text-xs font-medium rounded-md hover:bg-blue-100 transition-colors">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                        </path>
                                                    </svg>
                                                    Download
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="flex items-center justify-center p-6 bg-gray-50 rounded-lg">
                                            <div class="text-center">
                                                <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="currentColor"
                                                    viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                <p class="text-sm text-gray-500">No file attached</p>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- View Details and Comments Count -->
                                    <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-100">
                                        <div class="flex items-center space-x-4 text-xs text-gray-500">
                                            <span class="flex items-center space-x-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                                    </path>
                                                </svg>
                                                <span>{{ $resource->comments->count() }} comments</span>
                                            </span>
                                        </div>
                                        <a href="{{ route('resources.show', $resource) }}"
                                            class="inline-flex items-center px-3 py-1.5 bg-gray-100 text-gray-700 text-xs font-medium rounded-md hover:bg-gray-200 transition-colors">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <h3 class="mt-4 text-lg font-medium text-gray-900">No resources yet</h3>
                        <p class="mt-2 text-sm text-gray-500">Get started by uploading your first study resource.</p>
                        <div class="mt-6">
                            <a href="{{ route('resources.create') }}"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-medium text-sm text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                Upload Resource
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Pagination Links --}}
            @if($resources->hasPages())
                <div class="mt-8">
                    {{ $resources->links() }}
                </div>
            @endif
        </div>
    </div>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const courseSelect = document.getElementById('course_name');
            const searchForm = courseSelect.closest('form');

            // Auto-submit form when course is changed
            courseSelect.addEventListener('change', function () {
                searchForm.submit();
            });

            // Optional: Submit form on Enter key press in search input
            const searchInput = document.getElementById('search');
            searchInput.addEventListener('keypress', function (e) {
                if (e.key === 'Enter') {
                    searchForm.submit();
                }
            });

            // Voting functionality
            document.querySelectorAll('.vote-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const resourceId = this.closest('[data-resource-id]').dataset.resourceId;
                    const voteType = this.dataset.voteType;

                    // Disable button during request
                    this.disabled = true;

                    fetch(`/resources/${resourceId}/vote`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            vote_type: voteType
                        })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const container = this.closest('[data-resource-id]');
                                const upvoteBtn = container.querySelector('.upvote-btn');
                                const downvoteBtn = container.querySelector('.downvote-btn');
                                const voteScore = container.querySelector('.vote-score');
                                const upvotesCount = container.querySelector('.upvotes-count');
                                const downvotesCount = container.querySelector('.downvotes-count');

                                // Update counts
                                upvotesCount.textContent = data.upvotes_count;
                                downvotesCount.textContent = data.downvotes_count;
                                voteScore.textContent = data.vote_score;

                                // Update button states
                                upvoteBtn.className = `vote-btn upvote-btn flex items-center space-x-1 px-2 py-1 rounded-md text-xs font-medium transition-colors duration-200 ${data.user_vote === 'up' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600 hover:bg-green-50 hover:text-green-600'}`;

                                downvoteBtn.className = `vote-btn downvote-btn flex items-center space-x-1 px-2 py-1 rounded-md text-xs font-medium transition-colors duration-200 ${data.user_vote === 'down' ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-600 hover:bg-red-50 hover:text-red-600'}`;
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred while voting. Please try again.');
                        })
                        .finally(() => {
                            this.disabled = false;
                        });
                });
            });
        });
    </script>
</x-app-layout>