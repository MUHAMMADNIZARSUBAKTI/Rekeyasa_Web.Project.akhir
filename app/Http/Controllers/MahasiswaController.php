<?php
namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function store(Request $request)
    {
        // Validasi data input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|unique:mahasiswa,nim|max:50',
            'jurusan' => 'required|string|max:255',
        ]);

        // Buat data mahasiswa
        $mahasiswa = Mahasiswa::create($validated);

        // Kembalikan response sukses
        return response()->json([
            'message' => 'Mahasiswa berhasil dibuat',
            'data' => $mahasiswa
        ], 201);
    }
    // Read All Mahasiswa
    public function index()
    {
        $mahasiswa = Mahasiswa::paginate(10); // Gunakan pagination jika banyak data

        return response()->json([
            'message' => 'Data mahasiswa berhasil diambil',
            'data' => $mahasiswa
        ], 200);
    }

    // Read Mahasiswa By ID
    public function show($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                'message' => 'Mahasiswa tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'message' => 'Data mahasiswa berhasil diambil',
            'data' => $mahasiswa
        ], 200);
    }

    // Update Mahasiswa
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                'message' => 'Mahasiswa tidak ditemukan'
            ], 404);
        }

        $validated = $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'nim' => 'sometimes|required|string|unique:mahasiswa,nim,' . $id . '|max:50',
            'jurusan' => 'sometimes|required|string|max:255',
        ]);

        $mahasiswa->update($validated);

        return response()->json([
            'message' => 'Mahasiswa berhasil diperbarui',
            'data' => $mahasiswa
        ], 200);
    }

    // Delete Mahasiswa
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json([
                'message' => 'Mahasiswa tidak ditemukan'
            ], 404);
        }

        $mahasiswa->delete();

        return response()->json([
            'message' => 'Mahasiswa berhasil dihapus'
        ], 200);
    }
}

