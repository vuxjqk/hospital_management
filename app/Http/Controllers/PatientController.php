<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $patients = Patient::when($search, function ($query, $search) {
            return $query->where('full_name', 'like', "%{$search}%");
        })->paginate(10);

        $appointments = Appointment::paginate(10);

        $specialties = Specialty::all();

        return view('patients.index', compact('patients', 'appointments', 'specialties', 'search'));
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
        Patient::create($request->all());
        return redirect()->route('patients.index')->with('success', 'Bệnh nhân đã được thêm.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Patient $patient)
    {
        $patient->update(array_merge(
            $request->all(),
            ['updated_by' => Auth::id()]
        ));
        return redirect()->route('patients.index')->with('success', 'Bệnh nhân đã được cập nhật.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        //
    }
}
