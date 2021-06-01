@extends($navbar)

@section('title')
    Berita Perkembangan Petisi
@endsection

@section('content')
    @include('layout.message')
    <div class="container">
        <h2 class="mt-3" style="color: #1167B1">{{ $petition->title }}</h2>
        @if ($user->role != ADMIN)
            <small><a href="/petition" style="color: blue">-> kembali ke daftar petisi</a></small>
        @endif
        <div class="text-center mt-5">
            <a href="/petition/{{ $petition->id }}" type="button" class="btn btn-light rounded-pill">Detail Petisi</a>
            <a href="/petition/comments/{{ $petition->id }}" type="button"
                class="btn btn-light rounded-pill ml-3">Komentar</a>
            <a href="/petition/progress/{{ $petition->id }}" type="button"
                class="btn btn-primary rounded-pill ml-3">Perkembangan</a>
        </div>
        <div class="row">
            @if ($user->id == $petition->idCampaigner && $petition->status == 0)
                <div class="col-md-8 mb-5 ml-auto mr-auto mt-5" style="max-width: 800px;">
                @else
                    <div class="col-md-12 mb-5 ml-auto mr-auto mt-5" style="max-width: 800px;">
            @endif
            <div class="mb-5">
                <h3 class="font-weight-bold">Berita Terbaru</h3>
                <hr>
                <p>Ikuti perkembangan terbaru mengenai petisi ini</p>
            </div>
            @if (count($news) == 0)
                @if ($user->id == $petition->idCampaigner && $petition->status != 0)
                    <div class="card">
                        <div class="row no-gutters">
                            <div class="col-md-8 text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Belum ada berita mengenai petisi ini</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="row no-gutters">
                            <div class="col-md-12 text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Belum ada berita mengenai petisi ini</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
            @foreach ($news as $news)
                <div class="card mb-4">
                    <div class=" row no-gutters">
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold">{{ $news->title }}</h5>
                                @if ($news->link != null)
                                    <small class="text-muted"><a href="{{ $news->link }}"
                                            target="_blank">{{ $news->link }}</a></small>
                                @endif
                                <p class="card-text petition-description">{{ $news->content }}</p>
                                <button type="button" class="btn btn-info news-detail" data-toggle="modal"
                                    data-target="#detailNews" data-id="{{ $news->id }}">Detail</button>
                            </div>
                        </div>
                        <div class="col-md-4 text-center p-3">
                            <img src="{{ $news->image }}" class="img-progress-petition" alt="News Image">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @if ($user->id == $petition->idCampaigner && $petition->status != 0)
            <div class="col-md-3 text-center" style="margin-top: 100px">
                <h6 class="font-weight-bold">Sudah ada Perkembangan?</h6>
                <p class="ml-2">Tetap perbarui informasi dari perjuangan petisi ini</p>
                <button type="button" class="btn btn-primary ml-2" data-toggle="modal" data-target="#formCreateProgress"
                    id="create-news">Buat
                    Perkembangan</button>
            </div>
        @endif

    </div>
    </div>

    @include('petition.progress.progressDetail')
    @include('petition.progress.progressEditForm')
    @include('petition.progress.progressCreateForm')
@endsection
