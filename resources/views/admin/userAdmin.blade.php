@extends('layout.app')

@section('content')
    <div class="jumbotron text-center" style="background-image: url('/images/profile/background/coverProfile.png');">
        <img src="images/profile/photo/default.svg" alt="profile" class="profile-picture rounded-circle">
        <h3 class="display-4">Popon Tuti Wati</h3>
        <p class="lead">popon1029@gmail.com</p>
        <p>12/09/2020</p>
        <button type="button" class="btn btn-success">Pengajuan</button><br>
        <button type="button" class="btn btn-primary my-4 mr-5 rounded-pill">Terima Pengajuan</button>
        <button type="button" class="btn btn-danger rounded-pill">Tolak Pengajuan</button>
    </div>

    <div class="container">
        <div class="container">
            <h3>Profile</h3>
            <div class="row py-3">
                <div class="col-sm-2">
                    Nama Lengkap
                </div>
                <div class="col-sm-10">
                    Popon Tuti Wati
                </div>
            </div>
            <div class="row py-3">
                <div class="col-sm-2">
                    Tentang Saya
                </div>
                <div class="col-sm-10">
                    Seorang pengamat sosial yang menaruh perhatian khusus terkait acara penggalangan dana untuk membentuk sesama yang membutuhkan
                </div>
            </div>
            <div class="row py-3">
                <div class="col-sm-2">
                    Kota
                </div>
                <div class="col-sm-10">
                    Bandung
                </div>
            </div>
            <div class="row py-3">
                <div class="col-sm-2">
                    Negara
                </div>
                <div class="col-sm-10">
                    Indonesia
                </div>
            </div>
            <div class="row py-3">
                <div class="col-sm-2">
                    Alamat
                </div>
                <div class="col-sm-10">
                    Jalan Kenangan No. 21
                </div>
            </div>
            <div class="row py-3">
                <div class="col-sm-2">
                    Kode Pos
                </div>
                <div class="col-sm-10">
                    40219
                </div>
            </div>
            <div class="row py-3">
                <div class="col-sm-2">
                    Nomor Telepon
                </div>
                <div class="col-sm-10">
                    082133318
                </div>
            </div>
            <h3 class="mt-5">Campaigner</h3>
            <div class="row py-3">
                <div class="col-sm-2">
                    NIK
                </div>
                <div class="col-sm-10">
                    0128301230129
                </div>
            </div>
            <div class="row py-3">
                <div class="col-sm-2">
                    Nomor Rekening
                </div>
                <div class="col-sm-10">
                    10239102
                </div>
            </div>
            <div class="row py-3">
                <div class="col-sm-2">
                    KTP
                </div>
                <div class="col-sm-10">
                    <img src="/img/baby.png" class="img-thumbnail" alt="tolak">
                </div>
            </div>
        </div>
        <div class="container">
            <h3 class="mt-5">Event</h3>
            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-primary mx-2 rounded-pill my-3">Diikuti (20)</button>
                    <button type="button" class="btn btn-light rounded-pill my-3">Dibuat (0)</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img src="/img/baby.png" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                      </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img src="/img/baby.png" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                      </div>
                </div>
                <div class="col-md-4">
                    <div class="card" style="width: 18rem;">
                        <img src="/img/baby.png" class="card-img-top" alt="...">
                        <div class="card-body">
                          <h5 class="card-title">Card title</h5>
                          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                          <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
@endsection