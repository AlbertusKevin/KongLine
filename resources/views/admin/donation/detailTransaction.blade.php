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
                                        <td>Belum upload</td>
                                    @elseif ($transaction->status == 1)
                                        <td>Sudah Dikirim</td>
                                    @elseif ($transaction->status == 2)
                                        <td>Pending</td>
                                    @else
                                        <td>Ditolak</td>
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
                                    <td>Rp. {{ number_format($transaction->nominal, 2, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row w-35 ml-auto mr-auto mt-4">
            <img src="{{ $transaction->repaymentPicture }}" alt="bukti transaksi" class="img-preview">
        </div>
        @if ($transaction->status == NOT_CONFIRMED_TRANSACTION)
            <div class="row w-35 ml-auto mr-auto mt-4 text-center">
                <div class="col-md-12">
                    <form action="/admin/donation/transaction/confirm/{{ $transaction->id }}" method="post">
                        @csrf
                        @method('patch')
                        <button type="submit" class="btn btn-primary w-100">Konfirmasi</button>
                    </form>
                    <button type="button" class="btn btn-danger w-100 mt-3" data-toggle="modal"
                        data-target="#form-reject">Tolak</button>
                </div>
            </div>
        @endif
    </div>

    <div class="modal fade" id="form-reject" tabindex="-1" aria-labelledby="form-reject-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/admin/donation/transaction/reject/{{ $transaction->id }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="modal-header">
                        <h5 class="modal-title" id="form-reject-label">Alasan Ditolak</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <textarea class="form-control" id="rejectTransaction" name="rejectTransaction"
                                rows="3"></textarea>
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
