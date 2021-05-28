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
                    <input class="form-control mr-sm-2 w-50 mt-5" id="search-transaction" type="search" placeholder="Search"
                        aria-label="Search">
                </div>
                <div class="text-center mt-5">
                    <button href="/petition" type="button"
                        class="btn btn-primary transaction-type rounded-pill">Semua</button>
                    <button href="/petition" type="button"
                        class="btn btn-light transaction-type rounded-pill ml-3">Konfirmasi</button>
                    <button href="/petition" type="button"
                        class="btn btn-light transaction-type rounded-pill ml-3">Gagal</button>
                    <button href="/petition" type="button" class="btn btn-light transaction-type rounded-pill ml-3">Belum
                        Upload</button>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th scope="col">Tanggal Dibuat</th>
                            <th scope="col">Nama Donasi</th>
                            <th scope="col">Nama Participant</th>
                            <th scope="col">Jumlah Donasi</th>
                            <th scope="col">Status</th>
                            <th scope="col">Detail</th>
                        </tr>
                    </thead>
                    <tbody id="transaction-list">
                        @foreach ($transactions as $transaction)
                            <tr>
                                <td>{{ date_format(date_create($transaction->created_at), 'Y/m/d') }}</td>
                                <td>{{ $transaction->title }}</td>
                                <td>{{ $transaction->name }}</td>
                                <td>Rp. {{ number_format($transaction->nominal, 2, ',', '.') }}</td>

                                @if ($transaction->status == 0)
                                    <td>
                                        <p class="badge badge-warning">Belum Upload</p>
                                    </td>
                                @elseif ($transaction->status == 1)
                                    <td>
                                        <p class="badge badge-success">Dikonfirmasi</p>
                                    </td>
                                @elseif ($transaction->status == 2)
                                    <td>
                                        <p class="badge badge-info">Perlu Konfirmasi</p>
                                    </td>
                                @else
                                    <td>
                                        <p class="badge badge-danger">Ditolak</p>
                                    </td>
                                @endif

                                <td><a href="/admin/donation/transaction/{{ $transaction->id }}" type="button"
                                        class="btn btn-primary">detail</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
