<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-4">
        <div class="card bg-primary shadow-lg">
            <div class="card-body">
                @if (Auth::check())
                    <h1 class="mr-2 d-none d-lg-inline text-white  font-weight-bold">{{ Auth::user()->name }}</h1>
                @endif

                <hr class="bg-white">
                {{-- <h1 class="text-white">Hallo Word</h1> --}}
                <p class="text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem consequatur accusantium
                    eaque laboriosam
                    quam enim quae cupiditate adipisci corrupti nobis debitis molestiae incidunt dolorem, magnam fuga ea
                    libero obcaecati quia.</p>
            </div>
        </div>
    </div>
    @include('components.Dashboard.cardHeader')
@endsection
