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
        $aspek = Aspek::with('kriteria')->get();
        $nilai_kriteria = Nilai_Kriteria::with('kriteria')->get();
        $peserta = Peserta::with('sample')->get();
        $nilai = label_nilai::all();
        $bobot = pm_bobot::all();
        $kriteria = Kriteria::select('type')->get();

        $hasilTotalLaki = [];
        $hasilTotalPerempuan = [];

        foreach ($peserta as $row_peserta) {
            $totalNilaiPeserta = 0;

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

                $rataRataCore = $jumlahKriteriaCore > 0 ? $totalBobotCore / $jumlahKriteriaCore : 0;
                $rataRataSecondary = $jumlahKriteriaSecondary > 0 ? $totalBobotSecondary / $jumlahKriteriaSecondary : 0;
                $totalNilaiAspek = $coreFaktor * $rataRataCore + $secondaryFaktor * $rataRataSecondary;
                $totalNilaiPeserta += $totalNilaiAspek;
            }

            // Memisahkan berdasarkan jenis kelamin
            if ($row_peserta->jenis_kelamin === 'laki-laki') {
                $hasilTotalLaki[] = [
                    'peserta' => $row_peserta,
                    'total_nilai' => $totalNilaiPeserta
                ];
            } elseif ($row_peserta->jenis_kelamin === 'Perempuan') {
                $hasilTotalPerempuan[] = [
                    'peserta' => $row_peserta,
                    'total_nilai' => $totalNilaiPeserta
                ];
            }
        }

        // Urutkan berdasarkan total nilai (dari tertinggi ke terendah)
        usort($hasilTotalLaki, function ($a, $b) {
            return $b['total_nilai'] <=> $a['total_nilai'];
        });

        usort($hasilTotalPerempuan, function ($a, $b) {
            return $b['total_nilai'] <=> $a['total_nilai'];
        });

        // Berikan peringkat secara terpisah
        foreach ($hasilTotalLaki as $index => &$data) {
            $data['peringkat'] = $index + 1;
        }

        foreach ($hasilTotalPerempuan as $index => &$data) {
            $data['peringkat'] = $index + 1;
        }

        // dd($hasilTotalLaki);

        return view("admin.Dashboard.HasilPerhitungan", compact("nilai_kriteria", "nilai", "peserta", "aspek", 'bobot', 'kriteria', 'hasilTotalLaki', 'hasilTotalPerempuan'));
    }
}
