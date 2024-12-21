@foreach ($kriteria as $p)
    <div class="modal fade" id="exampleEdit{{ $p->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Aspek</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.kriteria.update', ['id' => $p->id]) }}" method="POST" class="modal-body">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="id" value="{{ $p->id }}">
                    <div class="form-group">
                        <label for="exampleInputAspek">Aspek Penilaian</label>
                        <input type="text" class="form-control form-control-user"
                            id="exampleInputAspek{{ $p->id }}" name="aspek_penilaian"
                            value="{{ $p->aspek_penilaian }}" placeholder="Aspek Lengkap">
                        @error('aspek_penilaian')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPresentase">Presentase</label>
                        <input type="number" class="form-control form-control-user" name="presentase"
                            id="exampleInputPresentase{{ $p->id }}" placeholder="Masukkan Presentase"
                            value="{{ $p->presentase }}" required>
                        @error('presentase')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputCore">Core Faktor</label>
                        <input type="number" class="form-control form-control-user" name="core_faktor"
                            id="exampleInputCore{{ $p->id }}" placeholder="Masukkan Core faktor"
                            value="{{ $p->core_faktor }}">
                        @error('core_faktor')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputSecondary">Secondary Faktor</label>
                        <input type="number" class="form-control form-control-user" name="secondary_faktor"
                            id="exampleInputSecondary{{ $p->id }}" placeholder="Masukkan Secondary faktor"
                            value="{{ $p->secondary_faktor }}">
                        @error('secondary_faktor')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
