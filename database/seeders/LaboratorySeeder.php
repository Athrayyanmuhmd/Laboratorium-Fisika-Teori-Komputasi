<?php

namespace Database\Seeders;

use App\Models\Laboratory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LaboratorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $laboratories = [
            [
                'name' => 'Laboratorium Geofisika',
                'slug' => 'geofisika',
                'description' => 'Laboratorium Geofisika merupakan pusat penelitian dan pendidikan dalam bidang geofisika yang dilengkapi dengan peralatan canggih untuk eksplorasi bawah permukaan, seismologi, dan geologi lingkungan.',
                'vision' => 'Menjadi laboratorium geofisika terdepan dalam pengembangan teknologi eksplorasi dan mitigasi bencana alam.',
                'mission' => 'Mengembangkan ilmu geofisika melalui penelitian, pendidikan, dan pengabdian masyarakat untuk mendukung pembangunan berkelanjutan.',
                'facilities' => [
                    'Seismometer digital',
                    'Georadar (GPR)',
                    'Magnetometer',
                    'Gravimeter',
                    'Resistivimeter',
                    'Software interpretasi geofisika'
                ],
                'location' => 'Gedung FMIPA Lantai 3, Ruang 301-305',
                'phone' => '+62 651 7551831',
                'email' => 'geofisika@unsyiah.ac.id',
                'operating_hours' => [
                    'senin' => '08:00-16:00',
                    'selasa' => '08:00-16:00',
                    'rabu' => '08:00-16:00',
                    'kamis' => '08:00-16:00',
                    'jumat' => '08:00-11:30',
                    'sabtu' => 'Tutup',
                    'minggu' => 'Tutup'
                ],
                'head_of_lab' => 'Prof. Dr. Ahmad Geofisika, M.Si.',
                'staff' => [
                    ['name' => 'Dr. Budi Seismologi, M.Si.', 'position' => 'Koordinator Lab'],
                    ['name' => 'Sari Gravitasi, S.Si., M.T.', 'position' => 'Teknisi Senior'],
                    ['name' => 'Reza Magnetik, S.Si.', 'position' => 'Asisten Lab']
                ]
            ],
            [
                'name' => 'Laboratorium Fisika Dasar',
                'slug' => 'fisika-dasar',
                'description' => 'Laboratorium Fisika Dasar menyediakan fasilitas praktikum untuk mahasiswa tingkat awal dengan berbagai eksperimen dasar dalam mekanika, termodinamika, gelombang, dan optik.',
                'vision' => 'Menjadi laboratorium fisika dasar yang unggul dalam memberikan pengalaman praktikum berkualitas tinggi.',
                'mission' => 'Menyediakan fasilitas praktikum yang mendukung pemahaman konsep fisika dasar melalui eksperimen langsung.',
                'facilities' => [
                    'Kit eksperimen mekanika',
                    'Peralatan termodinamika',
                    'Oscilloscope digital',
                    'Generator sinyal',
                    'Peralatan optik',
                    'Sensor digital'
                ],
                'location' => 'Gedung FMIPA Lantai 2, Ruang 201-210',
                'phone' => '+62 651 7551832',
                'email' => 'fisdasar@unsyiah.ac.id',
                'operating_hours' => [
                    'senin' => '08:00-17:00',
                    'selasa' => '08:00-17:00',
                    'rabu' => '08:00-17:00',
                    'kamis' => '08:00-17:00',
                    'jumat' => '08:00-11:30',
                    'sabtu' => '08:00-12:00',
                    'minggu' => 'Tutup'
                ],
                'head_of_lab' => 'Dr. Siti Mekanika, M.Pd.',
                'staff' => [
                    ['name' => 'Ahmad Praktikum, S.Pd., M.Si.', 'position' => 'Koordinator Lab'],
                    ['name' => 'Rina Eksperimen, S.Si.', 'position' => 'Teknisi Lab'],
                    ['name' => 'Dodi Alat, A.Md.', 'position' => 'Asisten Teknisi']
                ]
            ],
            [
                'name' => 'Laboratorium Elektronika',
                'slug' => 'elektronika',
                'description' => 'Laboratorium Elektronika dilengkapi dengan peralatan modern untuk penelitian dan pengembangan sistem elektronik, instrumentasi, dan teknologi sensor.',
                'vision' => 'Menjadi pusat unggulan dalam pengembangan teknologi elektronika dan instrumentasi fisika.',
                'mission' => 'Mengembangkan teknologi elektronika untuk mendukung penelitian fisika dan aplikasi industri.',
                'facilities' => [
                    'Oscilloscope digital 4 channel',
                    'Function generator',
                    'Power supply variable',
                    'Multimeter digital',
                    'LCR meter',
                    'PCB prototyping tools',
                    'Mikrocontroller development kit'
                ],
                'location' => 'Gedung FMIPA Lantai 4, Ruang 401-408',
                'phone' => '+62 651 7551833',
                'email' => 'elektronika@unsyiah.ac.id',
                'operating_hours' => [
                    'senin' => '08:00-16:00',
                    'selasa' => '08:00-16:00',
                    'rabu' => '08:00-16:00',
                    'kamis' => '08:00-16:00',
                    'jumat' => '08:00-11:30',
                    'sabtu' => 'Tutup',
                    'minggu' => 'Tutup'
                ],
                'head_of_lab' => 'Dr. Eng. Rizki Elektronik, M.T.',
                'staff' => [
                    ['name' => 'Ir. Fajar Sirkuit, M.T.', 'position' => 'Koordinator Lab'],
                    ['name' => 'Maya Sensor, S.T., M.T.', 'position' => 'Peneliti'],
                    ['name' => 'Andi Mikro, S.T.', 'position' => 'Teknisi Elektronik']
                ]
            ],
            [
                'name' => 'Laboratorium Fisika Lanjut',
                'slug' => 'fisika-lanjut',
                'description' => 'Laboratorium Fisika Lanjut menyediakan fasilitas untuk penelitian tingkat lanjut dalam fisika modern, fisika material, dan teknologi nano.',
                'vision' => 'Menjadi laboratorium fisika lanjut terdepan dalam penelitian fisika modern dan material.',
                'mission' => 'Mengembangkan penelitian fisika lanjut untuk kontribusi pada kemajuan sains dan teknologi.',
                'facilities' => [
                    'X-Ray Diffractometer (XRD)',
                    'Scanning Electron Microscope (SEM)',
                    'UV-Vis Spectrophotometer',
                    'FTIR Spectrometer',
                    'Thermal analyzer',
                    'Clean room facility',
                    'Thin film deposition system'
                ],
                'location' => 'Gedung FMIPA Lantai 5, Ruang 501-515',
                'phone' => '+62 651 7551834',
                'email' => 'fislanjut@unsyiah.ac.id',
                'operating_hours' => [
                    'senin' => '08:00-16:00',
                    'selasa' => '08:00-16:00',
                    'rabu' => '08:00-16:00',
                    'kamis' => '08:00-16:00',
                    'jumat' => '08:00-11:30',
                    'sabtu' => 'Tutup',
                    'minggu' => 'Tutup'
                ],
                'head_of_lab' => 'Prof. Dr. Indra Material, M.Si.',
                'staff' => [
                    ['name' => 'Dr. Lisa Nano, M.Si.', 'position' => 'Koordinator Lab'],
                    ['name' => 'Dr. Hendra Kristal, M.T.', 'position' => 'Peneliti Senior'],
                    ['name' => 'Putri Spektro, S.Si., M.Si.', 'position' => 'Analis'],
                    ['name' => 'Joko Thin, S.T.', 'position' => 'Teknisi Spesialis']
                ]
            ]
        ];

        foreach ($laboratories as $lab) {
            Laboratory::create($lab);
        }
    }
}
