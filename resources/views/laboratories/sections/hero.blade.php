<!-- Hero Section / Beranda -->
<section id="beranda" class="relative min-h-screen flex items-center justify-center overflow-hidden" style="font-family: 'Montserrat', sans-serif;">
    <!-- Google Fonts Import -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Background Layer -->
    <div class="absolute inset-0">
        <!-- Main Background Image -->
        <div class="absolute inset-0">
            <img src="{{ asset('images/WhatsApp Image 2025-06-17 at 18.12.15.jpeg') }}" 
                 alt="Physics Laboratory Background" 
                 class="w-full h-full object-cover object-center">
        </div>
        
        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-black/75"></div>
    </div>
    
    <!-- Content -->
    <div class="relative z-10 text-center text-white px-6 max-w-6xl mx-auto">
        <!-- Main Content Container -->
        <div class="mb-16 mt-20">
            <!-- Greeting Text with same styling as Department Badge -->
            <div class="mb-16">
                <div class="inline-flex items-center bg-white/10 backdrop-blur-sm border border-white/20 rounded-full px-8 py-4">
                    <span class="text-sm md:text-base font-medium">
                        Selamat Datang di
                    </span>
                </div>
            </div>
            
            <!-- Main Title with Typing Effect -->
            <div class="mb-6">
                <div class="text-6xl md:text-7xl lg:text-8xl xl:text-9xl font-bold leading-tight uppercase" 
                     style="letter-spacing: 0.01em; height: auto; display: block;">
                    <span id="typing-title" style="display: inline-block; min-width: 100%; text-align: center;"></span>
                </div>
            </div>
            
            <!-- Subtitle with Special Animation Effect -->
            <div class="mb-12">
                <div class="text-4xl md:text-5xl lg:text-6xl xl:text-7xl font-medium leading-tight" 
                     style="letter-spacing: 0.01em; font-family: 'Roboto', sans-serif; font-weight: 300;">
                    <div class="subtitle-animation-container">
                        <div class="first-part">Fisika Teori dan</div> 
                        <div class="second-part"> 
                            <span>Komputasi</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Department Badge without green dot -->
            <div class="mb-16">
                <div class="inline-flex items-center bg-white/10 backdrop-blur-sm border border-white/20 rounded-full px-8 py-4">
                    <span class="text-lg md:text-xl font-medium">
                        Departemen Fisika - Fakultas Matematika dan Ilmu Pengetahuan Alam - Universitas Syiah Kuala
                    </span>
                </div>
            </div>
        </div>
        
        <!-- CTA Icon Button positioned lower -->
        <div class="flex justify-center mb-1 mt-6">
            <a href="#layanan" 
               class="explore-icon-btn group relative inline-flex items-center justify-center w-16 h-16 bg-white/10 backdrop-blur-sm border border-white/30 text-white rounded-full hover:bg-white/20 transition-all duration-500"
               title="Jelajahi Layanan">
                <i class="fas fa-chevron-down text-xl group-hover:scale-110 transition-transform duration-300"></i>
                
                <!-- Soft Glow Effect -->
                <div class="absolute inset-0 rounded-full bg-white/20 opacity-0 group-hover:opacity-100 blur-md transition-opacity duration-500"></div>
            </a>
        </div>
    </div>
</section>

<style>
/* Typing Effect Styles for Title */
#typing-title {
    position: relative;
}

#typing-title::after {
    content: '|';
    color: rgba(255, 255, 255, 0.8);
    animation: blink 1s infinite;
    margin-left: 2px;
}

@keyframes blink {
    0%, 50% { opacity: 1; }
    51%, 100% { opacity: 0; }
}

/* Hide cursor initially */
#typing-title::after {
    opacity: 0;
}

/* Show cursor when typing */
#typing-title.typing::after {
    opacity: 1;
}

/* Hide cursor when done */
#typing-title.done::after {
    display: none;
}

/* Subtitle Animation Container */
.subtitle-animation-container {
    text-align: center;
    width: 100%;
    display: block;
    position: relative;
    min-height: 1.2em;
    -webkit-backface-visibility: hidden;
    -webkit-perspective: 1000;
    -webkit-transform: translate3d(0,0,0);
}

.subtitle-animation-container div {
    display: inline-block;
    overflow: hidden;
    white-space: nowrap;
}

.subtitle-animation-container .first-part {
    animation: showup 7s ease-in-out forwards;
}

