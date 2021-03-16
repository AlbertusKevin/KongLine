@extends('layout.app')

@section('content')
    <div class="jumbotron text-center" style="background-image: url('/{{ $participant->backgroundPicture }}');">
        <img src="/{{ $participant->photoProfile }}" alt="profile" class="profile-picture rounded-circle">
        <h3 class="display-4">{{ $participant->name }}</h3>
        <p class="lead">Pengguna sejak 5 Feb 2021</p>
        <a href="{{ $participant->linkProfile }}" target="_blank" class="lead">{{ $participant->linkProfile }}</a>
        <p class="mt-5">Terima kasih telah menjadi anggota aktif dari komunitas kami. </p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-0 ml-3"><img src="/img/profile2.png" alt="profile 2"></div>
            <div class="col-md ml-3">
                <h3>Profile dan Preferensi</h3>
            </div>
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
            <div class="col-md ml-3">
                <h3>Edit Profile</h3>
            </div>
        </div>
        <div class="row">
            <p class="ml-3">Atur akses akun dan kelola data yang kami gunakan untuk mempersonalisasi pengalamanmu.</p>
        </div>

        <form action="/profile/{{ $participant->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $participant->name }}">
            </div>
            <div class="form-group">
                <label for="about">Tentang Saya</label>
                <textarea class="form-control" id="about" rows="3" name="aboutMe"
                    value="{{ $participant->aboutMe }}"></textarea>
            </div>
            <div class="form-group">
                <label for="kota">Kota</label>
                <input type="text" class="form-control" id="kota" name="city" value="{{ $participant->city }}">
            </div>
            <div class="form-group">
                <label for="negara">Negara</label>
                <select id="negara" name="negara" class="form-control">
                    <option value="Indonesia">Indonesia</option>
                    <option value="Singapura">Singapura</option>
                    <option value="Malaysia">Malaysia</option>
                </select>
            </div>
            <div class="form-group">
                <label for="link">Tautan Singkat Profile</label>
                <input type="text" class="form-control" id="link" name="linkProfile"
                    value="{{ $participant->linkProfile }}">
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="address" value="{{ $participant->address }}">
            </div>

            <div class="form-row">
                <div class="col">
                    <label for="postcode">Kode Pos</label>
                    <input type="text" class="form-control" id="postcode" name="zipCode"
                        value="{{ $participant->zipCode }}">
                </div>
                <div class="col">
                    <label for="phone">Nomor Telephone</label>
                    <input type="text" class="form-control" id="phone" name="phoneNumber"
                        value="{{ $participant->phoneNumber }}">
                </div>
            </div>
            <div class="form-row mt-2">
                <label for="profile_picture">Profile Picture:</label>
                <input type="file" class="form-control" name="profile_picture" id="profile_picture">
            </div>
            <div class="form-row mt-2">
                <label for="zoom_picture">Cover Picture:</label>
                <input type="file" class="form-control" name="zoom_picture" id="zoom_picture">
            </div>

            <button type="submit" class="btn btn-primary mt-5">Simpan</button>
            <a type="button" href="/delete/{{  $participant->id }}" class="btn btn-danger mt-5">Hapus Akun</a>
        </form>
    </div>
@endsection
