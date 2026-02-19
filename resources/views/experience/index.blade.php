@extends('layouts.app')

@section('title', theme_setting('experience_page_title', 'roots & branches · Umesh Ghimire'))
@section('description', theme_setting('experience_meta_description', 'My professional journey through seasons of growth, learning, and building.'))

@push('styles')
<style>
    .experience-header {
        padding: 3rem 0 2rem;
        text-align: center;
    }
    
    .experience-header h1 {
        font-size: 4rem;
        font-weight: 800;
        color: var(--moss-deep);
        margin-bottom: 1rem;
    }
    
    .experience-header p {
        font-size: 1.3rem;
        color: #5a5f4b;
        max-width: 700px;
        margin: 0 auto;
        border-left: 4px solid var(--clay);
        padding-left: 1.6rem;
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 2rem;
        margin: 4rem 0;
    }
    
    .stat-card {
        background: rgba(255, 247, 240, 0.7);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(193, 123, 92, 0.25);
        border-radius: 60px 20px 60px 20px;
        padding: 2rem;
        text-align: center;
        box-shadow: var(--shadow-warm);
        transition: all 0.3s;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        border-color: var(--clay);
    }
    
    .stat-number {
        font-size: 3rem;
        font-weight: 800;
        color: var(--clay);
        line-height: 1;
        margin-bottom: 0.5rem;
    }
    
    .stat-label {
        color: var(--moss-deep);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 0.9rem;
    }
    
    .quote-section {
        background: rgba(227, 219, 207, 0.3);
        border-radius: 100px 20px 100px 20px;
        padding: 4rem;
        margin: 5rem 0;
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
    
    .cta-section {
        background: var(--moss);
        border-radius: 100px 20px 100px 20px;
        padding: 4rem;
        text-align: center;
        color: white;
        margin: 5rem 0;
    }
    
    .cta-section h2 {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
    }
    
    .cta-section .btn {
        background: white;
        color: var(--moss);
        margin: 0 0.5rem;
    }
    
    .cta-section .btn:hover {
        background: var(--clay);
        color: white;
    }
    
    @media (max-width: 768px) {
        .experience-header h1 { font-size: 3rem; }
        .cta-section h2 { font-size: 2rem; }
    }
</style>
@endpush

@section('content')
@php
    $experiences = \App\Models\Experience::where('is_published', true)
        ->orderBy('start_date', 'desc')
        ->get();
    
    $profile = \App\Models\Profile::first();
    
    // Calculate total experience
    $totalMonths = 0;
    foreach ($experiences as $exp) {
        $end = $exp->is_current ? now() : ($exp->end_date ? \Carbon\Carbon::parse($exp->end_date) : now());
        $start = \Carbon\Carbon::parse($exp->start_date);
        $totalMonths += $start->diffInMonths($end);
    }
    $totalYears = floor($totalMonths / 12);
    $remainingMonths = $totalMonths % 12;
    
    $companies = $experiences->pluck('company')->unique()->count();
    $roles = $experiences->count();
    $currentRole = $experiences->where('is_current', true)->first();
@endphp

<div class="container">
    <div class="experience-header">
        <h1>{{ theme_setting('experience_page_title', 'roots & branches') }}</h1>
        <p>{{ theme_setting('experience_subtitle', 'A journey through seasons of growth, from first lines of code to community-built systems.') }}</p>
    </div>
    
    @if($experiences->count() > 0)
        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">{{ $totalYears }}<span style="font-size: 1.5rem;">y</span> @if($remainingMonths > 0) <span style="font-size: 1.2rem;">{{ $remainingMonths }}m</span> @endif</div>
                <div class="stat-label">{{ theme_setting('total_experience_label', 'total seasons') }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $companies }}</div>
                <div class="stat-label">{{ theme_setting('companies_label', 'organizations') }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $roles }}</div>
                <div class="stat-label">{{ theme_setting('roles_label', 'roles tended') }}</div>
            </div>
            @if($currentRole)
            <div class="stat-card">
                <div class="stat-number" style="font-size: 1.5rem;">{{ Str::limit($currentRole->title, 20) }}</div>
                <div class="stat-label">{{ theme_setting('current_role_label', 'current field') }}</div>
            </div>
            @endif
        </div>
        
        <!-- Timeline -->
        <div class="timeline-organic">
            @include('partials.experience')
        </div>
        
        <!-- Quote Section -->
        <div class="quote-section">
            <i class="fas fa-quote-left"></i>
            <p class="quote-text">{{ theme_setting('experience_quote', 'The strongest roots grow slowly, reaching deep into the soil before breaking through to the sun.') }}</p>
            <p class="quote-author">— {{ theme_setting('experience_quote_author', 'Nepali farming wisdom') }}</p>
        </div>
        
        <!-- Download Resume CTA -->
        @if($profile && $profile->resume_file)
            <div class="cta-section">
                <h2>{{ theme_setting('resume_cta_title', 'want to dig deeper?') }}</h2>
                <p style="margin-bottom: 2rem;">{{ theme_setting('resume_cta_text', 'Download my complete resume with all the details.') }}</p>
                <div>
                    <a href="{{ asset('storage/' . $profile->resume_file) }}" target="_blank" class="btn btn-clay">
                        <i class="fas fa-file-pdf"></i> {{ theme_setting('resume_button_text', 'download resume') }}
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-outline">
                        <i class="fas fa-envelope"></i> {{ theme_setting('contact_button_text', 'get in touch') }}
                    </a>
                </div>
            </div>
        @endif
        
        <!-- Final CTA -->
        <div style="text-align: center; margin: 4rem 0;">
            <h2 style="font-size: 2.2rem; font-weight: 700; color: var(--moss-deep); margin-bottom: 1.5rem;">
                {{ theme_setting('final_cta_title', 'ready to grow together?') }}
            </h2>
            <div style="display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('projects.index') }}" class="btn btn-outline">
                    <i class="fas fa-asterisk"></i> {{ theme_setting('view_projects_text', 'view projects') }}
                </a>
                <a href="{{ route('contact.index') }}" class="btn btn-clay">
                    <i class="fas fa-seedling"></i> {{ theme_setting('start_conversation_text', 'start a conversation') }}
                </a>
            </div>
        </div>
        
    @else
        <div class="empty-state">
            <i class="fas fa-tree"></i>
            <h3>{{ theme_setting('experience_empty_title', 'journey is being written') }}</h3>
            <p>{{ theme_setting('experience_empty_message', 'Experience timeline coming soon.') }}</p>
        </div>
    @endif
</div>
@endsection