@php
    $profile = \App\Models\Profile::first();
    $email = $profile->email ?? theme_setting('email', '');
    $phone = $profile->phone ?? theme_setting('phone', null);
    $location = $profile->location ?? theme_setting('location', 'Lalitpur, Nepal');
@endphp

<div class="contact-container">
    <div class="contact-header">
        <h2>{{ theme_setting('contact_section_title', "let's grow together") }}</h2>
        <p>{{ theme_setting('contact_subtitle', 'reach out, I reply within a moon cycle 🌙') }}</p>
    </div>
    
    <div class="contact-grid">
        <div class="contact-info">
            <div class="contact-methods">
                @if($email)
                <div class="contact-method">
                    <div class="contact-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div>
                        <h3>{{ theme_setting('email_label', 'email') }}</h3>
                        <a href="mailto:{{ $email }}">{{ $email }}</a>
                    </div>
                </div>
                @endif
                
                @if($phone)
                <div class="contact-method">
                    <div class="contact-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div>
                        <h3>{{ theme_setting('phone_label', 'phone') }}</h3>
                        <a href="tel:{{ $phone }}">{{ $phone }}</a>
                    </div>
                </div>
                @endif
                
                <div class="contact-method">
                    <div class="contact-icon">
                        <i class="fas fa-location-dot"></i>
                    </div>
                    <div>
                        <h3>{{ theme_setting('location_label', 'field office') }}</h3>
                        <p>{{ $location }}</p>
                    </div>
                </div>
            </div>
            
            <div class="response-commitment">
                <i class="fas fa-moon"></i>
                <div>
                    <strong>{{ theme_setting('response_commitment', '🌙 one moon cycle guarantee') }}</strong>
                    <p>{{ theme_setting('response_detail', 'I read every message with care and will reply within a moon cycle.') }}</p>
                </div>
            </div>
        </div>
        
        <div class="contact-form-container">
            <form method="POST" action="{{ route('contact.store') }}" class="contact-form">
                @csrf
                
                <div class="form-group">
                    <input type="text" name="name" placeholder="{{ theme_setting('name_placeholder', 'your name') }}" 
                           value="{{ old('name') }}" required
                           class="form-input @error('name') is-invalid @enderror">
                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <input type="email" name="email" placeholder="{{ theme_setting('email_placeholder', 'your email') }}" 
                           value="{{ old('email') }}" required
                           class="form-input @error('email') is-invalid @enderror">
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <input type="text" name="subject" placeholder="{{ theme_setting('subject_placeholder', 'what shall we grow?') }}" 
                           value="{{ old('subject') }}" required
                           class="form-input @error('subject') is-invalid @enderror">
                    @error('subject')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <textarea name="message" rows="5" placeholder="{{ theme_setting('message_placeholder', 'your message...') }}" 
                              required class="form-textarea @error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                    @error('message')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-submit">
                    <button type="submit" class="btn btn-clay">
                        <span>{{ theme_setting('submit_button_text', 'plant the seed') }}</span>
                        <span class="project-link-arrow">🌱</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>