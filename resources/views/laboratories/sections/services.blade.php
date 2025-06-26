<!-- Enhanced Services Section / Layanan -->
<section id="layanan" class="py-16 bg-white relative overflow-hidden">
    <!-- Background decorations -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 left-10 w-64 h-64 bg-slate-50 rounded-full opacity-30 animate-pulse" style="animation-delay: 1s;"></div>
        <div class="absolute bottom-20 right-10 w-48 h-48 bg-slate-100 rounded-full opacity-40 animate-pulse" style="animation-delay: 3s;"></div>
        <div class="absolute top-1/3 right-1/4 w-3 h-3 bg-slate-300 rounded-full animate-bounce" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-1/3 left-1/4 w-2 h-2 bg-slate-400 rounded-full animate-bounce" style="animation-delay: 4s;"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Enhanced Header -->
        <div class="text-center mb-16">
            <div class="inline-flex items-center bg-slate-50 rounded-full px-6 py-2 mb-6 shadow-sm border border-slate-100">
                <div class="w-2 h-2 bg-slate-600 rounded-full mr-3 animate-pulse"></div>
                <span class="text-sm font-semibold text-slate-700 uppercase tracking-wide">Our Services</span>
            </div>
            <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-8 bg-gradient-to-r from-slate-800 via-slate-700 to-slate-600 bg-clip-text text-transparent">
                Layanan Laboratorium
            </h2>
            <p class="text-gray-600 text-lg max-w-3xl mx-auto leading-relaxed">
                Mendukung hobi dan kegiatan mahasiswa di bidang komputasi, simulasi, fotografi, dan web desain software geofisika
            </p>
            

        </div>

        <!-- Enhanced Main Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            <!-- Service 1: Enhanced Workstation Access -->
            <div class="service-card-enhanced h-full flex flex-col bg-white border border-slate-200 rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 group relative overflow-hidden">
                <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <span class="bg-slate-600 text-white px-3 py-1 rounded-full text-xs font-medium">Popular</span>
                </div>
                
                <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-br from-slate-600 to-slate-800 rounded-2xl mb-6 group-hover:scale-110 transition-all duration-300 shadow-lg">
                    <i class="fas fa-desktop text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-4 group-hover:text-slate-600 transition-colors duration-300">Akses PC Workstation</h3>
                <p class="text-gray-600 mb-6 flex-grow leading-relaxed">
                    Akses ke 28 PC workstation untuk kegiatan komputasi fisika, simulasi, fotografi digital, dan web design yang mendukung hobi mahasiswa.
                </p>
                
                <!-- Service features -->
                <div class="space-y-3 mb-6 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        <span>28 High-spec PC Workstations</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        <span>Professional Software Suite</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        <span>24/7 Technical Support</span>
                    </div>
                </div>

                <!-- Enhanced CTA button -->
                <button class="mt-auto w-full bg-gradient-to-r from-slate-600 to-slate-800 text-white py-4 px-6 rounded-xl font-semibold hover:from-slate-700 hover:to-slate-900 transition-all duration-300 transform hover:scale-105 shadow-lg" onclick="openServiceModal('workstation')">
                    <i class="fas fa-arrow-right mr-2"></i>
                    Request Access
                </button>
            </div>

            <!-- Service 2: Enhanced Lab Visit -->
            <div class="service-card-enhanced h-full flex flex-col bg-white border border-slate-200 rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 group relative overflow-hidden">
                <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-medium">Educational</span>
                </div>
                
                <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-br from-slate-600 to-slate-800 rounded-2xl mb-6 group-hover:scale-110 transition-all duration-300 shadow-lg">
                    <i class="fas fa-users text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-4 group-hover:text-slate-600 transition-colors duration-300">Kunjungan Laboratorium</h3>
                <p class="text-gray-600 mb-6 flex-grow leading-relaxed">
                    Program kunjungan edukasi untuk mahasiswa dan institusi yang ingin mengenal fasilitas laboratorium fisika teori dan komputasi.
                </p>
                
                <!-- Service features -->
                <div class="space-y-3 mb-6 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        <span>Guided Lab Tours</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        <span>Hands-on Demonstrations</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        <span>Certificate of Participation</span>
                    </div>
                </div>

                <button class="mt-auto w-full bg-gradient-to-r from-slate-600 to-slate-800 text-white py-4 px-6 rounded-xl font-semibold hover:from-slate-700 hover:to-slate-900 transition-all duration-300 transform hover:scale-105 shadow-lg" onclick="openServiceModal('visit')">
                    <i class="fas fa-calendar-plus mr-2"></i>
                    Schedule Visit
                </button>
            </div>

            <!-- Service 3: Enhanced Analysis & Simulation -->
            <div class="service-card-enhanced h-full flex flex-col bg-white border border-slate-200 rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 group relative overflow-hidden">
                <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <span class="bg-purple-600 text-white px-3 py-1 rounded-full text-xs font-medium">Advanced</span>
                </div>
                
                <div class="flex items-center justify-center w-16 h-16 bg-gradient-to-br from-slate-600 to-slate-800 rounded-2xl mb-6 group-hover:scale-110 transition-all duration-300 shadow-lg">
                    <i class="fas fa-chart-line text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-4 group-hover:text-slate-600 transition-colors duration-300">Pelatihan Software Geofisika</h3>
                <p class="text-gray-600 mb-6 flex-grow leading-relaxed">
                    Pelatihan penggunaan software geofisika dan aplikasi komputasi untuk mendukung pembelajaran dan hobi mahasiswa di bidang geofisika.
                </p>
                
                <!-- Service features -->
                <div class="space-y-3 mb-6 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        <span>Expert-led Training</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        <span>Industry-standard Software</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-600">
                        <i class="fas fa-check text-green-500 mr-2"></i>
                        <span>Personalized Guidance</span>
                    </div>
                </div>

                <button class="mt-auto w-full bg-gradient-to-r from-slate-600 to-slate-800 text-white py-4 px-6 rounded-xl font-semibold hover:from-slate-700 hover:to-slate-900 transition-all duration-300 transform hover:scale-105 shadow-lg" onclick="openServiceModal('training')">
                    <i class="fas fa-graduation-cap mr-2"></i>
                    Start Learning
                </button>
            </div>
        </div>


    </div>

    <!-- Service Modal -->
    <div id="serviceModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden opacity-0 transition-opacity duration-300">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-3xl max-w-lg w-full shadow-2xl transform scale-95 transition-transform duration-300" id="serviceModalContent">
                <div class="bg-gradient-to-br from-slate-600 to-slate-800 text-white p-6 rounded-t-3xl">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-bold" id="modalServiceTitle">Service Request</h3>
                        <button onclick="closeServiceModal()" class="text-white hover:text-gray-300 transition-colors duration-300">
                            <i class="fas fa-times text-xl"></i>
                        </button>
            </div>
            </div>
                <div class="p-6">
                    <div id="modalServiceContent" class="space-y-4"></div>
            </div>
            </div>
        </div>
    </div>
