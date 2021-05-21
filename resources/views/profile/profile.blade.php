@extends('layout.app')

@section('content')
    @include('layout.message')
    <div class="jumbotron text-center" style="background-image: url('{{ $user->backgroundPicture }}');">
        <div
            style="width: 80%; padding: 75px 10px; margin-left: auto; margin-right: auto; background-color: rgba(212, 212, 212, 0.575); border-radius: 30px;">
            <img src="{{ $user->photoProfile }}" alt="profile" class="profile-picture rounded-circle">
            <h4 class="display-4">{{ $user->name }}</h4>
            @if ($user->role == 'campaigner')
                <h1><span class="badge rounded-pill bg-primary text-white">Campaigner</span></h1>
            @endif
            <a href="{{ $user->linkProfile }}" target="_blank" class="lead">{{ $user->linkProfile }}</a>
            <p class="mt-3">Terima kasih telah menjadi anggota aktif dari komunitas kami. </p>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-0 ml-3"><img src="/images/app/icons/profile-preference.png" alt="profile-preferences-icon">
            </div>
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
                    <a href="/change" type="button" class="card-text">Ubah Sandi</a>
                </div>
            </div>
            @if ($user->role == 'participant' && $user->status != 3)
                <div class="card w-100 mt-2">
                    <div class="card-body">
                        <a href="/profile/campaigner" type="button" class="card-text">Upgrade to Campaigner</a>
                    </div>
                </div>
            @elseif ($user->role == 'campaigner' || $user->status == 3)
                <div class="card w-100 mt-2">
                    <div class="card-body">
                        <a href="/profile/campaigner" type="button" class="card-text">Data Campaigner</a>
                    </div>
                </div>
            @endif
        </div>
        <div class="row mt-5">
            <div class="col-md-0 ml-3"><img src="/images/app/icons/profile-edit.png" alt="profile-edit-icon"></div>
            <div class="col-md ml-3">
                <h3>Edit Profile</h3>
            </div>
        </div>
        <div class="row">
            <p class="ml-3">Atur akses akun dan kelola data yang kami gunakan untuk mempersonalisasi pengalamanmu.</p>
        </div>

        <form action="/profile" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
            </div>
            <div class="form-group">
                <label for="about">Tentang Saya</label>
                <textarea class="form-control" id="about" rows="3" name="aboutMe">{{ $user->aboutMe }}</textarea>
            </div>
            <div class="form-group">
                <label for="kota">Kota</label>
                <input type="text" class="form-control" id="kota" name="city" value="{{ $user->city }}">
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
                <input type="text" class="form-control" id="link" name="linkProfile" value="{{ $user->linkProfile }}">
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" id="alamat" name="address" value="{{ $user->address }}">
            </div>

            <div class="form-row">
                <div class="col">
                    <label for="postcode">Kode Pos</label>
                    <input type="text" class="form-control" id="postcode" name="zipCode" value="{{ $user->zipCode }}">
                </div>
                <div class="col">
                    <label for="phone">Nomor Telephone</label>
                    <input type="text" class="form-control" id="phone" name="phoneNumber"
                        value="{{ $user->phoneNumber }}">
                </div>
            </div>
            <div class="form-row mt-2">
                <label for="profile_picture">Profile Picture:</label>
                <input type="file" class="form-control" name="profile_picture" id="profile_picture">
            </div>
            <div class="form-row mt-2">
                <label for="cover_picture">Cover Picture:</label>
                <input type="file" class="form-control" name="cover_picture" id="cover_picture">
            </div>

            <button type="submit" class="btn btn-primary mt-5">Simpan</button>
            <button type="button" class="btn btn-danger mt-5" data-toggle="modal" data-target="#hapus-akun">Hapus
                Akun</button>
        </form>
    </div>

    <div class="modal fade" id="hapus-akun" tabindex="-1" aria-labelledby="hapus-akun-label" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h6 class="mb-4" style="line-height: 1.7">Apakah anda Yakin ingin menghapus akun Anda?</h6>
                    <button type="button" class="btn btn-warning mr-5" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus-akun-exec"
                        data-dismiss="modal">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="hapus-akun-exec" tabindex="-1" aria-labelledby="hapus-akun-exec-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hapus-akun-exec-label">Verifikasi Akun</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/delete/profile/verification" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="text" readonly class="form-control-plaintext" name="email" id="email"
                                    value="{{ $user->email }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="password" name="password">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection
