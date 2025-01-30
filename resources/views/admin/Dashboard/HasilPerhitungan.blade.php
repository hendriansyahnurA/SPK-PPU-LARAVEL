@extends('layouts.app')

@section('title', 'Hasil Perhitungan')
@section('header-title', 'Hasil Perhitungan')

@section('content')
    @foreach ($aspek as $row_aspek)
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><strong>{{ $row_aspek->aspek_penilaian }}</strong></h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="align-middle">Nama Penerima</th>
                                @foreach ($row_aspek->kriteria as $kriteria)
                                    <th class="text-center align-middle">{{ $kriteria->kriteria }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peserta as $row_peserta)
                                <tr>
                                    <td class="align-middle">{{ $row_peserta->nama }}</td>
                                    @foreach ($row_aspek->kriteria as $kriteria)
                                        <td class="text-center align-middle">
                                            @php
                                                $sample = $row_peserta->sample->firstWhere(function ($sample) use (
                                                    $kriteria,
                                                ) {
                                                    return $sample->faktorNilai &&
                                                        $sample->faktorNilai->kriteria->id == $kriteria->id;
                                                });
                                            @endphp
                                            @if ($sample && $sample->faktorNilai && $sample->faktorNilai->kriteria)
                                                {{ $sample->faktorNilai->nilai }}
                                            @else
                                                Tidak Ada Nilai
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="table-info">
                                <th class="align-middle">Nilai Ketetapan</th>
                                @foreach ($row_aspek->kriteria as $kriteria)
                                    @php
                                        $nilaiKriteria = $nilai->where('id', $kriteria->id_nilai)->first();
                                    @endphp
                                    <td class="text-center text-primary align-middle">
                                        <strong>{{ $nilaiKriteria ? $nilaiKriteria->nilai : '-' }}</strong>
                                    </td>
                                @endforeach
                            </tr>
                        </tfoot>
                    </table>
                    {{-- Table Nilai Ketatapan --}}
                    <div class="card-header bg-warning text-white">
                        <h5 class="mb-0"><strong>Hasil Ketatapan :</strong></h5>
                    </div>
                    <table class="table table-bordered table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="align-middle">Nama Penerima</th>
                                @foreach ($row_aspek->kriteria as $kriteria)
                                    <th class="text-center align-middle">{{ $kriteria->kriteria }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peserta as $row_peserta)
                                <tr>
                                    <td class="align-middle">{{ $row_peserta->nama }}</td>
                                    @foreach ($row_aspek->kriteria as $kriteria)
                                        <td class="text-center align-middle">
                                            @php
                                                // Cari sample yang sesuai dengan kriteria saat ini
                                                $sample = $row_peserta->sample->firstWhere(function ($sample) use (
                                                    $kriteria,
                                                ) {
                                                    return $sample->faktorNilai &&
                                                        $sample->faktorNilai->kriteria->id == $kriteria->id;
                                                });
                                            @endphp

                                            @if ($sample && $sample->faktorNilai && $sample->faktorNilai->kriteria)
                                                @php
                                                    // Mendapatkan nilai dari faktor nilai
                                                    $nilaiPeserta = $sample->faktorNilai->nilai;

                                                    // Cari nilai ketetapan yang sesuai dengan kriteria
                                                    $nilaiKriteria = $nilai->where('id', $kriteria->id_nilai)->first();
                                                    $nilaiKetetapan = $nilaiKriteria ? $nilaiKriteria->nilai : 0;

                                                    // Menghitung hasil pengurangan
                                                    $selisih = $nilaiPeserta - $nilaiKetetapan;
                                                @endphp
                                                {{ $selisih }}
                                            @else
                                                Tidak Ada Nilai
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0"><strong>Pembobotan Gap :</strong></h5>
                    </div>
                    <table class="table table-bordered table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="align-middle">Nama Penerima</th>
                                @foreach ($row_aspek->kriteria as $kriteria)
                                    <th class="text-center align-middle">{{ $kriteria->kriteria }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peserta as $row_peserta)
                                <tr>
                                    <td class="align-middle">{{ $row_peserta->nama }}</td>
                                    @foreach ($row_aspek->kriteria as $kriteria)
                                        <td class="text-center align-middle">
                                            @php
                                                // Cari sample yang sesuai dengan kriteria saat ini
                                                $sample = $row_peserta->sample->firstWhere(function ($sample) use (
                                                    $kriteria,
                                                ) {
                                                    return $sample->faktorNilai &&
                                                        $sample->faktorNilai->kriteria->id == $kriteria->id;
                                                });
                                            @endphp

                                            @if ($sample && $sample->faktorNilai && $sample->faktorNilai->kriteria)
                                                @php
                                                    // Mendapatkan nilai dari faktor nilai
                                                    $nilaiPeserta = $sample->faktorNilai->nilai;

                                                    // Cari nilai ketetapan yang sesuai dengan kriteria
                                                    $nilaiKriteria = $nilai->where('id', $kriteria->id_nilai)->first();
                                                    $nilaiKetetapan = $nilaiKriteria ? $nilaiKriteria->nilai : 0;

                                                    // Menghitung hasil pengurangan
                                                    $selisih = $nilaiPeserta - $nilaiKetetapan;

                                                    // Cari bobot yang sesuai dengan hasil selisih di tabel pm_bobot
                                                    $bobotRow = $bobot->firstWhere('selisih', $selisih);
                                                    $bobotNilai = $bobotRow ? $bobotRow->bobot : 'Tidak Ada Bobot';
                                                @endphp
                                                {{ $bobotNilai }}
                                            @else
                                                Tidak Ada Nilai
                                            @endif
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="card-header bg-danger text-white">
                        <h5 class="mb-0"><strong>Perhitungan Faktor :</strong></h5>
                    </div>
                    <table class="table table-bordered table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="align-middle">Nama Penerima</th>
                                @foreach ($row_aspek->kriteria as $kriteria)
                                    <th class="text-center align-middle">{{ $kriteria->kriteria }}</th>
                                @endforeach
                                <th class="text-center align-middle">NCF</th>
                                <th class="text-center align-middle">NSF</th>
                                <th class="text-center align-middle">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peserta as $row_peserta)
                                @php
                                    $totalBobotCore = 0; // Total bobot untuk type core
                                    $jumlahKriteriaCore = 0; // Jumlah kriteria dengan type core
                                    $totalBobotSecondary = 0; // Total bobot untuk type secondary
                                    $jumlahKriteriaSecondary = 0; // Jumlah kriteria dengan type secondary
                                    $coreFaktor = $row_aspek->core_faktor / 100; // Konversi core_faktor ke desimal
                                    $secondaryFaktor = $row_aspek->secondary_faktor / 100; // Konversi secondary_faktor ke desimal
                                @endphp
                                <tr>
                                    <td class="align-middle">{{ $row_peserta->nama }}</td>
                                    @foreach ($row_aspek->kriteria as $kriteria)
                                        <td class="text-center align-middle">
                                            @php
                                                $sample = $row_peserta->sample->firstWhere(function ($sample) use (
                                                    $kriteria,
                                                ) {
                                                    return $sample->faktorNilai &&
                                                        $sample->faktorNilai->kriteria->id == $kriteria->id;
                                                });

                                                $bobotNilai = 0;

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
                                            @endphp
                                            {{ $bobotNilai > 0 ? $bobotNilai : 'Tidak Ada Nilai' }}
                                        </td>
                                    @endforeach

                                    <!-- Kolom untuk rata-rata core -->
                                    <td class="text-center align-middle">
                                        {{ number_format($totalBobotCore, 2) }} /
                                        {{ $jumlahKriteriaCore }} =
                                        @php
                                            $rataRataCore =
                                                $jumlahKriteriaCore > 0 ? $totalBobotCore / $jumlahKriteriaCore : 0;
                                        @endphp
                                        <strong>{{ number_format($rataRataCore, 2) }}</strong>
                                    </td>

                                    <!-- Kolom untuk rata-rata secondary -->
                                    <td class="text-center align-middle">
                                        {{ number_format($totalBobotSecondary, 2) }} /
                                        {{ $jumlahKriteriaSecondary }} =
                                        @php
                                            $rataRataSecondary =
                                                $jumlahKriteriaSecondary > 0
                                                    ? $totalBobotSecondary / $jumlahKriteriaSecondary
                                                    : 0;
                                        @endphp
                                        <strong>{{ number_format($rataRataSecondary, 2) }}</strong>
                                    </td>

                                    <!-- Kolom untuk total nilai -->
                                    <td class="text-center align-middle">
                                        @php
                                            $totalNilai =
                                                $coreFaktor * $rataRataCore + $secondaryFaktor * $rataRataSecondary;
                                        @endphp
                                        <strong>{{ number_format($totalNilai, 2) }}</strong>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="table-info">
                                <th class="align-middle">Type Kriteria</th>
                                @foreach ($row_aspek->kriteria as $kriteria)
                                    <td class="text-center text-primary align-middle">
                                        <strong>{{ $kriteria->type }}</strong>
                                    </td>
                                @endforeach
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    @endforeach
    <div class="row">
        <!-- Tabel Laki-laki -->
        <div class="col-md-6">
            <div class="card mb-4 shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><strong>Peringkat Laki-laki</strong></h5>
                        </div>
                        <table class="table table-bordered table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="align-middle">Peringkat</th>
                                    <th class="align-middle">Nama Penerima</th>
                                    <th class="align-middle">Jenis Kelamin</th>
                                    <th class="align-middle text-center">Total Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hasilTotalLaki as $data)
                                    <tr>
                                        <td class="text-center">{{ $data['peringkat'] }}</td>
                                        <td>{{ $data['peserta']->nama }}</td>
                                        <td>{{ $data['peserta']->jenis_kelamin }}</td>
                                        <td class="text-center">{{ number_format($data['total_nilai'], 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Perempuan -->
        <div class="col-md-6">
            <div class="card mb-4 shadow-sm">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <div class="card-header bg-danger text-white">
                            <h5 class="mb-0"><strong>Peringkat Perempuan</strong></h5>
                        </div>
                        <table class="table table-bordered table-hover mb-0">
                            <thead>
                                <tr>
                                    <th class="align-middle">Peringkat</th>
                                    <th class="align-middle">Nama Penerima</th>
                                    <th class="align-middle">Jenis Kelamin</th>
                                    <th class="align-middle text-center">Total Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hasilTotalPerempuan as $data)
                                    <tr>
                                        <td class="text-center">{{ $data['peringkat'] }}</td>
                                        <td>{{ $data['peserta']->nama }}</td>
                                        <td>{{ $data['peserta']->jenis_kelamin }}</td>
                                        <td class="text-center">{{ number_format($data['total_nilai'], 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
