import './bootstrap';
import './bootstrap';

// Organic Portfolio - Soil & Code Theme
// Custom JavaScript for animations and interactions

document.addEventListener('DOMContentLoaded', function() {
    
    // ============================================
    // SMOOTH SCROLL FOR ANCHOR LINKS
    // ============================================
    const anchorLinks = document.querySelectorAll('a[href^="#"]:not([href="#"])');
    
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start',
                });
                
                // Update URL without jumping
                history.pushState(null, null, targetId);
            }
        });
    });

    // ============================================
    // ORGANIC CURSOR EFFECT (Optional)
    // ============================================
    const cursor = document.createElement('div');
    cursor.className = 'organic-cursor';
    cursor.style.cssText = `
        position: fixed;
        width: 20px;
        height: 20px;
        border-radius: 50% 30% 50% 30%;
        background: rgba(193, 123, 92, 0.2);
        pointer-events: none;
        z-index: 9999;
        transition: transform 0.2s ease;
        transform: translate(-50%, -50%);
        display: none;
    `;
    document.body.appendChild(cursor);

    let cursorVisible = false;
    let cursorEnlarged = false;

    if (window.innerWidth > 768) {
        cursor.style.display = 'block';
        cursorVisible = true;

        document.addEventListener('mousemove', (e) => {
            cursor.style.left = e.clientX + 'px';
            cursor.style.top = e.clientY + 'px';
        });

        // Enlarge cursor on hoverable elements
        const hoverables = document.querySelectorAll('a, button, input, textarea, .clay-pot-card');
        
        hoverables.forEach(element => {
            element.addEventListener('mouseenter', () => {
                cursor.style.transform = 'translate(-50%, -50%) scale(1.5)';
                cursor.style.background = 'rgba(193, 123, 92, 0.3)';
                cursorEnlarged = true;
            });
            
            element.addEventListener('mouseleave', () => {
                cursor.style.transform = 'translate(-50%, -50%) scale(1)';
                cursor.style.background = 'rgba(193, 123, 92, 0.2)';
                cursorEnlarged = false;
            });
        });
    }

    // ============================================
    // PARALLAX EFFECT FOR HIMALAYAN TEXTURE
    // ============================================
    const texture = document.querySelector('.himalayan-texture');
    
    if (texture) {
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            texture.style.transform = `translateY(${scrolled * 0.1}px)`;
        });
    }

    // ============================================
    // INTERSECTION OBSERVER FOR FADE-IN ANIMATIONS
    // ============================================
    const fadeElements = document.querySelectorAll('.clay-pot-card, .skill-badge, .section-title');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    fadeElements.forEach(element => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(20px)';
        element.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(element);
    });

    // ============================================
    // FORM VALIDATION & AJAX SUBMISSION
    // ============================================
    const contactForm = document.querySelector('form[action*="contact"]');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitButton = this.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;
            
            // Show loading state
            submitButton.innerHTML = '<span>sowing...</span> <span class="animate-spin">🌱</span>';
            submitButton.disabled = true;
            
            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    const successMessage = document.createElement('div');
                    successMessage.className = 'fixed bottom-4 right-4 bg-moss text-rice px-6 py-4 rounded-pottery-sm shadow-lg animate-grow';
                    successMessage.innerHTML = '🌱 ' + data.message;
                    document.body.appendChild(successMessage);
                    
                    // Reset form
                    contactForm.reset();
                    
                    // Remove message after 5 seconds
                    setTimeout(() => {
                        successMessage.remove();
                    }, 5000);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                
                // Show error message
                const errorMessage = document.createElement('div');
                errorMessage.className = 'fixed bottom-4 right-4 bg-clay text-rice px-6 py-4 rounded-pottery-sm shadow-lg';
                errorMessage.innerHTML = '🌱 Something went wrong. Please try again.';
                document.body.appendChild(errorMessage);
                
                setTimeout(() => {
                    errorMessage.remove();
                }, 5000);
            })
            .finally(() => {
                // Reset button
                submitButton.innerHTML = originalText;
                submitButton.disabled = false;
            });
        });
    }

    // ============================================
    // SKILLS FILTER / SHOW MORE (if implemented)
    // ============================================
    const showMoreButton = document.querySelector('.show-more-skills');
    const hiddenSkills = document.querySelectorAll('.skill-hidden');
    
    if (showMoreButton && hiddenSkills.length > 0) {
        showMoreButton.addEventListener('click', function() {
            hiddenSkills.forEach(skill => {
                skill.classList.remove('hidden');
                skill.classList.add('animate-grow');
            });
            this.style.display = 'none';
        });
    }

    // ============================================
    // RANDOM ORGANIC BORDER RADIUS FOR CARDS
    // ============================================
    const cards = document.querySelectorAll('.clay-pot-card');
    
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            const random = Math.floor(Math.random() * 4);
            const radii = [
                '50px 20px 50px 20px',
                '20px 50px 20px 50px',
                '70px 30px 70px 30px',
                '30px 70px 30px 70px'
            ];
            this.style.borderRadius = radii[random];
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.borderRadius = '50px 20px 50px 20px';
        });
    });

    // ============================================
    // PROJECT FILTERING (if implemented)
    // ============================================
    const filterButtons = document.querySelectorAll('[data-filter]');
    const projectItems = document.querySelectorAll('[data-category]');
    
    if (filterButtons.length > 0 && projectItems.length > 0) {
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const filter = this.dataset.filter;
                
                // Update active button
                filterButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                // Filter projects
                projectItems.forEach(item => {
                    if (filter === 'all' || item.dataset.category === filter) {
                        item.style.display = 'block';
                        setTimeout(() => {
                            item.style.opacity = '1';
                            item.style.transform = 'scale(1)';
                        }, 10);
                    } else {
                        item.style.opacity = '0';
                        item.style.transform = 'scale(0.8)';
                        setTimeout(() => {
                            item.style.display = 'none';
                        }, 300);
                    }
                });
            });
        });
    }

    // ============================================
    // MOBILE MENU TOGGLE
    // ============================================
    const menuButton = document.querySelector('[data-menu-button]');
    const mobileMenu = document.querySelector('[data-mobile-menu]');
    
    if (menuButton && mobileMenu) {
        menuButton.addEventListener('click', function() {
            const expanded = this.getAttribute('aria-expanded') === 'true' || false;
            this.setAttribute('aria-expanded', !expanded);
            mobileMenu.classList.toggle('hidden');
            
            // Animate menu items
            if (!mobileMenu.classList.contains('hidden')) {
                const menuItems = mobileMenu.querySelectorAll('a');
                menuItems.forEach((item, index) => {
                    item.style.animation = `slideIn 0.3s ease forwards ${index * 0.1}s`;
                });
            }
        });
    }

    // ============================================
    // BACK TO TOP BUTTON
    // ============================================
    const backToTop = document.createElement('button');
    backToTop.innerHTML = '↑';
    backToTop.className = 'fixed bottom-4 left-4 w-12 h-12 bg-clay text-rice rounded-pottery-sm shadow-lg opacity-0 transition-opacity duration-300 hover:bg-clay-light hover:text-moss-deep focus:outline-none z-50';
    backToTop.style.opacity = '0';
    backToTop.style.pointerEvents = 'none';
    backToTop.setAttribute('aria-label', 'Back to top');
    document.body.appendChild(backToTop);

    window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
            backToTop.style.opacity = '1';
            backToTop.style.pointerEvents = 'auto';
        } else {
            backToTop.style.opacity = '0';
            backToTop.style.pointerEvents = 'none';
        }
    });

    backToTop.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // ============================================
    // TYPEWRITER EFFECT FOR HERO (Optional)
    // ============================================
    const heroTitle = document.querySelector('[data-typewriter]');
    
    if (heroTitle) {
        const words = JSON.parse(heroTitle.dataset.words || '["soil & code"]');
        let wordIndex = 0;
        let charIndex = 0;
        let isDeleting = false;
        
        function typeEffect() {
            const currentWord = words[wordIndex];
            
            if (isDeleting) {
                heroTitle.textContent = currentWord.substring(0, charIndex - 1);
                charIndex--;
            } else {
                heroTitle.textContent = currentWord.substring(0, charIndex + 1);
                charIndex++;
            }
            
            if (!isDeleting && charIndex === currentWord.length) {
                isDeleting = true;
                setTimeout(typeEffect, 2000);
            } else if (isDeleting && charIndex === 0) {
                isDeleting = false;
                wordIndex = (wordIndex + 1) % words.length;
                setTimeout(typeEffect, 500);
            } else {
                setTimeout(typeEffect, isDeleting ? 50 : 100);
            }
        }
        
        setTimeout(typeEffect, 1000);
    }

    // ============================================
    // ADD KEYFRAMES DYNAMICALLY
    // ============================================
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        .animate-spin {
            animation: spin 1s linear infinite;
            display: inline-block;
        }
    `;
    document.head.appendChild(style);
});