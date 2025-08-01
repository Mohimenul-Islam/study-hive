<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResourceController extends Controller
{
    /**
     * Show the application dashboard with all resources.
     */
    public function index(Request $request)
    {
        $query = Resource::with('user')->latest();

        // Search functionality
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

        // Get unique course names for the dropdown
        $courseNames = Resource::select('course_name')
            ->distinct()
            ->orderBy('course_name')
            ->pluck('course_name');

        return view('dashboard', [
            'resources' => $resources,
            'courseNames' => $courseNames,
            'currentSearch' => $request->get('search', ''),
            'currentCourse' => $request->get('course_name', ''),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('resources.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'course_name' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,pptx,jpg,png', // Only allow these file types
        ]);

        // 2. Store the uploaded file and get its path
        $filePath = $request->file('file')->store('resources', 'public');

        // 3. Create a new record in the database
        Resource::create([
            'user_id' => Auth::id(), // Get the ID of the currently logged-in user
            'title' => $request->title,
            'description' => $request->description,
            'course_name' => $request->course_name,
            'file_path' => $filePath,
        ]);

        // 4. Redirect the user back to the dashboard with a success message
        return redirect()->route('dashboard')->with('status', 'Resource uploaded successfully!');
    }
}