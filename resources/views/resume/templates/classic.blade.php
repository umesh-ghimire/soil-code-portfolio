<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profile->name ?? 'Umesh Ghimire' }} - Professional Resume</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', 'Helvetica', sans-serif;
            line-height: 1.5;
            color: #2c3e50;
            background: white;
            padding: 0;
            margin: 0;
            font-size: 11pt;
        }
        
        .resume {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            background: white;
            padding: 15mm 15mm 10mm 15mm;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            position: relative;
        }
        
        /* Header with Photo */
        .header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 15px;
            border-bottom: 2px solid #2980b9;
            padding-bottom: 10px;
        }
        
        .photo-container {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid #2980b9;
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
            background: linear-gradient(145deg, #2980b9, #3498db);
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
            font-size: 28pt;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 3px;
            letter-spacing: 1px;
        }
        
        .title {
            font-size: 14pt;
            color: #2980b9;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .contact-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            font-size: 10pt;
            color: #7f8c8d;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .contact-item i {
            font-style: normal;
            color: #2980b9;
        }
        
        /* Two Column Layout */
        .two-column {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 20px;
            margin-bottom: 15px;
        }
        
        /* Left Column */
        .left-column {
            border-right: 1px solid #ecf0f1;
            padding-right: 15px;
        }
        
        /* Sections */
        .section {
            margin-bottom: 15px;
        }
        
        .section-title {
            font-size: 14pt;
            font-weight: 700;
            color: #2c3e50;
            border-bottom: 1px solid #bdc3c7;
            padding-bottom: 3px;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        /* Summary */
        .summary-text {
            text-align: justify;
            font-size: 10pt;
            line-height: 1.5;
            color: #34495e;
        }
        
        /* Skills */
        .skills-list {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            list-style: none;
        }
        
        .skill-item {
            background: #ecf0f1;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 9pt;
            color: #2c3e50;
        }
        
        /* Experience & Education */
        .exp-item, .edu-item {
            margin-bottom: 12px;
        }
        
        .exp-header, .edu-header {
            display: flex;
            justify-content: space-between;
            font-weight: 700;
            font-size: 11pt;
            margin-bottom: 2px;
        }
        
        .exp-title, .edu-title {
            color: #2c3e50;
        }
        
        .exp-date, .edu-date {
            color: #7f8c8d;
            font-weight: 400;
            font-size: 10pt;
        }
        
        .exp-company, .edu-school {
            font-size: 10pt;
            color: #2980b9;
            margin-bottom: 4px;
            font-weight: 500;
        }
        
        .exp-description {
            font-size: 9.5pt;
            line-height: 1.4;
            color: #34495e;
        }
        
        /* Languages */
        .language-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 6px;
            font-size: 10pt;
        }
        
        .language-name {
            font-weight: 600;
            color: #2c3e50;
        }
        
        .language-level {
            color: #7f8c8d;
        }
        
        /* Projects */
        .project-item {
            margin-bottom: 10px;
        }
        
        .project-header {
            display: flex;
            justify-content: space-between;
            font-weight: 600;
            font-size: 10.5pt;
            margin-bottom: 2px;
        }
        
        .project-title {
            color: #2c3e50;
        }
        
        .project-date {
            color: #7f8c8d;
            font-weight: 400;
            font-size: 9pt;
        }
        
        .project-description {
            font-size: 9.5pt;
            line-height: 1.4;
            color: #34495e;
        }
        
        .project-tech {
            font-size: 8.5pt;
            color: #2980b9;
            margin-top: 2px;
        }
        
        /* Footer */
        .footer {
            margin-top: 15px;
            text-align: center;
            font-size: 8pt;
            color: #95a5a6;
            border-top: 1px solid #ecf0f1;
            padding-top: 5px;
            position: absolute;
            bottom: 10mm;
            left: 15mm;
            right: 15mm;
            width: calc(100% - 30mm);
        }
        
        /* Print optimization */
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
                    <div class="section-title">Profile</div>
                    <div class="summary-text">
                        {{ $profile->bio ?? 'Versatile professional with a passion for learning and helping others succeed. Experienced in teaching, skilled in computer applications, accounting, and creative design. Known for adaptability, problem-solving, and building positive relationships.' }}
                    </div>
                </div>
                
                <!-- Skills -->
                @if($skills && $skills->count() > 0)
                <div class="section">
                    <div class="section-title">Skills</div>
                    <ul class="skills-list">
                        @foreach($skills as $skill)
                            <li class="skill-item">{{ $skill->name }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <!-- Languages -->
                <div class="section">
                    <div class="section-title">Languages</div>
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
                    <div class="section-title">Education</div>
                    @foreach($education as $edu)
                        <div class="edu-item">
                            <div class="edu-header">
                                <span class="edu-title">{{ $edu->full_degree }}</span>
                                <span class="edu-date">{{ \Carbon\Carbon::parse($edu->start_date)->format('Y') }}</span>
                            </div>
                            <div class="edu-school">{{ $edu->institution }}</div>
                            @if($edu->grade)
                                <div style="font-size: 9pt; color: #7f8c8d;">{{ $edu->grade }}</div>
                            @endif
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
                    <div class="section-title">Experience</div>
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
                                {{ Str::limit(strip_tags($exp->description), 200) }}
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif
                
                <!-- Projects -->
                @if($projects && $projects->count() > 0)
                <div class="section">
                    <div class="section-title">Projects</div>
                    @foreach($projects as $project)
                        <div class="project-item">
                            <div class="project-header">
                                <span class="project-title">{{ $project->title }}</span>
                                @if($project->project_date)
                                    <span class="project-date">{{ \Carbon\Carbon::parse($project->project_date)->format('Y') }}</span>
                                @endif
                            </div>
                            <div class="project-description">
                                {{ Str::limit($project->description, 120) }}
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