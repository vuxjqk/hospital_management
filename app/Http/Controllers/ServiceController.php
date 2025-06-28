<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $services = Service::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%");
        })->paginate(10);
        return view('services.index', compact('services', 'search'));
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
        Service::create($request->all());
        return redirect()->route('services.index')->with('success', 'Dịch vụ đã được thêm.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        $service->update([
            'name' => $request->name,
            'fee' => $request->fee,
            'status' => $request->has('status'),
        ]);

        return redirect()->route('services.index')->with('success', 'Cập nhật dịch vụ thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        try {
            $service->delete();
            return redirect()->route('services.index')->with('success', 'dịch vụ đã được xóa.');
        } catch (QueryException $e) {
            if ($e->getCode() == '23000') {
                return redirect()->route('services.index')
                    ->with('error', 'Không thể xóa dịch vụ này vì đang được sử dụng ở nơi khác.');
            }

            return redirect()->route('services.index')
                ->with('error', 'Đã xảy ra lỗi khi xóa dịch vụ.');
        }
    }
}
