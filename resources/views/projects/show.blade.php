@extends('layouts.app')

@section('title', $project->title . ' · ' . theme_setting('site_title', 'Umesh Ghimire'))
@section('description', $project->description)

@push('styles')
<style>
    /* ===== PROJECT DETAIL PAGE - PROFESSIONAL DESIGN ===== */
    .project-detail {
        position: relative;
        padding: 2rem 0 5rem;
    }
    
    /* ===== HERO SECTION ===== */
    .project-hero {
        position: relative;
        margin-bottom: 4rem;
        border-radius: 0 0 120px 20px;
        overflow: hidden;
    }
    
    .project-hero-bg {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(193, 123, 92, 0.1), rgba(76, 107, 74, 0.1));
        z-index: 0;
    }
    
    .project-hero-content {
        position: relative;
        z-index: 2;
        padding: 3rem 0;
        max-width: 900px;
        margin: 0 auto;
        text-align: center;
    }
    
    /* Back Button */
    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--clay);
        text-decoration: none;
        font-weight: 600;
        margin-bottom: 2rem;
        padding: 0.6rem 1.5rem;
        border-radius: 40px 12px 40px 12px;
        background: white;
        border: 1px solid var(--clay-light);
        transition: all 0.3s ease;
        font-size: 1rem;
        box-shadow: 0 5px 15px -5px rgba(0,0,0,0.1);
    }
    
    .back-button:hover {
        background: var(--clay);
        color: white;
        border-color: var(--clay);
        transform: translateX(-5px);
    }
    
    .back-button i {
        transition: transform 0.3s ease;
    }
    
    .back-button:hover i {
        transform: translateX(-3px);
    }
    
    /* Project Title */
    .project-detail-title {
        font-size: clamp(2.5rem, 6vw, 4.5rem);
        font-weight: 800;
        color: var(--moss-deep);
        margin-bottom: 1.5rem;
        font-family: 'Playfair Display', serif;
        line-height: 1.2;
        position: relative;
        display: inline-block;
    }
    
    .project-detail-title::after {
        content: '';
        position: absolute;
        bottom: -15px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 4px;
        background: linear-gradient(90deg, var(--clay), var(--moss));
        border-radius: 4px;
    }
    
    /* Project Meta Grid */
    .project-meta-grid {
        display: flex;
        justify-content: center;
        gap: clamp(2rem, 5vw, 4rem);
        margin: 3rem 0 2rem;
        flex-wrap: wrap;
    }
    
    .meta-item {
        text-align: center;
        position: relative;
        padding: 0 1rem;
    }
    
    .meta-item::after {
        content: '';
        position: absolute;
        right: -2rem;
        top: 50%;
        transform: translateY(-50%);
        width: 1px;
        height: 40px;
        background: linear-gradient(180deg, transparent, var(--clay-light), transparent);
    }
    
    .meta-item:last-child::after {
        display: none;
    }
    
    .meta-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(145deg, var(--clay-light), var(--clay));
        border-radius: 30% 50% 30% 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: white;
        font-size: 1.8rem;
        box-shadow: 0 10px 20px -8px var(--clay);
    }
    
    .meta-label {
        font-size: 0.8rem;
        color: var(--clay);
        text-transform: uppercase;
        letter-spacing: 2px;
        font-weight: 600;
        margin-bottom: 0.3rem;
    }
    
    .meta-value {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--moss-deep);
    }
    
    /* ===== MAIN CONTENT GRID ===== */
    .project-detail-grid {
        display: grid;
        grid-template-columns: 1.2fr 0.8fr;
        gap: 3rem;
        margin: 4rem 0;
        align-items: start;
    }
    
    /* Left Column - Content */
    .project-content-left {
        position: relative;
    }
    
    /* Section Headers */
    .section-header-detail {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
    }
    
    .section-header-detail i {
        width: 50px;
        height: 50px;
        background: linear-gradient(145deg, var(--clay-light), var(--clay));
        border-radius: 30% 50% 30% 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.4rem;
        box-shadow: 0 10px 20px -8px var(--clay);
    }
    
    .section-header-detail h2 {
        font-size: 2rem;
        font-weight: 700;
        color: var(--moss-deep);
        font-family: 'Playfair Display', serif;
    }
    
    /* Project Story */
    .project-story {
        background: white;
        border-radius: 60px 20px 60px 20px;
        padding: 2.5rem;
        margin-bottom: 2.5rem;
        box-shadow: 0 30px 50px -20px rgba(0, 0, 0, 0.15);
        border: 1px solid rgba(193, 123, 92, 0.1);
    }
    
    .project-story-content {
        color: #4a5a4a;
        line-height: 1.9;
        font-size: 1.1rem;
    }
    
    .project-story-content p {
        margin-bottom: 1.5rem;
    }
    
    .project-story-content h3 {
        font-size: 1.6rem;
        color: var(--moss-deep);
        margin: 2rem 0 1rem;
        font-family: 'Playfair Display', serif;
    }
    
    .project-story-content ul,
    .project-story-content ol {
        margin: 1.5rem 0 1.5rem 2rem;
    }
    
    .project-story-content li {
        margin-bottom: 0.5rem;
    }
    
    .project-story-content blockquote {
        border-left: 4px solid var(--clay);
        padding: 1.5rem 2rem;
        margin: 2rem 0;
        background: rgba(193, 123, 92, 0.05);
        font-style: italic;
        border-radius: 0 30px 30px 0;
        font-size: 1.2rem;
        color: var(--moss-deep);
    }
    
    /* Tech Stack Section */
    .tech-stack-section {
        background: white;
        border-radius: 60px 20px 60px 20px;
        padding: 2.5rem;
        margin-bottom: 2.5rem;
        box-shadow: 0 30px 50px -20px rgba(0, 0, 0, 0.15);
        border: 1px solid rgba(193, 123, 92, 0.1);
    }
    
    .tech-cloud {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-top: 1.5rem;
    }
    
    .tech-badge-large {
        background: linear-gradient(145deg, var(--ash), white);
        padding: 0.8rem 1.8rem;
        border-radius: 50px 15px 50px 15px;
        font-size: 1rem;
        font-weight: 600;
        color: var(--moss-deep);
        border: 1px solid var(--clay-light);
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px -5px rgba(0,0,0,0.1);
    }
    
    .tech-badge-large:hover {
        background: var(--clay);
        color: white;
        border-color: var(--clay);
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 10px 25px -5px var(--clay);
    }
    
    /* Right Column - Image & Actions */
    .project-content-right {
        position: sticky;
        top: 100px;
    }
    
    /* ===== FIXED IMAGE CONTAINER ===== */
    .project-main-image {
        background: white;
        border-radius: 60px 20px 60px 20px;
        padding: 1rem;
        margin-bottom: 2rem;
        box-shadow: 0 30px 50px -20px rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(193, 123, 92, 0.1);
    }
    
    .image-container {
        position: relative;
        width: 100%;
        aspect-ratio: 1/1;
        overflow: hidden;
        border-radius: 50px 15px 50px 15px;
        background: linear-gradient(145deg, var(--clay-light), var(--clay));
    }
    
    .project-main-image img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform 0.6s ease;
    }
    
    .image-container:hover img {
        transform: scale(1.05);
    }
    
    .image-placeholder-large {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(145deg, var(--clay-light), var(--clay));
    }
    
    .image-placeholder-large i {
        font-size: clamp(3rem, 8vw, 5rem);
        color: white;
        opacity: 0.8;
    }
    
    /* Action Buttons */
    .project-actions {
        background: white;
        border-radius: 60px 20px 60px 20px;
        padding: 2rem;
        box-shadow: 0 30px 50px -20px rgba(0, 0, 0, 0.15);
        border: 1px solid rgba(193, 123, 92, 0.1);
        margin-bottom: 2rem;
    }
    
    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .btn-primary {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        background: var(--clay);
        color: white;
        padding: 1.2rem 2rem;
        border-radius: 50px 15px 50px 15px;
        text-decoration: none;
        font-weight: 700;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        border: 2px solid var(--clay);
    }
    
    .btn-primary:hover {
        background: var(--moss);
        border-color: var(--moss);
        transform: translateY(-3px);
        box-shadow: 0 15px 30px -10px var(--moss);
    }
    
    .btn-secondary {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        background: white;
        color: var(--moss-deep);
        padding: 1.2rem 2rem;
        border-radius: 50px 15px 50px 15px;
        text-decoration: none;
        font-weight: 700;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        border: 2px solid var(--clay);
    }
    
    .btn-secondary:hover {
        background: var(--clay-light);
        transform: translateY(-3px);
        box-shadow: 0 15px 30px -10px var(--clay);
    }
    
    /* Key Features */
    .key-features {
        background: white;
        border-radius: 60px 20px 60px 20px;
        padding: 2rem;
        box-shadow: 0 30px 50px -20px rgba(0, 0, 0, 0.15);
        border: 1px solid rgba(193, 123, 92, 0.1);
    }
    
    .features-list {
        list-style: none;
        padding: 0;
        margin: 1.5rem 0 0;
    }
    
    .features-list li {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.8rem 0;
        border-bottom: 1px dashed rgba(193, 123, 92, 0.2);
    }
    
    .features-list li:last-child {
        border-bottom: none;
    }
    
    .features-list i {
        width: 30px;
        height: 30px;
        background: rgba(193, 123, 92, 0.1);
        border-radius: 30% 50% 30% 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--clay);
        font-size: 1rem;
        flex-shrink: 0;
    }
    
    /* ===== GALLERY SECTION - FIXED IMAGES ===== */
    .gallery-section {
        margin: 5rem 0;
    }
    
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }
    
    .gallery-item {
        position: relative;
        aspect-ratio: 1/1;
        border-radius: 40px 12px 40px 12px;
        overflow: hidden;
        border: 3px solid white;
        box-shadow: 0 15px 30px -10px rgba(0,0,0,0.15);
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .gallery-item img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform 0.5s ease;
    }
    
    .gallery-item:hover {
        transform: scale(1.05) rotate(1deg);
        border-color: var(--clay);
        box-shadow: 0 25px 40px -15px var(--clay);
    }
    
    .gallery-item:hover img {
        transform: scale(1.1);
    }
    
    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(193, 123, 92, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .gallery-item:hover .gallery-overlay {
        opacity: 1;
    }
    
    .gallery-overlay i {
        color: white;
        font-size: 2rem;
        background: rgba(0,0,0,0.3);
        width: 50px;
        height: 50px;
        border-radius: 30% 50% 30% 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    /* ===== TESTIMONIAL SECTION ===== */
    .testimonial-section {
        margin: 5rem 0;
        position: relative;
    }
    
    .testimonial-card {
        background: linear-gradient(145deg, var(--moss), var(--moss-deep));
        border-radius: 100px 20px 100px 20px;
        padding: 4rem;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 30px 50px -15px var(--moss);
    }
    
    .testimonial-card::before {
        content: '"';
        position: absolute;
        top: 20px;
        left: 30px;
        font-size: 12rem;
        opacity: 0.1;
        font-family: serif;
        color: white;
    }
    
    .testimonial-text {
        font-size: 1.8rem;
        font-style: italic;
        line-height: 1.6;
        margin-bottom: 2rem;
        position: relative;
        z-index: 2;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
        text-align: center;
    }
    
    .testimonial-author {
        text-align: center;
        font-weight: 700;
        font-size: 1.2rem;
        color: var(--clay-light);
        letter-spacing: 2px;
    }
    
    .testimonial-author span {
        color: white;
        font-weight: 400;
        font-size: 1rem;
        opacity: 0.8;
    }
    
    /* ===== NAVIGATION SECTION ===== */
    .project-navigation {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 2rem;
        margin: 5rem 0;
    }
    
    .nav-prev,
    .nav-next {
        background: white;
        border-radius: 60px 20px 60px 20px;
        padding: 2rem;
        text-decoration: none;
        color: inherit;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        transition: all 0.3s ease;
        border: 1px solid rgba(193, 123, 92, 0.1);
        box-shadow: 0 15px 30px -10px rgba(0,0,0,0.1);
    }
    
    .nav-prev:hover,
    .nav-next:hover {
        background: var(--clay);
        color: white;
        transform: translateY(-5px);
        box-shadow: 0 25px 40px -15px var(--clay);
        border-color: var(--clay);
    }
    
    .nav-prev:hover .nav-title,
    .nav-next:hover .nav-title {
        color: white;
    }
    
    .nav-icon {
        width: 50px;
        height: 50px;
        background: var(--clay-light);
        border-radius: 30% 50% 30% 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        flex-shrink: 0;
    }
    
    .nav-prev:hover .nav-icon,
    .nav-next:hover .nav-icon {
        background: white;
        color: var(--clay);
    }
    
    .nav-content {
        flex: 1;
    }
    
    .nav-label {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: var(--clay);
        margin-bottom: 0.3rem;
    }
    
    .nav-prev:hover .nav-label,
    .nav-next:hover .nav-label {
        color: var(--clay-light);
    }
    
    .nav-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--moss-deep);
        transition: color 0.3s ease;
    }
    
    .nav-next {
        text-align: right;
    }
    
    .nav-next .nav-icon {
        order: 2;
    }
    
    /* ===== RELATED PROJECTS - FIXED IMAGES ===== */
    .related-section {
        margin: 5rem 0;
    }
    
    .related-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        margin-top: 2rem;
    }
    
    .related-card {
        background: white;
        border-radius: 50px 20px 50px 20px;
        overflow: hidden;
        text-decoration: none;
        color: inherit;
        border: 1px solid rgba(193, 123, 92, 0.1);
        transition: all 0.3s ease;
        box-shadow: 0 15px 30px -10px rgba(0,0,0,0.1);
    }
    
    .related-card:hover {
        transform: translateY(-8px) rotate(0.5deg);
        border-color: var(--clay);
        box-shadow: 0 25px 40px -15px var(--clay);
    }
    
    .related-image {
        position: relative;
        width: 100%;
        aspect-ratio: 16/9;
        overflow: hidden;
    }
    
    .related-image img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform 0.5s ease;
    }
    
    .related-card:hover .related-image img {
        transform: scale(1.1);
    }
    
    .related-content {
        padding: 1.5rem;
    }
    
    .related-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--moss-deep);
        margin-bottom: 0.5rem;
        font-family: 'Playfair Display', serif;
    }
    
    .related-date {
        font-size: 0.85rem;
        color: #8a9d8a;
    }
    
    /* ===== RESPONSIVE DESIGN ===== */
    @media (max-width: 1024px) {
        .project-detail-grid {
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }
        
        .related-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 768px) {
        .project-detail-grid {
            grid-template-columns: 1fr;
        }
        
        .project-content-right {
            position: static;
            order: -1;
        }
        
        .project-meta-grid {
            gap: 1.5rem;
        }
        
        .meta-item::after {
            display: none;
        }
        
        .testimonial-card {
            padding: 2rem;
        }
        
        .testimonial-text {
            font-size: 1.4rem;
        }
        
        .project-navigation {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .related-grid {
            grid-template-columns: 1fr;
        }
        
        .gallery-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 480px) {
        .project-hero-content {
            padding: 2rem 1rem;
        }
        
        .project-detail-title {
            font-size: 2rem;
        }
        
        .section-header-detail h2 {
            font-size: 1.6rem;
        }
        
        .project-story,
        .tech-stack-section,
        .project-actions,
        .key-features {
            padding: 1.5rem;
        }
        
        .tech-cloud {
            gap: 0.5rem;
        }
        
        .tech-badge-large {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }
        
        .gallery-grid {
            grid-template-columns: 1fr;
        }
        
        .testimonial-text {
            font-size: 1.2rem;
        }
        
        .nav-prev,
        .nav-next {
            padding: 1.2rem;
        }
        
        .nav-title {
            font-size: 1rem;
        }
    }
    
    /* Lightbox Modal */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.95);
        z-index: 9999;
        align-items: center;
        justify-content: center;
    }
    
    .modal.active {
        display: flex;
    }
    
    .modal-content {
        max-width: 90vw;
        max-height: 90vh;
        position: relative;
    }
    
    .modal-content img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        border-radius: 60px 20px 60px 20px;
        border: 4px solid white;
    }
    
    .modal-close {
        position: absolute;
        top: -50px;
        right: -50px;
        width: 50px;
        height: 50px;
        background: white;
        border-radius: 30% 50% 30% 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 1.5rem;
        color: var(--clay);
        transition: all 0.3s ease;
    }
    
    .modal-close:hover {
        transform: rotate(90deg);
        background: var(--clay);
        color: white;
    }
    
    @media (max-width: 768px) {
        .modal-close {
            top: -40px;
            right: 0;
        }
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
    
    $relatedProjects = \App\Models\Project::where('is_published', true)
        ->where('id', '!=', $project->id)
        ->inRandomOrder()
        ->limit(3)
        ->get();
    
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
    
    // Sample features for demo (replace with actual project features)
    $features = [
        'Responsive Design',
        'User Authentication',
        'Payment Integration',
        'Real-time Updates',
        'Analytics Dashboard',
        'API Integration'
    ];
@endphp

<div class="project-detail">
    <!-- Hero Section -->
    <div class="project-hero">
        <div class="project-hero-bg"></div>
        <div class="container">
            <div class="project-hero-content">
                <a href="{{ route('projects.index') }}" class="back-button">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Projects</span>
                </a>
                
                <h1 class="project-detail-title">{{ $project->title }}</h1>
                
                <!-- Meta Information -->
                <div class="project-meta-grid">
                    <div class="meta-item">
                        <div class="meta-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div class="meta-label">Year</div>
                        <div class="meta-value">{{ $year }}</div>
                    </div>
                    
                    @if($project->client)
                    <div class="meta-item">
                        <div class="meta-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="meta-label">Client</div>
                        <div class="meta-value">{{ $project->client }}</div>
                    </div>
                    @endif
                    
                    @if($project->role)
                    <div class="meta-item">
                        <div class="meta-icon">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <div class="meta-label">Role</div>
                        <div class="meta-value">{{ $project->role }}</div>
                    </div>
                    @endif
                    
                    @if($project->duration)
                    <div class="meta-item">
                        <div class="meta-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="meta-label">Duration</div>
                        <div class="meta-value">{{ $project->duration }}</div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <div class="container">
        <!-- Main Content Grid -->
        <div class="project-detail-grid">
            <!-- Left Column - Content -->
            <div class="project-content-left">
                <!-- Project Story -->
                <div class="project-story">
                    <div class="section-header-detail">
                        <i class="fas fa-book-open"></i>
                        <h2>The Story</h2>
                    </div>
                    <div class="project-story-content">
                        {!! nl2br(e($project->description)) !!}
                        
                        @if($project->content)
                            {!! $project->content !!}
                        @endif
                        
                        @if($project->challenge)
                        <h3>The Challenge</h3>
                        <p>{{ $project->challenge }}</p>
                        @endif
                        
                        @if($project->solution)
                        <h3>The Solution</h3>
                        <p>{{ $project->solution }}</p>
                        @endif
                        
                        @if($project->results)
                        <h3>The Results</h3>
                        <p>{{ $project->results }}</p>
                        @endif
                    </div>
                </div>
                
                <!-- Tech Stack -->
                @if(count($techs) > 0)
                <div class="tech-stack-section">
                    <div class="section-header-detail">
                        <i class="fas fa-code"></i>
                        <h2>Technologies Used</h2>
                    </div>
                    <div class="tech-cloud">
                        @foreach($techs as $tech)
                            <span class="tech-badge-large">{{ $tech }}</span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            
            <!-- Right Column - Image & Actions -->
            <div class="project-content-right">
                <!-- Main Image - FIXED -->
                <div class="project-main-image">
                    <div class="image-container">
                        @if($projectImage)
                            <img src="{{ $projectImage }}" alt="{{ $project->title }}" id="mainProjectImage">
                        @else
                            <div class="image-placeholder-large">
                                <i class="fas fa-code-branch"></i>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="project-actions">
                    <div class="action-buttons">
                        @if($project->project_url)
                            <a href="{{ $project->project_url }}" target="_blank" class="btn-primary">
                                <i class="fas fa-external-link-alt"></i>
                                <span>Live Demo</span>
                            </a>
                        @endif
                        
                        @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank" class="btn-secondary">
                                <i class="fab fa-github"></i>
                                <span>Source Code</span>
                            </a>
                        @endif
                        
                        @if($project->case_study)
                            <a href="{{ route('projects.case-study', $project->slug) }}" class="btn-secondary">
                                <i class="fas fa-file-alt"></i>
                                <span>Case Study</span>
                            </a>
                        @endif
                    </div>
                </div>
                
                <!-- Key Features -->
                <div class="key-features">
                    <div class="section-header-detail">
                        <i class="fas fa-star"></i>
                        <h3>Key Features</h3>
                    </div>
                    <ul class="features-list">
                        @foreach($features as $feature)
                            <li>
                                <i class="fas fa-check"></i>
                                <span>{{ $feature }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        
        <!-- Gallery Section - FIXED -->
        @if($project->gallery && count($project->gallery) > 0)
        <div class="gallery-section">
            <div class="section-header-detail">
                <i class="fas fa-images"></i>
                <h2>Project Gallery</h2>
            </div>
            <div class="gallery-grid">
                @foreach($project->gallery as $index => $image)
                    <div class="gallery-item" onclick="openModal('{{ asset('storage/' . $image) }}')">
                        <img src="{{ asset('storage/' . $image) }}" alt="{{ $project->title }} - Image {{ $index + 1 }}" loading="lazy">
                        <div class="gallery-overlay">
                            <i class="fas fa-search-plus"></i>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif
        
        <!-- Testimonial Section -->
        @if($project->testimonial)
        <div class="testimonial-section">
            <div class="testimonial-card">
                <div class="testimonial-text">"{{ $project->testimonial }}"</div>
                @if($project->testimonial_author)
                <div class="testimonial-author">
                    {{ $project->testimonial_author }} 
                    @if($project->testimonial_position)
                    <span>{{ $project->testimonial_position }}</span>
                    @endif
                </div>
                @endif
            </div>
        </div>
        @endif
        
        <!-- Navigation -->
        @if($prevProject || $nextProject)
        <div class="project-navigation">
            @if($prevProject)
            <a href="{{ route('projects.show', $prevProject->slug) }}" class="nav-prev">
                <div class="nav-icon">
                    <i class="fas fa-arrow-left"></i>
                </div>
                <div class="nav-content">
                    <div class="nav-label">Previous Project</div>
                    <div class="nav-title">{{ $prevProject->title }}</div>
                </div>
            </a>
            @else
            <div></div>
            @endif
            
            @if($nextProject)
            <a href="{{ route('projects.show', $nextProject->slug) }}" class="nav-next">
                <div class="nav-content">
                    <div class="nav-label">Next Project</div>
                    <div class="nav-title">{{ $nextProject->title }}</div>
                </div>
                <div class="nav-icon">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </a>
            @endif
        </div>
        @endif
        
        <!-- Related Projects - FIXED -->
        @if($relatedProjects->count() > 0)
        <div class="related-section">
            <div class="section-header-detail">
                <i class="fas fa-project-diagram"></i>
                <h2>You Might Also Like</h2>
            </div>
            <div class="related-grid">
                @foreach($relatedProjects as $related)
                    @php
                        $relatedImage = $related->featured_image ? asset('storage/' . $related->featured_image) : null;
                        $relatedYear = $related->created_at ? $related->created_at->format('Y') : date('Y');
                    @endphp
                    <a href="{{ route('projects.show', $related->slug) }}" class="related-card">
                        <div class="related-image">
                            @if($relatedImage)
                                <img src="{{ $relatedImage }}" alt="{{ $related->title }}" loading="lazy">
                            @else
                                <div style="width:100%; height:100%; background: linear-gradient(145deg, var(--clay-light), var(--clay)); display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-code-branch" style="font-size: 2rem; color: white; opacity: 0.8;"></i>
                                </div>
                            @endif
                        </div>
                        <div class="related-content">
                            <h3 class="related-title">{{ $related->title }}</h3>
                            <span class="related-date">{{ $relatedYear }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Lightbox Modal -->
<div class="modal" id="imageModal" onclick="closeModal()">
    <div class="modal-content">
        <img src="" alt="" id="modalImage">
        <div class="modal-close" onclick="closeModal()">
            <i class="fas fa-times"></i>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Lightbox functionality
    function openModal(imageSrc) {
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        modalImage.src = imageSrc;
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    
    function closeModal() {
        const modal = document.getElementById('imageModal');
        modal.classList.remove('active');
        document.body.style.overflow = '';
    }
    
    // Close modal with escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
    
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>
@endpush
@endsection