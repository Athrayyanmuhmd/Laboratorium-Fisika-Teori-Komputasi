<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BiodataPengurus;
use App\Models\Gambar;
use Carbon\Carbon;
use Illuminate\Support\Str;

class StaffSeeder extends Seeder
{
    public function run()
    {
        // Staff data dengan informasi lengkap
        $staffData = [
            [
                'nama' => 'Prof. Dr. Ir. Ahmad Suryana, M.Si.',
                'jabatan' => 'Kepala Laboratorium',
                'email' => 'ahmad.suryana@fisika.univ.ac.id',
                'phone' => '+62 812-3456-7890',
                'bio' => 'Profesor dalam bidang Fisika Material dengan pengalaman lebih dari 20 tahun dalam penelitian dan pengembangan material semikonduktor. Memiliki dedikasi tinggi dalam pengembangan laboratorium fisika komputasi.',
                'specialization' => 'Fisika Material, Semikonduktor',
                'education' => 'S3 Fisika Material - Institut Teknologi Bandung',
                'expertise' => 'Material Science, Semiconductor Physics, Computational Physics, Nanotechnology',
                'research_interests' => 'Nanomaterial synthesis, Semiconductor device physics, Computational modeling of materials',
                'employment_type' => 'full_time',
                'linkedin_url' => 'https://linkedin.com/in/ahmad-suryana-physics',
                'google_scholar_url' => 'https://scholar.google.com/citations?user=ahmad_suryana',
                'website_url' => 'https://fisika.univ.ac.id/ahmad-suryana',
                'join_date' => Carbon::parse('2019-01-15'),
                'achievements' => 'Publikasi 50+ paper internasional, Penerima hibah penelitian nasional 5 kali, Pembimbing 20+ mahasiswa S2/S3',
                'publications' => 'Advanced Materials (2023), Physical Review B (2022), Journal of Applied Physics (2023)',
                'is_active' => true,
                'show_on_website' => true,
                'display_order' => 1
            ],
            [
                'nama' => 'Dr. Siti Rahayu, M.Sc.',
                'jabatan' => 'Koordinator Penelitian',
                'email' => 'siti.rahayu@fisika.univ.ac.id',
                'phone' => '+62 813-4567-8901',
                'bio' => 'Doktor Fisika Komputasi dengan fokus pada simulasi molekular dan pengembangan algoritma komputasi. Aktif dalam penelitian kolaboratif internasional.',
                'specialization' => 'Fisika Komputasi, Simulasi Molekular',
                'education' => 'S3 Fisika Komputasi - Universitas Gadjah Mada',
                'expertise' => 'Molecular Dynamics, Monte Carlo Simulation, High Performance Computing, Data Analysis',
                'research_interests' => 'Computational modeling, Molecular simulation, Machine learning in physics',
                'employment_type' => 'full_time',
                'linkedin_url' => 'https://linkedin.com/in/siti-rahayu-phd',
                'google_scholar_url' => 'https://scholar.google.com/citations?user=siti_rahayu',
                'join_date' => Carbon::parse('2020-03-01'),
                'achievements' => 'Publikasi 30+ paper, Presenter di 15+ konferensi internasional, Peneliti utama 3 hibah penelitian',
                'publications' => 'Computer Physics Communications (2023), Journal of Computational Physics (2022)',
                'is_active' => true,
                'show_on_website' => true,
                'display_order' => 2
            ],
            [
                'nama' => 'Dr. Eng. Budi Santoso, M.T.',
                'jabatan' => 'Kepala Divisi Instrumentasi',
                'email' => 'budi.santoso@fisika.univ.ac.id',
                'phone' => '+62 814-5678-9012',
                'bio' => 'Ahli dalam instrumentasi fisika dan pengembangan perangkat eksperimen. Berpengalaman dalam desain dan maintenance peralatan laboratorium canggih.',
                'specialization' => 'Instrumentasi Fisika, Elektronika',
                'education' => 'S3 Teknik Fisika - Institut Teknologi Sepuluh Nopember',
                'expertise' => 'Electronic Instrumentation, Data Acquisition Systems, Sensor Technology, Lab Equipment Design',
                'research_interests' => 'Smart sensors, IoT in physics laboratories, Automated measurement systems',
                'employment_type' => 'full_time',
                'linkedin_url' => 'https://linkedin.com/in/budi-santoso-engineer',
                'join_date' => Carbon::parse('2018-08-15'),
                'achievements' => 'Paten 5 alat instrumentasi, Publikasi 25+ paper, Pelatihan 100+ mahasiswa',
                'publications' => 'Review of Scientific Instruments (2023), Sensors and Actuators (2022)',
                'is_active' => true,
                'show_on_website' => true,
                'display_order' => 3
            ],
            [
                'nama' => 'Dr. Maya Kusuma, M.Si.',
                'jabatan' => 'Dosen & Peneliti',
                'email' => 'maya.kusuma@fisika.univ.ac.id',
                'phone' => '+62 815-6789-0123',
                'bio' => 'Dosen muda dengan passion dalam fisika teori dan aplikasinya. Aktif dalam mengembangkan metode pembelajaran fisika yang inovatif.',
                'specialization' => 'Fisika Teori, Fisika Kuantum',
                'education' => 'S3 Fisika Teori - Universitas Indonesia',
                'expertise' => 'Quantum Mechanics, Statistical Physics, Theoretical Modeling, Physics Education',
                'research_interests' => 'Quantum information, Many-body systems, Physics pedagogy',
                'employment_type' => 'full_time',
                'linkedin_url' => 'https://linkedin.com/in/maya-kusuma-physics',
                'join_date' => Carbon::parse('2021-09-01'),
                'achievements' => 'Publikasi 15+ paper, Best young researcher award 2022, Hibah penelitian dosen muda',
                'publications' => 'Physical Review Letters (2023), Quantum Information Processing (2022)',
                'is_active' => true,
                'show_on_website' => true,
                'display_order' => 4
            ],
            [
                'nama' => 'Ir. Dedi Prasetyo, M.T.',
                'jabatan' => 'Teknisi Senior',
                'email' => 'dedi.prasetyo@fisika.univ.ac.id',
                'phone' => '+62 816-7890-1234',
                'bio' => 'Teknisi berpengalaman dengan keahlian tinggi dalam maintenance dan operasional peralatan laboratorium. Berperan penting dalam menjaga kelancaran aktivitas penelitian.',
                'specialization' => 'Maintenance Peralatan, Teknik Laboratorium',
                'education' => 'S2 Teknik Fisika - Institut Teknologi Bandung',
                'expertise' => 'Laboratory Equipment Maintenance, Safety Protocols, Technical Support, Quality Control',
                'research_interests' => 'Equipment optimization, Laboratory safety systems, Preventive maintenance',
                'employment_type' => 'full_time',
                'join_date' => Carbon::parse('2017-06-01'),
                'achievements' => 'Sertifikat K3 laboratorium, Pelatihan 50+ mahasiswa teknik lab, Zero accident record 5 tahun',
                'publications' => 'Jurnal Teknik Laboratorium Indonesia (2022), Prosiding Seminar Keselamatan Lab (2023)',
                'is_active' => true,
                'show_on_website' => true,
                'display_order' => 5
            ],
            [
                'nama' => 'Dr. Andi Wijaya, M.Kom.',
                'jabatan' => 'Spesialis IT & Komputasi',
                'email' => 'andi.wijaya@fisika.univ.ac.id',
                'phone' => '+62 817-8901-2345',
                'bio' => 'Ahli IT dengan fokus pada high-performance computing dan pengembangan software untuk simulasi fisika. Mengelola infrastruktur komputasi laboratorium.',
                'specialization' => 'High Performance Computing, Software Development',
                'education' => 'S3 Ilmu Komputer - Institut Teknologi Bandung',
                'expertise' => 'HPC Systems, Scientific Computing, Linux Administration, Parallel Programming',
                'research_interests' => 'Parallel algorithms, GPU computing, Scientific software development',
                'employment_type' => 'full_time',
                'linkedin_url' => 'https://linkedin.com/in/andi-wijaya-hpc',
                'join_date' => Carbon::parse('2020-11-15'),
                'achievements' => 'Pengembangan 10+ software simulasi, Admin cluster 500+ core, Publikasi 20+ paper',
                'publications' => 'Journal of Parallel Computing (2023), Computer Methods in Applied Mechanics (2022)',
                'is_active' => true,
                'show_on_website' => true,
                'display_order' => 6
            ],
            [
                'nama' => 'Sarah Amelia, S.Si., M.Si.',
                'jabatan' => 'Asisten Peneliti',
                'email' => 'sarah.amelia@fisika.univ.ac.id',
                'phone' => '+62 818-9012-3456',
                'bio' => 'Lulusan terbaik S2 Fisika yang bergabung sebagai asisten peneliti. Memiliki kemampuan excellent dalam analisis data dan eksperimen.',
                'specialization' => 'Analisis Data, Fisika Eksperimen',
                'education' => 'S2 Fisika - Universitas Gadjah Mada',
                'expertise' => 'Data Analysis, Experimental Physics, Statistical Methods, Laboratory Techniques',
                'research_interests' => 'Experimental design, Data visualization, Statistical modeling',
                'employment_type' => 'contract',
                'linkedin_url' => 'https://linkedin.com/in/sarah-amelia-physics',
                'join_date' => Carbon::parse('2023-02-01'),
                'achievements' => 'Cum laude S1 dan S2, Publikasi 5+ paper, Best thesis award',
                'publications' => 'Indonesian Journal of Physics (2023), Prosiding Seminar Fisika Nasional (2023)',
                'is_active' => true,
                'show_on_website' => true,
                'display_order' => 7
            ],
            [
                'nama' => 'Prof. Dr. Hendri Setiawan, M.Sc.',
                'jabatan' => 'Konsultan Penelitian',
                'email' => 'hendri.setiawan@consultant.com',
                'phone' => '+62 819-0123-4567',
                'bio' => 'Profesor emeritus dengan pengalaman 30+ tahun dalam penelitian fisika. Berperan sebagai konsultan untuk proyek-proyek penelitian strategis.',
                'specialization' => 'Fisika Nuclear, Konsultasi Penelitian',
                'education' => 'S3 Nuclear Physics - University of Tokyo',
                'expertise' => 'Nuclear Physics, Research Methodology, Project Management, International Collaboration',
                'research_interests' => 'Nuclear structure, Radioactivity, Research strategy',
                'employment_type' => 'part_time',
                'linkedin_url' => 'https://linkedin.com/in/hendri-setiawan-nuclear',
                'google_scholar_url' => 'https://scholar.google.com/citations?user=hendri_setiawan',
                'join_date' => Carbon::parse('2022-01-15'),
                'achievements' => 'Publikasi 100+ paper internasional, Keynote speaker 20+ konferensi, Editor 3 jurnal internasional',
                'publications' => 'Nuclear Physics A (2023), Physical Review C (2022), Nature Physics (2021)',
                'is_active' => true,
                'show_on_website' => false, // Konsultan external, tidak ditampilkan di website
                'display_order' => 8
            ]
        ];

        // Insert staff data
        foreach ($staffData as $index => $staff) {
            $pengurus = BiodataPengurus::create($staff);
            
            // Create some dummy images for first few staff
            if ($index < 4) {
                Gambar::create([
                    'id' => (string) Str::uuid(),
                    'pengurusId' => $pengurus->id,
                    'acaraId' => null,
                    'url' => "pengurus/staff_photo_" . ($index + 1) . ".jpg",
                    'kategori' => 'PENGURUS',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

        $this->command->info('✅ Staff data seeded successfully!');
        $this->command->info('📊 Total staff created: ' . count($staffData));
        $this->command->info('🖼️  Staff with photos: 4');
        $this->command->info('🌐 Staff visible on website: 7');
        $this->command->info('👥 Active staff: 8');
    }
} 