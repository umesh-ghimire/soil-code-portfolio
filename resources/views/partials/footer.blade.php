<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-copyright">
                &copy; {{ date('Y') }} — crafted with soil & code 🌱
            </div>
            
            <div class="footer-social">
                @if(isset($profile) && $profile && isset($profile->social_links))
                    @php
                        $socialLinks = is_string($profile->social_links) 
                            ? json_decode($profile->social_links, true) 
                            : $profile->social_links;
                    @endphp
                    
                    @if(is_array($socialLinks))
                        @foreach($socialLinks as $platform => $url)
                            @if(is_string($platform) && is_string($url) && filter_var($url, FILTER_VALIDATE_URL))
                                <a href="{{ $url }}" target="_blank" rel="noopener noreferrer">
                                    {{ $platform }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>
</footer>