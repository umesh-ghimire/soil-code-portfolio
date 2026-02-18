@php
    $currentRoute = request()->route() ? request()->route()->getName() : '';
    $profile = \App\Models\Profile::first();
    $siteName = theme_setting('hero_name', 'Umesh Ghimire');
    
    $navItems = [
        ['route' => 'home', 'label' => theme_setting('home_nav_text', 'fields'), 'icon' => 'fas fa-leaf'],
        ['route' => 'projects.index', 'label' => theme_setting('projects_nav_text', 'projects'), 'icon' => 'fas fa-asterisk'],
        ['route' => 'experience', 'label' => theme_setting('experience_nav_text', 'journey'), 'icon' => 'fas fa-tree'],
        ['route' => 'skills', 'label' => theme_setting('skills_nav_text', 'tools'), 'icon' => 'fas fa-trowel'],
        ['route' => 'about', 'label' => theme_setting('about_nav_text', 'story'), 'icon' => 'fas fa-user'],
        ['route' => 'contact', 'label' => theme_setting('contact_nav_text', 'seed'), 'icon' => 'fas fa-seedling'],
    ];
    
    $firstLetter = substr($siteName, 0, 1);
    $restOfName = substr($siteName, 1);
    
    // Get resume URL
    $resumeUrl = null;
    if ($profile && $profile->resume_file) {
        $resumeUrl = asset('storage/' . $profile->resume_file);
    } elseif ($profile && $profile->resume_url) {
        $resumeUrl = $profile->resume_url;
    }
@endphp

<style>
    .organic-nav {
        background: rgba(255, 249, 237, 0.7);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-radius: 100px;
        border: 1px solid var(--clay-light);
        box-shadow: var(--shadow-warm);
        position: relative;
        z-index: 50;
        margin: 20px auto 0;
        max-width: 1400px;
        width: calc(100% - 32px);
        transition: var(--transition-slow);
    }

    .nav-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.8rem 2rem;
    }

    .logo {
        font-size: 2rem;
        font-weight: 800;
        color: var(--moss-deep);
        letter-spacing: -0.02em;
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .logo i {
        color: var(--clay);
        font-size: 1.8rem;
        transition: transform 0.3s ease;
    }

    .logo:hover i {
        transform: rotate(-10deg) scale(1.1);
    }

    .logo span {
        background: var(--moss);
        color: var(--rice);
        padding: 0.1rem 0.5rem;
        border-radius: 12px 4px 12px 4px;
        font-size: 1.6rem;
        transition: all 0.3s ease;
    }

    .logo:hover span {
        border-radius: 4px 12px 4px 12px;
        background: var(--clay);
    }

    .nav-links {
        display: flex;
        gap: 2rem;
        font-weight: 600;
        align-items: center;
    }

    .nav-link {
        text-decoration: none;
        color: var(--ink);
        font-size: 1.05rem;
        transition: all 0.2s;
        position: relative;
        padding: 0.6rem 1.2rem;
        border-radius: 40px 12px 40px 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .nav-link i {
        font-size: 1rem;
        color: var(--clay);
        transition: transform 0.2s ease;
    }

    .nav-link:hover i {
        transform: translateX(-3px) scale(1.1);
    }

    .nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 2px;
        background: var(--clay);
        transition: all 0.3s;
        transform: translateX(-50%);
    }

    .nav-link:hover::after {
        width: 60%;
    }

    .nav-link.active {
        background: rgba(193, 123, 92, 0.1);
        color: var(--moss-deep);
        border-radius: 20px 40px 20px 40px;
    }

    .nav-link.active i {
        color: var(--clay);
    }

    .active-indicator {
        width: 6px;
        height: 6px;
        background: var(--moss);
        border-radius: 50%;
        margin-left: 4px;
        animation: pulse 2s infinite;
    }

    /* ===== RESUME BUTTON STYLES ===== */
    .resume-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--clay);
        color: white !important;
        padding: 0.6rem 1.5rem;
        border-radius: 40px 12px 40px 12px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s;
        text-decoration: none;
        border: 1px solid var(--clay);
        margin-left: 1rem;
        box-shadow: 0 4px 10px -5px var(--clay);
    }

    .resume-btn i {
        color: white !important;
        font-size: 1rem;
        transition: transform 0.3s;
    }

    .resume-btn:hover {
        background: var(--moss);
        border-color: var(--moss);
        transform: translateY(-3px);
        box-shadow: 0 8px 15px -5px var(--moss);
    }

    .resume-btn:hover i {
        transform: translateX(3px);
    }

    .mobile-controls {
        display: none;
    }

    .mobile-menu-toggle {
        display: none;
        flex-direction: column;
        justify-content: space-between;
        width: 30px;
        height: 24px;
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 0;
    }

    .mobile-menu-toggle span {
        width: 100%;
        height: 3px;
        background: var(--moss-deep);
        border-radius: 3px;
        transition: all 0.3s ease;
    }

    .mobile-menu-toggle.active span:nth-child(1) {
        transform: translateY(10px) rotate(45deg);
    }

    .mobile-menu-toggle.active span:nth-child(2) {
        opacity: 0;
    }

    .mobile-menu-toggle.active span:nth-child(3) {
        transform: translateY(-10px) rotate(-45deg);
    }

    .mobile-nav {
        display: none;
        height: 0;
        overflow: hidden;
        transition: height 0.3s ease;
        background: inherit;
        backdrop-filter: inherit;
        border-top: 1px solid rgba(193, 123, 92, 0.25);
    }

    .mobile-nav.active {
        display: block;
        height: auto;
    }

    .mobile-nav-content {
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .mobile-nav-link {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 1.2rem;
        color: var(--ink);
        text-decoration: none;
        font-weight: 600;
        border-radius: 40px 12px 40px 12px;
        transition: all 0.3s;
    }

    .mobile-nav-link i {
        width: 24px;
        color: var(--clay);
        font-size: 1.2rem;
    }

    .mobile-nav-link:hover {
        background: rgba(193, 123, 92, 0.1);
        transform: translateX(5px);
    }

    .mobile-nav-link.active {
        background: rgba(193, 123, 92, 0.15);
        color: var(--moss-deep);
        border-left: 4px solid var(--clay);
        border-radius: 0 40px 40px 0;
    }

    .active-dot {
        width: 8px;
        height: 8px;
        background: var(--clay);
        border-radius: 50%;
        margin-left: auto;
        animation: pulse 2s infinite;
    }

    .mobile-divider {
        height: 1px;
        background: repeating-linear-gradient(45deg, var(--clay), var(--clay) 4px, transparent 4px, transparent 8px);
        margin: 1rem 0;
        opacity: 0.3;
    }

    .mobile-contact {
        padding: 0.5rem 1rem;
    }

    .mobile-contact-label {
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 2px;
        color: var(--clay);
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .mobile-contact-email {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        color: var(--ink);
        text-decoration: none;
        font-size: 0.95rem;
        padding: 0.5rem;
        border-radius: 30px 8px 30px 8px;
    }

    .mobile-contact-email i {
        color: var(--clay);
    }

    /* Mobile resume button */
    .mobile-resume {
        margin-top: 1rem;
        padding: 0.5rem 1rem;
    }

    .mobile-resume-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.8rem;
        background: var(--clay);
        color: white !important;
        padding: 1rem;
        border-radius: 40px 12px 40px 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
    }

    .mobile-resume-btn i {
        color: white !important;
    }

    .mobile-resume-btn:hover {
        background: var(--moss);
        transform: translateY(-2px);
    }

    @media (max-width: 900px) {
        .nav-links { display: none; }
        .mobile-controls { display: flex; }
        .mobile-menu-toggle { display: flex; }
        .organic-nav { margin: 10px auto 0; width: calc(100% - 20px); }
        .nav-container { padding: 0.6rem 1.2rem; }
        .logo { font-size: 1.8rem; }
        .logo span { font-size: 1.4rem; }
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(1.2); }
    }
