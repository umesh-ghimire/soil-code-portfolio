@extends('layouts.app')

@section('title', theme_setting('disclaimer_title', 'Disclaimer · Umesh Ghimire'))

@section('content')
<div class="container legal-container">
    <div class="legal-card">
        <h1>{{ theme_setting('disclaimer_title', 'Disclaimer') }}</h1>
        <p class="legal-date">{{ theme_setting('disclaimer_date', 'Last updated: ' . date('F j, Y')) }}</p>
        
        <div class="legal-content">
            {!! theme_setting('disclaimer_content', '
            <h2>General Information</h2>
            <p>The information provided on this website is for general informational purposes only. All information is provided in good faith, however we make no representation or warranty of any kind, express or implied, regarding the accuracy, adequacy, validity, reliability, availability, or completeness of any information on the site.</p>
            
            <h2>Professional Disclaimer</h2>
            <p>This website contains general information about my work and experience. It is not intended to be professional advice. You should not rely on this information as a substitute for professional advice from a qualified professional.</p>
            
            <h2>External Links Disclaimer</h2>
            <p>This website may contain links to external websites that are not provided or maintained by or in any way affiliated with us. Please note that we do not guarantee the accuracy, relevance, timeliness, or completeness of any information on these external websites.</p>
            
            <h2>Testimonials Disclaimer</h2>
            <p>Testimonials appearing on this site are received via text, audio, or video submission. They are individual experiences, reflecting real-life experiences of those who have used our services. However, they are individual results and results may vary.</p>
            
            <h2>Errors and Omissions Disclaimer</h2>
            <p>While we have made every attempt to ensure that the information contained in this site has been obtained from reliable sources, we are not responsible for any errors or omissions or for the results obtained from the use of this information.</p>
            
            <h2>Fair Use Disclaimer</h2>
            <p>This site may contain copyrighted material the use of which has not always been specifically authorized by the copyright owner. We are making such material available for criticism, comment, news reporting, teaching, scholarship, or research.</p>
            ') !!}
        </div>
    </div>
</div>
@endsection