@extends('layouts.app')

@section('title', theme_setting('terms_title', 'Terms of Service · Umesh Ghimire'))

@section('content')
<div class="container legal-container">
    <div class="legal-card">
        <h1>{{ theme_setting('terms_title', 'Terms of Service') }}</h1>
        <p class="legal-date">{{ theme_setting('terms_date', 'Last updated: ' . date('F j, Y')) }}</p>
        
        <div class="legal-content">
            {!! theme_setting('terms_content', '
            <h2>Acceptance of Terms</h2>
            <p>By accessing and using this website, you accept and agree to be bound by the terms and provision of this agreement.</p>
            
            <h2>Use License</h2>
            <p>Permission is granted to temporarily view the materials on this website for personal, non-commercial use only. This is the grant of a license, not a transfer of title.</p>
            
            <h2>Disclaimer</h2>
            <p>The materials on this website are provided on an "as is" basis. We make no warranties, expressed or implied, and hereby disclaim and negate all other warranties including, without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights.</p>
            
            <h2>Limitations</h2>
            <p>In no event shall we be liable for any damages arising out of the use or inability to use the materials on this website.</p>
            
            <h2>Governing Law</h2>
            <p>These terms and conditions are governed by and construed in accordance with the laws of Nepal and you irrevocably submit to the exclusive jurisdiction of the courts in that location.</p>
            ') !!}
        </div>
    </div>
</div>
@endsection