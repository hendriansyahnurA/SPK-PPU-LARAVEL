<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Aspek;
use App\Models\Kriteria;
use App\Models\label_nilai;
use App\Models\Nilai_Kriteria;
use App\Models\Peserta;
use App\Models\pm_bobot;

class evaluatorController extends Controller
{
    public function index()
    {
        $evaluatorCount = User::where('role', 'Evaluator')->count();
        return view('evaluator.page', compact('evaluatorCount'));
    }

    public function showHasil()
    {
        $aspek = Aspek::with('kriteria')->paginate(1);
        $nilai_kriteria = Nilai_Kriteria::with('kriteria')->get();
        $peserta = Peserta::with('sample')->get();
        $nilai = label_nilai::all();
        $bobot = pm_bobot::all();
        $kriteria = Kriteria::select('type')->get();
        return view("evaluator.hasilEvaluator", compact("nilai_kriteria", "nilai", "peserta", "aspek", 'bobot', 'kriteria'));
    }
}
