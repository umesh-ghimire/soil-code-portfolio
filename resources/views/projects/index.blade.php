@extends('layouts.app')

@section('title', theme_setting('projects_page_title', 'cultivated projects · Umesh Ghimire'))
@section('description', theme_setting('projects_meta_description', 'A curated collection of projects built with patience, respect, and generational wisdom.'))

@push('styles')
<style>
    .projects-header {
        padding: clamp(2rem, 5vw, 3rem) 0;
        text-align: center;
    }
    
    .projects-header h1 {
        font-size: clamp(2.5rem, 8vw, 4rem);
        font-weight: 800;
        color: var(--moss-deep);
        margin-bottom: 1rem;
        line-height: 1.2;
    }
    
    .projects-header .subtitle {
        font-size: clamp(1rem, 3vw, 1.3rem);
        color: #5a5f4b;
        max-width: min(700px, 90%);
        margin: 0 auto;
        border-left: 4px solid var(--clay);
        padding-left: clamp(1rem, 3vw, 1.6rem);
    }
    
    .projects-stats {
        display: flex;
        justify-content: center;
        gap: clamp(1.5rem, 5vw, 3rem);
        margin: clamp(2rem, 5vw, 3rem) 0;
        padding: clamp(1rem, 3vw, 1.5rem);
        background: rgba(227, 219, 207, 0.3);
        border-radius: 60px 20px 60px 20px;
        border: 1px solid rgba(193, 123, 92, 0.25);
        flex-wrap: wrap;
    }
    
    .stat-item {
        text-align: center;
    }
    
    .stat-number {
        font-size: clamp(1.5rem, 4vw, 2rem);
        font-weight: 800;
        color: var(--clay);
        line-height: 1;
    }
    
    .stat-label {
        font-size: clamp(0.8rem, 2vw, 0.9rem);
        color: var(--moss-deep);
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .projects-grid-full {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(min(300px, 100%), 1fr));
        gap: clamp(1.5rem, 4vw, 2.5rem);
        margin: clamp(2rem, 5vw, 3rem) 0;
    }
    
    .project-card {
        background: rgba(255, 247, 240, 0.7);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(193, 123, 92, 0.25);
        border-radius: 50px 20px 50px 20px;
        padding: clamp(1.2rem, 3vw, 1.5rem);
        transition: all 0.35s;
        box-shadow: var(--shadow-warm);
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    
    .project-card:hover {
        background: white;
        border-radius: 30px 60px 30px 60px;
        border-color: var(--clay);
        transform: translateY(-10px) rotate(0.5deg);
    }
    
    .project-image-container {
        height: clamp(160px, 25vw, 200px);
        margin-bottom: clamp(1rem, 2.5vw, 1.5rem);
        border-radius: 20px 5px 20px 5px;
        overflow: hidden;
        background: linear-gradient(135deg, rgba(193, 123, 92, 0.1), rgba(76, 107, 74, 0.1));
        position: relative;
    }
    
    .project-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    
    .project-card:hover .project-image {
        transform: scale(1.05);
    }
    
    .project-image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(145deg, var(--clay-light), var(--clay));
        color: white;
        font-size: clamp(2rem, 5vw, 3rem);
    }
    
    .project-featured-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: var(--clay);
        color: white;
        padding: 0.2rem 1rem;
        border-radius: 30px 8px 30px 8px;
        font-size: 0.75rem;
        font-weight: 600;
        z-index: 2;
    }
    
    .project-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(1.2rem, 3vw, 1.5rem);
        color: var(--moss-deep);
        margin-bottom: 0.8rem;
        line-height: 1.3;
    }
    
    .project-description {
        color: #5a5f4b;
        margin-bottom: 1rem;
        line-height: 1.6;
        font-size: clamp(0.9rem, 2.2vw, 0.95rem);
        flex: 1;
    }
    
    .project-tech {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }
    
    .tech-tag {
        background: var(--ash);
        padding: 0.3rem 1rem;
        border-radius: 30px 8px 30px 8px;
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--moss-deep);
        border: 1px solid var(--clay-light);
    }
    
    .project-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
        padding-top: 1rem;
        border-top: 1px dashed var(--clay-light);
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    
    .project-link {
        font-weight: 700;
        color: var(--clay);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
        font-size: clamp(0.9rem, 2.2vw, 0.95rem);
    }
    
    .project-link:hover {
        color: var(--moss);
        gap: 10px;
    }
    
    .project-date {
        font-size: 0.85rem;
        color: #8a9d8a;
    }
    
    .pagination-container {
        display: flex;
        justify-content: center;
        margin: 4rem 0;
    }
    
    .pagination {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        justify-content: center;
    }
    
    .pagination-item {
        width: clamp(40px, 8vw, 45px);
        height: clamp(40px, 8vw, 45px);
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        border: 1px solid var(--clay-light);
        border-radius: 30% 50% 30% 50%;
        color: var(--ink);
        text-decoration: none;
        transition: all 0.3s;
        font-size: clamp(0.9rem, 2vw, 1rem);
    }
    
    .pagination-item:hover,
    .pagination-item.active {
        background: var(--clay);
        color: white;
        border-color: var(--clay);
        transform: scale(1.1);
    }
    
    .footer-commitment {
        display: inline-flex;
        align-items: center;
        gap: 0.8rem;
        background: white;
        padding: 0.7rem 1.5rem;
        border-radius: 50px 12px 50px 12px;
        border: 1px solid rgba(193, 123, 92, 0.5);
        font-size: 0.95rem;
        color: var(--moss-deep);
        margin: 2rem auto;
    }
    
    @media (max-width: 768px) {
        .projects-header h1 {
            font-size: 2.5rem;
        }
        
        .projects-grid-full {
            grid-template-columns: repeat(auto-fill, minmax(min(250px, 100%), 1fr));
        }
        
        .project-footer {
            flex-direction: column;
            align-items: flex-start;
        }
    }
    
    @media (max-width: 480px) {
        .projects-header h1 {
            font-size: 2rem;
        }
        
        .projects-stats {
            flex-direction: column;
            gap: 1rem;
            align-items: center;
        }
        
        .projects-grid-full {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
@php
    $projects = \App\Models\Project::where('is_published', true)
        ->orderBy('is_featured', 'desc')
        ->orderBy('sort_order')
        ->orderBy('created_at', 'desc')
        ->paginate(9);
    
    $totalProjects = \App\Models\Project::where('is_published', true)->count();
    $featuredCount = \App\Models\Project::where('is_published', true)->where('is_featured', true)->count();
    
    // Collect all unique technologies
    $allTechnologies = collect();
    foreach ($projects as $project) {
        if ($project->technologies) {
            $techs = is_string($project->technologies) 
                ? array_map('trim', explode(',', $project->technologies)) 
                : ($project->technologies ?? []);
            foreach ($techs as $tech) {
                $allTechnologies->push($tech);
            }
        }
    }
    $uniqueTechnologies = $allTechnologies->unique();
@endphp

<div class="container">
    <div class="projects-header">
        <h1>{{ theme_setting('projects_page_title', 'cultivated projects') }}</h1>
        <p class="subtitle">{{ theme_setting('projects_page_subtitle', 'Each project is a seed planted, watered, and tended with care. Here\'s the harvest.') }}</p>
    </div>
    
    <div class="projects-stats">
        <div class="stat-item">
            <div class="stat-number">{{ $totalProjects }}</div>
            <div class="stat-label">{{ theme_setting('total_projects_label', 'total projects') }}</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $featuredCount }}</div>
            <div class="stat-label">{{ theme_setting('featured_label', 'featured') }}</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $uniqueTechnologies->count() }}+</div>
            <div class="stat-label">{{ theme_setting('technologies_label', 'technologies') }}</div>
        </div>
    </div>
    
    @if($projects->count() > 0)
    <div class="projects-grid-full">
        @foreach($projects as $project)
            @php
                $techs = [];
                if ($project->technologies) {
                    if (is_string($project->technologies)) {
                        $techs = array_map('trim', explode(',', $project->technologies));
                    } elseif (is_array($project->technologies)) {
                        $techs = $project->technologies;
                    }
                }
                
                $projectImage = null;
                if ($project->featured_image) {
                    $projectImage = asset('storage/' . $project->featured_image);
                }
                
                $year = $project->created_at ? $project->created_at->format('Y') : date('Y');
            @endphp
            <div class="project-card">
                <div class="project-image-container">
                    @if($projectImage)
                        <img src="{{ $projectImage }}" alt="{{ $project->title }}" class="project-image" loading="lazy">
                    @else
                        <div class="project-image-placeholder">
                            <i class="fas fa-code-branch"></i>
                        </div>
                    @endif
                    @if($project->is_featured)
                        <span class="project-featured-badge">
                            <i class="fas fa-star"></i> featured
                        </span>
                    @endif
                </div>
                
                <div class="project-content">
                    <h3 class="project-title">{{ $project->title }}</h3>
                    <p class="project-description">{{ Str::limit($project->description, 100) }}</p>
                    
                    @if(count($techs) > 0)
                    <div class="project-tech">
                        @foreach(array_slice($techs, 0, 3) as $tech)
                            <span class="tech-tag">{{ $tech }}</span>
                        @endforeach
                        @if(count($techs) > 3)
                            <span class="tech-tag">+{{ count($techs) - 3 }}</span>
                        @endif
                    </div>
                    @endif
                    
                    <div class="project-footer">
                        <a href="{{ route('projects.show', $project->slug) }}" class="project-link">
                            <span>{{ theme_setting('project_link_text', 'read case study') }}</span>
                            <span class="project-link-arrow">→</span>
                        </a>
                        <span class="project-date">{{ $year }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <div class="pagination-container">
        {{ $projects->links('pagination::default') }}
    </div>
    @else
    <div class="empty-state">
        <i class="fas fa-seedling"></i>
        <h3>{{ theme_setting('no_projects_title', 'no projects yet') }}</h3>
        <p>{{ theme_setting('no_projects_message', 'Projects are being cultivated. Check back soon!') }}</p>
    </div>
    @endif
    
    <div class="text-center">
        <span class="footer-commitment">
            <i class="fas fa-seedling"></i> {{ theme_setting('more_projects_text', 'more projects are germinating') }}
        </span>
    </div>
</div>
@endsection