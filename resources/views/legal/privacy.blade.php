@extends('layouts.app')

@section('title', theme_setting('privacy_title', 'Privacy Policy · Umesh Ghimire'))
@section('description', 'How I handle your data with the same care as tending a garden.')

@push('styles')
<style>
    .legal-hero {
        padding: 3rem 0 1rem;
        text-align: center;
        position: relative;
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
        border-radius: 2px;
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
    
    .legal-content blockquote {
        background: rgba(193, 123, 92, 0.05);
        border-left: 4px solid var(--clay);
        padding: 1.5rem 2rem;
        margin: 2rem 0;
        border-radius: 0 30px 30px 0;
        font-style: italic;
        color: #4a5a4a;
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
    
    .legal-footer .btn i {
        transition: transform 0.3s;
    }
    
    .legal-footer .btn:hover i {
        transform: translateX(-3px);
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
    
    .legal-quote i {
        color: var(--clay);
        font-size: 1.5rem;
        margin-right: 0.5rem;
    }
    
    @media (max-width: 768px) {
        .legal-hero h1 { font-size: 3rem; }
        .legal-card { padding: 2rem; }
        .legal-footer { flex-direction: column; text-align: center; }
        .legal-content h2 { font-size: 1.7rem; }
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
                <div class="legal-quote">
                    <i class="fas fa-quote-left"></i>
                    Your data is like a seed — I handle it with care, never sell it, and only use it to grow our connection.
                </div>
                
                {!! theme_setting('privacy_content', '
                <h2>🌱 Information I Collect</h2>
                <p>Just as a farmer observes the soil before planting, I collect only what\'s necessary to tend our connection:</p>
                <ul>
                    <li><strong>What you share:</strong> When you contact me, I receive your name, email, and message — like seeds you choose to plant in my garden.</li>
                    <li><strong>What\'s automatic:</strong> Like footprints in the field, your visit leaves basic technical data (IP address, browser type) for security and analytics.</li>
                    <li><strong>What I don\'t collect:</strong> I don\'t gather data from third parties or track you across the web.</li>
                </ul>
                
                <div class="legal-divider"></div>
                
                <h2>🌿 How I Use Your Information</h2>
                <p>Every seed planted serves a purpose:</p>
                <ul>
                    <li>To reply to your messages — the primary reason you reached out</li>
                    <li>To improve this garden — understanding how visitors interact helps me tend it better</li>
                    <li>To protect what\'s grown — ensuring security and preventing misuse</li>
                </ul>
                
                <div class="legal-divider"></div>
                
                <h2>🍃 Information Sharing</h2>
                <p>I believe in stewardship, not commerce. Your information is never sold, traded, or rented. Like a trusted neighbor, I keep what you share private. The only exceptions would be:</p>
                <ul>
                    <li>With your explicit consent</li>
                    <li>To comply with legal obligations</li>
                    <li>To protect rights and safety</li>
                </ul>
                
                <div class="legal-divider"></div>
                
                <h2>🌳 Your Rights</h2>
                <p>You have sovereignty over your data, just as a farmer has sovereignty over their land:</p>
                <ul>
                    <li><strong>Right to know:</strong> Ask what data I hold about you</li>
                    <li><strong>Right to correct:</strong> Update inaccurate information</li>
                    <li><strong>Right to delete:</strong> Request removal of your data</li>
                    <li><strong>Right to object:</strong> Opt out of certain uses</li>
                </ul>
                <p>To exercise these rights, simply <a href="'.route('contact.index').'">plant a seed</a> and let me know.</p>
                
                <div class="legal-divider"></div>
                
                <h2>🌾 Cookies & Tracking</h2>
                <p>Like seasonal markers in a field, I use minimal cookies:</p>
                <ul>
                    <li><strong>Essential cookies:</strong> For basic functionality (session management)</li>
                    <li><strong>Analytics cookies:</strong> Anonymous usage data to improve the garden</li>
                </ul>
                <p>You can adjust cookie settings in your browser anytime.</p>
                
                <div class="legal-divider"></div>
                
                <h2>🌻 Changes to This Policy</h2>
                <p>As gardens evolve, so might this policy. I\'ll post any updates here with a revised "last updated" date. Significant changes may be announced through the site.</p>
                ') !!}
            </div>
            
            <div class="legal-footer">
                <div>
                    <i class="fas fa-leaf" style="color: var(--clay);"></i>
                    <span style="color: #5a6b5a; margin-left: 0.5rem;">Last tended: {{ date('F j, Y') }}</span>
                </div>
                <a href="{{ route('contact.index') }}" class="btn">
                    <i class="fas fa-seedling"></i> Plant a Seed
                </a>
            </div>
        </div>
    </div>
</div>
@endsection