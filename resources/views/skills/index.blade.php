@extends('layouts.app')

@section('title', theme_setting('skills_page_title', 'toolshed · Umesh Ghimire'))
@section('description', theme_setting('skills_meta_description', 'Tools I\'ve worn down, sharpened, and learned to trust. Some are new, some are heirlooms.'))

@push('styles')
<style>
    .skills-header {
        padding: 3rem 0 2rem;
        text-align: center;
    }
    
    .skills-header h1 {
        font-size: 4rem;
        font-weight: 800;
        color: var(--moss-deep);
        margin-bottom: 1rem;
    }
    
    .skills-header p {
        font-size: 1.3rem;
        color: #5a5f4b;
        max-width: 700px;
        margin: 0 auto;
        border-left: 4px solid var(--clay);
        padding-left: 1.6rem;
    }
    
    .skills-category {
        margin-bottom: 4rem;
    }
    
    .category-title {
        font-size: 2.2rem;
        font-weight: 700;
        color: var(--moss);
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        border-bottom: 2px dashed var(--clay-light);
        padding-bottom: 0.8rem;
    }
    
    .category-title i {
        color: var(--clay);
        font-size: 2rem;
    }
    
    .quote-section {
        background: rgba(227, 219, 207, 0.3);
        border-radius: 80px 20px 80px 20px;
        padding: 4rem;
        margin: 4rem 0;
        text-align: center;
        border: 1px solid rgba(193, 123, 92, 0.25);
    }
    
    .quote-section i {
        font-size: 3rem;
        color: var(--clay-light);
        margin-bottom: 1rem;
    }
    
    .quote-text {
        font-size: 1.8rem;
        font-style: italic;
        color: var(--moss-deep);
        max-width: 800px;
        margin: 0 auto 1rem;
        font-family: 'Tiro Devanagari Sanskrit', serif;
    }
    
    .quote-author {
        color: var(--clay);
        font-weight: 600;
    }
    
    .skills-matrix {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }
    
    .skill-card {
        background: rgba(255, 247, 240, 0.5);
        border: 1px solid rgba(193, 123, 92, 0.25);
        border-radius: 50px 20px 50px 20px;
        padding: 2rem 1.5rem;
        transition: all 0.3s;
        display: flex;
        flex-direction: column;
    }
    
    .skill-card:hover {
        background: white;
        transform: translateY(-5px);
        border-color: var(--clay);
        box-shadow: var(--shadow-warm);
    }
    
    .skill-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .skill-icon {
        width: 60px;
        height: 60px;
        background: var(--ash);
        border-radius: 30% 50% 30% 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--moss);
        font-size: 2rem;
    }
    
    .skill-name {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--moss-deep);
    }
    
    .skill-proficiency {
        margin-bottom: 1rem;
    }
    
    .proficiency-label {
        display: flex;
        justify-content: space-between;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        color: var(--moss);
    }
    
    .proficiency-bar {
        height: 8px;
        background: var(--clay-light);
        border-radius: 4px;
        overflow: hidden;
    }
    
    .proficiency-fill {
        height: 100%;
        background: var(--moss);
        border-radius: 4px;
        width: 0;
        transition: width 1s ease;
    }
    
    .skill-card:hover .proficiency-fill {
        background: var(--clay);
    }
    
    @media (max-width: 768px) {
        .skills-header h1 { font-size: 3rem; }
        .quote-text { font-size: 1.4rem; }
    }
</style>
@endpush

@section('content')
@php
    $skillsByCategory = \App\Models\Skill::where('is_published', true)
        ->orderBy('category')
        ->orderBy('sort_order')
        ->orderBy('proficiency', 'desc')
        ->get()
        ->groupBy('category');
        
    $categoryIcons = [
        'frontend' => 'fas fa-code',
        'backend' => 'fas fa-server',
        'database' => 'fas fa-database',
        'devops' => 'fas fa-cloud',
        'tools' => 'fas fa-tools',
        'design' => 'fas fa-paint-brush',
        'soft' => 'fas fa-handshake',
    ];
    
    $totalSkills = \App\Models\Skill::where('is_published', true)->count();
@endphp

<div class="container">
    <div class="skills-header">
        <h1>{{ theme_setting('skills_page_title', 'toolshed') }}</h1>
        <p>{{ theme_setting('skills_subtitle', 'Tools I\'ve worn down, sharpened, and learned to trust. Some are new, some are heirlooms.') }}</p>
    </div>
    
    @if($skillsByCategory->count() > 0)
        @foreach($skillsByCategory as $category => $skills)
            <div class="skills-category">
                <div class="category-title">
                    <i class="{{ $categoryIcons[$category] ?? 'fas fa-code' }}"></i>
                    <span>{{ ucfirst($category) }}</span>
                </div>
                
                <!-- Use the skills partial but with all skills -->
                <div class="skills-matrix">
                    @foreach($skills as $skill)
                        <div class="skill-card">
                            <div class="skill-header">
                                <div class="skill-icon">
                                    @if($skill->icon)
                                        <i class="{{ $skill->icon }}"></i>
                                    @else
                                        <i class="fas fa-code"></i>
                                    @endif
                                </div>
                                <div class="skill-name">{{ $skill->name }}</div>
                            </div>
                            
                            @if($skill->proficiency)
                                <div class="skill-proficiency">
                                    <div class="proficiency-label">
                                        <span>{{ theme_setting('proficiency_label', 'familiarity') }}</span>
                                        <span>{{ $skill->proficiency }}%</span>
                                    </div>
                                    <div class="proficiency-bar">
                                        <div class="proficiency-fill" style="width: {{ $skill->proficiency }}%;"></div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
        
        <div class="quote-section">
            <i class="fas fa-quote-left"></i>
            <p class="quote-text">{{ theme_setting('skills_quote', 'A good farmer knows their tools not by their brand, but by the weight in their hand.') }}</p>
            <p class="quote-author">{{ theme_setting('skills_quote_author', '— Nepali farming wisdom') }}</p>
        </div>
        
        <div class="text-center" style="margin: 4rem 0;">
            <span class="footer-commitment">
                <i class="fas fa-trowel"></i> {{ $totalSkills }} {{ Str::plural('tool', $totalSkills) }} {{ theme_setting('tools_ready_text', 'ready for the field') }}
            </span>
        </div>
    @else
        <div class="empty-state">
            <i class="fas fa-tools"></i>
            <h3>{{ theme_setting('skills_empty_title', 'tools are being sharpened') }}</h3>
            <p>{{ theme_setting('skills_empty_message', 'Check back soon for the full toolshed.') }}</p>
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const bars = document.querySelectorAll('.proficiency-fill');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.width = entry.target.style.width;
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.2 });
    
    bars.forEach(bar => observer.observe(bar));
});
</script>
@endsection