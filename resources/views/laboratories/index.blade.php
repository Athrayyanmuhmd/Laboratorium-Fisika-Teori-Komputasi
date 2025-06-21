<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laboratorium Fisika Komputasi - FMIPA Universitas Syiah Kuala</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Notification Script -->
    <script src="{{ asset('js/notifications.js') }}"></script>
    
    <style>
        * {
            transition: background-color 0.4s cubic-bezier(0.4, 0, 0.2, 1), 
                       color 0.4s cubic-bezier(0.4, 0, 0.2, 1), 
                       border-color 0.4s cubic-bezier(0.4, 0, 0.2, 1),
                       box-shadow 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            font-weight: 400;
            letter-spacing: -0.01em;
        }
        
        .glassmorphism {
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            background: rgba(30, 41, 59, 0.05);
            border: 1px solid rgba(30, 41, 59, 0.1);
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #1e293b 0%, #334155 50%, #475569 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .btn-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .btn-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .card-hover {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card-hover:hover {
            transform: translateY(-8px) scale(1.02);
        }
        
        .typing-text {
            border-right: 3px solid #334155;
            animation: blink 1s infinite;
        }
        
        @keyframes blink {
            0%, 50% { border-color: #334155; }
            51%, 100% { border-color: transparent; }
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in {
            animation: fadeInUp 0.8s ease forwards;
        }
        
        .icon-minimal {
            font-size: 2rem;
            transition: all 0.3s ease;
        }
        
        .icon-minimal:hover {
            transform: scale(1.1) rotate(5deg);
        }
        
        .navbar-shadow {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        .pulse-dot {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { 
                opacity: 1;
                transform: scale(1);
            }
            50% { 
                opacity: 0.8;
                transform: scale(1.05);
            }
        }
        
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="%23667eea" stroke-width="0.5" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
            animation: gridMove 20s linear infinite;
        }
        
        @keyframes gridMove {
            0% { transform: translate(0, 0); }
            100% { transform: translate(10px, 10px); }
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
            text-align: left;
        }
        
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            padding: 0.5rem 1.5rem;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 2rem;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }
        
        .hero-badge:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
        }
        
        .status-dot {
            width: 8px;
            height: 8px;
            background: #10b981;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        
        .hero h1 {
            font-size: 4.5rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #1e293b 0%, #334155 50%, #475569 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .typing-text {
            display: inline-block;
            border-right: 3px solid #1e293b;
            animation: blink 1s infinite;
        }
        
        @keyframes blink {
            0%, 50% { border-color: #1e293b; }
            51%, 100% { border-color: transparent; }
        }
        
        .hero .subtitle {
            font-size: 1.5rem;
            color: #475569;
            margin-bottom: 1rem;
            font-weight: 600;
            font-family: 'Montserrat', sans-serif;
        }
        
        .hero p {
            font-size: 1.2rem;
            color: #6b7280;
            max-width: 600px;
            margin-bottom: 3rem;
            line-height: 1.6;
        }
        
        .hero-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .stat-item {
            background: rgba(30, 41, 59, 0.05);
            border: 1px solid rgba(30, 41, 59, 0.1);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            backdrop-filter: blur(10px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .stat-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(30, 41, 59, 0.1), transparent);
            transition: left 0.6s ease;
        }
        
        .stat-item:hover::before {
            left: 100%;
        }
        
        .stat-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(30, 41, 59, 0.2);
            border-color: rgba(30, 41, 59, 0.3);
        }
        
        .stat-number {
            font-size: 3rem;
            font-weight: 800;
            background: linear-gradient(135deg, #1e293b 0%, #334155 50%, #475569 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: block;
            font-family: 'Montserrat', sans-serif;
        }
        
        .stat-label {
            font-size: 1rem;
            color: #6b7280;
            margin-top: 0.5rem;
            font-weight: 500;
        }
        
        .services-section {
            padding: 8rem 0;
            position: relative;
        }
        
        .section-title {
            text-align: center;
            font-size: 3.5rem;
            margin-bottom: 4rem;
            font-weight: 700;
            font-family: 'Montserrat', sans-serif;
            letter-spacing: -0.02em;
            background: linear-gradient(135deg, #1e293b 0%, #334155 50%, #475569 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 2rem;
        }
        
        .service-card {
            background: rgba(30, 41, 59, 0.05);
            border: 1px solid rgba(30, 41, 59, 0.1);
            border-radius: 24px;
            padding: 3rem;
            backdrop-filter: blur(10px);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            group: hover;
        }
        
        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #1e293b 0%, #334155 50%, #475569 100%);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }
        
        .service-card:hover::before {
            transform: scaleX(1);
        }
        
        .service-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 30px 80px rgba(30, 41, 59, 0.15);
            border-color: rgba(30, 41, 59, 0.3);
            background: rgba(30, 41, 59, 0.08);
        }
        
        .service-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #1e293b 0%, #334155 50%, #475569 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }
        
        .service-card:hover .service-icon {
            transform: rotate(10deg) scale(1.1);
            box-shadow: 0 15px 40px rgba(30, 41, 59, 0.4);
        }
        
        .service-icon::before {
            content: '';
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 8px;
        }
        
        .service-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #1e293b;
            font-family: 'Montserrat', sans-serif;
            letter-spacing: -0.01em;
        }
        
        .service-description {
            color: #6b7280;
            line-height: 1.6;
            font-size: 1rem;
        }
        
        .cta-section {
            text-align: center;
            padding: 6rem 0;
            background: rgba(30, 41, 59, 0.03);
            border-radius: 40px;
            margin: 4rem 0;
            border: 1px solid rgba(30, 41, 59, 0.1);
        }
        
        .cta-title {
            font-size: 3rem;
            margin-bottom: 1rem;
            font-weight: 700;
            font-family: 'Montserrat', sans-serif;
            letter-spacing: -0.02em;
            background: linear-gradient(135deg, #1e293b 0%, #334155 50%, #475569 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .cta-buttons {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-top: 3rem;
            flex-wrap: wrap;
        }
        
        .btn {
            padding: 1.2rem 3rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            font-family: 'Montserrat', sans-serif;
            letter-spacing: 0.01em;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 2px solid transparent;
            color: white;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            position: relative;
            overflow: hidden;
        }
        
        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s ease;
        }
        
        .btn:hover::before {
            left: 100%;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #1e293b 0%, #334155 50%, #475569 100%);
            border-color: rgba(30, 41, 59, 0.5);
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 50px rgba(30, 41, 59, 0.4);
        }
        
        .btn-secondary {
            background: rgba(30, 41, 59, 0.1);
            border-color: rgba(30, 41, 59, 0.3);
            backdrop-filter: blur(10px);
            color: #1e293b;
        }
        
        .btn-secondary:hover {
            background: rgba(30, 41, 59, 0.2);
            transform: translateY(-3px);
            box-shadow: 0 15px 50px rgba(30, 41, 59, 0.2);
        }
        
        .facilities-section {
            padding: 6rem 0;
        }
        
        .facilities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 3rem;
        }
        
        .facility-item {
            background: rgba(30, 41, 59, 0.05);
            border: 1px solid rgba(30, 41, 59, 0.1);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            backdrop-filter: blur(10px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .facility-item::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: radial-gradient(circle, rgba(30, 41, 59, 0.1) 0%, transparent 70%);
            transform: translate(-50%, -50%);
            transition: all 0.3s ease;
        }
        
        .facility-item:hover::after {
            width: 300px;
            height: 300px;
        }
        
        .facility-item:hover {
            transform: translateY(-8px);
            border-color: rgba(30, 41, 59, 0.3);
            box-shadow: 0 20px 60px rgba(30, 41, 59, 0.15);
        }
        
        /* Minimalist Glassmorphism Footer */
        .footer {
            background: rgba(30, 41, 59, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-top: 1px solid rgba(71, 85, 105, 0.3);
            padding: 2rem 0 1.5rem;
            margin-top: 4rem;
            position: relative;
        }
        
        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(71, 85, 105, 0.1) 0%, rgba(51, 65, 85, 0.05) 100%);
            z-index: -1;
        }
        
        .footer-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 1.5rem;
        }
        
        .footer-main {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 2rem;
            margin-bottom: 1rem;
        }
        
        .footer-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 1.1rem;
            font-weight: 600;
            color: #ffffff;
        }
        
        .footer-links {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .footer-link {
            color: #e2e8f0;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            position: relative;
            overflow: hidden;
        }
        
        .footer-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.6s ease;
        }
        
        .footer-link:hover::before {
            left: 100%;
        }
        
        .footer-link:hover {
            color: #ffffff;
            background: rgba(71, 85, 105, 0.2);
        }
        
        .footer-divider {
            width: 100%;
            max-width: 300px;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            margin: 0.5rem 0;
        }
        
        .footer-copyright {
            color: #cbd5e1;
            font-size: 0.85rem;
            font-weight: 400;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in {
            animation: fadeInUp 0.8s ease forwards;
        }
        
        .loading-bar {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 3px;
            background: var(--primary-gradient);
            z-index: 9999;
            transition: width 0.3s ease;
        }
        


        /* ===== LUXURY ENHANCEMENTS ===== */
        
        /* Clean Background */
        .luxury-bg {
            position: relative;
            overflow: hidden;
        }

        /* Grid backgrounds removed */

        /* Physics Elements Section Styles */
        .marquee-container {
            position: relative;
            overflow: hidden;
        }

        .marquee-content {
            animation: marqueeScroll 40s linear infinite;
        }

        .marquee-text {
            display: inline-block;
        }

        @keyframes marqueeScroll {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }

        .physics-icon-container {
            transition: all 0.3s ease;
        }

        .physics-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, rgba(71, 85, 105, 0.05), rgba(71, 85, 105, 0.1));
            border: 1px solid rgba(71, 85, 105, 0.1);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .physics-icon::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(71, 85, 105, 0.1), transparent);
            transition: left 0.6s ease;
        }

        .physics-icon-container:hover .physics-icon {
            transform: translateY(-8px) scale(1.05);
            box-shadow: 0 20px 40px rgba(71, 85, 105, 0.15);
            border-color: rgba(71, 85, 105, 0.3);
            background: linear-gradient(135deg, rgba(71, 85, 105, 0.1), rgba(71, 85, 105, 0.15));
        }

        .physics-icon-container:hover .physics-icon::before {
            left: 100%;
        }

        .physics-icon-container:hover .physics-icon svg {
            transform: scale(1.1);
            color: #1e293b;
        }

        .research-area {
            transition: all 0.3s ease;
        }

        .research-area:hover {
            transform: translateY(-5px);
        }

        .research-area .bg-gradient-to-br {
            position: relative;
            overflow: hidden;
        }

        .research-area .bg-gradient-to-br::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(71, 85, 105, 0.1), transparent);
            transition: left 0.6s ease;
        }

        .research-area:hover .bg-gradient-to-br::before {
            left: 100%;
        }

        /* Symbol animations */
        .research-area .text-4xl {
            transition: all 0.3s ease;
            display: inline-block;
        }

        .research-area:hover .text-4xl {
            transform: scale(1.2) rotate(5deg);
        }

        /* Enhanced Glassmorphism */
        .glass-luxury {
            background: rgba(71, 85, 105, 0.08);
            backdrop-filter: blur(25px);
            -webkit-backdrop-filter: blur(25px);
            border: 1px solid rgba(71, 85, 105, 0.2);
            box-shadow: 
                0 8px 32px 0 rgba(71, 85, 105, 0.15),
                inset 0 1px 0 rgba(71, 85, 105, 0.1),
                inset 0 -1px 0 rgba(71, 85, 105, 0.05);
        }

        /* Advanced Card Effects */
        .card-luxury {
            transition: all 0.6s cubic-bezier(0.23, 1, 0.320, 1);
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
        }

        .card-luxury::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(71, 85, 105, 0.2), transparent);
            transition: left 0.8s ease;
            z-index: 1;
        }

        .card-luxury:hover {
            transform: translateY(-20px) rotateX(5deg) rotateY(-5deg);
            box-shadow: 
                0 35px 80px -12px rgba(0, 0, 0, 0.25),
                0 0 0 1px rgba(71, 85, 105, 0.2),
                0 0 60px rgba(71, 85, 105, 0.15);
        }

        .card-luxury:hover::before {
            left: 100%;
        }

        /* Button Magic Effect */
        .btn-luxury {
            position: relative;
            background: linear-gradient(45deg, #1e293b, #334155);
            border: none;
            overflow: hidden;
            transform-style: preserve-3d;
        }

        .btn-luxury::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s ease;
            z-index: 1;
        }

        .btn-luxury:hover::before {
            left: 100%;
        }

        .btn-luxury:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 
                0 25px 50px rgba(30, 41, 59, 0.4),
                0 0 30px rgba(71, 85, 105, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }

        /* Section Dividers */
        .section-divider {
            height: 2px;
            background: linear-gradient(90deg, transparent, #475569, transparent);
            margin: 4rem 0;
            position: relative;
            overflow: hidden;
            border-radius: 1px;
        }

        .section-divider::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(71, 85, 105, 0.6), transparent);
            animation: shimmer 3s infinite;
        }

        /* Particles Animation */
        .particles-container {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            background: radial-gradient(circle, rgba(71, 85, 105, 0.8) 0%, rgba(71, 85, 105, 0) 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        /* Icon Rotation Effect */
        .icon-luxury {
            transition: all 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            filter: drop-shadow(0 0 0 rgba(71, 85, 105, 0));
        }

        .icon-luxury:hover {
            transform: rotate(360deg) scale(1.3);
            filter: drop-shadow(0 0 30px rgba(71, 85, 105, 0.8));
        }

        /* Status Indicator Enhancement */
        .status-luxury {
            position: relative;
            display: inline-block;
        }

        .status-luxury::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 25px;
            height: 25px;
            background: rgba(34, 197, 94, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            animation: rippleLuxury 2s infinite;
        }

        .status-luxury::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 35px;
            height: 35px;
            background: rgba(34, 197, 94, 0.1);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            animation: rippleLuxury 2s infinite 1s;
        }

        @keyframes rippleLuxury {
            0% {
                transform: translate(-50%, -50%) scale(0.3);
                opacity: 1;
            }
            100% {
                transform: translate(-50%, -50%) scale(2.5);
                opacity: 0;
            }
        }

        /* Scroll Reveal Animation */
        .reveal-luxury {
            opacity: 0;
            transform: translateY(80px) scale(0.95);
            transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .reveal-luxury.revealed {
            opacity: 1;
            transform: translateY(0) scale(1);
        }

        /* Navigation Enhancement */
        .nav-luxury {
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            background: rgba(30, 64, 175, 0.95);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 
                0 10px 40px rgba(0, 0, 0, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            /* Logo Mobile Styles */
            .navbar-logo {
                height: 2rem;
            }
            
            /* Service Cards Mobile */
            .glass-luxury {
                margin-bottom: 1.5rem;
            }
            
            .card-luxury:hover {
                transform: translateY(-10px);
                box-shadow: 
                    0 20px 40px -12px rgba(0, 0, 0, 0.25),
                    0 0 0 1px rgba(71, 85, 105, 0.2);
            }
            
            /* Button Mobile */
            .btn-luxury:hover {
                transform: translateY(-3px) scale(1.02);
            }
            
            /* Icon Mobile Sizing */
            .w-20.h-20 {
                width: 4rem;
                height: 4rem;
            }
            
            .w-16.h-16 {
                width: 3.5rem;
                height: 3.5rem;
            }
            
            /* Typography Mobile */
            .text-3xl {
                font-size: 1.75rem;
            }
            
            .text-2xl {
                font-size: 1.5rem;
            }
            
            /* Spacing Mobile */
            .p-8 {
                padding: 1.5rem;
            }
            
            .mb-16 {
                margin-bottom: 2rem;
            }
            
            .py-16 {
                padding-top: 2rem;
                padding-bottom: 2rem;
                max-width: 160px;
            }
            
            .footer-logo {
                height: 1.75rem;
                max-width: 120px;
            }
            
            /* Grid backgrounds removed */
            
            /* Physics Elements Section Mobile */
            .physics-section-mobile {
                padding: 2rem 0 !important;
            }
            
            .physics-section-title {
                font-size: 1.5rem !important;
                margin-bottom: 1.5rem !important;
                text-align: center !important;
                color: #1e293b !important;
                font-weight: 700 !important;
                padding: 0 1rem !important;
                line-height: 1.3 !important;
            }
            
            /* Mobile section title for extra small screens */
            @media (max-width: 480px) {
                .physics-section-title {
                    font-size: 1.25rem !important;
                    margin-bottom: 1rem !important;
                }
            }
            
            .gradient-animated {
                background-size: 200% 200%;
            }
            
            .card-luxury:hover {
                transform: translateY(-10px) scale(1.02);
            }
            
            /* Typography Mobile */
            .section-title {
                font-size: 2.5rem !important;
                margin-bottom: 2rem !important;
            }
            
            .hero h1 {
                font-size: 2.5rem !important;
                line-height: 1.2 !important;
            }
            
            .hero p {
                font-size: 1rem !important;
                margin-bottom: 2rem !important;
            }
            
            /* Typing text mobile visibility */
            .typing-luxury {
                color: #1e293b !important;
                text-shadow: 0 3px 6px rgba(30, 41, 59, 0.4) !important;
                font-weight: 900 !important;
                -webkit-text-fill-color: #1e293b !important;
                background: none !important;
                text-rendering: optimizeLegibility !important;
            }
            
            /* Remove gradient from mobile */
            .gradient-animated {
                color: #1e293b !important;
                background: none !important;
                -webkit-background-clip: unset !important;
                -webkit-text-fill-color: #1e293b !important;
                background-clip: unset !important;
            }
            
            /* Services Grid Mobile */
            .services-grid {
                grid-template-columns: 1fr !important;
                gap: 1.5rem !important;
            }
            
            .service-card {
                padding: 2rem !important;
            }
            
            .service-title {
                font-size: 1.25rem !important;
            }
            
            /* Facilities Grid Mobile */
            .facilities-grid {
                grid-template-columns: 1fr !important;
                gap: 1.5rem !important;
            }
            
            .facility-item {
                padding: 1.5rem !important;
            }
            
            /* Stats Grid Mobile */
            .grid {
                grid-template-columns: 1fr !important;
                gap: 1rem !important;
            }
            
            /* Hero Mobile */
            .hero {
                min-height: 80vh !important;
                padding: 2rem 0 !important;
            }
            
            /* Hero Title Mobile */
            .hero-title-enhanced {
                font-size: 3rem !important;
                line-height: 1.2 !important;
                letter-spacing: -0.01em !important;
                padding: 0.75rem 0 !important;
                margin-bottom: 1.5rem !important;
            }
            
            /* Ensure text fits properly */
            .hero h1 {
                word-wrap: break-word !important;
                overflow-wrap: break-word !important;
                hyphens: auto !important;
            }
            
            /* CTA Buttons Mobile */
            .cta-buttons {
                flex-direction: column !important;
                gap: 1rem !important;
            }
            
            .btn-luxury, .btn {
                width: 100% !important;
                justify-content: center !important;
            }
            
            /* Footer Mobile */
            .footer-main {
                flex-direction: column !important;
                gap: 1.5rem !important;
                margin-bottom: 1.5rem !important;
            }
            
            .footer-links {
                gap: 1rem !important;
                justify-content: center !important;
            }
            
            .footer-link {
                font-size: 0.85rem !important;
                padding: 0.4rem 0.8rem !important;
            }
            
            .footer-brand {
                font-size: 1rem !important;
                gap: 0.5rem !important;
            }
            
            .footer-copyright {
                font-size: 0.8rem !important;
                text-align: center !important;
                line-height: 1.4 !important;
            }
            
            /* Navigation Mobile */
            .nav-links {
                display: none !important;
            }
            
            /* Sections Mobile */
            .services-section, .facilities-section {
                padding: 2rem 0 !important;
            }
            
            .cta-section {
                padding: 3rem 1rem !important;
                margin: 2rem 0 !important;
            }
            
            .cta-title {
                font-size: 2rem !important;
            }
            
            /* Badge Mobile */
            .glass-luxury {
                padding: 0.75rem 1.5rem !important;
                font-size: 0.875rem !important;
            }
            
            /* Hero content mobile */
            .hero .text-2xl {
                font-size: 1.25rem !important;
            }
            
            /* Mobile menu animation */
            #mobile-menu {
                transition: all 0.3s ease-in-out;
            }
            
            /* Particles mobile optimization */
            .particles-container {
                display: none !important;
            }
            

            
            /* Physics elements mobile */
            .marquee-container {
                padding: 0.75rem 0 !important;
            }
            
            .marquee-text {
                font-size: 1rem !important;
            }
            
            /* Physics Icons Grid Mobile Enhancement */
            .physics-icons-grid {
                grid-template-columns: repeat(3, 1fr) !important;
                gap: 1rem !important;
                max-width: 100% !important;
                margin: 0 auto !important;
                padding: 1rem !important;
                background: rgba(59, 130, 246, 0.02) !important;
                border-radius: 16px !important;
                border: 1px solid rgba(59, 130, 246, 0.08) !important;
                align-items: stretch !important;
                justify-items: stretch !important;
            }
            
            .physics-icon-container {
                display: flex !important;
                flex-direction: column !important;
                align-items: center !important;
                justify-content: center !important;
                text-align: center !important;
                padding: 0.75rem !important;
                background: rgba(255, 255, 255, 0.8) !important;
                border-radius: 12px !important;
                border: 1px solid rgba(59, 130, 246, 0.15) !important;
                transition: all 0.3s ease !important;
                min-height: 110px !important;
                max-height: 110px !important;
                height: 110px !important;
                width: 100% !important;
                box-shadow: 0 2px 8px rgba(59, 130, 246, 0.06) !important;
                backdrop-filter: blur(10px) !important;
                -webkit-backdrop-filter: blur(10px) !important;
                position: relative !important;
                overflow: hidden !important;
            }
            
            .physics-icon-container:hover {
                background: rgba(255, 255, 255, 0.95) !important;
                border-color: rgba(59, 130, 246, 0.25) !important;
                transform: translateY(-2px) scale(1.02) !important;
                box-shadow: 0 8px 25px rgba(59, 130, 246, 0.15) !important;
            }
            
            .physics-icon {
                width: 48px !important;
                height: 48px !important;
                border-radius: 10px !important;
                margin-bottom: 0.5rem !important;
                background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(59, 130, 246, 0.15)) !important;
                border: 1px solid rgba(59, 130, 246, 0.15) !important;
                flex-shrink: 0 !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
            }
            
            .physics-icon svg {
                width: 1.5rem !important;
                height: 1.5rem !important;
                color: #1e293b !important;
            }
            
            .physics-icon-container p {
                font-size: 0.7rem !important;
                line-height: 1.2 !important;
                font-weight: 600 !important;
                color: #374151 !important;
                margin: 0 !important;
                text-align: center !important;
                word-wrap: break-word !important;
                hyphens: auto !important;
                display: block !important;
                width: 100% !important;
                overflow: hidden !important;
                text-overflow: ellipsis !important;
            }
            
            /* Research Areas Mobile */
            .research-areas-grid {
                grid-template-columns: 1fr !important;
                gap: 1rem !important;
            }
            
            .research-area .bg-gradient-to-br {
                padding: 1.25rem !important;
                border-radius: 1rem !important;
                text-align: center !important;
            }
            
            .research-area .text-3xl, .research-area .text-4xl {
                font-size: 1.75rem !important;
                margin-bottom: 0.75rem !important;
            }
            
            .research-area h3 {
                font-size: 1rem !important;
                margin-bottom: 0.5rem !important;
            }
            
            .research-area p {
                font-size: 0.8rem !important;
                line-height: 1.4 !important;
            }
        }
        
        /* Extra Small Mobile */
        @media (max-width: 480px) {
            /* Logo Extra Small Mobile */
            .navbar-logo {
                height: 1.75rem;
                max-width: 140px;
            }
            
            .footer-logo {
                height: 1.5rem;
                max-width: 100px;
            }
            
            .hero h1 {
                font-size: 2rem !important;
            }
            
            .section-title {
                font-size: 2rem !important;
            }
            
            .service-card, .facility-item {
                padding: 1.5rem !important;
            }
            
            .stat-number {
                font-size: 2rem !important;
            }
            
            .glass-luxury {
                backdrop-filter: blur(15px) !important;
            }
            
            /* Simplify grid on very small screens */
            .grid-background {
                background-size: 40px 40px !important;
                opacity: 0.2 !important;
            }
            
            .dots-pattern {
                background-size: 25px 25px !important;
                opacity: 0.2 !important;
            }
            
            /* Physics elements extra small mobile */
            .marquee-container {
                padding: 0.5rem 0 !important;
            }
            
            .marquee-text {
                font-size: 0.875rem !important;
            }
            
            /* Extra Small Mobile Physics Icons */
            .physics-icons-grid {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 0.75rem !important;
                padding: 0.75rem !important;
                margin: 0 0.5rem !important;
                background: rgba(59, 130, 246, 0.02) !important;
                border-radius: 12px !important;
                border: 1px solid rgba(59, 130, 246, 0.1) !important;
                align-items: stretch !important;
                justify-items: stretch !important;
            }
            
            .physics-icon-container {
                padding: 0.5rem !important;
                min-height: 95px !important;
                max-height: 95px !important;
                height: 95px !important;
                width: 100% !important;
                border-radius: 8px !important;
                background: rgba(255, 255, 255, 0.9) !important;
                border: 1px solid rgba(59, 130, 246, 0.12) !important;
                box-shadow: 0 1px 6px rgba(59, 130, 246, 0.08) !important;
                display: flex !important;
                flex-direction: column !important;
                align-items: center !important;
                justify-content: center !important;
                text-align: center !important;
                position: relative !important;
                overflow: hidden !important;
            }
            
            .physics-icon {
                width: 40px !important;
                height: 40px !important;
                border-radius: 8px !important;
                margin-bottom: 0.375rem !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                flex-shrink: 0 !important;
            }
            
            .physics-icon svg {
                width: 1.25rem !important;
                height: 1.25rem !important;
            }
            
            .physics-icon-container p {
                font-size: 0.625rem !important;
                font-weight: 700 !important;
                line-height: 1.1 !important;
                margin: 0 !important;
                text-align: center !important;
                display: block !important;
                width: 100% !important;
                overflow: hidden !important;
                text-overflow: ellipsis !important;
                word-wrap: break-word !important;
                hyphens: auto !important;
            }
            
            /* Extra Small Research Areas */
            .research-area .bg-gradient-to-br {
                padding: 1rem !important;
                border-radius: 0.75rem !important;
            }
            
            .research-area .text-3xl, .research-area .text-4xl {
                font-size: 1.5rem !important;
                margin-bottom: 0.5rem !important;
            }
            
            .research-area h3 {
                font-size: 0.9rem !important;
                margin-bottom: 0.375rem !important;
                font-weight: 700 !important;
            }
            
            .research-area p {
                font-size: 0.7rem !important;
                line-height: 1.3 !important;
            }
        }
        
        /* Logo Styling */
        .navbar-logo {
            height: 2.5rem;
            width: auto;
            max-width: 200px;
            transition: all 0.3s ease;
        }
        
        .navbar-logo:hover {
            transform: scale(1.05);
        }
        
        .footer-logo {
            height: 2rem;
            width: auto;
            max-width: 150px;
            opacity: 0.9;
            transition: all 0.3s ease;
        }
        
        .footer-logo:hover {
            opacity: 1;
            transform: scale(1.02);
        }
        
        /* Physics Background Enhancement */
        .physics-bg-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(
                135deg,
                rgba(30, 41, 59, 0.1) 0%,
                rgba(51, 65, 85, 0.05) 50%,
                rgba(71, 85, 105, 0.1) 100%
            );
            backdrop-filter: blur(1px);
            -webkit-backdrop-filter: blur(1px);
        }
        
        /* Enhanced Staff Cards */
        .staff-card {
            background: rgba(30, 41, 59, 0.05);
            border: 1px solid rgba(30, 41, 59, 0.1);
            border-radius: 24px;
            padding: 2rem;
            text-align: center;
            backdrop-filter: blur(10px);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }
        
        .staff-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #1e293b 0%, #334155 50%, #475569 100%);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }
        
        .staff-card:hover::before {
            transform: scaleX(1);
        }
        
        .staff-card:hover {
            transform: translateY(-12px) scale(1.03);
            box-shadow: 0 25px 60px rgba(30, 41, 59, 0.2);
            border-color: rgba(30, 41, 59, 0.3);
            background: rgba(30, 41, 59, 0.08);
        }
        
        .staff-avatar-container {
            position: relative;
            margin-bottom: 1.5rem;
            display: inline-block;
        }
        
        .staff-avatar {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border: 3px solid rgba(30, 41, 59, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }
        
        .staff-card:hover .staff-avatar {
            background: linear-gradient(135deg, #1e293b 0%, #334155 50%, #475569 100%);
            border-color: rgba(30, 41, 59, 0.4);
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 15px 40px rgba(30, 41, 59, 0.3);
        }
        
        .staff-status-indicator {
            position: absolute;
            bottom: 5px;
            right: 5px;
            width: 16px;
            height: 16px;
            background: #10b981;
            border: 2px solid white;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }
        
        .staff-info {
            margin-bottom: 1rem;
        }
        
        .staff-name {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.5rem;
            font-family: 'Montserrat', sans-serif;
            transition: color 0.3s ease;
        }
        
        .staff-card:hover .staff-name {
            color: #0f172a;
        }
        
        .staff-position {
            font-size: 0.9rem;
            color: #475569;
            margin-bottom: 0.25rem;
            font-weight: 600;
            transition: color 0.3s ease;
        }
        
        .staff-card:hover .staff-position {
            color: #334155;
        }
        
        .staff-specialization {
            font-size: 0.8rem;
            color: #64748b;
            font-style: italic;
            transition: color 0.3s ease;
        }
        
        .staff-card:hover .staff-specialization {
            color: #475569;
        }
        
        .staff-contact-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(30, 41, 59, 0.95) 0%, rgba(30, 41, 59, 0.8) 50%, transparent 100%);
            padding: 1rem;
            transform: translateY(100%);
            transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .staff-card:hover .staff-contact-overlay {
            transform: translateY(0);
        }
        
        .staff-contact-buttons {
            display: flex;
            justify-content: center;
            gap: 0.75rem;
        }
        
        .staff-contact-btn {
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1e293b;
            transition: all 0.3s ease;
            cursor: pointer;
            backdrop-filter: blur(10px);
        }
        
        .staff-contact-btn:hover {
            background: white;
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }
        
        .email-btn:hover {
            color: #dc2626;
        }
        
        .profile-btn:hover {
            color: #1e293b;
        }
        
        /* Contact Form Enhancement */
        #contactForm {
            animation: slideInUp 0.8s ease-out;
        }
        
        #contactForm input:focus,
        #contactForm select:focus,
        #contactForm textarea:focus {
            transform: scale(1.02);
            box-shadow: 0 8px 25px rgba(30, 41, 59, 0.15);
        }
        
        #contactForm button[type="submit"]:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 0 15px 40px rgba(30, 41, 59, 0.3);
        }
        
        /* Map Container Enhancement */
        #map-container:hover iframe {
            filter: none !important;
        }
        
        /* Smooth Scrolling */
        html {
            scroll-behavior: smooth;
        }
        
        /* Enhanced Navigation Logo Effects */
        .navbar-logo-container {
            position: relative;
            display: flex;
            align-items: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .navbar-logo-container::before {
            content: '';
            position: absolute;
            top: -8px;
            left: -8px;
            right: -8px;
            bottom: -8px;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), transparent);
            border-radius: 16px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .navbar-logo-container:hover::before {
            opacity: 1;
        }

        /* Enhanced Mobile Menu Animation */
        .mobile-menu-slide {
            transform: translateY(-100%);
            opacity: 0;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .mobile-menu-slide.open {
            transform: translateY(0);
            opacity: 1;
        }

        /* Glass Reflection Effect */
        .nav-glass-reflection {
            position: relative;
            overflow: hidden;
        }

        .nav-glass-reflection::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent 0%,
                rgba(255, 255, 255, 0.2) 50%,
                transparent 100%
            );
            transition: left 0.8s ease;
            pointer-events: none;
        }

        .navbar-glassmorphism:hover .nav-glass-reflection::after {
            left: 100%;
        }

        /* Simplified Navbar Border */
        .navbar-border-glow {
            position: relative;
        }
        
        /* Section Transitions */
        section {
            scroll-margin-top: 80px;
            transition: all 0.6s ease-in-out;
        }
        
        /* Enhanced Section Animations */
        .section-animate {
            opacity: 0;
            transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .section-animate.visible {
            opacity: 1;
        }

        /* Simplified Section Animation Styles */
        .section-animate {
            transform: translateY(20px);
            opacity: 0;
        }
        
        .section-animate.visible {
            transform: translateY(0);
            opacity: 1;
        }



        /* Simplified Content Animation */
        .animate-fade-in-up,
        .animate-fade-in-left,
        .animate-fade-in-right,
        .animate-zoom-in {
            opacity: 1;
            transform: translateY(0) translateX(0) scale(1);
        }



        /* Dark Mode Styles */
        .dark {
            background-color: #0f172a;
            color: #e2e8f0;
        }

        .dark body {
            background-color: #0f172a !important;
            color: #e2e8f0 !important;
        }

        /* Dark Mode Navigation */
        .dark .navbar-glassmorphism {
            background: rgba(15, 23, 42, 0.75) !important;
            border-bottom: 1px solid rgba(71, 85, 105, 0.3) !important;
            box-shadow: 
                0 10px 40px rgba(15, 23, 42, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.08),
                0 0 0 1px rgba(71, 85, 105, 0.1) !important;
        }

        .dark .navbar-glassmorphism.scrolled {
            background: rgba(15, 23, 42, 0.9) !important;
            border-bottom: 1px solid rgba(71, 85, 105, 0.4) !important;
            box-shadow: 
                0 15px 50px rgba(15, 23, 42, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.12),
                0 0 0 1px rgba(71, 85, 105, 0.2) !important;
        }

        .dark .nav-link-enhanced {
            background: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.08) !important;
            color: rgba(255, 255, 255, 0.85) !important;
        }

        .dark .nav-link-enhanced:hover {
            background: rgba(255, 255, 255, 0.12) !important;
            border-color: rgba(255, 255, 255, 0.2) !important;
            color: rgba(255, 255, 255, 1) !important;
            box-shadow: 
                0 8px 25px rgba(15, 23, 42, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.15);
        }

        .dark .nav-link-enhanced.active {
            background: rgba(255, 255, 255, 0.15) !important;
            border-color: rgba(255, 255, 255, 0.25) !important;
            color: rgba(255, 255, 255, 1) !important;
            box-shadow: 
                0 6px 20px rgba(15, 23, 42, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }

        .dark .mobile-menu-enhanced {
            background: rgba(15, 23, 42, 0.95) !important;
            border-top: 1px solid rgba(71, 85, 105, 0.3) !important;
            box-shadow: 
                0 -10px 40px rgba(15, 23, 42, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.08);
        }

        .dark .mobile-menu-button-enhanced {
            background: rgba(255, 255, 255, 0.08) !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
        }

        .dark .mobile-menu-button-enhanced:hover {
            background: rgba(255, 255, 255, 0.12) !important;
            border-color: rgba(255, 255, 255, 0.2) !important;
            box-shadow: 
                0 8px 25px rgba(15, 23, 42, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.15);
        }

        /* Dark Mode Sections */
        .dark #beranda {
            background: #1e293b !important;
        }

        .dark #visi-misi {
            background: #0f172a !important;
        }

        .dark #staf {
            background: #1e293b !important;
        }

        .dark #galeri {
            background: #0f172a !important;
        }

        .dark #layanan {
            background: #1e293b !important;
        }

        .dark #fasilitas {
            background: #0f172a !important;
        }

        .dark #formulir {
            background: #1e293b !important;
        }

        .dark #kontak {
            background: #0f172a !important;
        }

        /* Dark Mode Text Colors - Enhanced Readability */
        .dark .text-navy,
        .dark .service-title,
        .dark h1, .dark h2, .dark h3, .dark h4, .dark h5, .dark h6 {
            color: #e2e8f0 !important;
        }

        .dark .text-gray-600,
        .dark .service-description,
        .dark p {
            color: #cbd5e1 !important;
        }

        .dark .text-gray-500 {
            color: #94a3b8 !important;
        }

        .dark .text-gray-700 {
            color: #e2e8f0 !important;
        }

        .dark .text-blue-800 {
            color: #cbd5e1 !important;
        }

        .dark .text-blue-900 {
            color: #e2e8f0 !important;
        }

        .dark .text-blue-600 {
            color: #cbd5e1 !important;
        }

        .dark .text-white {
            color: #f8fafc !important;
        }

        .dark .gradient-text,
        .dark .gradient-animated,
        .dark .section-title {
            color: #f8fafc !important;
            background: none !important;
            -webkit-background-clip: unset !important;
            -webkit-text-fill-color: #f8fafc !important;
            background-clip: unset !important;
        }

        /* Dark Mode Cards and Glass Elements - Ultra Glassmorphism */
        .dark .glass-luxury,
        .dark .glassmorphism {
            background: rgba(15, 23, 42, 0.3) !important;
            border: none !important;
            backdrop-filter: blur(25px) !important;
            -webkit-backdrop-filter: blur(25px) !important;
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.1),
                0 0 0 1px rgba(255, 255, 255, 0.05) !important;
        }

        .dark .service-card,
        .dark .facility-item {
            background: rgba(15, 23, 42, 0.2) !important;
            border: none !important;
            backdrop-filter: blur(20px) !important;
            -webkit-backdrop-filter: blur(20px) !important;
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.08),
                0 0 0 1px rgba(255, 255, 255, 0.03) !important;
        }

        .dark .service-card:hover,
        .dark .facility-item:hover {
            background: rgba(15, 23, 42, 0.4) !important;
            transform: translateY(-15px) !important;
            box-shadow: 
                0 25px 50px rgba(0, 0, 0, 0.5),
                inset 0 1px 0 rgba(255, 255, 255, 0.15),
                0 0 0 1px rgba(255, 255, 255, 0.08) !important;
        }

        /* Dark Mode Physics Icons - Enhanced Glassmorphism */
        .dark .physics-icon-container {
            background: rgba(15, 23, 42, 0.4) !important;
            border: none !important;
            backdrop-filter: blur(20px) !important;
            -webkit-backdrop-filter: blur(20px) !important;
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.1) !important;
        }

        .dark .physics-icon-container:hover {
            background: rgba(15, 23, 42, 0.6) !important;
            transform: translateY(-8px) scale(1.05) !important;
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.2) !important;
        }

        .dark .physics-icon {
            background: rgba(59, 130, 246, 0.1) !important;
            border: 1px solid rgba(59, 130, 246, 0.2) !important;
            backdrop-filter: blur(10px) !important;
        }

        .dark .physics-icon svg {
            color: #cbd5e1 !important;
            filter: drop-shadow(0 0 8px rgba(203, 213, 225, 0.3)) !important;
        }

        .dark .physics-icon-container p {
            color: #e2e8f0 !important;
            font-weight: 600 !important;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3) !important;
        }

        /* Dark Mode Research Areas - Enhanced Glassmorphism */
        .dark .research-area .bg-gradient-to-br {
            background: rgba(15, 23, 42, 0.4) !important;
            border: none !important;
            backdrop-filter: blur(20px) !important;
            -webkit-backdrop-filter: blur(20px) !important;
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.1) !important;
        }

        .dark .research-area:hover .bg-gradient-to-br {
            background: rgba(15, 23, 42, 0.6) !important;
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.2) !important;
        }

        .dark .research-area h3 {
            color: #e2e8f0 !important;
        }

        .dark .research-area p {
            color: #cbd5e1 !important;
        }

        .dark .research-area .text-3xl,
        .dark .research-area .text-4xl {
            color: #cbd5e1 !important;
            filter: drop-shadow(0 0 8px rgba(203, 213, 225, 0.3)) !important;
        }

        /* Dark Mode Background Patterns - Disabled */
        .dark .section-pattern-dots::before,
        .dark .section-pattern-lines::before,
        .dark .section-pattern-mesh::before,
        .dark .section-pattern-hexagon::before {
            display: none !important;
        }

        /* Dark Mode Grid Background - Disabled */
        .dark .grid-background,
        .dark .grid-background::before,
        .dark .grid-background::after,
        .dark .dots-pattern {
            display: none !important;
        }

        /* Dark Mode Footer */
        .dark .footer {
            background: rgba(15, 23, 42, 0.95) !important;
            border-top: 1px solid rgba(71, 85, 105, 0.3) !important;
        }

        .dark .footer-brand {
            color: #e2e8f0 !important;
        }

        .dark .footer-link {
            color: #cbd5e1 !important;
        }

        .dark .footer-link:hover {
            color: #e2e8f0 !important;
            background: rgba(71, 85, 105, 0.2) !important;
        }

        .dark .footer-copyright {
            color: #94a3b8 !important;
        }

        /* Dark Mode Marquee */
        .dark .marquee-container {
            background: linear-gradient(to right, rgba(15, 23, 42, 0.4), rgba(30, 41, 59, 0.2), rgba(15, 23, 42, 0.4)) !important;
            border-color: rgba(59, 130, 246, 0.2) !important;
            backdrop-filter: blur(10px) !important;
        }

        .dark .marquee-text {
            color: #cbd5e1 !important;
        }

        /* Dark Mode Form Elements */
        .dark input,
        .dark textarea,
        .dark select {
            background: rgba(30, 41, 59, 0.8) !important;
            border: 1px solid rgba(59, 130, 246, 0.3) !important;
            color: #e2e8f0 !important;
        }

        .dark input:focus,
        .dark textarea:focus,
        .dark select:focus {
            border-color: rgba(59, 130, 246, 0.6) !important;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1) !important;
            background: rgba(30, 41, 59, 0.9) !important;
        }

        .dark input::placeholder,
        .dark textarea::placeholder {
            color: #64748b !important;
        }

        .dark label {
            color: #cbd5e1 !important;
        }

        /* Dark Mode Modal */
        .dark #loginModal {
            background: rgba(0, 0, 0, 0.8) !important;
        }

        .dark #loginModalContent {
            background: rgba(15, 23, 42, 0.95) !important;
            border: 1px solid rgba(59, 130, 246, 0.3) !important;
        }

        /* Dark Mode Buttons */
        .dark .btn-luxury {
            background: linear-gradient(135deg, #1e293b, #334155) !important;
            border: 1px solid rgba(59, 130, 246, 0.3) !important;
            color: #f1f5f9 !important;
        }

        .dark .btn-luxury:hover {
            background: linear-gradient(135deg, #1d4ed8, #2563eb) !important;
            box-shadow: 0 25px 50px rgba(59, 130, 246, 0.4) !important;
        }

        .dark .btn-secondary,
        .dark .glass-luxury.border.border-slate-200 {
            background: rgba(30, 41, 59, 0.8) !important;
            border: 1px solid rgba(71, 85, 105, 0.3) !important;
            color: #cbd5e1 !important;
        }

        .dark .btn-secondary:hover,
        .dark .glass-luxury.border.border-slate-200:hover {
            background: rgba(30, 41, 59, 0.9) !important;
            border-color: rgba(71, 85, 105, 0.5) !important;
        }

        /* Dark Mode Navigation Buttons */
        .dark .bg-white.text-navy {
            background: rgba(59, 130, 246, 0.9) !important;
            color: #f1f5f9 !important;
            border: 1px solid rgba(59, 130, 246, 0.3) !important;
        }

        .dark .bg-white.text-navy:hover {
            background: rgba(59, 130, 246, 1) !important;
            transform: translateY(-2px) !important;
        }

        /* Dark Mode Status and Icons */
        .dark .status-dot {
            background: #10b981 !important;
            box-shadow: 0 0 10px rgba(16, 185, 129, 0.5) !important;
        }

        .dark .service-icon {
            background: linear-gradient(135deg, #1e293b 0%, #334155 50%, #475569 100%) !important;
            border: 1px solid rgba(71, 85, 105, 0.3) !important;
        }

        .dark .service-icon::before {
            background: rgba(15, 23, 42, 0.9) !important;
        }

        /* Dark Mode Stats */
        .dark .stat-number {
            background: linear-gradient(135deg, #cbd5e1 0%, #94a3b8 50%, #64748b 100%) !important;
            -webkit-background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
            background-clip: text !important;
        }

        .dark .stat-label {
            color: #94a3b8 !important;
        }

        /* Dark Mode Enhanced Hero Styles */

        .dark .hero-badge-enhanced {
            background: rgba(15, 23, 42, 0.9) !important;
            border: 2px solid rgba(71, 85, 105, 0.4) !important;
            box-shadow: 
                0 20px 40px rgba(0, 0, 0, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.1) !important;
        }

        .dark .hero-badge-enhanced:hover {
            background: rgba(15, 23, 42, 0.95) !important;
            box-shadow: 
                0 30px 60px rgba(0, 0, 0, 0.6),
                inset 0 1px 0 rgba(255, 255, 255, 0.15) !important;
        }

        .dark .hero-badge-enhanced span {
            color: #e2e8f0 !important;
        }

        .dark .hero-title-enhanced {
            color: #f8fafc !important;
        }

        .dark .simple-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700 !important;
            color: #f8fafc !important;
            letter-spacing: -0.02em !important;
            line-height: 1.1;
            margin-bottom: 0.5rem;
        }



        .dark .typewriter-prefix {
            color: #cbd5e1 !important;
        }

        .dark .typewriter-text {
            color: #e2e8f0 !important;
        }

        .dark .typewriter-cursor {
            color: #cbd5e1 !important;
        }

        .dark .highlight-text {
            color: #e2e8f0 !important;
            background: none !important;
            -webkit-background-clip: unset !important;
            -webkit-text-fill-color: #e2e8f0 !important;
        }

        .dark .highlight-text::after {
            background: linear-gradient(135deg, #cbd5e1, #94a3b8) !important;
        }

        .dark .stats-card-enhanced {
            background: rgba(15, 23, 42, 0.6) !important;
            border: 2px solid rgba(71, 85, 105, 0.3) !important;
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.1) !important;
        }

        .dark .stats-card-enhanced:hover {
            background: rgba(15, 23, 42, 0.8) !important;
            border-color: rgba(71, 85, 105, 0.5) !important;
            box-shadow: 
                0 30px 80px rgba(0, 0, 0, 0.6),
                inset 0 1px 0 rgba(255, 255, 255, 0.15) !important;
        }

        .dark .stats-card-enhanced .text-gray-600 {
            color: #cbd5e1 !important;
        }

        .dark .stats-number-enhanced {
            color: #f8fafc !important;
            background: none !important;
            -webkit-background-clip: unset !important;
            -webkit-text-fill-color: #f8fafc !important;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .dark .physics-icon svg {
            color: #cbd5e1 !important;
            filter: drop-shadow(0 0 8px rgba(203, 213, 225, 0.3)) !important;
        }

        .dark .research-area .text-3xl,
        .dark .research-area .text-4xl {
            color: #cbd5e1 !important;
            filter: drop-shadow(0 0 8px rgba(203, 213, 225, 0.3)) !important;
        }

        /* Navbar Dark Mode Toggle */
        .navbar-dark-toggle {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            min-width: 44px;
            height: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .navbar-dark-toggle:hover {
            background: rgba(255, 255, 255, 0.15) !important;
            border-color: rgba(255, 255, 255, 0.4);
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(255, 255, 255, 0.1);
        }

        .dark .navbar-dark-toggle {
            background: rgba(251, 191, 36, 0.1);
            border-color: rgba(251, 191, 36, 0.3);
            color: #fbbf24 !important;
        }

        .dark .navbar-dark-toggle:hover {
            background: rgba(251, 191, 36, 0.2) !important;
            border-color: rgba(251, 191, 36, 0.5);
            box-shadow: 0 4px 12px rgba(251, 191, 36, 0.2);
        }

        /* Mobile Dark Mode Toggle */
        .mobile-dark-toggle {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .mobile-dark-toggle:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .dark .mobile-dark-toggle {
            background: rgba(251, 191, 36, 0.1);
            border-color: rgba(251, 191, 36, 0.3);
            color: #fbbf24 !important;
        }

        .dark .mobile-dark-toggle:hover {
            background: rgba(251, 191, 36, 0.15);
            border-color: rgba(251, 191, 36, 0.4);
        }

        /* Dark Mode Transition Gradients */
        .dark .section-fade-bottom::after {
            background: linear-gradient(to bottom, transparent 0%, rgba(30, 41, 59, 0.8) 100%) !important;
        }

        .dark .section-fade-bottom-gray::after {
            background: linear-gradient(to bottom, transparent 0%, rgba(15, 23, 42, 0.8) 100%) !important;
        }

        .dark .section-fade-top::before {
            background: linear-gradient(to top, transparent 0%, rgba(30, 41, 59, 0.6) 100%) !important;
        }

        .dark .section-fade-top-gray::before {
            background: linear-gradient(to top, transparent 0%, rgba(15, 23, 42, 0.6) 100%) !important;
        }

        .dark .section-fade-top-blue::before {
            background: linear-gradient(to top, transparent 0%, rgba(30, 41, 59, 0.6) 100%) !important;
        }



            /* Dark Mode Physics Icons Mobile */
            .dark .physics-icon-container {
                background: rgba(15, 23, 42, 0.6) !important;
                box-shadow: 
                    0 4px 16px rgba(0, 0, 0, 0.4),
                    inset 0 1px 0 rgba(255, 255, 255, 0.1) !important;
            }

            .dark .physics-icon-container:hover {
                background: rgba(15, 23, 42, 0.8) !important;
                box-shadow: 
                    0 8px 24px rgba(0, 0, 0, 0.5),
                    inset 0 1px 0 rgba(255, 255, 255, 0.15) !important;
            }

            /* Dark Mode Service Cards Mobile */
            .dark .service-card,
            .dark .facility-item {
                background: rgba(15, 23, 42, 0.3) !important;
                box-shadow: 
                    0 4px 16px rgba(0, 0, 0, 0.3),
                    inset 0 1px 0 rgba(255, 255, 255, 0.08) !important;
            }

            .dark .service-card:hover,
            .dark .facility-item:hover {
                background: rgba(15, 23, 42, 0.5) !important;
                box-shadow: 
                    0 8px 24px rgba(0, 0, 0, 0.4),
                    inset 0 1px 0 rgba(255, 255, 255, 0.12) !important;
            }
        }

        /* ===== ENHANCED HERO SECTION STYLES ===== */
        


        /* Enhanced Badge */
        .hero-badge-enhanced {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(20px) !important;
            border: 2px solid rgba(71, 85, 105, 0.3) !important;
            box-shadow: 
                0 20px 40px rgba(59, 130, 246, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.8) !important;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hero-badge-enhanced:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 
                0 30px 60px rgba(59, 130, 246, 0.25),
                inset 0 1px 0 rgba(255, 255, 255, 0.9) !important;
        }

        .pulse-glow {
            animation: pulseGlow 2s ease-in-out infinite;
        }

        @keyframes pulseGlow {
            0%, 100% {
                box-shadow: 0 0 5px rgba(34, 197, 94, 0.5);
                transform: scale(1);
            }
            50% {
                box-shadow: 0 0 20px rgba(34, 197, 94, 0.8);
                transform: scale(1.1);
            }
        }

        /* Enhanced Title Styling */
        .hero-title-container {
            perspective: 1000px;
        }

        .hero-title-enhanced {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 4rem;
            color: #1e293b;
            letter-spacing: -0.02em;
            line-height: 1.2;
            margin-bottom: 2rem;
            padding: 1rem 0;
        }



        /* Simple Title - Clean Design */
        .simple-title {
            position: relative;
            display: block;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700 !important;
            color: #1e293b !important;
            letter-spacing: -0.02em;
            line-height: 1.1;
            margin-bottom: 0.5rem;
        }



        /* Typewriter Effect for Subtitle */
        .typewriter-container {
            position: relative;
        }

        .typewriter-prefix {
            color: #334155;
            font-weight: bold;
        }

        .typewriter-text {
            color: #1e293b;
            font-weight: 700;
        }

        .typewriter-cursor {
            color: #334155;
            animation: typewriterBlink 2s infinite;
            font-weight: normal;
        }

        @keyframes typewriterBlink {
            0%, 70% { opacity: 1; }
            71%, 100% { opacity: 0; }
        }

        /* Enhanced Description */
        .description-enhanced {
            opacity: 1;
            transform: translateY(0);
        }

        .highlight-text {
            background: linear-gradient(135deg, #334155, #475569);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
            position: relative;
        }

        .highlight-text::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(135deg, #334155, #475569);
            transform: scaleX(1);
        }



        /* Magnetic Button Effect */
        .btn-magnetic {
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-magnetic::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.6s ease;
        }

        .btn-magnetic:hover::before {
            left: 100%;
        }

        .btn-magnetic:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
        }

        .btn-icon-container {
            transition: transform 0.3s ease;
        }

        .btn-magnetic:hover .btn-icon-container {
            transform: scale(1.05);
        }

        .arrow-animation {
            transition: transform 0.3s ease;
            font-weight: bold;
        }

        .btn-magnetic:hover .arrow-animation {
            transform: translateX(5px);
        }

        /* Enhanced Stats Cards */
        .stats-card-enhanced {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(25px) !important;
            border: 2px solid rgba(71, 85, 105, 0.2) !important;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .stats-card-enhanced::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.1), transparent);
            transition: left 0.8s ease;
        }

        .stats-card-enhanced:hover::before {
            left: 100%;
        }

        .stats-card-enhanced:hover {
            transform: translateY(-15px) scale(1.05) rotateX(10deg);
            box-shadow: 
                0 30px 80px rgba(59, 130, 246, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
            border-color: rgba(71, 85, 105, 0.4);
        }

        .stats-number-enhanced {
            background: linear-gradient(135deg, #1e293b, #334155, #475569);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 2px 4px rgba(30, 41, 59, 0.3);
            transition: all 0.3s ease;
        }

        .stats-card-enhanced:hover .stats-number-enhanced {
            transform: scale(1.1);
            text-shadow: 0 4px 8px rgba(71, 85, 105, 0.5);
        }





        /* Enhanced Navigation Hover Effects */
        .nav-link {
            position: relative;
            overflow: hidden;
        }
        
        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.6s ease;
        }
        
        .nav-link:hover::before {
            left: 100%;
        }

        /* Enhanced Navbar Glassmorphism */
        .navbar-glassmorphism {
            background: rgba(30, 41, 59, 0.75) !important;
            backdrop-filter: blur(25px) !important;
            -webkit-backdrop-filter: blur(25px) !important;
            border-bottom: 1px solid rgba(71, 85, 105, 0.3) !important;
            box-shadow: 
                0 10px 40px rgba(30, 41, 59, 0.15),
                inset 0 1px 0 rgba(255, 255, 255, 0.1),
                0 0 0 1px rgba(71, 85, 105, 0.1) !important;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .navbar-glassmorphism.scrolled {
            background: rgba(30, 41, 59, 0.85) !important;
            backdrop-filter: blur(30px) !important;
            -webkit-backdrop-filter: blur(30px) !important;
            border-bottom: 1px solid rgba(71, 85, 105, 0.4) !important;
            box-shadow: 
                0 15px 50px rgba(30, 41, 59, 0.25),
                inset 0 1px 0 rgba(255, 255, 255, 0.15),
                0 0 0 1px rgba(71, 85, 105, 0.2) !important;
        }

        /* Enhanced Nav Link Styling */
        .nav-link-enhanced {
            background: rgba(255, 255, 255, 0.08) !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
            backdrop-filter: blur(10px) !important;
            -webkit-backdrop-filter: blur(10px) !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            color: rgba(255, 255, 255, 0.9) !important;
            position: relative;
            overflow: hidden;
            white-space: nowrap !important;
            display: inline-block !important;
            text-overflow: ellipsis !important;
            min-width: fit-content !important;
        }

        .nav-link-enhanced::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.15), transparent);
            transition: left 0.6s ease;
        }

        .nav-link-enhanced:hover::before {
            left: 100%;
        }

        .nav-link-enhanced:hover {
            background: rgba(255, 255, 255, 0.15) !important;
            border-color: rgba(255, 255, 255, 0.25) !important;
            color: rgba(255, 255, 255, 1) !important;
            transform: translateY(-2px);
            box-shadow: 
                0 8px 25px rgba(30, 41, 59, 0.4),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }

        .nav-link-enhanced.active {
            background: rgba(255, 255, 255, 0.2) !important;
            border-color: rgba(255, 255, 255, 0.3) !important;
            color: rgba(255, 255, 255, 1) !important;
            box-shadow: 
                0 6px 20px rgba(30, 41, 59, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.25);
        }

        /* Mobile Menu Enhanced */
        .mobile-menu-enhanced {
            background: rgba(30, 41, 59, 0.95) !important;
            backdrop-filter: blur(25px) !important;
            -webkit-backdrop-filter: blur(25px) !important;
            border-top: 1px solid rgba(71, 85, 105, 0.3) !important;
            box-shadow: 
                0 -10px 40px rgba(30, 41, 59, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
        }

        /* Mobile Menu Toggle Button */
        .mobile-menu-button-enhanced {
            background: rgba(255, 255, 255, 0.1) !important;
            border: 1px solid rgba(255, 255, 255, 0.15) !important;
            backdrop-filter: blur(10px) !important;
            -webkit-backdrop-filter: blur(10px) !important;
            border-radius: 12px !important;
            width: 44px !important;
            height: 44px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .mobile-menu-button-enhanced:hover {
            background: rgba(255, 255, 255, 0.15) !important;
            border-color: rgba(255, 255, 255, 0.25) !important;
            transform: scale(1.05);
            box-shadow: 
                0 8px 25px rgba(30, 41, 59, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.2);
        }

        /* Navigation Container Fixes */
        .navbar-glassmorphism .flex {
            min-width: 100% !important;
        }

        .navbar-glassmorphism .flex > div {
            min-width: fit-content !important;
        }

        /* Ensure no text wrapping in navigation */
        .nav-link,
        .nav-link-enhanced {
            flex-shrink: 0 !important;
        }

        /* Section Background Patterns */
        .section-pattern-dots::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: radial-gradient(circle, rgba(59, 130, 246, 0.08) 1px, transparent 1px);
            background-size: 40px 40px;
            background-position: 0 0, 20px 20px;
            opacity: 0.6;
            z-index: 0;
            pointer-events: none;
        }

        .section-pattern-lines::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                linear-gradient(90deg, rgba(59, 130, 246, 0.06) 1px, transparent 1px),
                linear-gradient(rgba(59, 130, 246, 0.06) 1px, transparent 1px);
            background-size: 60px 60px;
            opacity: 0.5;
            z-index: 0;
            pointer-events: none;
        }

        .section-pattern-mesh::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                linear-gradient(45deg, rgba(59, 130, 246, 0.04) 25%, transparent 25%),
                linear-gradient(-45deg, rgba(59, 130, 246, 0.04) 25%, transparent 25%),
                linear-gradient(45deg, transparent 75%, rgba(59, 130, 246, 0.04) 75%),
                linear-gradient(-45deg, transparent 75%, rgba(59, 130, 246, 0.04) 75%);
            background-size: 80px 80px;
            background-position: 0 0, 0 40px, 40px -40px, -40px 0px;
            opacity: 0.3;
            z-index: 0;
            pointer-events: none;
        }

        .section-pattern-hexagon::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                radial-gradient(circle at 25% 25%, rgba(59, 130, 246, 0.05) 2px, transparent 2px),
                radial-gradient(circle at 75% 75%, rgba(59, 130, 246, 0.05) 2px, transparent 2px);
            background-size: 100px 100px;
            background-position: 0 0, 50px 50px;
            opacity: 0.7;
            z-index: 0;
            pointer-events: none;
        }

        /* Section Content Positioning */
        .section-content {
            position: relative;
            z-index: 1;
        }

        /* Section Transition Gradients */
        .section-fade-bottom::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 60px;
            background: linear-gradient(to bottom, transparent 0%, rgba(255, 255, 255, 0.8) 100%);
            z-index: 2;
            pointer-events: none;
        }

        .section-fade-bottom-gray::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 60px;
            background: linear-gradient(to bottom, transparent 0%, rgba(249, 250, 251, 0.8) 100%);
            z-index: 2;
            pointer-events: none;
        }

        .section-fade-top::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 60px;
            background: linear-gradient(to top, transparent 0%, rgba(255, 255, 255, 0.6) 100%);
            z-index: 2;
            pointer-events: none;
        }

        .section-fade-top-gray::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 60px;
            background: linear-gradient(to top, transparent 0%, rgba(249, 250, 251, 0.6) 100%);
            z-index: 2;
            pointer-events: none;
        }

        .section-fade-top-blue::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 60px;
            background: linear-gradient(to top, transparent 0%, rgba(239, 246, 255, 0.6) 100%);
            z-index: 2;
            pointer-events: none;
        }

        /* Section Title Styling */
        .section-title {
            color: #1e293b !important;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        .section-subtitle {
            color: #1e293b !important;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            letter-spacing: -0.01em;
        }

        .service-title {
            color: #1e293b !important;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            letter-spacing: -0.01em;
        }

        .cta-title {
            color: #1e293b !important;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            letter-spacing: -0.01em;
        }

        /* Gradient Text Animation */
        .gradient-animated {
            background: linear-gradient(-45deg, #1e293b, #334155, #475569, #64748b, #1e293b);
            background-size: 400% 400%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradientFlow 8s ease infinite;
        }

        @keyframes gradientFlow {
            0%, 100% { background-position: 0% 50%; }
            25% { background-position: 100% 50%; }
            50% { background-position: 100% 100%; }
            75% { background-position: 0% 100%; }
        }

        /* Typing Effect Enhancement */
        .typing-luxury {
            position: relative;
            display: inline-block;
            color: #1e293b !important;
            font-weight: 900 !important;
            text-shadow: 0 2px 4px rgba(30, 41, 59, 0.2);
            -webkit-text-fill-color: #1e293b !important;
            background: none !important;
        }

        .typing-luxury::after {
            content: '';
            position: absolute;
            right: -8px;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(to bottom, #1e293b, #334155, #475569);
            border-radius: 2px;
            animation: blinkLuxury 1.2s infinite;
            box-shadow: 0 0 20px rgba(30, 41, 59, 0.6);
        }

        @keyframes blinkLuxury {
            0%, 50% { 
                opacity: 1;
                transform: scaleY(1) scaleX(1);
                box-shadow: 0 0 20px rgba(30, 41, 59, 0.8);
            }
            51%, 100% { 
                opacity: 0.3;
                transform: scaleY(0.8) scaleX(0.5);
                box-shadow: 0 0 5px rgba(30, 41, 59, 0.3);
            }
        }

        /* Enhanced Stats Counter */
        .stats-number-enhanced {
            background: linear-gradient(135deg, #1e293b, #334155, #475569);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 2px 4px rgba(30, 41, 59, 0.3);
            transition: all 0.3s ease;
        }

        /* Enhanced Service Card */
        .service-card:hover .service-title {
            color: #1e293b !important;
            -webkit-text-fill-color: #1e293b !important;
        }

        @keyframes shimmer {
            0% { left: -100%; }
            50% { left: 100%; }
            100% { left: 100%; }
        }

        /* Service Icons Glow */
        .service-icon-glow {
            background: linear-gradient(135deg, #1e293b, #334155) !important;
            color: white !important;
            border: 2px solid rgba(71, 85, 105, 0.3) !important;
            box-shadow: 
                0 20px 40px rgba(30, 41, 59, 0.4),
                0 0 50px rgba(71, 85, 105, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.2) !important;
        }

        /* Facility Item Enhanced */
        .facility-item {
            background: linear-gradient(135deg, rgba(71, 85, 105, 0.02), rgba(71, 85, 105, 0.08));
            border: 1px solid rgba(71, 85, 105, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .facility-item:hover {
            background: linear-gradient(135deg, rgba(71, 85, 105, 0.08), rgba(71, 85, 105, 0.12));
            border: 1px solid rgba(71, 85, 105, 0.15);
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px rgba(71, 85, 105, 0.4);
        }

        /* Contact Section Enhanced */
        .contact-icon-enhanced {
            background: rgba(71, 85, 105, 0.9) !important;
            color: white !important;
            border: 1px solid rgba(71, 85, 105, 0.3) !important;
            box-shadow: 0 12px 30px rgba(71, 85, 105, 0.4) !important;
        }

        .contact-icon-enhanced:hover {
            background: rgba(71, 85, 105, 1) !important;
            transform: translateY(-4px) scale(1.1) !important;
            box-shadow: 0 20px 50px rgba(71, 85, 105, 0.6) !important;
        }
    </style>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'navy': '#1e293b',
                        'navy-dark': '#334155',
                        'glass': 'rgba(255, 255, 255, 0.8)',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-white">
    <!-- Enhanced Glassmorphism Navigation -->
    <nav id="navbar" class="fixed w-full z-50 top-0 navbar-glassmorphism nav-glass-reflection">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20 navbar-border-glow">
                <!-- Logo - Left -->
                <div class="flex-shrink-0">
                    <a href="/" class="navbar-logo-container">
                        <img src="{{ asset('images/logo-fisika-putih.png') }}" alt="Lab Fisika Komputasi" class="navbar-logo">
                    </a>
                </div>
                
                <!-- Navigation Menu - Center (shifted left) -->
                <div class="hidden md:flex absolute left-1/2 transform -translate-x-1/2 -translate-x-8">
                    <div class="flex items-center space-x-6">
                        <a href="#beranda" class="nav-link nav-link-enhanced nav-click-effect px-4 py-3 rounded-xl text-sm font-semibold tracking-wide">Beranda</a>
                        <a href="#staf" class="nav-link nav-link-enhanced nav-click-effect px-4 py-3 rounded-xl text-sm font-semibold tracking-wide">Staf Ahli</a>
                        <a href="#layanan" class="nav-link nav-link-enhanced nav-click-effect px-4 py-3 rounded-xl text-sm font-semibold tracking-wide">Layanan</a>
                        <a href="#fasilitas" class="nav-link nav-link-enhanced nav-click-effect px-4 py-3 rounded-xl text-sm font-semibold tracking-wide">Fasilitas</a>
                        <a href="#kontak" class="nav-link nav-link-enhanced nav-click-effect px-4 py-3 rounded-xl text-sm font-semibold tracking-wide">Kontak</a>
                    </div>
                </div>
                
                <!-- Dark Mode Toggle - Right -->
                <div class="hidden md:flex flex-shrink-0">
                    <button id="darkModeToggle" class="navbar-dark-toggle px-4 py-2.5 rounded-xl text-white border border-white/20 hover:bg-white/10 transition-all duration-300" onclick="toggleDarkMode()" title="Toggle Dark Mode">
                        <i class="fas fa-moon text-base" id="darkModeIcon"></i>
                    </button>
                </div>
                
                <!-- Mobile menu button - Right (only visible on mobile) -->
                <div class="md:hidden flex justify-end">
                    <button id="mobile-menu-button" class="mobile-menu-button-enhanced text-white">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                </div>
            </div>
            
                         <!-- Enhanced Mobile menu -->
             <div id="mobile-menu" class="md:hidden mobile-menu-enhanced mobile-menu-slide">
                                 <div class="px-3 pt-3 pb-4 space-y-2">
                    <a href="#beranda" class="nav-link nav-link-enhanced nav-click-effect block px-4 py-3 rounded-xl text-base font-semibold">Beranda</a>
                    <a href="#staf" class="nav-link nav-link-enhanced nav-click-effect block px-4 py-3 rounded-xl text-base font-semibold">Staf Ahli</a>
                    <a href="#layanan" class="nav-link nav-link-enhanced nav-click-effect block px-4 py-3 rounded-xl text-base font-semibold">Layanan</a>
                    <a href="#fasilitas" class="nav-link nav-link-enhanced nav-click-effect block px-4 py-3 rounded-xl text-base font-semibold">Fasilitas</a>
                    <a href="#kontak" class="nav-link nav-link-enhanced nav-click-effect block px-4 py-3 rounded-xl text-base font-semibold">Kontak</a>
                    
                    <!-- Dark Mode Toggle for Mobile -->
                    <button class="mobile-dark-toggle flex items-center px-4 py-3 rounded-xl text-base font-semibold text-white hover:bg-white/10 transition-all duration-300 w-full" onclick="toggleDarkMode()">
                        <i class="fas fa-moon mr-3"></i>
                        <span>Dark Mode</span>
                    </button>
                </div>
             </div>
        </div>
    </nav>



        <!-- Hero Section / Beranda -->
    <section id="beranda" class="pt-16 bg-slate-50 min-h-screen flex items-center luxury-bg section-fade-bottom-gray relative overflow-hidden">
        <!-- Advanced Background Effects -->
        <div class="absolute inset-0 overflow-hidden">
            <!-- Physics Background Image -->
            <div class="absolute inset-0 opacity-20">
                <img src="{{ asset('images/WhatsApp Image 2025-06-17 at 18.12.15.jpeg') }}" 
                     alt="Physics Background" 
                     class="w-full h-full object-cover object-center filter blur-sm">
                <div class="physics-bg-overlay"></div>
            </div>
            
            <!-- Static Background Elements -->
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-gradient-to-r from-slate-600/10 to-slate-700/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-1/4 right-1/4 w-80 h-80 bg-gradient-to-r from-slate-500/8 to-slate-600/8 rounded-full blur-3xl"></div>
            

        </div>
        
        <!-- Grid backgrounds removed -->
        
        <!-- Particles Container -->
        <div class="particles-container" id="particles"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-20">
            <div class="text-center">
                <!-- Badge removed as requested -->
                
                <!-- Enhanced Main Title -->
                <div class="relative mb-8 hero-title-container">
                    <h1 class="relative text-4xl md:text-6xl lg:text-7xl reveal-luxury hero-title-enhanced text-center">
                        <div class="simple-title">Laboratorium</div>
                        <div class="simple-title">Fisika Teori dan Komputasi</div>
                    </h1>
                </div>
                
                <!-- Subtitle -->
                <div class="relative mb-12">
                                    <p class="text-xl md:text-3xl text-slate-600 font-bold mb-8 px-4 py-2" style="font-family: 'Montserrat', sans-serif; letter-spacing: 0.02em;">
                    Computational Physics Research Center
                </p>
                </div>
                
                <!-- Enhanced Description with Slide-in Effect -->
                <div class="relative mb-20">
                    <p class="text-lg md:text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed description-enhanced px-6 py-4">
                        <span class="highlight-text">Pusat unggulan</span> untuk penelitian dan pengembangan 
                        <span class="highlight-text">fisika komputasi</span>, simulasi numerik, dan pemodelan matematis 
                        dengan teknologi <span class="highlight-text">high-performance computing</span> terdepan.
                    </p>
                </div>
                
                <!-- Enhanced CTA Buttons with Magnetic Effect -->
                <div class="flex flex-col sm:flex-row gap-6 justify-center mb-20 reveal-luxury">
                    <a href="/layanan" class="btn-magnetic btn-luxury text-white px-10 py-5 rounded-2xl font-bold text-lg inline-flex items-center justify-center w-full sm:w-auto shadow-2xl">
                        <div class="btn-icon-container mr-3">
                            <i class="fas fa-rocket icon-luxury"></i>
                        </div>
                        <span>Explore Services</span>
                        <div class="ml-3 arrow-animation">→</div>
                    </a>
                    <a href="/kontak" class="btn-magnetic glass-luxury border border-slate-200 text-slate-800 px-10 py-5 rounded-2xl font-bold text-lg btn-hover inline-flex items-center justify-center w-full sm:w-auto shadow-2xl">
                        <div class="btn-icon-container mr-3">
                            <i class="fas fa-envelope icon-luxury"></i>
                        </div>
                        <span>Contact Us</span>
                        <div class="ml-3 arrow-animation">↗</div>
                    </a>
                </div>
                

                

            </div>
        </div>
    </section>

    <!-- Visi & Misi Section -->
    <section id="visi-misi" class="py-16 bg-white relative overflow-hidden section-pattern-dots section-fade-top-gray section-fade-bottom">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 section-content">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-8 section-title">Visi & Misi</h2>
                <p class="text-gray-600 text-lg max-w-3xl mx-auto">
                    Komitmen kami dalam mengembangkan ilmu fisika komputasi untuk kemajuan teknologi Indonesia
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Visi -->
                <div class="glass-luxury border border-slate-100 rounded-3xl p-10 card-luxury shadow-2xl group">
                    <div class="text-center mb-8">
                        <div class="w-20 h-20 bg-gradient-to-br from-slate-600 to-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-all duration-300">
                            <i class="fas fa-eye text-white text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-800 mb-4">Visi</h3>
                    </div>
                    <p class="text-gray-600 text-lg leading-relaxed text-center">
                        Menjadi pusat unggulan dalam penelitian dan pengembangan fisika komputasi yang berkelas dunia, 
                        menghasilkan inovasi teknologi untuk mendukung kemajuan ilmu pengetahuan dan pembangunan berkelanjutan.
                    </p>
                </div>
                
                <!-- Misi -->
                <div class="glass-luxury border border-slate-100 rounded-3xl p-10 card-luxury shadow-2xl group">
                    <div class="text-center mb-8">
                        <div class="w-20 h-20 bg-gradient-to-br from-slate-600 to-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-all duration-300">
                            <i class="fas fa-bullseye text-white text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-800 mb-4">Misi</h3>
                    </div>
                    <ul class="text-gray-600 text-base leading-relaxed space-y-4">
                        <li class="flex items-start">
                            <div class="w-2 h-2 bg-slate-600 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                            Menyelenggarakan penelitian berkualitas tinggi di bidang fisika komputasi dan simulasi numerik
                        </li>
                        <li class="flex items-start">
                            <div class="w-2 h-2 bg-slate-600 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                            Mengembangkan SDM unggul melalui pendidikan dan pelatihan computational physics
                        </li>
                        <li class="flex items-start">
                            <div class="w-2 h-2 bg-slate-600 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                            Memberikan layanan konsultasi dan fasilitas riset untuk akademisi dan industri
                        </li>
                        <li class="flex items-start">
                            <div class="w-2 h-2 bg-slate-600 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                            Membangun kemitraan strategis dengan institusi dalam dan luar negeri
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Staff & Dosen Section -->
    <section id="staf" class="py-16 bg-gray-50 relative overflow-hidden section-pattern-dots section-fade-top-blue section-fade-bottom">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 section-content">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-8 section-title">Staf dan Tenaga Ahli</h2>
                <p class="text-gray-600 text-lg max-w-3xl mx-auto">
                    Tim ahli berpengalaman di bidang fisika komputasi dan teknologi canggih
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
                @forelse ($featuredStaff as $staff)
                    <div class="staff-card group">
                        <div class="staff-avatar-container">
                            <div class="staff-avatar">
                                @if($staff->photo_path)
                                    <img src="{{ Storage::url($staff->photo_path) }}" alt="{{ $staff->name }}" 
                                         class="w-full h-full object-cover rounded-full group-hover:scale-110 transition-transform duration-300">
                                @else
                                    <i class="fas fa-user text-3xl text-slate-500 group-hover:text-white transition-colors duration-300"></i>
                                @endif
                            </div>
                            <div class="staff-status-indicator"></div>
                        </div>
                        <div class="staff-info">
                            <h3 class="staff-name">{{ $staff->name }}</h3>
                            <p class="staff-position">{{ $staff->position }}</p>
                            <p class="staff-specialization">{{ $staff->specialization ?? 'Computational Physics' }}</p>
                        </div>
                        <div class="staff-contact-overlay">
                            <div class="staff-contact-buttons">
                                @if($staff->email)
                                    <a href="mailto:{{ $staff->email }}" class="staff-contact-btn email-btn" title="Email">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                @endif
                                <button class="staff-contact-btn profile-btn" title="Profile">
                                    <i class="fas fa-user-circle"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Default placeholder if no staff -->
                    @for ($i = 0; $i < 5; $i++)
                        <div class="staff-card group">
                            <div class="staff-avatar-container">
                                <div class="staff-avatar">
                                    <i class="fas fa-user text-3xl text-slate-500 group-hover:text-white transition-colors duration-300"></i>
                                </div>
                                <div class="staff-status-indicator"></div>
                            </div>
                            <div class="staff-info">
                                <h3 class="staff-name">Dr. Mustapa, M.Si</h3>
                                <p class="staff-position">Dosen & Peneliti</p>
                                <p class="staff-specialization">Computational Physics</p>
                            </div>
                            <div class="staff-contact-overlay">
                                <div class="staff-contact-buttons">
                                    <button class="staff-contact-btn email-btn" title="Email">
                                        <i class="fas fa-envelope"></i>
                                    </button>
                                    <button class="staff-contact-btn profile-btn" title="Profile">
                                        <i class="fas fa-user-circle"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endfor
                @endforelse
            </div>
        </div>
    </section>

    <!-- Galeri Laboratorium Section -->
    <section id="galeri" class="py-16 bg-slate-50 relative overflow-hidden section-pattern-mesh section-fade-top section-fade-bottom-gray">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 section-content">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-8 section-title">Galeri Lab Fisika Teori dan Komputasi</h2>
                <p class="text-gray-600 text-lg max-w-4xl mx-auto">
                    Dokumentasi lengkap fasilitas dan aktivitas penelitian di laboratorium dengan 28 PC workstation untuk komputasi, simulasi, fotografi, dan web design
                </p>
            </div>
            
            <!-- Gallery Masonry Layout -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($featuredGallery as $gallery)
                    <div class="glass-luxury border border-slate-100 rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105">
                        <div class="aspect-video bg-gradient-to-br from-slate-100 to-slate-200 relative overflow-hidden">
                            @if($gallery->image_path)
                                <img src="{{ Storage::url($gallery->image_path) }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover">
                            @else
                                <img src="{{ asset('images/logo-fisika-putih.png') }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover opacity-30">
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-slate-800/50 flex items-end">
                                <div class="p-6 text-white">
                                    <h3 class="text-xl font-bold mb-2">{{ $gallery->title }}</h3>
                                    <p class="text-sm opacity-90">{{ $gallery->description ?? 'Fasilitas laboratorium fisika komputasi' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Default placeholder if no gallery -->
                    <!-- Main Lab Room -->
                    <div class="glass-luxury border border-slate-100 rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105">
                        <div class="aspect-video bg-gradient-to-br from-slate-100 to-slate-200 relative overflow-hidden">
                            <img src="{{ asset('images/logo-fisika-putih.png') }}" alt="Lab Room" class="w-full h-full object-cover opacity-30">
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-slate-800/50 flex items-end">
                                <div class="p-6 text-white">
                                    <h3 class="text-xl font-bold mb-2">Ruang Utama Lab</h3>
                                    <p class="text-sm opacity-90">28 PC Workstation untuk komputasi dan simulasi fisika</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Computer Setup -->
                    <div class="glass-luxury border border-slate-100 rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105">
                        <div class="aspect-square bg-gradient-to-br from-slate-50 to-slate-100 relative overflow-hidden">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-center">
                                    <i class="fas fa-desktop text-slate-600 text-6xl mb-4"></i>
                                    <h3 class="text-lg font-bold text-slate-800">PC Workstations</h3>
                                    <p class="text-sm text-gray-600">High-Performance Computing</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Photography Studio -->
                    <div class="glass-luxury border border-slate-100 rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105">
                        <div class="aspect-[4/3] bg-gradient-to-br from-slate-50 to-slate-100 relative overflow-hidden">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-center">
                                    <i class="fas fa-camera text-slate-600 text-5xl mb-3"></i>
                                    <h3 class="text-lg font-bold text-slate-800">Studio Fotografi</h3>
                                    <p class="text-sm text-gray-600">Digital Photography & Editing</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Software Development Area -->
                    <div class="glass-luxury border border-slate-100 rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105">
                        <div class="aspect-[4/3] bg-gradient-to-br from-slate-50 to-slate-100 relative overflow-hidden">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-center">
                                    <i class="fas fa-code text-slate-600 text-5xl mb-3"></i>
                                    <h3 class="text-lg font-bold text-slate-800">Web Development</h3>
                                    <p class="text-sm text-gray-600">Programming & Design Hub</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Geophysics Software -->
                    <div class="glass-luxury border border-slate-100 rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105">
                        <div class="aspect-square bg-gradient-to-br from-slate-50 to-slate-100 relative overflow-hidden">
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-center">
                                    <i class="fas fa-globe-americas text-slate-600 text-6xl mb-4"></i>
                                    <h3 class="text-lg font-bold text-slate-800">Software Geofisika</h3>
                                    <p class="text-sm text-gray-600">Earth Science Analysis</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Simulation Lab -->
                    <div class="glass-luxury border border-slate-100 rounded-3xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-300 hover:scale-105">
                        <div class="aspect-video bg-gradient-to-br from-slate-50 to-slate-200 relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-slate-800/50 flex items-end">
                                <div class="p-6 text-white">
                                    <h3 class="text-xl font-bold mb-2">Area Simulasi</h3>
                                    <p class="text-sm opacity-90">Computational Physics & Numerical Modeling</p>
                                </div>
                            </div>
                            <div class="absolute top-4 right-4">
                                <i class="fas fa-atom text-white text-3xl opacity-80"></i>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Section Divider -->
    <div class="section-divider"></div>
    
    <!-- Services Section / Layanan -->
    <section id="layanan" class="py-16 bg-white relative overflow-hidden section-pattern-lines section-fade-top-gray section-fade-bottom-gray">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 section-content">
        <div class="services-section">
            <h2 class="section-title text-center mb-6">Layanan Laboratorium Fisika Teori dan Komputasi</h2>
            <p class="text-gray-600 text-lg max-w-4xl mx-auto text-center mb-16">
                Laboratorium dengan <strong>28 PC workstation</strong> yang mendukung kegiatan mahasiswa dalam bidang komputasi dan simulasi, 
                fotografi digital, web design, dan software geofisika dengan teknologi terdepan.
            </p>
            
            <!-- Main Services -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-16">
                <!-- Penyewaan Alat -->
                <div class="glass-luxury border border-slate-100 rounded-3xl p-8 card-luxury shadow-2xl group h-full flex flex-col">
                    <div class="text-center mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-slate-600 to-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-all duration-300">
                            <i class="fas fa-desktop text-white text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-3">Penyewaan Workstation</h3>
                        <p class="text-gray-600 text-sm">Akses ke 28 PC workstation canggih untuk komputasi, simulasi, dan pengembangan software</p>
                    </div>
                    
                    <div class="space-y-3 mb-8 flex-grow">
                        <div class="flex items-start text-sm text-gray-600">
                            <i class="fas fa-check text-slate-600 mr-3 mt-1 flex-shrink-0"></i>
                            <span>PC High-Performance untuk Simulasi Fisika</span>
                        </div>
                        <div class="flex items-start text-sm text-gray-600">
                            <i class="fas fa-check text-slate-600 mr-3 mt-1 flex-shrink-0"></i>
                            <span>Software Geofisika dan Komputasi Terintegrasi</span>
                        </div>
                        <div class="flex items-start text-sm text-gray-600">
                            <i class="fas fa-check text-slate-600 mr-3 mt-1 flex-shrink-0"></i>
                            <span>Tools Fotografi Digital dan Web Design</span>
                        </div>
                        <div class="flex items-start text-sm text-gray-600">
                            <i class="fas fa-check text-slate-600 mr-3 mt-1 flex-shrink-0"></i>
                            <span>Environment Programming Terintegrasi</span>
                        </div>
                    </div>
                    
                    <div class="mt-auto">
                        <button class="w-full bg-gradient-to-br from-slate-600 to-slate-800 text-white py-4 px-6 rounded-xl font-semibold hover:from-slate-700 hover:to-slate-900 transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <i class="fas fa-clipboard-list mr-2"></i>
                            Ajukan Penyewaan
                        </button>
                    </div>
                </div>
                
                <!-- Kunjungan Laboratorium -->
                <div class="glass-luxury border border-slate-100 rounded-3xl p-8 card-luxury shadow-2xl group h-full flex flex-col">
                    <div class="text-center mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-slate-600 to-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-all duration-300">
                            <i class="fas fa-users text-white text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-3">Kunjungan Laboratorium</h3>
                        <p class="text-gray-600 text-sm">Program edukasi dan eksplorasi fasilitas lab untuk mendukung pembelajaran fisika komputasi</p>
                    </div>
                    
                    <div class="space-y-3 mb-8 flex-grow">
                        <div class="flex items-start text-sm text-gray-600">
                            <i class="fas fa-check text-slate-600 mr-3 mt-1 flex-shrink-0"></i>
                            <span>Tur Fasilitas 28 PC Workstation</span>
                        </div>
                        <div class="flex items-start text-sm text-gray-600">
                            <i class="fas fa-check text-slate-600 mr-3 mt-1 flex-shrink-0"></i>
                            <span>Workshop Simulasi dan Komputasi Fisika</span>
                        </div>
                        <div class="flex items-start text-sm text-gray-600">
                            <i class="fas fa-check text-slate-600 mr-3 mt-1 flex-shrink-0"></i>
                            <span>Demo Software Geofisika dan Visualisasi</span>
                        </div>
                        <div class="flex items-start text-sm text-gray-600">
                            <i class="fas fa-check text-slate-600 mr-3 mt-1 flex-shrink-0"></i>
                            <span>Sesi Konsultasi dengan Tim Ahli</span>
                        </div>
                    </div>
                    
                    <div class="mt-auto">
                        <button class="w-full bg-gradient-to-br from-slate-600 to-slate-800 text-white py-4 px-6 rounded-xl font-semibold hover:from-slate-700 hover:to-slate-900 transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <i class="fas fa-calendar-plus mr-2"></i>
                            Jadwalkan Kunjungan
                        </button>
                    </div>
                </div>
                
                <!-- Pengujian dan Analisis -->
                <div class="glass-luxury border border-slate-100 rounded-3xl p-8 card-luxury shadow-2xl group h-full flex flex-col">
                    <div class="text-center mb-6">
                        <div class="w-20 h-20 bg-gradient-to-br from-slate-600 to-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-all duration-300">
                            <i class="fas fa-chart-line text-white text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-3">Analisis & Simulasi Data</h3>
                        <p class="text-gray-600 text-sm">Layanan pengolahan data dan simulasi menggunakan computational physics dan software geofisika</p>
                    </div>
                    
                    <div class="space-y-3 mb-8 flex-grow">
                        <div class="flex items-start text-sm text-gray-600">
                            <i class="fas fa-check text-slate-600 mr-3 mt-1 flex-shrink-0"></i>
                            <span>Simulasi Numerik dan Pemodelan Fisika</span>
                        </div>
                        <div class="flex items-start text-sm text-gray-600">
                            <i class="fas fa-check text-slate-600 mr-3 mt-1 flex-shrink-0"></i>
                            <span>Analisis Data Geofisika dan Komputasi</span>
                        </div>
                        <div class="flex items-start text-sm text-gray-600">
                            <i class="fas fa-check text-slate-600 mr-3 mt-1 flex-shrink-0"></i>
                            <span>Visualisasi Data dan Rendering Grafis</span>
                        </div>
                        <div class="flex items-start text-sm text-gray-600">
                            <i class="fas fa-check text-slate-600 mr-3 mt-1 flex-shrink-0"></i>
                            <span>Laporan Analisis Komprehensif</span>
                        </div>
                    </div>
                    
                    <div class="mt-auto">
                        <button class="w-full bg-gradient-to-br from-slate-600 to-slate-800 text-white py-4 px-6 rounded-xl font-semibold hover:from-slate-700 hover:to-slate-900 transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <i class="fas fa-chart-bar mr-2"></i>
                            Request Analisis
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Lab Specializations -->
            <div class="bg-slate-50 rounded-3xl p-8 mb-8">
                <h3 class="text-2xl font-bold text-slate-800 text-center mb-8">Spesialisasi Lab Fisika Teori dan Komputasi</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="glass-luxury border border-slate-100 rounded-2xl p-6 card-hover text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-slate-600 to-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-calculator text-white text-2xl"></i>
                        </div>
                        <h4 class="font-bold text-slate-800 mb-3">Komputasi & Simulasi</h4>
                        <p class="text-gray-600 text-sm">Simulasi fisika teoritis dan komputasi numerik untuk penelitian mahasiswa</p>
                    </div>
                    
                    <div class="glass-luxury border border-slate-100 rounded-2xl p-6 card-hover text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-slate-600 to-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-camera text-white text-2xl"></i>
                        </div>
                        <h4 class="font-bold text-slate-800 mb-3">Fotografi Digital</h4>
                        <p class="text-gray-600 text-sm">Workshop dan praktik fotografi digital untuk dokumentasi ilmiah dan kreatif</p>
                    </div>
                    
                    <div class="glass-luxury border border-slate-100 rounded-2xl p-6 card-hover text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-slate-600 to-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-code text-white text-2xl"></i>
                        </div>
                        <h4 class="font-bold text-slate-800 mb-3">Web Design</h4>
                        <p class="text-gray-600 text-sm">Pengembangan web untuk portofolio ilmiah dan presentasi hasil penelitian</p>
                    </div>
                    
                    <div class="glass-luxury border border-slate-100 rounded-2xl p-6 card-hover text-center">
                        <div class="w-16 h-16 bg-gradient-to-br from-slate-600 to-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-globe text-white text-2xl"></i>
                        </div>
                        <h4 class="font-bold text-slate-800 mb-3">Software Geofisika</h4>
                        <p class="text-gray-600 text-sm">Aplikasi khusus geofisika untuk analisis data bumi dan simulasi geologi</p>
                    </div>
                </div>
            </div>
            

        </div>
    </div>
    </section>

    <!-- Facilities Section / Fasilitas -->
    <section id="fasilitas" class="py-16 bg-gray-50 relative overflow-hidden section-pattern-mesh section-fade-top section-fade-bottom">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 section-content">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-8 section-title">Fasilitas Lab Fisika Teori dan Komputasi</h2>
            <p class="text-gray-600 text-lg max-w-4xl mx-auto">
                Dilengkapi dengan infrastruktur modern untuk mendukung kegiatan komputasi, simulasi, fotografi, web design, dan software geofisika
            </p>
        </div>
        
        <!-- Main Facilities -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-16">
            <!-- PC Workstations -->
            <div class="glass-luxury border border-slate-100 rounded-3xl p-8 card-luxury shadow-2xl">
                <div class="flex items-start space-x-6">
                    <div class="w-20 h-20 bg-gradient-to-br from-slate-600 to-slate-800 rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-desktop text-white text-3xl"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold text-slate-800 mb-4">28 PC Workstations</h3>
                        <p class="text-gray-600 mb-6">Unit komputer high-performance yang dapat digunakan secara optimal oleh mahasiswa untuk berbagai kegiatan komputasi dan kreatif.</p>
                        
                        <div class="space-y-3">
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-check text-slate-600 mr-3"></i>
                                <span>Spesifikasi high-end untuk simulasi fisika</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-check text-slate-600 mr-3"></i>
                                <span>Optimized untuk komputasi intensif</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-check text-slate-600 mr-3"></i>
                                <span>Koneksi jaringan berkecepatan tinggi</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Software Ecosystem -->
            <div class="glass-luxury border border-slate-100 rounded-3xl p-8 card-luxury shadow-2xl">
                <div class="flex items-start space-x-6">
                    <div class="w-20 h-20 bg-gradient-to-br from-slate-600 to-slate-800 rounded-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-layer-group text-white text-3xl"></i>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-2xl font-bold text-slate-800 mb-4">Software Terintegrasi</h3>
                        <p class="text-gray-600 mb-6">Ecosystem software lengkap untuk mendukung seluruh kegiatan mahasiswa dari komputasi hingga kreatif.</p>
                        
                        <div class="space-y-3">
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-check text-slate-600 mr-3"></i>
                                <span>Software komputasi fisika dan matematis</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-check text-slate-600 mr-3"></i>
                                <span>Tools fotografi dan editing profesional</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <i class="fas fa-check text-slate-600 mr-3"></i>
                                <span>Platform web development modern</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Specialized Areas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <div class="glass-luxury border border-slate-100 rounded-2xl p-6 card-hover text-center">
                <div class="w-16 h-16 bg-gradient-to-br from-slate-600 to-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-atom text-white text-2xl"></i>
                </div>
                <h4 class="font-bold text-slate-800 mb-3">Simulasi Fisika</h4>
                <p class="text-gray-600 text-sm">Area khusus untuk simulasi dan pemodelan fisika teoritis</p>
            </div>
            
            <div class="glass-luxury border border-slate-100 rounded-2xl p-6 card-hover text-center">
                <div class="w-16 h-16 bg-gradient-to-br from-slate-600 to-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-camera-retro text-white text-2xl"></i>
                </div>
                <h4 class="font-bold text-slate-800 mb-3">Studio Fotografi</h4>
                <p class="text-gray-600 text-sm">Ruang untuk praktik fotografi digital dan editing</p>
            </div>
            
            <div class="glass-luxury border border-slate-100 rounded-2xl p-6 card-hover text-center">
                <div class="w-16 h-16 bg-gradient-to-br from-slate-600 to-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-laptop-code text-white text-2xl"></i>
                </div>
                <h4 class="font-bold text-slate-800 mb-3">Web Development</h4>
                <p class="text-gray-600 text-sm">Zone untuk pengembangan web dan aplikasi</p>
            </div>
            
            <div class="glass-luxury border border-slate-100 rounded-2xl p-6 card-hover text-center">
                <div class="w-16 h-16 bg-gradient-to-br from-slate-600 to-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-globe-americas text-white text-2xl"></i>
                </div>
                <h4 class="font-bold text-slate-800 mb-3">Geofisika</h4>
                <p class="text-gray-600 text-sm">Software khusus untuk analisis dan simulasi geofisika</p>
            </div>
        </div>
        
        <!-- Technical Specifications -->
        <div class="glass-luxury border border-slate-100 rounded-3xl p-8 card-luxury shadow-2xl">
            <h3 class="text-2xl font-bold text-slate-800 text-center mb-8">Spesifikasi Teknis</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-slate-600 to-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-microchip text-white text-2xl"></i>
                    </div>
                    <h4 class="font-bold text-slate-800 mb-2">Hardware</h4>
                    <p class="text-gray-600 text-sm">Processor multi-core, RAM 16GB+, Storage SSD untuk performa optimal</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-slate-600 to-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-network-wired text-white text-2xl"></i>
                    </div>
                    <h4 class="font-bold text-slate-800 mb-2">Konektivitas</h4>
                    <p class="text-gray-600 text-sm">Jaringan gigabit ethernet dengan akses internet berkecepatan tinggi</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-slate-600 to-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shield-alt text-white text-2xl"></i>
                    </div>
                    <h4 class="font-bold text-slate-800 mb-2">Keamanan</h4>
                    <p class="text-gray-600 text-sm">Sistem backup otomatis dan security protocols untuk melindungi data penelitian</p>
                </div>
            </div>
        </div>
    </div>
    </section>

    <!-- Formulir Online Section -->
    <section id="formulir" class="py-16 bg-slate-50 relative overflow-hidden section-pattern-hexagon section-fade-top section-fade-bottom">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 section-content">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-8 section-title">Formulir Online</h2>
                <p class="text-gray-600 text-lg max-w-3xl mx-auto">
                    Ajukan permohonan layanan laboratorium secara online dengan mudah dan cepat
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Formulir Penyewaan Alat -->
                <div class="glass-luxury border border-slate-100 rounded-3xl p-8 card-luxury shadow-2xl h-full flex flex-col">
                    <div class="text-center mb-8">
                        <div class="w-20 h-20 bg-gradient-to-br from-slate-600 to-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-desktop text-white text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-2">Formulir Penyewaan Workstation</h3>
                        <p class="text-gray-600 text-sm">Sewa workstation dan peralatan laboratorium untuk kebutuhan penelitian Anda</p>
                    </div>
                    
                    <form class="space-y-4 flex-grow flex flex-col" id="rentalForm">
                        <div class="space-y-4 flex-grow">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" name="name" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-300">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Institusi/Universitas</label>
                                <input type="text" name="institution" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-300">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" name="email" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-300">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Workstation/Alat yang Disewa</label>
                                <select name="equipment" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-300">
                                    <option value="">Pilih Workstation/Alat</option>
                                    <option value="pc_high_performance">PC High-Performance Workstation</option>
                                    <option value="software_geofisika">Software License Spesialis</option>
                                    <option value="tools_fotografi">Workstation + Software Package</option>
                                    <option value="environment_programming">Instrumentasi Penelitian</option>
                                </select>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                                    <input type="date" name="start_date" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-300">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai</label>
                                    <input type="date" name="end_date" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-300">
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tujuan Penelitian</label>
                                <textarea name="purpose" rows="3" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-300 resize-none"></textarea>
                            </div>
                        </div>
                        
                        <div class="mt-auto pt-4">
                            <button type="submit" class="w-full bg-gradient-to-br from-slate-600 to-slate-800 text-white py-4 px-6 rounded-xl font-semibold hover:from-slate-700 hover:to-slate-900 transition-all duration-300 transform hover:scale-105 shadow-lg">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Kirim Permohonan
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Formulir Kunjungan -->
                <div class="glass-luxury border border-slate-100 rounded-3xl p-8 card-luxury shadow-2xl h-full flex flex-col">
                    <div class="text-center mb-8">
                        <div class="w-20 h-20 bg-gradient-to-br from-slate-600 to-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-users text-white text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-2">Formulir Kunjungan Lab</h3>
                        <p class="text-gray-600 text-sm">Daftarkan kunjungan edukatif atau riset ke laboratorium fisika komputasi</p>
                    </div>
                    
                    <form class="space-y-4 flex-grow flex flex-col" id="visitForm">
                        <div class="space-y-4 flex-grow">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama PIC</label>
                                <input type="text" name="pic_name" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-300">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Institusi/Sekolah</label>
                                <input type="text" name="institution" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-300">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kontak</label>
                                <input type="tel" name="phone" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-300">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kunjungan</label>
                                <select name="visit_type" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-300">
                                    <option value="">Pilih Jenis</option>
                                    <option value="tur_fasilitas">Kunjungan Edukatif</option>
                                    <option value="workshop_simulasi">Kunjungan Riset</option>
                                    <option value="demo_software">Kunjungan Industri</option>
                                    <option value="konsultasi_ahli">Kunjungan Kerjasama</option>
                                </select>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Kunjungan</label>
                                    <input type="date" name="visit_date" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-300">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Peserta</label>
                                    <input type="number" name="participants" min="1" max="50" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-300">
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tujuan & Ekspektasi</label>
                                <textarea name="objectives" rows="3" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-300 resize-none"></textarea>
                            </div>
                        </div>
                        
                        <div class="mt-auto pt-4">
                            <button type="submit" class="w-full bg-gradient-to-br from-slate-600 to-slate-800 text-white py-4 px-6 rounded-xl font-semibold hover:from-slate-700 hover:to-slate-900 transition-all duration-300 transform hover:scale-105 shadow-lg">
                                <i class="fas fa-calendar-check mr-2"></i>
                                Ajukan Kunjungan
                            </button>
                        </div>
                    </form>
                </div>
                
                <!-- Formulir Pengujian -->
                <div class="glass-luxury border border-slate-100 rounded-3xl p-8 card-luxury shadow-2xl h-full flex flex-col">
                    <div class="text-center mb-8">
                        <div class="w-20 h-20 bg-gradient-to-br from-slate-600 to-slate-800 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-chart-line text-white text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-2">Formulir Analisis & Simulasi</h3>
                        <p class="text-gray-600 text-sm">Request analisis data dan simulasi menggunakan computational physics</p>
                    </div>
                    
                    <form class="space-y-4 flex-grow flex flex-col" id="testingForm">
                        <div class="space-y-4 flex-grow">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Peneliti</label>
                                <input type="text" name="researcher_name" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-300">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Afiliasi</label>
                                <input type="text" name="affiliation" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-300">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" name="email" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-300">
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Analisis</label>
                                <select name="test_type" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-300">
                                    <option value="">Pilih Jenis</option>
                                    <option value="simulasi_numerik">Simulasi Numerik & Pemodelan</option>
                                    <option value="analisis_data_geofisika">Analisis Data Geofisika</option>
                                    <option value="visualisasi_data">Mathematical Modeling</option>
                                    <option value="laporan_komprehensif">Computational Physics</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Data/Problem</label>
                                <textarea name="sample_description" rows="3" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-300 resize-none"></textarea>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Parameter yang Dianalisis</label>
                                <textarea name="parameters" rows="2" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-300 resize-none"></textarea>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Target Deadline</label>
                                <input type="date" name="deadline" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-300">
                            </div>
                        </div>
                        
                        <div class="mt-auto pt-4">
                            <button type="submit" class="w-full bg-gradient-to-br from-slate-600 to-slate-800 text-white py-4 px-6 rounded-xl font-semibold hover:from-slate-700 hover:to-slate-900 transition-all duration-300 transform hover:scale-105 shadow-lg">
                                <i class="fas fa-chart-bar mr-2"></i>
                                Request Analisis
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Form Processing Info -->
            <div class="mt-12 text-center">
                <div class="glass-luxury border border-slate-100 rounded-2xl p-8 max-w-4xl mx-auto">
                    <h4 class="text-lg font-bold text-slate-800 mb-4">Proses Persetujuan</h4>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="text-center">
                            <div class="w-12 h-12 bg-slate-700 rounded-full flex items-center justify-center mx-auto mb-3">
                                <span class="text-white font-bold">1</span>
                            </div>
                            <h5 class="font-semibold text-slate-800 mb-2">Submit Formulir</h5>
                            <p class="text-gray-600 text-sm">Isi dan kirim formulir permohonan online</p>
                        </div>
                        <div class="text-center">
                            <div class="w-12 h-12 bg-slate-700 rounded-full flex items-center justify-center mx-auto mb-3">
                                <span class="text-white font-bold">2</span>
                            </div>
                            <h5 class="font-semibold text-slate-800 mb-2">Review & Verifikasi</h5>
                            <p class="text-gray-600 text-sm">Tim kami akan review dan verifikasi dalam 1-2 hari kerja</p>
                        </div>
                        <div class="text-center">
                            <div class="w-12 h-12 bg-slate-700 rounded-full flex items-center justify-center mx-auto mb-3">
                                <span class="text-white font-bold">3</span>
                            </div>
                            <h5 class="font-semibold text-slate-800 mb-2">Konfirmasi</h5>
                            <p class="text-gray-600 text-sm">Anda akan menerima konfirmasi via email</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section / Kontak -->
    <section id="kontak" class="py-16 bg-white relative overflow-hidden section-pattern-hexagon section-fade-top-gray">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 section-content">
            <div class="text-center mb-12">
                <h2 class="section-title">Hubungi Kami</h2>
                <p class="text-gray-600 text-lg max-w-3xl mx-auto">
                    Bergabunglah dengan komunitas peneliti computational physics terdepan di Indonesia
                </p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                <!-- Contact Form -->
                <div class="space-y-8">
                    <div class="glass-luxury border border-slate-100 rounded-3xl p-8 card-luxury">
                        <h3 class="text-2xl font-bold text-slate-800 mb-6">Kirim Pesan</h3>
                        <form id="contactForm" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="contact_name" class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                                    <input type="text" id="contact_name" name="name" required 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-300"
                                           placeholder="Nama lengkap">
                                </div>
                                <div>
                                    <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                    <input type="email" id="contact_email" name="email" required 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-300"
                                           placeholder="email@example.com">
                                </div>
                            </div>
                            
                            <div>
                                <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-2">Telepon</label>
                                <input type="tel" id="contact_phone" name="phone" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-300"
                                       placeholder="+62 XXX XXXX XXXX">
                            </div>
                            
                            <div>
                                <label for="contact_subject" class="block text-sm font-medium text-gray-700 mb-2">Subjek</label>
                                <select id="contact_subject" name="subject" required 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-300">
                                    <option value="">Pilih topik</option>
                                    <option value="konsultasi">Konsultasi Penelitian</option>
                                    <option value="layanan">Informasi Layanan</option>
                                    <option value="kerjasama">Kerjasama Riset</option>
                                    <option value="fasilitas">Akses Fasilitas</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>
                            
                            <div>
                                <label for="contact_message" class="block text-sm font-medium text-gray-700 mb-2">Pesan</label>
                                <textarea id="contact_message" name="message" rows="5" required 
                                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-300 resize-none"
                                          placeholder="Jelaskan kebutuhan atau pertanyaan Anda..."></textarea>
                            </div>
                            
                            <button type="submit" class="btn-luxury text-white px-8 py-4 rounded-2xl font-semibold text-lg w-full inline-flex items-center justify-center">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>
                
                <!-- Map and Contact Info -->
                <div class="space-y-8">
                    <!-- Interactive Map -->
                    <div class="glass-luxury border border-slate-100 rounded-3xl p-8 card-luxury">
                        <h3 class="text-2xl font-bold text-slate-800 mb-6">Lokasi Kami</h3>
                        <div class="relative group">
                            <div id="map-container" class="w-full h-72 rounded-2xl overflow-hidden shadow-lg cursor-pointer relative bg-gray-100">
                                <iframe 
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3970.8473854743044!2d95.36282751476085!3d5.566856995407445!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x304039e1e9b8c5e5%3A0x3039d80b220cb90!2sUniversitas%20Syiah%20Kuala!5e0!3m2!1sen!2sid!4v1623456789000!5m2!1sen!2sid"
                                    width="100%" 
                                    height="100%" 
                                    style="border:0;" 
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    referrerpolicy="no-referrer-when-downgrade"
                                    class="transition-all duration-300 group-hover:grayscale-0 grayscale">
                                </iframe>
                                
                                <!-- Map Tooltip -->
                                <div class="absolute top-4 left-4 bg-slate-800 text-white px-4 py-2 rounded-xl opacity-0 group-hover:opacity-100 transition-all duration-300 transform translate-y-2 group-hover:translate-y-0">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                        <span class="text-sm font-medium">Universitas Syiah Kuala</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Contact Details -->
                    <div class="space-y-4">
                        <div class="glass-luxury border border-slate-100 rounded-2xl p-6 card-hover">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-slate-700 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-map-marker-alt text-white text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800">Alamat</h4>
                                    <p class="text-gray-600 text-sm">Lab. Fisika Komputasi, FMIPA USK<br>Jl. Syiah Kuala No. 1, Banda Aceh</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="glass-luxury border border-slate-100 rounded-2xl p-6 card-hover">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-slate-700 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-envelope text-white text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800">Email</h4>
                                    <p class="text-gray-600 text-sm">fiscomp@unsyiah.ac.id</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="glass-luxury border border-slate-100 rounded-2xl p-6 card-hover">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-slate-700 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-phone text-white text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800">Telepon</h4>
                                    <p class="text-gray-600 text-sm">+62 651 7551234</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="glass-luxury border border-slate-100 rounded-2xl p-6 card-hover">
                            <div class="flex items-center space-x-4">
                                <div class="w-12 h-12 bg-slate-700 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-clock text-white text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800">Jam Operasional</h4>
                                    <p class="text-gray-600 text-sm">Senin - Jumat: 08:00 - 16:00 WIB</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                </div>
            </div>
        </div>
    </section>

    <!-- Person in Charge Section - Full Width -->
    <section class="py-16 bg-slate-50 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-8">Person in Charge</h2>
                <p class="text-gray-600 text-lg max-w-3xl mx-auto">
                    Tim ahli yang siap membantu kebutuhan penelitian dan layanan laboratorium Anda
                </p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- PIC 1 -->
                <div class="glass-luxury border border-slate-100 rounded-3xl p-8 text-center hover:shadow-xl transition-all duration-300 card-hover">
                    <div class="w-24 h-24 bg-gradient-to-br from-slate-600 to-slate-800 rounded-3xl flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-user-tie text-white text-3xl"></i>
                    </div>
                    <h4 class="font-bold text-slate-800 text-xl mb-2">Dr. Eng. Ahmad Farhan, M.Sc</h4>
                    <p class="text-slate-600 font-medium mb-6">Kepala Laboratorium Fisika Komputasi</p>
                    <div class="space-y-3 text-sm text-gray-600">
                        <div class="flex items-center justify-center">
                            <i class="fas fa-envelope w-5 mr-3 text-slate-600"></i>
                            <span class="break-all">ahmad.farhan@unsyiah.ac.id</span>
                        </div>
                        <div class="flex items-center justify-center">
                            <i class="fas fa-phone w-5 mr-3 text-slate-600"></i>
                            <span>+62 812 3456 7890</span>
                        </div>
                        <div class="flex items-center justify-center">
                            <i class="fas fa-clock w-5 mr-3 text-slate-600"></i>
                            <span>Konsultasi: Senin-Kamis 09:00-15:00</span>
                        </div>
                    </div>
                </div>
                
                <!-- PIC 2 -->
                <div class="glass-luxury border border-slate-100 rounded-3xl p-8 text-center hover:shadow-xl transition-all duration-300 card-hover">
                    <div class="w-24 h-24 bg-gradient-to-br from-slate-600 to-slate-800 rounded-3xl flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-users text-white text-3xl"></i>
                    </div>
                    <h4 class="font-bold text-slate-800 text-xl mb-2">Dr. Siti Aminah, M.Eng</h4>
                    <p class="text-slate-600 font-medium mb-6">Koordinator Layanan & Fasilitas</p>
                    <div class="space-y-3 text-sm text-gray-600">
                        <div class="flex items-center justify-center">
                            <i class="fas fa-envelope w-5 mr-3 text-slate-600"></i>
                            <span class="break-all">siti.aminah@unsyiah.ac.id</span>
                        </div>
                        <div class="flex items-center justify-center">
                            <i class="fas fa-phone w-5 mr-3 text-slate-600"></i>
                            <span>+62 813 4567 8901</span>
                        </div>
                        <div class="flex items-center justify-center">
                            <i class="fas fa-clock w-5 mr-3 text-slate-600"></i>
                            <span>Layanan: Senin-Jumat 08:00-16:00</span>
                        </div>
                    </div>
                </div>
                
                <!-- PIC 3 -->
                <div class="glass-luxury border border-slate-100 rounded-3xl p-8 text-center hover:shadow-xl transition-all duration-300 card-hover">
                    <div class="w-24 h-24 bg-gradient-to-br from-slate-600 to-slate-800 rounded-3xl flex items-center justify-center mb-6 mx-auto">
                        <i class="fas fa-cogs text-white text-3xl"></i>
                    </div>
                    <h4 class="font-bold text-slate-800 text-xl mb-2">M. Rizki Pratama, S.Kom</h4>
                    <p class="text-slate-600 font-medium mb-6">Teknisi IT & Support Sistem</p>
                    <div class="space-y-3 text-sm text-gray-600">
                        <div class="flex items-center justify-center">
                            <i class="fas fa-envelope w-5 mr-3 text-slate-600"></i>
                            <span class="break-all">rizki.pratama@unsyiah.ac.id</span>
                        </div>
                        <div class="flex items-center justify-center">
                            <i class="fas fa-phone w-5 mr-3 text-slate-600"></i>
                            <span>+62 814 5678 9012</span>
                        </div>
                        <div class="flex items-center justify-center">
                            <i class="fas fa-clock w-5 mr-3 text-slate-600"></i>
                            <span>Support: Senin-Jumat 08:00-17:00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Minimalist Glassmorphism Footer -->
    <footer class="footer">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="footer-content">
                <div class="footer-main">
                    <div class="footer-brand">
                        <img src="{{ asset('images/logo-fisika-putih.png') }}" alt="Lab Fisika Komputasi" class="footer-logo">
                    </div>
                    
                    <div class="footer-links">
                        <a href="#beranda" class="footer-link">Beranda</a>
                        <a href="#staf" class="footer-link">Staf Ahli</a>
                        <a href="#layanan" class="footer-link">Layanan</a>
                        <a href="#fasilitas" class="footer-link">Fasilitas</a>
                        <a href="#kontak" class="footer-link">Kontak</a>
                    </div>
                </div>
                
                <div class="footer-divider"></div>
                
                <div class="footer-copyright">
                    &copy; {{ date('Y') }} Laboratorium Fisika Komputasi - FMIPA Universitas Syiah Kuala
                </div>
            </div>
        </div>
    </footer>

    <!-- Login Modal -->
    <div id="loginModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
        <div class="glass-luxury border border-slate-100 rounded-3xl p-8 mx-4 w-full max-w-md transform scale-95 transition-all duration-300" id="loginModalContent">
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold text-navy mb-2">Login Admin</h2>
                <p class="text-gray-600">Masuk ke sistem manajemen laboratorium</p>
            </div>
            
            <form action="/login" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" id="email" name="email" required 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-300">
                </div>
                
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" id="password" name="password" required autocomplete="current-password"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all duration-300">
                </div>
                
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-slate-600 shadow-sm focus:border-slate-300 focus:ring focus:ring-slate-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-600">Remember me</span>
                    </label>
                </div>
                
                <button type="submit" class="btn-luxury text-white px-8 py-3 rounded-xl font-semibold text-lg w-full">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Masuk
                </button>
            </form>
            
            <button onclick="closeLoginModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors duration-300">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
    </div>

    <script>
        // Loading animation
        window.addEventListener('load', function() {
            const loadingBar = document.getElementById('loadingBar');
            if (loadingBar) {
                loadingBar.style.width = '100%';
                setTimeout(() => {
                    loadingBar.style.opacity = '0';
                }, 500);
            }
        });

        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (navbar) {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            }
        });

        // Simple typing animation - single text
        const typeWriter = {
            text: 'Laboratorium Fisika Komputasi',
            currentCharIndex: 0,
            hasFinished: false,
            
            type() {
                if (this.hasFinished) return;
                
                const typingElement = document.getElementById('typing-text');
                
                // Check if element exists before manipulating it
                if (!typingElement) {
                    console.warn('typing-text element not found');
                    return;
                }
                
                if (this.currentCharIndex < this.text.length) {
                    typingElement.textContent = this.text.substring(0, this.currentCharIndex + 1);
                    this.currentCharIndex++;
                    setTimeout(() => this.type(), 100);
                } else {
                    this.hasFinished = true;
                }
            }
        };

        // Counter animation
        function animateCounters() {
            const counters = document.querySelectorAll('.stat-number');
            
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-count'));
                if (isNaN(target)) return; // Skip if target is not a valid number
                
                let count = 0;
                const increment = target / 50;
                
                const updateCounter = () => {
                    if (count < target) {
                        count += increment;
                        counter.textContent = Math.ceil(count) + '+';
                        setTimeout(updateCounter, 50);
                    } else {
                        counter.textContent = target + '+';
                    }
                };
                
                updateCounter();
            });
        }

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in');
                    
                    if (entry.target.classList.contains('hero-stats')) {
                        animateCounters();
                    }
                }
            });
        }, observerOptions);

        // Observe elements
        document.addEventListener('DOMContentLoaded', function() {
            const elementsToAnimate = document.querySelectorAll('.service-card, .facility-item, .hero-stats');
            elementsToAnimate.forEach(el => observer.observe(el));
            
            // Start typing animation only if element exists
            const typingElement = document.getElementById('typing-text');
            if (typingElement) {
                setTimeout(() => typeWriter.type(), 1000);
            }
        });

        // Smooth scrolling for navigation links
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', function(e) {
                if (this.getAttribute('href').startsWith('#')) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });

        // Particle background effect
        function createParticles() {
            // Only create particles if we're not on mobile to improve performance
            if (window.innerWidth < 768) return;
            
            const particleCount = 30; // Reduced count for better performance
            const particles = [];
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.style.position = 'fixed';
                particle.style.width = '2px';
                particle.style.height = '2px';
                particle.style.background = 'rgba(102, 126, 234, 0.3)'; // Reduced opacity
                particle.style.borderRadius = '50%';
                particle.style.pointerEvents = 'none';
                particle.style.zIndex = '1';
                
                particle.style.left = Math.random() * window.innerWidth + 'px';
                particle.style.top = Math.random() * window.innerHeight + 'px';
                
                document.body.appendChild(particle);
                particles.push({
                    element: particle,
                    x: Math.random() * window.innerWidth,
                    y: Math.random() * window.innerHeight,
                    vx: (Math.random() - 0.5) * 0.3, // Reduced speed
                    vy: (Math.random() - 0.5) * 0.3
                });
            }
            
            let animationId;
            function animateParticles() {
                particles.forEach(particle => {
                    particle.x += particle.vx;
                    particle.y += particle.vy;
                    
                    if (particle.x < 0 || particle.x > window.innerWidth) particle.vx *= -1;
                    if (particle.y < 0 || particle.y > window.innerHeight) particle.vy *= -1;
                    
                    particle.element.style.left = particle.x + 'px';
                    particle.element.style.top = particle.y + 'px';
                });
                
                animationId = requestAnimationFrame(animateParticles);
            }
            
            animateParticles();
            
            // Clean up on page unload
            window.addEventListener('beforeunload', () => {
                if (animationId) {
                    cancelAnimationFrame(animationId);
                }
                particles.forEach(particle => {
                    if (particle.element && particle.element.parentNode) {
                        particle.element.parentNode.removeChild(particle.element);
                    }
                });
            });
        }

        // Initialize particles on load with delay
        window.addEventListener('load', () => {
            setTimeout(createParticles, 1000);
        });
        
        // Online Forms Handling
        function initOnlineForms() {
            // Rental Form (Workstation)
            const rentalForm = document.getElementById('rentalForm');
            if (rentalForm) {
                rentalForm.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    
                    const submitBtn = rentalForm.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengirim...';
                    submitBtn.disabled = true;
                    
                    try {
                        const formData = new FormData(rentalForm);
                        
                        // Map form fields to backend expected fields
                        const data = {
                            name: formData.get('name'),
                            institution: formData.get('institution'),
                            email: formData.get('email'),
                            workstation_type: formData.get('equipment'), // map equipment to workstation_type
                            start_date: formData.get('start_date'),
                            end_date: formData.get('end_date'),
                            research_purpose: formData.get('purpose')
                        };
                        
                        console.log('Sending workstation data:', data);
                        
                        const response = await fetch('/workstation', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify(data)
                        });
                        
                        console.log('Response status:', response.status);
                        const result = await response.json();
                        console.log('Response data:', result);
                        
                        if (result.success) {
                            showSuccessNotification(result.message);
                            rentalForm.reset();
                        } else {
                            showNotification(result.message || 'Terjadi kesalahan saat mengirim permohonan', 'error');
                        }
                    } catch (error) {
                        console.error('Workstation submission error:', error);
                        showNotification('Terjadi kesalahan saat mengirim permohonan. Silakan coba lagi.', 'error');
                    } finally {
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }
                });
            }
            
            // Visit Form (Lab Visit)
            const visitForm = document.getElementById('visitForm');
            if (visitForm) {
                visitForm.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    
                    const submitBtn = visitForm.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengirim...';
                    submitBtn.disabled = true;
                    
                    try {
                        const formData = new FormData(visitForm);
                        
                        const data = {
                            pic_name: formData.get('pic_name'),
                            institution: formData.get('institution'),
                            contact: formData.get('phone'), // map phone to contact
                            visit_type: formData.get('visit_type'),
                            visit_date: formData.get('visit_date'),
                            participant_count: formData.get('participants'), // map participants to participant_count
                            purpose_expectations: formData.get('objectives') // map objectives to purpose_expectations
                        };
                        
                        console.log('Sending lab visit data:', data);
                        
                        const response = await fetch('/lab-visit', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify(data)
                        });
                        
                        console.log('Lab visit response status:', response.status);
                        const result = await response.json();
                        console.log('Lab visit response data:', result);
                        
                        if (result.success) {
                            showSuccessNotification(result.message);
                            visitForm.reset();
                        } else {
                            showNotification(result.message || 'Terjadi kesalahan saat mengirim pengajuan', 'error');
                        }
                    } catch (error) {
                        console.error('Lab visit submission error:', error);
                        showNotification('Terjadi kesalahan saat mengirim pengajuan. Silakan coba lagi.', 'error');
                    } finally {
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }
                });
            }
            
            // Testing Form (Analysis)
            const testingForm = document.getElementById('testingForm');
            if (testingForm) {
                testingForm.addEventListener('submit', async function(e) {
                    e.preventDefault();
                    
                    const submitBtn = testingForm.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengirim...';
                    submitBtn.disabled = true;
                    
                    try {
                        const formData = new FormData(testingForm);
                        
                        const data = {
                            researcher_name: formData.get('researcher_name'),
                            affiliation: formData.get('affiliation'),
                            email: formData.get('email'),
                            analysis_type: formData.get('test_type'), // map test_type to analysis_type
                            data_description: formData.get('sample_description'), // map sample_description to data_description
                            analysis_parameters: formData.get('parameters'),
                            target_deadline: formData.get('deadline')
                        };
                        
                        console.log('Sending analysis data:', data);
                        
                        const response = await fetch('/analysis', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify(data)
                        });
                        
                        console.log('Analysis response status:', response.status);
                        const result = await response.json();
                        console.log('Analysis response data:', result);
                        
                        if (result.success) {
                            showSuccessNotification(result.message);
                            testingForm.reset();
                        } else {
                            showNotification(result.message || 'Terjadi kesalahan saat mengirim request', 'error');
                        }
                    } catch (error) {
                        console.error('Analysis submission error:', error);
                        showNotification('Terjadi kesalahan saat mengirim request. Silakan coba lagi.', 'error');
                    } finally {
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }
                });
            }
        }

        // Contact Form Handling
        function initContactForm() {
            const contactForm = document.getElementById('contactForm');
            if (contactForm) {
                contactForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    // Get form data
                    const formData = new FormData(contactForm);
                    const name = formData.get('name');
                    const email = formData.get('email');
                    const phone = formData.get('phone');
                    const subject = formData.get('subject');
                    const message = formData.get('message');
                    
                    // Basic validation
                    if (!name || !email || !subject || !message) {
                        showNotification('Mohon lengkapi semua field yang wajib diisi.', 'error');
                        return;
                    }
                    
                    // Disable submit button
                    const submitBtn = contactForm.querySelector('button[type="submit"]');
                    const originalText = submitBtn.innerHTML;
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengirim...';
                    submitBtn.disabled = true;
                    
                    // Simulate form submission
                    setTimeout(() => {
                        showNotification('Pesan berhasil dikirim! Tim kami akan segera menghubungi Anda.', 'success');
                        contactForm.reset();
                        
                        // Reset button
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }, 2000);
                });
            }
        }
        
        // Success notification helper
        function showSuccessNotification(message) {
            showNotification(message, 'success');
        }
        
        // Notification System
        function showNotification(message, type = 'info') {
            // Remove existing notifications
            const existingNotifications = document.querySelectorAll('.notification');
            existingNotifications.forEach(notification => notification.remove());
            
            // Create notification
            const notification = document.createElement('div');
            notification.className = `notification fixed top-20 right-6 z-50 p-4 rounded-2xl shadow-2xl transform translate-x-full transition-all duration-500 max-w-sm`;
            
            const bgColor = type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-slate-600';
            notification.classList.add(bgColor);
            
            notification.innerHTML = `
                <div class="flex items-center text-white">
                    <div class="mr-3">
                        <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'error' ? 'fa-exclamation-circle' : 'fa-info-circle'}"></i>
                    </div>
                    <div class="flex-1">
                        <p class="font-medium">${message}</p>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-3 text-white hover:text-gray-200">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            
            
            document.body.appendChild(notification);
            
            // Show notification
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => notification.remove(), 5000);
            }, 5000);
        }
        
        // Staff Card Interactions
        function initStaffCards() {
            const staffCards = document.querySelectorAll('.staff-card');
            
            staffCards.forEach(card => {
                // Email button click
                const emailBtn = card.querySelector('.email-btn');
                if (emailBtn) {
                    emailBtn.addEventListener('click', function(e) {
                        e.stopPropagation();
                        const staffName = card.querySelector('.staff-name').textContent;
                        window.location.href = `mailto:fiscomp@unsyiah.ac.id?subject=Konsultasi dengan ${staffName}`;
                    });
                }
                
                // Profile button click
                const profileBtn = card.querySelector('.profile-btn');
                if (profileBtn) {
                    profileBtn.addEventListener('click', function(e) {
                        e.stopPropagation();
                        showNotification('Fitur profil detail akan segera tersedia.', 'info');
                    });
                }
                
                // Add ripple effect on card click
                card.addEventListener('click', function(e) {
                    if (!e.target.closest('.staff-contact-btn')) {
                        const ripple = document.createElement('span');
                        const rect = card.getBoundingClientRect();
                        const size = Math.max(rect.width, rect.height);
                        const x = e.clientX - rect.left - size / 2;
                        const y = e.clientY - rect.top - size / 2;
                        
                        ripple.style.cssText = `
                            position: absolute;
                            border-radius: 50%;
                            background: rgba(30, 41, 59, 0.1);
                            transform: scale(0);
                            animation: ripple 0.6s linear;
                            left: ${x}px;
                            top: ${y}px;
                            width: ${size}px;
                            height: ${size}px;
                            pointer-events: none;
                        `;
                        
                        card.appendChild(ripple);
                        
                        setTimeout(() => ripple.remove(), 600);
                    }
                });
            });
        }
        
        // Add CSS for ripple animation
        const rippleCSS = `
            @keyframes ripple {
                to {
                    transform: scale(2);
                    opacity: 0;
                }
            }
        `;
        
        const style = document.createElement('style');
        style.textContent = rippleCSS;
        document.head.appendChild(style);

        // ===== LUXURY ENHANCEMENTS JAVASCRIPT =====
        
        // Create floating particles
        function createLuxuryParticles() {
            const particlesContainer = document.getElementById('particles');
            if (!particlesContainer) return;
            
            const particleCount = 50;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                
                // Random size
                const size = Math.random() * 4 + 2;
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';
                
                // Random position
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                
                // Random animation delay
                particle.style.animationDelay = Math.random() * 15 + 's';
                particle.style.animationDuration = (Math.random() * 10 + 10) + 's';
                
                particlesContainer.appendChild(particle);
            }
        }

        // Scroll reveal animation
        function handleScrollReveal() {
            const reveals = document.querySelectorAll('.reveal-luxury');
            
            reveals.forEach(reveal => {
                const windowHeight = window.innerHeight;
                const elementTop = reveal.getBoundingClientRect().top;
                const elementVisible = 150;
                
                if (elementTop < windowHeight - elementVisible) {
                    reveal.classList.add('revealed');
                }
            });
        }

        // Parallax effect for grid background
        function handleGridParallax() {
            const scrolled = window.pageYOffset;
            const gridBg = document.querySelector('.grid-background');
            const dotsPattern = document.querySelector('.dots-pattern');
            
            if (gridBg) {
                const rate = scrolled * 0.3;
                gridBg.style.transform = `translate3d(0, ${rate}px, 0)`;
            }
            
            if (dotsPattern) {
                const rate = scrolled * 0.2;
                dotsPattern.style.transform = `translate3d(0, ${rate}px, 0)`;
            }
        }



        // Enhanced counter animation
        function animateLuxuryCounters() {
            const counters = document.querySelectorAll('[data-count]');
            
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-count'));
                let count = 0;
                const increment = target / 80;
                
                const updateCounter = () => {
                    if (count < target) {
                        count += increment;
                        counter.textContent = Math.ceil(count) + '+';
                        setTimeout(updateCounter, 30);
                    } else {
                        counter.textContent = target + '+';
                    }
                };
                
                updateCounter();
            });
        }

        // Enhanced Mobile menu functionality
        function initMobileMenu() {
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            let isMenuOpen = false;
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', function() {
                    isMenuOpen = !isMenuOpen;
                    
                    if (isMenuOpen) {
                        mobileMenu.classList.add('open');
                        mobileMenuButton.style.transform = 'scale(0.9) rotate(90deg)';
                    } else {
                        mobileMenu.classList.remove('open');
                        mobileMenuButton.style.transform = 'scale(1) rotate(0deg)';
                    }
                    
                    // Enhanced hamburger icon animation
                    const icon = mobileMenuButton.querySelector('i');
                    icon.style.transform = 'scale(0)';
                    
                    setTimeout(() => {
                        if (isMenuOpen) {
                            icon.className = 'fas fa-times text-lg';
                        } else {
                            icon.className = 'fas fa-bars text-lg';
                        }
                        icon.style.transform = 'scale(1)';
                    }, 150);
                });
                
                // Close mobile menu when clicking outside with animation
                document.addEventListener('click', function(event) {
                    if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target) && isMenuOpen) {
                        isMenuOpen = false;
                        mobileMenu.classList.remove('open');
                        mobileMenuButton.style.transform = 'scale(1) rotate(0deg)';
                        
                        const icon = mobileMenuButton.querySelector('i');
                        icon.style.transform = 'scale(0)';
                        setTimeout(() => {
                            icon.className = 'fas fa-bars text-lg';
                            icon.style.transform = 'scale(1)';
                        }, 150);
                    }
                });
                
                // Close mobile menu when window is resized to desktop
                window.addEventListener('resize', function() {
                    if (window.innerWidth >= 768 && isMenuOpen) {
                        isMenuOpen = false;
                        mobileMenu.classList.remove('open');
                        mobileMenuButton.style.transform = 'scale(1) rotate(0deg)';
                        
                        const icon = mobileMenuButton.querySelector('i');
                        icon.className = 'fas fa-bars text-lg';
                        icon.style.transform = 'scale(1)';
                    }
                });
                
                // Enhanced nav link click handling for mobile
                const mobileNavLinks = mobileMenu.querySelectorAll('.nav-link');
                mobileNavLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        if (isMenuOpen) {
                            isMenuOpen = false;
                            mobileMenu.classList.remove('open');
                            mobileMenuButton.style.transform = 'scale(1) rotate(0deg)';
                            
                            const icon = mobileMenuButton.querySelector('i');
                            icon.style.transform = 'scale(0)';
                            setTimeout(() => {
                                icon.className = 'fas fa-bars text-lg';
                                icon.style.transform = 'scale(1)';
                            }, 150);
                        }
                    });
                });
            }
        }

        // Dark Mode Functions
        function toggleDarkMode() {
            const html = document.documentElement;
            const icons = document.querySelectorAll('#darkModeIcon, .mobile-dark-toggle i');
            const toggleBtns = document.querySelectorAll('#darkModeToggle, .mobile-dark-toggle');
            const isDark = html.classList.contains('dark');
            
            // Add loading animation
            toggleBtns.forEach(btn => {
                btn.style.transform = 'scale(0.9) rotate(180deg)';
            });
            
            icons.forEach(icon => {
                icon.style.opacity = '0';
            });
            
            setTimeout(() => {
                if (isDark) {
                    html.classList.remove('dark');
                    icons.forEach(icon => {
                        icon.className = icon.className.replace('fa-sun', 'fa-moon');
                    });
                    localStorage.setItem('darkMode', 'false');
                } else {
                    html.classList.add('dark');
                    icons.forEach(icon => {
                        icon.className = icon.className.replace('fa-moon', 'fa-sun');
                    });
                    localStorage.setItem('darkMode', 'true');
                }
                
                // Restore icons and buttons
                icons.forEach(icon => {
                    icon.style.opacity = '1';
                });
                
                toggleBtns.forEach(btn => {
                    btn.style.transform = 'scale(1) rotate(0deg)';
                });
                
                // Add success feedback
                setTimeout(() => {
                    toggleBtns.forEach(btn => {
                        btn.style.transform = 'scale(1.05)';
                        setTimeout(() => {
                            btn.style.transform = 'scale(1)';
                        }, 150);
                    });
                }, 100);
                
            }, 200);
        }

        function initDarkMode() {
            const darkMode = localStorage.getItem('darkMode');
            const html = document.documentElement;
            const icons = document.querySelectorAll('#darkModeIcon, .mobile-dark-toggle i');
            
            // Check system preference if no saved preference
            if (darkMode === null) {
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                if (prefersDark) {
                    html.classList.add('dark');
                    icons.forEach(icon => {
                        icon.className = icon.className.replace('fa-moon', 'fa-sun');
                    });
                    localStorage.setItem('darkMode', 'true');
                } else {
                    html.classList.remove('dark');
                    icons.forEach(icon => {
                        icon.className = icon.className.replace('fa-sun', 'fa-moon');
                    });
                    localStorage.setItem('darkMode', 'false');
                }
            } else if (darkMode === 'true') {
                html.classList.add('dark');
                icons.forEach(icon => {
                    icon.className = icon.className.replace('fa-moon', 'fa-sun');
                });
            } else {
                html.classList.remove('dark');
                icons.forEach(icon => {
                    icon.className = icon.className.replace('fa-sun', 'fa-moon');
                });
            }
        }

        // Initialize luxury effects
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize dark mode
            initDarkMode();
            
            // Initialize enhanced navigation
            initSmoothNavigation();
            
            // Initialize section animations
            initSectionAnimations();
            
            // Initialize mobile menu
            initMobileMenu();
            
            // Initialize login modal
            initLoginModal();
            
            // Initialize contact form
            initContactForm();
            
            // Initialize online forms
            initOnlineForms();
            
            // Initialize staff cards
            initStaffCards();
            
            // Create luxury particles
            createLuxuryParticles();
            
            // Initial scroll reveal check
            handleScrollReveal();
            
            // Enhanced intersection observer for stats
            const statsObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && entry.target.querySelector('[data-count]')) {
                        animateLuxuryCounters();
                        statsObserver.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.5 });
            
            const statsSection = document.querySelector('.grid');
            if (statsSection) {
                statsObserver.observe(statsSection);
            }
        });

        // Preloader effect
        window.addEventListener('load', function() {
            document.body.style.opacity = '0';
            document.body.style.transition = 'opacity 0.5s ease';
            
            setTimeout(() => {
                document.body.style.opacity = '1';
            }, 100);
        });

        // Enhanced Single Page Navigation
        function initSmoothNavigation() {
            const navLinks = document.querySelectorAll('.nav-link');
            const sections = document.querySelectorAll('section[id]');
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileMenuButton = document.getElementById('mobile-menu-button');

            // Smooth scroll to sections
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href').substring(1);
                    const targetSection = document.getElementById(targetId);
                    
                    if (targetSection) {
                        // Add click effect
                        this.classList.add('clicked');
                        setTimeout(() => {
                            this.classList.remove('clicked');
                        }, 600);
                        
                        // Close mobile menu if open
                        if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                            mobileMenu.classList.add('hidden');
                            const icon = mobileMenuButton.querySelector('i');
                            icon.className = 'fas fa-bars text-xl';
                        }
                        
                        // Reset all sections animation
                        sections.forEach(section => {
                            section.classList.remove('visible');
                            section.classList.add('section-animate');
                        });
                        
                        // Smooth scroll to target
                        targetSection.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                        
                        // Trigger section animation after scroll
                        setTimeout(() => {
                            targetSection.classList.add('visible');
                            animateSectionContent(targetSection);
                        }, 500);
                        
                        // Update active navigation state
                        updateActiveNavigation(targetId);
                        
                        // Add visual feedback
                        this.style.transform = 'scale(0.95)';
                        setTimeout(() => {
                            this.style.transform = 'scale(1)';
                        }, 150);
                    }
                });
            });

            // Update active navigation on scroll
            function updateActiveNavigation(activeId = null) {
                if (!activeId) {
                    let current = 'beranda';
                    const scrollPos = window.scrollY + 100;
                    
                    sections.forEach(section => {
                        const sectionTop = section.offsetTop;
                        const sectionHeight = section.offsetHeight;
                        
                        if (scrollPos >= sectionTop && scrollPos < sectionTop + sectionHeight) {
                            current = section.getAttribute('id');
                        }
                    });
                    activeId = current;
                }
                
                navLinks.forEach(link => {
                    link.classList.remove('active');
                    if (link.getAttribute('href') === `#${activeId}`) {
                        link.classList.add('active');
                    }
                });
            }

            // Scroll spy
            window.addEventListener('scroll', function() {
                updateActiveNavigation();
                
                // Parallax effects
                handleGridParallax();
                handleScrollReveal();
                
                // Enhanced Navbar scroll effect
                const navbar = document.getElementById('navbar');
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });

            // Initialize active state
            updateActiveNavigation();
        }

        // Animate Section Content - Unified Pop Up Effect
        function animateSectionContent(section) {
            const contentElements = section.querySelectorAll('h1, h2, h3, p, .service-card, .facility-item, .physics-icon-container, .research-area, .glass-luxury');
            
            contentElements.forEach((element, index) => {
                // Reset animation classes
                element.classList.remove('animate-fade-in-up', 'animate-fade-in-left', 'animate-fade-in-right', 'animate-zoom-in');
                
                // Set initial state
                element.style.opacity = '0';
                element.style.transform = 'translateY(20px) scale(0.95)';
                
                setTimeout(() => {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0) scale(1)';
                    element.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
                    
                    // Unified pop up animation for all sections
                    element.classList.add('animate-fade-in-up');
                }, index * 80); // Stagger animation with shorter delay
            });
        }

        // Enhanced Section Animation
        function initSectionAnimations() {
            const sections = document.querySelectorAll('section');
            
            sections.forEach(section => {
                section.classList.add('section-animate');
            });
            
            const animationObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        // Animate content when section becomes visible
                        setTimeout(() => {
                            animateSectionContent(entry.target);
                        }, 200);
                    } else {
                        // Reset animation when section leaves viewport
                        entry.target.classList.remove('visible');
                    }
                });
            }, {
                threshold: 0.2,
                rootMargin: '0px 0px -100px 0px'
            });
            
            sections.forEach(section => {
                animationObserver.observe(section);
            });
        }

        // Login Modal Functions
        function openLoginModal() {
            const modal = document.getElementById('loginModal');
            const content = document.getElementById('loginModalContent');
            
            modal.classList.remove('hidden');
            setTimeout(() => {
                content.style.transform = 'scale(1)';
                content.style.opacity = '1';
            }, 10);
            
            document.body.style.overflow = 'hidden';
        }

        function closeLoginModal() {
            const modal = document.getElementById('loginModal');
            const content = document.getElementById('loginModalContent');
            
            content.style.transform = 'scale(0.95)';
            content.style.opacity = '0.8';
            
            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }, 300);
        }

        // Close modal when clicking outside
        function initLoginModal() {
            const modal = document.getElementById('loginModal');
            const content = document.getElementById('loginModalContent');
            
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeLoginModal();
                }
            });
            
            // Handle login link clicks
            document.querySelectorAll('a[href="#login"]').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    openLoginModal();
                });
            });
            
            // Handle footer navigation links
            document.querySelectorAll('.footer-link').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href').substring(1);
                    const targetSection = document.getElementById(targetId);
                    
                    if (targetSection) {
                        targetSection.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                        
                        // Add visual feedback
                        this.style.transform = 'scale(0.95)';
                        setTimeout(() => {
                            this.style.transform = 'scale(1)';
                        }, 150);
                    }
                });
            });
            
            // ESC key to close modal
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                    closeLoginModal();
                }
            });
        }

        // Modal Functions for New Services
        function openWorkstationModal() {
            document.getElementById('workstationModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeWorkstationModal() {
            document.getElementById('workstationModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function openLabVisitModal() {
            document.getElementById('labVisitModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeLabVisitModal() {
            document.getElementById('labVisitModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function openAnalysisModal() {
            document.getElementById('analysisModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeAnalysisModal() {
            document.getElementById('analysisModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Form Submission Functions
        function submitWorkstationForm(event) {
            console.log('submitWorkstationForm called');
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            console.log('Form data:', Object.fromEntries(formData));

            // Check if CSRF token exists
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (!csrfToken) {
                console.error('CSRF token not found');
                showErrorNotification('Token keamanan tidak ditemukan. Silakan refresh halaman.');
                return;
            }

            fetch('/workstation', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken.getAttribute('content')
                }
            })
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                if (data.success) {
                    showSuccessNotification(data.message);
                    form.reset();
                    closeWorkstationModal();
                } else {
                    showErrorNotification(data.message || 'Terjadi kesalahan saat mengirim formulir');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showErrorNotification('Terjadi kesalahan saat mengirim formulir: ' + error.message);
            });
        }

        function submitLabVisitForm(event) {
            console.log('submitLabVisitForm called');
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            console.log('Form data:', Object.fromEntries(formData));

            // Check if CSRF token exists
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (!csrfToken) {
                console.error('CSRF token not found');
                showErrorNotification('Token keamanan tidak ditemukan. Silakan refresh halaman.');
                return;
            }

            fetch('/lab-visit', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken.getAttribute('content')
                }
            })
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                if (data.success) {
                    showSuccessNotification(data.message);
                    form.reset();
                    closeLabVisitModal();
                } else {
                    showErrorNotification(data.message || 'Terjadi kesalahan saat mengirim formulir');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showErrorNotification('Terjadi kesalahan saat mengirim formulir: ' + error.message);
            });
        }

        function submitAnalysisForm(event) {
            console.log('submitAnalysisForm called');
            event.preventDefault();
            const form = event.target;
            const formData = new FormData(form);
            console.log('Form data:', Object.fromEntries(formData));

            // Check if CSRF token exists
            const csrfToken = document.querySelector('meta[name="csrf-token"]');
            if (!csrfToken) {
                console.error('CSRF token not found');
                showErrorNotification('Token keamanan tidak ditemukan. Silakan refresh halaman.');
                return;
            }

            fetch('/analysis', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken.getAttribute('content')
                }
            })
            .then(response => {
                console.log('Response status:', response.status);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Response data:', data);
                if (data.success) {
                    showSuccessNotification(data.message);
                    form.reset();
                    closeAnalysisModal();
                } else {
                    showErrorNotification(data.message || 'Terjadi kesalahan saat mengirim formulir');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showErrorNotification('Terjadi kesalahan saat mengirim formulir: ' + error.message);
            });
        }

        // Notification Functions
        function showSuccessNotification(message) {
            // Create notification container if it doesn't exist
            let container = document.getElementById('notification-container');
            if (!container) {
                container = document.createElement('div');
                container.id = 'notification-container';
                container.className = 'fixed top-4 right-4 z-[9999] space-y-2';
                document.body.appendChild(container);
            }

            // Create notification element
            const notification = document.createElement('div');
            notification.className = 'bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center space-x-3 transform translate-x-full transition-transform duration-300 ease-out min-w-[300px]';
            notification.innerHTML = `
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-xl"></i>
                </div>
                <div class="flex-1">
                    <p class="font-medium">${message}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="flex-shrink-0 text-white hover:text-gray-200">
                    <i class="fas fa-times"></i>
                </button>
            `;

            container.appendChild(notification);

            // Animate in
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);

            // Auto remove after 5 seconds
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => notification.remove(), 300);
            }, 5000);
        }

        function showErrorNotification(message) {
            // Create notification container if it doesn't exist
            let container = document.getElementById('notification-container');
            if (!container) {
                container = document.createElement('div');
                container.id = 'notification-container';
                container.className = 'fixed top-4 right-4 z-[9999] space-y-2';
                document.body.appendChild(container);
            }

            // Create notification element
            const notification = document.createElement('div');
            notification.className = 'bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg flex items-center space-x-3 transform translate-x-full transition-transform duration-300 ease-out min-w-[300px]';
            notification.innerHTML = `
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-xl"></i>
                </div>
                <div class="flex-1">
                    <p class="font-medium">${message}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="flex-shrink-0 text-white hover:text-gray-200">
                    <i class="fas fa-times"></i>
                </button>
            `;

            container.appendChild(notification);

            // Animate in
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);

            // Auto remove after 7 seconds (longer for errors)
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => notification.remove(), 300);
            }, 7000);
        }
    </script>

    <!-- Workstation Rental Modal -->
    <div id="workstationModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-3xl max-w-2xl w-full p-8 max-h-[90vh] overflow-y-auto">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-900">Formulir Penyewaan Workstation</h3>
                    <button onclick="closeWorkstationModal()" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <form onsubmit="submitWorkstationForm(event)" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                            <input type="text" name="name" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Nama lengkap">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Institusi/Universitas *</label>
                            <input type="text" name="institution" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Nama institusi">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                        <input type="email" name="email" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="email@example.com">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Workstation/Alat yang Disewa *</label>
                        <select name="workstation_type" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">Pilih Workstation/Alat</option>
                            <option value="pc_high_performance">PC High-Performance untuk Simulasi Fisika</option>
                            <option value="software_geofisika">Software Geofisika dan Komputasi Terintegrasi</option>
                            <option value="tools_fotografi">Tools Fotografi Digital dan Web Design</option>
                            <option value="environment_programming">Environment Programming Terintegrasi</option>
                        </select>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai *</label>
                            <input type="date" name="start_date" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai *</label>
                            <input type="date" name="end_date" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tujuan Penelitian *</label>
                        <textarea name="research_purpose" rows="4" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none" placeholder="Jelaskan tujuan dan kebutuhan penelitian Anda..."></textarea>
                    </div>
                    
                    <div class="flex justify-end space-x-4">
                        <button type="button" onclick="closeWorkstationModal()" class="px-6 py-3 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors">Batal</button>
                        <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-lg hover:from-blue-600 hover:to-indigo-700 transition-all">
                            <i class="fas fa-paper-plane mr-2"></i>Kirim Permohonan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Lab Visit Modal -->
    <div id="labVisitModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-3xl max-w-2xl w-full p-8 max-h-[90vh] overflow-y-auto">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-900">Formulir Kunjungan Lab</h3>
                    <button onclick="closeLabVisitModal()" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <form onsubmit="submitLabVisitForm(event)" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama PIC *</label>
                            <input type="text" name="pic_name" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="Nama penanggung jawab">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Institusi/Sekolah *</label>
                            <input type="text" name="institution" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="Nama institusi/sekolah">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kontak *</label>
                        <input type="text" name="contact" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="Email atau nomor telepon">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Kunjungan *</label>
                        <select name="visit_type" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            <option value="">Pilih Jenis</option>
                            <option value="tur_fasilitas">Tur Fasilitas 28 PC Workstation</option>
                            <option value="workshop_simulasi">Workshop Simulasi dan Komputasi Fisika</option>
                            <option value="demo_software">Demo Software Geofisika dan Visualisasi</option>
                            <option value="konsultasi_ahli">Sesi Konsultasi dengan Tim Ahli</option>
                        </select>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Kunjungan *</label>
                            <input type="date" name="visit_date" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Peserta *</label>
                            <input type="number" name="participant_count" min="1" max="50" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="Jumlah peserta">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tujuan & Ekspektasi *</label>
                        <textarea name="purpose_expectations" rows="4" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent resize-none" placeholder="Jelaskan tujuan kunjungan dan ekspektasi yang diharapkan..."></textarea>
                    </div>
                    
                    <div class="flex justify-end space-x-4">
                        <button type="button" onclick="closeLabVisitModal()" class="px-6 py-3 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors">Batal</button>
                        <button type="submit" class="px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-600 text-white rounded-lg hover:from-green-600 hover:to-emerald-700 transition-all">
                            <i class="fas fa-calendar-alt mr-2"></i>Ajukan Kunjungan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Analysis Request Modal -->
    <div id="analysisModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-3xl max-w-2xl w-full p-8 max-h-[90vh] overflow-y-auto">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-900">Formulir Analisis & Simulasi</h3>
                    <button onclick="closeAnalysisModal()" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <form onsubmit="submitAnalysisForm(event)" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Peneliti *</label>
                            <input type="text" name="researcher_name" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Nama peneliti">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Afiliasi *</label>
                            <input type="text" name="affiliation" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Institusi/universitas">
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                        <input type="email" name="email" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="email@example.com">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Analisis *</label>
                        <select name="analysis_type" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                            <option value="">Pilih Jenis</option>
                            <option value="simulasi_numerik">Simulasi Numerik dan Pemodelan Fisika</option>
                            <option value="analisis_data_geofisika">Analisis Data Geofisika dan Komputasi</option>
                            <option value="visualisasi_data">Visualisasi Data dan Rendering Grafis</option>
                            <option value="laporan_komprehensif">Laporan Analisis Komprehensif</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Data/Problem *</label>
                        <textarea name="data_description" rows="4" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent resize-none" placeholder="Jelaskan data yang akan dianalisis dan permasalahan yang ingin diselesaikan..."></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Parameter yang Dianalisis *</label>
                        <textarea name="analysis_parameters" rows="3" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent resize-none" placeholder="Sebutkan parameter-parameter yang perlu dianalisis..."></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Target Deadline *</label>
                        <input type="date" name="target_deadline" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>
                    
                    <div class="flex justify-end space-x-4">
                        <button type="button" onclick="closeAnalysisModal()" class="px-6 py-3 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors">Batal</button>
                        <button type="submit" class="px-6 py-3 bg-gradient-to-r from-purple-500 to-violet-600 text-white rounded-lg hover:from-purple-600 hover:to-violet-700 transition-all">
                            <i class="fas fa-microscope mr-2"></i>Request Analisis
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html> 

