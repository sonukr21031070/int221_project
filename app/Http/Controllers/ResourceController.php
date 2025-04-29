<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use App\Models\Category;
use App\Models\ResourceMetadata;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Resource::with(['category', 'metadata', 'user']);

        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->has('type')) {
            $query->where('file_type', $request->type);
        }

        if ($request->has('disability_focus')) {
            $query->whereHas('metadata', function($q) use ($request) {
                $q->where('disability_focus', $request->disability_focus);
            });
        }

        $resources = $query->latest()->paginate(12);
        $categories = Category::all();

        return view('resources.index', compact('resources', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('resources.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'file' => 'required|file|max:102400', // 100MB max
            'disability_focus' => 'required|string',
            'accessibility_features' => 'nullable|string',
            'language' => 'required|string',
        ]);

        $file = $request->file('file');
        $fileType = $this->determineFileType($file);
        $filePath = $file->store('resources');

        $resource = Resource::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'file_path' => $filePath,
            'file_type' => $fileType,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
        ]);

        ResourceMetadata::create([
            'resource_id' => $resource->id,
            'disability_focus' => $request->disability_focus,
            'accessibility_features' => $request->accessibility_features,
            'language' => $request->language,
            'duration_seconds' => $request->duration_seconds,
        ]);

        return redirect()->route('resources.show', $resource)
            ->with('success', 'Resource uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Resource $resource)
    {
        return view('resources.show', compact('resource'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resource $resource)
    {
        $this->authorize('update', $resource);
        $categories = Category::all();
        return view('resources.edit', compact('resource', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resource $resource)
    {
        $this->authorize('update', $resource);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'file' => 'nullable|file|max:102400', // 100MB max
            'disability_focus' => 'required|string',
            'accessibility_features' => 'nullable|string',
            'language' => 'required|string',
        ]);

        if ($request->hasFile('file')) {
            Storage::delete($resource->file_path);
            $file = $request->file('file');
            $fileType = $this->determineFileType($file);
            $filePath = $file->store('resources');
            
            $resource->update([
                'file_path' => $filePath,
                'file_type' => $fileType,
            ]);
        }

        $resource->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'category_id' => $request->category_id,
        ]);

        $resource->metadata->update([
            'disability_focus' => $request->disability_focus,
            'accessibility_features' => $request->accessibility_features,
            'language' => $request->language,
            'duration_seconds' => $request->duration_seconds,
        ]);

        return redirect()->route('resources.show', $resource)
            ->with('success', 'Resource updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resource $resource)
    {
        $this->authorize('delete', $resource);
        
        Storage::delete($resource->file_path);
        $resource->delete();

        return redirect()->route('resources.index')
            ->with('success', 'Resource deleted successfully.');
    }

    public function download(Resource $resource)
    {
        $resource->increment('download_count');
        return Storage::download($resource->file_path, $resource->title . '.' . $this->getFileExtension($resource->file_path));
    }

    public function preview(Resource $resource)
    {
        // Handle preview based on file type
        $fileType = $resource->file_type;
        $filePath = Storage::path($resource->file_path);

        switch ($fileType) {
            case 'audio':
            case 'video':
                return response()->file($filePath);
            case 'pdf':
                // Return first page or preview
                return response()->file($filePath);
            default:
                // For text files, return preview
                return response()->file($filePath);
        }
    }

    private function determineFileType($file)
    {
        $mimeType = $file->getMimeType();
        
        if (strpos($mimeType, 'audio') === 0) return 'audio';
        if (strpos($mimeType, 'video') === 0) return 'video';
        if ($mimeType === 'application/pdf') return 'pdf';
        return 'text';
    }

    private function getFileExtension($path)
    {
        return pathinfo($path, PATHINFO_EXTENSION);
    }
}
