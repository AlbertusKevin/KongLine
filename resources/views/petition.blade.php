@extends('layout.app')

@section('content')

<div class="container">
    <h2 class="mt-3">Daftar Petisi</h2>
    <hr>
    <p>Lihat Petisi yang Sedang Berlangsung</p>
    <div class="text-center mt-5">
        <button type="button" class="btn btn-primary rounded-pill">Berlangsung</button>
        <button type="button" class="btn btn-light rounded-pill ml-3">Telah Menang</button>
        <button type="button" class="btn btn-light rounded-pill ml-3">Ikut Serta</button>
    </div>
</div>

@endsection