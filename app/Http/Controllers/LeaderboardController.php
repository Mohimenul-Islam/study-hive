<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    /**
     * Display the leaderboard.
     */
    public function index()
    {
        $users = User::select('id', 'name', 'department', 'contribution_point')
            ->where('contribution_point', '>', 0)
            ->orderBy('contribution_point', 'desc')
            ->paginate(20);

        return view('leaderboard.index', compact('users'));
    }
}
