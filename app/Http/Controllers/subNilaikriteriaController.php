<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\label_nilai;
use App\Models\Nilai_Kriteria;
use Illuminate\Http\Request;

class subNilaikriteriaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $nilai_kriteria = Nilai_Kriteria::with('kriteria')->get();

        $kriteria = Kriteria::select('id', 'kriteria')->orderBy('id', 'desc')->paginate(10);
        // $id_kriteria = Nilai_Kriteria::with('kriteria')->get();
        $label_nilai = label_nilai::select('id', 'nama', 'nilai')->orderBy('id', 'desc')->paginate(10);

        return view("admin.Dashboard.subNilaikriteria", compact("kriteria", 'label_nilai', 'nilai_kriteria'));
    }

    public function store(Request $request)
    {
        $nilai_kriteria = Nilai_Kriteria::with('kriteria')->get();

        $kriteria = Kriteria::select('id', 'kriteria')->orderBy('id', 'desc')->paginate(10);
        $label_nilai = label_nilai::select('id', 'nama', 'nilai')->orderBy('id', 'desc')->paginate(10);

        $validatedData = $request->validate([
            "id_kriteria" => "required|exists:kriteria,id",
            "nama" => "required",
            "nilai" => "required",
        ]);

        // Iterasi untuk menyimpan data ke tabel
        foreach ($validatedData['nilai'] as $index => $nilaiId) {
            // Cek apakah kombinasi id_kriteria, nilai, dan nama sudah ada
            $existingNilai = Nilai_Kriteria::where('id_kriteria', $validatedData['id_kriteria'])
                ->where('nilai', $nilaiId)
                ->where('nama', $validatedData['nama'][$index])
                ->first();

            if (!$existingNilai) {
                Nilai_Kriteria::create([
                    'id_kriteria' => $validatedData['id_kriteria'],
                    'nilai' => $nilaiId,
                    'nama' => $validatedData['nama'][$index],
                ]);
            }
        }

        // Redirect atau tampilkan view setelah data disimpan
        return view('admin.Dashboard.subNilaikriteria', compact('kriteria', 'label_nilai', 'nilai_kriteria'));
    }
}
