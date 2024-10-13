<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Master Supplier',
        ];
        return view('supplier', $data);
    }

    public function getSuppliersData()
    {
        $suppliers = Supplier::all();
        return datatables()->of($suppliers)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $editBtn = '<button class="btn btn-sm btn-info edit-btn" data-id="' . $row->id . '"><i class="fa fa-edit" ></i></button>';
                $deleteBtn = '<button class="btn btn-sm btn-danger delete-btn" data-id="' . $row->id . '"><i class="fa fa-trash" ></i></button>';
                return $editBtn . ' ' . $deleteBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
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
        if (empty($request->name)) {
            return response()->json([
                'success' => false,
                'message' => 'Lengkapi nama supplier terlebih dahulu',
            ]);
        }
        if (empty($request->address)) {
            return response()->json([
                'success' => false,
                'message' => 'Lengkapi alamat supplier terlebih dahulu',
            ]);
        }
        if (empty($request->phone)) {
            return response()->json([
                'success' => false,
                'message' => 'Lengkapi nomor telepon supplier terlebih dahulu',
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:suppliers,name',
            'address' => 'required|string',
            'phone' => 'required|numeric',
        ], [
            'name.required' => 'Lengkapi nama supplier terlebih dahulu',
            'name.string' => 'Nama supplier harus berupa teks.',
            'name.max' => 'Nama supplier tidak boleh lebih dari 255 karakter.',
            'name.unique' => 'Nama supplier sudah ada, masukkan nama supplier lain',
            'address.required' => 'Lengkapi alamat supplier terlebih dahulu',
            'address.string' => 'Alamat supplier harus berupa teks.',
            'phone.required' => 'Lengkapi nomor telepon supplier terlebih dahulu',
            'phone.numeric' => 'Nomor telepon supplier harus berupa angka.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        $supplier = new Supplier();
        $supplier->name = $request->name;
        $supplier->address = $request->address;
        $supplier->phone = $request->phone;
        $supplier->save();

        return response()->json([
            'success' => true,
            'message' => 'Supplier berhasil disimpan!'
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
        try {
            $supplier = Supplier::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $supplier
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Supplier tidak ditemukan!'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (empty($id)) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan, ID kosong',
            ]);
        }
        if (empty($request->name)) {
            return response()->json([
                'success' => false,
                'message' => 'Lengkapi nama supplier terlebih dahulu',
            ]);
        }
        if (empty($request->address)) {
            return response()->json([
                'success' => false,
                'message' => 'Lengkapi alamat supplier terlebih dahulu',
            ]);
        }
        if (empty($request->phone)) {
            return response()->json([
                'success' => false,
                'message' => 'Lengkapi nomor telepon supplier terlebih dahulu',
            ]);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:suppliers,name,' . $id,
            'address' => 'required|string',
            'phone' => 'required|numeric',
        ], [
            'name.required' => 'Lengkapi nama supplier terlebih dahulu',
            'name.string' => 'Nama supplier harus berupa teks.',
            'name.max' => 'Nama supplier tidak boleh lebih dari 255 karakter.',
            'name.unique' => 'Nama supplier sudah ada, masukkan nama supplier lain',
            'address.required' => 'Lengkapi alamat supplier terlebih dahulu',
            'address.string' => 'Alamat supplier harus berupa teks.',
            'phone.required' => 'Lengkapi nomor telepon supplier terlebih dahulu',
            'phone.numeric' => 'Nomor telepon supplier harus berupa angka.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        $supplier = Supplier::findOrFail($id);
        $supplier->name = $request->name;
        $supplier->address = $request->address;
        $supplier->phone = $request->phone;
        $supplier->save();

        return response()->json([
            'success' => true,
            'message' => 'Supplier berhasil diperbarui!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        try {
            $supplier->delete();
            return response()->json([
                'success' => true,
                'message' => 'Supplier berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus kategori!'
            ]);
        }
    }
}
