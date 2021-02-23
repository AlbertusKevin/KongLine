@extends('layout.app')

@section('content')
    <div class="jumbotron text-center">
        <img src="/img/profilePicture.png" alt="cover" class="profile-picture">
        <h3 class="display-4">Ruben Calzoni</h3>
        <p class="lead">Pengguna sejak 5 Feb 2021</p>
        <p class="mt-5">Terima kasih telah menjadi anggota aktif dari komunitas kami. </p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-0 ml-3"><img src="/img/profile2.png" alt="profile 2"></div>
            <div class="col-md ml-3"><h3>Profile dan Preferensi</h3></div>
        </div>
        <div class="row">
            <p class="ml-3">Atur akses akun dan kelola data yang kami gunakan untuk mempersonalisasi pengalamanmu.</p>
        </div>
        <div class="row">
            <div class="card w-100">
                <div class="card-body">
                    <p class="card-text">Ubah Sandi</p>
                </div>
            </div>
            <div class="card w-100 mt-2">
                <div class="card-body">
                    <p class="card-text">Upgrade to Campaigner</p>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-0 ml-3"><img src="/img/edit.png" alt="profile 2"></div>
            <div class="col-md ml-3"><h3>Edit Profile</h3></div>
        </div>
        <div class="row">
            <p class="ml-3">Atur akses akun dan kelola data yang kami gunakan untuk mempersonalisasi pengalamanmu.</p>
        </div>

        <form>
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="form-group form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection