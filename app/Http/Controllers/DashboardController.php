<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display the user's dashboard.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        // Get user's resources with search and filter functionality
        $query = Resource::with(['user', 'upvotes', 'downvotes', 'comments'])
            ->where('user_id', $user->id)
            ->orderByDesc('created_at');

        // Search functionality for user's own resources
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        // Course filter functionality
        if ($request->filled('course_name')) {
            $query->where('course_name', $request->get('course_name'));
        }

        $resources = $query->paginate(10)->appends($request->query());

        // Get unique course names from user's resources for the dropdown
        $courseNames = Resource::where('user_id', $user->id)
            ->select('course_name')
            ->distinct()
            ->orderBy('course_name')
            ->pluck('course_name');

        // Get user statistics
        $stats = [
            'total_resources' => Resource::where('user_id', $user->id)->count(),
            'total_upvotes' => Resource::where('user_id', $user->id)->sum('upvote_count'),
            'total_comments' => Resource::where('user_id', $user->id)->withCount('comments')->get()->sum('comments_count'),
            'recent_resources' => Resource::where('user_id', $user->id)->where('created_at', '>=', now()->subDays(7))->count(),
        ];

        return view('dashboard.index', [
            'user' => $user,
            'resources' => $resources,
            'courseNames' => $courseNames,
            'currentSearch' => $request->get('search', ''),
            'currentCourse' => $request->get('course_name', ''),
            'stats' => $stats,
        ]);
    }
}
