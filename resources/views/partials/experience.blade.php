@php
    $experiences = \App\Models\Experience::where('is_published', true)
        ->orderBy('start_date', 'desc')
        ->limit(3)
        ->get();
@endphp

<style>
    .experience-section {
        margin: clamp(3rem, 8vw, 5rem) 0;
        width: 100%;
    }

    .timeline {
        display: flex;
        flex-direction: column;
        gap: clamp(1.5rem, 4vw, 2rem);
        margin-top: clamp(2rem, 5vw, 3rem);
    }

    .timeline-item {
        position: relative;
        padding: clamp(1.2rem, 3vw, 1.5rem);
        background: rgba(255, 247, 240, 0.5);
        border-radius: 60px 20px 60px 20px;
        border: 1px solid rgba(193, 123, 92, 0.2);
        transition: all 0.3s;
        margin-left: 20px;
    }

    .timeline-item:hover {
        background: white;
        border-color: var(--clay);
        transform: translateX(10px);
        box-shadow: var(--shadow-warm);
    }

    .timeline-dot {
        position: absolute;
        left: -24px;
        top: 50%;
        transform: translateY(-50%);
        width: 20px;
        height: 20px;
        background: var(--clay);
        border-radius: 50%;
        border: 4px solid var(--rice);
        box-shadow: 0 0 0 2px var(--clay-light);
    }

    .timeline-date {
        display: inline-block;
        background: var(--clay-light);
        color: var(--moss-deep);
        padding: 0.2rem 1.2rem;
        border-radius: 30px 8px 30px 8px;
        font-size: clamp(0.8rem, 2vw, 0.9rem);
        font-weight: 600;
        margin-bottom: 0.8rem;
    }

    .timeline-title {
        font-size: clamp(1.2rem, 3vw, 1.4rem);
        font-weight: 700;
        color: var(--moss-deep);
        margin-bottom: 0.3rem;
        line-height: 1.3;
        word-wrap: break-word;
    }

    .timeline-subtitle {
        font-size: clamp(0.95rem, 2.2vw, 1rem);
        color: var(--clay);
        margin-bottom: 0.8rem;
        font-weight: 600;
        word-wrap: break-word;
    }

    .timeline-item p {
        color: #5a5f4b;
        line-height: 1.6;
        font-size: clamp(0.9rem, 2.2vw, 0.95rem);
        margin-bottom: 1rem;
        word-wrap: break-word;
    }

    .duration-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--ash);
        padding: 0.3rem 1rem;
        border-radius: 30px 8px 30px 8px;
        font-size: 0.8rem;
        color: var(--moss-deep);
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
        .timeline-item {
            margin-left: 15px;
        }

        .timeline-dot {
            left: -19px;
            width: 18px;
            height: 18px;
        }
    }

    @media (max-width: 480px) {
        .timeline-item {
            padding: 1rem;
        }

        .timeline-dot {
            left: -16px;
            width: 16px;
            height: 16px;
            border-width: 3px;
        }

        .btn-outline {
            width: 100%;
            justify-content: center;
        }
    }
</style>

@if($experiences->count() > 0)
<div class="timeline">
    @foreach($experiences as $experience)
        @php
            $startDate = \Carbon\Carbon::parse($experience->start_date);
            $endDate = $experience->is_current ? null : ($experience->end_date ? \Carbon\Carbon::parse($experience->end_date) : null);
            
            $startYear = $startDate->format('Y');
            $endYear = $experience->is_current ? 'present' : ($endDate ? $endDate->format('Y') : 'present');
            
            $duration = '';
            $end = $experience->is_current ? now() : ($endDate ?? now());
            $months = $startDate->diffInMonths($end);
            $years = floor($months / 12);
            $remMonths = $months % 12;
            
            if ($years > 0) {
                $duration .= $years . ' ' . ($years > 1 ? 'years' : 'year');
            }
            if ($remMonths > 0) {
                if ($years > 0) $duration .= ' ';
                $duration .= $remMonths . ' ' . ($remMonths > 1 ? 'months' : 'month');
            }
        @endphp
        <div class="timeline-item">
            <div class="timeline-dot"></div>
            <div class="timeline-date">{{ $startYear }} — {{ $endYear }}</div>
            <h3 class="timeline-title">{{ $experience->title }}</h3>
            <div class="timeline-subtitle">{{ $experience->company }} · {{ $experience->location ?? 'Remote' }}</div>
            <p>{{ Str::limit(strip_tags($experience->description), 120) }}</p>
            <div class="duration-badge">
                <i class="fas fa-clock"></i> {{ $duration }}
            </div>
        </div>
    @endforeach
</div>

@if(\App\Models\Experience::where('is_published', true)->count() > 3)
<div class="text-center">
    <a href="{{ route('experience') }}" class="btn-outline">
        <i class="fas fa-tree"></i> {{ theme_setting('view_all_experience_text', 'view full journey') }}
    </a>
</div>
@endif
@else
<div class="empty-state">
    <i class="fas fa-tree"></i>
    <p>{{ theme_setting('no_experience_text', 'Seasons of experience coming soon.') }}</p>
</div>
@endif