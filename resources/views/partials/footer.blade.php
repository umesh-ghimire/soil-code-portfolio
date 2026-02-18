@php
    $profile = \App\Models\Profile::first();
    $siteName = theme_setting('hero_name', 'Umesh Ghimire');
    $copyright = theme_setting('copyright_text', '© ' . date('Y') . ' ' . $siteName . ' — growing digital roots');
    
    // Safely get social links as array
    $socialLinks = [];
    if ($profile && !empty($profile->social_links)) {
        $rawSocialLinks = $profile->social_links;
        
        if (is_array($rawSocialLinks)) {
            // Handle [{"platform":"github","url":"..."} format
            foreach ($rawSocialLinks as $link) {
                if (isset($link['platform']) && isset($link['url'])) {
                    $socialLinks[$link['platform']] = $link['url'];
                }
            }
        } elseif (is_string($rawSocialLinks)) {
            $decoded = json_decode($rawSocialLinks, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                foreach ($decoded as $platform => $url) {
                    $socialLinks[$platform] = $url;
                }
            }
        }
    }
    
    $email = $profile->email ?? theme_setting('email', '');
    $phone = $profile->phone ?? theme_setting('phone', null);
    $location = $profile->location ?? theme_setting('location', 'Lalitpur, Nepal');
@endphp

<style>
    .organic-footer {
        background: #e7dfd3;
        border-top: 1px solid rgba(193, 123, 92, 0.25);
        margin-top: 2rem;
        padding: 4rem 0 2rem;
        position: relative;
        z-index: 22;
    }

    .footer-container {
        max-width: 1300px;
        margin: 0 auto;
        padding: 0 28px;
    }

    .footer-grid {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1.5fr;
        gap: 3rem;
        margin-bottom: 3rem;
    }

    .footer-brand {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .footer-logo {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--moss-deep);
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .footer-logo i {
        color: var(--clay);
        font-size: 1.6rem;
        transition: transform 0.3s ease;
    }

    .footer-logo:hover i {
        transform: rotate(-10deg) scale(1.1);
    }

    .footer-logo span {
        background: var(--moss);
        color: var(--rice);
        padding: 0.1rem 0.5rem;
        border-radius: 12px 4px 12px 4px;
        transition: all 0.3s ease;
    }

    .footer-logo:hover span {
        border-radius: 4px 12px 4px 12px;
        background: var(--clay);
    }

    .footer-tagline {
        color: #475a4a;
        font-style: italic;
        line-height: 1.6;
    }

    .footer-commitment {
        display: inline-flex;
        align-items: center;
        gap: 0.8rem;
        background: white;
        padding: 0.7rem 1.5rem;
        border-radius: 50px 12px 50px 12px;
        border: 1px solid rgba(193, 123, 92, 0.5);
        font-size: 0.95rem;
        color: var(--moss-deep);
        transition: all 0.3s;
    }

    .footer-commitment:hover {
        background: rgba(193, 123, 92, 0.1);
        transform: translateY(-2px);
    }

    .footer-links h3,
    .footer-contact h3,
    .footer-social h3 {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--moss-deep);
        margin-bottom: 1.5rem;
        position: relative;
    }

    .footer-links h3::after,
    .footer-contact h3::after,
    .footer-social h3::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 40px;
        height: 2px;
        background: repeating-linear-gradient(45deg, var(--clay), var(--clay) 4px, transparent 4px, transparent 8px);
    }

    .footer-links ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li {
        margin-bottom: 0.8rem;
    }

    .footer-links a {
        color: #475a4a;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s;
    }

    .footer-links a i {
        font-size: 0.8rem;
        color: var(--clay);
        opacity: 0;
        transition: all 0.2s;
    }

    .footer-links a:hover {
        color: var(--clay);
        transform: translateX(5px);
    }

    .footer-links a:hover i {
        opacity: 1;
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        margin-bottom: 1rem;
        color: #475a4a;
    }

    .contact-item i {
        width: 20px;
        color: var(--clay);
    }

    .contact-item a {
        color: #475a4a;
        text-decoration: none;
    }

    .contact-item a:hover {
        color: var(--clay);
    }

    .social-basket {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
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

    .footer-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 2rem;
        border-top: 1px dashed rgba(193, 123, 92, 0.25);
        color: #475a4a;
        font-size: 0.95rem;
    }

    .copyright i {
        color: var(--clay);
        margin-right: 0.5rem;
        animation: pulse 2s infinite;
    }

    .legal-links {
        display: flex;
        gap: 2rem;
    }

    .legal-links a {
        color: #475a4a;
        text-decoration: none;
        transition: color 0.2s;
        position: relative;
    }

    .legal-links a::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 1px;
        background: var(--clay);
        transition: width 0.2s;
    }

    .legal-links a:hover {
        color: var(--clay);
    }

    .legal-links a:hover::after {
        width: 100%;
    }

    .back-to-top {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        width: 50px;
        height: 50px;
        border-radius: 30% 50% 30% 50%;
        background: var(--clay);
        color: white;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s;
        z-index: 99;
        box-shadow: var(--shadow-warm);
    }

    .back-to-top.visible {
        opacity: 1;
        visibility: visible;
    }

    .back-to-top:hover {
        background: var(--moss);
        transform: translateY(-5px);
        border-radius: 50% 30% 50% 30%;
    }

    @media (max-width: 1024px) {
        .footer-grid { grid-template-columns: 1fr 1fr; }
        .footer-brand { grid-column: 1 / -1; }
    }

    @media (max-width: 768px) {
        .footer-grid { grid-template-columns: 1fr; }
        .footer-bottom { flex-direction: column; gap: 1rem; text-align: center; }
        .legal-links { flex-wrap: wrap; justify-content: center; }
        .back-to-top { bottom: 1rem; right: 1rem; }
        .social-basket { justify-content: center; }
    }
