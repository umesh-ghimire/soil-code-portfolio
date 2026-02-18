@extends('layouts.app')

@section('title', theme_setting('about_page_title', 'About Umesh Ghimire · माटोको मान्छे'))
@section('description', theme_setting('about_meta_description', 'Born in a Dhankuta village without internet, I taught myself to code on a used laptop. Now I build resilient systems for communities like mine.'))

@section('content')
<div class="container">
    <div class="page-header" style="padding: 3rem 0 2rem; text-align: center;">
        <h1 style="font-size: 4rem; font-weight: 800; color: var(--moss-deep); margin-bottom: 1rem;">
            {{ theme_setting('about_page_title', 'about माटोको मान्छे') }}
        </h1>
        <p style="font-size: 1.3rem; color: #5a5f4b; max-width: 700px; margin: 0 auto; border-left: 4px solid var(--clay); padding-left: 1.6rem;">
            {{ theme_setting('about_subtitle', 'A maker, mentor, and mountain dweller who believes in slow technology.') }}
        </p>
    </div>
    
    @include('partials.about')
    
    <!-- Resume CTA -->
    @php $profile = \App\Models\Profile::first(); @endphp
    @if($profile && $profile->resume_file)
    <div style="text-align: center; margin: 4rem 0;">
        <a href="{{ asset('storage/' . $profile->resume_file) }}" target="_blank" class="btn btn-clay">
            <i class="fas fa-file-pdf"></i> {{ theme_setting('resume_button_text', 'download resume') }}
        </a>
    </div>
    @endif
</div>
@endsection