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
                <label for="name">Nama Lengkap</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="about">Tentang Saya</label>
                <textarea class="form-control" id="about" rows="3" name="about"></textarea>
            </div>
            <div class="form-group">
                <label for="kota">Kota</label>
                <input type="text" class="form-control" id="kota" name="kota">
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
                <input type="text" class="form-control" id="link" name="link">
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="alamat">
            </div>

            <div class="form-row">
                <div class="col">
                    <label for="postcode">Kode Pos</label>
                    <input type="text" class="form-control" id="postcode"  name="postcode">
                </div>
                <div class="col">
                    <label for="phone">Nomor Telephone</label>  
                    <input type="text" class="form-control" id="phone" name="phone">
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
        </form>
    </div>
@endsection