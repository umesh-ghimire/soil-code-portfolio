@extends('layouts.app')

@section('title', theme_setting('privacy_title', 'Privacy Policy · Umesh Ghimire'))

@push('styles')
<style>
    .legal-container {
        max-width: 900px;
        margin: 4rem auto;
        padding: 0 20px;
    }
    
    .legal-card {
        background: white;
        border-radius: 80px 20px 80px 20px;
        padding: 3rem;
        border: 1px solid var(--clay-light);
        box-shadow: var(--shadow-warm);
    }
    
    .legal-card h1 {
        font-size: 3rem;
        font-weight: 800;
        color: var(--moss-deep);
        margin-bottom: 1rem;
    }
    
    .legal-date {
        color: var(--clay);
        margin-bottom: 2rem;
        font-style: italic;
    }
    
    .legal-content {
        color: #3f4d45;
        line-height: 1.8;
    }
    
    .legal-content h2 {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--moss-deep);
        margin: 2rem 0 1rem;
    }
    
    .legal-content p {
        margin-bottom: 1.5rem;
    }
    
    .legal-content ul {
        margin: 1rem 0 2rem 2rem;
    }
    
    .legal-content li {
        margin-bottom: 0.5rem;
    }
    
    @media (max-width: 768px) {
        .legal-card { padding: 2rem; }
        .legal-card h1 { font-size: 2.2rem; }
    }
</style>
@endpush

@section('content')
<div class="container legal-container">
    <div class="legal-card">
        <h1>{{ theme_setting('privacy_title', 'Privacy Policy') }}</h1>
        <p class="legal-date">{{ theme_setting('privacy_date', 'Last updated: ' . date('F j, Y')) }}</p>
        
        <div class="legal-content">
            {!! theme_setting('privacy_content', '
            <h2>Information We Collect</h2>
            <p>We collect information you provide directly to us, such as when you contact us through our website. This may include your name, email address, and any other information you choose to provide.</p>
            
            <h2>How We Use Your Information</h2>
            <p>We use the information we collect to respond to your inquiries, improve our website, and communicate with you about updates and opportunities.</p>
            
            <h2>Information Sharing</h2>
            <p>We do not sell, trade, or otherwise transfer your personally identifiable information to outside parties. This does not include trusted third parties who assist us in operating our website, as long as those parties agree to keep this information confidential.</p>
            
            <h2>Your Rights</h2>
            <p>You have the right to access, correct, or delete your personal information. To exercise these rights, please contact us.</p>
            
            <h2>Changes to This Policy</h2>
            <p>We may update this privacy policy from time to time. We will notify you of any changes by posting the new policy on this page.</p>
            ') !!}
        </div>
    </div>
</div>
@endsection