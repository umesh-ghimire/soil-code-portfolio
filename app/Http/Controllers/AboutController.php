<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;

class AboutController extends Controller
{
    /**
     * Display the about page
     */
    public function index()
    {
        $profile = Profile::first();
        $projectsCount = Project::where('is_published', true)->count();
        $skillsCount = Skill::where('is_published', true)->count();
        
        return view('about.index', compact('profile', 'projectsCount', 'skillsCount'));
    }
}