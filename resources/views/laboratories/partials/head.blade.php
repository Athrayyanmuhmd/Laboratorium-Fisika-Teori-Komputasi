<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <!-- Enhanced Mobile Viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes, viewport-fit=cover">
    <meta name="format-detection" content="telephone=no">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#1e293b">
    
    <title>Laboratorium Fisika Komputasi - FMIPA Universitas Syiah Kuala</title>
    
    <!-- Preload Critical Resources -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" as="style">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @include('laboratories.partials.styles')
    @include('laboratories.partials.mobile-scripts')
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'navy': '#1e293b',
                        'navy-dark': '#334155',
                        'glass': 'rgba(255, 255, 255, 0.8)',
                    },
                    screens: {
                        'xs': '375px',
                        '3xl': '1600px',
                    },
                    spacing: {
                        'safe-top': 'env(safe-area-inset-top)',
                        'safe-bottom': 'env(safe-area-inset-bottom)',
                        'safe-left': 'env(safe-area-inset-left)',
                        'safe-right': 'env(safe-area-inset-right)',
                    }
                }
            }
        }
    </script>
    
    <!-- Mobile Performance Optimizations -->
    <style>
        /* Critical Mobile CSS */
        html { 
            -webkit-text-size-adjust: 100%; 
            -ms-text-size-adjust: 100%;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
        }
        
        body { 
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            text-rendering: optimizeLegibility;
            overscroll-behavior-y: contain;
        }
        
        /* Touch-friendly minimum sizes */
        @media (max-width: 768px) {
            button, a, input, select, textarea {
                min-height: 44px;
                min-width: 44px;
            }
            
            /* Hide scrollbars on mobile for cleaner look */
            ::-webkit-scrollbar {
                display: none;
            }
            
            body {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
        }
        
        /* Faster tap response */
        * {
            -webkit-tap-highlight-color: transparent;
            touch-action: manipulation;
        }
        
        /* GPU acceleration for smooth animations */
        .transform, .transition {
            will-change: transform;
            transform: translateZ(0);
        }
    </style>
</head>
<body class="bg-white mobile-safe-area"> 