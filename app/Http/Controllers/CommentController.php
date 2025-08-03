<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request, Resource $resource)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'resource_id' => $resource->id,
            'parent_id' => $request->parent_id,
            'content' => $request->content,
        ]);

        return redirect()->route('resources.show', $resource)
            ->with('status', 'Comment added successfully!');
    }

    /**
     * Remove the specified comment from storage.
     */
    public function destroy(Comment $comment)
    {
        // Check if the user owns the comment
        if ($comment->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $resourceId = $comment->resource_id;
        $comment->delete();

        return redirect()->route('resources.show', $resourceId)
            ->with('status', 'Comment deleted successfully!');
    }
}
