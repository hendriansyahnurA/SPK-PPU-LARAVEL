<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data Alternatif</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.store') }}" method="POST" class="modal-body">
                <div>
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputNama">Nama</label>
                        <input type="text" class="form-control form-control-user" id="exampleInputNama"
                            name="nama" placeholder="Nama Lengkap">
                        @error('username')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputNim">Nim</label>
                        <input type="number" class="form-control form-control-user" name="nim" id="exampleInputNim"
                            placeholder="Nim">
                        @error('nim')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputProdi">Prodi</label>
                        <input type="text" class="form-control form-control-user" name="prodi"
                            id="exampleInputProdi" placeholder="Prodi">
                        @error('prodi')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputSemester">Semester</label>
                        <input type="number" class="form-control form-control-user" name="semester"
                            id="exampleInputSemester" placeholder="Semester">
                        @error('semester')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputIpk">Ipk</label>
                        <input type="text" class="form-control form-control-user" name="ipk" id="exampleInputIpk"
                            placeholder="Masukkan IPK (gunakan koma, contoh: 3,5)">
                        @error('ipk')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
