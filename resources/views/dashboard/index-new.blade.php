<x-app-layout>
    <x-slot name="title">My Dashboard - StudyHive</x-slot>
    <x-slot name="metaDescription">Manage your resources and track your StudyHive activity from your personal
        dashboard.</x-slot>

    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                    Welcome back, {{ Auth::user()->name }}!
                </h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">
                    Manage your resources and track your contributions
                </p>
            </div>
            <x-button href="{{ route('resources.create') }}" class="shadow-lg hover:shadow-xl">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Upload Resource
            </x-button>
        </div>
    </x-slot>

    <x-page-container>
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Resources -->
            <x-card class="group hover:scale-105 transition-transform duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Resources</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['total_resources'] }}</p>
                    </div>
                    <div
                        class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                        <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
            </x-card>

            <!-- Total Upvotes -->
            <x-card class="group hover:scale-105 transition-transform duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Upvotes</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['total_upvotes'] }}</p>
                    </div>
                    <div
                        class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                        <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 11l5-5m0 0l5 5m-5-5v12" />
                        </svg>
                    </div>
                </div>
            </x-card>

            <!-- Total Comments -->
            <x-card class="group hover:scale-105 transition-transform duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">Total Comments</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['total_comments'] }}</p>
                    </div>
                    <div
                        class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                        <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                        </svg>
                    </div>
                </div>
            </x-card>

            <!-- This Week -->
            <x-card class="group hover:scale-105 transition-transform duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-600 dark:text-gray-400">This Week</p>
                        <p class="text-3xl font-bold text-gray-900 dark:text-white">{{ $stats['recent_resources'] }}</p>
                    </div>
                    <div
                        class="w-12 h-12 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-200">
                        <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                </div>
            </x-card>
        </div>

        <!-- Profile Section -->
        <x-card class="mb-8" hover>
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Profile Information</h2>
                <x-button href="{{ route('profile.edit') }}" variant="secondary" size="sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Profile
                </x-button>
            </div>

            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <div
                        class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center text-white font-bold text-xl shadow-lg">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $user->name }}</h3>
                    <p class="text-gray-600 dark:text-gray-400">{{ $user->email }}</p>
                    <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500 dark:text-gray-400">
                        <span class="flex items-center space-x-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0V8a2 2 0 012-2h4a2 2 0 012 2v-1" />
                            </svg>
                            <span>Member since {{ $user->created_at->format('M d, Y') }}</span>
                        </span>
                    </div>
                </div>
            </div>
        </x-card>

        <!-- My Resources Section -->
        <x-card class="overflow-hidden">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <div
                    class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0 mb-6">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                        My Resources <span
                            class="text-sm font-normal text-gray-500 dark:text-gray-400">({{ $resources->total() }})</span>
                    </h2>
                </div>

                <!-- Search and Filter Form -->
                <form method="GET" action="{{ route('dashboard.index') }}"
                    class="space-y-4 sm:space-y-0 sm:flex sm:items-end sm:space-x-4">
                    <!-- Search Input -->
                    <x-form-group label="Search My Resources" class="flex-1">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <input type="text" id="search" name="search" value="{{ $currentSearch }}"
                                class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 placeholder:text-gray-500 dark:placeholder:text-gray-400 focus:border-blue-500 dark:focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all duration-200"
                                placeholder="Search by title or description...">
                        </div>
                    </x-form-group>

                    <!-- Course Filter Dropdown -->
                    <x-form-group label="Filter by Course" class="sm:w-64">
                        <select id="course_name" name="course_name"
                            class="block w-full px-3 py-2.5 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-gray-100 bg-white dark:bg-gray-800 focus:border-blue-500 dark:focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 focus:outline-none transition-all duration-200">
                            <option value="">All Courses</option>
                            @foreach ($courseNames as $courseName)
                                <option value="{{ $courseName }}" {{ $currentCourse == $courseName ? 'selected' : '' }}>
                                    {{ $courseName }}
                                </option>
                            @endforeach
                        </select>
                    </x-form-group>

                    <!-- Action Buttons -->
                    <div class="flex space-x-3 sm:flex-shrink-0">
                        <x-button type="submit" class="flex-shrink-0">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Search
                        </x-button>

                        @if ($currentSearch || $currentCourse)
                            <x-button href="{{ route('dashboard.index') }}" variant="secondary">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Clear
                            </x-button>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Resources List -->
            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($resources as $resource)
                    <div class="p-6 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors duration-200">
                        <div class="flex items-start justify-between">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between mb-3">
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white truncate">
                                        <a href="{{ route('resources.show', $resource) }}"
                                            class="hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200">
                                            {{ $resource->title }}
                                        </a>
                                    </h3>
                                    <span
                                        class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-400">
                                        {{ $resource->course_name }}
                                    </span>
                                </div>

                                <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-2">
                                    {{ Str::limit($resource->description, 140) }}
                                </p>

                                <div class="flex items-center space-x-6 text-sm text-gray-500 dark:text-gray-400">
                                    <span class="flex items-center space-x-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 11l5-5m0 0l5 5m-5-5v12" />
                                        </svg>
                                        <span>{{ $resource->upvotes->count() }} upvotes</span>
                                    </span>
                                    <span class="flex items-center space-x-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                        <span>{{ $resource->comments->count() }} comments</span>
                                    </span>
                                    <span>{{ $resource->created_at->diffForHumans() }}</span>
                                </div>
                            </div>

                            <div class="flex items-center space-x-2 ml-4">
                                <x-button href="{{ route('resources.edit', $resource) }}" variant="secondary" size="sm">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </x-button>

                                <form action="{{ route('resources.destroy', $resource) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <x-button type="submit" variant="danger" size="sm"
                                        onclick="return confirm('Are you sure you want to delete this resource? This action cannot be undone.')">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Delete
                                    </x-button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16">
                        <div
                            class="w-24 h-24 mx-auto bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center mb-6">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No resources found</h3>
                        <p class="text-gray-600 dark:text-gray-400 mb-8 max-w-sm mx-auto">
                            @if($currentSearch || $currentCourse)
                                No resources match your current search criteria. Try adjusting your filters.
                            @else
                                Get started by uploading your first study resource to share with the community.
                            @endif
                        </p>
                        <x-button href="{{ route('resources.create') }}" size="lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Upload Your First Resource
                        </x-button>
                    </div>
                @endforelse
            </div>

            {{-- Pagination Links --}}
            @if($resources->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                    {{ $resources->links() }}
                </div>
            @endif
        </x-card>
    </x-page-container>

    @push('scripts')
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
                        e.preventDefault();
                        searchForm.submit();
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>