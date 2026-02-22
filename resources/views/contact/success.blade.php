@extends('layouts.app')

@section('title', theme_setting('success_title', 'seed planted · Umesh Ghimire'))

@push('styles')
<style>
    .success-container {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 4rem 0;
    }
    
    .success-card {
        background: white;
        border-radius: 100px 20px 100px 20px;
        padding: 4rem 3rem;
        border: 1px solid var(--clay-light);
        box-shadow: var(--shadow-warm);
        max-width: 700px;
        margin: 0 auto;
        text-align: center;
    }
    
    .success-icon {
        width: 120px;
        height: 120px;
        background: var(--moss);
        border-radius: 50% 40% 50% 40%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 2rem;
        animation: liquidMorph 8s infinite alternate;
    }
    
    .success-icon i {
        font-size: 4rem;
        color: white;
    }
    
    .success-card h1 {
        font-size: 3rem;
        font-weight: 800;
        color: var(--moss-deep);
        margin-bottom: 1rem;
    }
    
    .success-message {
        font-size: 1.3rem;
        color: #5a5f4b;
        margin-bottom: 2rem;
        line-height: 1.6;
    }
    
    .seed-details {
        background: rgba(227, 219, 207, 0.3);
        border-radius: 60px 20px 60px 20px;
        padding: 2rem;
        margin: 2rem 0;
        border: 1px solid var(--clay-light);
    }
    
    .reply-commitment {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        margin: 2rem 0;
        padding: 1rem;
        background: var(--ash);
        border-radius: 40px 12px 40px 12px;
    }
    
    .action-buttons {
        display: flex;
        gap: 1.5rem;
        justify-content: center;
        margin-top: 2.5rem;
    }
    
    
</style>
@endpush

@section('content')
@php
    $successTitle = theme_setting('success_title', 'seed planted');
    $successMessage = theme_setting('success_message', 'Your message has been tucked into the soil. I\'ll read it with care.');
    $quote = theme_setting('success_quote', 'The best time to plant a tree was 20 years ago. The second best time is now.');
    $quoteAttribution = theme_setting('success_quote_attribution', '— your message is now a seed');
    $commitment = theme_setting('response_commitment', '🌙 one moon cycle guarantee');
    $commitmentDetail = theme_setting('response_detail', 'I read every message with care and will reply within a moon cycle.');
@endphp

<div class="container success-container">
    <div class="success-card">
        <div class="success-icon">
            <i class="fas fa-seedling"></i>
        </div>
        
        <h1>{{ $successTitle }}</h1>
        <p class="success-message">
            {{ $successMessage }}
        </p>
        
        <div class="seed-details">
            <i class="fas fa-leaf" style="color: var(--clay); font-size: 1.5rem; margin-bottom: 1rem;"></i>
            <p style="font-style: italic; color: var(--moss-deep);">
                "{{ $quote }}"
            </p>
            <p style="margin-top: 1rem; font-size: 0.9rem; color: #5a5f4b;">{{ $quoteAttribution }}</p>
        </div>
        
        <div class="reply-commitment">
            <i class="fas fa-moon" style="color: var(--clay); font-size: 1.8rem;"></i>
            <div style="text-align: left;">
                <strong style="color: var(--moss-deep);">{{ $commitment }}</strong>
                <p style="font-size: 0.9rem; color: #5a5f4b;">{{ $commitmentDetail }}</p>
            </div>
        </div>
        
        <div class="action-buttons">
            <a href="{{ route('home') }}" class="btn btn-moss">
                <i class="fas fa-home"></i> {{ theme_setting('home_button_text', 'return home') }}
            </a>
            <a href="{{ route('projects.index') }}" class="btn btn-outline">
                <i class="fas fa-tree"></i> {{ theme_setting('projects_button_text', 'see projects') }}
            </a>
        </div>
    </div>
</div>
@endsection