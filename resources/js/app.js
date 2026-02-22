import './bootstrap';

// ============================================
// RESPONSIVE UTILITIES
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    
    // Fix 100vh on mobile (addresses address bar issue)
    const setVh = () => {
        const vh = window.innerHeight * 0.01;
        document.documentElement.style.setProperty('--vh', `${vh}px`);
    };
    
    setVh();
    window.addEventListener('resize', setVh);
    
    // Handle orientation changes
    window.addEventListener('orientationchange', function() {
        setTimeout(setVh, 100);
    });
    
    // ============================================
    // SKILLS PAGE - ANIMATE PROFICIENCY BARS
    // ============================================
    const bars = document.querySelectorAll('.proficiency-fill');
    if (bars.length > 0) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const bar = entry.target;
                    const width = bar.style.width;
                    bar.style.width = '0%';
                    setTimeout(() => {
                        bar.style.width = width;
                    }, 100);
                    observer.unobserve(bar);
                }
            });
        }, { threshold: 0.2, rootMargin: '50px' });
        
        bars.forEach(bar => observer.observe(bar));
    }
    
    // ============================================
    // EXPERIENCE PAGE - TIMELINE ANIMATIONS
    // ============================================
    const timelineItems = document.querySelectorAll('.timeline-item');
    if (timelineItems.length > 0) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateX(0)';
                }
            });
        }, { threshold: 0.2, rootMargin: '50px' });
        
        timelineItems.forEach(item => {
            item.style.opacity = '0';
            item.style.transform = window.innerWidth < 768 ? 'translateY(30px)' : 'translateX(50px)';
            item.style.transition = 'all 0.6s ease';
            observer.observe(item);
        });
    }
    
    // ============================================
    // STATS COUNTER ANIMATION (optimized for mobile)
    // ============================================
    const statNumbers = document.querySelectorAll('.stat-number, .stat-number-large, .stat-number-small');
    if (statNumbers.length > 0) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const stat = entry.target;
                    const text = stat.innerText;
                    const number = parseInt(text.replace(/[^0-9]/g, ''));
                    
                    if (!isNaN(number) && number > 0 && !stat.classList.contains('animated')) {
                        stat.classList.add('animated');
                        let current = 0;
                        const increment = number / 20; // Faster for mobile
                        const originalText = stat.innerText;
                        
                        const timer = setInterval(() => {
                            current += increment;
                            if (current >= number) {
                                stat.innerText = originalText;
                                clearInterval(timer);
                            } else {
                                stat.innerText = Math.floor(current) + (originalText.includes('+') ? '+' : '');
                            }
                        }, 30);
                    }
                    observer.unobserve(stat);
                }
            });
        }, { threshold: 0.3 });
        
        statNumbers.forEach(stat => observer.observe(stat));
    }
    
    // ============================================
    // TOUCH DEVICE OPTIMIZATIONS
    // ============================================
    if ('ontouchstart' in window) {
        document.body.classList.add('touch-device');
        
        // Prevent double-tap zoom on buttons
        const buttons = document.querySelectorAll('.btn, .nav-link, .project-card, .skill-item');
        buttons.forEach(button => {
            button.addEventListener('touchstart', function(e) {
                // Don't prevent default on links
                if (!button.classList.contains('nav-link') && !button.closest('a')) {
                    e.preventDefault();
                }
            }, { passive: false });
        });
    }
    
    // ============================================
    // LAZY LOAD IMAGES
    // ============================================
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.classList.add('loaded');
                    }
                    imageObserver.unobserve(img);
                }
            });
        }, { rootMargin: '50px' });
        
        document.querySelectorAll('img[data-src]').forEach(img => imageObserver.observe(img));
    }
    
    // ============================================
    // MOBILE MENU TOGGLE (already in header, but adding enhancement)
    // ============================================
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
    
    // ============================================
    // BACK TO TOP BUTTON
    // ============================================
    const backToTop = document.getElementById('backToTop');
    if (backToTop) {
        window.addEventListener('scroll', function() {
            backToTop.classList.toggle('visible', window.scrollY > 500);
        });
        
        backToTop.addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
    
    // ============================================
    // ACTIVE NAVIGATION HIGHLIGHT
    // ============================================
    const currentPath = window.location.pathname;
    document.querySelectorAll('.nav-link, .mobile-nav-link').forEach(link => {
        const href = link.getAttribute('href');
        if (href && currentPath.includes(href) && href !== '/') {
            link.classList.add('active');
        } else if (href === '/' && currentPath === '/') {
            link.classList.add('active');
        }
    });
});

// ============================================
// WINDOW RESIZE HANDLER
// ============================================
let resizeTimer;
window.addEventListener('resize', () => {
    document.body.classList.add('resize-animation-stopper');
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(() => {
        document.body.classList.remove('resize-animation-stopper');
    }, 400);
});

// ============================================
// PRELOADER (optional)
// ============================================
window.addEventListener('load', function() {
    document.body.classList.add('loaded');
});