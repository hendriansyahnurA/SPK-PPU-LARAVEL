<div class="modal fade" id="exampleNilai" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pemberian Nilai Kriteria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.subNilai.store') }}" method="POST">
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
                    <label class="form-label">Pilih Nilai</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="check_all">
                        <label class="form-check-label" for="check_all">
                            Pilih Semua
                        </label>
                    </div>
                    <div class="row">
                        @foreach ($label_nilai as $index => $nilai)
                            <div class="col-md-8 ">
                                <div class="form-check">
                                    <input class="form-check-input item-checkbox" type="checkbox" name="nilai[]"
                                        value="{{ $nilai->id }}" id="checkbox_{{ $nilai->id }}">
                                    <input type="hidden" name="nama[]" value="{{ $nilai->nama }}">
                                    <label class="form-check-label" for="checkbox_{{ $nilai->id }}">
                                        {{ $nilai->nilai }} - {{ $nilai->nama }}
                                    </label>
                                </div>
                            </div>
                    </div>
                    <div class="row">
                        @endforeach
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
<script>
    document.getElementById('check_all').addEventListener('click', function() {
        const isChecked = this.checked;
        document.querySelectorAll('.item-checkbox').forEach(function(checkbox) {
            checkbox.checked = isChecked;
        });
    });
</script>
