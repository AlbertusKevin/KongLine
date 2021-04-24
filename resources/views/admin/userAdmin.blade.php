@extends('layout.adminNavbar')

@section('title')
    User - Detail
@endsection
@section('content')
    <div class="jumbotron text-center" style="background-image: url('/{{ $user->backgroundPicture }}');">
        <img src="/{{ $user->photoProfile}}" alt="profile" class="profile-picture rounded-circle">
        <h3 class="display-4 name">{{ $user->name}}</h3>
        {{-- <h6 class="userId={{$user->id}}">{{ $user->id }}</h6> --}}
        <p class="lead">{{ $user->email }}</p>
        @if($user->dob == null)
            <p class="text-danger">Tidak ada data tanggal lahir.</p>
        @else
            <p>{{ $user->dob}}</p>
        @endif
        <button type="button" class="btn btn-success mb-2" disabled>{{ $user->role }}</button><br>
        @if($user->status != 1)
            <span class="badge badge-warning p-2">Pengajuan</span><br>
            <form id="confirm-pengajuan" action="/admin/user/terimaPengajuan/{{ $user->id }}" method="POST">
                @csrf
                @method('patch')
                <button type="submit" class="btn btn-primary my-4 mr-5 rounded-pill terimaPengajuan">Terima Pengajuan</button>
            </form>

            <form action="/admin/user/tolakPengajuan/{{ $user->id }}" method="POST">
                @csrf
                @method('patch')
                <button type="submit" class="btn btn-danger rounded-pill tolakPengajuan">Tolak Pengajuan</button>
            </form>
        @endif
    </div>

    {{-- <script>
        function confirmPengajuan(form_id){
            Alert({
                title: 'Terima Pengajuan?',
                text: 'Anda akan menerima pengajuan upgrade ke Campaigner',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Terima pengajuan',
            })
            .then((accept) =>{
                if(accept){
                    $("#" + form_id).submit();
                }else{
                    Alert("Canceled!");
                }
            });
        }
    </script> --}}

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
            @if( $user->role == CAMPAIGNER || $user->status == WAITING)

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
                        <img src="/{{$user->ktpPicture}}" class="img-thumbnail" alt="tolak">
                    </div>
                </div>
            @endif
        </div>
        <div class="container">
            <h3 class="mt-5">Event</h3>
            <div class="row">
                <div class="col-md-auto">
                    <button type="button" class="btn btn-primary mx-2 rounded-pill my-3 diikuti">Diikuti ({{ $countTotal }})</button>
                </div>
                <div class="col-md-auto">
                    @if( $user->role == CAMPAIGNER)
                        <button type="button" class="btn btn-light rounded-pill my-3 dibuat">Dibuat ({{ $eventMade }})</button>
                    @endif
                </div>
            </div>
            {{-- <div class="event-list"> --}}

            <div class="row flex-nowrap event horizontal-scroll">
                {{-- <div class="event"> --}}
                    @php
                        $status = DONATION;
                    @endphp
                    @foreach ($events as $event)
                        @foreach ( $event as $singleEvent)
                            @if ($status == DONATION)
                                <div class="m-2">
                                    <div class="card" style="width: 18rem;">
                                        <img src="/{{$singleEvent->photo}}" class="card-img-top" alt="...">
                                        <p class="time-left">Donation</p>
                                        <div class="card-body">
                                            <h5 class="card-title">{{$singleEvent->title}}</h5>
                                            <p class="card-text">{{$singleEvent->name}}</p>
                                            <a href="/donation/{{$singleEvent->id}}" class="btn btn-primary">Kunjungi event</a>
                                        </div>
                                    </div>
                                </div>
                            @elseif ($status == PETITION)
                                    <div class="m-2">
                                        <div class="card" style="width: 18rem;">
                                            <img src="/{{$singleEvent->photo}}" class="card-img-top" alt="...">
                                            <p class="time-left-white">Petition</p>
                                            <div class="card-body">
                                                <h5 class="card-title">{{$singleEvent->title}}</h5>
                                                <p class="card-text">{{$singleEvent->name}}</p>
                                                <a href="/petition/{{$singleEvent->id}}" class="btn btn-primary">Kunjungi event</a>
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
                {{-- </div> --}}
            </div>
            {{-- </div> --}}
        </div>
    </div>
@endsection