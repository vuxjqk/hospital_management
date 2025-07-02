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
        return view('patients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'national_id' => 'required|string|unique:patients,national_id',
            'full_name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:patients,email',
            'password' => 'nullable|string|min:8|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|string',
            'insurance_number' => 'nullable|string|unique:patients,insurance_number',
            'insurance_expiry_date' => 'nullable|date',
        ]);

        // Xử lý ảnh nếu có
        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $validated['profile_picture'] = $path;
        }

        // Mã hóa mật khẩu nếu có
        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        }

        $validated['updated_by'] = Auth::id(); // nếu có hệ thống đăng nhập

        Patient::create($validated);

        return redirect()->back()->with('success', 'Thêm bệnh nhân thành công.');
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
        $validated = $request->validate([
            'national_id' => 'required|string|unique:patients,national_id,' . $patient->id,
            'full_name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'email' => 'nullable|email|unique:patients,email,' . $patient->id,
            'password' => 'nullable|string|min:8|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|string',
            'insurance_number' => 'nullable|string|unique:patients,insurance_number,' . $patient->id,
            'insurance_expiry_date' => 'nullable|date',
        ]);

        if ($request->hasFile('profile_picture')) {
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $validated['profile_picture'] = $path;
        }

        if (!empty($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']); // nếu không nhập mới, giữ mật khẩu cũ
        }

        $validated['updated_by'] = Auth::id(); // nếu có hệ thống đăng nhập

        $patient->update($validated);

        return redirect()->back()->with('success', 'Cập nhật bệnh nhân thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        //
    }
}
