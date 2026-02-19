<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profile->name ?? 'Umesh Ghimire' }} - Resume</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            line-height: 1.4;
            color: #333;
            background: white;
            padding: 15px;
            font-size: 11px;
        }
        
        .resume {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            position: relative;
        }
        
        /* Header with Photo */
        .header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #2a4230;
        }
        
        .photo-container {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid #c17b5c;
            flex-shrink: 0;
            background: #f0f0f0;
        }
        
        .photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .photo-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(145deg, #c17b5c, #eac5b0);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 36px;
            font-weight: bold;
        }
        
        .title-section {
            flex: 1;
        }
        
        .name {
            font-size: 28px;
            font-weight: bold;
            color: #2a4230;
            margin-bottom: 5px;
        }
        
        .title {
            font-size: 14px;
            color: #c17b5c;
            font-style: italic;
            margin-bottom: 8px;
        }
        
        .contact-row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            font-size: 10px;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .contact-item i {
            font-style: normal;
            color: #c17b5c;
        }
        
        /* Two Column Layout */
        .two-column {
            display: grid;
            grid-template-columns: 1fr 1.8fr;
            gap: 20px;
        }
        
        /* Left Column */
        .left-column {
            border-right: 1px dashed #eac5b0;
            padding-right: 15px;
        }
        
        /* Right Column */
        .right-column {
            padding-left: 5px;
        }
        
        /* Sections */
        .section {
            margin-bottom: 12px;
        }
        
        .section-title {
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
            color: #2a4230;
            border-bottom: 1px solid #eac5b0;
            padding-bottom: 3px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .section-title i {
            color: #c17b5c;
        }
        
        /* Summary */
        .summary-text {
            text-align: justify;
            font-size: 10.5px;
            line-height: 1.5;
        }
        
        /* Skills */
        .skills-list {
            display: flex;
            flex-wrap: wrap;
            gap: 4px;
            list-style: none;
        }
        
        .skill-item {
            width: 48%;
            font-size: 10px;
            margin-bottom: 3px;
            padding-left: 12px;
            position: relative;
        }
        
        .skill-item:before {
            content: "•";
            position: absolute;
            left: 0;
            color: #c17b5c;
            font-weight: bold;
        }
        
        /* Experience & Education Items - Compact */
        .exp-item, .edu-item {
            margin-bottom: 10px;
        }
        
        .exp-header, .edu-header {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            font-size: 11px;
            margin-bottom: 2px;
        }
        
        .exp-title, .edu-title {
            color: #2a4230;
        }
        
        .exp-date, .edu-date {
            font-style: italic;
            color: #777;
            font-size: 10px;
        }
        
        .exp-company, .edu-school {
            font-size: 10px;
            color: #c17b5c;
            margin-bottom: 3px;
        }
        
        .exp-description {
            font-size: 9.5px;
            line-height: 1.4;
            color: #555;
        }
        
        /* Languages */
        .languages-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .language-item {
            width: 45%;
        }
        
        .language-name {
            font-weight: bold;
            font-size: 10px;
        }
        
        .language-level {
            font-size: 9px;
            color: #777;
        }
        
        /* Projects - Compact */
        .project-item {
            margin-bottom: 8px;
        }
        
        .project-header {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            font-size: 10px;
            margin-bottom: 2px;
        }
        
        .project-title {
            color: #2a4230;
        }
        
        .project-date {
            font-size: 9px;
            color: #777;
            font-style: italic;
        }
        
        .project-description {
            font-size: 9px;
            line-height: 1.3;
            color: #555;
        }
        
        .project-tech {
            font-size: 8px;
            color: #c17b5c;
            margin-top: 2px;
        }
        
        /* Footer */
        .footer {
            margin-top: 10px;
            text-align: center;
            font-size: 8px;
            color: #aaa;
            border-top: 1px solid #eee;
            padding-top: 5px;
        }
        
        /* Page break prevention */
        .keep-together {
            page-break-inside: avoid;
        }
        
        /* Print optimization */
        @media print {
            body { padding: 0; }
            .resume { max-width: 100%; }
        }
    </style>
</head>
<body>
    <div class="resume">
        <!-- Header with Photo - FIXED -->
        <div class="header keep-together">
            <div class="photo-container">
                @if(isset($photoBase64) && $photoBase64)
                    <img src="{{ $photoBase64 }}" alt="{{ $profile->name ?? 'Profile' }}" class="photo">
                @elseif($profile && $profile->profile_image)
                    {{-- Fallback to public path --}}
                    <img src="{{ public_path('storage/' . $profile->profile_image) }}" alt="{{ $profile->name }}" class="photo">
                @else
                    <div class="photo-placeholder">
                        {{ substr($profile->name ?? 'U', 0, 1) }}
                    </div>
                @endif
            </div>
            
            <div class="title-section">
                <h1 class="name">{{ $profile->name ?? 'Umesh Ghimire' }}</h1>
                <div class="title">{{ $profile->title ?? 'Full Stack Developer' }}</div>
                
                <div class="contact-row">
                    <div class="contact-item">
                        <i>📞</i> {{ $phone }}
                    </div>
                    <div class="contact-item">
                        <i>📧</i> {{ $email }}
                    </div>
                    <div class="contact-item">
                        <i>📍</i> {{ $location }}
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Two Column Layout -->
        <div class="two-column">
            <!-- LEFT COLUMN -->
            <div class="left-column">
                <!-- SUMMARY -->
                <div class="section keep-together">
                    <div class="section-title">
                        <i>📋</i> SUMMARY
                    </div>
                    <div class="summary-text">
                        {{ $profile->bio ?? 'Versatile professional with a passion for learning and helping others succeed. Experienced in teaching, skilled in computer applications, accounting, and creative design. Known for adaptability, problem-solving, and building positive relationships.' }}
                    </div>
                </div>
                
                <!-- SKILLS -->
                @if($skills && $skills->count() > 0)
                <div class="section keep-together">
                    <div class="section-title">
                        <i>⚡</i> SKILLS
                    </div>
                    <ul class="skills-list">
                        @php $count = 0; @endphp
                        @foreach($skills as $skill)
                            @if($count < 14)
                                <li class="skill-item">{{ $skill->name }}</li>
                            @endif
                            @php $count++; @endphp
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <!-- LANGUAGES -->
                <div class="section keep-together">
                    <div class="section-title">
                        <i>🗣️</i> LANGUAGES
                    </div>
                    <div class="languages-grid">
                        @foreach($languages as $lang)
                            <div class="language-item">
                                <div class="language-name">{{ $lang['name'] }}:</div>
                                <div class="language-level">{{ $lang['level'] }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- EDUCATION -->
                @if($education && $education->count() > 0)
                <div class="section keep-together">
                    <div class="section-title">
                        <i>🎓</i> EDUCATION
                    </div>
                    
                    @foreach($education->take(2) as $edu)
                    <div class="edu-item">
                        <div class="edu-header">
                            <span class="edu-title">{{ $edu->full_degree }}</span>
                            <span class="edu-date">{{ \Carbon\Carbon::parse($edu->start_date)->format('Y') }}</span>
                        </div>
                        <div class="edu-school">{{ $edu->institution }}</div>
                        @if($edu->grade)
                            <div style="font-size: 9px; color: #777;">{{ $edu->grade }}</div>
                        @endif
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            
            <!-- RIGHT COLUMN -->
            <div class="right-column">
                <!-- EXPERIENCE -->
                @if($experiences && $experiences->count() > 0)
                <div class="section keep-together">
                    <div class="section-title">
                        <i>💼</i> EXPERIENCE
                    </div>
                    
                    @foreach($experiences->take(2) as $exp)
                    <div class="exp-item">
                        <div class="exp-header">
                            <span class="exp-title">{{ $exp->title }}</span>
                            <span class="exp-date">
                                {{ \Carbon\Carbon::parse($exp->start_date)->format('Y') }} - 
                                {{ $exp->is_current ? 'Present' : ($exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->format('Y') : 'Present') }}
                            </span>
                        </div>
                        <div class="exp-company">{{ $exp->company }}</div>
                        <div class="exp-description">
                            {{ Str::limit(strip_tags($exp->description), 150) }}
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
                
                <!-- PROJECTS -->
                @if($projects && $projects->count() > 0)
                <div class="section keep-together">
                    <div class="section-title">
                        <i>🚀</i> PROJECTS
                    </div>
                    
                    @foreach($projects as $project)
                    <div class="project-item">
                        <div class="project-header">
                            <span class="project-title">{{ $project->title }}</span>
                            @if($project->project_date)
                                <span class="project-date">{{ \Carbon\Carbon::parse($project->project_date)->format('Y') }}</span>
                            @endif
                        </div>
                        <div class="project-description">
                            {{ Str::limit($project->description, 100) }}
                        </div>
                        @if($project->technologies && count($project->technologies) > 0)
                            <div class="project-tech">
                                {{ implode(' • ', array_slice($project->technologies, 0, 3)) }}
                            </div>
                        @endif
                    </div>
                    @endforeach
                </div>
                @endif
                
                @if($experiences->count() > 2)
                <div style="font-size: 8px; color: #c17b5c; text-align: right; margin-top: 5px;">
                    * Additional experience available upon request
                </div>
                @endif
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            Generated from {{ config('app.url') }} · {{ $generated_at }} · One-page resume
        </div>
    </div>
</body>
</html>