@extends('layouts.app')

@section('title', theme_setting('home_title', 'Umesh Ghimire · soil & code'))
@section('description', theme_setting('meta_description', 'I shape digital tools the way farmers tend terraces — with patience, respect, and generational wisdom.'))

@section('content')
<div class="hero-section">
    <div class="container">
        
        <!-- HERO SECTION -->
        @include('partials.hero')
        
        <!-- PROJECTS SECTION -->
        @if(theme_setting('show_projects_section', true))
        <section id="projects" class="projects-section">
            <h2 class="section-title">
                {{ theme_setting('projects_section_title', 'cultivated projects') }}
            </h2>
            @include('partials.projects')
        </section>
        @endif

        <!-- SKILLS SECTION -->
        @if(theme_setting('show_skills_section', true))
        <section id="skills" class="skills-section">
            <h2 class="section-title">
                {{ theme_setting('skills_section_title', 'toolshed') }}
            </h2>
            @include('partials.skills')
        </section>
        @endif

        <!-- ABOUT SECTION -->
        @if(theme_setting('show_about_section', true))
        <section id="about" class="about-section">
            @include('partials.about')
        </section>
        @endif

        <!-- EXPERIENCE SECTION -->
        @if(theme_setting('show_experience_section', true))
        <section id="experience" class="experience-section">
            <h2 class="section-title">
                {{ theme_setting('experience_section_title', 'recent seasons') }}
            </h2>
            @include('partials.experience')
        </section>
        @endif

        <!-- BLOG SECTION - ADD THIS -->
        @include('partials.blog')

        <!-- CONTACT SECTION -->
        @if(theme_setting('show_contact_section', true))
        <section id="contact" class="contact-section">
            @include('partials.contact')
        </section>
        @endif
    </div>
</div>
@endsection