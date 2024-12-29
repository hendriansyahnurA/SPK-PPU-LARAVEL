<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspek;
use App\Models\Kriteria;
use App\Models\label_nilai;
use App\Models\Nilai_Kriteria;
use App\Models\Peserta;
use App\Models\pm_bobot;

class HasilAkhirController extends Controller
{
    public function index()
    {
        $aspek = Aspek::with('kriteria')->paginate(1);
        $nilai_kriteria = Nilai_Kriteria::with('kriteria')->get();
        $peserta = Peserta::with('sample')->get();
        $nilai = label_nilai::all();
        $bobot = pm_bobot::all();
        $kriteria = Kriteria::select('type')->get();
        return view("admin.Dashboard.HasilPerhitungan", compact("nilai_kriteria", "nilai", "peserta", "aspek", 'bobot', 'kriteria'));
    }
}
