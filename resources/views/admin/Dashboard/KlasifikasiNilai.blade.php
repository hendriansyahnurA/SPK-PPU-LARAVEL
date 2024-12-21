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
                                                        @foreach ($nilai as $nilaiItem)
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
