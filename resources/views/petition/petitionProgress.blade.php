@extends('layout.app')
@section('title')
    Petition's Progress
@endsection

@section('content')
    <div class="container">
        <h2 class="mt-3" style="color: #1167B1">{{ $petition->title }}</h2>
        <div class="text-center mt-5">
            <a href="/petition/{{ $petition->id }}" type="button" class="btn btn-light rounded-pill">Detail Petisi</a>
            <a href="/petition/comments/{{ $petition->id }}" type="button"
                class="btn btn-light rounded-pill ml-3">Komentar</a>
            <a href="/petition/progress/{{ $petition->id }}" type="button"
                class="btn btn-primary rounded-pill ml-3">Perkembangan</a>
        </div>
        <div class="mb-5 ml-auto mr-auto mt-5" style="max-width: 800px;">
            <div class="mb-5">
                <h3 class="font-weight-bold">Berita Terbaru</h3>
                <hr>
                <p>Ikuti perkembangan terbaru mengenai petisi ini</p>
            </div>
            @if (count($news) == 0)
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
            @foreach ($news as $news)
                <div class="card mb-4">
                    <div class=" row no-gutters">
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title font-weight-bold">{{ $news->title }}</h5>
                                <p class="card-text petition-description">{{ $news->content }}</p>
                                @if ($news->link != null)
                                    <small class="text-muted">{{ $news->link }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <img src="/{{ $news->image }}" class="img-thumbnail" alt="News Image">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
