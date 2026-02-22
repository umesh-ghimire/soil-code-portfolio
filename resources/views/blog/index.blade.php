@extends('layouts.app')

@section('title', theme_setting('blog_page_title', 'thoughts & field notes · Umesh Ghimire'))
@section('description', theme_setting('blog_meta_description', 'Writing about code, community, and the space where technology meets tradition.'))

@push('styles')
<style>
    .blog-header {
        padding: 3rem 0 2rem;
        text-align: center;
    }
    
    .blog-header h1 {
        font-size: 4rem;
        font-weight: 800;
        color: var(--moss-deep);
        margin-bottom: 1rem;
    }
    
    .blog-header p {
        font-size: 1.3rem;
        color: #5a5f4b;
        max-width: 700px;
        margin: 0 auto;
        border-left: 4px solid var(--clay);
        padding-left: 1.6rem;
    }
    
    .featured-post {
        background: rgba(255, 247, 240, 0.7);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(193, 123, 92, 0.25);
        border-radius: 80px 20px 80px 20px;
        padding: 3rem;
        margin: 3rem 0;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 3rem;
        align-items: center;
        box-shadow: var(--shadow-warm);
    }
    
    .featured-badge {
        display: inline-block;
        background: var(--clay);
        color: white;
        padding: 0.3rem 1.2rem;
        border-radius: 30px 8px 30px 8px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .featured-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--moss-deep);
        margin-bottom: 1rem;
        line-height: 1.2;
    }
    
    .featured-excerpt {
        color: #5a5f4b;
        margin-bottom: 1.5rem;
        font-size: 1.1rem;
        line-height: 1.8;
    }
    
    .featured-meta {
        display: flex;
        gap: 2rem;
        margin-bottom: 2rem;
        color: #5a5f4b;
        font-size: 0.95rem;
    }
    
    .featured-meta i {
        color: var(--clay);
        margin-right: 0.5rem;
    }
    
    .featured-image {
        border-radius: 40px 12px 40px 12px;
        overflow: hidden;
        aspect-ratio: 16/9;
        border: 3px solid var(--clay-light);
    }
    
    .featured-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    
    .featured-image:hover img {
        transform: scale(1.05);
    }
    
    .blog-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 3rem;
        margin: 4rem 0;
    }
    
    .posts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
    }
    
    .post-card {
        background: white;
        border-radius: 60px 20px 60px 20px;
        overflow: hidden;
        transition: all 0.35s;
        box-shadow: var(--shadow-warm);
        border: 1px solid var(--clay-light);
        display: flex;
        flex-direction: column;
    }
    
    .post-card:hover {
        transform: translateY(-8px) rotate(0.3deg);
        border-color: var(--clay);
        box-shadow: 0 30px 40px -15px rgba(193, 123, 92, 0.3);
    }
    
    .post-image {
        height: 200px;
        overflow: hidden;
        position: relative;
    }
    
    .post-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    
    .post-card:hover .post-image img {
        transform: scale(1.1);
    }
    
    .post-category {
        position: absolute;
        top: 1rem;
        left: 1rem;
        background: var(--moss);
        color: white;
        padding: 0.3rem 1rem;
        border-radius: 30px 8px 30px 8px;
        font-size: 0.75rem;
        font-weight: 600;
        z-index: 2;
    }
    
    .post-content {
        padding: 2rem 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    
    .post-meta {
        display: flex;
        gap: 1rem;
        font-size: 0.85rem;
        color: #8a9d8a;
        margin-bottom: 1rem;
    }
    
    .post-meta i {
        color: var(--clay);
        margin-right: 0.3rem;
    }
    
    .post-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--moss-deep);
        margin-bottom: 1rem;
        line-height: 1.3;
    }
    
    .post-excerpt {
        color: #5a5f4b;
        margin-bottom: 1.5rem;
        line-height: 1.6;
        flex: 1;
    }
    
    .post-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }
    
    .post-tag {
        background: var(--ash);
        padding: 0.2rem 1rem;
        border-radius: 30px 8px 30px 8px;
        font-size: 0.7rem;
        font-weight: 600;
        color: var(--moss-deep);
        border: 1px solid var(--clay-light);
    }
    
    .post-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
        padding-top: 1rem;
        border-top: 1px dashed var(--clay-light);
    }
    
    .post-link {
        font-weight: 700;
        color: var(--clay);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
    }
    
    .post-link:hover {
        color: var(--moss);
        gap: 10px;
    }
    
    .post-date {
        font-size: 0.85rem;
        color: #8a9d8a;
        font-style: italic;
    }
    
    .sidebar {
        background: rgba(227, 219, 207, 0.2);
        border-radius: 60px 20px 60px 20px;
        padding: 2rem;
        border: 1px solid rgba(193, 123, 92, 0.25);
    }
    
    .sidebar-widget {
        margin-bottom: 2.5rem;
    }
    
    .sidebar-widget h3 {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--moss-deep);
        margin-bottom: 1.5rem;
        position: relative;
        padding-bottom: 0.8rem;
        border-bottom: 2px dashed var(--clay-light);
    }
    
    .category-list {
        list-style: none;
        padding: 0;
    }
    
    .category-list li {
        margin-bottom: 0.8rem;
    }
    
    .category-list a {
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: #5a5f4b;
        text-decoration: none;
        padding: 0.5rem 0;
        transition: all 0.2s;
        border-bottom: 1px dotted rgba(193, 123, 92, 0.2);
    }
    
    .category-list a:hover {
        color: var(--clay);
        transform: translateX(5px);
    }
    
    .category-count {
        background: var(--ash);
        padding: 0.2rem 0.8rem;
        border-radius: 20px 5px 20px 5px;
        font-size: 0.8rem;
        color: var(--moss-deep);
    }
    
    .tag-cloud {
        display: flex;
        flex-wrap: wrap;
        gap: 0.8rem;
    }
    
    .tag-cloud a {
        background: white;
        padding: 0.5rem 1.2rem;
        border-radius: 30px 8px 30px 8px;
        font-size: 0.85rem;
        color: var(--moss-deep);
        text-decoration: none;
        border: 1px solid var(--clay-light);
        transition: all 0.2s;
    }
    
    .tag-cloud a:hover {
        background: var(--clay);
        color: white;
        border-color: var(--clay);
        transform: translateY(-2px);
    }
    
    .pagination-container {
        display: flex;
        justify-content: center;
        margin: 4rem 0;
    }
    
    .pagination {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    
    .pagination-item {
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        border: 1px solid var(--clay-light);
        border-radius: 30% 50% 30% 50%;
        color: var(--ink);
        text-decoration: none;
        transition: all 0.3s;
    }
    
    .pagination-item:hover,
    .pagination-item.active {
        background: var(--clay);
        color: white;
        border-color: var(--clay);
        transform: scale(1.1);
    }
    
    
</style>
@endpush

@section('content')
@php
    $categories = \App\Models\BlogPost::published()
        ->select('category')
        ->distinct()
        ->get()
        ->pluck('category')
        ->filter();
    
    $allTags = \App\Models\BlogPost::published()
        ->get()
        ->flatMap(function ($post) {
            $tags = $post->tags ?? [];
            return is_array($tags) ? $tags : [];
        })
        ->countBy()
        ->sortDesc()
        ->take(15);
@endphp

<div class="container">
    <div class="blog-header">
        <h1>{{ theme_setting('blog_page_title', 'thoughts & field notes') }}</h1>
        <p>{{ theme_setting('blog_subtitle', 'Writing about code, community, and the space where technology meets tradition.') }}</p>
    </div>
    
    @if(isset($featuredPost) && $featuredPost)
    <!-- Featured Post -->
    <div class="featured-post">
        <div>
            <span class="featured-badge"><i class="fas fa-star"></i> {{ theme_setting('featured_label', 'featured') }}</span>
            <h2 class="featured-title">{{ $featuredPost->title }}</h2>
            <p class="featured-excerpt">{{ $featuredPost->excerpt ?? Str::limit(strip_tags($featuredPost->content), 150) }}</p>
            <div class="featured-meta">
                <span><i class="fas fa-calendar-alt"></i> {{ $featuredPost->published_at->format('M j, Y') }}</span>
                <span><i class="fas fa-clock"></i> {{ $featuredPost->reading_time }} {{ Str::plural('min', $featuredPost->reading_time) }} read</span>
                <span><i class="fas fa-eye"></i> {{ number_format($featuredPost->views_count) }} views</span>
            </div>
            <a href="{{ route('blog.show', $featuredPost->slug) }}" class="btn btn-moss">
                {{ theme_setting('read_more_text', 'read the story') }} <i class="fas fa-arrow-right"></i>
            </a>
        </div>
        <div class="featured-image">
            @if($featuredPost->featured_image)
                <img src="{{ asset('storage/' . $featuredPost->featured_image) }}" alt="{{ $featuredPost->title }}">
            @else
                <div style="width:100%; height:100%; background: linear-gradient(145deg, var(--clay-light), var(--clay)); display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-pen-fancy" style="font-size: 4rem; color: white; opacity: 0.8;"></i>
                </div>
            @endif
        </div>
    </div>
    @endif
    
    <div class="blog-grid">
        <!-- Posts Grid -->
        <div>
            @if($posts->count() > 0)
                <div class="posts-grid">
                    @foreach($posts as $post)
                        @php
                            $readingTime = $post->reading_time ?? ceil(str_word_count(strip_tags($post->content)) / 200);
                            $postTags = is_array($post->tags) ? $post->tags : [];
                        @endphp
                        <div class="post-card">
                            <div class="post-image">
                                @if($post->featured_image)
                                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}">
                                @else
                                    <div style="width:100%; height:100%; background: linear-gradient(145deg, var(--clay-light), var(--clay)); display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-feather" style="font-size: 3rem; color: white; opacity: 0.8;"></i>
                                    </div>
                                @endif
                                @if($post->category)
                                    <span class="post-category">{{ $post->category }}</span>
                                @endif
                            </div>
                            
                            <div class="post-content">
                                <div class="post-meta">
                                    <span><i class="fas fa-calendar-alt"></i> {{ $post->published_at->format('M j, Y') }}</span>
                                    <span><i class="fas fa-clock"></i> {{ $readingTime }} min</span>
                                </div>
                                
                                <h3 class="post-title">{{ $post->title }}</h3>
                                <p class="post-excerpt">{{ $post->excerpt ?? Str::limit(strip_tags($post->content), 100) }}</p>
                                
                                @if(count($postTags) > 0)
                                <div class="post-tags">
                                    @foreach(array_slice($postTags, 0, 3) as $tag)
                                        <span class="post-tag">{{ $tag }}</span>
                                    @endforeach
                                </div>
                                @endif
                                
                                <div class="post-footer">
                                    <a href="{{ route('blog.show', $post->slug) }}" class="post-link">
                                        {{ theme_setting('read_more_text', 'read more') }} <i class="fas fa-arrow-right"></i>
                                    </a>
                                    <span class="post-date">{{ $post->published_at->format('M j') }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                @if($posts->hasPages())
                <div class="pagination-container">
                    {{ $posts->links('pagination::default') }}
                </div>
                @endif
            @else
                <div class="empty-state">
                    <i class="fas fa-feather"></i>
                    <h3>{{ theme_setting('no_posts_title', 'no stories yet') }}</h3>
                    <p>{{ theme_setting('no_posts_message', 'Thoughts are being gathered. Check back soon!') }}</p>
                </div>
            @endif
        </div>
        
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Categories Widget -->
            @if($categories->count() > 0)
            <div class="sidebar-widget">
                <h3>{{ theme_setting('categories_label', 'categories') }}</h3>
                <ul class="category-list">
                    @foreach($categories as $category)
                        @php
                            $count = \App\Models\BlogPost::published()->where('category', $category)->count();
                        @endphp
                        <li>
                            <a href="{{ route('blog.category', $category) }}">
                                <span><i class="fas fa-folder" style="color: var(--clay); margin-right: 0.5rem;"></i> {{ $category }}</span>
                                <span class="category-count">{{ $count }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            <!-- Tags Widget -->
            @if($allTags->count() > 0)
            <div class="sidebar-widget">
                <h3>{{ theme_setting('tags_label', 'topics') }}</h3>
                <div class="tag-cloud">
                    @foreach($allTags as $tag => $count)
                        <a href="{{ route('blog.tag', $tag) }}" style="font-size: {{ 0.8 + ($count / 10) }}rem;">
                            {{ $tag }}
                        </a>
                    @endforeach
                </div>
            </div>
            @endif
            
            <!-- About Widget -->
            <div class="sidebar-widget">
                <h3>{{ theme_setting('about_blog_label', 'about this space') }}</h3>
                <p style="color: #5a5f4b; line-height: 1.8;">
                    {{ theme_setting('blog_about_text', 'Here I write about the intersection of technology and tradition, code and community, and the slow craft of building things that matter.') }}
                </p>
            </div>
            
            <!-- Newsletter Widget -->
            <div class="sidebar-widget">
                <h3>{{ theme_setting('newsletter_label', 'plant a seed') }}</h3>
                <p style="color: #5a5f4b; margin-bottom: 1rem;">{{ theme_setting('newsletter_text', 'Get notified when new stories grow.') }}</p>
                <form action="{{ route('newsletter') }}" method="POST" style="display: flex; gap: 0.5rem;">
                    @csrf
                    <input type="email" name="email" placeholder="your email" required
                           style="flex: 1; padding: 0.8rem; border: 1px solid var(--clay-light); border-radius: 30px 8px 30px 8px; background: white;">
                    <button type="submit" style="background: var(--clay); color: white; border: none; padding: 0 1.5rem; border-radius: 30px 8px 30px 8px; cursor: pointer;">
                        <i class="fas fa-seedling"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection