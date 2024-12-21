<div class="modal fade" id="exampleNilai" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Nilai Kriteria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.kriteria.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="id_kriteria" class="form-label">Pilih Kriteria</label>
                        <select class="form-control form-control-user" id="id_kriteria" name="id_kriteria" required>
                            <option value="" selected disabled>Pilih Kriteria</option>
                            @foreach ($kriteria as $item)
                                <option value="{{ $item->id }}">{{ $item->kriteria }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputNama">Nama</label>
                        <input type="text" class="form-control form-control-user" name="nama"
                            id="exampleInputNama" placeholder="Masukkan Nama" required>
                        @error('nama')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputNilai">Nilai</label>
                        <select class="form-control form-control-user" name="nilai" id="exampleInputNilai"
                            placeholder="Masukkan Core & Secondary" required>
                            <option value="" selected disabled>Pilih Nilai</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            @error('nilai')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>
