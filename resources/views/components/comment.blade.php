<div class="comment-item">
    <div class="flex space-x-3">
        <!-- Avatar -->
        <div class="flex-shrink-0">
            <div
                class="w-10 h-10 bg-gradient-to-br from-green-500 to-blue-600 rounded-full flex items-center justify-center text-white font-medium text-sm">
                {{ strtoupper(substr($comment->user->name, 0, 2)) }}
            </div>
        </div>

        <!-- Comment Content -->
        <div class="flex-1 min-w-0">
            <div class="bg-gray-50 rounded-lg p-4">
                <!-- Comment Header -->
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center space-x-2">
                        <span class="font-medium text-gray-900">{{ $comment->user->name }}</span>
                        <span class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    @auth
                        @if($comment->user_id === auth()->id())
                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs text-red-600 hover:text-red-800"
                                    onclick="return confirm('Are you sure you want to delete this comment?')">
                                    Delete
                                </button>
                            </form>
                        @endif
                    @endauth
                </div>

                <!-- Comment Text -->
                <p class="text-gray-700 text-sm leading-relaxed">{{ $comment->content }}</p>
            </div>

            <!-- Reply Button and Form -->
            @auth
                <div class="mt-2 flex items-center space-x-4">
                    <button type="button" class="reply-btn text-xs font-medium text-blue-600 hover:text-blue-800"
                        data-comment-id="{{ $comment->id }}">
                        Reply
                    </button>
                </div>

                <!-- Reply Form (Initially Hidden) -->
                <div id="reply-form-{{ $comment->id }}" class="hidden mt-3">
                    <form action="{{ route('comments.store', $resource) }}" method="POST">
                        @csrf
                        <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                        <div class="space-y-3">
                            <textarea name="content" rows="2"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm resize-none"
                                placeholder="Write a reply..." required></textarea>
                            <div class="flex justify-end space-x-2">
                                <button type="button"
                                    class="cancel-reply px-3 py-1 text-xs font-medium text-gray-600 hover:text-gray-800"
                                    onclick="document.getElementById('reply-form-{{ $comment->id }}').classList.add('hidden'); document.querySelector('[data-comment-id=\'{{ $comment->id }}\']').textContent = 'Reply'; document.querySelector('[data-comment-id=\'{{ $comment->id }}\']').classList.remove('text-gray-600', 'hover:text-gray-800'); document.querySelector('[data-comment-id=\'{{ $comment->id }}\']').classList.add('text-blue-600', 'hover:text-blue-800');">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="px-3 py-1 bg-blue-600 text-white text-xs font-medium rounded hover:bg-blue-700">
                                    Reply
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            @endauth

            <!-- Replies -->
            @if($comment->replies->count() > 0)
                <div class="mt-4 space-y-4">
                    @foreach($comment->replies as $reply)
                        @include('components.comment', ['comment' => $reply, 'resource' => $resource])
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>