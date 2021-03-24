@extends('layout.app')
@section('title')
    Detail Donation
@endsection
@section('content')

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
                                    <div class="col-md-6">
                                        <button class="btn btn-danger donate-button">Donasikan</button>
                                        <span
                                            class="ml-2">{{ ceil((strtotime($donation->deadline) - time()) / (60 * 60 * 24)) }}
                                            Hari Lagi!</span>
                                    </div>
                                    <div class="col-md-6">
                                        <p>Jumlah Donatur: <b>{{ count($participatedDonation) }}</b> Donatur</p>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%"
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
                            @if (count($participatedDonation) != 0)
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
                @if ($user->role == 'guest')
                    <h5 class="font-weight-bold">Ayo daftarkan dirimu sekarang!</h5>
                    <small>Mulailah membawa perubahan dengan menolong
                        sesama.</small>
                    <a type="button" class="btn btn-primary mt-2">Daftar</a>
                @elseif($user->role == 'campaigner')
                    <h5 class="font-weight-bold">Butuh Bantuan Donasi?</h5>
                    <small>Yuk buat donasimu sekarang juga!</small>
                    <a type="button" class="btn btn-primary mt-2">Ajukan Donasi</a>
                @elseif($user->role == 'participant')
                    <h5 class="font-weight-bold">Upgrade akun mu menjadi <i>campaigner</i>!</h5>
                    <small>Mulailah membawa perubahan dengan menolong
                        sesama.</small>
                    <a type="button" class="btn btn-primary mt-2">Daftar Campaigner</a>
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
                    <li class="list-group-item">
                        <img src="/{{ $donatur->photoProfile }}" alt="{{ $donatur->name }} Profile"
                            class="donatur-photo">
                        <span class="ml-3"> {{ $donatur->name }} </span>
                    </li>
                @endforeach
            </ul>
        </div>
        <div id="comment">
            @foreach ($participatedDonation as $donatur)
                @if ($donatur->comment != null)
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
            @endforeach
        </div>
    </div>


@endsection
