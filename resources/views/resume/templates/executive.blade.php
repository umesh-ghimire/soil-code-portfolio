<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profile->name ?? 'Umesh Ghimire' }} - Executive Resume</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Times New Roman', 'Georgia', serif;
            line-height: 1.5;
            color: #2c3e50;
            background: #f0f0f0;
            padding: 0;
            margin: 0;
            font-size: 11pt;
        }
        
        .resume {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            background: white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            padding: 15mm 15mm 10mm 15mm;
            position: relative;
        }
        
        /* Header with Photo */
        .header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 3px double #c17b5c;
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
            text-transform: uppercase;
        }
        
        .title-section {
            flex: 1;
        }
        
        .name {
            font-size: 32pt;
            font-weight: 700;
            color: #2a4230;
            margin-bottom: 3px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        
        .title {
            font-size: 16pt;
            color: #c17b5c;
            margin-bottom: 10px;
            font-style: italic;
        }
        
        .contact-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            font-size: 11pt;
            color: #666;
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
            grid-template-columns: 1fr 2fr;
            gap: 25px;
            margin-bottom: 20px;
        }
        
        /* Sections */
        .section {
            margin-bottom: 18px;
        }
        
        .section-title {
            font-size: 16pt;
            font-weight: 700;
            color: #2a4230;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 2px solid #eac5b0;
            padding-bottom: 3px;
        }
        
        /* Summary */
        .summary-text {
            font-size: 11pt;
            line-height: 1.5;
            color: #555;
            text-align: justify;
        }
        
        /* Skills */
        .skills-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 8px;
        }
        
        .skill-item {
            font-size: 11pt;
            color: #555;
            padding-left: 12px;
            position: relative;
        }
        
        .skill-item::before {
            content: "•";
            position: absolute;
            left: 0;
            color: #c17b5c;
            font-weight: bold;
        }
        
        /* Languages */
        .language-item {
            display: flex;
            margin-bottom: 6px;
            font-size: 11pt;
        }
        
        .language-name {
            width: 100px;
            font-weight: 600;
            color: #2a4230;
        }
        
        .language-level {
            color: #666;
        }
        
        /* Experience & Education */
        .exp-item, .edu-item {
            margin-bottom: 15px;
        }
        
        .exp-header, .edu-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3px;
        }
        
        .exp-title, .edu-title {
            font-size: 14pt;
            font-weight: 700;
            color: #2a4230;
        }
        
        .exp-date, .edu-date {
            color: #c17b5c;
            font-size: 11pt;
            font-style: italic;
        }
        
        .exp-company, .edu-school {
            font-size: 12pt;
            color: #666;
            margin-bottom: 5px;
            font-weight: 500;
        }
        
        .exp-description {
            font-size: 10.5pt;
            line-height: 1.5;
            color: #555;
            margin-left: 5px;
        }
        
        /* Projects */
        .project-item {
            margin-bottom: 12px;
            padding-left: 8px;
            border-left: 2px solid #eac5b0;
        }
        
        .project-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3px;
        }
        
        .project-title {
            font-size: 13pt;
            font-weight: 600;
            color: #2a4230;
        }
        
        .project-date {
            color: #c17b5c;
            font-size: 10pt;
            font-style: italic;
        }
        
        .project-description {
            font-size: 10.5pt;
            color: #555;
            line-height: 1.5;
            margin-bottom: 3px;
        }
        
        .project-tech {
            font-size: 9pt;
            color: #c17b5c;
        }
        
        /* Footer */
        .footer {
            margin-top: 15px;
            padding-top: 10px;
            text-align: center;
            font-size: 9pt;
            color: #999;
            border-top: 1px solid #eac5b0;
            position: absolute;
            bottom: 10mm;
            left: 15mm;
            right: 15mm;
            width: calc(100% - 30mm);
        }
        
        /* Print */
        @media print {
            body { 
                background: white; 
                padding: 0;
                margin: 0;
            }
            .resume { 
                box-shadow: none; 
                padding: 15mm 15mm 10mm 15mm;
                width: 100%;
                min-height: auto;
            }
            .footer {
                position: fixed;
                bottom: 10mm;
            }
        }
        
        .keep-together {
            page-break-inside: avoid;
        }
    </style>
