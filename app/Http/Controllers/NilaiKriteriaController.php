<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai_Kriteria;

class NilaiKriteriaController extends Controller
{
    public function index()
    {
        $data = Nilai_Kriteria::all();
        return view("admin.Dashboard.DataKriteria", compact("data"));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                "id_kriteria" => "required|exists:kriteria,id",
                "nama" => "required",
                "nilai" => "required",
            ],
            [
                "id_aspek" => "Data Dari Aspek Tidak Sesuai",
                "nama" => "nama Harus Di isi Terlebih Dahulu ",
                "nilai" => "Nilai Harus Di isi Terlebih Dahulu ",
            ]
        );

        $nilai_kriteria = Nilai_Kriteria::create($validatedData);
        return redirect()->route("admin.nilai")->with("success", "Berhasil Menambahkan Data Nilai");
    }
}
