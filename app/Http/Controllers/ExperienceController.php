<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Profile;

class ExperienceController extends Controller
{
    /**
     * Display the experience page
     */
    public function index()
    {
        $experiences = Experience::where('is_published', true)
            ->orderBy('start_date', 'desc')
            ->get();
        
        $profile = Profile::first();
        
        return view('experience.index', compact('experiences', 'profile'));
    }
}