</style>

<nav class="organic-nav">
    <div class="nav-container">
        <a href="{{ route('home') }}" class="logo">
            <i class="fas fa-leaf"></i>
            <span>{{ $firstLetter }}</span>{{ $restOfName }}
        </a>

        <div class="nav-links">
            @foreach($navItems as $item)
                @if(Route::has($item['route']))
                    <a href="{{ route($item['route']) }}" 
                       class="nav-link {{ request()->routeIs($item['route']) ? 'active' : '' }}">
                        <i class="{{ $item['icon'] }}"></i>
                        {{ $item['label'] }}
                        @if(request()->routeIs($item['route']))
                            <span class="active-indicator"></span>
                        @endif
                    </a>
                @endif
            @endforeach
            
            {{-- RESUME BUTTON - DESKTOP --}}
            <a href="{{ route('download.resume') }}" class="resume-btn">
    <i class="fas fa-file-pdf"></i>
    <span>{{ theme_setting('resume_btn_text', 'resume') }}</span>
    <i class="fas fa-download"></i>
</a>

        <div class="mobile-controls">
            <button class="mobile-menu-toggle" id="mobileMenuToggle">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>

    <div class="mobile-nav" id="mobileNav">
        <div class="mobile-nav-content">
            @foreach($navItems as $item)
                @if(Route::has($item['route']))
                    <a href="{{ route($item['route']) }}" 
                       class="mobile-nav-link {{ request()->routeIs($item['route']) ? 'active' : '' }}">
                        <i class="{{ $item['icon'] }}"></i>
                        <span>{{ $item['label'] }}</span>
                        @if(request()->routeIs($item['route']))
                            <span class="active-dot"></span>
                        @endif
                    </a>
                @endif
            @endforeach
            
            {{-- RESUME BUTTON - MOBILE --}}
                <a href="{{ route('download.resume') }}" class="resume-btn">
                    <i class="fas fa-file-pdf"></i>
                    <span>{{ theme_setting('resume_btn_text', 'resume') }}</span>
                    <i class="fas fa-download"></i>
                 </a>
            
            @if($profile && $profile->email)
                <div class="mobile-divider"></div>
                <div class="mobile-contact">
                    <p class="mobile-contact-label">{{ theme_setting('quick_contact_text', 'quick contact') }}</p>
                    <a href="mailto:{{ $profile->email }}" class="mobile-contact-email">
                        <i class="fas fa-envelope"></i>
                        {{ $profile->email }}
                    </a>
                </div>
            @endif
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggle = document.getElementById('mobileMenuToggle');
    const nav = document.getElementById('mobileNav');
    
    if (toggle && nav) {
        toggle.addEventListener('click', function() {
            nav.classList.toggle('active');
            toggle.classList.toggle('active');
            document.body.style.overflow = nav.classList.contains('active') ? 'hidden' : 'auto';
        });

        nav.querySelectorAll('.mobile-nav-link').forEach(link => {
            link.addEventListener('click', function() {
                nav.classList.remove('active');
                toggle.classList.remove('active');
                document.body.style.overflow = 'auto';
            });
        });
    }
});
</script>