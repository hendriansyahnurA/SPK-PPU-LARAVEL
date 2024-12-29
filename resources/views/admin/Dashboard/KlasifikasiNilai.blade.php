@extends('layouts.app')

@section('title', 'Klasifikasi Nilai')
@section('header-title', 'Klasifikasi Nilai')

@section('content')
    <form class="form-kecerdasan" method="post" action="{{ route('admin.klasifikasi.store') }}" role="form">
        @csrf
        <div class="shadow-sm">
            <div class="card-header">
                <div class="col-6">
                    <select class="custom-select d-block w-50" id="aspek" name="id_aspek" required>
                        <option value="">Pilih Aspek...</option>
                        @foreach ($aspek as $row)
                            <option value="{{ $row->id }}">{{ $row->aspek_penilaian }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div>
                <div class="container">
                    @foreach ($aspek as $row_aspek)
                        <div id="spninactive_{{ $row_aspek->id }}" style="display:none;">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Penerima</th>
                                        @foreach ($row_aspek->kriteria as $kriteria)
                                            <th>{{ $kriteria->kriteria }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($peserta as $row)
                                        <tr>
                                            <td>{{ $row->nama }}</td>
                                            @foreach ($row_aspek->kriteria as $kriteria)
                                                <td>
                                                    <input type="hidden" name="id_alternatif[]"
                                                        value="{{ $row->id }}">

                                                    <select class="custom-select d-block w-100" name="id_faktor_nilai[]">
                                                        <option value="0">Pilih Salah Satu</option>
                                                        @foreach ($kriteria->pm_kriteria_nilai as $nilaiItem)
                                                            <option value="{{ $nilaiItem->id }}"
                                                                {{ old('id_faktor_nilai.' . $loop->index) == $nilaiItem->id ? 'selected' : '' }}>
                                                                {{ $nilaiItem->nilai }} - {{ $nilaiItem->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <button class="btn btn-success mb-5" type="submit">Simpan</button>
    </form>

    @foreach ($table_aspek as $row_aspek)
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
                </div>
            </div>
        </div>
    @endforeach

    <!-- Tambahkan Navigasi Pagination -->
    <div class="d-flex justify-content-center">
        {{ $table_aspek->links('pagination::bootstrap-4') }}
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const aspekSelect = document.getElementById('aspek');
            const aspekDivs = document.querySelectorAll('.container div');

            // Menampilkan div untuk aspek yang dipilih saat halaman dimuat
            const selectedValue = aspekSelect.value;
            if (selectedValue) {
                document.getElementById('spninactive_' + selectedValue).style.display = 'block';
            }

            aspekSelect.addEventListener('change', function() {
                const selectedValue = this.value;
                aspekDivs.forEach(function(div) {
                    div.style.display = 'none'; // Sembunyikan semua div
                });

                // Tampilkan div untuk aspek yang dipilih
                if (selectedValue) {
                    document.getElementById('spninactive_' + selectedValue).style.display = 'block';
                }
            });
        });
    </script>

@endsection
