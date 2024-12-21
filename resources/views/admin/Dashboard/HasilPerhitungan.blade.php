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
                        <thead class="table-light">
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
                                    @foreach ($row_peserta->sample as $sample)
                                        @php
                                            $nilaiSample = $nilai->where('id', $sample->id_faktor_nilai)->first();
                                        @endphp
                                        <td class="text-center align-middle">
                                            {{ $nilaiSample ? $nilaiSample->nilai : '-' }}
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
                </div>
            </div>
        </div>
    @endforeach

@endsection
