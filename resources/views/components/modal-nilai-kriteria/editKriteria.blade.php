@foreach ($nilai_kriteria as $p)
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
                <form action="{{ route('admin.subNilai.update', ['id' => $p->id]) }}" method="POST" class="modal-body">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" name="id" value="{{ $p->id }}">
                    <input type="hidden" name="id_kriteria" value="{{ $p->id_kriteria }}">
                    <div class="mb-3">
                        <label for="id_kriteria" class="form-label">Pilih Kriteria</label>
                        <select class="form-control form-control-user" id="id_kriteria" name="id_kriteria" required>
                            <option value="" selected disabled>
                                {{ $p->kriteria->kriteria ?? '-' }}</option>
                            @foreach ($kriteria as $item)
                                <option value="{{ $item->id }}">{{ $item->kriteria }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pilih-nilai">Pilih Nilai</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="check_all">
                            <label class="form-check-label" for="check_all">Pilih Semua</label>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-check">
                                    <input class="form-check-input item-checkbox" type="checkbox" name="nilai[]"
                                        value="{{ $p->id }}" id="checkbox_{{ $p->id }}"
                                        @if (in_array($p->id, $p->selected_nilai ?? [])) checked @endif>
                                    <input type="hidden" name="nama[]" value="{{ $p->nama }}">
                                    <label class="form-check-label" for="checkbox_{{ $p->id }}">
                                        {{ $p->nilai }} - {{ $p->nama }}
                                    </label>
                                </div>
                            </div>
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
@endforeach

<script>
    document.getElementById('check_all').addEventListener('click', function() {
        const isChecked = this.checked;
        document.querySelectorAll('.item-checkbox').forEach(function(checkbox) {
            checkbox.checked = isChecked;
        });
    });
</script>
