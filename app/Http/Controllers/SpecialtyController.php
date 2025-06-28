<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $specialties = Specialty::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })->paginate(10);
        return view('specialties.index', compact('specialties', 'search'));
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
        Specialty::create($request->all());
        return redirect()->route('specialties.index')->with('success', 'Chuyên khoa đã được thêm.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Specialty $specialty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Specialty $specialty)
    {
        return view('specialties.edit', compact('specialty'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Specialty $specialty)
    {
        $specialty->update([
            'name' => $request->name,
            'fee' => $request->fee,
            'status' => $request->has('status'),
        ]);

        return redirect()->route('specialties.index')->with('success', 'Chuyên khoa đã được cập nhật.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Specialty $specialty)
    {
        try {
            $specialty->delete();
            return redirect()->route('specialties.index')->with('success', 'Chuyên khoa đã được xóa.');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('specialties.index')
                    ->with('error', 'Không thể xóa chuyên khoa này vì đang được sử dụng ở nơi khác.');
            }

            return redirect()->route('specialties.index')
                ->with('error', 'Đã xảy ra lỗi khi xóa chuyên khoa.');
        }
    }
}
