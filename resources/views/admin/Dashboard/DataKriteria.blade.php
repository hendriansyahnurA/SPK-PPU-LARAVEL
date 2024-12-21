<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Data Kriteria')
@section('header-title', 'Data Kriteria')

@section('content')
    <div class="card shadow mb-4">
        <!-- Button trigger modal -->
        <div class="card-header py-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tambah Kriteria
            </button>
            {{-- <button type="button" class="btn btn-warning " data-toggle="modal" data-target="#exampleNilai">
                Tambah Penilaian
            </button> --}}
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.aspek') }}" class="mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Cari berdasarkan nama"
                        value="{{ request()->input('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                <div id="loading" style="display: none;">
                    <p>Loading data...</p>
                </div>
                <div id="data-table">
                    @if ($kriteria->isNotEmpty())
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Aspek Penilaian</th>
                                    <th>Kriteria</th>
                                    <th>Target</th>
                                    <th>Type</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kriteria as $p)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $p->aspek->aspek_penilaian }}</td>
                                        <td>{{ $p->kriteria }}</td>
                                        <td>{{ $p->nilai->nilai }}</td>
                                        <td>{{ $p->type }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-warning btn-circle" data-toggle="modal"
                                                data-target="#editModal{{ $p->id }}">
                                                <i class="fa-solid fa-pen"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-circle" data-toggle="modal"
                                                data-target="#exampleDelete{{ $p->id }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @include('components.modal-kriteria.editKriteria')
                                    @include('components.modal-kriteria.deleteKriteria')
                                @endforeach
                            </tbody>
                        </table>
                        <!-- Pagination -->
                        <div class="d-flex justify-content-center">
                            {{ $aspek->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    @else
                        {{-- <p id="no-data">Tidak Ada Data Evaluator</p> --}}
                    @endif
                </div>
            </div>

            @include('components.modal-kriteria.createKriteria')


        </div>
        @push('scripts')
            @include('components.Sweetalert-loader.exampleModal')
            @include('components.Sweetalert-loader.loaderTable')
        @endpush
    </div>
@endsection
