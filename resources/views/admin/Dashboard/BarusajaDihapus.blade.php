@extends('layouts.app')

@section('title', 'Baru Saja Dihapus')
@section('header-title', 'Baru Saja Dihapus')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Data</th>
                            <th>Data</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($deletedItems as $item)
                            <tr>
                                <td>
                                    {{ $item->aspek_penilaian }}
                                    {{ $item->nama }}
                                    {{ $item->kriteria }}
                                </td>
                                <td>{{ $item->type }}</td>
                                <td class="text-center">
                                    {{-- <a href="{{ route('admin . kembalikan', $item->id) }}" class="btn btn-success btn-circle">
                                    </a> --}}
                                    <a href="{{ route('admin.kembalikan', $item->id) }}" class="btn btn-success btn-circle"
                                        onclick="confirmRestore(event, '{{ route('admin.kembalikan', $item->id) }}')">
                                        <i class="fa-solid fa-recycle"></i>
                                    </a>
                                    <a href="{{ route('admin.hapusPermanen', $item->id) }}" class="btn btn-danger btn-circle"
                                        onclick="confirmPermanen(event, '{{ route('admin.hapusPermanen', $item->id) }}')">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
<script>
    function confirmRestore(event, url) {
        event.preventDefault(); // Mencegah navigasi default

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Item akan dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, kembalikan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna mengonfirmasi, arahkan ke URL
                window.location.href = url;
            }
        });
    }

    function confirmPermanen(event, url) {
        event.preventDefault(); // Mencegah navigasi langsung

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus permanen!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                // Jika pengguna mengonfirmasi, arahkan ke URL
                window.location.href = url;
            }
        });
    }
</script>
