@extends('layout.app')
@section('title')
    Form Konfirmasi
@endsection

@section('content')
    @include('layout.message')
    <div class="container mt-5">
        <div class="row text-center">
            <div class="col-md-2 offset-md-3">
                <svg height="65" height="43" viewBox="0 0 55 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M27.5 26.6875L18.0208 15.3125H36.9791L27.5 26.6875Z" fill="#1565C0" />
                    <path d="M24.7917 0.416668H30.2083V19.375H24.7917V0.416668Z" fill="#1565C0" />
                    <path
                        d="M37.6562 31.4271L36.7083 32.9167L41.4478 35.4896L42.2603 33.8646C44.427 29.8021 45.7812 27.5 46.9999 26.8229C48.2187 26.1458 50.5208 26.1458 54.5833 26.1458V20.7292C44.1562 20.7292 43.2083 21.2708 37.6562 31.4271Z"
                        fill="#1565C0" />
                    <path d="M47 36.9792L34.8125 42.3958L32.9167 28.8542L47 36.9792Z" fill="#1565C0" />
                    <path
                        d="M17.3437 31.4271L18.1562 33.0521L13.4167 35.625L12.6042 34C10.4375 29.9375 9.08332 27.6354 7.86457 26.9583C6.78124 26.1458 4.47916 26.1458 0.416656 26.1458V20.7292C10.8437 20.7292 11.7917 21.2708 17.3437 31.4271Z"
                        fill="#1565C0" />
                    <path d="M22.0834 28.8542L20.1875 42.3958L8.00003 36.9792L22.0834 28.8542Z" fill="#1565C0" />
                </svg>
                <p class="mt-2">Input Data</p>
            </div>
            <div class="col-md-2 mt-4">
                <svg width="135" height="6" viewBox="0 0 135 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 3H135" stroke="#1167B1" stroke-width="5" />
                </svg>
            </div>
            <div class="col-md-2">
                <svg width="65" height="75" viewBox="0 0 65 75" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M24.375 31.8656H32.5C33.362 31.8656 34.1886 31.4708 34.7981 30.7681C35.4076 30.0653 35.75 29.1122 35.75 28.1184C35.75 27.1246 35.4076 26.1715 34.7981 25.4688C34.1886 24.7661 33.362 24.3713 32.5 24.3713H29.25V22.4977C29.25 21.5039 28.9076 20.5508 28.2981 19.8481C27.6886 19.1454 26.862 18.7506 26 18.7506C25.1381 18.7506 24.3114 19.1454 23.7019 19.8481C23.0924 20.5508 22.75 21.5039 22.75 22.4977V24.5587C20.7754 25.0209 19.0202 26.3127 17.8252 28.1831C16.6301 30.0536 16.0805 32.3692 16.283 34.6806C16.4855 36.992 17.4257 39.1341 18.921 40.6913C20.4163 42.2484 22.3601 43.1093 24.375 43.107H27.625C28.056 43.107 28.4693 43.3044 28.7741 43.6557C29.0788 44.0071 29.25 44.4837 29.25 44.9806C29.25 45.4775 29.0788 45.954 28.7741 46.3054C28.4693 46.6567 28.056 46.8541 27.625 46.8541H19.5C18.6381 46.8541 17.8114 47.2489 17.2019 47.9516C16.5924 48.6544 16.25 49.6075 16.25 50.6013C16.25 51.5951 16.5924 52.5482 17.2019 53.2509C17.8114 53.9536 18.6381 54.3484 19.5 54.3484H22.75V56.222C22.75 57.2158 23.0924 58.1689 23.7019 58.8716C24.3114 59.5743 25.1381 59.9691 26 59.9691C26.862 59.9691 27.6886 59.5743 28.2981 58.8716C28.9076 58.1689 29.25 57.2158 29.25 56.222V54.161C31.2246 53.6988 32.9798 52.407 34.1749 50.5366C35.3699 48.6661 35.9195 46.3505 35.717 44.0391C35.5145 41.7277 34.5744 39.5855 33.0791 38.0284C31.5837 36.4713 29.6399 35.6104 27.625 35.6127H24.375C23.944 35.6127 23.5307 35.4153 23.226 35.064C22.9212 34.7126 22.75 34.236 22.75 33.7391C22.75 33.2422 22.9212 32.7657 23.226 32.4143C23.5307 32.063 23.944 31.8656 24.375 31.8656ZM61.75 37.4863H52V3.76203C52.0023 3.10175 51.8532 2.4525 51.5678 1.88002C51.2825 1.30754 50.871 0.832161 50.375 0.502022C49.8809 0.173142 49.3205 0 48.75 0C48.1795 0 47.6191 0.173142 47.125 0.502022L37.375 6.9471L27.625 0.502022C27.131 0.173142 26.5705 0 26 0C25.4295 0 24.8691 0.173142 24.375 0.502022L14.625 6.9471L4.87502 0.502022C4.38096 0.173142 3.82052 0 3.25002 0C2.67953 0 2.11909 0.173142 1.62502 0.502022C1.12906 0.832161 0.717565 1.30754 0.432205 1.88002C0.146844 2.4525 -0.00224797 3.10175 2.56194e-05 3.76203V63.7162C2.56194e-05 66.6977 1.02725 69.557 2.85573 71.6651C4.68421 73.7733 7.16416 74.9577 9.75002 74.9577H55.25C57.8359 74.9577 60.3158 73.7733 62.1443 71.6651C63.9728 69.557 65 66.6977 65 63.7162V41.2334C65 40.2396 64.6576 39.2865 64.0481 38.5838C63.4386 37.8811 62.612 37.4863 61.75 37.4863ZM9.75002 67.4634C8.88807 67.4634 8.06142 67.0686 7.45193 66.3659C6.84243 65.6632 6.50002 64.7101 6.50002 63.7162V10.2446L13 14.5163C13.5016 14.8184 14.0591 14.9761 14.625 14.9761C15.1909 14.9761 15.7484 14.8184 16.25 14.5163L26 8.07124L35.75 14.5163C36.2516 14.8184 36.8091 14.9761 37.375 14.9761C37.9409 14.9761 38.4984 14.8184 39 14.5163L45.5 10.2446V63.7162C45.5088 64.9946 45.7066 66.2618 46.085 67.4634H9.75002ZM58.5 63.7162C58.5 64.7101 58.1576 65.6632 57.5481 66.3659C56.9386 67.0686 56.112 67.4634 55.25 67.4634C54.3881 67.4634 53.5614 67.0686 52.9519 66.3659C52.3424 65.6632 52 64.7101 52 63.7162V44.9806H58.5V63.7162Z"
                        fill="#27B7FF" />
                </svg>

                <p class="mt-2">Konfirmasi Pembayaran</p>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="confirm-donate ml-auto mr-auto text-center w-75">
                    <h3 class="mt-5">Transfer Rp {{ number_format($transaction->nominal, 2, ',', '.') }}</h3>
                    <small>ke Virtual Account BCA </small>
                    <h4 class="mt-3"><u>{{ ACCOUNT }}</u></h4>
                </div>
            </div>
        </div>

        <form action="/donation/confirm_donate/{{ $donation->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="row w-75 ml-auto mr-auto mt-4">
                <div class="col-md-12">
                    <div class="modal-content">
                        <div class="modal-body p-4">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="repaymentPicture"
                                        name="repaymentPicture">
                                    <label class="custom-file-label" for="repaymentPicture">Input gambar bukti pembayaran
                                        (jpg, png)</label>
                                </div>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit">Upload</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row w-35 ml-auto mr-auto mt-4">
                <div class="col-md-12">
                    <div class="modal-content">
                        <div class="modal-body p-4 text-center">
                            <img src="{{ DEFAULT_FILE_PREVIEW }}" alt="file preview" class="img-preview">
                        </div>
                    </div>
                </div>
            </div>
        </form>

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
                                    <td>{{ $user->name }}</td>
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

        {{-- <div class="row w-75 ml-auto mr-auto mt-4">
                <div class="col-md-12">
                    <div class="modal-content">
                        <div class="modal-body p-4">
                            <h5 class="font-weight-bold">Tuliskan dukungan/doa</h5>
                            <div class="form-group">
                                <textarea class="form-control" id="comment" rows="3" name="comment"></textarea>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="annonymousComment"
                                    name="annonymousComment">
                                <label class="form-check-label" for="annonymousComment">
                                    Donasi sebagai anonymus
                                </label>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row w-75 ml-auto mr-auto mt-4">
                <div class="col-md-12">
                    <button class="btn btn-danger btn-donate" type="submit">Konfirmasi Pembayaran</button>
                </div>
            </div>
        </form> --}}
    </div>
@endsection
