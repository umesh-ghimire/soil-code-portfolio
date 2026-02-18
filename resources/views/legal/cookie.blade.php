@extends('layouts.app')

@section('title', theme_setting('cookie_title', 'Cookie Policy · Umesh Ghimire'))

@section('content')
<div class="container legal-container">
    <div class="legal-card">
        <h1>{{ theme_setting('cookie_title', 'Cookie Policy') }}</h1>
        <p class="legal-date">{{ theme_setting('cookie_date', 'Last updated: ' . date('F j, Y')) }}</p>
        
        <div class="legal-content">
            {!! theme_setting('cookie_content', '
            <h2>What Are Cookies</h2>
            <p>Cookies are small text files that are placed on your computer or mobile device when you visit a website. They are widely used to make websites work more efficiently and provide information to the owners of the site.</p>
            
            <h2>How We Use Cookies</h2>
            <p>We use cookies for the following purposes:</p>
            <ul>
                <li><strong>Essential cookies:</strong> These are necessary for the website to function properly.</li>
                <li><strong>Analytics cookies:</strong> These help us understand how visitors interact with our website.</li>
                <li><strong>Preference cookies:</strong> These remember your settings and preferences.</li>
            </ul>
            
            <h2>Types of Cookies We Use</h2>
            <p>We use both session cookies (which expire when you close your browser) and persistent cookies (which stay on your device until they expire or you delete them).</p>
            
            <h2>Managing Cookies</h2>
            <p>Most web browsers allow you to control cookies through their settings. You can usually find these settings in the "Options" or "Preferences" menu of your browser. Please note that disabling cookies may affect the functionality of this website.</p>
            
            <h2>Third-Party Cookies</h2>
            <p>We may also use third-party services that set their own cookies. These services include analytics providers and social media platforms.</p>
            
            <h2>Updates to This Policy</h2>
            <p>We may update this cookie policy from time to time. Any changes will be posted on this page with an updated revision date.</p>
            ') !!}
        </div>
    </div>
</div>
@endsection