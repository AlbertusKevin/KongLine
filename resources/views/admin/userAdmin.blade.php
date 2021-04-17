@extends('layout.adminNavbar')

@section('title')
    User - Detail
@endsection
@section('content')
    <div class="jumbotron text-center" style="background-image: url('/{{ $user->backgroundPicture }}');">
        <img src="/{{ $user->photoProfile}}" alt="profile" class="profile-picture rounded-circle">
        <h3 class="display-4">{{ $user->name}}</h3>
        <p class="lead">{{ $user->email }}</p>
        @if($user->dob == null)
            <p class="text-danger">Tidak ada data tanggal lahir.</p>
        @else
            <p>{{ $user->dob}}</p>
        @endif
        <button type="button" class="btn btn-success" disabled>{{ $user->role }}</button><br>
        @if($user->status != 1)
            <button type="button" class="btn btn-success">Pengajuan</button><br>
            <button type="button" class="btn btn-primary my-4 mr-5 rounded-pill">Terima Pengajuan</button>
            <button type="button" class="btn btn-danger rounded-pill">Tolak Pengajuan</button>
        @endif
    </div>

    <div class="container">
        <div class="container">
            <h3>Profile</h3>
            <div class="row py-3">
                <div class="col-sm-2">
                    Nama Lengkap
                </div>
                <div class="col-sm-10">
                    {{ $user->name }}
                </div>
            </div>
            <div class="row py-3">
                <div class="col-sm-2">
                    Tentang Saya
                </div>
                @if($user->aboutMe == null)
                    <div class="col-sm-10">
                        <p class="text-danger">Tidak ada data Tentang Saya.</p>
                    </div>
                @else
                    <div class="col-sm-10">
                        {{ $user->aboutMe }}
                    </div>
                @endif
            </div>
            <div class="row py-3">
                <div class="col-sm-2">
                    Kota
                </div>
                @if($user->city == null)
                    <div class="col-sm-10">
                        <p class="text-danger">Tidak ada data Kota.</p>
                    </div>
                @else
                    <div class="col-sm-10">
                        {{ $user->city }}
                    </div>
                @endif
            </div>
            <div class="row py-3">
                <div class="col-sm-2">
                    Negara
                </div>
                @if($user->country == null)
                    <div class="col-sm-10">
                        <p class="text-danger">Tidak ada data Negara.</p>
                    </div>
                @else
                    <div class="col-sm-10">
                        {{ $user->country }}
                    </div>
                @endif
            </div>
            <div class="row py-3">
                <div class="col-sm-2">
                    Alamat
                </div>
                @if($user->address == null)
                    <div class="col-sm-10">
                        <p class="text-danger">Tidak ada data Alamat.</p>
                    </div>
                @else
                    <div class="col-sm-10">
                        {{ $user->address }}
                    </div>
                @endif
            </div>
            <div class="row py-3">
                <div class="col-sm-2">
                    Kode Pos
                </div>
                @if($user->zipCode == null)
                    <div class="col-sm-10">
                        <p class="text-danger">Tidak ada data Kode Pos.</p>
                    </div>
                @else
                    <div class="col-sm-10">
                        {{ $user->zipCode }}
                    </div>
                @endif
            </div>
            <div class="row py-3">
                <div class="col-sm-2">
                    Nomor Telepon
                </div>
                @if($user->phoneNumber == null)
                    <div class="col-sm-10">
                        <p class="text-danger">Tidak ada data Nomor Telepon.</p>
                    </div>
                @else
                    <div class="col-sm-10">
                        {{ $user->phoneNumber }}
                    </div>
                @endif
            </div>
            @if( $user->role == 'campaigner')

                <h3 class="mt-5">Campaigner</h3>
                <div class="row py-3">
                    <div class="col-sm-2">
                        NIK
                    </div>
                    <div class="col-sm-10">
                        {{ $user->nik }}
                    </div>
                </div>
                <div class="row py-3">
                    <div class="col-sm-2">
                        Nomor Rekening
                    </div>
                    <div class="col-sm-10">
                        {{ $user->accountNumber }}
                    </div>
                </div>
                <div class="row py-3">
                    <div class="col-sm-2">
                        KTP
                    </div>
                    <div class="col-sm-10">
                        <img src="/{{$user->ktpPicture}}" class="img-thumbnail" alt="tolak">
                    </div>
                </div>
            @endif
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