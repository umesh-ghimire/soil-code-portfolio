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
            if (isset($rawSocialLinks[0]) && is_array($rawSocialLinks[0]) && isset($rawSocialLinks[0]['platform'])) {
                foreach ($rawSocialLinks as $link) {
                    if (isset($link['platform']) && isset($link['url'])) {
                        $socialLinks[$link['platform']] = $link['url'];
                    }
                }
            } else {
                $socialLinks = $rawSocialLinks;
            }
        } elseif (is_string($rawSocialLinks)) {
            $decoded = json_decode($rawSocialLinks, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                if (isset($decoded[0]) && is_array($decoded[0]) && isset($decoded[0]['platform'])) {
                    foreach ($decoded as $link) {
                        if (isset($link['platform']) && isset($link['url'])) {
                            $socialLinks[$link['platform']] = $link['url'];
                        }
                    }
                } else {
                    $socialLinks = $decoded;
                }
            }
        }
    }
@endphp

<style>
    .contact-section {
        background: linear-gradient(145deg, rgba(193, 123, 92, 0.03), rgba(76, 107, 74, 0.03));
        border-radius: 120px 30px 120px 30px;
        padding: 4rem 3rem;
        margin: 5rem 0;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(193, 123, 92, 0.2);
        box-shadow: var(--shadow-warm);
    }
    
    .contact-section::before {
        content: '';
        position: absolute;
        top: -100px;
        right: -100px;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(193, 123, 92, 0.1) 0%, transparent 70%);
        border-radius: 50%;
        animation: float 20s infinite alternate;
    }
    
    .contact-section::after {
        content: '';
        position: absolute;
        bottom: -100px;
        left: -100px;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(76, 107, 74, 0.1) 0%, transparent 70%);
        border-radius: 50%;
        animation: float 25s infinite alternate-reverse;
    }
    
    .contact-header {
        text-align: center;
        margin-bottom: 3rem;
        position: relative;
        z-index: 2;
    }
    
    .contact-header h2 {
        font-size: 3.5rem;
        font-weight: 800;
        color: var(--moss-deep);
        margin-bottom: 0.5rem;
        font-family: 'Playfair Display', serif;
        letter-spacing: -0.02em;
        position: relative;
        display: inline-block;
    }
    
    .contact-header h2::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background: repeating-linear-gradient(45deg, var(--clay), var(--clay) 6px, transparent 6px, transparent 12px);
    }
    
    .contact-header p {
        font-size: 1.3rem;
        color: #5a6b5a;
        max-width: 600px;
        margin: 1.5rem auto 0;
        font-style: italic;
        border-left: 4px solid var(--clay);
        padding-left: 1.5rem;
    }
    
    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 3rem;
        position: relative;
        z-index: 2;
    }
    
    /* Left side - Contact Info */
    .contact-info-card {
        background: rgba(255, 255, 255, 0.6);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 80px 20px 80px 20px;
        padding: 2.5rem;
        border: 1px solid rgba(193, 123, 92, 0.3);
        box-shadow: 0 15px 30px -10px rgba(44, 62, 47, 0.1);
        transition: all 0.3s ease;
    }
    
    .contact-info-card:hover {
        border-color: var(--clay);
        box-shadow: 0 20px 40px -10px rgba(193, 123, 92, 0.2);
    }
    
    .contact-method {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-bottom: 2rem;
        padding: 1.2rem;
        background: white;
        border-radius: 50px 15px 50px 15px;
        border: 1px solid var(--clay-light);
        transition: all 0.3s;
    }
    
    .contact-method:hover {
        transform: translateX(8px);
        border-color: var(--clay);
        box-shadow: 0 10px 20px -8px rgba(193, 123, 92, 0.3);
    }
    
    .contact-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(145deg, var(--clay-light), var(--clay));
        border-radius: 30% 50% 30% 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.8rem;
        flex-shrink: 0;
        box-shadow: 0 8px 15px -5px var(--clay);
    }
    
    .contact-detail h3 {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--moss-deep);
        margin-bottom: 0.3rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .contact-detail p,
    .contact-detail a {
        color: #5a6b5a;
        text-decoration: none;
        font-size: 1.1rem;
        transition: color 0.3s;
    }
    
    .contact-detail a:hover {
        color: var(--clay);
    }
    
    .response-commitment {
        display: flex;
        align-items: center;
        gap: 1.2rem;
        margin-top: 2rem;
        padding: 1.5rem;
        background: linear-gradient(145deg, var(--ash), rgba(227, 219, 207, 0.5));
        border-radius: 60px 20px 60px 20px;
        border: 1px solid var(--clay-light);
        backdrop-filter: blur(5px);
    }
    
    .response-commitment i {
        font-size: 2.5rem;
        color: var(--clay);
        animation: pulse 2s infinite;
    }
    
    .response-commitment strong {
        color: var(--moss-deep);
        display: block;
        margin-bottom: 0.3rem;
        font-size: 1.1rem;
    }
    
    .response-commitment p {
        color: #5a6b5a;
        font-size: 0.95rem;
        line-height: 1.5;
    }
    
    /* Right side - Contact Form */
    .contact-form-card {
        background: rgba(255, 255, 255, 0.6);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 80px 20px 80px 20px;
        padding: 2.5rem;
        border: 1px solid rgba(193, 123, 92, 0.3);
        box-shadow: 0 15px 30px -10px rgba(44, 62, 47, 0.1);
    }
    
    .contact-form-card h3 {
        font-size: 2rem;
        font-weight: 700;
        color: var(--moss-deep);
        margin-bottom: 2rem;
        font-family: 'Playfair Display', serif;
        position: relative;
        display: inline-block;
    }
    
    .contact-form-card h3::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 60px;
        height: 3px;
        background: repeating-linear-gradient(45deg, var(--clay), var(--clay) 6px, transparent 6px, transparent 12px);
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-input,
    .form-textarea {
        width: 100%;
        padding: 1.2rem 1.5rem;
        background: white;
        border: 2px solid var(--clay-light);
        border-radius: 40px 12px 40px 12px;
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
        color: var(--ink);
        transition: all 0.3s;
        outline: none;
    }
    
    .form-input:focus,
    .form-textarea:focus {
        border-color: var(--clay);
        border-radius: 12px 40px 12px 40px;
        box-shadow: 0 0 0 3px rgba(193, 123, 92, 0.1);
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
        margin-left: 0.5rem;
    }
    
    .submit-btn {
        width: 100%;
        padding: 1.2rem;
        background: linear-gradient(145deg, var(--moss), var(--moss-deep));
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
        border: 1px solid transparent;
    }
    
    .submit-btn:hover {
        background: linear-gradient(145deg, var(--clay), var(--terra-cotta));
        border-radius: 30px 60px 30px 60px;
        transform: translateY(-2px);
        box-shadow: 0 15px 30px -10px var(--clay);
    }
    
    .submit-btn i {
        transition: transform 0.3s;
    }
    
    .submit-btn:hover i {
        transform: translateX(5px) rotate(10deg);
    }
    
    .success-message {
        background: linear-gradient(145deg, var(--moss), var(--moss-deep));
        color: white;
        padding: 1.5rem;
        border-radius: 60px 20px 60px 20px;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        animation: slideIn 0.5s ease;
    }
    
    .success-message i {
        font-size: 2rem;
        background: white;
        color: var(--moss);
        width: 50px;
        height: 50px;
        border-radius: 30% 50% 30% 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .social-mini {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        justify-content: center;
    }
    
    .social-mini a {
        width: 45px;
        height: 45px;
        background: white;
        border-radius: 30% 50% 30% 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--moss);
        border: 2px solid var(--clay-light);
        font-size: 1.2rem;
        transition: all 0.3s;
        text-decoration: none;
    }
    
    .social-mini a:hover {
        background: var(--clay);
        color: white;
        border-color: var(--clay);
        transform: translateY(-5px) rotate(8deg);
        border-radius: 50% 30% 50% 30%;
    }
    
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes float {
        0%, 100% { transform: translate(0, 0) rotate(0deg); }
        50% { transform: translate(20px, -20px) rotate(5deg); }
    }
    
    @media (max-width: 900px) {
        .contact-section {
            padding: 3rem 1.5rem;
        }
        
        .contact-header h2 {
            font-size: 2.8rem;
        }
        
        .contact-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        
        .contact-info-card {
            padding: 2rem;
        }
        
        .contact-form-card {
            padding: 2rem;
        }
    }
    
    @media (max-width: 480px) {
        .contact-header h2 {
            font-size: 2.2rem;
        }
        
        .contact-header p {
            font-size: 1.1rem;
        }
        
        .contact-method {
            flex-direction: column;
            text-align: center;
            gap: 0.8rem;
        }
        
        .response-commitment {
            flex-direction: column;
            text-align: center;
        }
    }
