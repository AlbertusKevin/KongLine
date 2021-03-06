@extends('layout.app')
@section('title')
    Data Campaigner
@endsection
@section('content')
    @include('layout.message')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-0 ml-3"><img src="/images/app/icons/campaigner-profile.png" alt="icon profile campaigner">
            </div>
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
            @if ($user->status == 3 || $user->role == PARTICIPANT)
                <div class="form-group">
                    @if ($user->status == 3)
                        <img src="{{ $user->ktpPicture }}" alt="KTP" class="img-thumbnail" width="300px"><br><br>
                    @endif
                    <label for="KTP_picture">Foto KTP</label>
                    <input type="file" class="form-control" name="KTP_picture" id="KTP_picture">
                </div>
            @endif

            <div class="form-group mt-2">
                <label for="nik">NIK</label>
                @if ($user->role == CAMPAIGNER)
                    <input type="text" class="form-control" id="nik" name="nik" value="{{ $user->nik }}" disabled>
                @else
                    <input type="text" class="form-control" id="nik" name="nik" value="{{ $user->nik }}">
                @endif
            </div>

            <div class="form-group">
                <label for="rekening">Nomor Rekening</label>
                <input type="text" class="form-control" id="rekening" name="rekening" value="{{ $user->accountNumber }}">
            </div>

            @if ($user->status == 1 && $user->role == PARTICIPANT)
                <button type="submit" class="btn btn-primary mt-5">Daftar</button>
            @else
                <button type="submit" class="btn btn-primary mt-5">Perbarui</button>
            @endif
            <a type="button" href="{{ url('/profile') }}" class="btn btn-light mt-5">Batal</a>
        </form>
    </div>
@endsection
