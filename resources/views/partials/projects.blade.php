@php
    $featuredProjects = \App\Models\Project::where('is_featured', true)
        ->where('is_published', true)
        ->orderBy('sort_order')
        ->limit(6)
        ->get();
@endphp

<style>
    .projects-section {
        margin: clamp(3rem, 8vw, 5rem) 0;
        width: 100%;
    }

    .projects-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(min(280px, 100%), 1fr));
        gap: clamp(1.5rem, 4vw, 2rem);
        margin-top: clamp(2rem, 5vw, 3rem);
    }

    .project-card {
        background: rgba(255, 247, 240, 0.7);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(193, 123, 92, 0.25);
        border-radius: 50px 20px 50px 20px;
        padding: clamp(1.2rem, 3vw, 1.5rem);
        transition: all 0.35s;
        box-shadow: var(--shadow-warm);
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .project-card:hover {
        background: white;
        border-radius: 30px 60px 30px 60px;
        border-color: var(--clay);
        transform: translateY(-8px) rotate(0.3deg);
    }

    .project-image-container {
        height: clamp(160px, 25vw, 200px);
        margin-bottom: clamp(1rem, 2.5vw, 1.5rem);
        border-radius: 20px 5px 20px 5px;
        overflow: hidden;
        background: linear-gradient(135deg, rgba(193, 123, 92, 0.1), rgba(76, 107, 74, 0.1));
        position: relative;
    }

    .project-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .project-card:hover .project-image {
        transform: scale(1.05);
    }

    .project-image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(145deg, var(--clay-light), var(--clay));
        color: white;
        font-size: clamp(2rem, 6vw, 3rem);
    }

    .project-featured-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: var(--clay);
        color: white;
        padding: 0.2rem 1rem;
        border-radius: 30px 8px 30px 8px;
        font-size: 0.7rem;
        font-weight: 600;
        z-index: 2;
    }

    .project-title {
        font-family: 'Playfair Display', serif;
        font-size: clamp(1.2rem, 3vw, 1.5rem);
        color: var(--moss-deep);
        margin-bottom: 0.8rem;
        line-height: 1.3;
        word-wrap: break-word;
    }

    .project-description {
        color: #5a5f4b;
        margin-bottom: 1rem;
        line-height: 1.6;
        font-size: clamp(0.9rem, 2.2vw, 0.95rem);
        flex: 1;
        word-wrap: break-word;
    }

    .project-tech {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .tech-tag {
        background: var(--ash);
        padding: 0.3rem 1rem;
        border-radius: 30px 8px 30px 8px;
        font-size: 0.7rem;
        font-weight: 600;
        color: var(--moss-deep);
        border: 1px solid var(--clay-light);
        transition: all 0.3s;
    }

    .tech-tag:hover {
        background: var(--clay);
        color: white;
        border-color: var(--clay);
    }

    .project-link {
        font-weight: 700;
        color: var(--clay);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
        font-size: clamp(0.9rem, 2.2vw, 0.95rem);
    }

    .project-link:hover {
        color: var(--moss);
        gap: 10px;
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
        .projects-grid {
            grid-template-columns: repeat(auto-fit, minmax(min(250px, 100%), 1fr));
        }
    }

    @media (max-width: 480px) {
        .projects-grid {
            grid-template-columns: 1fr;
        }

        .project-card {
            padding: 1rem;
        }

        .btn-outline {
            width: 100%;
            justify-content: center;
        }
    }
</style>

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
                    <img src="{{ $projectImage }}" alt="{{ $project->title }}" class="project-image" loading="lazy">
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
<div class="text-center">
    <a href="{{ route('projects.index') }}" class="btn-outline">
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