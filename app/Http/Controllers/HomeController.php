<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Testimonial;
use App\Models\Profile;
use App\Models\BlogPost; // ADD THIS
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the home page
     */
    public function index()
    {
        $profile = Profile::first();
        $featuredProjects = Project::featured()->published()->orderBy('sort_order')->take(6)->get();
        $featuredSkills = Skill::featured()->published()->orderBy('sort_order')->take(8)->get();
        $skillsByCategory = Skill::published()->orderBy('sort_order')->get()->groupBy('category');
        $experiences = Experience::published()->latestFirst()->take(5)->get();
        $testimonials = Testimonial::featured()->published()->take(3)->get();
        
        $latestPosts = BlogPost::published()
            ->latest('published_at')
            ->take(3)
            ->get();
        
        return view('home.index', compact(
            'profile',
            'featuredProjects',
            'featuredSkills',
            'skillsByCategory',
            'experiences',
            'testimonials',
            'latestPosts' // ADD THIS
        ));
    }

    public function downloadResume()
{
    $profile = Profile::first();
    
    if ($profile && $profile->resume_file) {
        // Log download (optional)
        // DownloadLog::create(['ip' => request()->ip(), 'downloaded_at' => now()]);
        
        return response()->download(storage_path('app/public/' . $profile->resume_file));
    }
    
    return redirect()->back()->with('error', 'Resume not found.');
}
}