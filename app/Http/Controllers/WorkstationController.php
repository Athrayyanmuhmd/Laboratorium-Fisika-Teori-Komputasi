<?php

namespace App\Http\Controllers;

use App\Models\WorkstationRental;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class WorkstationController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        Log::info('=== WORKSTATION CONTROLLER STORE CALLED ===');
        Log::info('Request method: ' . $request->method());
        Log::info('Request URL: ' . $request->fullUrl());
        Log::info('Request headers: ', $request->headers->all());
        Log::info('Request data: ', $request->all());
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'institution' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'workstation_type' => 'required|in:pc_high_performance,software_geofisika,tools_fotografi,environment_programming',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'research_purpose' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            Log::error('Validation failed', $validator->errors()->toArray());
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . $validator->errors()->first(),
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Generate request code
            $requestCode = 'WRK' . date('Ymd') . str_pad(WorkstationRental::count() + 1, 4, '0', STR_PAD_LEFT);
            Log::info('Generated request code: ' . $requestCode);

            $workstation = WorkstationRental::create([
                'request_code' => $requestCode,
                'name' => $request->name,
                'institution' => $request->institution,
                'email' => $request->email,
                'workstation_type' => $request->workstation_type,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'research_purpose' => $request->research_purpose,
                'status' => 'pending',
            ]);

            Log::info('Workstation created successfully', ['id' => $workstation->id, 'request_code' => $requestCode]);

            return response()->json([
                'success' => true,
                'message' => 'Permohonan penyewaan workstation berhasil dikirim! Kode permohonan: ' . $requestCode,
                'request_code' => $requestCode
            ]);
        } catch (\Exception $e) {
            Log::error('Error creating workstation', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
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
                'message' => 'Kode permohonan diperlukan'
            ], 400);
        }

        $workstation = WorkstationRental::where('request_code', $requestCode)
            ->with('approvedBy')
            ->first();

        if (!$workstation) {
            return response()->json([
                'success' => false,
                'message' => 'Permohonan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'request_code' => $workstation->request_code,
                'name' => $workstation->name,
                'institution' => $workstation->institution,
                'workstation_type' => $workstation->getWorkstationTypeLabel(),
                'start_date' => $workstation->start_date->format('d/m/Y'),
                'end_date' => $workstation->end_date->format('d/m/Y'),
                'status' => $workstation->getStatusLabel(),
                'admin_notes' => $workstation->admin_notes,
                'approved_at' => $workstation->approved_at?->format('d/m/Y H:i'),
                'approved_by' => $workstation->approvedBy?->name,
                'created_at' => $workstation->created_at->format('d/m/Y H:i')
            ]
        ]);
    }
} 