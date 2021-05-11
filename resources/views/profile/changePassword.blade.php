@extends('layout.app')

@section('content')
    @include('layout.message')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-0 ml-3"><img src="/img/changePassword.png" alt="change password"></div>
            <div class="col-md ml-3">
                <h3>Ubah Sandi</h3>
            </div>
        </div>

        <div class="row">
            <p class="ml-3">Sandi yang kuat memuat kombinasi nomor, huruf dan simbol</i></p>
        </div>

        <form action="" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mt-2">
                <label for="old_password">Sandi saat ini</label>
                <input type="password" class="form-control" id="old_password" name="old_password">
            </div>

            <div class="form-group mt-2">
                <label for="new_password">Sandi Baru</label>
                <input type="password" class="form-control" id="new_password" name="new_password">
            </div>

            <div class="form-group">
                <label for="verification">Verifikasi sandi baru</label>
                <input type="password" class="form-control" id="verification" name="verification">
            </div>

            <button type="submit" class="btn btn-primary mt-5">Save</button>
            <a type="button" class="btn btn-light mt-5">Batal</a>
        </form>
    </div>
@endsection
