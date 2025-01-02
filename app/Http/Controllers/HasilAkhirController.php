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
    public function index(Request $request)
    {
        $aspek = Aspek::with('kriteria')->paginate(1);
        $nilai_kriteria = Nilai_Kriteria::with('kriteria')->get();
        $peserta = Peserta::with('sample')->get();
        $nilai = label_nilai::all();
        $bobot = pm_bobot::all();
        $kriteria = Kriteria::select('type')->get();

        // Menyimpan hasil total per peserta
        $hasilTotal = [];

        foreach ($peserta as $row_peserta) {
            foreach ($aspek as $row_aspek) {
                $totalBobotCore = 0;
                $jumlahKriteriaCore = 0;
                $totalBobotSecondary = 0;
                $jumlahKriteriaSecondary = 0;
                $coreFaktor = $row_aspek->core_faktor / 100;
                $secondaryFaktor = $row_aspek->secondary_faktor / 100;

                foreach ($row_aspek->kriteria as $kriteria) {
                    $sample = $row_peserta->sample->firstWhere(function ($sample) use ($kriteria) {
                        return $sample->faktorNilai &&
                            $sample->faktorNilai->kriteria->id == $kriteria->id;
                    });

                    if ($sample && $sample->faktorNilai && $sample->faktorNilai->kriteria) {
                        $nilaiPeserta = $sample->faktorNilai->nilai;
                        $nilaiKriteria = $nilai->where('id', $kriteria->id_nilai)->first();
                        $nilaiKetetapan = $nilaiKriteria ? $nilaiKriteria->nilai : 0;
                        $selisih = $nilaiPeserta - $nilaiKetetapan;

                        $bobotRow = $bobot->firstWhere('selisih', $selisih);
                        $bobotNilai = $bobotRow ? $bobotRow->bobot : 0;

                        if ($kriteria->type == 'core') {
                            $totalBobotCore += $bobotNilai;
                            $jumlahKriteriaCore++;
                        } elseif ($kriteria->type == 'secondary') {
                            $totalBobotSecondary += $bobotNilai;
                            $jumlahKriteriaSecondary++;
                        }
                    }
                }

                // Menghitung rata-rata dan total
                $rataRataCore = $jumlahKriteriaCore > 0 ? $totalBobotCore / $jumlahKriteriaCore : 0;
                $rataRataSecondary = $jumlahKriteriaSecondary > 0 ? $totalBobotSecondary / $jumlahKriteriaSecondary : 0;

                $totalNilai = $coreFaktor * $rataRataCore + $secondaryFaktor * $rataRataSecondary;

                // Simpan hasil total
                $hasilTotal[] = [
                    'peserta' => $row_peserta,
                    'total_nilai' => $totalNilai
                ];
            }
        }

        // Urutkan berdasarkan total_nilai
        usort($hasilTotal, function ($a, $b) {
            return $b['total_nilai'] <=> $a['total_nilai']; // Urutkan secara menurun
        });

        // Berikan peringkat
        foreach ($hasilTotal as $index => &$data) {
            $data['peringkat'] = $index + 1; // Peringkat dimulai dari 1
        }

        return view("admin.Dashboard.HasilPerhitungan", compact("nilai_kriteria", "nilai", "peserta", "aspek", 'bobot', 'kriteria', 'hasilTotal'));
    }
}