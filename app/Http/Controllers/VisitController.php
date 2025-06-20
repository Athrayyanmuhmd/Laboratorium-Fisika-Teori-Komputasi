<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use App\Models\Visit;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class VisitController extends Controller
{
    public function index(): View
    {
        $laboratories = Laboratory::active()->get();
        return view('visits.index', compact('laboratories'));
    }

    public function create(Laboratory $laboratory): View
    {
        return view('visits.create', compact('laboratory'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'laboratory_id' => 'required|exists:laboratories,id',
            'visitor_name' => 'required|string|max:255',
            'visitor_email' => 'required|email|max:255',
            'visitor_phone' => 'required|string|max:20',
            'visitor_institution' => 'nullable|string|max:255',
            'visitor_id_number' => 'nullable|string|max:50',
            'purpose' => 'required|string',
            'group_size' => 'required|integer|min:1|max:50',
            'visit_date' => 'required|date|after:today',
            'visit_time' => 'required',
            'duration_hours' => 'required|integer|min:1|max:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Generate visit code
        $visitCode = 'VST' . date('Ymd') . str_pad(Visit::count() + 1, 4, '0', STR_PAD_LEFT);

        $visit = Visit::create([
            'visit_code' => $visitCode,
            'laboratory_id' => $request->laboratory_id,
            'visitor_name' => $request->visitor_name,
            'visitor_email' => $request->visitor_email,
            'visitor_phone' => $request->visitor_phone,
            'visitor_institution' => $request->visitor_institution,
            'visitor_id_number' => $request->visitor_id_number,
            'purpose' => $request->purpose,
            'group_size' => $request->group_size,
            'visit_date' => $request->visit_date,
            'visit_time' => $request->visit_time,
            'duration_hours' => $request->duration_hours,
            'status' => 'pending',
        ]);

        return redirect()->route('visits.success', $visit->visit_code)
            ->with('success', 'Visit request submitted successfully!');
    }

    public function success(string $visitCode): View
    {
        $visit = Visit::where('visit_code', $visitCode)
            ->with('laboratory')
            ->firstOrFail();

        return view('visits.success', compact('visit'));
    }

    public function track(Request $request): View
    {
        $visitCode = $request->get('code');
        $visit = null;

        if ($visitCode) {
            $visit = Visit::where('visit_code', $visitCode)
                ->with(['laboratory', 'approvedBy'])
                ->first();
        }

        return view('visits.track', compact('visit', 'visitCode'));
    }
}
