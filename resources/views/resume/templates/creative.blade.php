<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profile->name ?? 'Umesh Ghimire' }} - Creative Resume</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', 'Helvetica', sans-serif;
            background: #fafafa;
            padding: 0;
            margin: 0;
            font-size: 11pt;
        }
        
        .resume {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            background: white;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            position: relative;
        }
        
        /* Header with Photo - Organic Style */
        .header {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 15mm 15mm 10mm 15mm;
            background: linear-gradient(145deg, #2a4230, #4c6b4a);
            color: white;
        }
        
        .photo-container {
            width: 100px;
            height: 100px;
            border-radius: 50% 40% 50% 40%;
            overflow: hidden;
            border: 3px solid #eac5b0;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            flex-shrink: 0;
            background: #f0f0f0;
        }
        
        .photo {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50% 40% 50% 40%;
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
            margin-bottom: 3px;
        }
        
        .title {
            font-size: 16pt;
            opacity: 0.9;
            margin-bottom: 10px;
            font-style: italic;
        }
        
        .contact-row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            font-size: 10pt;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .contact-item i {
            font-style: normal;
            color: #eac5b0;
        }
        
        /* Content */
        .content {
            padding: 15mm 15mm 10mm 15mm;
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 20px;
        }
        
        /* Left Column - Light Background */
        .left-column {
            background: #f8f4f0;
            padding: 15px;
            border-radius: 20px;
        }
        
        .section {
            margin-bottom: 20px;
        }
        
        .section-title {
            font-size: 16pt;
            font-weight: 700;
            color: #2a4230;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            display: inline-block;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 0;
            width: 100%;
            height: 2px;
            background: repeating-linear-gradient(45deg, #c17b5c, #c17b5c 4px, transparent 4px, transparent 8px);
        }
        
        /* Summary */
        .summary-text {
            font-size: 11pt;
            line-height: 1.5;
            color: #4a4a4a;
        }
        
        /* Skills */
        .skill-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }
        
        .skill-tag {
            background: white;
            color: #2a4230;
            padding: 4px 10px;
            border-radius: 30px 8px 30px 8px;
            font-size: 9pt;
            font-weight: 500;
            border: 1px solid #eac5b0;
        }
        
        /* Languages */
        .language-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            padding: 6px 10px;
            background: white;
            border-radius: 40px 12px 40px 12px;
            border: 1px solid #eac5b0;
            font-size: 10pt;
        }
        
        .language-name {
            font-weight: 600;
            color: #2a4230;
        }
        
        .language-level {
            color: #c17b5c;
        }
        
        /* Right Column */
        .right-column {
            padding: 0 5px;
        }
        
        /* Experience & Education Cards */
        .exp-item, .edu-item {
            background: #f8f4f0;
            padding: 15px;
            border-radius: 60px 20px 60px 20px;
            margin-bottom: 15px;
            border: 1px solid #eac5b0;
        }
        
        .exp-header, .edu-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        
        .exp-title, .edu-title {
            font-size: 14pt;
            font-weight: 700;
            color: #2a4230;
        }
        
        .exp-date, .edu-date {
            color: #c17b5c;
            font-weight: 500;
            font-size: 10pt;
        }
        
        .exp-company, .edu-school {
            color: #666;
            margin-bottom: 8px;
            font-size: 11pt;
            font-style: italic;
        }
        
        .exp-description {
            font-size: 10pt;
            line-height: 1.5;
            color: #4a4a4a;
        }
        
        /* Projects */
        .project-item {
            background: white;
            padding: 15px;
            border-radius: 50px 15px 50px 15px;
            margin-bottom: 12px;
            border: 1px solid #eac5b0;
            box-shadow: 0 3px 8px rgba(0,0,0,0.03);
        }
        
        .project-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        
        .project-title {
            font-size: 13pt;
            font-weight: 700;
            color: #2a4230;
        }
        
        .project-date {
            color: #c17b5c;
            font-size: 9pt;
        }
        
        .project-description {
            font-size: 10pt;
            color: #666;
            line-height: 1.5;
            margin-bottom: 5px;
        }
        
        .project-tech {
            font-size: 9pt;
            color: #c17b5c;
        }
        
        /* Footer */
        .footer {
            padding: 5mm 15mm;
            text-align: center;
            background: #2a4230;
            color: #eac5b0;
            font-size: 9pt;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            width: 100%;
        }
        
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
                <!-- About -->
                <div class="section">
                    <h2 class="section-title">About</h2>
                    <div class="summary-text">
                        {{ $profile->bio ?? 'Versatile professional with a passion for learning and helping others succeed. Experienced in teaching, skilled in computer applications, accounting, and creative design. Known for adaptability, problem-solving, and building positive relationships.' }}
                    </div>
                </div>
                
                <!-- Skills -->
                @if($skills && $skills->count() > 0)
                <div class="section">
                    <h2 class="section-title">Skills</h2>
                    <div class="skill-tags">
                        @foreach($skills as $skill)
                            <span class="skill-tag">{{ $skill->name }}</span>
                        @endforeach
                    </div>
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
                                {{ Str::limit(strip_tags($exp->description), 120) }}
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
                                {{ Str::limit($project->description, 80) }}
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