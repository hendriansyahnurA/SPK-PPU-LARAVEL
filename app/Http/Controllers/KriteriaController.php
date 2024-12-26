<?php

namespace App\Http\Controllers;

use App\Models\Aspek;
use App\Models\Kriteria;
use App\Models\label_nilai;
use App\Models\Nilai_Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input("search");
        $kriteria = Kriteria::when($search, function ($query) use ($search) {
            $query->where("kriteria", "like", "%{$search}%");
        })->paginate(10);

        $aspek = Aspek::select('id', 'aspek_penilaian')->orderBy('id', 'desc')->paginate(10);

        $label_nilai = label_nilai::select('id', 'nilai')->orderBy('id', 'desc')->paginate(10);

        return view("admin.Dashboard.DataKriteria", compact("search", "kriteria", 'aspek', 'label_nilai'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                "id_aspek" => "required|exists:aspek,id",
                'id_nilai' => 'required|exists:label_nilai,id',
                "kriteria" => "required",
                "type" => "required",
            ],
            [
                "id_aspek" => "Data Dari Aspek Tidak Sesuai",
                "id_nilai" => "Target Dari nilai Tidak Sesuai",
                "kriteria" => "Kriteria Harus Di isi Terlebih Dahulu ",
                "type" => "Type Harus Di isi Terlebih Dahulu ",
            ]
        );

        $kriteria = Kriteria::create($validatedData);
        return redirect()->route("admin.kriteria")->with("success", "Berhasil Menambahkan Data Kriteria");
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                "id_aspek" => "required|exists:aspek,id",
                "id_nilai" => "required|exists:label_nilai,id",
                "kriteria" => "required",
                "type" => "required",
            ],
            [

                "id_aspek" => "Data Dari Aspek Tidak Sesuai",
                "id_nilai" => "Target Dari nilai Tidak Sesuai",
                "kriteria" => "Data Harus Di isi Terlebih Dahulu ",
                "type" => "Data Harus Di isi Terlebih Dahulu ",
            ]
        );
        $kriteria = Kriteria::findOrFail($id);
        $kriteria->update($validatedData);
        return redirect()->route("admin.kriteria")->with("success", "Data Kriteria Berhasil Diperbarui");
    }

    public function destroy($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        $kriteria->delete();
        return redirect()->route("admin.kriteria")->with("success", "Data Kriteria Berhasil Dihapus");
    }
}
