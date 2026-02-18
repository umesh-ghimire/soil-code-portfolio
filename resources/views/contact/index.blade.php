 
@extends('layouts.app')

@section('title', theme_setting('contact_page_title', 'plant a seed · Umesh Ghimire'))
@section('description', theme_setting('contact_meta_description', 'I reply within a moon cycle — sometimes faster, never slower. All messages are read, all seeds are tended.'))

@push('styles')
<style>
    .contact-header {
        padding: 3rem 0 2rem;
        text-align: center;
    }
    
    .contact-header h1 {
        font-size: 4rem;
        font-weight: 800;
        color: var(--moss-deep);
        margin-bottom: 1rem;
    }
    
    .contact-header p {
        font-size: 1.3rem;
        color: #5a5f4b;
        max-width: 700px;
        margin: 0 auto;
        border-left: 4px solid var(--clay);
        padding-left: 1.6rem;
    }
    
    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 4rem;
        margin: 3rem 0 5rem;
    }
    
    .contact-info-card {
        background: rgba(227, 219, 207, 0.3);
        border-radius: 80px 20px 80px 20px;
        padding: 2.5rem;
        border: 1px solid rgba(193, 123, 92, 0.25);
    }
    
    .contact-method {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-bottom: 2rem;
        padding: 1rem;
        background: white;
        border-radius: 40px 12px 40px 12px;
        border: 1px solid var(--clay-light);
        transition: all 0.3s;
    }
    
    .contact-method:hover {
        border-color: var(--clay);
        transform: translateX(5px);
    }
    
    .contact-icon {
        width: 60px;
        height: 60px;
        background: var(--ash);
        border-radius: 30% 50% 30% 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--clay);
        font-size: 1.8rem;
        flex-shrink: 0;
    }
    
    .contact-detail h3 {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--moss-deep);
        margin-bottom: 0.2rem;
    }
    
    .contact-detail p,
    .contact-detail a {
        color: #5a5f4b;
        text-decoration: none;
    }
    
    .contact-detail a:hover {
        color: var(--clay);
        text-decoration: underline;
    }
    
    .response-commitment {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-top: 2rem;
        padding: 1.5rem;
        background: var(--ash);
        border-radius: 40px 12px 40px 12px;
        border: 1px solid var(--clay-light);
    }
    
    .response-commitment i {
        font-size: 2rem;
        color: var(--clay);
    }
    
    .response-commitment strong {
        color: var(--moss-deep);
        display: block;
        margin-bottom: 0.3rem;
    }
    
    .response-commitment p {
        color: #5a5f4b;
        font-size: 0.95rem;
    }
    
    .contact-form-card {
        background: white;
        border-radius: 80px 20px 80px 20px;
        padding: 2.5rem;
        border: 1px solid var(--clay-light);
        box-shadow: var(--shadow-warm);
    }
    
    .form-group {
        margin-bottom: 1.8rem;
    }
    
    .form-input,
    .form-textarea {
        width: 100%;
        padding: 1rem 1.5rem;
        background: var(--rice);
        border: 1px solid var(--clay-light);
        border-radius: 30px 8px 30px 8px;
        font-family: 'Inter', sans-serif;
        transition: all 0.3s;
    }
    
    .form-input:focus,
    .form-textarea:focus {
        outline: none;
        border-color: var(--clay);
        background: white;
        border-radius: 8px 30px 8px 30px;
    }
    
    .form-textarea {
        min-height: 150px;
        resize: vertical;
    }
    
    .form-input.is-invalid,
    .form-textarea.is-invalid {
        border-color: #dc2626;
    }
    
    .error-message {
        display: block;
        color: #dc2626;
        font-size: 0.875rem;
        margin-top: 0.3rem;
    }
    
    .submit-btn {
        width: 100%;
        padding: 1.2rem;
        background: var(--moss);
        color: white;
        border: none;
        border-radius: 60px 20px 60px 20px;
        font-weight: 700;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.8rem;
        cursor: pointer;
        transition: all 0.3s;
    }
    
    .submit-btn:hover {
        background: var(--moss-deep);
        border-radius: 30px 60px 30px 60px;
        transform: scale(0.98);
    }
    
    .success-message {
        background: var(--moss);
        color: white;
        padding: 1.5rem;
        border-radius: 40px 12px 40px 12px;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .success-message i {
        font-size: 2rem;
    }
    
    .social-basket {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        margin-top: 2rem;
    }
    
    .social-icon {
        background: white;
        width: 50px;
        height: 50px;
        border-radius: 30% 50% 30% 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--moss);
        border: 2px solid rgba(193, 123, 92, 0.25);
        font-size: 1.4rem;
        transition: all 0.3s;
        text-decoration: none;
    }
    
    .social-icon[data-platform="facebook"]:hover { 
        background: #1877f2; 
        color: white;
        border-color: #1877f2;
    }
    
    .social-icon[data-platform="instagram"]:hover { 
        background: linear-gradient(45deg, #f09433, #d62976, #962fbf, #4f5bd5);
        color: white;
        border-color: transparent;
    }
    
    .social-icon[data-platform="github"]:hover { 
        background: #333; 
        color: white;
        border-color: #333;
    }
    
    .social-icon[data-platform="linkedin"]:hover { 
        background: #0077b5; 
        color: white;
        border-color: #0077b5;
    }
    
    .social-icon[data-platform="twitter"]:hover { 
        background: #000; 
        color: white;
        border-color: #000;
    }
    
    .social-icon:hover {
        transform: translateY(-5px) rotate(8deg);
        border-radius: 50% 30% 50% 30%;
    }
    
    @media (max-width: 900px) {
        .contact-header h1 { font-size: 3rem; }
        .contact-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')
@php
    $profile = \App\Models\Profile::first();
    
    $email = $profile->email ?? theme_setting('email', '');
    $phone = $profile->phone ?? theme_setting('phone', null);
    $location = $profile->location ?? theme_setting('location', 'Lalitpur, Nepal');
    
    // Get social links properly
    $socialLinks = [];
    if ($profile && !empty($profile->social_links)) {
        $rawSocialLinks = $profile->social_links;
        
        if (is_array($rawSocialLinks)) {
            foreach ($rawSocialLinks as $link) {
                if (isset($link['platform']) && isset($link['url'])) {
                    $socialLinks[$link['platform']] = $link['url'];
                }
            }
        } elseif (is_string($rawSocialLinks)) {
            $decoded = json_decode($rawSocialLinks, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $socialLinks = $decoded;
            }
        }
    }
    
    $responseTime = theme_setting('response_time', '1-28 days (I read everything)');
    $commitment = theme_setting('response_commitment', '🌙 one moon cycle guarantee');
    $responseDetail = theme_setting('response_detail', 'I read every message with care and will reply within a moon cycle. Your words matter to me.');
@endphp

<div class="container">
    <div class="contact-header">
        <h1>{{ theme_setting('contact_page_title', 'plant a seed') }}</h1>
        <p>{{ theme_setting('contact_subtitle', 'I reply within a moon cycle — sometimes faster, never slower. All messages are read, all seeds are tended.') }}</p>
    </div>
    
    <div class="contact-grid">
        <div class="contact-info-card">
            <h2 style="font-size: 2rem; font-weight: 700; color: var(--moss-deep); margin-bottom: 2rem;">
                {{ theme_setting('reach_out_title', 'reach out') }}
            </h2>
            
            @if($email)
            <div class="contact-method">
                <div class="contact-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="contact-detail">
                    <h3>{{ theme_setting('email_label', 'email') }}</h3>
                    <a href="mailto:{{ $email }}">{{ $email }}</a>
                </div>
            </div>
            @endif
            
            @if($phone)
            <div class="contact-method">
                <div class="contact-icon">
                    <i class="fas fa-phone"></i>
                </div>
                <div class="contact-detail">
                    <h3>{{ theme_setting('phone_label', 'phone') }}</h3>
                    <a href="tel:{{ $phone }}">{{ $phone }}</a>
                </div>
            </div>
            @endif
            
            <div class="contact-method">
                <div class="contact-icon">
                    <i class="fas fa-location-dot"></i>
                </div>
                <div class="contact-detail">
                    <h3>{{ theme_setting('location_label', 'field office') }}</h3>
                    <p>{{ $location }}</p>
                </div>
            </div>
            
            <div class="contact-method">
                <div class="contact-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="contact-detail">
                    <h3>{{ theme_setting('response_label', 'response time') }}</h3>
                    <p>{{ $responseTime }}</p>
                </div>
            </div>
            
            <div class="response-commitment">
                <i class="fas fa-moon"></i>
                <div>
                    <strong>{{ $commitment }}</strong>
                    <p>{{ $responseDetail }}</p>
                </div>
            </div>
            
            <!-- Social Links Section -->
            <div style="margin-top: 2.5rem; padding-top: 1.5rem; border-top: 1px dashed var(--clay-light);">
                <h3 style="font-size: 1.3rem; font-weight: 700; color: var(--moss-deep); margin-bottom: 1.2rem;">
                    <i class="fas fa-seedling" style="color: var(--clay); margin-right: 0.5rem;"></i>
                    {{ theme_setting('social_title', 'digital soil') }}
                </h3>
                
                <div class="social-basket">
                    @php
                        $defaultPlatforms = [
                            'github' => ['url' => '#', 'icon' => 'fab fa-github', 'title' => 'GitHub'],
                            'linkedin' => ['url' => '#', 'icon' => 'fab fa-linkedin-in', 'title' => 'LinkedIn'],
                            'twitter' => ['url' => '#', 'icon' => 'fab fa-twitter', 'title' => 'Twitter'],
                        ];
                        
                        if (!empty($socialLinks) && is_array($socialLinks)) {
                            foreach ($socialLinks as $platform => $url) {
                                if (isset($defaultPlatforms[$platform])) {
                                    $defaultPlatforms[$platform]['url'] = $url;
                                } elseif ($url && $url !== '#') {
                                    $iconClass = 'fab fa-' . $platform;
                                    if ($platform === 'devto') $iconClass = 'fab fa-dev';
                                    if ($platform === 'stackoverflow') $iconClass = 'fab fa-stack-overflow';
                                    
                                    $defaultPlatforms[$platform] = [
                                        'url' => $url,
                                        'icon' => $iconClass,
                                        'title' => ucfirst($platform)
                                    ];
                                }
                            }
                        }
                    @endphp
                    
                    @foreach($defaultPlatforms as $platform => $data)
                        <a href="{{ $data['url'] }}" 
                           target="_blank" 
                           class="social-icon" 
                           data-platform="{{ $platform }}" 
                           title="{{ $data['title'] }}">
                            <i class="{{ $data['icon'] }}"></i>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        
        <div>
            <div class="contact-form-card">
                <h2 style="font-size: 2rem; font-weight: 700; color: var(--moss-deep); margin-bottom: 2rem;">
                    {{ theme_setting('form_title', 'send a seed') }}
                </h2>
                
                @if(session('success'))
                    <div class="success-message">
                        <i class="fas fa-seedling"></i>
                        <div>{{ session('success') }}</div>
                    </div>
                @endif
                
                <form method="POST" action="{{ route('contact.store') }}">
                    @csrf
                    
                    <div class="form-group">
                        <input type="text" name="name" 
                               placeholder="{{ theme_setting('name_placeholder', 'your name') }}" 
                               value="{{ old('name') }}" required
                               class="form-input @error('name') is-invalid @enderror">
                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <input type="email" name="email" 
                               placeholder="{{ theme_setting('email_placeholder', 'your email') }}" 
                               value="{{ old('email') }}" required
                               class="form-input @error('email') is-invalid @enderror">
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <input type="text" name="subject" 
                               placeholder="{{ theme_setting('subject_placeholder', 'what shall we grow?') }}" 
                               value="{{ old('subject') }}" required
                               class="form-input @error('subject') is-invalid @enderror">
                        @error('subject')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="form-group">
                        <textarea name="message" rows="5" 
                                  placeholder="{{ theme_setting('message_placeholder', 'your message...') }}" 
                                  required class="form-textarea @error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                        @error('message')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <button type="submit" class="submit-btn">
                        <i class="fas fa-seedling"></i> {{ theme_setting('submit_button_text', 'plant the seed') }}
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection