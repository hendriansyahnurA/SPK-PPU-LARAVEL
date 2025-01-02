<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Data Alternatif')
@section('header-title', 'Data Alternatif')

@section('content')
    <div class="card shadow mb-4">
        <!-- Button trigger modal -->
        <div class="card-header py-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tambah Data
            </button>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.alternatif') }}" class="mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Cari berdasarkan nama atau NIM"
                        value="{{ request()->input('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                @if ($peserta->isNotEmpty())
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>NIM</th>
                                <th>Prodi</th>
                                <th>Semester</th>
                                <th>IPK</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($peserta as $p)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $p->nama }}</td>
                                    <td>{{ $p->jenis_kelamin }}</td>
                                    <td>{{ $p->nim }}</td>
                                    <td>{{ $p->prodi }}</td>
                                    <td>{{ $p->semester }}</td>
                                    <td>{{ $p->ipk }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-circle btn-warning" data-toggle="modal"
                                            data-target="#exampleEdit{{ $p->id }}">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <button type="button" class="btn btn-circle btn-danger" data-toggle="modal"
                                            data-target="#exampleDelete{{ $p->id }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center">
                        {{ $peserta->links('vendor.pagination.bootstrap-4') }}
                        <!-- Gunakan bootstrap-4 untuk pagination -->
                    </div>
                @else
                    <p>Tidak Ada Data Peserta</p>
                @endif
            </div>
        </div>
        @include('components.modal-alternatif.createAlternatif')
        @include('components.modal-alternatif.editAlternatif')
        @include('components.modal-alternatif.deleteAlternatif')
        @push('scripts')
            @include('components.Sweetalert-loader.exampleModal')
        @endpush
    </div>
@endsection