.subtitle-animation-container .second-part {
    width: 0px;
    animation: reveal 7s ease-in-out forwards;
}

.subtitle-animation-container .second-part span {
    margin-left: -400px;
    animation: slidein 7s ease-in-out forwards;
}

@keyframes showup {
    0% { opacity: 0; }
    20% { opacity: 1; }
    80% { opacity: 1; }
    100% { opacity: 1; }
}

@keyframes slidein {
    0% { margin-left: -800px; }
    20% { margin-left: -800px; }
    35% { margin-left: 0px; }
    100% { margin-left: 0px; }
}

@keyframes reveal {
    0% { opacity: 0; width: 0px; }
    20% { opacity: 1; width: 0px; }
    30% { width: 400px; }
    80% { opacity: 1; }
    100% { opacity: 1; width: 400px; }
}

/* Responsive adjustments */
@media (max-width: 1200px) {
    .subtitle-animation-container .second-part span {
        margin-left: -350px;
    }
    
    @keyframes slidein {
        0% { margin-left: -700px; }
        20% { margin-left: -700px; }
        35% { margin-left: 0px; }
        100% { margin-left: 0px; }
    }
    
    @keyframes reveal {
        0% { opacity: 0; width: 0px; }
        20% { opacity: 1; width: 0px; }
        30% { width: 350px; }
        80% { opacity: 1; }
        100% { opacity: 1; width: 350px; }
    }
}

@media (max-width: 768px) {
    .subtitle-animation-container .second-part span {
        margin-left: -300px;
    }
    
    @keyframes slidein {
        0% { margin-left: -600px; }
        20% { margin-left: -600px; }
        35% { margin-left: 0px; }
        100% { margin-left: 0px; }
    }
    
    @keyframes reveal {
        0% { opacity: 0; width: 0px; }
        20% { opacity: 1; width: 0px; }
        30% { width: 300px; }
        80% { opacity: 1; }
        100% { opacity: 1; width: 300px; }
    }
}

@media (max-width: 480px) {
    .subtitle-animation-container .second-part span {
        margin-left: -250px;
    }
    
    @keyframes slidein {
        0% { margin-left: -500px; }
        20% { margin-left: -500px; }
        35% { margin-left: 0px; }
        100% { margin-left: 0px; }
    }
    
    @keyframes reveal {
        0% { opacity: 0; width: 0px; }
        20% { opacity: 1; width: 0px; }
        30% { width: 250px; }
        80% { opacity: 1; }
        100% { opacity: 1; width: 250px; }
    }
}

/* Wiggle Animation for Explore Icon */
@keyframes wiggle {
    0%, 100% { transform: rotate(0deg); }
    25% { transform: rotate(-3deg); }
    75% { transform: rotate(3deg); }
}

@keyframes pulse-glow {
    0%, 100% { 
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
    }
    50% { 
        box-shadow: 0 0 30px rgba(255, 255, 255, 0.2), 0 0 40px rgba(255, 255, 255, 0.1);
    }
}

.explore-icon-btn {
    animation: wiggle 2s ease-in-out infinite, pulse-glow 3s ease-in-out infinite;
}

.explore-icon-btn:hover {
    animation: none;
    transform: scale(1.1);
    box-shadow: 
        0 0 25px rgba(255, 255, 255, 0.3),
        0 0 50px rgba(255, 255, 255, 0.1),
        0 8px 32px rgba(0, 0, 0, 0.3);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .explore-icon-btn {
        width: 56px;
        height: 56px;
    }
    
    .explore-icon-btn i {
        font-size: 1.125rem;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Typing effect configuration for title only
    const titleElement = document.getElementById('typing-title');
    
    const titleText = 'LABORATORIUM';
    
    let titleIndex = 0;
    
    // Typing speed (milliseconds)
    const typingSpeed = 100;
    
    function typeTitle() {
        if (titleIndex <= titleText.length) {
            titleElement.textContent = titleText.slice(0, titleIndex);
            titleIndex++;
            
            if (titleIndex <= titleText.length) {
                setTimeout(typeTitle, typingSpeed);
            } else {
                // Title complete, hide cursor
                titleElement.classList.remove('typing');
                titleElement.classList.add('done');
            }
        }
    }
    
    // Start typing effect
    function startTyping() {
        // Start title typing
        titleElement.classList.add('typing');
        setTimeout(typeTitle, 500);
    }
    
    // Initialize
    titleElement.textContent = '';
    startTyping();
});
</script> 