</style>

<footer class="organic-footer">
    <div class="footer-container">
        <div class="footer-grid">
            <div class="footer-brand">
                <a href="{{ route('home') }}" class="footer-logo">
                    <i class="fas fa-leaf"></i>
                    <span>{{ substr($siteName, 0, 1) }}</span>{{ substr($siteName, 1) }}
                </a>
                <p class="footer-tagline">
                    {{ theme_setting('footer_tagline', 'hand‑coiled code potter') }}
                </p>
                <div class="footer-commitment">
                    <i class="fas fa-moon"></i>
                    <span>{{ theme_setting('response_time', 'reply within a moon cycle 🌙') }}</span>
                </div>
            </div>

            <div class="footer-links">
                <h3>{{ theme_setting('quick_links_title', 'explore') }}</h3>
                <ul>
                    <li><a href="{{ route('home') }}"><i class="fas fa-seedling"></i> fields</a></li>
                    <li><a href="{{ route('projects.index') }}"><i class="fas fa-seedling"></i> projects</a></li>
                    <li><a href="{{ route('experience') }}"><i class="fas fa-seedling"></i> journey</a></li>
                    <li><a href="{{ route('skills') }}"><i class="fas fa-seedling"></i> tools</a></li>
                    <li><a href="{{ route('about') }}"><i class="fas fa-seedling"></i> story</a></li>
                    <li><a href="{{ route('contact.index') }}"><i class="fas fa-seedling"></i> seed</a></li>
                </ul>
            </div>

            <div class="footer-contact">
                <h3>{{ theme_setting('contact_info_title', 'reach out') }}</h3>
                @if($email)
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <a href="mailto:{{ $email }}">{{ $email }}</a>
                    </div>
                @endif
                @if($phone)
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <a href="tel:{{ $phone }}">{{ $phone }}</a>
                    </div>
                @endif
                @if($location)
                    <div class="contact-item">
                        <i class="fas fa-location-dot"></i>
                        <span>{{ $location }}</span>
                    </div>
                @endif
            </div>

            <div class="footer-social">
                <h3>{{ theme_setting('social_links_title', 'digital soil') }}</h3>
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

        <div class="footer-bottom">
            <div class="copyright">
                <i class="fas fa-leaf"></i>
                {!! $copyright !!}
            </div>
            <div class="legal-links">
                <a href="{{ route('legal.privacy') }}">Privacy</a>
                <a href="{{ route('legal.terms') }}">Terms</a>
                <a href="{{ route('legal.cookie') }}">Cookie</a>
                <a href="{{ route('legal.disclaimer') }}">Disclaimer</a>
            </div>
        </div>
    </div>
</footer>

<button id="backToTop" class="back-to-top">
    <i class="fas fa-arrow-up"></i>
</button>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const backToTop = document.getElementById('backToTop');
    if (backToTop) {
        window.addEventListener('scroll', function() {
            backToTop.classList.toggle('visible', window.scrollY > 500);
        });
        
        backToTop.addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
});
</script>