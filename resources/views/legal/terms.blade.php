@extends('layouts.app')

@section('title', theme_setting('terms_title', 'Terms of Service · Umesh Ghimire'))
@section('description', 'The gentle agreements that help us grow together.')

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
    
    .legal-content h3 {
        font-size: 1.4rem;
        font-weight: 600;
        color: var(--moss);
        margin: 2rem 0 1rem;
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
        content: '🌱';
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
    
    @keyframes float {
        0%, 100% { transform: translate(0, 0) rotate(0deg); }
        50% { transform: translate(20px, -20px) rotate(5deg); }
    }
    
    
</style>
@endpush

@section('content')
<div class="container">
    <div class="legal-hero">
        <h1>{{ theme_setting('terms_title', 'Terms of Service') }}</h1>
        <p>{{ theme_setting('terms_subtitle', 'The gentle agreements that help us grow together.') }}</p>
    </div>
    
    <div class="legal-container">
        <div class="legal-card">
            <div class="legal-date">
                <i class="fas fa-calendar-alt" style="margin-right: 0.5rem;"></i>
                {{ theme_setting('terms_date', 'Last updated: ' . date('F j, Y')) }}
            </div>
            
            <div class="legal-content">
                <div class="legal-quote">
                    <i class="fas fa-quote-left"></i>
                    These terms are like garden guidelines — simple, fair, and designed for mutual growth.
                </div>
                
                {!! theme_setting('terms_content', '
                <h2>🌱 Acceptance of Terms</h2>
                <p>By visiting this garden (website), you\'re agreeing to tend it with care and respect. These terms form the soil in which our interaction grows. If you don\'t agree with any part, please step away from the garden.</p>
                
                <div class="legal-divider"></div>
                
                <h2>🌿 Use of the Garden</h2>
                <p>Permission is granted to temporarily explore this digital space for personal, non-commercial reflection. This is a gift of access, not a transfer of ownership. You may not:</p>
                <ul>
                    <li>Harvest content for commercial use without permission</li>
                    <li>Attempt to dig up or damage the garden\'s infrastructure</li>
                    <li>Plant weeds (spam, malicious code, or harmful content)</li>
                    <li>Claim ownership of what grows here</li>
                </ul>
                
                <div class="legal-divider"></div>
                
                <h2>🍃 Intellectual Property</h2>
                <p>Everything in this garden — the words, the design, the code, the unique organic aesthetic — has been cultivated by me unless noted otherwise. You\'re welcome to be inspired, but please don\'t transplant without asking.</p>
                <p>The code that runs this garden is open source (check the GitHub repository), but the specific content and design are my own.</p>
                
                <div class="legal-divider"></div>
                
                <h2>🌳 Your Contributions</h2>
                <p>When you plant a seed (send a message or comment), you\'re giving me permission to tend it — to read it, respond to it, and perhaps learn from it. You retain ownership of your words, but grant me the right to use them for our interaction.</p>
                <p>Please don\'t share anything you wouldn\'t want growing in a public garden. I\'ll respect your privacy, as outlined in the Privacy Policy.</p>
                
                <div class="legal-divider"></div>
                
                <h2>🌾 Disclaimer of Warranties</h2>
                <p>This garden is provided "as is," like a natural landscape. While I tend it with care, I make no guarantees that:</p>
                <ul>
                    <li>It will always be available (storms happen)</li>
                    <li>It\'s free of bugs (nature has its own)</li>
                    <li>It meets your specific needs (every gardener works differently)</li>
                </ul>
                
                <div class="legal-divider"></div>
                
                <h2>🌻 Limitation of Liability</h2>
                <p>To the fullest extent permitted by law, I won\'t be liable for any damages arising from your use of this garden. This includes direct, indirect, incidental, or consequential damages — like a storm damaging your harvest, I can\'t be held responsible for unexpected outcomes.</p>
                
                <div class="legal-divider"></div>
                
                <h2>🌿 Changes to Terms</h2>
                <p>Gardens evolve, and so might these terms. I\'ll post any updates here with a revised "last updated" date. Continuing to visit after changes means you accept the new terms.</p>
                
                <div class="legal-divider"></div>
                
                <h2>🌱 Governing Law</h2>
                <p>These terms are governed by the laws of Nepal, where this garden is rooted. Any disputes will be handled with the same spirit of cooperation that guides a community garden.</p>
                ') !!}
            </div>
            
            <div class="legal-footer">
                <div>
                    <i class="fas fa-leaf" style="color: var(--clay);"></i>
                    <span style="color: #5a6b5a; margin-left: 0.5rem;">Last tended: {{ date('F j, Y') }}</span>
                </div>
                <a href="{{ route('home') }}" class="btn">
                    <i class="fas fa-home"></i> Return to Garden
                </a>
            </div>
        </div>
    </div>
</div>
@endsection