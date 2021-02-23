@extends('layout.app')

@section('content')
    <div class="container">
        <h2 class="mt-3" style="color: #1167B1">Lorem ipsum dolor sit amet</h2>
        <div class="text-center mt-5">
            <button type="button" class="btn btn-primary rounded-pill">Berlangsung</button>
            <button type="button" class="btn btn-light rounded-pill ml-3">Telah Menang</button>
            <button type="button" class="btn btn-light rounded-pill ml-3">Ikut Serta</button>
        </div>
        <div class="row">
            <div class="col-8">
                <hr>
                <img src="/img/detailPetisi.png" alt="detail petisi">
            </div>
            <div class="col-4">col-4</div>
          </div>
    </div>
@endsection