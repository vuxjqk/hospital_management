<?php

namespace App\Http\Controllers;

use App\Models\Examination;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExaminationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('examinations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Appointment $appointment)
    {
        $examination = Examination::create([
            'patient_id' => $request->patient_id,
            'specialty_id' => $request->specialty_id,
            'user_id' => Auth::id(),
            'examined_at' => now(),
        ]);

        $appointment = Appointment::findOrFail($request->appointment_id);

        $appointment->update([
            'examination_id' => $examination->id,
        ]);

        return redirect()->route('examinations.edit', $examination)->with('success', 'Bắt đầu khám bệnh.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Examination $examination)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Examination $examination)
    {
        return view('examinations.edit', compact('examination'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Examination $examination)
    {
        $examination->update([
            'symptoms' => $request->symptoms,
            'diagnosis' => $request->diagnosis,
            'treatment' => $request->treatment,
            'note' => $request->note,
            'status' => 'completed',
        ]);

        return redirect()->route('appointments.index')->with('success', 'Đã khám bệnh.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Examination $examination)
    {
        //
    }
}
