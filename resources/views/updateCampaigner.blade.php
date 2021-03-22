@extends('layout.app')

@section('content')
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

    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="profile_picture">Foto KTP</label>
            <input type="file" class="form-control" name="profile_picture" id="profile_picture">
        </div>

        <div class="form-group mt-2">
            <label for="alamat">NIK</label>
            <input type="text" class="form-control" id="alamat" name="address">
        </div>

        <div class="form-group">
            <label for="alamat">Nomor Rekening</label>
            <input type="text" class="form-control" id="alamat" name="address">
        </div>

        <button type="submit" class="btn btn-primary mt-5">Simpan</button>
        <a type="button" class="btn btn-light mt-5">Batal</a>
    </form>
</div>
@endsection