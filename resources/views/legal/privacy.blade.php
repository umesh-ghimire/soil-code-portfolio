@extends('layouts.app')

@section('title', theme_setting('privacy_title', 'Privacy Policy · Umesh Ghimire'))
@section('description', 'How I handle your data with the same care as tending a garden.')

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
    
    .legal-content h3 {
        font-size: clamp(1.2rem, 3vw, 1.4rem);
        font-weight: 600;
        color: var(--moss);
        margin: 1.5rem 0 1rem;
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
    
    .legal-content a {
        color: var(--clay);
        text-decoration: none;
        border-bottom: 1px dotted var(--clay);
        word-wrap: break-word;
    }
    
    .legal-content blockquote {
        background: rgba(193, 123, 92, 0.05);
        border-left: 4px solid var(--clay);
        padding: 1rem 1.5rem;
        margin: 1.5rem 0;
        border-radius: 0 30px 30px 0;
        font-style: italic;
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
    
    .legal-footer .btn i {
        transition: transform 0.3s;
    }
    
    .legal-footer .btn:hover i {
        transform: translateX(-3px);
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
        
        .legal-content h2 {
            margin: 1.5rem 0 0.8rem;
        }
        
        .legal-content ul, 
        .legal-content ol {
            margin-left: 1rem;
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
            margin-bottom: 1.5rem;
        }
        
        .legal-content {
            font-size: 0.9rem;
            line-height: 1.6;
        }
        
        .legal-content h2 {
            margin: 1.2rem 0 0.6rem;
        }
        
        .legal-content blockquote {
            padding: 0.8rem 1rem;
        }
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="legal-hero">
        <h1>{{ theme_setting('privacy_title', 'Privacy Policy') }}</h1>
        <p>{{ theme_setting('privacy_subtitle', 'How I handle your data with the same care as tending a garden.') }}</p>
    </div>
    
    <div class="legal-container">
        <div class="legal-card">
            <div class="legal-date">
                <i class="fas fa-calendar-alt" style="margin-right: 0.5rem;"></i>
                {{ theme_setting('privacy_date', 'Last updated: ' . date('F j, Y')) }}
            </div>
            
            <div class="legal-content">
                {!! theme_setting('privacy_content', '
                <h2>🌱 Information I Collect</h2>
                <p>Just as a farmer observes the soil before planting, I collect only what\'s necessary to tend our connection:</p>
                <ul>
                    <li><strong>What you share:</strong> When you contact me, I receive your name, email, and message — like seeds you choose to plant in my garden.</li>
                    <li><strong>What\'s automatic:</strong> Like footprints in the field, your visit leaves basic technical data (IP address, browser type) for security and analytics.</li>
                    <li><strong>What I don\'t collect:</strong> I don\'t gather data from third parties or track you across the web.</li>
                </ul>
                
                <h2>🌿 How I Use Your Information</h2>
                <p>Every seed planted serves a purpose:</p>
                <ul>
                    <li>To reply to your messages — the primary reason you reached out</li>
                    <li>To improve this garden — understanding how visitors interact helps me tend it better</li>
                    <li>To protect what\'s grown — ensuring security and preventing misuse</li>
                </ul>
                
                <h2>🍃 Information Sharing</h2>
                <p>I believe in stewardship, not commerce. Your information is never sold, traded, or rented. Like a trusted neighbor, I keep what you share private.</p>
                
                <h2>🌳 Your Rights</h2>
                <p>You have sovereignty over your data, just as a farmer has sovereignty over their land:</p>
                <ul>
                    <li><strong>Right to know:</strong> Ask what data I hold about you</li>
                    <li><strong>Right to correct:</strong> Update inaccurate information</li>
                    <li><strong>Right to delete:</strong> Request removal of your data</li>
                </ul>
                ') !!}
            </div>
            
            <div class="legal-footer">
                <div>
                    <i class="fas fa-leaf" style="color: var(--clay);"></i>
                    <span style="color: #5a6b5a; margin-left: 0.5rem;">Last updated: {{ date('F j, Y') }}</span>
                </div>
                <a href="{{ route('contact.index') }}" class="btn">
                    <i class="fas fa-seedling"></i> Contact Me
                </a>
            </div>
        </div>
    </div>
</div>
@endsection