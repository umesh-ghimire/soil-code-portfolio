@extends('layouts.app')

@section('title', 'Select Resume Template')
@section('description', 'Choose a professional resume template to download')

@push('styles')
<style>
    .templates-header {
        padding: 3rem 0 2rem;
        text-align: center;
    }
    
    .templates-header h1 {
        font-size: 3.5rem;
        font-weight: 800;
        color: var(--moss-deep);
        margin-bottom: 1rem;
        font-family: 'Playfair Display', serif;
    }
    
    .templates-header p {
        font-size: 1.2rem;
        color: #5a6b5a;
        max-width: 700px;
        margin: 0 auto;
    }
    
    .templates-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 2rem;
        margin: 3rem 0 5rem;
    }
    
    .template-card {
        background: white;
        border-radius: 80px 20px 80px 20px;
        overflow: hidden;
        border: 2px solid var(--clay-light);
        transition: all 0.3s;
        box-shadow: var(--shadow-warm);
        cursor: pointer;
        position: relative;
    }
    
    .template-card:hover {
        transform: translateY(-10px);
        border-color: var(--clay);
        box-shadow: 0 30px 40px -15px rgba(193, 123, 92, 0.3);
    }
    
    .template-card.selected {
        border: 4px solid var(--clay);
        transform: scale(1.02);
    }
    
    .template-preview {
        height: 400px;
        overflow: hidden;
        background: #f8f8f8;
        position: relative;
        border-bottom: 1px solid var(--clay-light);
    }
    
    .template-preview iframe {
        width: 100%;
        height: 100%;
        border: none;
        pointer-events: none;
    }
    
    .template-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: var(--clay);
        color: white;
        padding: 0.5rem 1.5rem;
        border-radius: 40px 12px 40px 12px;
        font-weight: 600;
        font-size: 0.9rem;
        z-index: 10;
    }
    
    .template-info {
        padding: 1.5rem;
        text-align: center;
    }
    
    .template-name {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--moss-deep);
        margin-bottom: 0.5rem;
        font-family: 'Playfair Display', serif;
    }
    
    .template-description {
        color: #5a6b5a;
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
    }
    
    .template-actions {
        display: flex;
        gap: 1rem;
        justify-content: center;
        margin: 2rem 0;
        flex-wrap: wrap;
    }
    
    .btn-template {
        background: var(--clay);
        color: white;
        padding: 1rem 2rem;
        border-radius: 60px 20px 60px 20px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .btn-template:hover {
        background: var(--moss);
        transform: translateY(-3px);
        box-shadow: 0 10px 20px -5px var(--moss);
    }
    
    .btn-template-outline {
        background: transparent;
        color: var(--clay);
        border: 2px solid var(--clay);
        padding: 1rem 2rem;
        border-radius: 60px 20px 60px 20px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .btn-template-outline:hover {
        background: var(--clay-light);
        border-color: var(--clay);
        color: var(--moss-deep);
    }
    
    .selection-actions {
        display: flex;
        gap: 1.5rem;
        justify-content: center;
        margin: 3rem 0;
    }
    
    .btn-download {
        background: var(--moss);
        color: white;
        padding: 1.2rem 3rem;
        border-radius: 60px 20px 60px 20px;
        text-decoration: none;
        font-weight: 700;
        font-size: 1.2rem;
        transition: all 0.3s;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 1rem;
    }
    
    .btn-download:hover {
        background: var(--clay);
        transform: translateY(-3px);
        box-shadow: 0 15px 30px -10px var(--clay);
    }
    
    .btn-download:disabled {
        opacity: 0.5;
        cursor: not-allowed;
        transform: none;
    }
    
    .btn-download:disabled:hover {
        background: var(--moss);
        box-shadow: none;
    }
    
    .btn-view {
        background: transparent;
        color: var(--moss-deep);
        border: 2px solid var(--moss);
        padding: 1.2rem 3rem;
        border-radius: 60px 20px 60px 20px;
        text-decoration: none;
        font-weight: 700;
        font-size: 1.2rem;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 1rem;
    }
    
    .btn-view:hover {
        background: var(--moss);
        color: white;
        transform: translateY(-3px);
    }
    
    @media (max-width: 900px) {
        .templates-grid {
            grid-template-columns: 1fr;
        }
        
        .templates-header h1 {
            font-size: 2.5rem;
        }
        
        .template-preview {
            height: 300px;
        }
        
        .selection-actions {
            flex-direction: column;
            align-items: center;
        }
        
        .btn-download, .btn-view {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="templates-header">
        <h1>Choose Your Resume Template</h1>
        <p>Select a professional template and download your resume instantly</p>
    </div>
    
    <div class="templates-grid">
        <!-- Template 1: Classic Professional -->
        <div class="template-card" id="template1" onclick="selectTemplate(1)">
            <div class="template-preview">
                <iframe src="{{ route('resume.preview', 'classic') }}" title="Classic Professional Preview"></iframe>
                <div class="template-badge">Classic</div>
            </div>
            <div class="template-info">
                <h3 class="template-name">Classic Professional</h3>
                <p class="template-description">Clean, traditional layout perfect for corporate and formal applications.</p>
                <div class="template-actions">
                    <a href="{{ route('resume.preview', 'classic') }}" target="_blank" class="btn-template-outline">Preview</a>
                    <a href="{{ route('resume.download', 'classic') }}" class="btn-template">Download</a>
                </div>
            </div>
        </div>
        
        <!-- Template 2: Modern Minimal -->
        <div class="template-card" id="template2" onclick="selectTemplate(2)">
            <div class="template-preview">
                <iframe src="{{ route('resume.preview', 'modern') }}" title="Modern Minimal Preview"></iframe>
                <div class="template-badge">Modern</div>
            </div>
            <div class="template-info">
                <h3 class="template-name">Modern Minimal</h3>
                <p class="template-description">Contemporary design with clean lines and elegant spacing for creative professionals.</p>
                <div class="template-actions">
                    <a href="{{ route('resume.preview', 'modern') }}" target="_blank" class="btn-template-outline">Preview</a>
                    <a href="{{ route('resume.download', 'modern') }}" class="btn-template">Download</a>
                </div>
            </div>
        </div>
        
        <!-- Template 3: Creative Portfolio -->
        <div class="template-card" id="template3" onclick="selectTemplate(3)">
            <div class="template-preview">
                <iframe src="{{ route('resume.preview', 'creative') }}" title="Creative Portfolio Preview"></iframe>
                <div class="template-badge">Creative</div>
            </div>
            <div class="template-info">
                <h3 class="template-name">Creative Portfolio</h3>
                <p class="template-description">Bold, artistic layout for designers, artists, and creative professionals.</p>
                <div class="template-actions">
                    <a href="{{ route('resume.preview', 'creative') }}" target="_blank" class="btn-template-outline">Preview</a>
                    <a href="{{ route('resume.download', 'creative') }}" class="btn-template">Download</a>
                </div>
            </div>
        </div>
        
        <!-- Template 4: Executive -->
        <div class="template-card" id="template4" onclick="selectTemplate(4)">
            <div class="template-preview">
                <iframe src="{{ route('resume.preview', 'executive') }}" title="Executive Preview"></iframe>
                <div class="template-badge">Executive</div>
            </div>
            <div class="template-info">
                <h3 class="template-name">Executive</h3>
                <p class="template-description">Sophisticated design for senior roles, featuring expanded experience sections.</p>
                <div class="template-actions">
                    <a href="{{ route('resume.preview', 'executive') }}" target="_blank" class="btn-template-outline">Preview</a>
                    <a href="{{ route('resume.download', 'executive') }}" class="btn-template">Download</a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="selection-actions">
        <button class="btn-download" id="downloadSelectedBtn" onclick="downloadSelected()" disabled>
            <i class="fas fa-download"></i> Download Selected Template
        </button>
        <a href="{{ route('resume.preview', 'classic') }}" class="btn-view" target="_blank">
            <i class="fas fa-eye"></i> Preview as PDF
        </a>
    </div>
</div>

<script>
let selectedTemplate = null;

function selectTemplate(templateNumber) {
    // Remove selected class from all cards
    document.querySelectorAll('.template-card').forEach(card => {
        card.classList.remove('selected');
    });
    
    // Add selected class to clicked card
    document.getElementById(`template${templateNumber}`).classList.add('selected');
    
    // Store selected template
    selectedTemplate = templateNumber;
    
    // Enable download button
    document.getElementById('downloadSelectedBtn').disabled = false;
}

function downloadSelected() {
    if (selectedTemplate) {
        const templates = ['classic', 'modern', 'creative', 'executive'];
        window.location.href = `/resume/download/${templates[selectedTemplate - 1]}`;
    }
}
</script>
@endsection