</style>

<div class="contact-section">
    <div class="contact-header">
        <h2>{{ theme_setting('contact_section_title', "let's grow together") }}</h2>
        <p>{{ theme_setting('contact_subtitle', 'reach out, I reply within a moon cycle 🌙') }}</p>
    </div>
    
    <div class="contact-grid">
        <!-- Left side - Contact Info -->
        <div class="contact-info-card">
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
            
            @if($location)
            <div class="contact-method">
                <div class="contact-icon">
                    <i class="fas fa-location-dot"></i>
                </div>
                <div class="contact-detail">
                    <h3>{{ theme_setting('location_label', 'field office') }}</h3>
                    <p>{{ $location }}</p>
                </div>
            </div>
            @endif
            
            <div class="response-commitment">
                <i class="fas fa-moon"></i>
                <div>
                    <strong>{{ theme_setting('response_commitment', '🌙 one moon cycle guarantee') }}</strong>
                    <p>{{ theme_setting('response_detail', 'I read every message with care and will reply within a moon cycle. Your words matter to me.') }}</p>
                </div>
            </div>
            
            <!-- Social Links (Mini) -->
            @if(!empty($socialLinks))
            <div class="social-mini">
                @foreach($socialLinks as $platform => $url)
                    @if($url && $url !== '#')
                        <a href="{{ $url }}" target="_blank" title="{{ ucfirst($platform) }}">
                            <i class="fab fa-{{ $platform }}"></i>
                        </a>
                    @endif
                @endforeach
            </div>
            @endif
        </div>
        
        <!-- Right side - Contact Form -->
        <div class="contact-form-card">
            <h3>{{ theme_setting('form_title', 'plant a seed') }}</h3>
            
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
                    <i class="fas fa-seedling"></i> 
                    <span>{{ theme_setting('submit_button_text', 'plant the seed') }}</span>
                    <i class="fas fa-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>
</div>