<!-- Staff & Dosen Section -->
<section id="staf" class="py-16 bg-gray-50 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-8">Staf dan Tenaga Ahli</h2>
            <p class="text-gray-600 text-lg max-w-3xl mx-auto">
                Tim ahli berpengalaman di bidang fisika komputasi dan teknologi canggih
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
            @forelse ($featuredStaff as $staff)
                <div class="staff-card group">
                    <div class="staff-avatar-container">
                        <div class="staff-avatar">
                            @if($staff->photo)
                                <img src="{{ Storage::url($staff->photo) }}" alt="{{ $staff->name }}" 
                                     class="w-full h-full object-cover rounded-full group-hover:scale-110 transition-transform duration-300">
                            @else
                                <i class="fas fa-user text-3xl text-slate-500 group-hover:text-white transition-colors duration-300"></i>
                            @endif
                        </div>
                        <div class="staff-ring"></div>
                    </div>
                    <div class="staff-info">
                        <h3 class="staff-name">{{ $staff->name }}</h3>
                        <p class="staff-title">{{ $staff->position }}</p>
                        <p class="text-sm text-slate-600 mb-2">{{ $staff->specialization }}</p>
                        <div class="staff-contact">
                            <a href="mailto:{{ $staff->email }}" class="staff-email">
                                <i class="fas fa-envelope"></i>
                            </a>
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
                            <div class="staff-ring"></div>
                        </div>
                        <div class="staff-info">
                            <h3 class="staff-name">Dr. Mustapa, M.Si</h3>
                            <p class="staff-title">Dosen & Peneliti</p>
                            <p class="text-sm text-slate-600 mb-2">Computational Physics</p>
                            <div class="staff-contact">
                                <a href="mailto:staff{{ $i + 1 }}@unsyiah.ac.id" class="staff-email">
                                    <i class="fas fa-envelope"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endfor
            @endforelse
        </div>
    </div>
</section> 