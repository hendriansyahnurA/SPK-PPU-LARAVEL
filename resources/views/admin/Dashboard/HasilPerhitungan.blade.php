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
                        <h5 class="mb-0"><strong>Hasil Ketatapan:</strong></h5>
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
                </div>
            </div>
        </div>
    @endforeach

    <!-- Tambahkan Navigasi Pagination -->
    <div class="d-flex justify-content-center">
        {{ $aspek->links('pagination::bootstrap-4') }}
    </div>

@endsection
