<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Aspek;
use App\Models\Nilai_Kriteria;
use App\Models\Peserta;
use App\Models\Sample;
use Illuminate\Http\Request;

class KlasifikasiController extends Controller
{
    public function index()
    {
        $aspek = Aspek::with('kriteria')->get(); // Mengambil aspek beserta kriteria terkait
        $nilai = Nilai_Kriteria::all(); // Mengambil semua nilai dari pm_kriteria_nilai
        $peserta = Peserta::all(); // Mengambil semua peserta

        return view('admin.Dashboard.KlasifikasiNilai', compact('aspek', 'peserta', 'nilai'));
    }

    public function store(Request $request)
    {
        $aspek = Aspek::with('kriteria')->get(); // Mengambil aspek beserta kriteria terkait
        $nilai = Nilai_Kriteria::all(); // Mengambil semua nilai dari pm_kriteria_nilai
        $peserta = Peserta::all();

        $request->validate([
            'id_alternatif' => 'required|array',
            'id_faktor_nilai' => 'required|array',
            'id_aspek' => 'required|integer',
        ]);

        // Mengambil input dari request
        $id_alternatif = $request->input('id_alternatif');
        $id_faktor_nilai = $request->input('id_faktor_nilai');
        $id_aspek = $request->input('id_aspek');

        // Menyimpan data baru ke dalam table Sample
        foreach ($id_alternatif as $index => $id_peserta) {
            if ($id_faktor_nilai[$index] != 0) { // Pastikan tidak menyimpan nilai 0
                Sample::create([
                    'id_peserta' => $id_peserta,
                    'id_alternatif' => $id_alternatif[$index],
                    'id_faktor_nilai' => $id_faktor_nilai[$index],
                    'id_aspek' => $id_aspek,
                ]);
            }
        }

        return view('admin.Dashboard.KlasifikasiNilai', compact('aspek', 'peserta', 'nilai'));
    }
}
