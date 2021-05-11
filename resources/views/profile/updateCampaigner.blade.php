@extends('layout.app')

@section('content')
    @include('layout.message')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-0 ml-3"><img src="/img/campaignerProfile.png" alt="profile 2"></div>
            <div class="col-md ml-3">
                <h3>Data Campaigner</h3>
            </div>
        </div>

        <div class="row">
            <p class="ml-3">Atur dan input data diri lebih lanjut untuk menjadi <i>campaigner</i></p>
        </div>

        <form action="/profile/campaigner" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="KTP_picture">Foto KTP</label>
                <input type="file" class="form-control" name="KTP_picture" id="KTP_picture">
            </div>

            <div class="form-group mt-2">
                <label for="nik">NIK</label>
                <input type="text" class="form-control" id="nik" name="nik">
            </div>

            <div class="form-group">
                <label for="rekening">Nomor Rekening</label>
                <input type="text" class="form-control" id="rekening" name="rekening">
            </div>

            <button type="submit" class="btn btn-primary mt-5">Simpan</button>
            <a type="button" href="{{ url('/profile') }}" class="btn btn-light mt-5">Batal</a>
        </form>
    </div>
@endsection