</section> 

<script>
// Service modal functions
function openServiceModal(serviceType) {
    const modal = document.getElementById('serviceModal');
    const modalTitle = document.getElementById('modalServiceTitle');
    const modalContent = document.getElementById('modalServiceContent');
    
    let title, content;
    
    switch(serviceType) {
        case 'workstation':
            title = 'PC Workstation Access Request';
            content = `
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-slate-600 to-slate-800 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-desktop text-white text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-800">Request Workstation Access</h4>
                </div>
                <div class="space-y-4">
                    <p class="text-gray-700">Get access to our 28 high-performance PC workstations for computational physics, simulation, photography, and web development.</p>
                    <div class="bg-slate-50 p-4 rounded-xl">
                        <h5 class="font-semibold text-slate-800 mb-2">Included:</h5>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li>• Professional software suite</li>
                            <li>• 24/7 technical support</li>
                            <li>• High-speed internet access</li>
                            <li>• Printing facilities</li>
                        </ul>
                    </div>
                    <a href="#formulir" class="block w-full bg-slate-600 text-white text-center py-3 rounded-xl font-semibold hover:bg-slate-700 transition-colors duration-300" onclick="closeServiceModal()">
                        Submit Application
                    </a>
                </div>
            `;
            break;
        case 'visit':
            title = 'Schedule Lab Visit';
            content = `
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-slate-600 to-slate-800 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-white text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-800">Educational Lab Visit</h4>
                </div>
                <div class="space-y-4">
                    <p class="text-gray-700">Schedule an educational visit to explore our computational physics laboratory facilities.</p>
                    <div class="bg-slate-50 p-4 rounded-xl">
                        <h5 class="font-semibold text-slate-800 mb-2">Visit includes:</h5>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li>• Guided laboratory tour</li>
                            <li>• Hands-on demonstrations</li>
                            <li>• Meet our expert staff</li>
                            <li>• Certificate of participation</li>
                        </ul>
                    </div>
                    <a href="#formulir" class="block w-full bg-slate-600 text-white text-center py-3 rounded-xl font-semibold hover:bg-slate-700 transition-colors duration-300" onclick="closeServiceModal()">
                        Schedule Visit
                    </a>
                </div>
            `;
            break;
        case 'training':
            title = 'Geophysics Software Training';
            content = `
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-slate-600 to-slate-800 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-chart-line text-white text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-slate-800">Professional Training Program</h4>
                </div>
                <div class="space-y-4">
                    <p class="text-gray-700">Learn industry-standard geophysics software with expert guidance and hands-on practice.</p>
                    <div class="bg-slate-50 p-4 rounded-xl">
                        <h5 class="font-semibold text-slate-800 mb-2">Training covers:</h5>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li>• Geophysics software mastery</li>
                            <li>• Data analysis techniques</li>
                            <li>• Industry best practices</li>
                            <li>• Completion certificate</li>
                        </ul>
                    </div>
                    <a href="#formulir" class="block w-full bg-slate-600 text-white text-center py-3 rounded-xl font-semibold hover:bg-slate-700 transition-colors duration-300" onclick="closeServiceModal()">
                        Enroll Now
                    </a>
                </div>
            `;
            break;
    }
    
    modalTitle.textContent = title;
    modalContent.innerHTML = content;
    
    modal.classList.remove('hidden');
    setTimeout(() => {
        modal.classList.add('show');
    }, 10);
}

function closeServiceModal() {
    const modal = document.getElementById('serviceModal');
    modal.classList.remove('show');
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
}

// Close modal when clicking outside
document.getElementById('serviceModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeServiceModal();
    }
});
</script> 