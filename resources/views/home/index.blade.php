@extends('layouts.app')

@section('content')
<div class="hero-section">
    <!-- HIMALAYAN TEXTURE OVERLAY -->
    <div class="himalayan-texture"></div>

    <!-- MAIN CONTAINER -->
    <div class="container">
        
        <!-- HERO SECTION -->
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
                        <a href="#contact" class="btn btn-outline">
                            {{ theme_setting('hero_cta_secondary', 'plant a seed') }}
                        </a>
                    </div>
                </div>
                
                <!-- Right Column - Avatar with Pottery Shape -->
                <div class="hero-avatar">
                    <div class="avatar-wrapper">
                        <div class="avatar-shape animate-hammerSwing">
                            <div class="avatar-image" 
                                 style="background-image: url('{{ $profile->profile_image_url ?? 'https://via.placeholder.com/400' }}');">
                            </div>
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

        <!-- PROJECTS SECTION - CULTIVATED WORK -->
        @if(theme_setting('show_projects_section', true))
        <section id="projects" class="projects-section">
            <h2 class="section-title">
                {{ theme_setting('projects_section_title', 'cultivated projects') }}
            </h2>
            
            <div class="projects-grid">
                @forelse($featuredProjects as $project)
                <div class="project-card">
                    <!-- Project Image -->
                    <div class="project-image">
                        <img src="{{ $project->featured_image_url ?? 'https://via.placeholder.com/400x225' }}" 
                             alt="{{ $project->title }}">
                    </div>
                    
                    <!-- Project Info -->
                    <h3 class="project-title">{{ $project->title }}</h3>
                    <p class="project-description">{{ $project->description }}</p>
                    
                    <!-- Technologies -->
                    <div class="project-tech">
                        @foreach($project->technologies ?? [] as $tech)
                        <span class="tech-tag">{{ $tech }}</span>
                        @endforeach
                    </div>
                    
                    <!-- Link -->
                    <a href="{{ route('projects.show', $project->slug) }}" class="project-link">
                        <span>{{ theme_setting('project_link_text', 'read case study') }}</span>
                        <span class="project-link-arrow">→</span>
                    </a>
                </div>
                @empty
                <div class="empty-state">
                    No projects cultivated yet. Check back soon!
                </div>
                @endforelse
            </div>
        </section>
        @endif

        <!-- SKILLS SECTION - TOOLSHED -->
        @if(theme_setting('show_skills_section', true))
        <section id="skills" class="skills-section">
            <h2 class="section-title">
                {{ theme_setting('skills_section_title', 'toolshed') }}
            </h2>
            
            <div class="skills-grid">
                @forelse($featuredSkills as $skill)
                <div class="skill-item">
                    <div class="skill-icon">{{ $skill->icon ?? '🔨' }}</div>
                    <h3 class="skill-name">{{ $skill->name }}</h3>
                    @if($skill->proficiency)
                    <div class="skill-progress">
                        <div class="skill-progress-bar" style="width: {{ $skill->proficiency }}%"></div>
                    </div>
                    @endif
                </div>
                @empty
                <div class="empty-state">
                    Tools are being sharpened. Check back soon!
                </div>
                @endforelse
            </div>
            
            @if($skillsByCategory->count() > 8)
            <div class="text-center mt-4">
                <button class="btn btn-outline">
                    <span>{{ theme_setting('more_skills_text', 'more organic tools') }}</span>
                    <span>↓</span>
                </button>
            </div>
            @endif
        </section>
        @endif

        <!-- ABOUT SECTION - माटोको मान्छे -->
        @if(theme_setting('show_about_section', true))
        <section id="about" class="about-section">
            <div class="about-grid">
                <!-- Left - Stats with Organic Shapes -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-number">{{ $profile->years_experience ?? '8' }}</div>
                        <div class="stat-label">{{ theme_setting('years_label', 'years craft') }}</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">{{ $profile->total_projects ?? '24' }}</div>
                        <div class="stat-label">{{ theme_setting('projects_label', 'projects') }}</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">{{ $profile->open_source_contributions ?? '12' }}</div>
                        <div class="stat-label">{{ theme_setting('skills_label', 'open source') }}</div>
                    </div>
                </div>
                
                <!-- Right - About Text -->
                <div class="about-content">
                    <h2>{{ theme_setting('about_section_title', 'माटोको मान्छे') }}</h2>
                    <p class="about-text">
                        {{ theme_setting('about_description', 'Born in a Dhankuta village without internet, I learned to code by moonlight — literally. Now I build for the web with the same patience it takes to grow millet.') }}
                    </p>
                    <div class="social-links">
                        <a href="{{ $profile->getSocialLink('github') ?? '#' }}" class="social-link">GitHub</a>
                        <a href="{{ $profile->getSocialLink('linkedin') ?? '#' }}" class="social-link">LinkedIn</a>
                        <a href="{{ $profile->getSocialLink('twitter') ?? '#' }}" class="social-link">Twitter</a>
                    </div>
                </div>
            </div>
        </section>
        @endif

        <!-- EXPERIENCE SECTION - RECENT SEASONS -->
        @if(theme_setting('show_experience_section', true))
        <section id="experience" class="experience-section">
            <h2 class="section-title">
                {{ theme_setting('experience_section_title', 'recent seasons') }}
            </h2>
            
            <div class="timeline">
                @forelse($experiences as $experience)
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-date">{{ $experience->duration }}</div>
                    <h3 class="timeline-title">{{ $experience->title }}</h3>
                    <div class="timeline-subtitle">{{ $experience->company }} · {{ $experience->location }}</div>
                    <p>{{ $experience->description }}</p>
                </div>
                @empty
                <div class="empty-state">
                    Seasons of experience coming soon.
                </div>
                @endforelse
            </div>
        </section>
        @endif

        <!-- CONTACT SECTION - LET'S GROW TOGETHER -->
        @if(theme_setting('show_contact_section', true))
        <section id="contact" class="contact-section">
            <div class="contact-header">
                <h2>{{ theme_setting('contact_section_title', "let's grow together") }}</h2>
                <p>{{ theme_setting('contact_subtitle', "reach out, I reply within a moon cycle 🌙") }}</p>
            </div>
            
            <form method="POST" action="{{ route('contact.store') }}" class="contact-form">
                @csrf
                
                <div class="form-grid">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="your name" required
                               class="form-input">
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="your email" required
                               class="form-input">
                    </div>
                </div>
                
                <div class="form-group">
                    <input type="text" name="subject" placeholder="what shall we grow?" required
                           class="form-input">
                </div>
                
                <div class="form-group">
                    <textarea name="message" rows="5" placeholder="your message..." required
                              class="form-textarea"></textarea>
                </div>
                
                <div class="form-submit">
                    <button type="submit" class="btn btn-clay">
                        <span>plant the seed</span>
                        <span class="project-link-arrow">🌱</span>
                    </button>
                </div>
            </form>
        </section>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
</script>
@endpush