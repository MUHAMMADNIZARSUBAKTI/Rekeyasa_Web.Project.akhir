<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nidn' => 'required|string|unique:dosen,nidn|max:50',
            'fakultas' => 'required|string|max:255',
        ]);

        $dosen = Dosen::create($validated);

        return response()->json(['message' => 'Dosen berhasil dibuat', 'data' => $dosen], 201);
    }

    public function index()
    {
        $dosen = Dosen::all();
        return response()->json(['message' => 'Data dosen berhasil diambil', 'data' => $dosen], 200);
    }

    public function show($id)
    {
        $dosen = Dosen::find($id);

        if (!$dosen) {
            return response()->json(['message' => 'Dosen tidak ditemukan'], 404);
        }

        return response()->json(['message' => 'Data dosen berhasil diambil', 'data' => $dosen], 200);
    }

    public function update(Request $request, $id)
    {
        $dosen = Dosen::find($id);

        if (!$dosen) {
            return response()->json(['message' => 'Dosen tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'nidn' => 'sometimes|required|string|unique:dosen,nidn,' . $id . '|max:50',
            'fakultas' => 'sometimes|required|string|max:255',
        ]);

        $dosen->update($validated);

        return response()->json(['message' => 'Dosen berhasil diperbarui', 'data' => $dosen], 200);
    }

    public function destroy($id)
    {
        $dosen = Dosen::find($id);

        if (!$dosen) {
            return response()->json(['message' => 'Dosen tidak ditemukan'], 404);
        }

        $dosen->delete();

        return response()->json(['message' => 'Dosen berhasil dihapus'], 200);
    }
}
