<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-3 sm:space-y-0">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 leading-tight">
                    Resource Details
                </h2>
                <p class="text-sm text-gray-600 mt-1">View full details and comments</p>
            </div>
            <a href="{{ route('home') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg font-medium text-sm text-gray-700 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-all duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Resources
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
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

            <!-- Resource Details Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                <div class="p-6">
                    <!-- Header with user info and date -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-6 space-y-2 sm:space-y-0">
                        <div class="flex items-center space-x-3">
                            <div class="flex-shrink-0">
                                <div
                                    class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center text-white font-medium">
                                    {{ strtoupper(substr($resource->user->name, 0, 2)) }}
                                </div>
                            </div>
                            <div>
                                <h3 class="text-lg font-medium text-gray-900">{{ $resource->user->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $resource->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div class="text-sm text-gray-500">
                            {{ $resource->created_at->format('M d, Y \a\t g:i A') }}
                        </div>
                    </div>

                    <!-- Resource content -->
                    <div class="space-y-4">
                        <!-- Title -->
                        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">
                            {{ $resource->title }}
                        </h1>

                        <!-- Course name badge and votes -->
                        <div class="flex items-center justify-between">
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                        class="vote-btn upvote-btn flex items-center space-x-1 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 {{ $resource->user_vote === 'up' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600 hover:bg-green-50 hover:text-green-600' }}"
                                        data-vote-type="up">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                                        </svg>
                                        <span class="upvotes-count">{{ $resource->upvotes->count() }}</span>
                                    </button>

                                    <!-- Vote score -->
                                    <span class="vote-score px-3 py-2 text-sm font-medium text-gray-700">
                                        {{ $resource->vote_score }}
                                    </span>

                                    <!-- Downvote button -->
                                    <button type="button"
                                        class="vote-btn downvote-btn flex items-center space-x-1 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 {{ $resource->user_vote === 'down' ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-600 hover:bg-red-50 hover:text-red-600' }}"
                                        data-vote-type="down">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                                        </svg>
                                        <span class="downvotes-count">{{ $resource->downvotes->count() }}</span>
                                    </button>
                                </div>
                            @else
                                <div class="flex items-center space-x-1">
                                    <div class="flex items-center space-x-1 px-3 py-2 text-sm text-gray-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                                        </svg>
                                        <span>{{ $resource->upvotes->count() }}</span>
                                    </div>
                                    <span class="px-3 py-2 text-sm font-medium text-gray-700">
                                        {{ $resource->vote_score }}
                                    </span>
                                    <div class="flex items-center space-x-1 px-3 py-2 text-sm text-gray-500">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                                        </svg>
                                        <span>{{ $resource->downvotes->count() }}</span>
                                    </div>
                                </div>
                            @endauth
                        </div>

                        <!-- Full Description -->
                        <div class="prose max-w-none">
                            <p class="text-gray-700 text-base leading-relaxed">
                                {{ $resource->description }}
                            </p>
                        </div>

                        <!-- File Display -->
                        <div class="pt-4 border-t border-gray-100">
                            @if(in_array(pathinfo($resource->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                <div class="text-center">
                                    <img src="{{ asset('storage/' . $resource->file_path) }}" alt="{{ $resource->title }}"
                                        class="rounded-lg max-w-full max-h-96 mx-auto shadow-md">
                                </div>
                            @else
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            @php
                                                $extension = strtolower(pathinfo($resource->file_path, PATHINFO_EXTENSION));
                                            @endphp
                                            @if($extension === 'pdf')
                                                <svg class="w-12 h-12 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            @elseif(in_array($extension, ['ppt', 'pptx']))
                                                <svg class="w-12 h-12 text-orange-500" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            @else
                                                <svg class="w-12 h-12 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500 uppercase font-medium">
                                                {{ $extension }} file
                                            </p>
                                            <p class="text-xs text-gray-400">
                                                Click to download the resource file
                                            </p>
                                        </div>
                                    </div>
                                    <a href="{{ asset('storage/' . $resource->file_path) }}" target="_blank"
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-md hover:shadow-lg">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                            </path>
                                        </svg>
                                        Download File
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-gray-900">
                            Comments ({{ $resource->comments->count() }})
                        </h2>
                    </div>

                    @auth
                        <!-- Comment Form -->
                        <form action="{{ route('comments.store', $resource) }}" method="POST" class="mb-8">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label for="content" class="sr-only">Add a comment</label>
                                    <textarea id="content" name="content" rows="3"
                                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm resize-none"
                                        placeholder="Share your thoughts about this resource..."
                                        required>{{ old('content') }}</textarea>
                                    @error('content')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="flex justify-end">
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-blue-700 focus:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                            </path>
                                        </svg>
                                        Add Comment
                                    </button>
                                </div>
                            </div>
                        </form>
                    @else
                        <div class="mb-8 p-4 bg-gray-50 rounded-lg text-center">
                            <p class="text-gray-600 mb-4">Please <a href="{{ route('login') }}"
                                    class="text-blue-600 hover:text-blue-800 underline">log in</a> to leave a comment.</p>
                        </div>
                    @endauth

                    <!-- Comments List -->
                    <div class="space-y-6">
                        @forelse ($resource->parentComments as $comment)
                            @include('components.comment', ['comment' => $comment, 'resource' => $resource])
                        @empty
                            <div class="text-center py-8">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                    </path>
                                </svg>
                                <h3 class="mt-4 text-lg font-medium text-gray-900">No comments yet</h3>
                                <p class="mt-2 text-sm text-gray-500">Be the first to share your thoughts about this
                                    resource.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Voting functionality (same as in index)
            document.querySelectorAll('.vote-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const resourceId = this.closest('[data-resource-id]').dataset.resourceId;
                    const voteType = this.dataset.voteType;

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

                                upvotesCount.textContent = data.upvotes_count;
                                downvotesCount.textContent = data.downvotes_count;
                                voteScore.textContent = data.vote_score;

                                upvoteBtn.className = `vote-btn upvote-btn flex items-center space-x-1 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 ${data.user_vote === 'up' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600 hover:bg-green-50 hover:text-green-600'}`;

                                downvoteBtn.className = `vote-btn downvote-btn flex items-center space-x-1 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-200 ${data.user_vote === 'down' ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-600 hover:bg-red-50 hover:text-red-600'}`;
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

            // Reply functionality
            document.querySelectorAll('.reply-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const commentId = this.dataset.commentId;
                    const replyForm = document.getElementById(`reply-form-${commentId}`);

                    if (replyForm.classList.contains('hidden')) {
                        replyForm.classList.remove('hidden');
                        this.textContent = 'Cancel Reply';
                        this.classList.remove('text-blue-600', 'hover:text-blue-800');
                        this.classList.add('text-gray-600', 'hover:text-gray-800');
                    } else {
                        replyForm.classList.add('hidden');
                        this.textContent = 'Reply';
                        this.classList.remove('text-gray-600', 'hover:text-gray-800');
                        this.classList.add('text-blue-600', 'hover:text-blue-800');
                    }
                });
            });
        });
    </script>
</x-app-layout>