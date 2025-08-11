<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $user->name }}'s Profile
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- User Info Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center space-x-6">
                        <!-- Avatar -->
                        <div class="flex-shrink-0">
                            <div class="w-20 h-20 bg-indigo-500 rounded-full flex items-center justify-center">
                                <span class="text-2xl font-bold text-white">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- User Details -->
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                {{ $user->name }}
                            </h3>
                            <div class="mt-2 space-y-2">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
                                        <path d="M2 13.692V16a2 2 0 002 2h12a2 2 0 002-2v-2.308A24.974 24.974 0 0110 15c-2.796 0-5.487-.46-8-1.308z" />
                                    </svg>
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                        {{ $user->department }}
                                    </span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3.293 9.707a1 1 0 010-1.414l6-6a1 1 0 011.414 0l6 6a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L4.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                        {{ number_format($user->contribution_point) }} Contribution Points
                                    </span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm0 2v.01h12V6H4zm0 2v8h12V8H4z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-sm text-gray-600 dark:text-gray-400">
                                        {{ $resources->total() }} {{ Str::plural('Resource', $resources->total()) }} Shared
                                    </span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-gray-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-sm text-gray-600 dark:text-gray-400">
                                        Member since {{ $user->created_at->format('M Y') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Resources Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <h3 class="text-xl font-bold mb-2">Shared Resources</h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            Resources uploaded by {{ $user->name }}
                        </p>
                    </div>

                    @if($resources->count() > 0)
                        <div class="grid gap-4 sm:gap-6">
                            @foreach($resources as $resource)
                                <div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-200 overflow-hidden">
                                    <div class="p-4 sm:p-6">
                                        <!-- Header with date -->
                                        <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4 space-y-2 sm:space-y-0">
                                            <div class="text-xs sm:text-sm text-gray-500">
                                                {{ $resource->created_at->diffForHumans() }}
                                            </div>
                                            <div class="text-xs sm:text-sm text-gray-500">
                                                {{ $resource->created_at->format('M d, Y') }}
                                            </div>
                                        </div>

                                        <!-- Resource content -->
                                        <div class="space-y-3">
                                            <!-- Title -->
                                            <h2 class="text-lg sm:text-xl font-bold text-gray-900 line-clamp-2">
                                                <a href="{{ route('resources.show', $resource) }}" class="hover:text-indigo-600 dark:hover:text-indigo-400">
                                                    {{ $resource->title }}
                                                </a>
                                            </h2>

                                            <!-- Course name badge and vote info -->
                                            <div class="flex items-center justify-between">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                                    </svg>
                                                    {{ $resource->course_name }}
                                                </span>

                                                <!-- Vote display -->
                                                @auth
                                                    <div class="flex items-center space-x-1" data-resource-id="{{ $resource->id }}">
                                                        <!-- Upvote button -->
                                                        <button type="button" 
                                                                class="vote-btn upvote-btn flex items-center space-x-1 px-2 py-1 rounded-md text-xs font-medium transition-colors duration-200 {{ $resource->user_vote === 'up' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600 hover:bg-green-50 hover:text-green-600' }}"
                                                                data-vote-type="up">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
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
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                                                            </svg>
                                                            <span class="downvotes-count">{{ $resource->downvotes->count() }}</span>
                                                        </button>
                                                    </div>
                                                @else
                                                    <!-- Show vote counts for guests -->
                                                    <div class="flex items-center space-x-1">
                                                        <div class="flex items-center space-x-1 px-2 py-1 text-xs text-gray-500">
                                                            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                                                            </svg>
                                                            <span class="font-semibold">{{ $resource->upvote_count }}</span>
                                                        </div>
                                                        <span class="px-2 py-1 text-xs font-medium text-gray-700">
                                                            {{ $resource->vote_score }}
                                                        </span>
                                                        <div class="flex items-center space-x-1 px-2 py-1 text-xs text-gray-500">
                                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                                                            </svg>
                                                            <span>{{ $resource->downvotes->count() }}</span>
                                                        </div>
                                                    </div>
                                                @endauth
                                            </div>

                                            <!-- Description -->
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
                                                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all duration-200 rounded-lg"></div>
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
                                                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                                                                    </svg>
                                                                @elseif(in_array($extension, ['ppt', 'pptx']))
                                                                    <svg class="w-8 h-8 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                                                                    </svg>
                                                                @else
                                                                    <svg class="w-8 h-8 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path>
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
                                                            <a href="{{ asset('storage/' . $resource->file_path) }}" 
                                                                target="_blank"
                                                                class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 text-xs font-medium rounded-md hover:bg-blue-100 transition-colors">
                                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                                </svg>
                                                                Download
                                                            </a>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="flex items-center justify-center p-6 bg-gray-50 rounded-lg">
                                                        <div class="text-center">
                                                            <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path>
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
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                                            </svg>
                                                            <span>{{ $resource->comments->count() }} comments</span>
                                                        </span>
                                                    </div>
                                                    <a href="{{ route('resources.show', $resource) }}" 
                                                       class="inline-flex items-center px-3 py-1.5 bg-gray-100 text-gray-700 text-xs font-medium rounded-md hover:bg-gray-200 transition-colors">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                        </svg>
                                                        View Details
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Pagination Links --}}
                        @if($resources->hasPages())
                            <div class="mt-8">
                                {{ $resources->links() }}
                            </div>
                        @endif
                    @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No resources yet</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                {{ $user->name }} hasn't shared any resources yet.
                            </p>
                        </div>
                    @endif
                </div>
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
        
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Voting functionality
            document.querySelectorAll('.vote-btn').forEach(button => {
                button.addEventListener('click', function() {
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
