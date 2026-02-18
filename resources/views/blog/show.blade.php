 
@extends('layouts.app')

@section('title', $post->title . ' · ' . theme_setting('site_title', 'Umesh Ghimire'))
@section('description', $post->excerpt ?? Str::limit(strip_tags($post->content), 160))

@push('styles')
<style>
    .post-header {
        padding: 3rem 0 2rem;
        max-width: 800px;
        margin: 0 auto;
    }
    
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--moss);
        text-decoration: none;
        font-weight: 600;
        margin-bottom: 2rem;
        border-bottom: 2px dotted var(--clay);
        padding-bottom: 0.3rem;
        transition: all 0.3s;
    }
    
    .back-link:hover {
        color: var(--clay);
        gap: 1rem;
    }
    
    .post-category {
        display: inline-block;
        background: var(--moss);
        color: white;
        padding: 0.3rem 1.2rem;
        border-radius: 30px 8px 30px 8px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 1.5rem;
    }
    
    .post-title {
        font-size: 3.5rem;
        font-weight: 800;
        color: var(--moss-deep);
        line-height: 1.2;
        margin-bottom: 1.5rem;
    }
    
    .post-meta {
        display: flex;
        gap: 2rem;
        margin-bottom: 2rem;
        color: #5a5f4b;
        font-size: 1rem;
        flex-wrap: wrap;
    }
    
    .post-meta i {
        color: var(--clay);
        margin-right: 0.5rem;
    }
    
    .post-meta-item {
        display: flex;
        align-items: center;
    }
    
    .post-image-container {
        border-radius: 80px 20px 80px 20px;
        overflow: hidden;
        margin: 2rem 0 3rem;
        border: 6px solid rgba(255, 250, 240, 0.6);
        box-shadow: 0 30px 40px -12px rgba(110, 70, 50, 0.25);
    }
    
    .post-image {
        width: 100%;
        max-height: 500px;
        object-fit: cover;
    }
    
    .post-content {
        max-width: 800px;
        margin: 0 auto;
        color: #3f4d45;
        line-height: 1.9;
        font-size: 1.1rem;
    }
    
    .post-content h2 {
        font-size: 2rem;
        color: var(--moss-deep);
        margin: 2.5rem 0 1rem;
    }
    
    .post-content h3 {
        font-size: 1.5rem;
        color: var(--moss);
        margin: 2rem 0 1rem;
    }
    
    .post-content p {
        margin-bottom: 1.8rem;
    }
    
    .post-content blockquote {
        border-left: 4px solid var(--clay);
        padding: 1rem 2rem;
        margin: 2rem 0;
        background: rgba(193, 123, 92, 0.05);
        font-style: italic;
        border-radius: 0 30px 30px 0;
        font-size: 1.2rem;
        color: var(--moss-deep);
    }
    
    .post-content ul, .post-content ol {
        margin: 1.5rem 0 1.5rem 2rem;
    }
    
    .post-content li {
        margin-bottom: 0.5rem;
    }
    
    .post-content img {
        max-width: 100%;
        border-radius: 40px 12px 40px 12px;
        margin: 2rem 0;
        border: 3px solid var(--clay-light);
    }
    
    .post-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.8rem;
        margin: 3rem 0;
        padding: 2rem 0;
        border-top: 1px dashed var(--clay-light);
        border-bottom: 1px dashed var(--clay-light);
    }
    
    .post-tag {
        background: var(--ash);
        padding: 0.5rem 1.5rem;
        border-radius: 40px 12px 40px 12px;
        font-weight: 600;
        color: var(--moss-deep);
        border: 1px solid var(--clay-light);
        text-decoration: none;
        transition: all 0.3s;
    }
    
    .post-tag:hover {
        background: var(--clay);
        color: white;
        border-color: var(--clay);
        transform: translateY(-2px);
    }
    
    .share-section {
        margin: 3rem 0;
        text-align: center;
    }
    
    .share-title {
        font-size: 1.2rem;
        color: var(--moss-deep);
        margin-bottom: 1rem;
    }
    
    .share-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
    }
    
    .share-button {
        width: 50px;
        height: 50px;
        border-radius: 30% 50% 30% 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        transition: all 0.3s;
    }
    
    .share-button:hover {
        transform: translateY(-5px) rotate(8deg);
    }
    
    .share-button.twitter { background: #000; }
    .share-button.facebook { background: #1877f2; }
    .share-button.linkedin { background: #0077b5; }
    .share-button.whatsapp { background: #25d366; }
    
    .post-navigation {
        display: flex;
        justify-content: space-between;
        margin: 4rem 0;
        padding: 2rem 0;
        border-top: 1px dashed var(--clay-light);
        border-bottom: 1px dashed var(--clay-light);
    }
    
    .nav-prev,
    .nav-next {
        display: flex;
        align-items: center;
        gap: 1rem;
        text-decoration: none;
        color: var(--moss-deep);
        transition: all 0.3s;
        max-width: 300px;
    }
    
    .nav-prev:hover {
        transform: translateX(-10px);
        color: var(--clay);
    }
    
    .nav-next:hover {
        transform: translateX(10px);
        color: var(--clay);
    }
    
    .nav-label {
        font-size: 0.85rem;
        color: var(--clay);
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .nav-title {
        font-weight: 700;
    }
    
    .related-posts {
        margin: 4rem 0;
    }
    
    .related-posts h3 {
        font-size: 2rem;
        font-weight: 700;
        color: var(--moss-deep);
        margin-bottom: 2rem;
        text-align: center;
    }
    
    .related-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
    }
    
    .related-card {
        background: white;
        border-radius: 50px 20px 50px 20px;
        overflow: hidden;
        border: 1px solid var(--clay-light);
        transition: all 0.3s;
    }
    
    .related-card:hover {
        transform: translateY(-5px);
        border-color: var(--clay);
        box-shadow: var(--shadow-warm);
    }
    
    .related-image {
        height: 150px;
        overflow: hidden;
    }
    
    .related-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    
    .related-card:hover .related-image img {
        transform: scale(1.1);
    }
    
    .related-content {
        padding: 1.5rem;
    }
    
    .related-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--moss-deep);
        margin-bottom: 0.5rem;
    }
    
    .related-date {
        font-size: 0.85rem;
        color: #8a9d8a;
    }
    
    @media (max-width: 768px) {
        .post-title { font-size: 2.5rem; }
        .related-grid { grid-template-columns: 1fr; }
        .post-navigation { flex-direction: column; gap: 1rem; }
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="post-header">
        <a href="{{ route('blog.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i> {{ theme_setting('back_to_blog_text', 'back to field notes') }}
        </a>
        
        @if($post->category)
        <div class="post-category">{{ $post->category }}</div>
        @endif
        
        <h1 class="post-title">{{ $post->title }}</h1>
        
        <div class="post-meta">
            <div class="post-meta-item">
                <i class="fas fa-calendar-alt"></i> {{ $post->published_at->format('F j, Y') }}
            </div>
            <div class="post-meta-item">
                <i class="fas fa-clock"></i> {{ $post->reading_time }} {{ Str::plural('min', $post->reading_time) }} read
            </div>
            <div class="post-meta-item">
                <i class="fas fa-eye"></i> {{ number_format($post->views_count) }} views
            </div>
            @if($post->user)
            <div class="post-meta-item">
                <i class="fas fa-user"></i> {{ $post->user->name }}
            </div>
            @endif
        </div>
    </div>
    
    @if($post->featured_image)
    <div class="post-image-container">
        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="post-image">
    </div>
    @endif
    
    <div class="post-content">
        {!! $post->content !!}
    </div>
    
    @if($post->tags && count($post->tags) > 0)
    <div class="post-tags">
        @foreach($post->tags as $tag)
            <a href="{{ route('blog.tag', $tag) }}" class="post-tag">#{{ $tag }}</a>
        @endforeach
    </div>
    @endif
    
    <!-- Share Section -->
    <div class="share-section">
        <div class="share-title">{{ theme_setting('share_label', 'share this story') }}</div>
        <div class="share-buttons">
            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title) }}" 
               target="_blank" class="share-button twitter">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
               target="_blank" class="share-button facebook">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($post->title) }}" 
               target="_blank" class="share-button linkedin">
                <i class="fab fa-linkedin-in"></i>
            </a>
            <a href="https://wa.me/?text={{ urlencode($post->title . ' ' . url()->current()) }}" 
               target="_blank" class="share-button whatsapp">
                <i class="fab fa-whatsapp"></i>
            </a>
        </div>
    </div>
    
    <!-- Post Navigation -->
    @if($prevPost || $nextPost)
    <div class="post-navigation">
        @if($prevPost)
        <a href="{{ route('blog.show', $prevPost->slug) }}" class="nav-prev">
            <i class="fas fa-arrow-left" style="color: var(--clay);"></i>
            <div>
                <div class="nav-label">{{ theme_setting('previous_label', 'previous') }}</div>
                <div class="nav-title">{{ $prevPost->title }}</div>
            </div>
        </a>
        @else
        <div></div>
        @endif
        
        @if($nextPost)
        <a href="{{ route('blog.show', $nextPost->slug) }}" class="nav-next">
            <div style="text-align: right;">
                <div class="nav-label">{{ theme_setting('next_label', 'next') }}</div>
                <div class="nav-title">{{ $nextPost->title }}</div>
            </div>
            <i class="fas fa-arrow-right" style="color: var(--clay);"></i>
        </a>
        @endif
    </div>
    @endif
    
    <!-- Related Posts -->
    @if($relatedPosts && $relatedPosts->count() > 0)
    <div class="related-posts">
        <h3>{{ theme_setting('related_posts_label', 'you might also like') }}</h3>
        <div class="related-grid">
            @foreach($relatedPosts as $related)
            <a href="{{ route('blog.show', $related->slug) }}" style="text-decoration: none;">
                <div class="related-card">
                    <div class="related-image">
                        @if($related->featured_image)
                            <img src="{{ asset('storage/' . $related->featured_image) }}" alt="{{ $related->title }}">
                        @else
                            <div style="width:100%; height:100%; background: linear-gradient(145deg, var(--clay-light), var(--clay)); display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-feather" style="font-size: 2rem; color: white; opacity: 0.8;"></i>
                            </div>
                        @endif
                    </div>
                    <div class="related-content">
                        <div class="related-title">{{ Str::limit($related->title, 50) }}</div>
                        <div class="related-date">{{ $related->published_at->format('M j, Y') }}</div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection