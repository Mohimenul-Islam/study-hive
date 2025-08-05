<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    /**
     * Vote on a resource.
     */
    public function vote(Request $request, Resource $resource)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return response()->json(['error' => 'Authentication required'], 401);
        }

        $request->validate([
            'vote_type' => 'required|in:up,down'
        ]);

        $userId = Auth::id();
        $voteType = $request->vote_type;

        // Check if user already voted on this resource
        $existingVote = Vote::where('user_id', $userId)
            ->where('resource_id', $resource->id)
            ->first();

        if ($existingVote) {
            if ($existingVote->vote_type === $voteType) {
                // Same vote type - remove the vote (toggle off)
                $existingVote->delete();
                $message = 'Vote removed';
            } else {
                // Different vote type - update the vote
                $existingVote->update(['vote_type' => $voteType]);
                $message = 'Vote updated';
            }
        } else {
            // Create new vote
            Vote::create([
                'user_id' => $userId,
                'resource_id' => $resource->id,
                'vote_type' => $voteType,
            ]);
            $message = 'Vote added';
        }

        // Update the cached upvote count
        $resource->updateUpvoteCount();

        // Update the resource owner's contribution points
        $resource->user->updateContributionPoints();

        // Return JSON response for AJAX requests
        if ($request->expectsJson()) {
            $resource->load(['upvotes', 'downvotes']);
            return response()->json([
                'success' => true,
                'message' => $message,
                'vote_score' => $resource->vote_score,
                'upvotes_count' => $resource->upvotes()->count(),
                'downvotes_count' => $resource->downvotes()->count(),
                'user_vote' => $resource->user_vote,
            ]);
        }

        // Redirect back for regular requests
        return back()->with('status', $message);
    }
}
