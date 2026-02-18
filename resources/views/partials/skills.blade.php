@php
    $featuredSkills = \App\Models\Skill::where('is_featured', true)
        ->where('is_published', true)
        ->orderBy('sort_order')
        ->limit(8)
        ->get();
        
    $skillsCount = \App\Models\Skill::where('is_published', true)->count();
@endphp

@if($featuredSkills->count() > 0)
<div class="skills-grid">
    @foreach($featuredSkills as $skill)
        <div class="skill-item">
            <div class="skill-icon">
                @if($skill->icon)
                    <i class="{{ $skill->icon }}"></i>
                @else
                    <i class="fas fa-code"></i>
                @endif
            </div>
            <h3 class="skill-name">{{ $skill->name }}</h3>
            @if($skill->proficiency)
            <div class="skill-progress">
                <div class="skill-progress-bar" style="width: {{ $skill->proficiency }}%"></div>
            </div>
            @endif
        </div>
    @endforeach
</div>

@if($skillsCount > $featuredSkills->count())
<div class="text-center mt-4">
    <a href="{{ route('skills') }}" class="btn btn-outline">
        <i class="fas fa-trowel"></i> {{ theme_setting('more_skills_text', 'more organic tools') }}
    </a>
</div>
@endif
@else
<div class="empty-state">
    <i class="fas fa-tools"></i>
    <p>{{ theme_setting('no_skills_text', 'Tools are being sharpened. Check back soon!') }}</p>
</div>
@endif