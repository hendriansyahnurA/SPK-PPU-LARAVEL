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
        $nilai_kriteria = Nilai_Kriteria::with('kriteria')
            ->when($search, function ($query, $search) {
                $query->whereHas('kriteria', function ($q) use ($search) {
                    $q->where('kriteria', 'LIKE', '%' . $search . '%');
                });
            })
            ->paginate(5);

        $kriteria = Kriteria::select('id', 'kriteria')->orderBy('id', 'desc')->get();
        $label_nilai = label_nilai::select('id', 'nama', 'nilai')->orderBy('id', 'desc')->get();

        return view("admin.Dashboard.subNilaikriteria", compact("kriteria", 'label_nilai', 'nilai_kriteria'));
    }

    public function store(Request $request)
    {
        $search = $request->input('search');
        $nilai_kriteria = Nilai_Kriteria::with('kriteria')
            ->when($search, function ($query, $search) {
                $query->whereHas('kriteria', function ($q) use ($search) {
                    $q->where('kriteria', 'LIKE', '%' . $search . '%');
                });
            })
            ->paginate(5);
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

        return redirect()->route("admin.subNilai", compact('kriteria', 'label_nilai', 'nilai_kriteria'))->with("success", "Data Kriteria Berhasil Ditambahkan");
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                "id_kriteria" => "required|exists:kriteria,id",
                "nama" => "required",
                "nilai" => "required",
            ],
            [

                "id_aspek" => "Data Dari Aspek Tidak Sesuai",
                "id_nilai" => "Target Dari nilai Tidak Sesuai",
                "kriteria" => "Data Harus Di isi Terlebih Dahulu ",
                "type" => "Data Harus Di isi Terlebih Dahulu ",
            ]
        );

        $kriteria = Nilai_Kriteria::findOrFail($id);
        $kriteria->update($validatedData);
        return redirect()->route("admin.subNilai")->with("success", "Data Kriteria Berhasil Diperbarui");
    }

    public function destroy($id)
    {
        $kriteria = Nilai_Kriteria::findOrFail($id);
        $kriteria->delete();
        return redirect()->route("admin.subNilai")->with("success", "Data Kriteria Berhasil Dihapus");
    }
}
