<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Education;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ResumeController extends Controller
{
    /**
     * Generate and download one-page PDF resume
     */
    public function downloadOnePage()
    {
        $profile = Profile::first();
        
        // Get all experiences
        $experiences = Experience::where('is_published', true)
            ->orderBy('start_date', 'desc')
            ->get();
            
        // Get all skills
        $skills = Skill::where('is_published', true)
            ->orderBy('name')
            ->get();
            
        // Get featured projects only
        $projects = Project::where('is_published', true)
            ->where('is_featured', true)
            ->orderBy('sort_order')
            ->take(3)
            ->get();
            
        // Get education
        $education = Education::where('is_published', true)
            ->orderBy('start_date', 'desc')
            ->get();
        
        // Get languages
        $languages = $profile->languages ?? [
            ['name' => 'English', 'level' => 'C1 (Advanced)'],
            ['name' => 'Nepali', 'level' => 'Native'],
            ['name' => 'Hindi', 'level' => 'B2 (Intermediate)'],
        ];
        
        // Get contact info
        $phone = $profile->phone ?? '+977 9863567668';
        $email = $profile->email ?? 'ghimireu933@gmail.com';
        $location = $profile->location ?? 'Butwal, Nepal';
        
        // ===== FIXED: Handle image properly =====
        $photoBase64 = null;
        if ($profile && $profile->profile_image) {
            $imagePath = storage_path('app/public/' . $profile->profile_image);
            
            // Also try public path if storage path doesn't work
            if (!file_exists($imagePath)) {
                $imagePath = public_path('storage/' . $profile->profile_image);
            }
            
            if (file_exists($imagePath)) {
                $imageData = file_get_contents($imagePath);
                $photoBase64 = 'data:image/' . pathinfo($imagePath, PATHINFO_EXTENSION) . ';base64,' . base64_encode($imageData);
            }
        }
        
        $data = [
            'profile' => $profile,
            'experiences' => $experiences,
            'skills' => $skills,
            'projects' => $projects,
            'education' => $education,
            'languages' => $languages,
            'phone' => $phone,
            'email' => $email,
            'location' => $location,
            'photoBase64' => $photoBase64, // Use base64 encoded image
            'generated_at' => now()->format('F j, Y'),
        ];
        
        $pdf = Pdf::loadView('resume.one-page', $data);
        
        // Set paper to A4 portrait
        $pdf->setPaper('A4', 'portrait');
        
        // PDF options for better quality
        $pdf->setOptions([
            'defaultFont' => 'sans-serif',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'dpi' => 150,
            'defaultPaperSize' => 'a4',
            'isFontSubsettingEnabled' => true,
            'isPhpEnabled' => true
        ]);
        
        $filename = $profile 
            ? str_replace(' ', '_', $profile->name) . '_Resume.pdf'
            : 'Umesh_Ghimire_Resume.pdf';
        
        return $pdf->download($filename);
    }
    
    /**
     * Stream PDF in browser
     */
    public function viewOnePage()
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
            ->take(3)
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
        $email = $profile->email ?? 'ghimireu933@gmail.com';
        $location = $profile->location ?? 'Butwal, Nepal';
        
        // ===== FIXED: Handle image properly =====
        $photoBase64 = null;
        if ($profile && $profile->profile_image) {
            $imagePath = storage_path('app/public/' . $profile->profile_image);
            
            if (!file_exists($imagePath)) {
                $imagePath = public_path('storage/' . $profile->profile_image);
            }
            
            if (file_exists($imagePath)) {
                $imageData = file_get_contents($imagePath);
                $photoBase64 = 'data:image/' . pathinfo($imagePath, PATHINFO_EXTENSION) . ';base64,' . base64_encode($imageData);
            }
        }
        
        $data = [
            'profile' => $profile,
            'experiences' => $experiences,
            'skills' => $skills,
            'projects' => $projects,
            'education' => $education,
            'languages' => $languages,
            'phone' => $phone,
            'email' => $email,
            'location' => $location,
            'photoBase64' => $photoBase64,
            'generated_at' => now()->format('F j, Y'),
        ];
        
        $pdf = Pdf::loadView('resume.one-page', $data);
        $pdf->setPaper('A4', 'portrait');
        
        return $pdf->stream('resume.pdf');
    }
}