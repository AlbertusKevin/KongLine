@extends($navbar)

@section('title')
    Rincian Event Donasi
@endsection
@section('content')
    @include('layout.message')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="{{ $donation['detail']->photo }}" class="card-img-top detail-donation-photo"
                                    height="300px">
                            </div>
                            <div class="col-md-9">
                                <h3 class="font-weight-bold title-donation-detail">{{ $donation['detail']->title }}</h3>
                                <p>Kategori: {{ $donation['detail']->category_description }}</p>
                                <p>{{ $donation['detail']->name }}</p>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        @if ($donation['detail']->status == ACTIVE)
                                            @if ($user->role != ADMIN)
                                                @if (!$isParticipated)
                                                    @if ($user->role == GUEST)
                                                        <small class="badge badge-info">
                                                            Login sebagai peserta untuk ikut berdonasi
                                                        </small>
                                                    @else
                                                        <a type="button" class="btn btn-info"
                                                            href="/donation/donate/{{ $donation['detail']->id }}">Donasikan</a>
                                                    @endif
                                                @else
                                                    <div class="alert alert-info alert-donated">
                                                        {!! $messageTransaction !!}
                                                    </div>
                                                @endif
                                            @endif
                                            <span
                                                class="mt-2 d-block">{{ ceil((strtotime($donation['detail']->deadline) - time()) / (60 * 60 * 24)) }}
                                                Hari Lagi!</span>
                                        @else
                                            @if ($user->role != ADMIN)
                                                <div class="alert alert-info alert-donated">
                                                    <h5>{{ $message['header'] }}</h5>
                                                    <small>{{ $message['content'] }}</small>
                                                </div>
                                                @if (($donation['detail']->status == NOT_CONFIRMED || $donation['detail']->status == REJECTED) && $donation['detail']->idCampaigner == $user->id)
                                                    <small><a href="/donation/edit/{{ $donation['detail']->id }}">Klik
                                                            untuk
                                                            mengubah data
                                                            donasi</a></small>
                                                @endif
                                            @endif
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <p>Jumlah Donatur: <b>{{ count($donation['participated']) }}</b> Donatur</p>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: {{ $donation['progress'] }}%"
                                                aria-valuenow="{{ $donation['detail']->donationCollected }}"
                                                aria-valuemin="0"
                                                aria-valuemax="{{ $donation['detail']->donationTarget }}"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 text-left font-weight-bold">
                                                Rp.
                                                {{ number_format($donation['detail']->donationCollected, 2, ',', '.') }}
                                            </div>
                                            <div class="col-md-6 text-right font-weight-bold">
                                                Rp.
                                                {{ number_format($donation['detail']->donationTarget, 2, ',', '.') }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 text-left">
                                                Terkumpul
                                            </div>
                                            <div class="col-md-6 text-right">
                                                Menuju Target
                                            </div>
                                        </div>
                                        @if ($user->role == ADMIN)
                                            @if ($donation['detail']->status == FINISHED)
                                                <form action="/admin/donation/proceed/{{ $donation['detail']->id }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('patch')
                                                    <button type="submit" class="btn btn-success mt-2">Tandai
                                                        Selesai</button>
                                                </form>
                                            @endif
                                        @endif
                                        {{-- @if ($user->role == ADMIN)
                                                <div class="row">
                                                    <p class="mt-2 ml-3">
                                                        {{ ceil((strtotime($donation['detail']->deadline) - time()) / (60 * 60 * 24)) }}
                                                        Hari Lagi!</p>
                                                </div>
                                            @endif --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-8">
                <div class="card text-center">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link donation-detail active show-description">Kisah</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link donation-detail show-budgeting">Alokasi Dana</a>
                            </li>
                            @if (!$donation['isAllTransactionNotConfirmed'])
                                <li class="nav-item">
                                    <a class="nav-link donation-detail show-donatur">Donatur</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link donation-detail show-comment">Dukungan</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="card-body information-donation">
                        <div class="card-text">
                            <p class="text-justify">{{ $donation['detail']->purpose }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-right">
                @if ($user->role == GUEST)
                    <h5 class="font-weight-bold">Ayo daftarkan dirimu sekarang!</h5>
                    <p>Mulailah membawa perubahan dengan menolong
                        sesama.</p>
                    <a type="button" href="/register" class="btn btn-primary mt-2">Daftar</a>
                @elseif($user->role == CAMPAIGNER)
                    <h5 class="font-weight-bold">Butuh Bantuan Donasi?</h5>
                    <p>Yuk buat donasimu sekarang juga!</p>
                    <a type="button" class="btn btn-primary mt-2" href="/donation/create">Ajukan Donasi</a>
                @elseif($user->role == PARTICIPANT)
                    <h5 class="font-weight-bold">Upgrade akun mu menjadi <i>campaigner</i>!</h5>
                    <p>Mulailah membawa perubahan dengan menolong
                        sesama.</p>
                    <a type="button" class="btn btn-primary mt-2" href="/profile/campaigner">Daftar
                        Campaigner</a>
                @elseif($user->role == ADMIN)
                    @if ($donation['detail']->status == ACTIVE)
                        <form action="/admin/donation/close/{{ $donation['detail']->id }}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label for="closeEvent">
                                    <h5 class="font-weight-bold mt-5">Berikan Alasan Mengapa Event ini Ditutup</h5>
                                </label>
                                <textarea class="form-control" id="closeEvent" name="closeEvent" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-danger close-event">Tutup Event</button>
                        </form>
                    @elseif($donation['detail']->status == NOT_CONFIRMED)
                        <form action="/admin/donation/reject/{{ $donation['detail']->id }}" method="POST">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <label for="rejectEvent">
                                    <h4 class="font-weight-bold">Alasan Ditolak</h4>
                                </label>
                                <textarea class="form-control" id="rejectEvent" name="rejectEvent" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-danger close-event">Tolak Event</button>
                        </form>
                        <form action="/admin/donation/accept/{{ $donation['detail']->id }}" method="POST">
                            @csrf
                            @method('patch')
                            <button type="submit" class="btn btn-primary approve-event mt-3">Setujui Event</button>
                        </form>
                    @endif
                @endif
            </div>
        </div>
    </div>

    <div class="banish">
        <div id="description">
            <p class="text-justify">{{ $donation['detail']->purpose }}</p>
        </div>
        <div id="budgeting">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Keperluan</th>
                        <th scope="col">Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($donation['budgetAlloc'] as $budget)
                        <tr>
                            <td>{{ $budget->description }}</td>
                            <td>Rp. {{ number_format($budget->nominal, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div id="donatur">
            <ul class="list-group">
                @foreach ($donation['participated'] as $donatur)
                    <li class="list-group-item">
                        <div class="row">
                            @if ($donatur->annonymous_comment == 1)
                                <div class="col-md-2 offset-md-2 text-center">
                                    <img src="{{ DEFAULT_PROFILE }}" alt="Photo Profile" class="profile-donatur">
                                </div>
                                <div class="col-md-5 text-left">
                                    <span class="ml-3"> Annonymous </span>
                                </div>
                            @else
                                <div class="col-md-2 offset-md-2 text-center">
                                    <img src="{{ $donatur->photoProfile }}" alt="{{ $donatur->name }} Profile"
                                        class="profile-donatur">
                                </div>
                                <div class="col-md-5 text-left">
                                    <span class="ml-3"> {{ $donatur->name }} </span>
                                </div>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div id="comment">
            @foreach ($donation['participated'] as $donatur)
                @if ($donatur->comment != null)
                    @if ($donatur->annonymous_comment == 1)
                        <div class="card mb-4">
                            <div class=" row no-gutters">
                                <div class="col-md-2 offset-md-2 text-right p-3">
                                    <img src="{{ DEFAULT_PROFILE }}" class="profile-donatur"
                                        alt="Participant's Image Profile">
                                </div>
                                <div class="col-md-8 text-left">
                                    <div class="card-body">
                                        <h5 class="card-title font-weight-bold">Annonymous</h5>
                                        <p class="petition-description">{{ $donatur->comment }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card mb-4">
                            <div class=" row no-gutters">
                                <div class="col-md-2 offset-md-2 text-right p-3">
                                    <img src="{{ $donatur->photoProfile }}" class="profile-donatur"
                                        alt="Participant's Image Profile">
                                </div>
                                <div class="col-md-8 text-left">
                                    <div class="card-body">
                                        <h5 class="card-title font-weight-bold">{{ $donatur->name }}</h5>
                                        <p class="petition-description">{{ $donatur->comment }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>
    </div>


@endsection
