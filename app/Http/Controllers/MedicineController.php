<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Master Obat',
        ];
        return view('obat', $data);
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
        //
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
        //
    }

    public function getMedicinesData(Request $request)
    {
        $medicines = Medicine::leftJoin('categories', 'medicines.category_id', '=', 'categories.id')
            ->leftJoin('groups', 'medicines.group_id', '=', 'groups.id')
            ->leftJoin('suppliers', 'medicines.supplier_id', '=', 'suppliers.id')
            ->leftJoin('units', 'medicines.unit_id', '=', 'units.unit_id')
            ->select([
                'medicines.id',
                'medicines.name',
                'categories.category as category_name',
                'groups.group as group_name',
                'suppliers.name as supplier_name',
                'units.unit_name as unit_name',
                'medicines.stock',
                'medicines.price_buy',
                'medicines.price_sell',
                'medicines.description',
                'medicines.created_at',
                'medicines.updated_at'
            ]);
        return DataTables::of($medicines)
            ->addIndexColumn()
            ->filterColumn('category_name', function ($query, $keyword) {
                $query->where('categories.category', 'like', "%{$keyword}%");
            })
            ->filterColumn('group_name', function ($query, $keyword) {
                $query->where('groups.group', 'like', "%{$keyword}%");
            })
            ->filterColumn('supplier_name', function ($query, $keyword) {
                $query->where('suppliers.name', 'like', "%{$keyword}%");
            })
            ->filterColumn('unit_name', function ($query, $keyword) {
                $query->where('units.unit_name', 'like', "%{$keyword}%");
            })

            ->addColumn('category_name', function ($row) {
                return $row->category_name ?: 'No Category';
            })
            ->addColumn('group_name', function ($row) {
                return $row->group_name ?: 'No Group';
            })
            ->addColumn('supplier_name', function ($row) {
                return $row->supplier_name ?: 'No Supplier';
            })
            ->addColumn('unit_name', function ($row) {
                return $row->unit_name ?: 'No Unit';
            })
            ->addColumn('action', function ($row) {
                $editBtn = '<button class="btn btn-sm btn-info edit-btn" data-id="' . $row->id . '"><i class="fa fa-edit"></i></button>';
                $deleteBtn = '<button class="btn btn-sm btn-danger delete-btn" data-id="' . $row->id . '"><i class="fa fa-trash"></i></button>';
                return $editBtn . ' ' . $deleteBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
