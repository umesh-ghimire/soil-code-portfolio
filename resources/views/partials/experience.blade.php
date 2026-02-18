@php
    $experiences = \App\Models\Experience::where('is_published', true)
        ->orderBy('start_date', 'desc')
        ->limit(3)
        ->get();
@endphp

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
<div class="text-center mt-4">
    <a href="{{ route('experience') }}" class="btn btn-outline">
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