@extends('layouts.app')

@section('title', $project->case_study_title ?? $project->title . ' · Case Study')
@section('description', 'An in-depth look at the ' . $project->title . ' project')

@push('styles')
<style>
    .case-study-hero {
        background: linear-gradient(145deg, rgba(193, 123, 92, 0.1), rgba(76, 107, 74, 0.1));
        padding: 4rem 0;
        margin-bottom: 3rem;
        border-radius: 0 0 100px 20px 100px 20px;
        position: relative;
        overflow: hidden;
    }
    
    .case-study-hero::before {
        content: '';
        position: absolute;
        top: -100px;
        right: -100px;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(193, 123, 92, 0.2) 0%, transparent 70%);
        border-radius: 50%;
    }
    
    .case-study-hero-content {
        position: relative;
        z-index: 2;
    }
    
    .case-study-title {
        font-size: 3.5rem;
        font-weight: 800;
        color: var(--moss-deep);
        margin-bottom: 1rem;
        font-family: 'Playfair Display', serif;
    }
    
    .case-study-meta {
        display: flex;
        gap: 2rem;
        margin: 2rem 0;
        flex-wrap: wrap;
    }
    
    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }
    
    .meta-icon {
        width: 45px;
        height: 45px;
        background: white;
        border-radius: 30% 50% 30% 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--clay);
        font-size: 1.2rem;
        border: 1px solid var(--clay-light);
    }
    
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--moss);
        text-decoration: none;
        font-weight: 600;
        margin-bottom: 2rem;
        transition: all 0.3s;
    }
    
    .back-link:hover {
        color: var(--clay);
        gap: 1rem;
    }
    
    .case-study-section {
        max-width: 900px;
        margin: 4rem auto;
        padding: 2rem;
        background: white;
        border-radius: 80px 20px 80px 20px;
        border: 1px solid var(--clay-light);
        box-shadow: var(--shadow-warm);
    }
    
    .section-heading {
        font-size: 2rem;
        font-weight: 700;
        color: var(--moss-deep);
        margin-bottom: 2rem;
        font-family: 'Playfair Display', serif;
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .section-heading i {
        color: var(--clay);
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        margin: 3rem 0;
    }
    
    .stat-block {
        text-align: center;
        padding: 2rem;
        background: rgba(193, 123, 92, 0.05);
        border-radius: 60px 20px 60px 20px;
        border: 1px solid var(--clay-light);
    }
    
    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--clay);
        margin-bottom: 0.5rem;
    }
    
    .stat-label {
        color: var(--moss-deep);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.9rem;
    }
    
    .testimonial-box {
        background: linear-gradient(145deg, var(--moss), var(--moss-deep));
        color: white;
        padding: 3rem;
        border-radius: 100px 20px 100px 20px;
        margin: 4rem 0;
        position: relative;
    }
    
    .testimonial-box::before {
        content: '"';
        position: absolute;
        top: 20px;
        left: 30px;
        font-size: 8rem;
        opacity: 0.2;
        font-family: serif;
    }
    
    .testimonial-text {
        font-size: 1.3rem;
        font-style: italic;
        line-height: 1.8;
        margin-bottom: 1rem;
    }
    
    .testimonial-author {
        text-align: right;
        font-weight: 600;
        color: var(--clay-light);
    }
    
    .btn-case-study {
        background: var(--clay);
        color: white;
        padding: 1rem 2.5rem;
        border-radius: 60px 20px 60px 20px;
        display: inline-flex;
        align-items: center;
        gap: 1rem;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
    }
    
    .btn-case-study:hover {
        background: var(--moss);
        transform: translateY(-3px);
        box-shadow: 0 10px 20px -5px var(--clay);
    }
    
    @media (max-width: 768px) {
        .case-study-title { font-size: 2.5rem; }
        .stats-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
<div class="case-study-hero">
    <div class="container case-study-hero-content">
        <a href="{{ route('projects.show', $project->slug) }}" class="back-link">
            <i class="fas fa-arrow-left"></i> back to project
        </a>
        
        <h1 class="case-study-title">{{ $project->case_study_title ?? $project->title . ': A Case Study' }}</h1>
        
        <div class="case-study-meta">
            @if($project->duration)
            <div class="meta-item">
                <div class="meta-icon"><i class="fas fa-clock"></i></div>
                <div>
                    <strong>Duration</strong><br>
                    {{ $project->duration }}
                </div>
            </div>
            @endif
            
            @if($project->team_size)
            <div class="meta-item">
                <div class="meta-icon"><i class="fas fa-users"></i></div>
                <div>
                    <strong>Team Size</strong><br>
                    {{ $project->team_size }}
                </div>
            </div>
            @endif
            
            @if($project->client)
            <div class="meta-item">
                <div class="meta-icon"><i class="fas fa-building"></i></div>
                <div>
                    <strong>Client</strong><br>
                    {{ $project->client }}
                </div>
            </div>
            @endif
            
            @if($project->role)
            <div class="meta-item">
                <div class="meta-icon"><i class="fas fa-user-tie"></i></div>
                <div>
                    <strong>My Role</strong><br>
                    {{ $project->role }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="container">
    @if($project->challenge || $project->solution || $project->results)
    <div class="stats-grid">
        @if($project->challenge)
        <div class="stat-block">
            <div class="stat-number"><i class="fas fa-question"></i></div>
            <div class="stat-label">The Challenge</div>
            <p style="margin-top: 1rem;">{{ $project->challenge }}</p>
        </div>
        @endif
        
        @if($project->solution)
        <div class="stat-block">
            <div class="stat-number"><i class="fas fa-lightbulb"></i></div>
            <div class="stat-label">The Solution</div>
            <p style="margin-top: 1rem;">{{ $project->solution }}</p>
        </div>
        @endif
        
        @if($project->results)
        <div class="stat-block">
            <div class="stat-number"><i class="fas fa-chart-line"></i></div>
            <div class="stat-label">The Results</div>
            <p style="margin-top: 1rem;">{{ $project->results }}</p>
        </div>
        @endif
    </div>
    @endif
    
    @if($project->case_study_content)
    <div class="case-study-section">
        <div class="section-heading">
            <i class="fas fa-book-open"></i>
            <span>The Full Story</span>
        </div>
        <div class="project-content">
            {!! $project->case_study_content !!}
        </div>
    </div>
    @endif
    
    @if($project->testimonial)
    <div class="testimonial-box">
        <div class="testimonial-text">"{{ $project->testimonial }}"</div>
        @if($project->testimonial_author)
        <div class="testimonial-author">— {{ $project->testimonial_author }}</div>
        @endif
    </div>
    @endif
    
    @if($project->project_url || $project->github_url)
    <div style="text-align: center; margin: 4rem 0;">
        <h3 style="font-size: 2rem; color: var(--moss-deep); margin-bottom: 2rem;">Want to see more?</h3>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            @if($project->project_url)
            <a href="{{ $project->project_url }}" target="_blank" class="btn-case-study">
                <i class="fas fa-external-link-alt"></i> View Live Project
            </a>
            @endif
            @if($project->github_url)
            <a href="{{ $project->github_url }}" target="_blank" class="btn-case-study" style="background: var(--moss);">
                <i class="fab fa-github"></i> View Source Code
            </a>
            @endif
        </div>
    </div>
    @endif
</div>
@endsection