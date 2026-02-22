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
    
    // Get resume URL with fallback
    $resumeUrl = null;
    if ($profile && $profile->resume_file) {
        $resumeUrl = asset('storage/' . $profile->resume_file);
    } elseif ($profile && $profile->resume_url) {
        $resumeUrl = $profile->resume_url;
    } else {
        // Fallback resume URL
        $resumeUrl = '#';
    }
@endphp

<style>
    /* Reset and base styles */
    .organic-nav {
        background: rgba(255, 249, 237, 0.7);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-radius: 100px;
        border: 1px solid var(--clay-light);
        box-shadow: var(--shadow-warm);
        position: relative;
        z-index: 999;
        margin: 20px auto 0;
        max-width: 1400px;
        width: calc(100% - 32px);
    }

    .nav-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.8rem 2rem;
        position: relative;
    }

    .logo {
        font-size: 2rem;
        font-weight: 800;
        color: var(--moss-deep);
        display: flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
    }

    .logo i {
        color: var(--clay);
        font-size: 1.8rem;
    }

    .logo span {
        background: var(--moss);
        color: var(--rice);
        padding: 0.1rem 0.5rem;
        border-radius: 12px 4px 12px 4px;
        font-size: 1.6rem;
    }

    /* Desktop Navigation */
    .nav-links {
        display: flex;
        gap: 2rem;
        align-items: center;
    }

    .nav-link {
        text-decoration: none;
        color: var(--ink);
        font-size: 1.05rem;
        padding: 0.6rem 1.2rem;
        border-radius: 40px 12px 40px 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .nav-link i {
        color: var(--clay);
    }

    .nav-link.active {
        background: rgba(193, 123, 92, 0.1);
    }

    /* Desktop Resume Button */
    .resume-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--clay);
        color: white !important;
        padding: 0.6rem 1.5rem;
        border-radius: 40px 12px 40px 12px;
        text-decoration: none;
        margin-left: 1rem;
        transition: all 0.3s;
        border: 1px solid var(--clay);
        font-size: 1rem;
    }

    .resume-btn:hover {
        background: var(--moss);
        border-color: var(--moss);
        transform: translateY(-2px);
        box-shadow: 0 8px 15px -5px var(--moss);
    }

    .resume-btn i {
        color: white !important;
        font-size: 1rem;
    }

    /* Mobile Menu Toggle */
    .mobile-menu-toggle {
        display: none;
        background: none;
        border: none;
        cursor: pointer;
        padding: 10px;
        z-index: 1001;
    }

    .mobile-menu-toggle span {
        display: block;
        width: 25px;
        height: 3px;
        background: var(--moss-deep);
        margin: 5px 0;
        transition: all 0.3s;
    }

    .mobile-menu-toggle.active span:nth-child(1) {
        transform: rotate(45deg) translate(5px, 5px);
    }

    .mobile-menu-toggle.active span:nth-child(2) {
        opacity: 0;
    }

    .mobile-menu-toggle.active span:nth-child(3) {
        transform: rotate(-45deg) translate(7px, -7px);
    }

    /* ===== DROPDOWN MENU SYSTEM ===== */
    .mobile-dropdown {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: rgba(255, 249, 237, 0.98);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-radius: 0 0 60px 60px;
        border: 1px solid var(--clay-light);
        border-top: none;
        box-shadow: 0 20px 30px -10px rgba(0, 0, 0, 0.15);
        padding: 20px;
        z-index: 998;
        max-height: 80vh;
        overflow-y: auto;
    }

    .mobile-dropdown.show {
        display: block;
        animation: slideDown 0.3s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .mobile-dropdown-links {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .mobile-dropdown-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 16px;
        color: var(--ink) !important;
        text-decoration: none !important;
        font-size: 1.1rem;
        font-weight: 500;
        border-radius: 40px 12px 40px 12px;
        background: rgba(255, 255, 255, 0.8);
        transition: all 0.3s;
        border: 1px solid rgba(193, 123, 92, 0.2);
    }

    .mobile-dropdown-link i {
        width: 24px;
        color: var(--clay) !important;
        font-size: 1.2rem;
    }

    .mobile-dropdown-link:hover,
    .mobile-dropdown-link:active {
        background: rgba(193, 123, 92, 0.15);
        transform: translateX(5px);
        border-color: var(--clay);
    }

    .mobile-dropdown-link.active {
        background: rgba(193, 123, 92, 0.2);
        border-left: 4px solid var(--clay);
        border-radius: 0 40px 40px 0;
    }

    /* Mobile Resume Button - Properly Sized for Mobile */
    .mobile-dropdown-resume {
        margin: 15px 0 5px;
        padding-top: 15px;
        border-top: 2px dashed var(--clay-light);
    }

    .mobile-resume-btn {
        display: flex !important;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: var(--clay) !important;
        color: white !important;
        padding: 12px 16px !important;
        border-radius: 40px 12px 40px 12px !important;
        text-decoration: none !important;
        font-size: 1rem !important;
        font-weight: 600 !important;
        transition: all 0.3s !important;
        border: 1px solid var(--clay) !important;
        width: 100%;
        box-shadow: 0 4px 10px -3px rgba(193, 123, 92, 0.4);
    }

    .mobile-resume-btn i {
        color: white !important;
        font-size: 1rem !important;
    }

    .mobile-resume-btn:hover,
    .mobile-resume-btn:active {
        background: var(--moss) !important;
        border-color: var(--moss) !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 12px -4px var(--moss) !important;
    }

    /* Contact section in dropdown */
    .mobile-dropdown-contact {
        margin-top: 15px;
        padding-top: 15px;
        border-top: 2px dashed var(--clay-light);
    }

    .mobile-dropdown-contact-label {
        color: var(--clay);
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 10px;
        font-weight: 600;
        text-align: center;
    }

    .mobile-dropdown-email {
        display: flex !important;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px;
        background: white;
        border-radius: 30px 8px 30px 8px !important;
        color: var(--ink) !important;
        text-decoration: none !important;
        font-size: 0.95rem;
        word-break: break-all;
        border: 1px solid rgba(193, 123, 92, 0.2);
    }

    .mobile-dropdown-email i {
        color: var(--clay);
        font-size: 1.1rem;
    }

    /* Responsive */
    @media (max-width: 900px) {
        .nav-links {
            display: none;
        }
        
        .mobile-menu-toggle {
            display: block;
        }
        
        .organic-nav {
            margin: 10px auto 0;
            width: calc(100% - 20px);
        }
        
        .nav-container {
            padding: 0.6rem 1.2rem;
        }
        
        .logo {
            font-size: 1.8rem;
        }
        
        .logo span {
            font-size: 1.4rem;
        }
    }

    @media (max-width: 768px) {
        .mobile-dropdown {
            padding: 15px;
        }
        
        .mobile-dropdown-link {
            padding: 12px 14px;
            font-size: 1rem;
        }
        
        .mobile-dropdown-link i {
            font-size: 1.1rem;
            width: 22px;
        }
        
        .mobile-resume-btn {
            padding: 10px 14px !important;
            font-size: 0.95rem !important;
        }
        
        .mobile-resume-btn i {
            font-size: 0.95rem !important;
        }
        
        .mobile-dropdown-email {
            padding: 10px;
            font-size: 0.9rem;
        }
    }

    @media (max-width: 480px) {
        .logo {
            font-size: 1.5rem;
        }
        
        .logo i {
            font-size: 1.3rem;
        }
        
        .logo span {
            font-size: 1.2rem;
        }
        
        .nav-container {
            padding: 0.5rem 1rem;
        }
        
        .mobile-dropdown {
            padding: 12px;
        }
        
        .mobile-dropdown-link {
            padding: 10px 12px;
            font-size: 0.95rem;
            gap: 10px;
        }
        
        .mobile-dropdown-link i {
            font-size: 1rem;
            width: 20px;
        }
        
        .mobile-dropdown-resume {
            margin: 12px 0 3px;
            padding-top: 12px;
        }
        
        .mobile-resume-btn {
            padding: 10px 12px !important;
            font-size: 0.9rem !important;
            gap: 6px;
        }
        
        .mobile-resume-btn i {
            font-size: 0.9rem !important;
        }
        
        .mobile-dropdown-contact {
            margin-top: 12px;
            padding-top: 12px;
        }
        
        .mobile-dropdown-contact-label {
            font-size: 0.8rem;
            margin-bottom: 8px;
        }
        
        .mobile-dropdown-email {
            padding: 8px 10px;
            font-size: 0.85rem;
            gap: 6px;
        }
        
        .mobile-dropdown-email i {
            font-size: 1rem;
        }
    }

    /* Very small phones */
    @media (max-width: 360px) {
        .mobile-resume-btn {
            padding: 8px 10px !important;
            font-size: 0.85rem !important;
        }
        
        .mobile-resume-btn i {
            font-size: 0.85rem !important;
        }
        
        .mobile-dropdown-link {
            padding: 8px 10px;
            font-size: 0.9rem;
        }
    }

    /* Landscape mode */
    @media (orientation: landscape) and (max-height: 600px) {
        .mobile-dropdown {
            max-height: 70vh;
            padding: 12px;
        }
        
        .mobile-dropdown-link {
            padding: 8px 12px;
        }
        
        .mobile-resume-btn {
            padding: 8px 12px !important;
        }
    }
</style>

<nav class="organic-nav">
    <div class="nav-container">
        <a href="{{ route('home') }}" class="logo">
            <i class="fas fa-leaf"></i>
            <span>{{ $firstLetter }}</span>{{ $restOfName }}
        </a>

        <!-- Desktop Navigation -->
        <div class="nav-links">
            @foreach($navItems as $item)
                @if(Route::has($item['route']))
                    <a href="{{ route($item['route']) }}" 
                       class="nav-link {{ request()->routeIs($item['route']) ? 'active' : '' }}">
                        <i class="{{ $item['icon'] }}"></i>
                        {{ $item['label'] }}
                    </a>
                @endif
            @endforeach
            
            <!-- Desktop Resume Button -->
            <a href="{{ $resumeUrl ?: '#' }}" class="resume-btn" target="_blank">
                <i class="fas fa-file-pdf"></i>
                <span>resume</span>
                <i class="fas fa-download"></i>
            </a>
        </div>

        <!-- Mobile Menu Toggle Button -->
        <button class="mobile-menu-toggle" id="mobileMenuToggle" onclick="toggleMobileDropdown()">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>

    <!-- Mobile Dropdown Menu -->
    <div class="mobile-dropdown" id="mobileDropdown">
        <div class="mobile-dropdown-links">
            @foreach($navItems as $item)
                @if(Route::has($item['route']))
                    <a href="{{ route($item['route']) }}" 
                       class="mobile-dropdown-link {{ request()->routeIs($item['route']) ? 'active' : '' }}"
                       onclick="closeMobileDropdown()">
                        <i class="{{ $item['icon'] }}"></i>
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endif
            @endforeach
            
            <!-- Mobile Resume Button - Properly Sized -->
            <div class="mobile-dropdown-resume">
                <a href="{{ $resumeUrl ?: '#' }}" 
                   class="mobile-resume-btn" 
                   target="_blank" 
                   onclick="closeMobileDropdown()">
                    <i class="fas fa-file-pdf"></i>
                    <span>Resume</span>
                    <i class="fas fa-download"></i>
                </a>
            </div>
            
            <!-- Quick Contact in Dropdown -->
            @if($profile && $profile->email)
                <div class="mobile-dropdown-contact">
                    <div class="mobile-dropdown-contact-label">Quick Contact</div>
                    <a href="mailto:{{ $profile->email }}" 
                       class="mobile-dropdown-email" 
                       onclick="closeMobileDropdown()">
                        <i class="fas fa-envelope"></i>
                        {{ $profile->email }}
                    </a>
                </div>
            @endif
        </div>
    </div>
</nav>

<script>
// Dropdown menu functions
function toggleMobileDropdown() {
    var dropdown = document.getElementById('mobileDropdown');
    var toggleButton = document.getElementById('mobileMenuToggle');
    
    if (dropdown.classList.contains('show')) {
        dropdown.classList.remove('show');
        toggleButton.classList.remove('active');
        document.body.style.overflow = '';
    } else {
        dropdown.classList.add('show');
        toggleButton.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
}

function closeMobileDropdown() {
    var dropdown = document.getElementById('mobileDropdown');
    var toggleButton = document.getElementById('mobileMenuToggle');
    
    dropdown.classList.remove('show');
    toggleButton.classList.remove('active');
    document.body.style.overflow = '';
}

// Close dropdown when clicking outside
document.addEventListener('click', function(event) {
    var dropdown = document.getElementById('mobileDropdown');
    var toggleButton = document.getElementById('mobileMenuToggle');
    var nav = document.querySelector('.organic-nav');
    
    if (dropdown && toggleButton && nav) {
        if (dropdown.classList.contains('show') && 
            !nav.contains(event.target)) {
            closeMobileDropdown();
        }
    }
});

// Close dropdown on escape key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeMobileDropdown();
    }
});

// Handle window resize
window.addEventListener('resize', function() {
    if (window.innerWidth > 900) {
        closeMobileDropdown();
    }
});
</script>