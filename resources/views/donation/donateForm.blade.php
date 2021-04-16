@extends('layout.app')
@section('title')
    Form Donate
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
                <svg height="76" viewBox="0 0 65 76" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M24.375 32.7525H32.5C33.362 32.7525 34.1886 32.3577 34.7981 31.655C35.4076 30.9523 35.75 29.9992 35.75 29.0054C35.75 28.0116 35.4076 27.0585 34.7981 26.3557C34.1886 25.653 33.362 25.2582 32.5 25.2582H29.25V23.3846C29.25 22.3908 28.9076 21.4377 28.2981 20.735C27.6886 20.0323 26.862 19.6375 26 19.6375C25.1381 19.6375 24.3114 20.0323 23.7019 20.735C23.0924 21.4377 22.75 22.3908 22.75 23.3846V25.4456C20.7754 25.9079 19.0202 27.1996 17.8252 29.07C16.6301 30.9405 16.0805 33.2562 16.283 35.5675C16.4855 37.8789 17.4257 40.0211 18.921 41.5782C20.4163 43.1353 22.3601 43.9962 24.375 43.9939H27.625C28.056 43.9939 28.4693 44.1913 28.7741 44.5427C29.0788 44.894 29.25 45.3706 29.25 45.8675C29.25 46.3644 29.0788 46.8409 28.7741 47.1923C28.4693 47.5437 28.056 47.7411 27.625 47.7411H19.5C18.6381 47.7411 17.8114 48.1358 17.2019 48.8386C16.5924 49.5413 16.25 50.4944 16.25 51.4882C16.25 52.482 16.5924 53.4351 17.2019 54.1378C17.8114 54.8405 18.6381 55.2353 19.5 55.2353H22.75V57.1089C22.75 58.1027 23.0924 59.0558 23.7019 59.7585C24.3114 60.4613 25.1381 60.856 26 60.856C26.862 60.856 27.6886 60.4613 28.2981 59.7585C28.9076 59.0558 29.25 58.1027 29.25 57.1089V55.048C31.2246 54.5857 32.9798 53.2939 34.1749 51.4235C35.3699 49.5531 35.9195 47.2374 35.717 44.926C35.5145 42.6146 34.5744 40.4725 33.0791 38.9154C31.5837 37.3583 29.6399 36.4973 27.625 36.4996H24.375C23.944 36.4996 23.5307 36.3022 23.226 35.9509C22.9212 35.5995 22.75 35.123 22.75 34.6261C22.75 34.1292 22.9212 33.6526 23.226 33.3013C23.5307 32.9499 23.944 32.7525 24.375 32.7525ZM61.75 38.3732H52V4.64896C52.0023 3.98867 51.8532 3.33942 51.5678 2.76694C51.2825 2.19446 50.871 1.71909 50.375 1.38895C49.8809 1.06007 49.3205 0.886925 48.75 0.886925C48.1795 0.886925 47.6191 1.06007 47.125 1.38895L37.375 7.83402L27.625 1.38895C27.131 1.06007 26.5705 0.886925 26 0.886925C25.4295 0.886925 24.8691 1.06007 24.375 1.38895L14.625 7.83402L4.87502 1.38895C4.38096 1.06007 3.82052 0.886925 3.25002 0.886925C2.67953 0.886925 2.11909 1.06007 1.62502 1.38895C1.12906 1.71909 0.717565 2.19446 0.432205 2.76694C0.146844 3.33942 -0.00224797 3.98867 2.56194e-05 4.64896V64.6032C2.56194e-05 67.5846 1.02725 70.4439 2.85573 72.5521C4.68421 74.6602 7.16416 75.8446 9.75002 75.8446H55.25C57.8359 75.8446 60.3158 74.6602 62.1443 72.5521C63.9728 70.4439 65 67.5846 65 64.6032V42.1203C65 41.1265 64.6576 40.1734 64.0481 39.4707C63.4386 38.768 62.612 38.3732 61.75 38.3732ZM9.75002 68.3503C8.88807 68.3503 8.06142 67.9555 7.45193 67.2528C6.84243 66.5501 6.50002 65.597 6.50002 64.6032V11.1315L13 15.4032C13.5016 15.7053 14.0591 15.8631 14.625 15.8631C15.1909 15.8631 15.7484 15.7053 16.25 15.4032L26 8.95817L35.75 15.4032C36.2516 15.7053 36.8091 15.8631 37.375 15.8631C37.9409 15.8631 38.4984 15.7053 39 15.4032L45.5 11.1315V64.6032C45.5088 65.8815 45.7066 67.1487 46.085 68.3503H9.75002ZM58.5 64.6032C58.5 65.597 58.1576 66.5501 57.5481 67.2528C56.9386 67.9555 56.112 68.3503 55.25 68.3503C54.3881 68.3503 53.5614 67.9555 52.9519 67.2528C52.3424 66.5501 52 65.597 52 64.6032V45.8675H58.5V64.6032Z"
                        fill="#777777" />
                </svg>
                <p class="mt-2">Konfirmasi Pembayaran</p>
            </div>
        </div>
        <div class="row w-75 text-center ml-auto mr-auto">
            <div class="col-md-12">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row text-center">
                            <div class="col-md-3">
                                <img src="/{{ $donation->photo }}" class="card-img-top detail-donate-photo">
                            </div>
                            <div class="col-md-9 pt-4">
                                <h3 class="font-weight-bold title-donation-detail">
                                    {{ $donation->title }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <form action=" /donation/donate/{{ $donation->id }}" method="post">
            @csrf
            <div class="row w-75 ml-auto mr-auto mt-4">
                <div class="col-md-12">
                    <div class="modal-content">
                        <div class="modal-body p-4">
                            <h5 class="font-weight-bold">Isi Nominal Donasi&nbsp;<sup>*</sup></h5>
                            <div class="form-group">
                                <input type="text" class="form-control" id="nominal" name="nominal">
                                <small class="form-text text-muted">Donasi mulai dari Rp
                                    10,000,-</small>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="annonymousDonatur"
                                    name="annonymousDonatur">
                                <label class="form-check-label" for="annonymousDonatur">
                                    Donasi sebagai anonymus
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row w-75 ml-auto mr-auto mt-4">
                <div class="col-md-12">
                    <div class="modal-content">
                        <div class="modal-body p-4">
                            <h5 class="font-weight-bold">Nomor Rekening<sup>*</sup></h5>
                            <div class="form-group">
                                <input type="text" class="form-control" id="rekeningUser" name="rekeningUser">
                                <small class="form-text text-muted">Nomor rekening yang kamu
                                    gunakan</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row w-75 ml-auto mr-auto mt-4">
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
                    <button class="btn btn-danger btn-donate" type="submit">Konfirmasi
                        Pembayaran</button>
                </div>
            </div>
        </form>
    </div>
@endsection
