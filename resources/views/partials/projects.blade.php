@php
    $featuredProjects = \App\Models\Project::where('is_featured', true)
        ->where('is_published', true)
        ->orderBy('sort_order')
        ->limit(6)
        ->get();
@endphp

@if($featuredProjects->count() > 0)
<div class="projects-grid">
    @foreach($featuredProjects as $index => $project)
        @php
            $techs = [];
            if ($project->technologies) {
                if (is_string($project->technologies)) {
                    $techs = array_map('trim', explode(',', $project->technologies));
                } elseif (is_array($project->technologies)) {
                    $techs = $project->technologies;
                }
            }
            
            $projectImage = null;
            if ($project->featured_image) {
                $projectImage = asset('storage/' . $project->featured_image);
            }
        @endphp
        <div class="project-card" style="animation-delay: {{ $index * 0.1 }}s;">
            <div class="project-image-container">
                @if($projectImage)
                    <img src="{{ $projectImage }}" alt="{{ $project->title }}" class="project-image">
                @else
                    <div class="project-image-placeholder">
                        <i class="fas fa-code-branch"></i>
                    </div>
                @endif
                @if($project->is_featured)
                    <span class="project-featured-badge">
                        <i class="fas fa-star"></i> featured
                    </span>
                @endif
            </div>
            
            <div class="project-content">
                <h3 class="project-title">{{ $project->title }}</h3>
                <p class="project-description">{{ Str::limit($project->description, 100) }}</p>
                
                @if(count($techs) > 0)
                <div class="project-tech">
                    @foreach(array_slice($techs, 0, 3) as $tech)
                        <span class="tech-tag">{{ $tech }}</span>
                    @endforeach
                    @if(count($techs) > 3)
                        <span class="tech-tag">+{{ count($techs) - 3 }}</span>
                    @endif
                </div>
                @endif
                
                <a href="{{ route('projects.show', $project->slug) }}" class="project-link">
                    <span>{{ theme_setting('project_link_text', 'read case study') }}</span>
                    <span class="project-link-arrow">→</span>
                </a>
            </div>
        </div>
    @endforeach
</div>

@if(\App\Models\Project::where('is_published', true)->count() > $featuredProjects->count())
<div class="text-center mt-5">
    <a href="{{ route('projects.index') }}" class="btn btn-outline">
        <i class="fas fa-asterisk"></i> {{ theme_setting('view_all_projects_text', 'view all projects') }}
    </a>
</div>
@endif
@else
<div class="empty-state">
    <i class="fas fa-seedling"></i>
    <p>{{ theme_setting('no_projects_text', 'Projects are being cultivated. Check back soon!') }}</p>
</div>
@endif