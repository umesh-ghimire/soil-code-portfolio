@extends('layouts.app')

@section('title', theme_setting('disclaimer_title', 'Disclaimer · Umesh Ghimire'))
@section('description', 'A gentle note about what you\'ll find (and won\'t find) in this garden.')

@push('styles')
<style>
    .legal-hero {
        padding: 3rem 0 2rem;
        text-align: center;
    }
    
    .legal-hero h1 {
        font-size: clamp(2.5rem, 5vw, 4rem);
        font-weight: 800;
        color: var(--moss-deep);
        margin-bottom: 1rem;
        font-family: 'Playfair Display', serif;
        word-wrap: break-word;
    }
    
    .legal-hero p {
        font-size: clamp(1rem, 3vw, 1.3rem);
        color: #5a6b5a;
        max-width: 700px;
        margin: 0 auto;
        border-left: 4px solid var(--clay);
        padding-left: 1.6rem;
        word-wrap: break-word;
    }
    
    .legal-container {
        max-width: 900px;
        margin: 2rem auto 4rem;
        padding: 0 20px;
    }
    
    .legal-card {
        background: rgba(255, 247, 240, 0.6);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 60px 15px 60px 15px;
        padding: clamp(1.5rem, 4vw, 3rem);
        border: 1px solid rgba(193, 123, 92, 0.3);
        box-shadow: var(--shadow-warm);
        width: 100%;
        overflow-x: hidden;
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
    }
    
    .legal-content {
        color: #3f4d45;
        line-height: 1.8;
        font-size: clamp(0.95rem, 2.5vw, 1.05rem);
        width: 100%;
        overflow-x: hidden;
    }
    
    .legal-content h2 {
        font-size: clamp(1.5rem, 4vw, 2rem);
        font-weight: 700;
        color: var(--moss-deep);
        margin: 2rem 0 1rem;
        font-family: 'Playfair Display', serif;
        word-wrap: break-word;
    }
    
    .legal-content p {
        margin-bottom: 1.2rem;
        word-wrap: break-word;
    }
    
    .legal-content ul, 
    .legal-content ol {
        margin: 1rem 0 1.5rem 1.5rem;
        word-wrap: break-word;
    }
    
    .legal-content li {
        margin-bottom: 0.5rem;
        word-wrap: break-word;
    }
    
    .legal-divider {
        width: 100%;
        height: 2px;
        background: repeating-linear-gradient(45deg, var(--clay-light), var(--clay-light) 8px, transparent 8px, transparent 16px);
        margin: 2rem 0;
        opacity: 0.4;
    }
    
    .legal-footer {
        margin-top: 2.5rem;
        padding-top: 1.5rem;
        border-top: 1px dashed var(--clay-light);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }
    
    .legal-footer .btn {
        background: var(--clay);
        color: white;
        padding: 0.8rem 2rem;
        border-radius: 40px 12px 40px 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s;
        white-space: nowrap;
    }
    
    .legal-footer .btn:hover {
        background: var(--moss);
        transform: translateY(-2px);
    }
    
    /* Mobile Responsive */
    @media screen and (max-width: 768px) {
        .legal-hero {
            padding: 2rem 0 1.5rem;
        }
        
        .legal-hero p {
            border-left: 3px solid var(--clay);
            padding-left: 1rem;
        }
        
        .legal-card {
            padding: 1.5rem;
            border-radius: 40px 10px 40px 10px;
        }
        
        .legal-footer {
            flex-direction: column;
            text-align: center;
        }
        
        .legal-footer .btn {
            width: 100%;
            justify-content: center;
            white-space: normal;
        }
    }
    
    @media screen and (max-width: 480px) {
        .legal-container {
            padding: 0 15px;
            margin: 1.5rem auto 3rem;
        }
        
        .legal-card {
            padding: 1.2rem;
            border-radius: 30px 8px 30px 8px;
        }
        
        .legal-date {
            font-size: 0.85rem;
            padding: 0.4rem 1rem;
        }
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
                <h2>🌿 General Information</h2>
                <p>Everything shared in this garden reflects my personal experiences, perspectives, and journey. It's offered freely, like advice between neighbors, but shouldn't be mistaken for professional counsel.</p>
                
                <h2>🍃 Professional Disclaimer</h2>
                <p>While I write about code, technology, and community building, this isn't professional advice. Please seek qualified professionals for specific needs.</p>
                
                <h2>🌱 External Links</h2>
                <p>This garden may contain paths to other gardens (external websites). I share them because I find them valuable, but I can't tend or control what grows there.</p>
                
                <h2>🌳 No Guarantees</h2>
                <p>I can't guarantee specific outcomes from applying anything shared here. Technology changes, circumstances differ, and every situation is unique.</p>
            </div>
            
            <div class="legal-footer">
                <div>
                    <i class="fas fa-seedling" style="color: var(--clay);"></i>
                    <span style="color: #5a6b5a; margin-left: 0.5rem;">Grown with honesty</span>
                </div>
                <a href="{{ route('contact.index') }}" class="btn">
                    <i class="fas fa-envelope"></i> Questions?
                </a>
            </div>
        </div>
    </div>
</div>
@endsection