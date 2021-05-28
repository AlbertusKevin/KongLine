@extends('layout.adminNavbar')

@section('title')
    User - Detail
@endsection
@section('content')
    <div class="jumbotron text-center" style="background-image: url('{{ $user->backgroundPicture }}');">
        <div
            style="width: 80%; padding: 75px 10px; margin-left: auto; margin-right: auto; background-color: rgba(255, 255, 255, 0.5); border-radius: 20px;">
            <img src="{{ $user->photoProfile }}" alt="profile" class="profile-picture rounded-circle">
            <h3 class="display-4 name">{{ $user->name }}</h3>
            <p class="lead">{{ $user->email }}</p>
            @if ($user->dob != null)
                <p>{{ date_format(date_create($user->dob), 'd F Y') }}</p>
            @endif
            <button type="button" class="btn btn-success mb-2" disabled>{{ $user->role }}</button><br>
            @if ($user->status == 0)
                <span class="badge badge-info p-2">Akun Telah Dihapus</span><br>
            @elseif($user->status == 2)
                <span class="badge badge-danger p-2">Akun Telah Diblokir</span><br>
            @elseif ($user->status == 3)
                <span class="badge badge-warning p-2">Pengajuan</span><br>
                <form id="confirm-pengajuan" action="/admin/user/terimaPengajuan/{{ $user->id }}" method="POST"
                    style="display: inline-block">
                    @csrf
                    @method('patch')
                    <button type="submit" class="btn btn-primary my-4 rounded-pill terimaPengajuan">Terima
                        Pengajuan</button>
                </form>

                {{-- <form action="" method="POST" style="display: inline-block">
                    @csrf
                    @method('patch') --}}
                <button type="button" class="btn btn-danger rounded-pill tolakPengajuan" data-toggle="modal"
                    data-target="#tolak-pengajuan">Tolak Pengajuan</button>
                {{-- </form> --}}
            @endif
        </div>
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
            @if ($user->aboutMe != null || $user->aboutMe != '')
                <div class="row py-3">
                    <div class="col-sm-2">
                        Tentang Saya
                    </div>
                    <div class="col-sm-10">
                        {{ $user->aboutMe }}
                    </div>
                </div>
            @endif
            @if ($user->city != null || $user->city != '')
                <div class="row py-3">
                    <div class="col-sm-2">
                        Kota
                    </div>
                    <div class="col-sm-10">
                        {{ $user->city }}
                    </div>
                </div>
            @endif
            @if ($user->country != null || $user->country != '')
                <div class="row py-3">
                    <div class="col-sm-2">
                        Negara
                    </div>
                    <div class="col-sm-10">
                        {{ $user->country }}
                    </div>
                </div>
            @endif
            @if ($user->address != null || $user->address != '')
                <div class="row py-3">
                    <div class="col-sm-2">
                        Alamat
                    </div>
                    <div class="col-sm-10">
                        {{ $user->address }}
                    </div>
                </div>
            @endif
            @if ($user->zipCode != null || $user->zipCode != '')
                <div class="row py-3">
                    <div class="col-sm-2">
                        Kode Pos
                    </div>
                    <div class="col-sm-10">
                        {{ $user->zipCode }}
                    </div>
                </div>
            @endif
            @if ($user->phoneNumber != null || $user->phoneNumber != '')
                <div class="row py-3">
                    <div class="col-sm-2">
                        Nomor Telepon
                    </div>
                    <div class="col-sm-10">
                        {{ $user->phoneNumber }}
                    </div>
                </div>
            @endif
            @if ($user->role == CAMPAIGNER || $user->status == WAITING)
                @if ($user->role == CAMPAIGNER)
                    <h3 class="mt-5">Campaigner</h3>
                @else
                    <h3 class="mt-5">Data Calon Campaigner</h3>
                @endif
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
                        <img src="{{ $user->ktpPicture }}" class="img-thumbnail" alt="{{ $user->name }}'s KTP"
                            width="35%">
                    </div>
                </div>
            @endif
        </div>
        <div class="container">
            <h3 class="mt-5">Event</h3>
            <div class="row">
                <div class="col-md-auto">
                    <button type="button" class="btn btn-primary mx-2 rounded-pill my-3 diikuti">Diikuti
                        ({{ $countTotal }})</button>
                </div>
                <div class="col-md-auto">
                    @if ($user->role == CAMPAIGNER)
                        <button type="button" class="btn btn-light rounded-pill my-3 dibuat">Dibuat
                            ({{ $eventMade }})</button>
                    @endif
                </div>
            </div>

            <div class="row flex-nowrap event horizontal-scroll">
                @php
                    $status = DONATION;
                @endphp
                @foreach ($events as $event)
                    @foreach ($event as $singleEvent)
                        @if ($status == DONATION)
                            <div class="m-2">
                                <div class="card" style="width: 18rem;">
                                    <img src="{{ $singleEvent->photo }}" class="card-img-top event-profile"
                                        alt="{{ $singleEvent->title }}'s photo">
                                    <p class="time-left">Donation</p>
                                    <div class="card-body">
                                        <h5 class="card-title event-text">{{ $singleEvent->title }}</h5>
                                        <p class="card-text">{{ $singleEvent->name }}</p>
                                        <a href="/donation/{{ $singleEvent->id }}" class="btn btn-primary">Kunjungi
                                            event</a>
                                    </div>
                                </div>
                            </div>
                        @elseif ($status == PETITION)
                            <div class="m-2">
                                <div class="card" style="width: 18rem;">
                                    <img src="{{ $singleEvent->photo }}" class="card-img-top event-profile"
                                        alt="{{ $singleEvent->title }}'s photo">
                                    <p class="time-left-white">Petition</p>
                                    <div class="card-body">
                                        <h5 class="card-title event-text">{{ $singleEvent->title }}</h5>
                                        <p class="card-text">{{ $singleEvent->name }}</p>
                                        <a href="/petition/{{ $singleEvent->id }}" class="btn btn-primary">Kunjungi
                                            event</a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    @if ($loop->remaining)
                        @php
                            $status = PETITION;
                        @endphp
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="modal fade" id="tolak-pengajuan" tabindex="-1" aria-labelledby="tolak-pengajuan-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/admin/user/tolakPengajuan/{{ $user->id }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="modal-header">
                        <h5 class="modal-title" id="tolak-pengajuan-label">Alasan Ditolak</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <textarea class="form-control" id="rejectCampaigner" name="rejectCampaigner"
                                rows="3">{{ old('rejectCampaigner') }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-danger" type="submit">Tolak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
