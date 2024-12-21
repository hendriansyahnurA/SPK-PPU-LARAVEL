@foreach ($peserta as $p)
    <div class="modal fade" id="exampleDelete{{ $p->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Data Alternatif</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.destroy', ['id' => $p->id]) }}" method="POST" class="modal-body">
                    @csrf
                    @method('DELETE') <!-- Gunakan method DELETE untuk penghapusan -->
                    <div class="form-group">
                        <p class="font-bold">Anda Yakin Menghapus Data Ini ?</p>
                        <label for="exampleInputNama{{ $p->id }}" hidden>Nama</label>
                        <input type="text" class="form-control form-control-user"
                            id="exampleInputNama{{ $p->id }}" name="nama" value="{{ $p->nama }}"
                            placeholder="Nama Lengkap" disabled>
                        @error('nama')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
