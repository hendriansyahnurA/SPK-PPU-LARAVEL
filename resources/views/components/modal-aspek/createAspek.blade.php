<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Aspek</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.aspek.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputAspek">Aspek Penilaian</label>
                        <input type="text" class="form-control form-control-user" id="exampleInputAspek"
                            name="aspek_penilaian" placeholder="Aspek Penilaian" required>
                        @error('asepek_penilaian')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPresentase">Presentase</label>
                        <input type="number" class="form-control form-control-user" name="presentase"
                            id="exampleInputPresentase" placeholder="Masukkan Presentase" required>
                        @error('presentase')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputCoreFaktor">Core Faktor</label>
                        <input type="number" class="form-control form-control-user" name="core_faktor"
                            id="exampleInputCoreFaktor" placeholder="Masukkan Core Faktor" required>
                        @error('core_faktor')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleInputSecondaryFaktor">Secondary Faktor</label>
                        <input type="number" class="form-control form-control-user" name="secondary_faktor"
                            id="exampleInputSecondaryFaktor" placeholder="Masukkan Secondary Faktor" required>
                        @error('core_faktor')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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
