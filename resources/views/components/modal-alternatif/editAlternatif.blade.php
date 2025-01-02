@foreach ($peserta as $p)
    <div class="modal fade" id="exampleEdit{{ $p->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Data Alternatif</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.update', ['id' => $p->id]) }}" method="POST" class="modal-body">
                    @csrf
                    <input type="hidden" name="_method" value="PUT"> <!-- Jika Anda menggunakan metode PUT -->
                    <input type="hidden" name="id" value="{{ $p->id }}"> <!-- ID peserta untuk update -->
                    <div class="form-group">
                        <label for="exampleInputNama{{ $p->id }}">Nama</label>
                        <input type="text" class="form-control form-control-user"
                            id="exampleInputNama{{ $p->id }}" name="nama" value="{{ $p->nama }}"
                            placeholder="Nama Lengkap">
                        @error('nama')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputJeniskelamin{{ $p->id }}">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control form-control-user"
                            id="exampleInputJeniskelamin{{ $p->id }}">
                            <option value="" disabled selected>Jenis Kelamin</option>
                            <option value="laki-laki{{ $p->jenis_kelamin }}">Laki-Laki</option>
                            <option value="Perempuan{{ $p->jenis_kelamin }}">Perempuan</option>
                        </select>
                        @error('username')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputNim{{ $p->id }}">Nim</label>
                        <input type="number" class="form-control form-control-user" name="nim"
                            id="exampleInputNim{{ $p->id }}" value="{{ $p->nim }}" placeholder="Nim">
                        @error('nim')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputProdi{{ $p->id }}">Prodi</label>
                        <input type="text" class="form-control form-control-user" name="prodi"
                            id="exampleInputProdi{{ $p->id }}" value="{{ $p->prodi }}" placeholder="Prodi">
                        @error('prodi')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputSemester{{ $p->id }}">Semester</label>
                        <input type="number" class="form-control form-control-user" name="semester"
                            id="exampleInputSemester{{ $p->id }}" value="{{ $p->semester }}"
                            placeholder="Semester">
                        @error('semester')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputIpk{{ $p->id }}">Ipk</label>
                        <input type="text" class="form-control form-control-user" name="ipk"
                            id="exampleInputIpk{{ $p->id }}" value="{{ $p->ipk }}"
                            placeholder="Masukkan IPK (gunakan koma, contoh: 3,5)">
                        @error('ipk')
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
