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

{{-- INLINE STYLES - NO @push OR @section HERE --}}
<style>
    /* ===== ABOUT SECTION STYLES ===== */
    .about-root-section {
        margin: 6rem 0;
        position: relative;
    }

    /* Background Elements */
    .about-root-section::before {
        content: '';
        position: absolute;
        top: -50px;
        left: -50px;
        width: 300px;
        height: 300px;
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
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(76, 107, 74, 0.08) 0%, transparent 70%);
        border-radius: 50%;
        z-index: 0;
        animation: float 25s infinite alternate-reverse;
    }

    /* Main Container */
    .about-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        position: relative;
        z-index: 2;
    }

    /* Section Header */
    .about-header {
        text-align: center;
        margin-bottom: 4rem;
        position: relative;
    }

    .about-header h2 {
        font-size: 4rem;
        font-weight: 800;
        color: var(--moss-deep);
        font-family: 'Playfair Display', serif;
        letter-spacing: -0.02em;
        position: relative;
        display: inline-block;
        margin-bottom: 1rem;
    }

    .about-header h2 .nepali {
        font-family: 'Tiro Devanagari Sanskrit', serif;
        color: var(--clay);
        font-size: 2.5rem;
        display: block;
        margin-top: 0.5rem;
    }

    .about-header h2::after {
        content: '';
        position: absolute;
        bottom: -15px;
        left: 50%;
        transform: translateX(-50%);
        width: 120px;
        height: 4px;
        background: repeating-linear-gradient(45deg, var(--clay), var(--clay) 10px, transparent 10px, transparent 20px);
        border-radius: 2px;
    }

    .about-header p {
        font-size: 1.2rem;
        color: #5a6b5a;
        max-width: 600px;
        margin: 2rem auto 0;
        font-style: italic;
    }

    /* Main Content Grid */
    .about-content-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
        align-items: center;
        background: rgba(255, 247, 240, 0.4);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 120px 30px 120px 30px;
        padding: 3rem;
        border: 1px solid rgba(193, 123, 92, 0.3);
        box-shadow: var(--shadow-warm);
        position: relative;
        overflow: hidden;
    }

    .about-content-grid::before {
        content: '';
        position: absolute;
        top: -100px;
        right: -100px;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(193, 123, 92, 0.1) 0%, transparent 70%);
        border-radius: 50%;
        z-index: -1;
    }

    /* Left Side - Stats with Organic Shapes */
    .stats-organic {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .stat-item-large {
        background: white;
        border-radius: 80px 20px 80px 20px;
        padding: 2.5rem 2rem;
        text-align: center;
        border: 1px solid var(--clay-light);
        box-shadow: 0 15px 30px -10px rgba(193, 123, 92, 0.15);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-item-large:hover {
        transform: translateY(-5px);
        border-color: var(--clay);
        box-shadow: 0 20px 40px -10px rgba(193, 123, 92, 0.25);
    }

    .stat-item-large::after {
        content: '';
        position: absolute;
        top: -20px;
        right: -20px;
        width: 100px;
        height: 100px;
        background: radial-gradient(circle, rgba(193, 123, 92, 0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .stat-number-large {
        font-size: 5rem;
        font-weight: 800;
        color: var(--clay);
        line-height: 1;
        font-family: 'Playfair Display', serif;
        margin-bottom: 0.5rem;
    }

    .stat-label-large {
        font-size: 1.2rem;
        color: var(--moss-deep);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .stat-grid-small {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }

    .stat-item-small {
        background: white;
        border-radius: 50px 15px 50px 15px;
        padding: 1.5rem;
        text-align: center;
        border: 1px solid var(--clay-light);
        transition: all 0.3s ease;
    }

    .stat-item-small:hover {
        transform: translateY(-3px);
        border-color: var(--clay);
        background: rgba(255, 255, 255, 0.9);
    }

    .stat-number-small {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--clay);
        line-height: 1;
        font-family: 'Playfair Display', serif;
        margin-bottom: 0.3rem;
    }

    .stat-label-small {
        font-size: 0.9rem;
        color: var(--moss-deep);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Right Side - Story */
    .story-container {
        padding: 1rem;
    }

    .story-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.8rem;
        background: rgba(193, 123, 92, 0.1);
        padding: 0.5rem 1.5rem;
        border-radius: 40px 12px 40px 12px;
        margin-bottom: 2rem;
        border: 1px solid rgba(193, 123, 92, 0.3);
    }

    .story-badge i {
        color: var(--clay);
        font-size: 1.2rem;
    }

    .story-badge span {
        color: var(--moss-deep);
        font-weight: 600;
        letter-spacing: 1px;
    }

    .story-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--moss-deep);
        font-family: 'Playfair Display', serif;
        margin-bottom: 1.5rem;
        line-height: 1.3;
    }

    .story-title .highlight {
        color: var(--clay);
        font-style: italic;
    }

    .story-text {
        color: #4a5a4a;
        line-height: 1.9;
        font-size: 1.1rem;
        margin-bottom: 2rem;
        border-left: 4px solid var(--clay-light);
        padding-left: 1.5rem;
    }

    .story-quote {
        background: linear-gradient(145deg, rgba(193, 123, 92, 0.05), rgba(76, 107, 74, 0.05));
        border-radius: 60px 20px 60px 20px;
        padding: 2rem;
        margin: 2rem 0;
        border: 1px solid rgba(193, 123, 92, 0.2);
        font-style: italic;
        position: relative;
    }

    .story-quote i {
        color: var(--clay);
        font-size: 2rem;
        opacity: 0.3;
        position: absolute;
        top: 1rem;
        left: 1rem;
    }

    .story-quote p {
        color: var(--moss-deep);
        font-size: 1.1rem;
        line-height: 1.8;
        position: relative;
        z-index: 2;
        margin-left: 2rem;
    }

    .story-quote .author {
        margin-top: 1rem;
        color: var(--clay);
        font-weight: 600;
        text-align: right;
    }

    /* Social Links */
    .social-roots {
        margin-top: 2.5rem;
        padding-top: 2rem;
        border-top: 2px dashed var(--clay-light);
    }

    .social-roots-title {
        font-size: 1rem;
        color: var(--moss);
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 1.2rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .social-roots-title i {
        color: var(--clay);
    }

    .social-icons-row {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .social-icon-root {
        background: white;
        width: 55px;
        height: 55px;
        border-radius: 30% 50% 30% 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--moss);
        border: 2px solid var(--clay-light);
        font-size: 1.5rem;
        transition: all 0.3s;
        text-decoration: none;
        position: relative;
        overflow: hidden;
    }

    .social-icon-root::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: var(--clay);
        opacity: 0;
        transition: opacity 0.3s;
        z-index: 0;
    }

    .social-icon-root i {
        position: relative;
        z-index: 2;
    }

    .social-icon-root:hover {
        transform: translateY(-8px) rotate(8deg);
        border-color: var(--clay);
        color: white;
    }

    .social-icon-root:hover::before {
        opacity: 1;
    }

    /* Platform-specific hover colors */
    .social-icon-root[data-platform="github"]:hover::before { background: #333; }
    .social-icon-root[data-platform="linkedin"]:hover::before { background: #0077b5; }
    .social-icon-root[data-platform="twitter"]:hover::before { background: #000; }
    .social-icon-root[data-platform="facebook"]:hover::before { background: #1877f2; }
    .social-icon-root[data-platform="instagram"]:hover::before { background: linear-gradient(45deg, #f09433, #d62976, #962fbf, #4f5bd5); }
    .social-icon-root[data-platform="youtube"]:hover::before { background: #ff0000; }
    .social-icon-root[data-platform="dribbble"]:hover::before { background: #ea4c89; }

    /* Signature */
    .signature-root {
        margin-top: 2rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        font-family: 'Tiro Devanagari Sanskrit', serif;
        color: var(--moss-deep);
        font-size: 1.3rem;
    }

    .signature-root i {
        color: var(--clay);
        animation: pulse 2s infinite;
    }

    .signature-root .nepali {
        color: var(--clay);
        font-size: 1.5rem;
    }

    @keyframes float {
        0%, 100% { transform: translate(0, 0) rotate(0deg); }
        50% { transform: translate(20px, -20px) rotate(5deg); }
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.7; transform: scale(1.1); }
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .about-header h2 {
            font-size: 3.5rem;
        }
        
        .about-content-grid {
            padding: 2rem;
        }
    }

    @media (max-width: 900px) {
        .about-content-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        
        .about-header h2 {
            font-size: 3rem;
        }
        
        .about-header h2 .nepali {
            font-size: 2rem;
        }
        
        .story-title {
            font-size: 2rem;
        }
    }

    @media (max-width: 480px) {
        .stat-grid-small {
            grid-template-columns: 1fr;
        }
        
        .stat-number-large {
            font-size: 3.5rem;
        }
        
        .signature-root {
            flex-direction: column;
            text-align: center;
        }
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
                @else
                <!-- Default social icons for demo -->
                <div class="social-roots">
                    <div class="social-roots-title">
                        <i class="fas fa-seedling"></i>
                        <span>{{ theme_setting('social_roots_title', 'digital soil') }}</span>
                    </div>
                    <div class="social-icons-row">
                        <a href="#" class="social-icon-root" data-platform="github"><i class="fab fa-github"></i></a>
                        <a href="#" class="social-icon-root" data-platform="linkedin"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#" class="social-icon-root" data-platform="twitter"><i class="fab fa-twitter"></i></a>
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