<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-3 sm:space-y-0">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    My Dashboard
                </h2>
                <p class="text-sm text-gray-600 mt-1">Manage your profile and resources</p>
            </div>
            <a href="{{ route('resources.create') }}"
                class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Upload New Resource
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
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

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Resources -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Resources</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['total_resources'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Upvotes -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Upvotes</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['total_upvotes'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Comments -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                    </path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Total Comments</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['total_comments'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- This Week -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">This Week</p>
                            <p class="text-2xl font-bold text-gray-900">{{ $stats['recent_resources'] }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Profile Information</h3>
                    <a href="{{ route('profile.edit') }}"
                        class="inline-flex items-center px-3 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-200 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        Edit Profile
                    </a>
                </div>
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-xl">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                    </div>
                    <div class="flex-1">
                        <h4 class="text-lg font-medium text-gray-900">{{ $user->name }}</h4>
                        <p class="text-sm text-gray-600">{{ $user->email }}</p>
                        <p class="text-xs text-gray-500 mt-1">Member since {{ $user->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- My Resources Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <div
                        class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-3 sm:space-y-0">
                        <h3 class="text-lg font-semibold text-gray-900">
                            My Resources ({{ $resources->total() }})
                        </h3>
                    </div>

                    <!-- Search and Filter Form -->
                    <form method="GET" action="{{ route('dashboard.index') }}"
                        class="mt-4 space-y-4 sm:space-y-0 sm:flex sm:items-end sm:space-x-4">
                        <!-- Search Input -->
                        <div class="flex-1">
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-2">
                                Search My Resources
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
                                <a href="{{ route('dashboard.index') }}"
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
                </div>

                <!-- Resources List -->
                <div class="divide-y divide-gray-100">
                    @forelse ($resources as $resource)
                        <div class="p-6 hover:bg-gray-50 transition-colors">
                            <div class="flex items-start justify-between">
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between mb-2">
                                        <h4 class="text-lg font-medium text-gray-900 truncate">
                                            <a href="{{ route('resources.show', $resource) }}"
                                                class="hover:text-blue-600 transition-colors">
                                                {{ $resource->title }}
                                            </a>
                                        </h4>
                                        <span
                                            class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            {{ $resource->course_name }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                                        {{ Str::limit($resource->description, 120) }}
                                    </p>
                                    <div class="flex items-center space-x-4 text-xs text-gray-500">
                                        <span class="flex items-center space-x-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                                            </svg>
                                            <span>{{ $resource->upvotes->count() }} upvotes</span>
                                        </span>
                                        <span class="flex items-center space-x-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                                </path>
                                            </svg>
                                            <span>{{ $resource->comments->count() }} comments</span>
                                        </span>
                                        <span>{{ $resource->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2 ml-4">
                                    <a href="{{ route('resources.edit', $resource) }}"
                                        class="inline-flex items-center px-3 py-1.5 bg-yellow-50 text-yellow-700 text-xs font-medium rounded-md hover:bg-yellow-100 transition-colors">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('resources.destroy', $resource) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 text-xs font-medium rounded-md hover:bg-red-100 transition-colors"
                                            onclick="return confirm('Are you sure you want to delete this resource? This action cannot be undone.')">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
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
                    <div class="px-6 py-4 border-t border-gray-100">
                        {{ $resources->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
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
        });
    </script>
</x-app-layout>