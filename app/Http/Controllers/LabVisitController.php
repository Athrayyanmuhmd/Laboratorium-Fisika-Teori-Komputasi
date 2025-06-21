<?php

namespace App\Http\Controllers;

use App\Models\LabVisit;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class LabVisitController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'pic_name' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'visit_type' => 'required|in:tur_fasilitas,workshop_simulasi,demo_software,konsultasi_ahli',
            'visit_date' => 'required|date|after_or_equal:today',
            'participant_count' => 'required|integer|min:1|max:50',
            'purpose_expectations' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Generate visit code
            $visitCode = 'LVS' . date('Ymd') . str_pad(LabVisit::count() + 1, 4, '0', STR_PAD_LEFT);

            $visit = LabVisit::create([
                'visit_code' => $visitCode,
                'pic_name' => $request->pic_name,
                'institution' => $request->institution,
                'contact' => $request->contact,
                'visit_type' => $request->visit_type,
                'visit_date' => $request->visit_date,
                'participant_count' => $request->participant_count,
                'purpose_expectations' => $request->purpose_expectations,
                'status' => 'pending',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pengajuan kunjungan berhasil dikirim! Kode kunjungan: ' . $visitCode,
                'visit_code' => $visitCode
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function track(Request $request)
    {
        $visitCode = $request->get('code');
        
        if (!$visitCode) {
            return response()->json([
                'success' => false,
                'message' => 'Kode kunjungan diperlukan'
            ], 400);
        }

        $visit = LabVisit::where('visit_code', $visitCode)
            ->with('approvedBy')
            ->first();

        if (!$visit) {
            return response()->json([
                'success' => false,
                'message' => 'Kunjungan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'visit_code' => $visit->visit_code,
                'pic_name' => $visit->pic_name,
                'institution' => $visit->institution,
                'contact' => $visit->contact,
                'visit_type' => $visit->getVisitTypeLabel(),
                'visit_date' => $visit->visit_date->format('d/m/Y'),
                'participant_count' => $visit->participant_count,
                'status' => $visit->getStatusLabel(),
                'admin_notes' => $visit->admin_notes,
                'approved_at' => $visit->approved_at?->format('d/m/Y H:i'),
                'approved_by' => $visit->approvedBy?->name,
                'created_at' => $visit->created_at->format('d/m/Y H:i')
            ]
        ]);
    }
} 