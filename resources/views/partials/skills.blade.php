@php
    $featuredSkills = \App\Models\Skill::where('is_featured', true)
        ->where('is_published', true)
        ->orderBy('sort_order')
        ->limit(8)
        ->get();
        
    $skillsCount = \App\Models\Skill::where('is_published', true)->count();
@endphp

<style>
    .skills-section {
        margin: clamp(3rem, 8vw, 5rem) 0;
        width: 100%;
    }

    .skills-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(min(140px, 100%), 1fr));
        gap: clamp(1rem, 3vw, 1.5rem);
        margin-top: clamp(2rem, 5vw, 3rem);
    }

    .skill-item {
        text-align: center;
        padding: clamp(1rem, 3vw, 1.5rem);
        background: rgba(255, 247, 240, 0.5);
        border: 1px solid rgba(227, 219, 207, 0.3);
        border-radius: 20px 5px 20px 5px;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .skill-item:hover {
        background: rgba(193, 123, 92, 0.05);
        transform: translateY(-5px);
        border-color: var(--clay-light);
        box-shadow: var(--shadow-warm);
    }

    .skill-icon {
        font-size: clamp(2rem, 5vw, 2.5rem);
        margin-bottom: clamp(0.8rem, 2vw, 1rem);
        color: var(--clay);
        transition: transform 0.3s ease;
    }

    .skill-item:hover .skill-icon {
        transform: scale(1.1);
    }

    .skill-name {
        font-weight: 600;
        color: var(--moss-deep);
        margin-bottom: clamp(0.5rem, 1.5vw, 0.8rem);
        font-size: clamp(0.9rem, 2.2vw, 1rem);
        word-wrap: break-word;
        width: 100%;
    }

    .skill-progress {
        width: 100%;
        height: 6px;
        background: var(--ash);
        border-radius: 3px;
        overflow: hidden;
        margin-top: auto;
    }

    .skill-progress-bar {
        height: 100%;
        background: var(--moss);
        border-radius: 3px;
        transition: width 1s ease;
    }

    .skill-item:hover .skill-progress-bar {
        background: var(--clay);
    }

    .text-center {
        text-align: center;
        margin-top: clamp(2rem, 5vw, 3rem);
    }

    .btn-outline {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: transparent;
        color: var(--moss-deep);
        border: 2px solid var(--clay);
        padding: clamp(0.8rem, 2vw, 1rem) clamp(1.5rem, 4vw, 2rem);
        border-radius: 40px 12px 40px 12px;
        font-weight: 600;
        font-size: clamp(0.9rem, 2.2vw, 1rem);
        text-decoration: none;
        transition: all 0.3s;
    }

    .btn-outline:hover {
        background: var(--clay-light);
        transform: translateY(-3px);
    }

    .empty-state {
        text-align: center;
        padding: clamp(3rem, 8vw, 5rem) 0;
        background: rgba(255, 247, 240, 0.5);
        border-radius: 60px 20px 60px 20px;
    }

    .empty-state i {
        font-size: clamp(3rem, 8vw, 4rem);
        color: var(--clay);
        margin-bottom: 1rem;
    }

    @media (max-width: 768px) {
        .skills-grid {
            grid-template-columns: repeat(auto-fit, minmax(min(120px, 100%), 1fr));
        }
    }

    @media (max-width: 480px) {
        .skills-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .btn-outline {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 360px) {
        .skills-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

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
<div class="text-center">
    <a href="{{ route('skills') }}" class="btn-outline">
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