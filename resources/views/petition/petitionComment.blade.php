@extends('layout.app')
@section('title')
    Petition's Comments
@endsection

@section('content')
    <div class="container">
        <h2 class="mt-3" style="color: #1167B1">{{ $petition->title }}</h2>
        <small><a href="/petition" style="color: blue">-> kembali ke daftar petisi</a></small>
        <div class="text-center mt-5">
            <a href="/petition/{{ $petition->id }}" type="button" class="btn btn-light rounded-pill">Detail Petisi</a>
            <a href="/petition/comments/{{ $petition->id }}" type="button"
                class="btn btn-primary rounded-pill ml-3">Komentar</a>
            <a href="/petition/progress/{{ $petition->id }}" type="button"
                class="btn btn-light rounded-pill ml-3">Perkembangan</a>
        </div>
        <div class="mb-5 ml-auto mr-auto mt-5" style="max-width: 800px;">
            <div class="mb-5">
                <h3 class="font-weight-bold">Alasan Menandatangani</h3>
                <hr>
                <p>Lihat mengapa orang lain menandatangani petisi, mengapa petisi ini penting untuk mereka, dan tulis alasan
                    mu
                    untuk menandatangani</p>
            </div>
            @if (count($comments) == 0)
                <div class="card">
                    <div class="row no-gutters">
                        <div class="col-md-12 text-center">
                            <div class="card-body">
                                <h5 class="card-title">Belum ada yang berkomentar pada petisi ini</h5>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @foreach ($comments as $comment)
                @if ($comment->comment != null)
                    <div class="card mb-4">
                        <div class=" row no-gutters">
                            <div class="col-md-4 text-center">
                                <img src="/{{ $comment->photoProfile }}" class="img-thumbnail"
                                    alt="Participant's Image Profile">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title font-weight-bold">{{ $comment->name }}</h5>
                                    <p class="card-text petition-description">{{ $comment->comment }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>

@endsection
