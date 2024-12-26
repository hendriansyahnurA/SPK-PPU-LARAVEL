<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Aspek;
use App\Models\label_nilai;
use App\Models\Nilai_Kriteria;
use App\Models\Peserta;
use App\Models\Sample;
use Illuminate\Http\Request;

class KlasifikasiController extends Controller
{
    public function index()
    {
        $aspek = Aspek::with('kriteria')->get();
        $table_aspek = Aspek::with('kriteria')->paginate(1);
        $nilai_kriteria = Nilai_Kriteria::with('kriteria')->get();
        $peserta = Peserta::all();
        $nilai = label_nilai::all();

        return view('admin.Dashboard.KlasifikasiNilai', compact('aspek', 'peserta', 'nilai_kriteria', 'table_aspek', 'nilai'));
    }

    public function store(Request $request)
    {
        $aspek = Aspek::with('kriteria')->get();
        $nilai_kriteria = Nilai_Kriteria::with('kriteria')->get();
        $peserta = Peserta::all();

        $request->validate([
            'id_alternatif' => 'required',
            'id_faktor_nilai' => 'required',
        ]);

        // Mengambil input dari request
        $id_alternatif = $request->input('id_alternatif');
        $id_faktor_nilai = $request->input('id_faktor_nilai');

        // Menyimpan data baru ke dalam table Sample
        foreach ($id_alternatif as $index => $id_peserta) {
            // Memeriksa apakah data dengan kombinasi id_alternatif dan id_faktor_nilai sudah ada
            $exists = Sample::where('id_alternatif', $id_alternatif[$index])
                ->where('id_faktor_nilai', $id_faktor_nilai[$index])
                ->exists();

            // Jika data belum ada, baru disimpan
            if ($id_faktor_nilai[$index] != 0 && !$exists) {
                Sample::create([
                    'id_alternatif' => $id_alternatif[$index],
                    'id_faktor_nilai' => $id_faktor_nilai[$index],
                ]);
            }
        }

        return view('admin.Dashboard.KlasifikasiNilai', compact('aspek', 'nilai_kriteria', 'peserta'));
    }
}
