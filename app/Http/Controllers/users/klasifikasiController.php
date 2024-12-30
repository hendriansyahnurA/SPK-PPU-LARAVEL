<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aspek;
use App\Models\label_nilai;
use App\Models\Nilai_Kriteria;
use App\Models\Peserta;
use App\Models\Sample;

class klasifikasiController extends Controller
{
    public function index()
    {
        $aspek = Aspek::with('kriteria')->get();
        $table_aspek = Aspek::with('kriteria')->paginate(1);
        $nilai_kriteria = Nilai_Kriteria::with('kriteria')->get();
        $peserta = Peserta::all();
        $nilai = label_nilai::all();

        return view('evaluator.klasifikasi', compact('aspek', 'peserta', 'nilai_kriteria', 'table_aspek', 'nilai'));
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

        return redirect()->route("users.klasifikasi", compact('aspek', 'nilai_kriteria', 'peserta'))->with("success", "Berhasil Mengklasifikasi Nilai");
    }

    public function destroy()
    {
        Sample::truncate();
        return redirect()->route("users.klasifikasi")->with("success", "Berhasil Mengahapus Semua Nilai");
    }
}
