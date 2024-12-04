<?php

namespace App\Http\Controllers;

use App\Models\Matkul;
use Illuminate\Http\Request;

class MatkulController extends Controller
{
    /**
     * Create a new matkul.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|unique:matkul,kode|max:10',
            'nama' => 'required|string|max:255',
            'sks' => 'required|integer|min:1|max:6',
        ]);

        $matkul = Matkul::create($validated);

        return response()->json([
            'message' => 'Mata Kuliah berhasil dibuat',
            'data' => $matkul
        ], 201);
    }

    /**
     * Retrieve all matkul records.
     */
    public function index()
    {
        $matkul = Matkul::all();

        return response()->json([
            'message' => 'Data Mata Kuliah berhasil diambil',
            'data' => $matkul
        ], 200);
    }

    /**
     * Retrieve a single matkul by ID.
     */
    public function show($id)
    {
        $matkul = Matkul::find($id);

        if (!$matkul) {
            return response()->json([
                'message' => 'Mata Kuliah tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'message' => 'Data Mata Kuliah berhasil diambil',
            'data' => $matkul
        ], 200);
    }

    /**
     * Update an existing matkul.
     */
    public function update(Request $request, $id)
    {
        $matkul = Matkul::find($id);

        if (!$matkul) {
            return response()->json([
                'message' => 'Mata Kuliah tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'kode' => 'sometimes|required|string|unique:matkul,kode,' . $id . '|max:10',
            'nama' => 'sometimes|required|string|max:255',
            'sks' => 'sometimes|required|integer|min:1|max:6',
        ]);

        $matkul->update($validated);

        return response()->json([
            'message' => 'Mata Kuliah berhasil diperbarui',
            'data' => $matkul
        ], 200);
    }

    /**
     * Delete a matkul by ID.
     */
    public function destroy($id)
    {
        $matkul = Matkul::find($id);

        if (!$matkul) {
            return response()->json([
                'message' => 'Mata Kuliah tidak ditemukan'
            ], 404);
        }

        $matkul->delete();

        return response()->json([
            'message' => 'Mata Kuliah berhasil dihapus'
        ], 200);
    }
}