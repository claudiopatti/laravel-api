<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Helpers
use Illuminate\Support\Facades\Storage;

// Models
use App\Models\{
    Project,
    Type,
    Technology
};

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::paginate(5);

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::get();

        $technologies = Technology::get();

        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:3|max:128',
            'description' => 'required|min:3|max:4096',
            'delivery_time' => 'nullable|min:0|max:2000',
            'price' => 'nullable|decimal:2|min:0|max:99999',
            'cover' => 'nullable|image|max:2048',
            'complete' => 'nullable|in:1,0,true,false',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'nullable|array|exists:technologies,id',
        ]);

        $data['slug'] = str()->slug($data['name']);
        $data['complete'] = isset($data['complete']);

        if (isset($data['cover'])) {
            $coverPath = Storage::put('uploads', $data['cover']);
            $data['cover'] = $coverPath;
        }

        $project = Project::create($data);

        $project->technologies()->sync($data['technologies'] ?? []);


        return redirect()->route('admin.projects.show', ['project' => $project->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show',  compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::get();

        $technologies = Technology::get();


        return view('admin.projects.edit',  compact('project', 'types', 'technologies'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {

        $data = $request->validate([
            'name' => 'required|min:3|max:128',
            'description' => 'required|min:3|max:4096',
            'delivery_time' => 'nullable|min:0|max:2000',
            'price' => 'nullable|decimal:2|min:0|max:99999',
            'cover' => 'nullable|image|max:2048',
            'complete' => 'nullable|in:1,0,true,false',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'nullable|array|exists:technologies,id',
            'remove_cover' => 'nullable'
        ]);

        $data['slug'] = str()->slug($data['name']);
        $data['complete'] = isset($data['complete']);

        if (isset($data['cover'])) {
            if($project->cover) {
                Storage::delete($project->cover);
                $project->cover = null;
            }
            $coverPath = Storage::put('uploads', $data['cover']);
            $data['cover'] = $coverPath;
        }
        elseif (isset($data['remove_cover']) && $project->cover) {
            Storage::delete($project->cover);
            $project->cover = null;
        }

        $project->update($data);

        $project->technologies()->sync($data['technologies'] ?? []);

        return redirect()->route('admin.projects.show', ['project' => $project->id]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if($project->cover) {
            Storage::delete($project->cover);
            $project->cover = null;
        }

        $project->delete();

        return redirect()->route('admin.projects.index');
    }
}
