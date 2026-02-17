<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of blog posts
     */
    public function index()
    {
        $posts = BlogPost::published()
            ->orderBy('published_at', 'desc')
            ->paginate(6);
        
        $featuredPost = BlogPost::featured()
            ->published()
            ->latest('published_at')
            ->first();
        
        $categories = BlogPost::published()
            ->select('category')
            ->distinct()
            ->get()
            ->pluck('category')
            ->filter();
        
        $popularTags = BlogPost::published()
            ->get()
            ->flatMap(function ($post) {
                return $post->tags ?? [];
            })
            ->countBy()
            ->sortDesc()
            ->take(10)
            ->keys();
        
        return view('blog.index', compact('posts', 'featuredPost', 'categories', 'popularTags'));
    }

    /**
     * Display the specified blog post
     */
    public function show($slug)
    {
        $post = BlogPost::where('slug', $slug)
            ->published()
            ->firstOrFail();
        
        $post->incrementViews();
        
        $relatedPosts = BlogPost::published()
            ->where('id', '!=', $post->id)
            ->where(function ($query) use ($post) {
                $tags = $post->tags;
                if ($tags) {
                    foreach ($tags as $tag) {
                        $query->orWhereJsonContains('tags', $tag);
                    }
                }
                if ($post->category) {
                    $query->orWhere('category', $post->category);
                }
            })
            ->limit(3)
            ->get();
        
        $prevPost = BlogPost::published()
            ->where('published_at', '<', $post->published_at)
            ->latest('published_at')
            ->first();
        
        $nextPost = BlogPost::published()
            ->where('published_at', '>', $post->published_at)
            ->oldest('published_at')
            ->first();
        
        return view('blog.show', compact('post', 'relatedPosts', 'prevPost', 'nextPost'));
    }

    /**
     * Display posts by category
     */
    public function category($category)
    {
        $posts = BlogPost::published()
            ->where('category', $category)
            ->orderBy('published_at', 'desc')
            ->paginate(6);
        
        return view('blog.index', compact('posts', 'category'));
    }

    /**
     * Display posts by tag
     */
    public function tag($tag)
    {
        $posts = BlogPost::published()
            ->whereJsonContains('tags', $tag)
            ->orderBy('published_at', 'desc')
            ->paginate(6);
        
        return view('blog.index', compact('posts', 'tag'));
    }
}