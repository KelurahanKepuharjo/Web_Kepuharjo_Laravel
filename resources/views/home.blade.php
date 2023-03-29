@extends('layouts.mainlayout')
@section('title', 'Home')
<!-- partial -->
@section('content')
    <div class="main-panel">
        <h4 class="font-weight-bold text-dark">Master Rt Rw</h4>
        <h5>Halo {{ $name }} dengan role {{ $role }}</h5>
        @if ($role == 'Admin')
            <a href="http://">Halaman Admin</a>
        @elseif ($role == 'user')
            <a href="http://">Halaman User</a>
        @else
            <a href="http://">Halaman Whatever</a>
        @endif
    </div>
@endsection


<!-- main-panel ends -->
