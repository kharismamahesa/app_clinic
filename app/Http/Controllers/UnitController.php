<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Master Satuan Obat',
        ];
        return view('unit', $data);
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
        if (empty($request->unit_name)) {
            return response()->json([
                'success' => false,
                'message' => 'Lengkapi Satuan terlebih dahulu',
            ]);
        }
        if (empty($request->initial)) {
            return response()->json([
                'success' => false,
                'message' => 'Lengkapi inisial terlebih dahulu',
            ]);
        }
        $validator = Validator::make($request->all(), [
            'unit_name' => 'required|string|max:50|unique:units,unit_name',
            'initial' => 'required|string|max:5|unique:units,initial',
        ], [
            'unit_name.required' => 'Lengkapi Satuan terlebih dahulu',
            'unit_name.string' => 'Satuan harus berupa teks.',
            'unit_name.max' => 'Satuan tidak boleh lebih dari 50 karakter.',
            'unit_name.unique' => 'Satuan sudah ada, masukkan Satuan lain',
            'initial.required' => 'Lengkapi Inisial terlebih dahulu',
            'initial.string' => 'Satuan harus berupa teks.',
            'initial.max' => 'Satuan tidak boleh lebih dari 55 karakter.',
            'initial.unique' => 'Inisial sudah ada, masukkan Inisial lain',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        $unit = new Unit();
        $unit->unit_name = $request->unit_name;
        $unit->initial = $request->initial;
        $unit->desc = $request->desc;
        $unit->save();

        return response()->json([
            'success' => true,
            'message' => 'Satuan berhasil disimpan!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $unit = Unit::findOrFail($id);
        try {
            $unit->delete();
            return response()->json([
                'success' => true,
                'message' => 'Satuan berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus satuan!'
            ]);
        }
    }

    public function getUnitsData(Request $request)
    {
        $units = Unit::select(['unit_id', 'unit_name', 'initial', 'desc', 'created_at', 'updated_at']);

        return DataTables::of($units)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $editBtn = '<button class="btn btn-sm btn-info edit-btn" data-id="' . $row->unit_id . '"><i class="fa fa-edit" ></i></button>';
                $deleteBtn = '<button class="btn btn-sm btn-danger delete-btn" data-id="' . $row->unit_id . '"><i class="fa fa-trash" ></i></button>';
                return $editBtn . ' ' . $deleteBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
