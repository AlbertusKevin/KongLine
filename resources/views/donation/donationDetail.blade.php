@extends($navbar)

@section('title')
    Detail Donation
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
                                <img src="/{{ $donation->photo }}" class="card-img-top detail-donation-photo"
                                    height="300px">
                            </div>
                            <div class="col-md-9">
                                <h3 class="font-weight-bold title-donation-detail">{{ $donation->title }}</h3>
                                <p>Kategori: {{ $category->description }}</p>
                                <p>{{ $donation->name }}</p>
                                <div class="row mt-3">
                                    @if ($donation->status == ACTIVE)
                                        @if ($user->role != ADMIN)
                                            @if ($isParticipated)
                                                <div class="col-md-6">
                                                    @if ($user->role == GUEST || $user->role == ADMIN)
                                                        <button type="button" class="btn btn-danger donate-button" disabled>
                                                            Donasikan
                                                        </button>
                                                        <small>Login untuk ikut berdonasi</small>
                                                        <p class="mt-2">
                                                            {{ ceil((strtotime($donation->deadline) - time()) / (60 * 60 * 24)) }}
                                                            Hari Lagi!</p>
                                                    @else
                                                        <a type="button" class="btn btn-danger donate-button"
                                                            href="/donation/donate/{{ $donation->id }}">Donasikan</a>
                                                        <span
                                                            class="ml-2">{{ ceil((strtotime($donation->deadline) - time()) / (60 * 60 * 24)) }}
                                                            Hari Lagi!</span>
                                                    @endif
                                                </div>
                                            @else
                                                <div class="col-md-6">
                                                    @if ($userTransactionStatus == WAITING)
                                                        <div class="alert alert-info alert-donated">
                                                            Konfirmasi Pembayaran Sedang diproses.
                                                        </div>
                                                    @elseif ($userTransactionStatus == FINISHED)
                                                        <div class="alert alert-info alert-donated">
                                                            Terima kasih telah berdonasi.
                                                        </div>
                                                    @else
                                                        <div class="alert alert-info alert-donated">
                                                            <p>Upload konfirmasi Anda</p>
                                                            <small><a
                                                                    href="/donation/confirm_donate/{{ $donation->id }}">konfirmasi
                                                                    pembayaran</a></small>
                                                        </div>
                                                    @endif
                                                    <span
                                                        class="ml-2">{{ ceil((strtotime($donation->deadline) - time()) / (60 * 60 * 24)) }}
                                                        Hari Lagi!</span>
                                                </div>
                                            @endif
                                        @endif
                                    @else
                                        @if ($user->role != ADMIN)
                                            <div class="col-md-6">
                                                <div class="alert alert-info alert-donated">
                                                    <h5>{{ $message['header'] }}</h5>
                                                    <small>{{ $message['content'] }}</small>
                                                </div>
                                                @if ($donation->status == NOT_CONFIRMED || $donation->status == REJECTED)
                                                    <small><a href="/donation/edit/{{ $donation->id }}">Klik untuk
                                                            mengubah data
                                                            donasi</a></small>
                                                @endif
                                            </div>
                                        @endif
                                    @endif
                                    <div class="col-md-6">
                                        <p>Jumlah Donatur: <b>{{ count($participatedDonation) }}</b> Donatur</p>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar"
                                                style="width: {{ $progress }}%"
                                                aria-valuenow="{{ $donation->donationCollected }}" aria-valuemin="0"
                                                aria-valuemax="{{ $donation->donationTarget }}"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 text-left font-weight-bold">
                                                Rp. {{ number_format($donation->donationCollected, 2, ',', '.') }}
                                            </div>
                                            <div class="col-md-6 text-right font-weight-bold">
                                                Rp. {{ number_format($donation->donationTarget, 2, ',', '.') }}
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
                                            <div class="row">
                                                <p class="mt-2 ml-3">
                                                    {{ ceil((strtotime($donation->deadline) - time()) / (60 * 60 * 24)) }}
                                                    Hari Lagi!</p>
                                            </div>
                                        @endif
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
                            @if (count($participatedDonation) != 0 && !$allStatusZero)
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
                            <p class="text-justify">{{ $donation->purpose }}</p>
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
                    @if ($donation->status == ACTIVE)
                        <form action="/admin/donation/close/{{ $donation->id }}" method="POST">
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
                    @elseif($donation->status == NOT_CONFIRMED)
                        <form action="/admin/donation/reject/{{ $donation->id }}" method="POST">
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
                        <form action="/admin/donation/accept/{{ $donation->id }}" method="POST">
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
            <p class="text-justify">{{ $donation->purpose }}</p>
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
                    @foreach ($alocationBudget as $budget)
                        <tr>
                            <td>{{ $budget->description }}</td>
                            <td>{{ $budget->nominal }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div id="donatur">
            <ul class="list-group">
                @foreach ($participatedDonation as $donatur)
                    @if ($donatur->status != 0)
                        <li class="list-group-item">
                            @if ($donatur->annonymous_comment == 1)
                                <img src="{{ DEFAULT_PROFILE }}" alt="Photo Profile" class="donatur-photo">
                                <span class="ml-3"> Annonymous </span>
                            @else
                                <img src="/{{ $donatur->photoProfile }}" alt="{{ $donatur->name }} Profile"
                                    class="donatur-photo">
                                <span class="ml-3"> {{ $donatur->name }} </span>
                            @endif
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
        <div id="comment">
            @foreach ($participatedDonation as $donatur)
                @if ($donatur->comment != null && $donatur->status != 0)
                    @if ($donatur->annonymous_comment == 1)
                        <div class="card mb-4">
                            <div class=" row no-gutters">
                                <div class="col-md-2 offset-md-2 text-center p-3">
                                    <img src="{{ DEFAULT_PROFILE }}" class="img-thumbnail rounded-circle"
                                        alt="Participant's Image Profile">
                                </div>
                                <div class="col-md-8">
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
                                <div class="col-md-2 offset-md-2 text-center p-3">
                                    <img src="/{{ $donatur->photoProfile }}" class="img-thumbnail rounded-circle"
                                        alt="Participant's Image Profile">
                                </div>
                                <div class="col-md-8">
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
