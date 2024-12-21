<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Kriteria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.kriteria.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="id_aspek" class="form-label">Pilih Aspek Penilaian</label>
                        <select class="form-control form-control-user" id="id_aspek" name="id_aspek" required>
                            <option value="" selected disabled>Pilih Aspek Penilaian</option>
                            @foreach ($aspek as $item)
                                <option value="{{ $item->id }}">{{ $item->aspek_penilaian }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputKriteria">Kriteria</label>
                        <input type="text" class="form-control form-control-user" name="kriteria"
                            id="exampleInputKriteria" placeholder="Masukkan Kriteria" required>
                        @error('Kriteria')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="id_nilai" class="form-label">Nama Target</label>
                        <select class="form-control form-control-user" id="id_nilai" name="id_nilai" required>
                            <option value="" selected disabled>Pilih Nama Target</option>
                            @foreach ($nilai_kriteria as $item)
                                <option value="{{ $item->id }}">{{ $item->nilai }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputType">Type</label>
                        <select class="form-control form-control-user" name="type" id="exampleInputType"
                            placeholder="Masukkan Core & Secondary" required>
                            <option value="" selected disabled>Pilih Type Nilai</option>
                            <option value="core">Core</option>
                            <option value="secondary">Secondary</option>
                            @error('type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
