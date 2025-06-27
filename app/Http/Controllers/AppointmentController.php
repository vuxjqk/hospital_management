<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Patient;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $specialties = Specialty::all();
        $patients = Patient::all();
        $appointments = Appointment::all();
        return view('appointments.index', compact('patients', 'appointments', 'specialties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $today = today();

        // Tính số thứ tự trong ngày cho chuyên khoa
        $queueNumber = Appointment::where('specialty_id', $request->specialty_id)
            ->whereDate('created_at', $today)
            ->count() + 1;

        // Lấy thông tin chuyên khoa để tính phí
        $specialty = Specialty::findOrFail($request->specialty_id);

        // Xác định xem bệnh nhân có bảo hiểm không
        $has_insurance = $request->boolean('has_insurance');

        // Tạo lịch hẹn
        $appointment = Appointment::create([
            'patient_id' => $request->patient_id,
            'specialty_id' => $request->specialty_id,
            'queue_number' => $queueNumber,
            'has_insurance' => $has_insurance,
            'created_by' => Auth::id(),
        ]);

        // Tạo hóa đơn
        $invoice = Invoice::create([
            'patient_id' => $request->patient_id,
            'created_by' => Auth::id(),
        ]);

        // Chi tiết hóa đơn
        InvoiceDetail::create([
            'invoice_id' => $invoice->id,
            'item_type' => 'Khám bệnh',
            'item_id' => $appointment->id,
            'unit_price' => $specialty->fee,
            'quantity' => 1,
            'total_price' => $specialty->fee,
        ]);

        // Cập nhật hoá đơn
        Invoice::where('id', $invoice->id)->update([
            'total_amount' => $specialty->fee,
        ]);

        return redirect()->route('appointments.index')->with('success', 'Lịch khám đã được thêm.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
