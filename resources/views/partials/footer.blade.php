@php
    $profile = \App\Models\Profile::first();
    $siteName = theme_setting('hero_name', 'Umesh Ghimire');
    $copyright = theme_setting('copyright_text', '© ' . date('Y') . ' ' . $siteName . ' — growing digital roots');
    
    // Safely get social links as array
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
    /* ===== CUSTOM FOOTER LAYOUT ===== */
    .custom-footer {
        background: #e7dfd3;
        border-top: 1px solid rgba(193, 123, 92, 0.25);
        margin-top: 4rem;
        padding: 3rem 0 2rem;
        width: 100%;
    }

    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Main Footer Row - 3 Columns */
    .footer-main-row {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-bottom: 3rem;
    }

    /* Left Column - Brand */
    .footer-left {
        flex: 0 0 30%;
        max-width: 30%;
    }

    .footer-logo {
        font-size: 2rem;
        font-weight: 800;
        color: var(--moss-deep);
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        margin-bottom: 0.5rem;
    }

    .footer-logo i {
        color: var(--clay);
        font-size: 1.8rem;
    }

    .footer-logo span {
        background: var(--moss);
        color: var(--rice);
        padding: 0.1rem 0.5rem;
        border-radius: 12px 4px 12px 4px;
    }

    .footer-tagline {
        color: #475a4a;
        font-style: italic;
        font-size: 1rem;
        margin: 0.5rem 0 1rem;
    }

    .response-time {
        display: inline-flex;
        align-items: center;
        gap: 0.8rem;
        background: white;
        padding: 0.7rem 1.5rem;
        border-radius: 50px 12px 50px 12px;
        border: 1px solid rgba(193, 123, 92, 0.5);
        font-size: 0.95rem;
        color: var(--moss-deep);
    }

    /* Middle Column - Explore & Reach Out */
    .footer-middle {
        flex: 0 0 35%;
        max-width: 35%;
        display: flex;
        justify-content: space-between;
    }

    .footer-middle-left {
        flex: 0 0 48%;
    }

    .footer-middle-right {
        flex: 0 0 48%;
    }

    .footer-heading {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--moss-deep);
        margin-bottom: 1.5rem;
        position: relative;
    }

    .footer-heading::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 40px;
        height: 2px;
        background: repeating-linear-gradient(45deg, var(--clay), var(--clay) 4px, transparent 4px, transparent 8px);
    }

    .footer-links-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links-list li {
        margin-bottom: 0.8rem;
    }

    .footer-links-list a {
        color: #475a4a;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.2s;
        font-size: 1rem;
    }

    .footer-links-list a i {
        font-size: 0.8rem;
        color: var(--clay);
        opacity: 0;
        transition: all 0.2s;
    }

    .footer-links-list a:hover {
        color: var(--clay);
        transform: translateX(5px);
    }

    .footer-links-list a:hover i {
        opacity: 1;
    }

    .contact-details {
        margin-top: 0;
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        margin-bottom: 1rem;
        color: #475a4a;
        font-size: 1rem;
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

    /* Right Column - Digital Soil */
    .footer-right {
        flex: 0 0 25%;
        max-width: 25%;
    }

    .social-links {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        margin-top: 1rem;
    }

    .social-link {
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

    .social-link:hover {
        transform: translateY(-5px) rotate(8deg);
        border-radius: 50% 30% 50% 30%;
        background: var(--clay);
        color: white;
        border-color: var(--clay);
    }

    /* Footer Bottom */
    .footer-bottom-row {
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
    }

    .legal-links {
        display: flex;
        gap: 2rem;
    }

    .legal-links a {
        color: #475a4a;
        text-decoration: none;
        transition: color 0.2s;
    }

    .legal-links a:hover {
        color: var(--clay);
    }

    /* ===== RESPONSIVE ===== */
    @media screen and (max-width: 1024px) {
        .footer-left,
        .footer-middle,
        .footer-right {
            flex: 0 0 100%;
            max-width: 100%;
            margin-bottom: 2.5rem;
            text-align: center;
        }

        .footer-left {
            text-align: center;
        }

        .footer-middle {
            justify-content: center;
            gap: 3rem;
        }

        .footer-middle-left,
        .footer-middle-right {
            flex: 0 0 200px;
            text-align: left;
        }

        .footer-right {
            text-align: center;
        }

        .footer-heading::after {
            left: 50%;
            transform: translateX(-50%);
        }

        .footer-links-list a {
            justify-content: center;
        }

        .contact-item {
            justify-content: center;
        }

        .social-links {
            justify-content: center;
        }

        .footer-bottom-row {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }

        .legal-links {
            justify-content: center;
        }
    }

    @media screen and (max-width: 768px) {
        .footer-middle {
            flex-direction: column;
            gap: 2rem;
            align-items: center;
        }

        .footer-middle-left,
        .footer-middle-right {
            width: 100%;
            max-width: 280px;
            text-align: center;
        }

        .footer-links-list a {
            justify-content: center;
        }

        .contact-item {
            justify-content: center;
        }

        .legal-links {
            flex-wrap: wrap;
            gap: 1rem;
        }
    }

    @media screen and (max-width: 480px) {
        .custom-footer {
            padding: 2rem 0 1.5rem;
        }

        .footer-logo {
            font-size: 1.6rem;
        }

        .response-time {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }

        .social-link {
            width: 45px;
            height: 45px;
            font-size: 1.2rem;
        }
    }

    /* Back to Top Button */
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
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .back-to-top.visible {
        opacity: 1;
        visibility: visible;
    }

    .back-to-top:hover {
        background: var(--moss);
        transform: translateY(-5px);
    }

    @media screen and (max-width: 768px) {
        .back-to-top {
            bottom: 1.5rem;
            right: 1.5rem;
            width: 45px;
            height: 45px;
            font-size: 1.1rem;
        }
    }
</style>

<footer class="custom-footer">
    <div class="footer-container">
        <!-- Main Row with 3 Columns -->
        <div class="footer-main-row">
            <!-- LEFT COLUMN - Brand -->
            <div class="footer-left">
                <a href="{{ route('home') }}" class="footer-logo">
                    <i class="fas fa-leaf"></i>
                    <span>{{ substr($siteName, 0, 1) }}</span>{{ substr($siteName, 1) }}
                </a>
                <p class="footer-tagline">{{ theme_setting('footer_tagline', 'hand‑coiled code potter') }}</p>
                <div class="response-time">
                    <i class="fas fa-moon"></i>
                    <span>{{ theme_setting('response_time', '1-28 days (I read everything)') }}</span>
                </div>
            </div>

            <!-- MIDDLE COLUMN - Explore & Reach Out -->
            <div class="footer-middle">
                <!-- Explore Section -->
                <div class="footer-middle-left">
                    <h3 class="footer-heading">{{ theme_setting('quick_links_title', 'explore') }}</h3>
                    <ul class="footer-links-list">
                        <li><a href="{{ route('home') }}"><i class="fas fa-seedling"></i> fields</a></li>
                        <li><a href="{{ route('projects.index') }}"><i class="fas fa-seedling"></i> projects</a></li>
                        <li><a href="{{ route('experience') }}"><i class="fas fa-seedling"></i> journey</a></li>
                        <li><a href="{{ route('skills') }}"><i class="fas fa-seedling"></i> tools</a></li>
                        <li><a href="{{ route('about') }}"><i class="fas fa-seedling"></i> story</a></li>
                        <li><a href="{{ route('contact.index') }}"><i class="fas fa-seedling"></i> seed</a></li>
                    </ul>
                </div>

                <!-- Reach Out Section -->
                <div class="footer-middle-right">
                    <h3 class="footer-heading">{{ theme_setting('contact_info_title', 'reach out') }}</h3>
                    <div class="contact-details">
                        @if($email)
                            <div class="contact-item">
                                <i class="fas fa-envelope"></i>
                                <a href="mailto:{{ $email }}">{{ $email }}</a>
                            </div>
                        @endif
                        @if($location)
                            <div class="contact-item">
                                <i class="fas fa-location-dot"></i>
                                <span>{{ $location }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN - Digital Soil -->
            <div class="footer-right">
                <h3 class="footer-heading">{{ theme_setting('social_links_title', 'digital soil') }}</h3>
                <div class="social-links">
                    @php
                        $defaultPlatforms = [
                            'github' => ['url' => '#', 'icon' => 'fab fa-github'],
                            'linkedin' => ['url' => '#', 'icon' => 'fab fa-linkedin-in'],
                            'twitter' => ['url' => '#', 'icon' => 'fab fa-twitter'],
                        ];
                        
                        if (!empty($socialLinks) && is_array($socialLinks)) {
                            foreach ($socialLinks as $platform => $url) {
                                if (isset($defaultPlatforms[$platform])) {
                                    $defaultPlatforms[$platform]['url'] = $url;
                                }
                            }
                        }
                    @endphp
                    
                    @foreach($defaultPlatforms as $platform => $data)
                        @if($data['url'] && $data['url'] !== '#')
                            <a href="{{ $data['url'] }}" target="_blank" class="social-link">
                                <i class="{{ $data['icon'] }}"></i>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Footer Bottom Row -->
        <div class="footer-bottom-row">
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