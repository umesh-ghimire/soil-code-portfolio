@php
    $profile = \App\Models\Profile::first();
    $avatarUrl = null;
    if ($profile && $profile->profile_image) {
        $avatarUrl = asset('storage/' . $profile->profile_image);
    }
@endphp

<style>
    .hero {
        padding: clamp(2rem, 6vw, 4rem) 0;
        position: relative;
        z-index: 20;
        min-height: auto;
        display: flex;
        align-items: center;
        width: 100%;
        overflow: hidden;
    }

    .hero-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(min(300px, 100%), 1fr));
        gap: clamp(2rem, 6vw, 4rem);
        align-items: center;
        width: 100%;
    }

    /* Background Elements */
    .hero-bg-1,
    .hero-bg-2 {
        position: absolute;
        width: clamp(200px, 40vw, 400px);
        height: clamp(200px, 40vw, 400px);
        background-color: rgba(193, 123, 92, 0.05);
        border-radius: 50px 20px 50px 20px;
        z-index: -1;
    }

    .hero-bg-1 {
        top: -5vw;
        right: -5vw;
        animation: liquidShift 8s ease-in-out infinite;
    }

    .hero-bg-2 {
        bottom: -5vw;
        left: -5vw;
        animation: liquidMorph 10s ease-in-out infinite;
    }

    /* Content Styles */
    .hero-content {
        max-width: 100%;
    }

    .hero-greeting {
        display: inline-block;
        background: rgba(193, 123, 92, 0.1);
        padding: clamp(0.5rem, 2vw, 0.75rem) clamp(1rem, 3vw, 1.5rem);
        border-radius: 30px 10px 30px 10px;
        border: 1px solid rgba(193, 123, 92, 0.2);
        margin-bottom: clamp(1rem, 3vw, 1.5rem);
        font-size: clamp(0.9rem, 2.5vw, 1rem);
        color: var(--clay);
        font-weight: 500;
    }

    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2rem, 8vw, 4rem);
        line-height: 1.1;
        margin-bottom: clamp(1rem, 3vw, 1.5rem);
    }

    .hero-title-main {
        display: block;
        color: var(--moss-deep);
    }

    .hero-title-sub {
        display: block;
        color: var(--clay);
        font-size: clamp(1.5rem, 6vw, 3rem);
        margin-top: 0.3rem;
    }

    .hero-description {
        font-size: clamp(1rem, 3vw, 1.2rem);
        color: #3c4f44;
        margin-bottom: clamp(1.5rem, 4vw, 2rem);
        max-width: 90%;
        border-left: 4px solid var(--clay);
        padding-left: clamp(1rem, 3vw, 1.5rem);
        font-weight: 450;
        line-height: 1.6;
    }

    .hero-cta {
        display: flex;
        gap: clamp(1rem, 3vw, 1.5rem);
        flex-wrap: wrap;
    }

    .hero-cta .btn {
        flex: 0 1 auto;
    }

    /* Avatar Styles */
    .hero-avatar {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .avatar-wrapper {
        position: relative;
        width: 100%;
        max-width: min(400px, 90%);
        margin: 0 auto;
    }

    .avatar-shape {
        width: 100%;
        aspect-ratio: 1/1;
        background: linear-gradient(145deg, #dbb8a2, #b28b74);
        border-radius: 52% 48% 70% 30% / 46% 52% 48% 54%;
        display: flex;
        justify-content: center;
        align-items: center;
        box-shadow: 0 30px 40px -12px rgba(110, 70, 50, 0.25);
        border: 6px solid rgba(255, 250, 240, 0.6);
        animation: liquidMorph 10s infinite alternate;
        overflow: hidden;
    }

    .avatar-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: inherit;
    }

    .avatar-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: radial-gradient(circle at 30% 40%, #e7cfbe, #ac8b74);
    }

    .avatar-placeholder i {
        font-size: clamp(3rem, 12vw, 8rem);
        color: white;
    }

    .hero-badge {
        position: absolute;
        bottom: clamp(-0.5rem, -2vw, -1rem);
        right: clamp(-0.5rem, -2vw, -1rem);
        background: var(--rice);
        border: 1px solid var(--ash);
        padding: clamp(0.4rem, 2vw, 0.75rem) clamp(0.8rem, 3vw, 1.5rem);
        border-radius: 20px 5px 20px 5px;
        box-shadow: 0 10px 20px -5px rgba(0,0,0,0.1);
        font-size: clamp(0.7rem, 2vw, 0.9rem);
        white-space: nowrap;
        z-index: 3;
    }

    .hero-nepali {
        position: absolute;
        top: clamp(-1rem, -3vw, -1.5rem);
        left: clamp(-1rem, -3vw, -1.5rem);
        transform: rotate(-12deg);
        font-family: 'Playfair Display', serif;
        font-size: clamp(1.2rem, 5vw, 2rem);
        color: rgba(193, 123, 92, 0.2);
        z-index: 1;
    }

    /* Responsive Breakpoints */
    @media (max-width: 768px) {
        .hero-grid {
            grid-template-columns: 1fr;
            text-align: center;
        }

        .hero-avatar {
            grid-row: 1;
            margin-bottom: 1rem;
        }

        .hero-content {
            text-align: center;
        }

        .hero-description {
            max-width: 100%;
            text-align: center;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-cta {
            justify-content: center;
        }

        .hero-badge {
            white-space: normal;
        }
    }

    @media (max-width: 480px) {
        .hero-title {
            font-size: 2.2rem;
        }

        .hero-title-sub {
            font-size: 1.8rem;
        }

        .hero-cta {
            flex-direction: column;
            width: 100%;
        }

        .hero-cta .btn {
            width: 100%;
            justify-content: center;
        }

        .avatar-wrapper {
            max-width: 280px;
        }

        .hero-badge {
            font-size: 0.7rem;
            padding: 0.3rem 0.8rem;
        }
    }

    @media (max-width: 360px) {
        .hero-title {
            font-size: 1.8rem;
        }

        .hero-title-sub {
            font-size: 1.5rem;
        }

        .avatar-wrapper {
            max-width: 220px;
        }
    }

    /* Landscape Mode */
    @media (orientation: landscape) and (max-height: 600px) {
        .hero {
            padding: 1.5rem 0;
        }

        .avatar-wrapper {
            max-width: 200px;
        }

        .hero-grid {
            gap: 1.5rem;
        }
    }

    /* Animations */
    @keyframes liquidShift {
        0%, 100% { border-radius: 50px 20px 50px 20px; }
        25% { border-radius: 30px 60px 30px 60px; }
        50% { border-radius: 70px 30px 70px 30px; }
        75% { border-radius: 20px 50px 20px 50px; }
    }

    @keyframes liquidMorph {
        0% { border-radius: 52% 48% 70% 30% / 46% 52% 48% 54%; }
        25% { border-radius: 60% 40% 50% 50% / 40% 60% 40% 60%; }
        50% { border-radius: 40% 60% 40% 60% / 60% 40% 60% 40%; }
        75% { border-radius: 70% 30% 60% 40% / 50% 50% 50% 50%; }
        100% { border-radius: 48% 52% 38% 62% / 58% 42% 58% 42%; }
    }
</style>

<section class="hero">
    <!-- Clay Morph Background -->
    <div class="hero-bg-1 animate-liquidShift"></div>
    <div class="hero-bg-2 animate-liquidMorph"></div>
    
    <div class="hero-grid">
        <!-- Left Column -->
        <div class="hero-content">
            <!-- Greeting with Pottery Shape -->
            <div class="hero-greeting pottery-shape">
                <span class="text-clay">{{ theme_setting('hero_greeting', "Hi, I'm") }}</span>
            </div>
            
            <!-- Name with Organic Typography -->
            <h1 class="hero-title">
                <span class="hero-title-main">{{ theme_setting('hero_name', 'Umesh Ghimire') }}</span>
                <span class="hero-title-sub">{{ theme_setting('hero_title', 'soil & code') }}</span>
            </h1>
            
            <!-- Description with Wavy Underline -->
            <p class="hero-description wavy-underline">
                {{ theme_setting('hero_description', 'I shape digital tools the way farmers tend terraces — with patience, respect, and generational wisdom.') }}
            </p>
            
            <!-- CTA Buttons -->
            <div class="hero-cta">
                <a href="#projects" class="btn btn-moss">
                    <span>{{ theme_setting('hero_cta_primary', 'view grown work') }}</span>
                    <span class="project-link-arrow">→</span>
                </a>
                <a href="{{ route('contact.index') }}" class="btn btn-outline">
                    {{ theme_setting('hero_cta_secondary', 'plant a seed') }}
                </a>
            </div>
        </div>
        
        <!-- Right Column - Avatar with Pottery Shape -->
        <div class="hero-avatar">
            <div class="avatar-wrapper">
                <div class="avatar-shape animate-hammerSwing">
                    @if($avatarUrl)
                        <img src="{{ $avatarUrl }}" alt="{{ theme_setting('hero_name', 'Umesh Ghimire') }}" class="avatar-image">
                    @else
                        <div class="avatar-placeholder">
                            <i class="fas fa-seedling"></i>
                        </div>
                    @endif
                </div>
                <!-- Badge -->
                <div class="hero-badge">
                    <span class="text-moss-deep">{{ theme_setting('hero_badge', 'from the himalayas') }}</span>
                </div>
                <!-- Nepali Text -->
                <div class="hero-nepali">
                    <span>{{ theme_setting('hero_nepali_text', 'माटो र माया') }}</span>
                </div>
            </div>
        </div>
    </div>
</section>