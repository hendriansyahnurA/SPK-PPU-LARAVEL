<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspek;
use App\Models\Kriteria;
use App\Models\Nilai_Kriteria;
use App\Models\Peserta;
use App\Models\pm_bobot;
use App\Models\Sample;

class HasilAkhirController extends Controller
{
    public function index()
    {
        $aspek = Aspek::with('kriteria')->get();
        $peserta = Peserta::with('sample')->get();
        $sample = Sample::all();
        $kriteria = Kriteria::with('')->get();
        $nilai = Nilai_Kriteria::all();
        return view("admin.Dashboard.HasilPerhitungan", compact("aspek", "nilai", "peserta", "sample"));
    }
}
