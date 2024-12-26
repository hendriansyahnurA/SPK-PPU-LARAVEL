@foreach ($kriteria as $p)
    <div class="modal fade" id="editModal{{ $p->id }}" tabindex="-1"
        aria-labelledby="editModalLabel{{ $p->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel{{ $p->id }}">Edit Data Kriteria</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Form for Edit -->
                    <form action="{{ route('admin.kriteria.update', $p->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="id_aspek" class="form-label">Pilih Aspek Penilaian</label>
                            <select class="form-control form-control-user" name="id_aspek" required>
                                <option value="" disabled>Pilih Aspek Penilaian</option>
                                @foreach ($aspek as $as)
                                    <option value="{{ $as->id }}" {{ $as->id == $p->id_aspek ? 'selected' : '' }}>
                                        {{ $as->aspek_penilaian }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputKriteria">Kriteria</label>
                            <input type="text" class="form-control" name="kriteria" value="{{ $p->kriteria }}"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="id_nilai" class="form-label">Nama Target</label>
                            <select class="form-control" name="id_nilai" required>
                                <option value="" disabled>Pilih Nama Target</option>
                                @foreach ($label_nilai as $nilai)
                                    <option value="{{ $nilai->id }}"
                                        {{ $nilai->id == $p->id_nilai ? 'selected' : '' }}>
                                        {{ $nilai->nilai }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputType">Type</label>
                            <select class="form-control" name="type" required>
                                <option value="core" {{ $p->type == 'core' ? 'selected' : '' }}>Core</option>
                                <option value="secondary" {{ $p->type == 'secondary' ? 'selected' : '' }}>Secondary
                                </option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
