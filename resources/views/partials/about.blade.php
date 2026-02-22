@php
    $profile = \App\Models\Profile::first();
    
    $yearsExperience = $profile->years_experience ?? 8;
    $projectsCount = \App\Models\Project::where('is_published', true)->count();
    $skillsCount = \App\Models\Skill::where('is_published', true)->count();
    
    $bio = $profile->bio ?? theme_setting('about_description', 'Born in a Dhankuta village without internet, I learned to code by moonlight — literally. Now I build for the web with the same patience it takes to grow millet.');
    
    // Get social links
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
    /* ===== ABOUT SECTION STYLES - FULLY RESPONSIVE ===== */
    .about-root-section {
        margin: clamp(3rem, 8vw, 6rem) 0;
        position: relative;
    }

    /* Background Elements */
    .about-root-section::before {
        content: '';
        position: absolute;
        top: -50px;
        left: -50px;
        width: min(300px, 40vw);
        height: min(300px, 40vw);
        background: radial-gradient(circle, rgba(193, 123, 92, 0.08) 0%, transparent 70%);
        border-radius: 50%;
        z-index: 0;
        animation: float 20s infinite alternate;
    }

    .about-root-section::after {
        content: '';
        position: absolute;
        bottom: -50px;
        right: -50px;
        width: min(300px, 40vw);
        height: min(300px, 40vw);
        background: radial-gradient(circle, rgba(76, 107, 74, 0.08) 0%, transparent 70%);
        border-radius: 50%;
        z-index: 0;
        animation: float 25s infinite alternate-reverse;
    }

    /* Main Container */
    .about-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 clamp(15px, 4vw, 20px);
        position: relative;
        z-index: 2;
    }

    /* Section Header */
    .about-header {
        text-align: center;
        margin-bottom: clamp(2rem, 6vw, 4rem);
        position: relative;
    }

    .about-header h2 {
        font-size: clamp(2.5rem, 8vw, 4rem);
        font-weight: 800;
        color: var(--moss-deep);
        font-family: 'Playfair Display', serif;
        letter-spacing: -0.02em;
        position: relative;
        display: inline-block;
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .about-header h2 .nepali {
        font-family: 'Tiro Devanagari Sanskrit', serif;
        color: var(--clay);
        font-size: clamp(1.5rem, 5vw, 2.5rem);
        display: block;
        margin-top: 0.5rem;
    }

    .about-header h2::after {
        content: '';
        position: absolute;
        bottom: -15px;
        left: 50%;
        transform: translateX(-50%);
        width: min(120px, 30vw);
        height: 4px;
        background: repeating-linear-gradient(45deg, var(--clay), var(--clay) 10px, transparent 10px, transparent 20px);
        border-radius: 2px;
    }

    .about-header p {
        font-size: clamp(1rem, 3vw, 1.2rem);
        color: #5a6b5a;
        max-width: 600px;
        margin: 2rem auto 0;
        font-style: italic;
        padding: 0 1rem;
    }

    /* Main Content Grid - Responsive */
    .about-content-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(min(300px, 100%), 1fr));
        gap: clamp(2rem, 5vw, 3rem);
        align-items: center;
        background: rgba(255, 247, 240, 0.4);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: clamp(60px, 10vw, 120px) clamp(15px, 3vw, 30px) 
                      clamp(60px, 10vw, 120px) clamp(15px, 3vw, 30px);
        padding: clamp(1.5rem, 5vw, 3rem);
        border: 1px solid rgba(193, 123, 92, 0.3);
        box-shadow: var(--shadow-warm);
        position: relative;
        overflow: hidden;
    }

    /* Left Side - Stats */
    .stats-organic {
        display: flex;
        flex-direction: column;
        gap: clamp(1rem, 3vw, 1.5rem);
    }

    .stat-item-large {
        background: white;
        border-radius: clamp(60px, 10vw, 80px) clamp(15px, 3vw, 20px) 
                      clamp(60px, 10vw, 80px) clamp(15px, 3vw, 20px);
        padding: clamp(1.5rem, 5vw, 2.5rem) clamp(1rem, 4vw, 2rem);
        text-align: center;
        border: 1px solid var(--clay-light);
        box-shadow: 0 15px 30px -10px rgba(193, 123, 92, 0.15);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-number-large {
        font-size: clamp(3rem, 12vw, 5rem);
        font-weight: 800;
        color: var(--clay);
        line-height: 1;
        font-family: 'Playfair Display', serif;
        margin-bottom: 0.5rem;
    }

    .stat-label-large {
        font-size: clamp(1rem, 3vw, 1.2rem);
        color: var(--moss-deep);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .stat-grid-small {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(min(140px, 100%), 1fr));
        gap: clamp(1rem, 3vw, 1.5rem);
    }

    .stat-item-small {
        background: white;
        border-radius: clamp(40px, 8vw, 50px) clamp(10px, 2vw, 15px) 
                      clamp(40px, 8vw, 50px) clamp(10px, 2vw, 15px);
        padding: clamp(1rem, 3vw, 1.5rem);
        text-align: center;
        border: 1px solid var(--clay-light);
        transition: all 0.3s ease;
    }

    .stat-number-small {
        font-size: clamp(1.8rem, 6vw, 2.5rem);
        font-weight: 700;
        color: var(--clay);
        line-height: 1;
        font-family: 'Playfair Display', serif;
        margin-bottom: 0.3rem;
    }

    .stat-label-small {
        font-size: clamp(0.8rem, 2vw, 0.9rem);
        color: var(--moss-deep);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Right Side - Story */
    .story-container {
        padding: clamp(0.5rem, 2vw, 1rem);
    }

    .story-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.8rem;
        background: rgba(193, 123, 92, 0.1);
        padding: 0.5rem clamp(1rem, 3vw, 1.5rem);
        border-radius: clamp(30px, 6vw, 40px) clamp(8px, 2vw, 12px) 
                      clamp(30px, 6vw, 40px) clamp(8px, 2vw, 12px);
        margin-bottom: clamp(1rem, 3vw, 2rem);
        border: 1px solid rgba(193, 123, 92, 0.3);
        font-size: clamp(0.85rem, 2vw, 0.95rem);
    }

    .story-badge i {
        color: var(--clay);
        font-size: clamp(1rem, 2.5vw, 1.2rem);
    }

    .story-badge span {
        color: var(--moss-deep);
        font-weight: 600;
        letter-spacing: 1px;
    }

    .story-title {
        font-size: clamp(1.5rem, 5vw, 2.2rem);
        font-weight: 700;
        color: var(--moss-deep);
        font-family: 'Playfair Display', serif;
        margin-bottom: clamp(1rem, 3vw, 1.5rem);
        line-height: 1.3;
        word-wrap: break-word;
    }

    .story-title .highlight {
        color: var(--clay);
        font-style: italic;
    }

    .story-text {
        color: #4a5a4a;
        line-height: 1.9;
        font-size: clamp(0.95rem, 2.5vw, 1.1rem);
        margin-bottom: clamp(1.5rem, 4vw, 2rem);
        border-left: 4px solid var(--clay-light);
        padding-left: clamp(1rem, 3vw, 1.5rem);
        word-wrap: break-word;
    }

    .story-quote {
        background: linear-gradient(145deg, rgba(193, 123, 92, 0.05), rgba(76, 107, 74, 0.05));
        border-radius: clamp(40px, 8vw, 60px) clamp(15px, 3vw, 20px) 
                      clamp(40px, 8vw, 60px) clamp(15px, 3vw, 20px);
        padding: clamp(1.5rem, 4vw, 2rem);
        margin: clamp(1.5rem, 4vw, 2rem) 0;
        border: 1px solid rgba(193, 123, 92, 0.2);
        font-style: italic;
        position: relative;
    }

    .story-quote i {
        color: var(--clay);
        font-size: clamp(1.5rem, 4vw, 2rem);
        opacity: 0.3;
        position: absolute;
        top: 1rem;
        left: 1rem;
    }

    .story-quote p {
        color: var(--moss-deep);
        font-size: clamp(0.95rem, 2.5vw, 1.1rem);
        line-height: 1.8;
        position: relative;
        z-index: 2;
        margin-left: clamp(1.5rem, 4vw, 2rem);
        word-wrap: break-word;
    }

    .story-quote .author {
        margin-top: 1rem;
        color: var(--clay);
        font-weight: 600;
        text-align: right;
        font-size: clamp(0.85rem, 2vw, 0.95rem);
    }

    /* Social Links */
    .social-roots {
        margin-top: clamp(1.5rem, 4vw, 2.5rem);
        padding-top: clamp(1.5rem, 4vw, 2rem);
        border-top: 2px dashed var(--clay-light);
    }

    .social-roots-title {
        font-size: clamp(0.9rem, 2.5vw, 1rem);
        color: var(--moss);
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 1.2rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .social-icons-row {
        display: flex;
        gap: clamp(0.8rem, 2vw, 1rem);
        flex-wrap: wrap;
    }

    .social-icon-root {
        background: white;
        width: clamp(45px, 8vw, 55px);
        height: clamp(45px, 8vw, 55px);
        border-radius: 30% 50% 30% 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--moss);
        border: 2px solid var(--clay-light);
        font-size: clamp(1.2rem, 3vw, 1.5rem);
        transition: all 0.3s;
        text-decoration: none;
        position: relative;
        overflow: hidden;
    }

    /* Signature */
    .signature-root {
        margin-top: clamp(1.5rem, 4vw, 2rem);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: clamp(0.8rem, 2vw, 1rem);
        font-family: 'Tiro Devanagari Sanskrit', serif;
        color: var(--moss-deep);
        font-size: clamp(1.1rem, 3vw, 1.3rem);
        flex-wrap: wrap;
    }

    .signature-root .nepali {
        color: var(--clay);
        font-size: clamp(1.2rem, 4vw, 1.5rem);
    }

    /* Responsive Breakpoints */
    @media (max-width: 768px) {
        .about-content-grid {
            text-align: center;
        }
        
        .story-badge {
            margin-left: auto;
            margin-right: auto;
        }
        
        .story-text {
            text-align: left;
        }
        
        .story-quote p {
            margin-left: 0;
        }
        
        .story-quote i {
            display: none;
        }
        
        .social-icons-row {
            justify-content: center;
        }
        
        .social-roots-title {
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .about-header h2 {
            font-size: 2.2rem;
        }
        
        .about-header h2 .nepali {
            font-size: 1.3rem;
        }
        
        .stat-grid-small {
            grid-template-columns: 1fr;
        }
        
        .story-title {
            font-size: 1.5rem;
        }
        
        .signature-root {
            flex-direction: column;
            gap: 0.5rem;
        }
    }

    /* Animations */
    @keyframes float {
        0%, 100% { transform: translate(0, 0) rotate(0deg); }
        50% { transform: translate(10px, -10px) rotate(5deg); }
    }
</style>

<section class="about-root-section">
    <div class="about-container">
        <!-- Header -->
        <div class="about-header">
            <h2>
                {{ theme_setting('about_section_title', 'माटोको मान्छे') }}
                <span class="nepali">(Person of the Soil)</span>
            </h2>
            <p>{{ theme_setting('about_subtitle', 'A maker, mentor, and mountain dweller who believes in slow technology.') }}</p>
        </div>
        
        <!-- Main Content -->
        <div class="about-content-grid">
            <!-- Left Side - Stats -->
            <div class="stats-organic">
                <div class="stat-item-large">
                    <div class="stat-number-large">{{ $yearsExperience }}</div>
                    <div class="stat-label-large">{{ theme_setting('years_label', 'years craft') }}</div>
                </div>
                
                <div class="stat-grid-small">
                    <div class="stat-item-small">
                        <div class="stat-number-small">{{ $projectsCount }}+</div>
                        <div class="stat-label-small">{{ theme_setting('projects_label', 'projects') }}</div>
                    </div>
                    <div class="stat-item-small">
                        <div class="stat-number-small">{{ $skillsCount }}+</div>
                        <div class="stat-label-small">{{ theme_setting('skills_label', 'open source') }}</div>
                    </div>
                </div>
            </div>
            
            <!-- Right Side - Story -->
            <div class="story-container">
                <div class="story-badge">
                    <i class="fas fa-leaf"></i>
                    <span>{{ theme_setting('about_badge', 'the story') }}</span>
                </div>
                
                <h3 class="story-title">
                    {{ theme_setting('about_heading', 'Rooted in the') }} 
                    <span class="highlight">{{ theme_setting('about_highlight', 'Himalayas') }}</span>
                </h3>
                
                <div class="story-text">
                    {{ $bio }}
                </div>
                
                <div class="story-quote">
                    <i class="fas fa-quote-left"></i>
                    <p>{{ theme_setting('about_quote', '"The strongest roots grow slowly, reaching deep into the soil before breaking through to the sun."') }}</p>
                    <div class="author">{{ theme_setting('about_quote_author', '— Nepali farming wisdom') }}</div>
                </div>
                
                <!-- Social Links -->
                @if(!empty($socialLinks) && is_array($socialLinks))
                <div class="social-roots">
                    <div class="social-roots-title">
                        <i class="fas fa-seedling"></i>
                        <span>{{ theme_setting('social_roots_title', 'digital soil') }}</span>
                    </div>
                    <div class="social-icons-row">
                        @foreach($socialLinks as $platform => $url)
                            @if($url && $url !== '#' && filter_var($url, FILTER_VALIDATE_URL))
                                <a href="{{ $url }}" target="_blank" class="social-icon-root" data-platform="{{ $platform }}" title="{{ ucfirst($platform) }}">
                                    <i class="fab fa-{{ $platform }}"></i>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>
                @endif
                
                <!-- Signature -->
                <div class="signature-root">
                    <i class="fas fa-leaf"></i>
                    <span class="nepali">उमेश घिमिरे</span>
                    <i class="fas fa-leaf"></i>
                </div>
            </div>
        </div>
    </div>
</section>