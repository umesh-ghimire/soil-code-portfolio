@extends('layouts.app')

@section('title', theme_setting('cookie_title', 'Cookie Policy · Umesh Ghimire'))
@section('description', 'How I use tiny digital seeds (cookies) to improve your visit.')

@push('styles')
<style>
    /* Same styles as privacy page - reuse */
    .legal-hero {
        padding: 3rem 0 1rem;
        text-align: center;
    }
    
    .legal-hero h1 {
        font-size: 4rem;
        font-weight: 800;
        color: var(--moss-deep);
        margin-bottom: 1rem;
        font-family: 'Playfair Display', serif;
        letter-spacing: -0.02em;
        position: relative;
        display: inline-block;
    }
    
    .legal-hero h1::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 100px;
        height: 4px;
        background: repeating-linear-gradient(45deg, var(--clay), var(--clay) 8px, transparent 8px, transparent 16px);
    }
    
    .legal-hero p {
        font-size: 1.3rem;
        color: #5a6b5a;
        max-width: 700px;
        margin: 2rem auto 0;
        font-style: italic;
        border-left: 4px solid var(--clay);
        padding-left: 1.6rem;
    }
    
    .legal-container {
        max-width: 900px;
        margin: 3rem auto 5rem;
        padding: 0 20px;
        position: relative;
    }
    
    .legal-card {
        background: rgba(255, 247, 240, 0.6);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 100px 20px 100px 20px;
        padding: 3.5rem;
        border: 1px solid rgba(193, 123, 92, 0.3);
        box-shadow: var(--shadow-warm);
        position: relative;
        overflow: hidden;
    }
    
    .legal-card::before {
        content: '';
        position: absolute;
        top: -80px;
        right: -80px;
        width: 250px;
        height: 250px;
        background: radial-gradient(circle, rgba(193, 123, 92, 0.1) 0%, transparent 70%);
        border-radius: 50%;
        animation: float 20s infinite alternate;
    }
    
    .legal-card::after {
        content: '';
        position: absolute;
        bottom: -80px;
        left: -80px;
        width: 250px;
        height: 250px;
        background: radial-gradient(circle, rgba(76, 107, 74, 0.1) 0%, transparent 70%);
        border-radius: 50%;
        animation: float 25s infinite alternate-reverse;
    }
    
    .legal-date {
        display: inline-block;
        background: rgba(193, 123, 92, 0.1);
        color: var(--clay);
        padding: 0.5rem 1.5rem;
        border-radius: 40px 12px 40px 12px;
        font-size: 0.95rem;
        font-weight: 600;
        margin-bottom: 2rem;
        border: 1px solid rgba(193, 123, 92, 0.3);
        position: relative;
        z-index: 2;
    }
    
    .legal-content {
        color: #3f4d45;
        line-height: 1.9;
        font-size: 1.05rem;
        position: relative;
        z-index: 2;
    }
    
    .legal-content h2 {
        font-size: 2rem;
        font-weight: 700;
        color: var(--moss-deep);
        margin: 2.5rem 0 1.2rem;
        font-family: 'Playfair Display', serif;
        position: relative;
        display: inline-block;
    }
    
    .legal-content h2::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 60px;
        height: 3px;
        background: repeating-linear-gradient(45deg, var(--clay), var(--clay) 6px, transparent 6px, transparent 12px);
    }
    
    .legal-content p {
        margin-bottom: 1.5rem;
        color: #4a5a4a;
    }
    
    .legal-content ul, 
    .legal-content ol {
        margin: 1.5rem 0 2rem 2rem;
    }
    
    .legal-content li {
        margin-bottom: 0.8rem;
        position: relative;
        list-style-type: none;
        padding-left: 1.8rem;
    }
    
    .legal-content li::before {
        content: '🍪';
        position: absolute;
        left: 0;
        top: 0;
        color: var(--clay);
        font-size: 1rem;
    }
    
    .cookie-table {
        background: white;
        border-radius: 40px 12px 40px 12px;
        padding: 1.5rem;
        margin: 2rem 0;
        border: 1px solid var(--clay-light);
        overflow-x: auto;
    }
    
    .cookie-table table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .cookie-table th {
        text-align: left;
        padding: 1rem;
        background: rgba(193, 123, 92, 0.1);
        color: var(--moss-deep);
        font-weight: 600;
        border-radius: 20px 5px 20px 5px;
    }
    
    .cookie-table td {
        padding: 1rem;
        border-bottom: 1px dashed var(--clay-light);
    }
    
    .cookie-table tr:last-child td {
        border-bottom: none;
    }
    
    .legal-divider {
        width: 100%;
        height: 2px;
        background: repeating-linear-gradient(45deg, var(--clay-light), var(--clay-light) 8px, transparent 8px, transparent 16px);
        margin: 2.5rem 0;
        opacity: 0.4;
    }
    
    .legal-footer {
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 1px dashed var(--clay-light);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
        position: relative;
        z-index: 2;
    }
    
    .legal-footer .btn {
        background: transparent;
        color: var(--clay);
        border: 2px solid var(--clay);
        padding: 0.8rem 2rem;
        border-radius: 40px 12px 40px 12px;
        font-weight: 600;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .legal-footer .btn:hover {
        background: var(--clay);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px -8px var(--clay);
    }
    
   
</style>
@endpush

@section('content')
<div class="container">
    <div class="legal-hero">
        <h1>{{ theme_setting('cookie_title', 'Cookie Policy') }}</h1>
        <p>{{ theme_setting('cookie_subtitle', 'How I use tiny digital seeds (cookies) to improve your visit.') }}</p>
    </div>
    
    <div class="legal-container">
        <div class="legal-card">
            <div class="legal-date">
                <i class="fas fa-calendar-alt" style="margin-right: 0.5rem;"></i>
                {{ theme_setting('cookie_date', 'Last updated: ' . date('F j, Y')) }}
            </div>
            
            <div class="legal-content">
                <p>Just as a seed carries information for next season's growth, cookies carry small bits of data to improve your experience in this garden.</p>
                
                <h2>🍪 What Are Cookies?</h2>
                <p>Cookies are tiny text files stored on your device when you visit a website. Like a marker in a garden, they help remember your path and preferences for your next visit.</p>
                
                <div class="legal-divider"></div>
                
                <h2>🌱 How I Use Cookies</h2>
                <p>I use cookies sparingly and respectfully, only to:</p>
                <ul>
                    <li><strong>Essential functions:</strong> Keeping you logged in (if you have an account) and maintaining security</li>
                    <li><strong>Analytics:</strong> Understanding which paths visitors take through the garden, so I can tend it better</li>
                    <li><strong>Preferences:</strong> Remembering your settings (like theme preferences)</li>
                </ul>
                
                <div class="cookie-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Cookie Type</th>
                                <th>Purpose</th>
                                <th>Duration</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Session Cookie</strong></td>
                                <td>Keeps you logged in during your visit</td>
                                <td>Until you close your browser</td>
                            </tr>
                            <tr>
                                <td><strong>Analytics Cookie</strong></td>
                                <td>Anonymous visitor statistics</td>
                                <td>Up to 2 years</td>
                            </tr>
                            <tr>
                                <td><strong>Preference Cookie</strong></td>
                                <td>Remembers your settings</td>
                                <td>1 year</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="legal-divider"></div>
                
                <h2>🌿 Third-Party Cookies</h2>
                <p>I occasionally use trusted services that may set their own cookies:</p>
                <ul>
                    <li><strong>Font Awesome:</strong> For icons (privacy policy: <a href="https://fontawesome.com/privacy" target="_blank">fontawesome.com/privacy</a>)</li>
                    <li><strong>Google Fonts:</strong> For typography (privacy policy: <a href="https://policies.google.com/privacy" target="_blank">policies.google.com/privacy</a>)</li>
                </ul>
                <p>These services help make the garden beautiful and functional, but I choose them carefully for their privacy practices.</p>
                
                <div class="legal-divider"></div>
                
                <h2>🌳 Managing Cookies</h2>
                <p>You have control over which seeds are planted. Most browsers allow you to:</p>
                <ul>
                    <li>View what cookies are stored</li>
                    <li>Delete individual or all cookies</li>
                    <li>Block cookies from specific sites</li>
                    <li>Block all cookies (though this may affect functionality)</li>
                </ul>
                <p>Check your browser's help section for instructions:</p>
                <ul>
                    <li><a href="#" onclick="return false;">Chrome: Settings → Privacy and Security → Cookies</a></li>
                    <li><a href="#" onclick="return false;">Firefox: Options → Privacy & Security → Cookies</a></li>
                    <li><a href="#" onclick="return false;">Safari: Preferences → Privacy → Cookies</a></li>
                </ul>
                
                <div class="legal-divider"></div>
                
                <h2>🌾 Your Consent</h2>
                <p>By continuing to explore this garden, you consent to the use of cookies as described. If you'd prefer not to be tracked, you can adjust your browser settings or limit your visit to essential pages.</p>
                
                <div class="legal-divider"></div>
                
                <h2>🌻 Updates to This Policy</h2>
                <p>If my cookie practices change, I'll update this page. The "last updated" date will always show when I last tended this policy.</p>
            </div>
            
            <div class="legal-footer">
                <div>
                    <i class="fas fa-cookie-bite" style="color: var(--clay);"></i>
                    <span style="color: #5a6b5a; margin-left: 0.5rem;">Tended with care</span>
                </div>
                <a href="{{ route('home') }}" class="btn">
                    <i class="fas fa-home"></i> Return to Garden
                </a>
            </div>
        </div>
    </div>
</div>
@endsection