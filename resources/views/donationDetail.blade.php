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
                                <img src="/{{ $donation->photo }}" class="card-img-top">
                            </div>
                            <div class="col-md-9">
                                <h3 class="font-weight-bold title-donation-detail">{{ $donation->title }}</h3>
                                <p>{{ $donation->name }}</p>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <button class="btn btn-danger rounded-pill">Donasikan</button> xx Hari Lagi!
                                    </div>
                                    <div class="col-md-6">
                                        <p>Jumlah Donatur: <b>{{ $donation->totalDonatur }}</b> Donatur</p>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%"
                                                aria-valuenow="{{ $donation->donationCollected }}" aria-valuemin="0"
                                                aria-valuemax="{{ $donation->donationTarget }}"></div>
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
                                <a class="nav-link donation-detail" href="#">Kisah</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link donation-detail active" href="#">Alokasi Dana</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link donation-detail" href="#">Donatur</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link donation-detail" href="#">Dukungan</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Special title treatment</h5>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 text-right">
                <h5 class="font-weight-bold">Butuh Bantuan Donasi?</h5>
                <small>Yuk buat donasimu sekarang juga!</small>
                <a type="button" class="btn btn-primary mt-2">Ajukan Donasi</a>
            </div>
        </div>
    </div>

@endsection
