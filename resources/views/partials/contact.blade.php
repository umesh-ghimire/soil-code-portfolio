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
        border-radius: clamp(60px, 10vw, 120px) clamp(15px, 3vw, 30px) 
                      clamp(60px, 10vw, 120px) clamp(15px, 3vw, 30px);
        padding: clamp(2rem, 6vw, 4rem) clamp(1.5rem, 5vw, 3rem);
        margin: clamp(3rem, 8vw, 5rem) 0;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(193, 123, 92, 0.2);
        box-shadow: var(--shadow-warm);
    }

    .contact-header {
        text-align: center;
        margin-bottom: clamp(2rem, 5vw, 3rem);
        position: relative;
        z-index: 2;
    }

    .contact-header h2 {
        font-size: clamp(2rem, 6vw, 3rem);
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
        width: min(80px, 20vw);
        height: 3px;
        background: repeating-linear-gradient(45deg, var(--clay), var(--clay) 6px, transparent 6px, transparent 12px);
    }

    .contact-header p {
        font-size: clamp(1rem, 3vw, 1.2rem);
        color: #5a6b5a;
        max-width: min(600px, 90%);
        margin: 1.5rem auto 0;
        font-style: italic;
        border-left: 4px solid var(--clay);
        padding-left: clamp(1rem, 3vw, 1.5rem);
    }

    .contact-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(min(300px, 100%), 1fr));
        gap: clamp(2rem, 5vw, 3rem);
        position: relative;
        z-index: 2;
    }

    /* Left side - Contact Info */
    .contact-info-card {
        background: rgba(255, 255, 255, 0.6);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 80px 20px 80px 20px;
        padding: clamp(1.5rem, 5vw, 2.5rem);
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
        gap: clamp(1rem, 3vw, 1.5rem);
        margin-bottom: 1.5rem;
        padding: clamp(1rem, 3vw, 1.2rem);
        background: white;
        border-radius: 50px 15px 50px 15px;
        border: 1px solid var(--clay-light);
        transition: all 0.3s;
        flex-wrap: wrap;
    }

    .contact-method:hover {
        transform: translateX(8px);
        border-color: var(--clay);
        box-shadow: 0 10px 20px -8px rgba(193, 123, 92, 0.3);
    }

    .contact-icon {
        width: clamp(50px, 8vw, 60px);
        height: clamp(50px, 8vw, 60px);
        background: linear-gradient(145deg, var(--clay-light), var(--clay));
        border-radius: 30% 50% 30% 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: clamp(1.5rem, 4vw, 1.8rem);
        flex-shrink: 0;
        box-shadow: 0 8px 15px -5px var(--clay);
    }

    .contact-detail h3 {
        font-size: clamp(1rem, 2.5vw, 1.1rem);
        font-weight: 700;
        color: var(--moss-deep);
        margin-bottom: 0.2rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .contact-detail p,
    .contact-detail a {
        color: #5a6b5a;
        text-decoration: none;
        font-size: clamp(0.95rem, 2.2vw, 1rem);
        word-break: break-word;
    }

    .response-commitment {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-top: 2rem;
        padding: clamp(1.2rem, 3vw, 1.5rem);
        background: linear-gradient(145deg, var(--ash), rgba(227, 219, 207, 0.5));
        border-radius: 60px 20px 60px 20px;
        border: 1px solid var(--clay-light);
        backdrop-filter: blur(5px);
        flex-wrap: wrap;
    }

    .response-commitment i {
        font-size: clamp(2rem, 5vw, 2.5rem);
        color: var(--clay);
        animation: pulse 2s infinite;
    }

    /* Right side - Contact Form */
    .contact-form-card {
        background: rgba(255, 255, 255, 0.6);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 80px 20px 80px 20px;
        padding: clamp(1.5rem, 5vw, 2.5rem);
        border: 1px solid rgba(193, 123, 92, 0.3);
        box-shadow: 0 15px 30px -10px rgba(44, 62, 47, 0.1);
    }

    .contact-form-card h3 {
        font-size: clamp(1.5rem, 5vw, 2rem);
        font-weight: 700;
        color: var(--moss-deep);
        margin-bottom: 1.5rem;
        font-family: 'Playfair Display', serif;
        position: relative;
        display: inline-block;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-input,
    .form-textarea {
        width: 100%;
        padding: clamp(0.8rem, 2vw, 1rem) clamp(1rem, 2.5vw, 1.5rem);
        background: white;
        border: 2px solid var(--clay-light);
        border-radius: 40px 12px 40px 12px;
        font-family: 'Inter', sans-serif;
        font-size: clamp(0.95rem, 2.2vw, 1rem);
        color: var(--ink);
        transition: all 0.3s;
        outline: none;
    }

    .form-textarea {
        min-height: 150px;
        resize: vertical;
    }

    .submit-btn {
        width: 100%;
        padding: clamp(1rem, 3vw, 1.2rem);
        background: linear-gradient(145deg, var(--moss), var(--moss-deep));
        color: white;
        border: none;
        border-radius: 60px 20px 60px 20px;
        font-weight: 700;
        font-size: clamp(1rem, 2.5vw, 1.1rem);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.8rem;
        cursor: pointer;
        transition: all 0.3s;
    }

    .submit-btn:hover {
        background: linear-gradient(145deg, var(--clay), var(--terra-cotta));
        border-radius: 30px 60px 30px 60px;
        transform: translateY(-2px);
        box-shadow: 0 15px 30px -10px var(--clay);
    }

    .social-mini {
        display: flex;
        gap: clamp(0.8rem, 2vw, 1rem);
        margin-top: 2rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .social-mini a {
        width: clamp(40px, 7vw, 45px);
        height: clamp(40px, 7vw, 45px);
        background: white;
        border-radius: 30% 50% 30% 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--moss);
        border: 2px solid var(--clay-light);
        font-size: clamp(1.1rem, 3vw, 1.2rem);
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

    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.7; transform: scale(1.1); }
    }

    @media (max-width: 768px) {
        .contact-method {
            flex-direction: column;
            text-align: center;
        }

        .response-commitment {
            flex-direction: column;
            text-align: center;
        }
    }

    @media (max-width: 480px) {
        .contact-section {
            padding: 2rem 1rem;
        }

        .contact-header h2 {
            font-size: 2rem;
        }

        .contact-header p {
            font-size: 1rem;
        }

        .submit-btn {
            width: 100%;
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