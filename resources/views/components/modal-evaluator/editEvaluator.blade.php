@foreach ($users as $p)
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
                <form action="{{ route('admin.evaluator.update', ['id' => $p->id]) }}" method="POST"
                    class="modal-body">
                    @csrf
                    <input type="hidden" name="_method" value="PUT"> <!-- Jika Anda menggunakan metode PUT -->
                    <input type="hidden" name="id" value="{{ $p->id }}"> <!-- ID peserta untuk update -->
                    <div class="form-group">
                        <label for="exampleInputNama">Nama</label>
                        <input type="text" class="form-control form-control-user"
                            id="exampleInputNama{{ $p->id }}" name="name" value="{{ $p->name }}"
                            placeholder="Nama Lengkap">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername">Username</label>
                        <input type="text" class="form-control form-control-user" name="username"
                            id="exampleInputUsername{{ $p->id }}" placeholder="Masukkan Username"
                            value="{{ $p->username }}" required>
                        @error('username')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword">Password</label>
                        <input type="password" class="form-control form-control-user" name="password"
                            id="exampleInputPassword{{ $p->id }}" placeholder="Masukkan Password">
                        @error('password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleRole">Role</label>
                        <select name="role" id="exampleRole{{ $p->id }}"
                            class="form-control form-control-user" required>
                            <!-- Menampilkan role saat ini (yang dari database) sebagai pilihan default -->
                            <option value="admin" {{ $p->role === 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="evaluator" {{ $p->role === 'evaluator' ? 'selected' : '' }}>Evaluator
                            </option>
                        </select>
                        @error('role')
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
