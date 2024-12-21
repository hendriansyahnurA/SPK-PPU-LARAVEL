<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Data Evaluator')
@section('header-title', 'Data Evaluator')

@section('content')
    <div class="card shadow mb-4">
        <!-- Button trigger modal -->
        <div class="card-header py-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Tambah Data
            </button>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.evaluator') }}" class="mb-3">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Cari berdasarkan nama"
                        value="{{ request()->input('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </div>
            </form>

            <div class="table-responsive">
                @if ($users->isNotEmpty())
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th hidden>Password</th>
                                <th>Role</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $p)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ $p->username }}</td>
                                    <td hidden>{{ $p->password }}</td>
                                    <td>{{ $p->role }}</td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-warning btn-circle" data-toggle="modal"
                                            data-target="#exampleEdit{{ $p->id }}">
                                            <i class="fa-solid fa-pen"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-circle" data-toggle="modal"
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
                        {{ $users->links('vendor.pagination.bootstrap-4') }}
                    </div>
                @else
                    <p>Tidak Ada Data Evaluator</p>
                @endif
            </div>
        </div>
        @include('components.modal-evaluator.createEvaluator')
        @include('components.modal-evaluator.editEvaluator')
        @include('components.modal-evaluator.deleteEvaluator')
        @push('scripts')
            @include('components.Sweetalert-loader.exampleModal')
        @endpush
    </div>
@endsection
