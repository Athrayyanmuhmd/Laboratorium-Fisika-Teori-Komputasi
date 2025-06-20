<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    public function index(): View
    {
        $laboratories = Laboratory::active()->get();
        return view('tests.index', compact('laboratories'));
    }

    public function create(Laboratory $laboratory): View
    {
        return view('tests.create', compact('laboratory'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'laboratory_id' => 'required|exists:laboratories,id',
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'client_phone' => 'required|string|max:20',
            'client_institution' => 'nullable|string|max:255',
            'client_address' => 'required|string',
            'sample_type' => 'required|string|max:255',
            'sample_description' => 'required|string',
            'test_type' => 'required|string|max:255',
            'test_parameters' => 'required|string',
            'sample_quantity' => 'required|integer|min:1',
            'urgency_level' => 'required|in:normal,urgent,emergency',
            'expected_completion_date' => 'nullable|date|after:today',
            'special_instructions' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Generate test code
        $testCode = 'TST' . date('Ymd') . str_pad(Test::count() + 1, 4, '0', STR_PAD_LEFT);

        $test = Test::create([
            'test_code' => $testCode,
            'laboratory_id' => $request->laboratory_id,
            'client_name' => $request->client_name,
            'client_email' => $request->client_email,
            'client_phone' => $request->client_phone,
            'client_institution' => $request->client_institution,
            'client_address' => $request->client_address,
            'sample_type' => $request->sample_type,
            'sample_description' => $request->sample_description,
            'test_type' => $request->test_type,
            'test_parameters' => $request->test_parameters,
            'sample_quantity' => $request->sample_quantity,
            'urgency_level' => $request->urgency_level,
            'expected_completion_date' => $request->expected_completion_date,
            'special_instructions' => $request->special_instructions,
            'status' => 'pending',
        ]);

        return redirect()->route('tests.success', $test->test_code)
            ->with('success', 'Test request submitted successfully!');
    }

    public function success(string $testCode): View
    {
        $test = Test::where('test_code', $testCode)
            ->with('laboratory')
            ->firstOrFail();

        return view('tests.success', compact('test'));
    }

    public function track(Request $request): View
    {
        $testCode = $request->get('code');
        $test = null;

        if ($testCode) {
            $test = Test::where('test_code', $testCode)
                ->with(['laboratory', 'approvedBy', 'assignedTo'])
                ->first();
        }

        return view('tests.track', compact('test', 'testCode'));
    }
}
