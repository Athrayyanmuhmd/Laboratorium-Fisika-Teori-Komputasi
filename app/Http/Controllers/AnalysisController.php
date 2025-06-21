<?php

namespace App\Http\Controllers;

use App\Models\AnalysisRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class AnalysisController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'researcher_name' => 'required|string|max:255',
            'affiliation' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'analysis_type' => 'required|in:simulasi_numerik,analisis_data_geofisika,visualisasi_data,laporan_komprehensif',
            'data_description' => 'required|string|max:2000',
            'analysis_parameters' => 'required|string|max:1000',
            'target_deadline' => 'required|date|after_or_equal:today',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Generate request code
            $requestCode = 'ANL' . date('Ymd') . str_pad(AnalysisRequest::count() + 1, 4, '0', STR_PAD_LEFT);

            $analysis = AnalysisRequest::create([
                'request_code' => $requestCode,
                'researcher_name' => $request->researcher_name,
                'affiliation' => $request->affiliation,
                'email' => $request->email,
                'analysis_type' => $request->analysis_type,
                'data_description' => $request->data_description,
                'analysis_parameters' => $request->analysis_parameters,
                'target_deadline' => $request->target_deadline,
                'status' => 'pending',
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Request analisis berhasil dikirim! Kode request: ' . $requestCode,
                'request_code' => $requestCode
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
        $requestCode = $request->get('code');
        
        if (!$requestCode) {
            return response()->json([
                'success' => false,
                'message' => 'Kode request diperlukan'
            ], 400);
        }

        $analysis = AnalysisRequest::where('request_code', $requestCode)
            ->with(['approvedBy', 'analyst'])
            ->first();

        if (!$analysis) {
            return response()->json([
                'success' => false,
                'message' => 'Request tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'request_code' => $analysis->request_code,
                'researcher_name' => $analysis->researcher_name,
                'affiliation' => $analysis->affiliation,
                'analysis_type' => $analysis->getAnalysisTypeLabel(),
                'target_deadline' => $analysis->target_deadline->format('d/m/Y'),
                'status' => $analysis->getStatusLabel(),
                'admin_notes' => $analysis->admin_notes,
                'results' => $analysis->results,
                'approved_at' => $analysis->approved_at?->format('d/m/Y H:i'),
                'completed_at' => $analysis->completed_at?->format('d/m/Y H:i'),
                'approved_by' => $analysis->approvedBy?->name,
                'analyst' => $analysis->analyst?->name,
                'created_at' => $analysis->created_at->format('d/m/Y H:i')
            ]
        ]);
    }
} 