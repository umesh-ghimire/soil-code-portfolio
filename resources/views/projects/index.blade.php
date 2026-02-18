 
@extends('layouts.app')

@section('title', theme_setting('projects_page_title', 'cultivated projects · Umesh Ghimire'))
@section('description', theme_setting('projects_meta_description', 'A curated collection of projects built with patience, respect, and generational wisdom.'))

@push('styles')
<style>
    .projects-header {
        padding: 3rem 0 2rem;
        text-align: center;
    }
    
    .projects-header h1 {
        font-size: 4rem;
        font-weight: 800;
        color: var(--moss-deep);
        margin-bottom: 1rem;
    }
    
    .projects-header .subtitle {
        font-size: 1.3rem;
        color: #5a5f4b;
        max-width: 700px;
        margin: 0 auto;
        border-left: 4px solid var(--clay);
        padding-left: 1.6rem;
    }
    
    .projects-stats {
        display: flex;
        justify-content: center;
        gap: 3rem;
        margin: 3rem 0;
        padding: 1.5rem;
        background: rgba(227, 219, 207, 0.3);
        border-radius: 60px 20px 60px 20px;
        border: 1px solid rgba(193, 123, 92, 0.25);
        flex-wrap: wrap;
    }
    
    .stat-item {
        text-align: center;
    }
    
    .stat-number {
        font-size: 2rem;
        font-weight: 800;
        color: var(--clay);
        line-height: 1;
    }
    
    .stat-label {
        font-size: 0.9rem;
        color: var(--moss-deep);
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .projects-grid-full {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 2.5rem;
        margin: 3rem 0;
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
    }
    
    .pagination-item {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        border: 1px solid var(--clay-light);
        border-radius: 30% 50% 30% 50%;
        color: var(--ink);
        text-decoration: none;
        transition: all 0.3s;
    }
    
    .pagination-item:hover,
    .pagination-item.active {
        background: var(--clay);
        color: white;
        border-color: var(--clay);
        transform: scale(1.1);
    }
    
    @media (max-width: 768px) {
        .projects-header h1 { font-size: 3rem; }
        .projects-grid-full { grid-template-columns: 1fr; }
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
                        <img src="{{ $projectImage }}" alt="{{ $project->title }}" class="project-image">
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
        {{ $projects->links() }}
    </div>
    @else
    <div class="empty-state">
        <i class="fas fa-seedling"></i>
        <h3>{{ theme_setting('no_projects_title', 'no projects yet') }}</h3>
        <p>{{ theme_setting('no_projects_message', 'Projects are being cultivated. Check back soon!') }}</p>
    </div>
    @endif
    
    <div class="text-center" style="margin: 4rem 0;">
        <span class="footer-commitment">
            <i class="fas fa-seedling"></i> {{ theme_setting('more_projects_text', 'more projects are germinating') }}
        </span>
    </div>
</div>
@endsection