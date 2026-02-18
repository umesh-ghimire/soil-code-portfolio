@php
    $profile = \App\Models\Profile::first();
    
    $yearsExperience = $profile->years_experience ?? 8;
    $projectsCount = \App\Models\Project::where('is_published', true)->count();
    $skillsCount = \App\Models\Skill::where('is_published', true)->count();
    
    $bio = $profile->bio ?? theme_setting('about_description', 'Born in a Dhankuta village without internet, I learned to code by moonlight — literally. Now I build for the web with the same patience it takes to grow millet.');
    
    // Social links
    $socialLinks = [];
    if ($profile && !empty($profile->social_links)) {
        $rawSocialLinks = $profile->social_links;
        
        if (is_array($rawSocialLinks)) {
            foreach ($rawSocialLinks as $link) {
                if (isset($link['platform']) && isset($link['url'])) {
                    $socialLinks[$link['platform']] = $link['url'];
                }
            }
        } elseif (is_string($rawSocialLinks)) {
            $decoded = json_decode($rawSocialLinks, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $socialLinks = $decoded;
            }
        }
    }
@endphp

<div class="about-grid">
    <!-- Left - Stats with Organic Shapes -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">{{ $yearsExperience }}</div>
            <div class="stat-label">{{ theme_setting('years_label', 'years craft') }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $projectsCount }}</div>
            <div class="stat-label">{{ theme_setting('projects_label', 'projects') }}</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $skillsCount }}</div>
            <div class="stat-label">{{ theme_setting('skills_label', 'open source') }}</div>
        </div>
    </div>
    
    <!-- Right - About Text -->
    <div class="about-content">
        <h2>{{ theme_setting('about_section_title', 'माटोको मान्छे') }}</h2>
        <p class="about-text">{{ $bio }}</p>
        <div class="social-links">
            @if(!empty($socialLinks))
                @foreach($socialLinks as $platform => $url)
                    @if($url && $url !== '#')
                        <a href="{{ $url }}" target="_blank" class="social-link">{{ ucfirst($platform) }}</a>
                    @endif
                @endforeach
            @else
                <a href="#" class="social-link">GitHub</a>
                <a href="#" class="social-link">LinkedIn</a>
                <a href="#" class="social-link">Twitter</a>
            @endif
        </div>
    </div>
</div>