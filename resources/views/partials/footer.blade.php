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
    /* ===== MODERN FOOTER DESIGN ===== */
    .modern-footer {
        background: #2a4230; /* Dark moss color */
        color: #ffffff; /* White text */
        margin-top: 5rem;
        padding: 4rem 0 2rem;
        width: 100%;
        position: relative;
        border-top: 3px solid #c17b5c;
    }

    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 30px;
    }

    /* Main Footer Content */
    .footer-content {
        display: grid;
        grid-template-columns: 1.5fr 2fr 1.5fr;
        gap: 3rem;
        margin-bottom: 3rem;
    }

    /* Brand Section */
    .footer-brand {
        color: #ffffff;
    }

    .footer-logo {
        font-size: 2rem;
        font-weight: 800;
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        margin-bottom: 1rem;
    }

    .footer-logo i {
        color: #c17b5c;
        font-size: 2rem;
    }

    .footer-logo span {
        background: #c17b5c;
        color: #ffffff;
        padding: 0.1rem 0.5rem;
        border-radius: 8px;
    }

    .footer-description {
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        color: #ffffff;
        opacity: 0.9;
    }

    .footer-commitment {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(255, 255, 255, 0.1);
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.9rem;
        color: #ffffff;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .footer-commitment i {
        color: #c17b5c;
    }

    /* Links Grid */
    .footer-links-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
    }

    .footer-column h4 {
        color: #ffffff;
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 1.2rem;
        position: relative;
        display: inline-block;
    }

    .footer-column h4::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 30px;
        height: 2px;
        background: #c17b5c;
    }

    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li {
        margin-bottom: 0.7rem;
    }

    .footer-links a {
        color: #ffffff;
        text-decoration: none;
        font-size: 0.95rem;
        opacity: 0.8;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
    }

    .footer-links a:hover {
        opacity: 1;
        color: #c17b5c;
        transform: translateX(5px);
    }

    .footer-links a i {
        font-size: 0.7rem;
        color: #c17b5c;
    }

    /* Contact Info */
    .contact-info {
        margin-bottom: 1.5rem;
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        margin-bottom: 1rem;
        color: #ffffff;
        font-size: 0.95rem;
        opacity: 0.9;
    }

    .contact-item i {
        color: #c17b5c;
        width: 20px;
        font-size: 1rem;
    }

    .contact-item a {
        color: #ffffff;
        text-decoration: none;
    }

    .contact-item a:hover {
        color: #c17b5c;
    }

    .contact-item span {
        color: #ffffff;
    }

    /* Social Links */
    .social-heading {
        color: #ffffff;
        font-size: 1rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .social-icons {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .social-icon {
        background: rgba(255, 255, 255, 0.1);
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.2rem;
        transition: all 0.3s;
        text-decoration: none;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .social-icon:hover {
        background: #c17b5c;
        color: #ffffff;
        transform: translateY(-3px);
    }

    /* Footer Bottom */
    .footer-bottom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 2rem;
        border-top: 1px solid rgba(255, 255, 255, 0.2);
        font-size: 0.9rem;
    }

    .copyright {
        color: #ffffff;
        opacity: 0.7;
    }

    .copyright i {
        color: #c17b5c;
        margin-right: 0.3rem;
    }

    .legal-links {
        display: flex;
        gap: 2rem;
    }

    .legal-links a {
        color: #ffffff;
        text-decoration: none;
        opacity: 0.7;
        transition: all 0.3s;
    }

    .legal-links a:hover {
        opacity: 1;
        color: #c17b5c;
    }

    /* Back to Top Button */
    .back-to-top {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: #c17b5c;
        color: #ffffff;
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
        box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }

    .back-to-top.visible {
        opacity: 1;
        visibility: visible;
    }

    .back-to-top:hover {
        background: #eac5b0;
        color: #2a4230;
        transform: translateY(-5px);
    }

    /* ===== RESPONSIVE DESIGN ===== */
    
    /* Tablet */
    @media screen and (max-width: 900px) {
        .footer-content {
            grid-template-columns: 1fr;
            gap: 2rem;
        }

        .footer-brand {
            text-align: center;
        }

        .footer-commitment {
            margin: 0 auto;
        }

        .footer-links-grid {
            max-width: 600px;
            margin: 0 auto;
            width: 100%;
        }

        .footer-column {
            text-align: left;
        }
    }

    /* Mobile */
    @media screen and (max-width: 600px) {
        .modern-footer {
            padding: 3rem 0 1.5rem;
        }

        .footer-container {
            padding: 0 20px;
        }

        .footer-links-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .footer-column h4 {
            font-size: 1rem;
        }

        .footer-links a {
            font-size: 0.9rem;
        }

        .contact-item {
            font-size: 0.9rem;
        }

        .social-icons {
            justify-content: center;
        }

        .footer-bottom {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }

        .legal-links {
            flex-wrap: wrap;
            justify-content: center;
            gap: 1.5rem;
        }
    }

    /* Small Mobile */
    @media screen and (max-width: 400px) {
        .footer-links-grid {
            grid-template-columns: 1fr;
            text-align: center;
        }

        .footer-column h4::after {
            left: 50%;
            transform: translateX(-50%);
        }

        .footer-links a {
            justify-content: center;
        }

        .footer-links a i {
            display: none;
        }

        .legal-links {
            gap: 1rem;
        }
    }
</style>

<footer class="modern-footer">
    <div class="footer-container">
        <!-- Main Footer Content -->
        <div class="footer-content">
            <!-- Brand Section -->
            <div class="footer-brand">
                <a href="{{ route('home') }}" class="footer-logo">
                    <i class="fas fa-leaf"></i>
                    <span>{{ substr($siteName, 0, 1) }}</span>{{ substr($siteName, 1) }}
                </a>
                <p class="footer-description">
                    {{ theme_setting('footer_description', 'Hand-crafted digital experiences with organic roots and Himalayan wisdom.') }}
                </p>
                <div class="footer-commitment">
                    <i class="fas fa-moon"></i>
                    <span>{{ theme_setting('response_time', 'reply within a moon cycle') }}</span>
                </div>
            </div>

            <!-- Links Grid -->
            <div class="footer-links-grid">
                <div class="footer-column">
                    <h4>Explore</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}"><i class="fas fa-chevron-right"></i> Fields</a></li>
                        <li><a href="{{ route('projects.index') }}"><i class="fas fa-chevron-right"></i> Projects</a></li>
                        <li><a href="{{ route('experience') }}"><i class="fas fa-chevron-right"></i> Journey</a></li>
                        <li><a href="{{ route('skills') }}"><i class="fas fa-chevron-right"></i> Tools</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h4>Connect</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('about') }}"><i class="fas fa-chevron-right"></i> Story</a></li>
                        <li><a href="{{ route('contact.index') }}"><i class="fas fa-chevron-right"></i> Seed</a></li>
                        <li><a href="{{ route('blog.index') }}"><i class="fas fa-chevron-right"></i> Blog</a></li>
                    </ul>
                </div>
            </div>

            <!-- Contact & Social -->
            <div class="footer-contact">
                <div class="contact-info">
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

                <div class="social-heading">Digital Soil</div>
                <div class="social-icons">
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
                            <a href="{{ $data['url'] }}" target="_blank" class="social-icon">
                                <i class="{{ $data['icon'] }}"></i>
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="copyright">
                <i class="fas fa-leaf"></i>
                {!! $copyright !!}
            </div>
            <div class="legal-links">
                <a href="{{ route('legal.privacy') }}">Privacy</a>
                <a href="{{ route('legal.terms') }}">Terms</a>
                <a href="{{ route('legal.cookie') }}">Cookies</a>
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