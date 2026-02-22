@php
    $showBlog = theme_setting('show_blog_section', true);
@endphp

@if($showBlog && isset($latestPosts) && $latestPosts->count() > 0)
<style>
    .blog-section {
        margin: clamp(3rem, 8vw, 5rem) 0;
        width: 100%;
        overflow: hidden;
    }
    
    .blog-section .container {
        max-width: 1300px;
        margin: 0 auto;
        padding: 0 clamp(15px, 4vw, 20px);
    }
    
    .section-header {
        display: flex;
        flex-direction: column;
        margin-bottom: clamp(2rem, 5vw, 3rem);
        text-align: center;
    }
    
    .section-header h2 {
        font-size: clamp(2rem, 6vw, 3rem);
        font-weight: 700;
        color: var(--moss-deep);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: clamp(10px, 2vw, 15px);
        margin-bottom: 1rem;
        flex-wrap: wrap;
    }
    
    .section-header h2 i {
        color: var(--clay);
        font-size: clamp(1.8rem, 5vw, 2.5rem);
    }
    
    .blog-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(min(280px, 100%), 1fr));
        gap: clamp(1.5rem, 4vw, 2rem);
        margin-top: clamp(2rem, 5vw, 3rem);
    }
    
    .blog-card {
        background: white;
        border-radius: clamp(40px, 8vw, 60px) clamp(15px, 3vw, 20px) 
                      clamp(40px, 8vw, 60px) clamp(15px, 3vw, 20px);
        overflow: hidden;
        border: 1px solid var(--clay-light);
        transition: all 0.3s;
        box-shadow: var(--shadow-warm);
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    
    .blog-card:hover {
        transform: translateY(-8px) rotate(0.3deg);
        border-color: var(--clay);
        box-shadow: 0 30px 40px -15px rgba(193, 123, 92, 0.3);
    }
    
    .blog-image-container {
        height: clamp(160px, 25vw, 200px);
        overflow: hidden;
        position: relative;
    }
    
    .blog-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    
    .blog-card:hover .blog-image-container img {
        transform: scale(1.1);
    }
    
    .blog-image-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(145deg, var(--clay-light), var(--clay));
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .blog-image-placeholder i {
        font-size: clamp(2.5rem, 6vw, 3.5rem);
        color: white;
        opacity: 0.8;
    }
    
    .blog-content {
        padding: clamp(1.2rem, 3vw, 1.8rem);
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    
    .blog-category {
        display: inline-block;
        background: var(--moss);
        color: white;
        padding: 0.2rem clamp(0.8rem, 2vw, 1rem);
        border-radius: 30px 8px 30px 8px;
        font-size: clamp(0.7rem, 1.8vw, 0.75rem);
        font-weight: 600;
        margin-bottom: clamp(0.8rem, 2vw, 1rem);
        width: fit-content;
    }
    
    .blog-title {
        font-size: clamp(1.2rem, 3vw, 1.4rem);
        font-weight: 700;
        color: var(--moss-deep);
        margin-bottom: clamp(0.6rem, 1.5vw, 0.8rem);
        line-height: 1.3;
        word-wrap: break-word;
    }
    
    .blog-excerpt {
        color: #5a5f4b;
        margin-bottom: clamp(1rem, 2.5vw, 1.2rem);
        line-height: 1.6;
        font-size: clamp(0.9rem, 2.2vw, 0.95rem);
        flex: 1;
        word-wrap: break-word;
    }
    
    .blog-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
        padding-top: clamp(0.8rem, 2vw, 1rem);
        border-top: 1px dashed var(--clay-light);
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    
    .blog-read-more {
        font-weight: 700;
        color: var(--clay);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
        font-size: clamp(0.9rem, 2.2vw, 0.95rem);
    }
    
    .blog-read-more:hover {
        color: var(--moss);
        gap: 10px;
    }
    
    .blog-date {
        font-size: clamp(0.75rem, 2vw, 0.8rem);
        color: #8a9d8a;
    }
    
    .blog-view-all {
        text-align: center;
        margin-top: clamp(2.5rem, 6vw, 3.5rem);
    }
    
    .btn-outline {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: transparent;
        color: var(--moss-deep);
        border: 2px solid var(--clay);
        padding: clamp(0.8rem, 2vw, 1rem) clamp(1.5rem, 4vw, 2rem);
        border-radius: 40px 12px 40px 12px;
        font-weight: 600;
        font-size: clamp(0.9rem, 2.2vw, 1rem);
        text-decoration: none;
        transition: all 0.3s;
    }
    
    .btn-outline:hover {
        background: var(--clay-light);
        transform: translateY(-3px);
    }
    
    /* Empty state */
    .empty-state {
        text-align: center;
        padding: clamp(2rem, 6vw, 4rem);
        background: rgba(255, 247, 240, 0.5);
        border-radius: 60px 20px 60px 20px;
        border: 1px dashed var(--clay-light);
    }
    
    .empty-state i {
        font-size: clamp(3rem, 8vw, 4rem);
        color: var(--clay);
        margin-bottom: 1rem;
    }
    
    .empty-state p {
        color: #5a5f4b;
        font-size: clamp(0.95rem, 2.2vw, 1rem);
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .blog-grid {
            grid-template-columns: repeat(auto-fit, minmax(min(250px, 100%), 1fr));
        }
        
        .blog-footer {
            flex-direction: column;
            align-items: flex-start;
        }
    }
    
    @media (max-width: 480px) {
        .blog-grid {
            grid-template-columns: 1fr;
        }
        
        .section-header h2 {
            font-size: 1.8rem;
        }
        
        .blog-image-container {
            height: 180px;
        }
        
        .blog-content {
            padding: 1.2rem;
        }
        
        .btn-outline {
            width: 100%;
            justify-content: center;
        }
    }
    
    /* Landscape mode */
    @media (orientation: landscape) and (max-height: 600px) {
        .blog-section {
            margin: 2rem 0;
        }
        
        .blog-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }
</style>

<section id="blog" class="blog-section">
    <div class="container">
        <div class="section-header">
            <h2><i class="fas fa-feather"></i> {{ theme_setting('blog_section_title', 'field notes') }}</h2>
        </div>
        
        <div class="blog-grid">
            @foreach($latestPosts as $post)
                @php
                    $readingTime = $post->reading_time ?? ceil(str_word_count(strip_tags($post->content)) / 200);
                @endphp
                <div class="blog-card">
                    <div class="blog-image-container">
                        @if($post->featured_image)
                            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" loading="lazy">
                        @else
                            <div class="blog-image-placeholder">
                                <i class="fas fa-feather"></i>
                            </div>
                        @endif
                    </div>
                    
                    <div class="blog-content">
                        @if($post->category)
                        <span class="blog-category">{{ $post->category }}</span>
                        @endif
                        
                        <h3 class="blog-title">{{ Str::limit($post->title, 60) }}</h3>
                        
                        <p class="blog-excerpt">{{ $post->excerpt ?? Str::limit(strip_tags($post->content), 100) }}</p>
                        
                        <div class="blog-footer">
                            <a href="{{ route('blog.show', $post->slug) }}" class="blog-read-more">
                                {{ theme_setting('read_more_text', 'read more') }} <i class="fas fa-arrow-right"></i>
                            </a>
                            <span class="blog-date">{{ $post->published_at->format('M j, Y') }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="blog-view-all">
            <a href="{{ route('blog.index') }}" class="btn-outline">
                <i class="fas fa-feather"></i> {{ theme_setting('view_all_posts_text', 'read all field notes') }}
            </a>
        </div>
    </div>
</section>
@endif