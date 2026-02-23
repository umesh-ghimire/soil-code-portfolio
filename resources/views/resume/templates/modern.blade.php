<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profile->name ?? 'Umesh Ghimire' }} - Modern Resume</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', 'Roboto', sans-serif;
            line-height: 1.5;
            color: #333;
            background: #f5f5f5;
            padding: 0;
            margin: 0;
            font-size: 11pt;
        }
        
        .resume {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            background: white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            position: relative;
        }
        
        /* Header with Photo and Color Block */
        .header {
            display: flex;
            align-items: center;
            gap: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15mm 15mm 10mm 15mm;
        }
        
        .photo-container {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid white;
            flex-shrink: 0;
            background: #f0f0f0;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .photo-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(145deg, #667eea, #764ba2);
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
            margin-bottom: 3px;
            letter-spacing: -0.5px;
        }
        
        .title {
            font-size: 16pt;
            opacity: 0.9;
            margin-bottom: 10px;
            font-weight: 400;
        }
        
        .contact-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            font-size: 11pt;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 6px;
        }
        
        .contact-item i {
            font-style: normal;
            opacity: 0.8;
        }
        
        /* Content */
        .content {
            padding: 15mm 15mm 10mm 15mm;
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 20px;
        }
        
        /* Left Column */
        .left-column {
            border-right: 2px solid #f0f0f0;
            padding-right: 15px;
        }
        
        .section {
            margin-bottom: 20px;
        }
        
        .section-title {
            font-size: 16pt;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 40px;
            height: 3px;
            background: linear-gradient(135deg, #667eea, #764ba2);
        }
        
        /* Summary */
        .summary-text {
            font-size: 11pt;
            line-height: 1.5;
            color: #666;
        }
        
        /* Skills */
        .skill-item {
            margin-bottom: 8px;
            font-size: 11pt;
            color: #555;
        }
        
        .skill-name {
            display: block;
            margin-bottom: 2px;
            font-weight: 500;
        }
        
        .skill-bar {
            height: 6px;
            background: #f0f0f0;
            border-radius: 3px;
            overflow: hidden;
        }
        
        .skill-progress {
            height: 100%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 3px;
        }
        
        /* Languages */
        .language-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 11pt;
        }
        
        .language-name {
            font-weight: 500;
            color: #444;
        }
        
        .language-level {
            color: #667eea;
        }
        
        /* Right Column */
        .right-column {
            padding-left: 5px;
        }
        
        /* Experience & Education */
        .exp-item, .edu-item {
            margin-bottom: 18px;
        }
        
        .exp-header, .edu-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3px;
        }
        
        .exp-title, .edu-title {
            font-size: 14pt;
            font-weight: 600;
            color: #333;
        }
        
        .exp-date, .edu-date {
            font-size: 11pt;
            color: #667eea;
            font-weight: 500;
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
            color: #777;
        }
        
        /* Projects */
        .project-item {
            margin-bottom: 15px;
        }
        
        .project-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3px;
        }
        
        .project-title {
            font-size: 13pt;
            font-weight: 600;
            color: #333;
        }
        
        .project-date {
            font-size: 10pt;
            color: #667eea;
        }
        
        .project-description {
            font-size: 10.5pt;
            color: #777;
            line-height: 1.5;
            margin-bottom: 3px;
        }
        
        .project-tech {
            font-size: 9pt;
            color: #667eea;
        }
        
        /* Footer */
        .footer {
            padding: 5mm 15mm;
            text-align: center;
            font-size: 9pt;
            color: #999;
            border-top: 1px solid #f0f0f0;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
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
                width: 100%;
                min-height: auto;
            }
            .footer {
                position: fixed;
                bottom: 0;
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
        
        <!-- Content -->
        <div class="content">
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
                    <h2 class="section-title">Skills</h2>
                    @foreach($skills->take(8) as $skill)
                        <div class="skill-item">
                            <span class="skill-name">{{ $skill->name }}</span>
                            <div class="skill-bar">
                                <div class="skill-progress" style="width: {{ $skill->proficiency ?? 80 }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif
                
                <!-- Languages -->
                <div class="section">
                    <h2 class="section-title">Languages</h2>
                    @foreach($languages as $lang)
                        <div class="language-item">
                            <span class="language-name">{{ $lang['name'] }}</span>
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
                    <h2 class="section-title">Experience</h2>
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
                                {{ Str::limit(strip_tags($exp->description), 150) }}
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif
                
                <!-- Projects -->
                @if($projects && $projects->count() > 0)
                <div class="section">
                    <h2 class="section-title">Projects</h2>
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
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            Generated from {{ config('app.url') }} · {{ $generated_at }}
        </div>
    </div>
</body>
</html>