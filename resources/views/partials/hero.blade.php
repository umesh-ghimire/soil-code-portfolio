@php
    $profile = \App\Models\Profile::first();
    $avatarUrl = null;
    if ($profile && $profile->profile_image) {
        $avatarUrl = asset('storage/' . $profile->profile_image);
    }
@endphp

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