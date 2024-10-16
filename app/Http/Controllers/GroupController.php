<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Master Supplier',
        ];
        return view('group', $data);
    }

    public function getGroupsData()
    {
        $group = Group::all();
        return datatables()->of($group)
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
        if (empty($request->group)) {
            return response()->json([
                'success' => false,
                'message' => 'Lengkapi Golongan terlebih dahulu',
            ]);
        }
        $validator = Validator::make($request->all(), [
            'group' => 'required|string|max:100|unique:groups,group',
        ], [
            'group.required' => 'Lengkapi Golongan terlebih dahulu',
            'group.string' => 'Golongan harus berupa teks.',
            'group.max' => 'Golongan tidak boleh lebih dari 100 karakter.',
            'group.unique' => 'Golongan sudah ada, masukkan Satuan lain',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        $group = new Group();
        $group->group = $request->group;
        $group->desc = $request->desc;
        $group->save();

        return response()->json([
            'success' => true,
            'message' => 'Golongan berhasil disimpan!'
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
            $group = Group::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $group
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Golongan tidak ditemukan!'
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
        if (empty($request->group)) {
            return response()->json([
                'success' => false,
                'message' => 'Lengkapi Golongan terlebih dahulu',
            ]);
        }
        $validator = Validator::make($request->all(), [
            'group' => 'required|string|max:100|unique:groups,group,' . $id,
        ], [
            'group.required' => 'Lengkapi Golongan terlebih dahulu',
            'group.string' => 'Golongan harus berupa teks.',
            'group.max' => 'Golongan tidak boleh lebih dari 100 karakter.',
            'group.unique' => 'Golongan sudah ada, masukkan Satuan lain',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ]);
        }

        $group = Group::findOrFail($id);
        $group->group = $request->group;
        $group->desc = $request->desc;
        $group->save();

        return response()->json([
            'success' => true,
            'message' => 'Golongan berhasil diperbarui! '
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $group = Group::findOrFail($id);
        try {
            $group->delete();
            return response()->json([
                'success' => true,
                'message' => 'Golongan berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus golongan!'
            ]);
        }
    }
}
