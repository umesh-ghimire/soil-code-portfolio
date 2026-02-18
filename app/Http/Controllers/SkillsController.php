<?php

namespace App\Http\Controllers;

use App\Models\Skill;

class SkillsController extends Controller
{
    /**
     * Display the skills page
     */
    public function index()
    {
        $skillsByCategory = Skill::where('is_published', true)
            ->orderBy('category')
            ->orderBy('sort_order')
            ->orderBy('proficiency', 'desc')
            ->get()
            ->groupBy('category');
        
        $totalSkills = Skill::where('is_published', true)->count();
        
        return view('skills.index', compact('skillsByCategory', 'totalSkills'));
    }
}