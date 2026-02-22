@extends('layouts.app')

@section('title', theme_setting('experience_page_title', 'roots & branches · Umesh Ghimire'))
@section('description', theme_setting('experience_meta_description', 'My professional journey through seasons of growth, learning, and building.'))

@push('styles')
<style>
    .experience-header {
        padding: clamp(2rem, 5vw, 3rem) 0 clamp(1.5rem, 4vw, 2rem);
        text-align: center;
    }
    
    .experience-header h1 {
        font-size: clamp(2.5rem, 8vw, 4rem);
        font-weight: 800;
        color: var(--moss-deep);
        margin-bottom: 1rem;
        line-height: 1.2;
    }
    
    .experience-header p {
        font-size: clamp(1rem, 3vw, 1.3rem);
        color: #5a5f4b;
        max-width: min(700px, 90%);
        margin: 0 auto;
        border-left: 4px solid var(--clay);
        padding-left: clamp(1rem, 3vw, 1.6rem);
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(min(180px, 100%), 1fr));
        gap: clamp(1.5rem, 4vw, 2rem);
        margin: clamp(2rem, 5vw, 4rem) 0;
    }
    
    .stat-card {
        background: rgba(255, 247, 240, 0.7);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(193, 123, 92, 0.25);
        border-radius: 60px 20px 60px 20px;
        padding: clamp(1.5rem, 4vw, 2rem);
        text-align: center;
        box-shadow: var(--shadow-warm);
        transition: all 0.3s;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        border-color: var(--clay);
    }
    
    .stat-number {
        font-size: clamp(2rem, 6vw, 3rem);
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
        font-size: clamp(0.8rem, 2vw, 0.9rem);
    }
    
    .timeline-organic {
        margin: 3rem 0;
    }
    
    .timeline-item {
        position: relative;
        padding: clamp(1.5rem, 4vw, 2rem);
        margin-bottom: clamp(1.5rem, 4vw, 2rem);
        background: rgba(255, 247, 240, 0.5);
        border-radius: 60px 20px 60px 20px;
        border: 1px solid rgba(193, 123, 92, 0.2);
        transition: all 0.3s;
    }
    
    .timeline-item:hover {
        background: white;
        border-color: var(--clay);
        transform: translateX(10px);
    }
    
    .timeline-dot {
        position: absolute;
        left: -12px;
        top: 50%;
        transform: translateY(-50%);
        width: 24px;
        height: 24px;
        background: var(--clay);
        border-radius: 50%;
        border: 4px solid var(--rice);
        box-shadow: 0 0 0 2px var(--clay-light);
    }
    
    .timeline-date {
        display: inline-block;
        background: var(--clay-light);
        color: var(--moss-deep);
        padding: 0.3rem 1.2rem;
        border-radius: 30px 8px 30px 8px;
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }
    
    .timeline-title {
        font-size: clamp(1.3rem, 4vw, 1.8rem);
        font-weight: 700;
        color: var(--moss-deep);
        margin-bottom: 0.5rem;
    }
    
    .timeline-subtitle {
        font-size: clamp(1rem, 2.5vw, 1.2rem);
        color: var(--clay);
        margin-bottom: 1rem;
        font-weight: 600;
    }
    
    .duration-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--ash);
        padding: 0.3rem 1.2rem;
        border-radius: 30px 8px 30px 8px;
        font-size: 0.85rem;
        margin-top: 1rem;
    }
    
    .quote-section {
        background: rgba(227, 219, 207, 0.3);
        border-radius: clamp(60px, 10vw, 100px) clamp(15px, 3vw, 20px) 
                      clamp(60px, 10vw, 100px) clamp(15px, 3vw, 20px);
        padding: clamp(2rem, 6vw, 4rem);
        margin: clamp(3rem, 8vw, 5rem) 0;
        text-align: center;
        border: 1px solid rgba(193, 123, 92, 0.25);
    }
    
    .quote-section i {
        font-size: clamp(2rem, 5vw, 3rem);
        color: var(--clay-light);
        margin-bottom: 1rem;
    }
    
    .quote-text {
        font-size: clamp(1.2rem, 4vw, 1.8rem);
        font-style: italic;
        color: var(--moss-deep);
        max-width: 800px;
        margin: 0 auto 1rem;
        font-family: 'Tiro Devanagari Sanskrit', serif;
        line-height: 1.5;
    }
    
    .cta-section {
        background: var(--moss);
        border-radius: clamp(60px, 10vw, 100px) clamp(15px, 3vw, 20px) 
                      clamp(60px, 10vw, 100px) clamp(15px, 3vw, 20px);
        padding: clamp(2rem, 6vw, 4rem);
        text-align: center;
        color: white;
        margin: clamp(3rem, 8vw, 5rem) 0;
    }
    
    .cta-section h2 {
        font-size: clamp(1.5rem, 5vw, 2.5rem);
        font-weight: 800;
        margin-bottom: 1.5rem;
    }
    
    .cta-section .btn {
        background: white;
        color: var(--moss);
        margin: 0.5rem;
    }
    
    .cta-section .btn:hover {
        background: var(--clay);
        color: white;
    }
    
    .empty-state {
        text-align: center;
        padding: clamp(3rem, 8vw, 5rem) 0;
    }
    
    .empty-state i {
        font-size: clamp(3rem, 8vw, 4rem);
        color: var(--clay);
        margin-bottom: 1rem;
    }
    
    @media (max-width: 768px) {
        .timeline-item {
            margin-left: 20px;
        }
        
        .timeline-dot {
            left: -16px;
            width: 20px;
            height: 20px;
        }
        
        .cta-section .btn {
            display: block;
            width: 100%;
            margin: 0.5rem 0;
        }
    }
    
    @media (max-width: 480px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .timeline-item {
            padding: 1.2rem;
        }
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
                <div class="stat-number" style="font-size: clamp(1.2rem, 3vw, 1.5rem);">{{ Str::limit($currentRole->title, 20) }}</div>
                <div class="stat-label">{{ theme_setting('current_role_label', 'current field') }}</div>
            </div>
            @endif
        </div>
        
        <!-- Timeline -->
        <div class="timeline-organic">
            @foreach($experiences as $experience)
                @php
                    $startDate = \Carbon\Carbon::parse($experience->start_date);
                    $endDate = $experience->is_current ? null : ($experience->end_date ? \Carbon\Carbon::parse($experience->end_date) : null);
                    
                    $startYear = $startDate->format('Y');
                    $endYear = $experience->is_current ? 'present' : ($endDate ? $endDate->format('Y') : 'present');
                    
                    $duration = '';
                    $end = $experience->is_current ? now() : ($endDate ?? now());
                    $months = $startDate->diffInMonths($end);
                    $years = floor($months / 12);
                    $remMonths = $months % 12;
                    
                    if ($years > 0) {
                        $duration .= $years . ' ' . ($years > 1 ? 'years' : 'year');
                    }
                    if ($remMonths > 0) {
                        if ($years > 0) $duration .= ' ';
                        $duration .= $remMonths . ' ' . ($remMonths > 1 ? 'months' : 'month');
                    }
                @endphp
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-date">{{ $startYear }} — {{ $endYear }}</div>
                    <h3 class="timeline-title">{{ $experience->title }}</h3>
                    <div class="timeline-subtitle">{{ $experience->company }} · {{ $experience->location ?? 'Remote' }}</div>
                    <p style="font-size: clamp(0.95rem, 2.2vw, 1rem); line-height: 1.8;">{{ Str::limit(strip_tags($experience->description), 200) }}</p>
                    <div class="duration-badge">
                        <i class="fas fa-clock"></i> {{ $duration }}
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Quote Section -->
        <div class="quote-section">
            <i class="fas fa-quote-left"></i>
            <p class="quote-text">{{ theme_setting('experience_quote', 'The strongest roots grow slowly, reaching deep into the soil before breaking through to the sun.') }}</p>
            <p class="quote-author" style="color: var(--clay); font-weight: 600;">— {{ theme_setting('experience_quote_author', 'Nepali farming wisdom') }}</p>
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
            <h2 style="font-size: clamp(1.5rem, 5vw, 2.2rem); font-weight: 700; color: var(--moss-deep); margin-bottom: 1.5rem;">
                {{ theme_setting('final_cta_title', 'ready to grow together?') }}
            </h2>
            <div style="display: flex; gap: clamp(1rem, 3vw, 1.5rem); justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('projects.index') }}" class="btn btn-outline">
                    <i class="fas fa-asterisk"></i> {{ theme_setting('view_projects_text', 'view projects') }}
                </a>
                <a href="{{ route('contact') }}" class="btn btn-clay">
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