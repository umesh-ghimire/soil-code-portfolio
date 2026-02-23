<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Education;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class ResumeController extends Controller
{
    /**
     * Show template selection page
     */
    public function select()
    {
        return view('resume.select');
    }
    
    /**
     * Preview a specific template
     */
    public function preview($template)
    {
        $data = $this->getResumeData();
        return view("resume.templates.{$template}", $data);
    }
    
    /**
     * Download resume with selected template
     */
    public function download($template)
    {
        $data = $this->getResumeData();
        
        $pdf = Pdf::loadView("resume.templates.{$template}", $data);
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOptions([
            'defaultFont' => 'sans-serif',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'dpi' => 150,
            'isFontSubsettingEnabled' => true,
            'isPhpEnabled' => true,
            'chroot' => public_path(),
        ]);
        
        $filename = $data['profile'] 
            ? str_replace(' ', '_', $data['profile']->name) . '_Resume.pdf'
            : 'Umesh_Ghimire_Resume.pdf';
        
        return $pdf->download($filename);
    }
    
    /**
     * Get common resume data with base64 images
     */
    private function getResumeData()
    {
        $profile = Profile::first();
        
        $experiences = Experience::where('is_published', true)
            ->orderBy('start_date', 'desc')
            ->get();
            
        $skills = Skill::where('is_published', true)
            ->orderBy('name')
            ->get();
            
        $projects = Project::where('is_published', true)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->take(4)
            ->get();
            
        $education = Education::where('is_published', true)
            ->orderBy('start_date', 'desc')
            ->get();
        
        $languages = $profile->languages ?? [
            ['name' => 'English', 'level' => 'C1 (Advanced)'],
            ['name' => 'Nepali', 'level' => 'Native'],
            ['name' => 'Hindi', 'level' => 'B2 (Intermediate)'],
        ];
        
        $phone = $profile->phone ?? '+977 9863567668';
        $email = $profile->email ?? 'ughimire305@gmail.com';
        $location = $profile->location ?? 'Butwal, Nepal';
        
        // ===== FIX: Convert image to base64 =====
        $photoBase64 = null;
        if ($profile && $profile->profile_image) {
            // Try multiple possible paths
            $possiblePaths = [
                storage_path('app/public/' . $profile->profile_image),
                public_path('storage/' . $profile->profile_image),
                public_path($profile->profile_image),
                storage_path('app/public/profiles/' . basename($profile->profile_image)),
            ];
            
            foreach ($possiblePaths as $path) {
                if (file_exists($path)) {
                    try {
                        $imageData = file_get_contents($path);
                        $extension = pathinfo($path, PATHINFO_EXTENSION) ?: 'jpg';
                        $photoBase64 = 'data:image/' . $extension . ';base64,' . base64_encode($imageData);
                        break;
                    } catch (\Exception $e) {
                        continue;
                    }
                }
            }
        }
        
        return [
            'profile' => $profile,
            'experiences' => $experiences,
            'skills' => $skills,
            'projects' => $projects,
            'education' => $education,
            'languages' => $languages,
            'phone' => $phone,
            'email' => $email,
            'location' => $location,
            'photoBase64' => $photoBase64, // Add base64 image
            'generated_at' => now()->format('F j, Y'),
        ];
    }
}