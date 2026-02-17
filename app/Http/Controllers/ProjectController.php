<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of projects
     */
    public function index()
    {
        $projects = Project::published()
            ->orderBy('is_featured', 'desc')
            ->orderBy('sort_order')
            ->paginate(9);
        
        return view('projects.index', compact('projects'));
    }

    /**
     * Display the specified project
     */
    public function show($slug)
    {
        $project = Project::where('slug', $slug)
            ->published()
            ->firstOrFail();
        
        $relatedProjects = Project::published()
            ->where('id', '!=', $project->id)
            ->where(function ($query) use ($project) {
                $technologies = $project->technologies;
                if ($technologies) {
                    foreach ($technologies as $tech) {
                        $query->orWhereJsonContains('technologies', $tech);
                    }
                }
            })
            ->limit(3)
            ->get();
        
        return view('projects.show', compact('project', 'relatedProjects'));
    }
}