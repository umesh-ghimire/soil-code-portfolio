@php
    $showBlog = theme_setting('show_blog_section', true);
@endphp

@if($showBlog && isset($latestPosts) && $latestPosts->count() > 0)
<section id="blog" class="blog-section" style="margin: var(--space-xxl) 0;">
    <div class="container">
        <div class="section-header">
            <h2><i class="fas fa-feather"></i> {{ theme_setting('blog_section_title', 'field notes') }}</h2>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; margin-top: 2rem;">
            @foreach($latestPosts as $post)
                @php
                    $readingTime = $post->reading_time ?? ceil(str_word_count(strip_tags($post->content)) / 200);
                @endphp
                <div class="blog-card" style="background: white; border-radius: 60px 20px 60px 20px; overflow: hidden; border: 1px solid var(--clay-light); transition: all 0.3s; box-shadow: var(--shadow-warm);">
                    @if($post->featured_image)
                    <div style="height: 180px; overflow: hidden;">
                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.6s ease;">
                    </div>
                    @else
                    <div style="height: 180px; background: linear-gradient(145deg, var(--clay-light), var(--clay)); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-feather" style="font-size: 3rem; color: white; opacity: 0.8;"></i>
                    </div>
                    @endif
                    
                    <div style="padding: 1.8rem;">
                        @if($post->category)
                        <span style="display: inline-block; background: var(--moss); color: white; padding: 0.2rem 1rem; border-radius: 30px 8px 30px 8px; font-size: 0.7rem; font-weight: 600; margin-bottom: 1rem;">{{ $post->category }}</span>
                        @endif
                        
                        <h3 style="font-size: 1.3rem; font-weight: 700; color: var(--moss-deep); margin-bottom: 0.8rem;">{{ Str::limit($post->title, 50) }}</h3>
                        
                        <p style="color: #5a5f4b; margin-bottom: 1.2rem; line-height: 1.6;">{{ $post->excerpt ?? Str::limit(strip_tags($post->content), 80) }}</p>
                        
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <a href="{{ route('blog.show', $post->slug) }}" style="font-weight: 700; color: var(--clay); text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                                {{ theme_setting('read_more_text', 'read more') }} <i class="fas fa-arrow-right"></i>
                            </a>
                            <span style="font-size: 0.8rem; color: #8a9d8a;">{{ $post->published_at->format('M j') }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div style="text-align: center; margin-top: 3rem;">
            <a href="{{ route('blog.index') }}" class="btn btn-outline">
                <i class="fas fa-feather"></i> {{ theme_setting('view_all_posts_text', 'read all field notes') }}
            </a>
        </div>
    </div>
</section>
@endif