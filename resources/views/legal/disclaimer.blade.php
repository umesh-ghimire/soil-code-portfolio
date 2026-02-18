@extends('layouts.app')

@section('title', theme_setting('disclaimer_title', 'Disclaimer · Umesh Ghimire'))
@section('description', 'A gentle note about what you\'ll find (and won\'t find) in this garden.')

@push('styles')
<style>
    /* Same styles as privacy page - reuse */
    .legal-hero {
        padding: 3rem 0 1rem;
        text-align: center;
    }
    
    .legal-hero h1 {
        font-size: 4rem;
        font-weight: 800;
        color: var(--moss-deep);
        margin-bottom: 1rem;
        font-family: 'Playfair Display', serif;
        letter-spacing: -0.02em;
        position: relative;
        display: inline-block;
    }
    
    .legal-hero h1::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 4px;
        background: repeating-linear-gradient(45deg, var(--clay), var(--clay) 8px, transparent 8px, transparent 16px);
    }
    
    .legal-hero p {
        font-size: 1.3rem;
        color: #5a6b5a;
        max-width: 700px;
        margin: 2rem auto 0;
        font-style: italic;
        border-left: 4px solid var(--clay);
        padding-left: 1.6rem;
    }
    
    .legal-container {
        max-width: 900px;
        margin: 3rem auto 5rem;
        padding: 0 20px;
        position: relative;
    }
    
    .legal-card {
        background: rgba(255, 247, 240, 0.6);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 100px 20px 100px 20px;
        padding: 3.5rem;
        border: 1px solid rgba(193, 123, 92, 0.3);
        box-shadow: var(--shadow-warm);
        position: relative;
        overflow: hidden;
    }
    
    .legal-card::before {
        content: '';
        position: absolute;
        top: -80px;
        right: -80px;
        width: 250px;
        height: 250px;
        background: radial-gradient(circle, rgba(193, 123, 92, 0.1) 0%, transparent 70%);
        border-radius: 50%;
        animation: float 20s infinite alternate;
    }
    
    .legal-card::after {
        content: '';
        position: absolute;
        bottom: -80px;
        left: -80px;
        width: 250px;
        height: 250px;
        background: radial-gradient(circle, rgba(76, 107, 74, 0.1) 0%, transparent 70%);
        border-radius: 50%;
        animation: float 25s infinite alternate-reverse;
    }
    
    .legal-date {
        display: inline-block;
        background: rgba(193, 123, 92, 0.1);
        color: var(--clay);
        padding: 0.5rem 1.5rem;
        border-radius: 40px 12px 40px 12px;
        font-size: 0.95rem;
        font-weight: 600;
        margin-bottom: 2rem;
        border: 1px solid rgba(193, 123, 92, 0.3);
        position: relative;
        z-index: 2;
    }
    
    .legal-content {
        color: #3f4d45;
        line-height: 1.9;
        font-size: 1.05rem;
        position: relative;
        z-index: 2;
    }
    
    .legal-content h2 {
        font-size: 2rem;
        font-weight: 700;
        color: var(--moss-deep);
        margin: 2.5rem 0 1.2rem;
        font-family: 'Playfair Display', serif;
        position: relative;
        display: inline-block;
    }
    
    .legal-content h2::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 60px;
        height: 3px;
        background: repeating-linear-gradient(45deg, var(--clay), var(--clay) 6px, transparent 6px, transparent 12px);
    }
    
    .legal-content p {
        margin-bottom: 1.5rem;
        color: #4a5a4a;
    }
    
    .legal-content ul, 
    .legal-content ol {
        margin: 1.5rem 0 2rem 2rem;
    }
    
    .legal-content li {
        margin-bottom: 0.8rem;
        position: relative;
        list-style-type: none;
        padding-left: 1.8rem;
    }
    
    .legal-content li::before {
        content: '🌿';
        position: absolute;
        left: 0;
        top: 0;
        color: var(--clay);
        font-size: 1rem;
    }
    
    .legal-content strong {
        color: var(--moss-deep);
        font-weight: 700;
    }
    
    .legal-content a {
        color: var(--clay);
        text-decoration: none;
        border-bottom: 1px dotted var(--clay);
        transition: all 0.3s;
    }
    
    .legal-content a:hover {
        color: var(--moss);
        border-bottom-color: var(--moss);
    }
    
    .legal-divider {
        width: 100%;
        height: 2px;
        background: repeating-linear-gradient(45deg, var(--clay-light), var(--clay-light) 8px, transparent 8px, transparent 16px);
        margin: 2.5rem 0;
        opacity: 0.4;
    }
    
    .legal-footer {
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 1px dashed var(--clay-light);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
        position: relative;
        z-index: 2;
    }
    
    .legal-footer .btn {
        background: transparent;
        color: var(--clay);
        border: 2px solid var(--clay);
        padding: 0.8rem 2rem;
        border-radius: 40px 12px 40px 12px;
        font-weight: 600;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .legal-footer .btn:hover {
        background: var(--clay);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px -8px var(--clay);
    }
    
    .legal-quote {
        background: linear-gradient(145deg, rgba(193, 123, 92, 0.05), rgba(76, 107, 74, 0.05));
        padding: 2rem;
        border-radius: 60px 20px 60px 20px;
        margin: 2rem 0;
        border: 1px solid rgba(193, 123, 92, 0.2);
        font-style: italic;
        color: var(--moss-deep);
        text-align: center;
    }
    
    @media (max-width: 768px) {
        .legal-hero h1 { font-size: 3rem; }
        .legal-card { padding: 2rem; }
        .legal-footer { flex-direction: column; text-align: center; }
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="legal-hero">
        <h1>{{ theme_setting('disclaimer_title', 'Disclaimer') }}</h1>
        <p>{{ theme_setting('disclaimer_subtitle', 'A gentle note about what you\'ll find (and won\'t find) in this garden.') }}</p>
    </div>
    
    <div class="legal-container">
        <div class="legal-card">
            <div class="legal-date">
                <i class="fas fa-calendar-alt" style="margin-right: 0.5rem;"></i>
                {{ theme_setting('disclaimer_date', 'Last updated: ' . date('F j, Y')) }}
            </div>
            
            <div class="legal-content">
                <div class="legal-quote">
                    <i class="fas fa-quote-left"></i>
                    Think of this as a conversation with a fellow gardener, not a formal consultation.
                </div>
                
                <h2>🌿 General Information</h2>
                <p>Everything shared in this garden reflects my personal experiences, perspectives, and journey. It's offered freely, like advice between neighbors, but shouldn't be mistaken for professional counsel. Each garden grows differently — what works for me may not work for you.</p>
                
                <div class="legal-divider"></div>
                
                <h2>🍃 Professional Disclaimer</h2>
                <p>While I write about code, technology, and community building, this isn't professional advice. If you need technical consulting, legal guidance, or any professional service, please seek qualified professionals who understand your specific soil (situation).</p>
                
                <div class="legal-divider"></div>
                
                <h2>🌱 External Links</h2>
                <p>This garden may contain paths to other gardens (external websites). These connections are like recommendations from a friend — I share them because I find them valuable, but I can't tend or control what grows there. Please explore with care and respect their own garden guidelines.</p>
                
                <div class="legal-divider"></div>
                
                <h2>🌳 Testimonials</h2>
                <p>Words shared by others about working with me represent their individual experiences. Like harvests vary by season, results can differ. These testimonials aren't guarantees of what you'll experience, but genuine reflections of past collaborations.</p>
                
                <div class="legal-divider"></div>
                
                <h2>🌾 Accuracy & Completeness</h2>
                <p>I tend this garden with care, but I'm human. Information may sometimes be incomplete, outdated, or simply reflect my own perspective. I encourage you to verify anything important and do your own research before making decisions.</p>
                
                <div class="legal-divider"></div>
                
                <h2>🌻 Fair Use</h2>
                <p>Occasionally, I may reference or quote others' work for criticism, comment, teaching, or scholarship — all within fair use principles. If you believe anything here oversteps, please let me know so I can address it.</p>
                
                <div class="legal-divider"></div>
                
                <h2>🌱 No Guarantees</h2>
                <p>Gardening involves uncertainty. Similarly, I can't guarantee specific outcomes from applying anything shared here. Technology changes, circumstances differ, and every situation is unique. Use what you learn here as inspiration, not instruction.</p>
                
                <div class="legal-quote" style="margin-top: 2rem;">
                    <i class="fas fa-leaf"></i>
                    Explore with curiosity, question with kindness, and always tend your own garden with care.
                </div>
            </div>
            
            <div class="legal-footer">
                <div>
                    <i class="fas fa-seedling" style="color: var(--clay);"></i>
                    <span style="color: #5a6b5a; margin-left: 0.5rem;">Grown with honesty</span>
                </div>
                <a href="{{ route('contact.index') }}" class="btn">
                    <i class="fas fa-envelope"></i> Have Questions?
                </a>
            </div>
        </div>
    </div>
</div>
@endsection