<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class RentalController extends Controller
{
    public function index(): View
    {
        $equipments = Equipment::with('laboratory')
            ->where('status', 'available')
            ->where('available_quantity', '>', 0)
            ->paginate(12);

        return view('rentals.index', compact('equipments'));
    }

    public function create(Equipment $equipment): View
    {
        $equipment->load('laboratory');
        
        return view('rentals.create', compact('equipment'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'equipment_id' => 'required|exists:equipment,id',
            'renter_name' => 'required|string|max:255',
            'renter_email' => 'required|email|max:255',
            'renter_phone' => 'required|string|max:20',
            'renter_institution' => 'nullable|string|max:255',
            'renter_id_number' => 'nullable|string|max:50',
            'purpose' => 'required|string',
            'quantity' => 'required|integer|min:1',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $equipment = Equipment::findOrFail($request->equipment_id);

        // Check availability
        if ($equipment->available_quantity < $request->quantity) {
            return redirect()->back()
                ->withErrors(['quantity' => 'Quantity requested exceeds available stock.'])
                ->withInput();
        }

        // Generate rental code
        $rentalCode = 'RNT' . date('Ymd') . str_pad(Rental::count() + 1, 4, '0', STR_PAD_LEFT);

        // Calculate total cost
        $startDate = new \DateTime($request->start_date);
        $endDate = new \DateTime($request->end_date);
        $days = $startDate->diff($endDate)->days + 1;
        $totalCost = $equipment->rental_price_per_day * $request->quantity * $days;

        $rental = Rental::create([
            'rental_code' => $rentalCode,
            'equipment_id' => $request->equipment_id,
            'renter_name' => $request->renter_name,
            'renter_email' => $request->renter_email,
            'renter_phone' => $request->renter_phone,
            'renter_institution' => $request->renter_institution,
            'renter_id_number' => $request->renter_id_number,
            'purpose' => $request->purpose,
            'quantity' => $request->quantity,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_cost' => $totalCost,
            'status' => 'pending',
        ]);

        return redirect()->route('rentals.success', $rental->rental_code)
            ->with('success', 'Rental request submitted successfully!');
    }

    public function success(string $rentalCode): View
    {
        $rental = Rental::where('rental_code', $rentalCode)
            ->with(['equipment.laboratory'])
            ->firstOrFail();

        return view('rentals.success', compact('rental'));
    }

    public function track(Request $request): View
    {
        $rentalCode = $request->get('code');
        $rental = null;

        if ($rentalCode) {
            $rental = Rental::where('rental_code', $rentalCode)
                ->with(['equipment.laboratory', 'approvedBy'])
                ->first();
        }

        return view('rentals.track', compact('rental', 'rentalCode'));
    }
}
