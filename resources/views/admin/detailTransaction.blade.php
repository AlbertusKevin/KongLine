@extends('layout.app')
@section('title')
    Form Konfirmasi
@endsection

@section('content')
    @include('layout.message')
    <div class="container mt-5">
        <div class="row w-50 ml-auto mr-auto mt-4">
            <div class="col-md-12">
                <div class="modal-content">
                    <div class="modal-body p-4">
                        <h4 class="font-weight-bold">Detail Transaksi</h4>
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <td>No. Invoice :</td>
                                    <td>{{ $transaction->id }}</td>
                                </tr>
                                <tr>
                                    <td>Status :</td>
                                    @if ($transaction->status == 0)
                                        <td>Pending</td>
                                    @else
                                        <td>Sudah Dikirim</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>No. Rekening:</td>
                                    <td>{{ $transaction->accountNumber }}</td>
                                </tr>
                                <tr>
                                    <td>Donasi Oleh:</td>
                                    <td>{{ $transaction->name }}</td>
                                </tr>
                                <tr>
                                    <td>Jumlah Donasi:</td>
                                    <td>{{ $transaction->nominal }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row w-35 ml-auto mr-auto mt-4">
            <div class="col-md-12">
                <div class="modal-content">
                    <div class="modal-body p-4 text-center">
                        <img src="/{{ $transaction->repaymentPicture }}" alt="bukti transaksi" class="img-preview">
                    </div>
                </div>
            </div>
        </div>
        <div class="row w-35 ml-auto mr-auto mt-4 text-center">
            <div class="col-md-12">
                <form action="/admin/donation/transaction/confirm/{{ $transaction->id }}" method="post">
                    @csrf
                    @method('patch')
                    <button class="btn btn-primary w-100">Konfirmasi</button>
                </form>
                <form action="/admin/donation/transaction/reject/{{ $transaction->id }}" method="post">
                    @csrf
                    @method('patch')
                    <button class="btn btn-danger w-100 mt-3">Tolak</button>
                </form>
            </div>
        </div>
    </div>
@endsection
