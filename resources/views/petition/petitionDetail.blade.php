@extends($navbar)

@section('title')
    Petition Detail
@endsection
@section('content')
    @include('layout.message')
    <div class="container">
        <h2 class="mt-3" style="color: #1167B1">{{ $petition->title }}</h2>
        @if ($user->role != ADMIN)
            <small><a href="/petition" style="color: blue">-> kembali ke daftar petisi</a></small>
        @endif
        <div class="text-center mt-5">
            <a href="/petition/{{ $petition->id }}" type="button" class="btn btn-primary rounded-pill">Detail
                Petisi</a>
            <a href="/petition/comments/{{ $petition->id }}" type="button"
                class="btn btn-light rounded-pill ml-3">Komentar</a>
            <a href="/petition/progress/{{ $petition->id }}" type="button"
                class="btn btn-light rounded-pill ml-3">Perkembangan</a>
        </div>
        <div class="row">
            <div class="col-md-8 mt-3">
                <hr>
                <img src="{{ $petition->photo }}" class="image-detail-petition" alt="detail petisi">
                <p class="mt-3 petition-detail-description">{{ $petition->purpose }}</p>
            </div>
            <div class="col-md-4">
                @if ($petition->status == 1)
                    @if ($user->role == GUEST)
                        <h4 class="mt-5 ml-4">{{ $petition->signedCollected }} dari {{ $petition->signedTarget }} </h4>
                        <p class="ml-4">Orang telah menendatangani Petisi ini !</p>
                        <div class="row row-cols-2">
                            <div class="col-md-10 offset-md-1 text-center">
                                <h4 class="font-weight-bold">Daftarkan dirimu sekarang untuk menandatangani petisi.</h4>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12 text-center">
                                <a href="/register" type="button" class="btn btn-primary">Daftar</a>
                            </div>
                        </div>
                    @elseif($user->role == ADMIN)
                        <form action="/admin/petition/close/{{ $petition->id }}" method="POST">
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
                        <h4 class="mt-3 font-weight-bold">{{ $petition->signedCollected }} dari
                            {{ $petition->signedTarget }} </h4>
                        <p class="font-weight-bold">Orang telah menendatangani Petisi ini !</p>
                    @else
                        @if ($isParticipated)
                            <h4 class="mt-5 ml-4">{{ number_format($petition->signedCollected) }} dari
                                {{ number_format($petition->signedTarget) }} </h4>
                            <p class="ml-4">Orang telah menendatangani Petisi ini !</p>
                            <div class="row row-cols-2">
                                <div class="col-md-10 offset-md-1 text-center">
                                    <h4 class="font-weight-bold">Terimakasih sudah menandatangani petisi ini</h4>
                                </div>
                            </div>
                        @else
                            <form action="/petition/{{ $petition->id }}" method="POST">
                                @csrf
                                <h4 class="mt-5 ml-4">{{ $petition->signedCollected }} dari
                                    {{ $petition->signedTarget }}
                                </h4>
                                <p class="ml-4">Orang telah menendatangani Petisi ini !</p>
                                <div class="row row-cols-2">
                                    <div class="col-sm-4"><img src="{{ $user->photoProfile }}" alt="petition profile"
                                            class="ml-4 img-thumbnail">
                                    </div>
                                    <div class="col-sm-8"><b>{{ $user->name }}</b>
                                        <input class="form-control form-control-sm form-rounded mt-2" type="text"
                                            placeholder="Tulis Komentarmu" name="petitionComment">
                                    </div>
                                </div>
                                <div class="row ml-5 mt-5">
                                    <input type="checkbox" class="form-check-input" id="check-privacy-policy">
                                    <label class="form-check-label" for="check-privacy-policy">Saya menyetujui kebijakan
                                        privasi</label>
                                </div>
                                <div class="row mt-4 ml-4">
                                    <button type="submit" class="btn btn-primary" id="sign-petition-button" disabled>
                                        Tanda Tangani Petisi Ini
                                    </button>
                                </div>
                            </form>
                        @endif
                    @endif
                @else
                    @if ($user->role != ADMIN)
                        <div class="row mt-5">
                            <div class="col-md-10 offset-md-2">
                                <div class="card bg-light mb-3" style="max-width: 18rem;">
                                    <h5 class="card-header text-center font-weight-bold">{{ $message['header'] }}</h5>
                                    <div class="card-body">
                                        <p class="card-text">{{ $message['content'] }}
                                        </p>
                                        <a href="/inbox" type="button"
                                            class="btn btn-outline-secondary btn-sm rounded-pill">Hubungi
                                            Admin</a>
                                    </div>
                                </div>
                                @if ($petition->status == NOT_CONFIRMED || $petition->status == REJECTED)
                                    <small>
                                        <a href="/petition/edit/{{ $petition->id }}">Perbarui Data Petisi</a>
                                    </small>
                                @endif
                            </div>
                        </div>
                    @else
                        @if ($petition->status == 0)
                            <form action="/admin/petition/reject/{{ $petition->id }}" method="POST">
                                @csrf
                                @method('patch')
                                <div class="form-group">
                                    <label for="rejectEvent">
                                        <h3 class="font-weight-bold mt-5">Alasan Ditolak</h3>
                                    </label>
                                    <textarea class="form-control" id="rejectEvent" name="rejectEvent" rows="3"></textarea>
                                </div>
                                <button type="submit" class="btn btn-danger close-event">Tolak Event</button>
                            </form>
                            <form action="/admin/petition/accept/{{ $petition->id }}" method="POST">
                                @csrf
                                @method('patch')
                                <button type="submit" class="btn btn-primary approve-event mt-3">Setujui Event</button>
                            </form>
                        @endif
                    @endif
                @endif
            </div>

        </div>
    </div>
@endsection