</head>
<body>
    <div class="resume">
        <!-- Header with Photo -->
        <div class="header">
            <div class="photo-container">
                @if(isset($photoBase64) && $photoBase64)
                    {{-- For PDF download --}}
                    <img src="{{ $photoBase64 }}" alt="{{ $profile->name ?? 'Profile' }}" class="photo">
                @elseif($profile && $profile->profile_image)
                    {{-- For browser preview --}}
                    <img src="{{ asset('storage/' . $profile->profile_image) }}" alt="{{ $profile->name }}" class="photo">
                @else
                    {{-- Fallback to initials --}}
                    <div class="photo-placeholder">
                        @php
                            $name = $profile->name ?? 'Umesh Ghimire';
                            $initials = '';
                            $nameParts = explode(' ', $name);
                            foreach ($nameParts as $part) {
                                $initials .= strtoupper(substr($part, 0, 1));
                            }
                            echo substr($initials, 0, 2);
                        @endphp
                    </div>
                @endif
            </div>
            
            <div class="title-section">
                <h1 class="name">{{ $profile->name ?? 'Umesh Ghimire' }}</h1>
                <div class="title">{{ $profile->title ?? 'Full Stack Developer' }}</div>
                
                <div class="contact-row">
                    <div class="contact-item"><i>📧</i> {{ $email }}</div>
                    <div class="contact-item"><i>📞</i> {{ $phone }}</div>
                    <div class="contact-item"><i>📍</i> {{ $location }}</div>
                </div>
            </div>
        </div>
        
        <!-- Two Column Layout -->
        <div class="two-column">
            <!-- LEFT COLUMN -->
            <div class="left-column">
                <!-- Summary -->
                <div class="section">
                    <h2 class="section-title">Profile</h2>
                    <div class="summary-text">
                        {{ $profile->bio ?? 'Versatile professional with a passion for learning and helping others succeed. Experienced in teaching, skilled in computer applications, accounting, and creative design. Known for adaptability, problem-solving, and building positive relationships.' }}
                    </div>
                </div>
                
                <!-- Skills -->
                @if($skills && $skills->count() > 0)
                <div class="section">
                    <h2 class="section-title">Core Skills</h2>
                    <div class="skills-grid">
                        @foreach($skills as $skill)
                            <div class="skill-item">{{ $skill->name }}</div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <!-- Languages -->
                <div class="section">
                    <h2 class="section-title">Languages</h2>
                    @foreach($languages as $lang)
                        <div class="language-item">
                            <span class="language-name">{{ $lang['name'] }}:</span>
                            <span class="language-level">{{ $lang['level'] }}</span>
                        </div>
                    @endforeach
                </div>
                
                <!-- Education -->
                @if($education && $education->count() > 0)
                <div class="section">
                    <h2 class="section-title">Education</h2>
                    @foreach($education as $edu)
                        <div class="edu-item">
                            <div class="edu-header">
                                <span class="edu-title">{{ $edu->full_degree }}</span>
                                <span class="edu-date">{{ \Carbon\Carbon::parse($edu->start_date)->format('Y') }}</span>
                            </div>
                            <div class="edu-school">{{ $edu->institution }}</div>
                        </div>
                    @endforeach
                </div>
                @endif
            </div>
            
            <!-- RIGHT COLUMN -->
            <div class="right-column">
                <!-- Experience -->
                @if($experiences && $experiences->count() > 0)
                <div class="section">
                    <h2 class="section-title">Professional Experience</h2>
                    @foreach($experiences as $exp)
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
                                {{ strip_tags($exp->description) }}
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif
                
                <!-- Projects -->
                @if($projects && $projects->count() > 0)
                <div class="section">
                    <h2 class="section-title">Key Projects</h2>
                    @foreach($projects as $project)
                        <div class="project-item">
                            <div class="project-header">
                                <span class="project-title">{{ $project->title }}</span>
                                @if($project->project_date)
                                    <span class="project-date">{{ \Carbon\Carbon::parse($project->project_date)->format('Y') }}</span>
                                @endif
                            </div>
                            <div class="project-description">
                                {{ $project->description }}
                            </div>
                            @if($project->technologies && count($project->technologies) > 0)
                                <div class="project-tech">
                                    {{ implode(' | ', array_slice($project->technologies, 0, 3)) }}
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            Generated from {{ config('app.url') }} · {{ $generated_at }}
        </div>
    </div>
</body>
</html>