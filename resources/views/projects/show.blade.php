@extends('layouts.app')

@section('title', $project->title . ' · ' . theme_setting('site_title', 'Umesh Ghimire'))
@section('description', $project->description)

@push('styles')
<style>
    .project-detail-header {
        padding: 2rem 0 3rem;
    }
    
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--moss);
        text-decoration: none;
        font-weight: 600;
        margin-bottom: 2rem;
        border-bottom: 2px dotted var(--clay);
        padding-bottom: 0.3rem;
        transition: all 0.3s;
    }
    
    .back-link:hover {
        color: var(--clay);
        gap: 1rem;
    }
    
    .project-detail-title {
        font-size: 4rem;
        font-weight: 800;
        color: var(--moss-deep);
        line-height: 1.1;
        margin-bottom: 1rem;
    }
    
    .project-detail-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        margin: 2rem 0 3rem;
        padding: 1.5rem 0;
        border-top: 1px solid var(--clay-light);
        border-bottom: 1px solid var(--clay-light);
    }
    
    .meta-item {
        display: flex;
        flex-direction: column;
    }
    
    .meta-label {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: var(--clay);
        font-weight: 700;
    }
    
    .meta-value {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--moss-deep);
    }
    
    .project-detail-grid {
        display: grid;
        grid-template-columns: 1fr 0.8fr;
        gap: 3rem;
        margin: 3rem 0;
    }
    
    .project-detail-image {
        background: linear-gradient(145deg, #dbb8a2, #b28b74);
        border-radius: 52% 48% 70% 30% / 46% 52% 48% 54%;
        overflow: hidden;
        aspect-ratio: 1/1;
        animation: liquidMorph 15s infinite alternate;
        box-shadow: 0 30px 40px -12px rgba(110, 70, 50, 0.25);
        border: 6px solid rgba(255, 250, 240, 0.6);
    }
    
    .project-detail-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    
    .project-detail-image:hover img {
        transform: scale(1.05);
    }
    
    .project-detail-tech {
        display: flex;
        flex-wrap: wrap;
        gap: 0.8rem;
        margin: 2rem 0;
    }
    
    .tech-badge {
        background: var(--ash);
        padding: 0.5rem 1.5rem;
        border-radius: 40px 12px 40px 12px;
        font-weight: 600;
        color: var(--moss-deep);
        border: 1px solid var(--clay-light);
        transition: all 0.3s;
    }
    
    .tech-badge:hover {
        background: var(--clay);
        color: white;
        border-color: var(--clay);
    }
    
    .project-links {
        display: flex;
        gap: 1.5rem;
        margin: 2rem 0;
    }
    
    .project-navigation {
        display: flex;
        justify-content: space-between;
        margin: 4rem 0;
    }
    
    .nav-prev,
    .nav-next {
        display: flex;
        align-items: center;
        gap: 1rem;
        text-decoration: none;
        color: var(--moss-deep);
        transition: all 0.3s;
        max-width: 300px;
    }
    
    .nav-prev:hover {
        transform: translateX(-10px);
        color: var(--clay);
    }
    
    .nav-next:hover {
        transform: translateX(10px);
        color: var(--clay);
    }
    
    .nav-label {
        font-size: 0.85rem;
        color: var(--clay);
    }
    
    .nav-title {
        font-weight: 700;
    }
    
    @media (max-width: 900px) {
        .project-detail-title { font-size: 3rem; }
        .project-detail-grid { grid-template-columns: 1fr; }
        .project-links { flex-direction: column; }
    }
</style>
@endpush

@section('content')
@php
    $prevProject = \App\Models\Project::where('is_published', true)
        ->where('created_at', '<', $project->created_at)
        ->orderBy('created_at', 'desc')
        ->first();
    
    $nextProject = \App\Models\Project::where('is_published', true)
        ->where('created_at', '>', $project->created_at)
        ->orderBy('created_at', 'asc')
        ->first();
    
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

<div class="container project-detail-header">
    <a href="{{ route('projects.index') }}" class="back-link">
        <i class="fas fa-arrow-left"></i> {{ theme_setting('back_to_projects_text', 'back to fields') }}
    </a>
    
    <h1 class="project-detail-title">{{ $project->title }}</h1>
    
    <div class="project-detail-meta">
        <div class="meta-item">
            <span class="meta-label">{{ theme_setting('harvested_label', 'harvested') }}</span>
            <span class="meta-value">{{ $year }}</span>
        </div>
        
        @if($project->client)
        <div class="meta-item">
            <span class="meta-label">{{ theme_setting('client_label', 'client') }}</span>
            <span class="meta-value">{{ $project->client }}</span>
        </div>
        @endif
        
        @if($project->role)
        <div class="meta-item">
            <span class="meta-label">{{ theme_setting('role_label', 'role') }}</span>
            <span class="meta-value">{{ $project->role }}</span>
        </div>
        @endif
    </div>
    
    <div class="project-detail-grid">
        <div>
            <h2 style="font-size: 2rem; font-weight: 700; color: var(--moss-deep); margin-bottom: 1.5rem;">
                {{ theme_setting('story_label', 'the story') }}
            </h2>
            <div style="line-height: 1.8; color: #3f4d45; margin-bottom: 2rem;">
                {!! nl2br(e($project->description)) !!}
            </div>
            
            @if($project->content)
            <div style="line-height: 1.8; color: #3f4d45;">
                {!! $project->content !!}
            </div>
            @endif
            
            @if(count($techs) > 0)
            <div style="margin-top: 2rem;">
                <h3 style="font-size: 1.5rem; font-weight: 700; color: var(--moss-deep); margin-bottom: 1rem;">
                    {{ theme_setting('tools_label', 'tools & techniques') }}
                </h3>
                <div class="project-detail-tech">
                    @foreach($techs as $tech)
                        <span class="tech-badge">{{ $tech }}</span>
                    @endforeach
                </div>
            </div>
            @endif
            
            <div class="project-links">
                @if($project->project_url)
                    <a href="{{ $project->project_url }}" target="_blank" class="btn btn-clay">
                        <i class="fas fa-external-link-alt"></i> {{ theme_setting('live_demo_text', 'live demo') }}
                    </a>
                @endif
                
                @if($project->github_url)
                    <a href="{{ $project->github_url }}" target="_blank" class="btn btn-outline">
                        <i class="fab fa-github"></i> {{ theme_setting('source_code_text', 'source code') }}
                    </a>
                @endif
            </div>
        </div>
        
        <div>
            <div class="project-detail-image">
                @if($projectImage)
                    <img src="{{ $projectImage }}" alt="{{ $project->title }}">
                @else
                    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: linear-gradient(145deg, var(--clay-light), var(--clay));">
                        <i class="fas fa-code" style="font-size: 8rem; color: white; opacity: 0.8;"></i>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    @if($project->gallery && count($project->gallery) > 0)
    <div style="margin: 4rem 0;">
        <h2 style="font-size: 2rem; font-weight: 700; color: var(--moss-deep); margin-bottom: 2rem;">
            {{ theme_setting('gallery_label', 'project gallery') }}
        </h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1.5rem;">
            @foreach($project->gallery as $image)
                <div style="border-radius: 40px 12px 40px 12px; overflow: hidden; aspect-ratio: 1/1; border: 3px solid var(--clay-light);">
                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $project->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            @endforeach
        </div>
    </div>
    @endif
    
    @if($prevProject || $nextProject)
    <div class="project-navigation">
        @if($prevProject)
        <a href="{{ route('projects.show', $prevProject->slug) }}" class="nav-prev">
            <i class="fas fa-arrow-left" style="color: var(--clay);"></i>
            <div>
                <div class="nav-label">{{ theme_setting('previous_label', 'previous') }}</div>
                <div class="nav-title">{{ $prevProject->title }}</div>
            </div>
        </a>
        @else
        <div></div>
        @endif
        
        @if($nextProject)
        <a href="{{ route('projects.show', $nextProject->slug) }}" class="nav-next">
            <div style="text-align: right;">
                <div class="nav-label">{{ theme_setting('next_label', 'next') }}</div>
                <div class="nav-title">{{ $nextProject->title }}</div>
            </div>
            <i class="fas fa-arrow-right" style="color: var(--clay);"></i>
        </a>
        @endif
    </div>
    @endif
</div>
@endsection