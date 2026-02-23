@extends('layouts.app')

@section('title', theme_setting('projects_page_title', 'cultivated projects · Umesh Ghimire'))
@section('description', theme_setting('projects_meta_description', 'A curated collection of projects built with patience, respect, and generational wisdom.'))

@push('styles')
<style>
    /* ===== PROJECTS HEADER ===== */
    .projects-header {
        padding: clamp(2rem, 5vw, 4rem) 0 clamp(1.5rem, 4vw, 3rem);
        text-align: center;
        position: relative;
        margin-bottom: clamp(1rem, 3vw, 2rem);
    }
    
    .projects-header h1 {
        font-size: clamp(2rem, 6vw, 4.5rem);
        font-weight: 800;
        color: var(--moss-deep);
        margin-bottom: 1rem;
        font-family: 'Playfair Display', serif;
        letter-spacing: -0.02em;
        position: relative;
        display: inline-block;
        line-height: 1.2;
    }
    
    .projects-header h1::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: clamp(60px, 8vw, 80px);
        height: 4px;
        background: linear-gradient(90deg, var(--clay), var(--moss));
        border-radius: 4px;
    }
    
    .projects-header .subtitle {
        font-size: clamp(0.95rem, 2.2vw, 1.25rem);
        color: #5a6b5a;
        max-width: min(600px, 90%);
        margin: 2rem auto 0;
        font-style: italic;
        line-height: 1.6;
        opacity: 0.9;
        padding: 0 1rem;
    }
    
    /* ===== PROJECT STATS ===== */
    .projects-stats {
        display: flex;
        justify-content: center;
        gap: clamp(1rem, 4vw, 4rem);
        margin: clamp(2rem, 5vw, 3rem) 0 clamp(3rem, 8vw, 5rem);
        padding: clamp(1.2rem, 3vw, 2rem);
        background: rgba(255, 255, 255, 0.6);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: clamp(60px, 10vw, 80px) clamp(15px, 3vw, 20px) clamp(60px, 10vw, 80px) clamp(15px, 3vw, 20px);
        border: 1px solid rgba(193, 123, 92, 0.2);
        flex-wrap: wrap;
        box-shadow: 0 20px 40px -15px rgba(76, 107, 74, 0.15);
    }
    
    .stat-item {
        text-align: center;
        position: relative;
        padding: 0 clamp(0.5rem, 2vw, 1rem);
    }
    
    .stat-item::after {
        content: '';
        position: absolute;
        right: -2rem;
        top: 50%;
        transform: translateY(-50%);
        width: 1px;
        height: 40px;
        background: linear-gradient(180deg, transparent, var(--clay-light), transparent);
    }
    
    .stat-item:last-child::after {
        display: none;
    }
    
    .stat-number {
        font-size: clamp(1.8rem, 4vw, 2.8rem);
        font-weight: 800;
        color: var(--clay);
        line-height: 1;
        margin-bottom: 0.3rem;
        font-family: 'Playfair Display', serif;
    }
    
    .stat-label {
        font-size: clamp(0.7rem, 2vw, 0.85rem);
        color: var(--moss-deep);
        text-transform: uppercase;
        letter-spacing: clamp(1px, 0.3vw, 2px);
        font-weight: 600;
    }
    
    /* ===== SPIRAL STAIRCASE LAYOUT ===== */
    .spiral-container {
        position: relative;
        max-width: min(1300px, 100%);
        margin: 0 auto;
        padding: clamp(1rem, 4vw, 3rem) 0;
    }
    
    /* Central Spiral Column */
    .spiral-column {
        position: absolute;
        left: 50%;
        top: 0;
        bottom: 0;
        width: 4px;
        transform: translateX(-50%);
        z-index: 5;
    }
    
    .spiral-core {
        position: relative;
        height: 100%;
        width: 100%;
    }
    
    /* Animated gradient line */
    .spiral-line {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(180deg, 
            rgba(193, 123, 92, 0.2) 0%,
            var(--clay) 30%,
            var(--moss) 60%,
            rgba(76, 107, 74, 0.2) 100%);
        border-radius: 4px;
        animation: pulseGlow 3s ease-in-out infinite;
    }
    
    @keyframes pulseGlow {
        0%, 100% { opacity: 0.5; box-shadow: 0 0 10px rgba(193, 123, 92, 0.3); }
        50% { opacity: 1; box-shadow: 0 0 20px rgba(193, 123, 92, 0.6); }
    }
    
    /* Floating particles along the spiral */
    .spiral-particle {
        position: absolute;
        width: clamp(6px, 1vw, 8px);
        height: clamp(6px, 1vw, 8px);
        background: var(--clay);
        border-radius: 50%;
        left: 50%;
        transform: translateX(-50%);
        animation: floatParticle 4s ease-in-out infinite;
        opacity: 0.6;
    }
    
    .spiral-particle:nth-child(1) { top: 10%; animation-delay: 0s; }
    .spiral-particle:nth-child(2) { top: 30%; animation-delay: 1s; width: clamp(8px, 1.5vw, 12px); height: clamp(8px, 1.5vw, 12px); background: var(--moss); }
    .spiral-particle:nth-child(3) { top: 50%; animation-delay: 2s; }
    .spiral-particle:nth-child(4) { top: 70%; animation-delay: 3s; width: clamp(5px, 0.8vw, 6px); height: clamp(5px, 0.8vw, 6px); }
    .spiral-particle:nth-child(5) { top: 90%; animation-delay: 1.5s; background: var(--moss); }
    
    @keyframes floatParticle {
        0%, 100% { transform: translateX(-50%) translateY(0); opacity: 0.4; }
        50% { transform: translateX(-50%) translateY(-20px); opacity: 0.8; }
    }
    
    /* Spiral Steps Container */
    .spiral-steps {
        position: relative;
        z-index: 10;
    }
    
    /* Individual Step */
    .spiral-step {
        position: relative;
        margin-bottom: clamp(4rem, 8vw, 8rem);
        opacity: 0;
        transform: translateY(60px);
        transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .spiral-step.visible {
        opacity: 1;
        transform: translateY(0);
    }
    
    /* Step Connector */
    .step-connector {
        position: absolute;
        top: 50%;
        width: clamp(40px, 6vw, 80px);
        height: 2px;
        background: linear-gradient(90deg, var(--clay), transparent);
        transform: translateY(-50%);
        z-index: 8;
    }
    
    .step-left .step-connector {
        right: calc(-1 * clamp(20px, 3vw, 40px));
        background: linear-gradient(90deg, var(--clay), transparent);
    }
    
    .step-right .step-connector {
        left: calc(-1 * clamp(20px, 3vw, 40px));
        background: linear-gradient(90deg, transparent, var(--clay));
    }
    
    /* Step Number Badge */
    .step-badge {
        position: absolute;
        top: 50%;
        width: clamp(40px, 6vw, 50px);
        height: clamp(40px, 6vw, 50px);
        background: white;
        border: clamp(2px, 0.4vw, 3px) solid var(--clay);
        border-radius: 30% 50% 30% 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: clamp(1rem, 2vw, 1.3rem);
        color: var(--clay);
        transform: translateY(-50%);
        z-index: 15;
        box-shadow: 0 10px 20px -5px rgba(193, 123, 92, 0.3);
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .step-left .step-badge {
        right: calc(-1 * clamp(50px, 8vw, 65px));
    }
    
    .step-right .step-badge {
        left: calc(-1 * clamp(50px, 8vw, 65px));
    }
    
    .step-badge:hover {
        transform: translateY(-50%) scale(1.1);
        background: var(--clay);
        color: white;
        border-color: var(--moss);
    }
    
    /* Left and Right Step Positioning - FULLY RESPONSIVE */
    .step-left {
        width: min(45%, 550px);
        margin-right: auto;
    }
    
    .step-right {
        width: min(45%, 550px);
        margin-left: auto;
    }
    
    /* ===== PROFESSIONAL PROJECT CARD ===== */
    .project-card-premium {
        background: white;
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 30px 50px -20px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
        border: 1px solid rgba(193, 123, 92, 0.15);
        display: flex;
        flex-direction: row;
        height: clamp(280px, 25vw, 320px);
        position: relative;
        text-decoration: none;
        color: inherit;
        width: 100%;
    }
    
    /* Remove default link styles */
    .project-card-premium,
    .project-card-premium:hover,
    .project-card-premium:focus,
    .project-card-premium:visited {
        text-decoration: none;
        color: inherit;
    }
    
    /* Different border radii for alternating sides */
    .step-left .project-card-premium {
        border-radius: min(60px, 8vw) min(20px, 3vw) min(60px, 8vw) min(20px, 3vw);
    }
    
    .step-right .project-card-premium {
        border-radius: min(20px, 3vw) min(60px, 8vw) min(20px, 3vw) min(60px, 8vw);
    }
    
    /* Hover effect */
    .project-card-premium:hover {
        box-shadow: 0 40px 60px -15px rgba(193, 123, 92, 0.4);
        border-color: var(--clay);
    }
    
    /* Image Section - FIXED for proper image sizing */
    .card-image-section {
        flex: 0 0 45%;
        position: relative;
        overflow: hidden;
        background: linear-gradient(145deg, var(--clay-light), var(--clay));
        height: 100%;
    }
    
    .step-left .card-image-section {
        border-radius: min(60px, 8vw) 0 0 min(20px, 3vw);
    }
    
    .step-right .card-image-section {
        border-radius: 0 min(60px, 8vw) min(20px, 3vw) 0;
        order: 2;
    }
    
    /* FIXED: Image sizing - now fills completely */
    .card-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        display: block;
    }
    
    /* Image Placeholder - FIXED sizing */
    .image-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(145deg, var(--clay-light), var(--clay));
    }
    
    .image-placeholder i {
        font-size: clamp(3rem, 6vw, 4rem);
        color: white;
        opacity: 0.8;
    }
    
    /* Featured Badge */
    .featured-badge-premium {
        position: absolute;
        top: clamp(1rem, 2vw, 1.5rem);
        left: clamp(1rem, 2vw, 1.5rem);
        background: var(--clay);
        color: white;
        padding: clamp(0.3rem, 1vw, 0.5rem) clamp(0.8rem, 2vw, 1.5rem);
        border-radius: min(40px, 5vw) min(12px, 2vw) min(40px, 5vw) min(12px, 2vw);
        font-size: clamp(0.7rem, 1.5vw, 0.8rem);
        font-weight: 600;
        z-index: 20;
        box-shadow: 0 5px 15px rgba(193, 123, 92, 0.4);
        display: flex;
        align-items: center;
        gap: clamp(4px, 1vw, 8px);
        backdrop-filter: blur(5px);
        pointer-events: none;
        white-space: nowrap;
    }
    
    .step-right .featured-badge-premium {
        left: auto;
        right: clamp(1rem, 2vw, 1.5rem);
    }
    
    /* Content Section */
    .card-content-section {
        flex: 1;
        padding: clamp(1.2rem, 3vw, 2rem);
        display: flex;
        flex-direction: column;
        background: white;
        position: relative;
        overflow: hidden;
    }
    
    .step-left .card-content-section {
        border-radius: 0 min(20px, 3vw) min(60px, 8vw) 0;
    }
    
    .step-right .card-content-section {
        border-radius: min(20px, 3vw) 0 0 min(60px, 8vw);
    }
    
    /* Category Tag */
    .project-category {
        display: inline-block;
        background: rgba(193, 123, 92, 0.1);
        color: var(--clay);
        padding: clamp(0.2rem, 0.8vw, 0.3rem) clamp(0.6rem, 2vw, 1rem);
        border-radius: min(30px, 4vw) min(8px, 1.5vw) min(30px, 4vw) min(8px, 1.5vw);
        font-size: clamp(0.6rem, 1.5vw, 0.7rem);
        font-weight: 600;
        letter-spacing: clamp(0.5px, 0.2vw, 1px);
        margin-bottom: clamp(0.5rem, 1.5vw, 1rem);
        width: fit-content;
        border: 1px solid rgba(193, 123, 92, 0.2);
    }
    
    /* Title */
    .project-title-premium {
        font-size: clamp(1.2rem, 3vw, 1.6rem);
        font-weight: 700;
        color: var(--moss-deep);
        margin-bottom: clamp(0.4rem, 1.2vw, 0.8rem);
        font-family: 'Playfair Display', serif;
        line-height: 1.3;
        transition: color 0.3s ease;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .project-card-premium:hover .project-title-premium {
        color: var(--clay);
    }
    
    /* Description */
    .project-description-premium {
        color: #5a6b5a;
        margin-bottom: clamp(0.6rem, 2vw, 1.2rem);
        line-height: 1.5;
        font-size: clamp(0.85rem, 2vw, 0.95rem);
        flex: 1;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    /* Tech Stack */
    .project-tech-premium {
        display: flex;
        flex-wrap: wrap;
        gap: clamp(0.3rem, 1vw, 0.5rem);
        margin-bottom: clamp(0.6rem, 2vw, 1.2rem);
    }
    
    .tech-tag-premium {
        background: linear-gradient(145deg, var(--ash), white);
        padding: clamp(0.2rem, 0.8vw, 0.3rem) clamp(0.5rem, 1.5vw, 1rem);
        border-radius: min(30px, 4vw) min(8px, 1.5vw) min(30px, 4vw) min(8px, 1.5vw);
        font-size: clamp(0.6rem, 1.5vw, 0.7rem);
        font-weight: 600;
        color: var(--moss-deep);
        border: 1px solid var(--clay-light);
        transition: all 0.3s ease;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        pointer-events: none;
        white-space: nowrap;
    }
    
    /* Card Footer */
    .card-footer-premium {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: clamp(0.6rem, 1.5vw, 1rem);
        border-top: 2px dashed rgba(193, 123, 92, 0.2);
        margin-top: auto;
    }
    
    /* Project link button */
    .project-link-premium {
        font-weight: 700;
        color: var(--clay);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: clamp(4px, 1vw, 8px);
        transition: all 0.3s ease;
        font-size: clamp(0.85rem, 2vw, 1rem);
        padding: clamp(0.3rem, 1vw, 0.5rem) clamp(0.8rem, 2vw, 1.2rem);
        border-radius: min(30px, 4vw) min(8px, 1.5vw) min(30px, 4vw) min(8px, 1.5vw);
        background: rgba(193, 123, 92, 0.05);
        border: 1px solid var(--clay-light);
        cursor: pointer;
        z-index: 30;
        position: relative;
        white-space: nowrap;
    }
    
    .project-link-premium:hover {
        background: var(--clay);
        color: white;
        border-color: var(--clay);
        transform: translateY(-2px);
    }
    
    .project-link-premium i {
        transition: transform 0.3s ease;
        font-size: clamp(0.8rem, 2vw, 1rem);
    }
    
    .project-link-premium:hover i {
        transform: translateX(5px);
    }
    
    .project-date-premium {
        font-size: clamp(0.8rem, 2vw, 0.9rem);
        color: #8a9d8a;
        font-weight: 500;
        letter-spacing: clamp(0.5px, 0.2vw, 1px);
        white-space: nowrap;
    }
    
    /* ===== VIEW ALL BUTTON ===== */
    .view-all-container {
        text-align: center;
        margin: clamp(3rem, 8vw, 5rem) 0 clamp(2rem, 5vw, 3rem);
        position: relative;
        z-index: 20;
    }
    
    .btn-view-all {
        display: inline-flex;
        align-items: center;
        gap: clamp(0.6rem, 2vw, 1rem);
        background: white;
        color: var(--moss-deep);
        padding: clamp(0.8rem, 3vw, 1.2rem) clamp(1.5rem, 5vw, 3rem);
        border-radius: min(60px, 8vw) min(20px, 3vw) min(60px, 8vw) min(20px, 3vw);
        font-weight: 700;
        font-size: clamp(0.9rem, 2.5vw, 1.1rem);
        text-decoration: none;
        border: 2px solid var(--clay);
        transition: all 0.3s ease;
        box-shadow: 0 10px 20px -8px rgba(193, 123, 92, 0.3);
    }
    
    .btn-view-all:hover {
        background: var(--clay);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 20px 30px -10px var(--clay);
    }
    
    .btn-view-all i {
        transition: transform 0.3s ease;
        font-size: clamp(0.9rem, 2.5vw, 1.1rem);
    }
    
    .btn-view-all:hover i {
        transform: translateX(5px);
    }
    
    /* ===== RESPONSIVE BREAKPOINTS - MAINTAINING DESIGN ===== */
    
    /* Large Tablets */
    @media (max-width: 1024px) {
        .step-left,
        .step-right {
            width: min(48%, 500px);
        }
        
        .project-card-premium {
            height: clamp(260px, 22vw, 300px);
        }
    }
    
    /* Medium Tablets */
    @media (max-width: 768px) {
        .spiral-column {
            left: 30px;
        }
        
        .step-left,
        .step-right {
            width: calc(100% - 70px);
            margin-left: 70px;
        }
        
        .step-left .step-badge,
        .step-right .step-badge {
            left: -45px;
            right: auto;
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }
        
        .step-connector {
            display: none;
        }
        
        .project-card-premium {
            flex-direction: column;
            height: auto;
            min-height: 400px;
        }
        
        .step-left .project-card-premium,
        .step-right .project-card-premium {
            border-radius: min(40px, 6vw) min(12px, 2vw) min(40px, 6vw) min(12px, 2vw);
        }
        
        .card-image-section {
            flex: 0 0 200px;
            width: 100%;
            border-radius: min(40px, 6vw) min(40px, 6vw) 0 0 !important;
        }
        
        .step-left .card-image-section,
        .step-right .card-image-section {
            order: 0;
            border-radius: min(40px, 6vw) min(40px, 6vw) 0 0 !important;
        }
        
        .card-content-section {
            border-radius: 0 0 min(40px, 6vw) min(40px, 6vw) !important;
        }
        
        .featured-badge-premium {
            top: 1rem;
            left: 1rem;
            right: auto !important;
            font-size: 0.75rem;
            padding: 0.4rem 1rem;
        }
        
        .stat-item::after {
            display: none;
        }
        
        .project-title-premium {
            font-size: 1.3rem;
            -webkit-line-clamp: 2;
        }
        
        .project-description-premium {
            -webkit-line-clamp: 2;
            font-size: 0.9rem;
        }
    }
    
    /* Small Tablets & Large Phones */
    @media (max-width: 600px) {
        .step-left,
        .step-right {
            width: calc(100% - 60px);
            margin-left: 60px;
        }
        
        .step-left .step-badge,
        .step-right .step-badge {
            left: -38px;
            width: 35px;
            height: 35px;
            font-size: 0.9rem;
            border-width: 2px;
        }
        
        .card-image-section {
            flex: 0 0 180px;
        }
        
        .card-content-section {
            padding: 1.2rem;
        }
        
        .project-title-premium {
            font-size: 1.2rem;
        }
        
        .project-tech-premium {
            gap: 0.3rem;
        }
        
        .tech-tag-premium {
            padding: 0.2rem 0.6rem;
            font-size: 0.65rem;
        }
    }
    
    /* Mobile Phones */
    @media (max-width: 480px) {
        .projects-header h1 {
            font-size: 2.2rem;
        }
        
        .spiral-column {
            left: 20px;
        }
        
        .step-left,
        .step-right {
            width: calc(100% - 50px);
            margin-left: 50px;
        }
        
        .step-left .step-badge,
        .step-right .step-badge {
            left: -32px;
            width: 30px;
            height: 30px;
            font-size: 0.8rem;
            border-width: 2px;
        }
        
        .card-image-section {
            flex: 0 0 160px;
        }
        
        .card-content-section {
            padding: 1rem;
        }
        
        .project-title-premium {
            font-size: 1.1rem;
            margin-bottom: 0.3rem;
        }
        
        .project-description-premium {
            font-size: 0.85rem;
            margin-bottom: 0.5rem;
            -webkit-line-clamp: 2;
        }
        
        .project-tech-premium {
            margin-bottom: 0.5rem;
        }
        
        .tech-tag-premium {
            padding: 0.15rem 0.5rem;
            font-size: 0.6rem;
        }
        
        .card-footer-premium {
            padding-top: 0.5rem;
        }
        
        .project-link-premium {
            font-size: 0.8rem;
            padding: 0.3rem 0.8rem;
        }
        
        .project-date-premium {
            font-size: 0.75rem;
        }
        
        .btn-view-all {
            padding: 0.8rem 1.5rem;
            font-size: 0.9rem;
        }
    }
    
    /* Very Small Phones */
    @media (max-width: 360px) {
        .step-left,
        .step-right {
            width: calc(100% - 45px);
            margin-left: 45px;
        }
        
        .step-left .step-badge,
        .step-right .step-badge {
            left: -28px;
            width: 25px;
            height: 25px;
            font-size: 0.7rem;
        }
        
        .card-image-section {
            flex: 0 0 140px;
        }
        
        .project-title-premium {
            font-size: 1rem;
        }
        
        .project-description-premium {
            font-size: 0.8rem;
            -webkit-line-clamp: 2;
        }
        
        .project-link-premium {
            font-size: 0.75rem;
            padding: 0.2rem 0.6rem;
        }
        
        .project-date-premium {
            font-size: 0.7rem;
        }
    }
    
    /* Landscape Mode */
    @media (orientation: landscape) and (max-height: 600px) {
        .project-card-premium {
            height: 250px;
        }
        
        .card-image-section {
            flex: 0 0 40%;
        }
        
        .project-title-premium {
            font-size: 1.1rem;
        }
        
        .project-description-premium {
            font-size: 0.85rem;
            -webkit-line-clamp: 2;
        }
    }
</style>
@endpush

@section('content')
@php
    $projects = \App\Models\Project::where('is_published', true)
        ->orderBy('is_featured', 'desc')
        ->orderBy('sort_order')
        ->orderBy('created_at', 'desc')
        ->get();
    
    $totalProjects = $projects->count();
    $featuredCount = $projects->where('is_featured', true)->count();
    
    // Collect all unique technologies
    $allTechnologies = collect();
    foreach ($projects as $project) {
        if ($project->technologies) {
            $techs = is_string($project->technologies) 
                ? array_map('trim', explode(',', $project->technologies)) 
                : ($project->technologies ?? []);
            foreach ($techs as $tech) {
                $allTechnologies->push($tech);
            }
        }
    }
    $uniqueTechnologies = $allTechnologies->unique();
@endphp

<div class="container">
    <div class="projects-header">
        <h1>{{ theme_setting('projects_page_title', 'cultivated projects') }}</h1>
        <p class="subtitle">{{ theme_setting('projects_page_subtitle', 'Each project is a step in the journey, ascending like a spiral staircase through seasons of growth.') }}</p>
    </div>
    
    <div class="projects-stats">
        <div class="stat-item">
            <div class="stat-number">{{ $totalProjects }}</div>
            <div class="stat-label">{{ theme_setting('total_projects_label', 'total projects') }}</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $featuredCount }}</div>
            <div class="stat-label">{{ theme_setting('featured_label', 'featured') }}</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">{{ $uniqueTechnologies->count() }}+</div>
            <div class="stat-label">{{ theme_setting('technologies_label', 'technologies') }}</div>
        </div>
    </div>
    
    @if($projects->count() > 0)
        <!-- Spiral Staircase Container -->
        <div class="spiral-container">
            <!-- Central Spiral Column -->
            <div class="spiral-column">
                <div class="spiral-core">
                    <div class="spiral-line"></div>
                    <div class="spiral-particle"></div>
                    <div class="spiral-particle"></div>
                    <div class="spiral-particle"></div>
                    <div class="spiral-particle"></div>
                    <div class="spiral-particle"></div>
                </div>
            </div>
            
            <!-- Spiral Steps -->
            <div class="spiral-steps">
                @foreach($projects as $index => $project)
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
                        
                        $year = $project->created_at ? $project->created_at->format('Y') : date('Y');
                        $position = ($index % 2 == 0) ? 'step-left' : 'step-right';
                        $stepNumber = $index + 1;
                        
                        // Random category for demo (you can replace with actual category)
                        $categories = ['Web App', 'Mobile', 'UI/UX', 'Backend', 'Full Stack', 'Open Source'];
                        $category = $categories[array_rand($categories)];
                    @endphp
                    
                    <div class="spiral-step {{ $position }}" id="step-{{ $stepNumber }}">
                        <!-- Step Badge -->
                        <div class="step-badge">{{ $stepNumber }}</div>
                        
                        <!-- Connector Line -->
                        <div class="step-connector"></div>
                        
                        <!-- Entire card links to project detail -->
                        <a href="{{ route('projects.show', $project->slug) }}" class="project-card-premium">
                            @if($position == 'step-left')
                                <!-- Image on left for left steps -->
                                <div class="card-image-section">
                                    @if($projectImage)
                                        <img src="{{ $projectImage }}" alt="{{ $project->title }}" class="card-image" loading="lazy">
                                    @else
                                        <div class="image-placeholder">
                                            <i class="fas fa-code-branch"></i>
                                        </div>
                                    @endif
                                    
                                    @if($project->is_featured)
                                        <span class="featured-badge-premium">
                                            <i class="fas fa-star"></i> Featured
                                        </span>
                                    @endif
                                </div>
                                
                                <!-- Content on right for left steps -->
                                <div class="card-content-section">
                                    <span class="project-category">{{ $category }}</span>
                                    <h3 class="project-title-premium">{{ $project->title }}</h3>
                                    <p class="project-description-premium">{{ Str::limit($project->description, 120) }}</p>
                                    
                                    @if(count($techs) > 0)
                                    <div class="project-tech-premium">
                                        @foreach(array_slice($techs, 0, 4) as $tech)
                                            <span class="tech-tag-premium">{{ $tech }}</span>
                                        @endforeach
                                        @if(count($techs) > 4)
                                            <span class="tech-tag-premium">+{{ count($techs) - 4 }}</span>
                                        @endif
                                    </div>
                                    @endif
                                    
                                    <div class="card-footer-premium">
                                        <span class="project-link-premium" onclick="event.preventDefault(); window.location='{{ route('projects.show', $project->slug) }}';">
                                            <span>View Case Study</span>
                                            <i class="fas fa-arrow-right"></i>
                                        </span>
                                        <span class="project-date-premium">{{ $year }}</span>
                                    </div>
                                </div>
                            @else
                                <!-- Content on left for right steps -->
                                <div class="card-content-section">
                                    <span class="project-category">{{ $category }}</span>
                                    <h3 class="project-title-premium">{{ $project->title }}</h3>
                                    <p class="project-description-premium">{{ Str::limit($project->description, 120) }}</p>
                                    
                                    @if(count($techs) > 0)
                                    <div class="project-tech-premium">
                                        @foreach(array_slice($techs, 0, 4) as $tech)
                                            <span class="tech-tag-premium">{{ $tech }}</span>
                                        @endforeach
                                        @if(count($techs) > 4)
                                            <span class="tech-tag-premium">+{{ count($techs) - 4 }}</span>
                                        @endif
                                    </div>
                                    @endif
                                    
                                    <div class="card-footer-premium">
                                        <span class="project-link-premium" onclick="event.preventDefault(); window.location='{{ route('projects.show', $project->slug) }}';">
                                            <span>View Case Study</span>
                                            <i class="fas fa-arrow-right"></i>
                                        </span>
                                        <span class="project-date-premium">{{ $year }}</span>
                                    </div>
                                </div>
                                
                                <!-- Image on right for right steps -->
                                <div class="card-image-section">
                                    @if($projectImage)
                                        <img src="{{ $projectImage }}" alt="{{ $project->title }}" class="card-image" loading="lazy">
                                    @else
                                        <div class="image-placeholder">
                                            <i class="fas fa-code-branch"></i>
                                        </div>
                                    @endif
                                    
                                    @if($project->is_featured)
                                        <span class="featured-badge-premium">
                                            <i class="fas fa-star"></i> Featured
                                        </span>
                                    @endif
                                </div>
                            @endif
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        
        <!-- View All Button -->
        <div class="view-all-container">
            <a href="{{ route('projects.index') }}" class="btn-view-all">
                <span>Explore All Projects</span>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    @else
        <!-- Empty State -->
        <div class="empty-state-premium">
            <i class="fas fa-seedling"></i>
            <h3>{{ theme_setting('no_projects_title', 'cultivating new projects') }}</h3>
            <p>{{ theme_setting('no_projects_message', 'Seeds have been planted. New projects are germinating and will emerge soon.') }}</p>
        </div>
    @endif
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Intersection Observer for scroll animations
        const steps = document.querySelectorAll('.spiral-step');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { 
            threshold: 0.3,
            rootMargin: '0px 0px -50px 0px'
        });
        
        steps.forEach(step => {
            observer.observe(step);
        });
        
        // Parallax effect for spiral particles
        window.addEventListener('scroll', () => {
            const scrollY = window.scrollY;
            const particles = document.querySelectorAll('.spiral-particle');
            
            particles.forEach((particle, index) => {
                const speed = 0.2 + (index * 0.1);
                const yPos = scrollY * speed;
                particle.style.transform = `translateX(-50%) translateY(${yPos}px)`;
            });
        });
        
        // Smooth scroll to steps when clicking on step badges
        const badges = document.querySelectorAll('.step-badge');
        badges.forEach((badge, index) => {
            badge.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                const step = document.getElementById(`step-${index + 1}`);
                if (step) {
                    step.scrollIntoView({ 
                        behavior: 'smooth',
                        block: 'center'
                    });
                }
            });
        });
        
        // Handle project link button clicks
        const projectLinks = document.querySelectorAll('.project-link-premium');
        projectLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                const card = this.closest('.project-card-premium');
                if (card && card.href) {
                    window.location.href = card.href;
                }
            });
        });
    });
</script>
@endpush
@endsection