<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ResourceController extends Controller
{
    /**
     * Show the application dashboard with all resources.
     */
    public function index(Request $request)
    {
        $query = Resource::with(['user', 'upvotes', 'downvotes'])
            ->orderByDesc('upvote_count')
            ->orderByDesc('created_at');

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

        return view('resources.index', [
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
     * Display the specified resource.
     */
    public function show(Resource $resource)
    {
        $resource->load([
            'user',
            'upvotes',
            'downvotes',
            'parentComments.user',
            'parentComments.replies.user',
            'parentComments.replies.replies.user'
        ]);

        return view('resources.show', compact('resource'));
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
            'file' => 'nullable|file|mimes:pdf,pptx,ppt,jpg,jpeg,png,gif,doc,docx|max:10240', // 10MB max
        ]);

        // 2. Store the uploaded file and get its path (if file is provided)
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('resources', 'public');
        }

        // 3. Create a new record in the database
        Resource::create([
            'user_id' => Auth::id(), // Get the ID of the currently logged-in user
            'title' => $request->title,
            'description' => $request->description,
            'course_name' => $request->course_name,
            'file_path' => $filePath,
        ]);

        // 4. Redirect the user back to the dashboard with a success message
        return redirect()->route('home')->with('status', 'Resource uploaded successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resource $resource)
    {
        // Check if the user owns this resource
        if ($resource->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('resources.edit', compact('resource'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resource $resource)
    {
        // Check if the user owns this resource
        if ($resource->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Validate the incoming data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'course_name' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,pptx,ppt,jpg,jpeg,png,gif,doc,docx|max:10240', // 10MB max, file is optional on update
        ]);

        // Handle file upload if a new file is provided
        $updateData = [
            'title' => $request->title,
            'description' => $request->description,
            'course_name' => $request->course_name,
        ];

        if ($request->hasFile('file')) {
            // Delete old file if it exists
            if ($resource->file_path && Storage::disk('public')->exists($resource->file_path)) {
                Storage::disk('public')->delete($resource->file_path);
            }

            // Store new file
            $updateData['file_path'] = $request->file('file')->store('resources', 'public');
        }

        // Update the resource
        $resource->update($updateData);

        return redirect()->route('dashboard.index')->with('status', 'Resource updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resource $resource)
    {
        // Check if the user owns this resource
        if ($resource->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete the file from storage
        if ($resource->file_path && Storage::disk('public')->exists($resource->file_path)) {
            Storage::disk('public')->delete($resource->file_path);
        }

        // Delete the resource
        $resource->delete();

        return redirect()->route('dashboard.index')->with('status', 'Resource deleted successfully!');
    }
}