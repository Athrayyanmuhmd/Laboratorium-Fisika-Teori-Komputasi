<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WorkstationRental;
use App\Models\LabVisit;
use App\Models\AnalysisRequest;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create test workstation rentals
        WorkstationRental::create([
            'request_code' => 'WRK202506210001',
            'name' => 'John Doe',
            'institution' => 'Universitas Syiah Kuala',
            'email' => 'john.doe@unsyiah.ac.id',
            'workstation_type' => 'pc_high_performance',
            'start_date' => '2025-06-25',
            'end_date' => '2025-06-27',
            'research_purpose' => 'Simulasi dinamika fluida untuk penelitian geofisika',
            'status' => 'pending',
        ]);

        WorkstationRental::create([
            'request_code' => 'WRK202506210002',
            'name' => 'Jane Smith',
            'institution' => 'Institut Teknologi Bandung',
            'email' => 'jane.smith@itb.ac.id',
            'workstation_type' => 'software_geofisika',
            'start_date' => '2025-06-28',
            'end_date' => '2025-06-30',
            'research_purpose' => 'Analisis data seismik untuk penelitian gempa',
            'status' => 'approved',
            'approved_at' => now(),
            'approved_by' => 2,
        ]);

        // Create test lab visits
        LabVisit::create([
            'visit_code' => 'LVS202506210001',
            'pic_name' => 'Dr. Ahmad Rahman',
            'institution' => 'SMA Negeri 1 Banda Aceh',
            'contact' => 'ahmad.rahman@sman1banda.ac.id',
            'visit_type' => 'tur_fasilitas',
            'visit_date' => '2025-07-01',
            'participant_count' => 25,
            'purpose_expectations' => 'Memperkenalkan siswa pada teknologi komputasi fisika modern',
            'status' => 'pending',
        ]);

        LabVisit::create([
            'visit_code' => 'LVS202506210002',
            'pic_name' => 'Prof. Siti Nurhaliza',
            'institution' => 'Universitas Gadjah Mada',
            'contact' => 'siti.nurhaliza@ugm.ac.id',
            'visit_type' => 'workshop_simulasi',
            'visit_date' => '2025-07-05',
            'participant_count' => 15,
            'purpose_expectations' => 'Workshop simulasi Monte Carlo untuk mahasiswa S2',
            'status' => 'approved',
            'approved_at' => now(),
            'approved_by' => 2,
        ]);

        // Add new test entry from form
        LabVisit::create([
            'visit_code' => 'LVS202506210003',
            'pic_name' => 'athar',
            'institution' => 'universitas syiah kuala',
            'contact' => '+62 81386999706',
            'visit_type' => 'tur_fasilitas',
            'visit_date' => '2025-06-11',
            'participant_count' => 25,
            'purpose_expectations' => 'ede',
            'status' => 'pending',
        ]);

        // Create test analysis requests
        AnalysisRequest::create([
            'request_code' => 'ANL202506210001',
            'researcher_name' => 'Dr. Budi Santoso',
            'affiliation' => 'LIPI - Pusat Penelitian Fisika',
            'email' => 'budi.santoso@lipi.go.id',
            'analysis_type' => 'simulasi_numerik',
            'data_description' => 'Data eksperimen tentang sifat magnetik material nano',
            'analysis_parameters' => 'Temperatur, medan magnet, ukuran partikel',
            'target_deadline' => '2025-07-15',
            'status' => 'pending',
        ]);

        AnalysisRequest::create([
            'request_code' => 'ANL202506210002',
            'researcher_name' => 'Dr. Maya Sari',
            'affiliation' => 'Universitas Indonesia',
            'email' => 'maya.sari@ui.ac.id',
            'analysis_type' => 'analisis_data_geofisika',
            'data_description' => 'Data gravitasi untuk eksplorasi mineral',
            'analysis_parameters' => 'Anomali gravitasi, densitas batuan, struktur geologi',
            'target_deadline' => '2025-07-20',
            'status' => 'in_progress',
            'approved_at' => now(),
            'approved_by' => 2,
        ]);
    }
}
