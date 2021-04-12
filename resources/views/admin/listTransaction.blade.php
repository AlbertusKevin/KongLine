@extends('layout.adminNavbar')

@section('title')
    Admin - Donation List
@endsection

@section('content')
    @include('layout.message')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="form-inline my-2 my-lg-0 justify-content-center">
                    <input class="form-control mr-sm-2 w-50 mt-5" id="search-donation" type="search" placeholder="Search"
                        aria-label="Search">
                </div>
                <div class="text-center mt-5">
                    <button href="/petition" type="button" class="btn btn-primary donation-type rounded-pill">Semua</button>
                    <button href="/petition" type="button"
                        class="btn btn-light donation-type rounded-pill ml-3">Konfirmasi</button>
                    <button href="/petition" type="button"
                        class="btn btn-light donation-type rounded-pill ml-3">Gagal</button>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                {{-- <small><a href="/admin/donation/transaction">Transaksi donasi untuk diproses</a></small> --}}
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th scope="col">Tanggal Dibuat</th>
                            <th scope="col">Nama Donasi</th>
                            <th scope="col">Nama Participant</th>
                            <th scope="col">Jumlah Donasi</th>
                            <th scope="col">Detail</th>
                        </tr>
                    </thead>
                    <tbody id="donation-list">
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->created_at }}</td>
                                <td>{{ $transaction->title }}</td>
                                <td>{{ $transaction->name }}</td>
                                <td>{{ $transaction->nominal }}</td>
                                <td><a href="" type="button" class="btn btn-primary">detail</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
