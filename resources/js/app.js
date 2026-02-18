import './bootstrap';
import './bootstrap';

// ============================================
// PAGE-SPECIFIC FUNCTIONALITY
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    
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
        }, { threshold: 0.2 });
        
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
        }, { threshold: 0.2 });
        
        timelineItems.forEach(item => {
            item.style.opacity = '0';
            item.style.transform = 'translateX(50px)';
            item.style.transition = 'all 0.6s ease';
            observer.observe(item);
        });
    }
    
    // ============================================
    // STATS COUNTER ANIMATION
    // ============================================
    const statNumbers = document.querySelectorAll('.stat-number');
    statNumbers.forEach(stat => {
        const text = stat.innerText;
        const number = parseInt(text.replace(/[^0-9]/g, ''));
        
        if (!isNaN(number) && number > 0) {
            let current = 0;
            const increment = number / 30;
            const originalText = stat.innerText;
            
            const observer = new IntersectionObserver((entries) => {
                if (entries[0].isIntersecting) {
                    const timer = setInterval(() => {
                        current += increment;
                        if (current >= number) {
                            stat.innerText = originalText;
                            clearInterval(timer);
                        } else {
                            stat.innerText = Math.floor(current) + (originalText.includes('+') ? '+' : '');
                        }
                    }, 50);
                    observer.unobserve(stat);
                }
            }, { threshold: 0.5 });
            
            observer.observe(stat);
        }
    });
    
    // ============================================
    // FILTER FUNCTIONALITY FOR PROJECTS (if needed)
    // ============================================
    const filterTags = document.querySelectorAll('.filter-tag');
    const projectsGrid = document.getElementById('projectsGrid');
    
    if (filterTags.length > 0 && projectsGrid) {
        filterTags.forEach(tag => {
            tag.addEventListener('click', function() {
                filterTags.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                
                const filter = this.dataset.filter;
                const projectCards = projectsGrid.querySelectorAll('.project-card');
                
                projectCards.forEach(card => {
                    if (filter === 'all') {
                        card.style.display = 'flex';
                    } else {
                        const techs = card.dataset.technologies?.split(',') || [];
                        card.style.display = techs.includes(filter) ? 'flex' : 'none';
                    }
                });
            });
        });
    }
});