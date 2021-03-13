@extends('layout.app')
@section('title')
    Petition's Progress
@endsection

@section('content')
    <div class="container">
        <h2 class="mt-3" style="color: #1167B1">{{ $petition->title }}</h2>
        <small><a href="/petition" style="color: blue">-> kembali ke daftar petisi</a></small>
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
                    <div class="mb-5 ml-auto mr-auto mt-5" style="max-width: 800px;">
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
                                <p class="card-text petition-description">{{ $news->content }}</p>
                                @if ($news->link != null)
                                    <small class="text-muted"><a href="{{ $news->link }}"
                                            target="_blank">{{ $news->link }}</a></small>
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
        @if ($user->id == $petition->idCampaigner && $petition->status != 0)
            <div class="col-md-3 text-center" style="margin-top: 100px">
                <h6 class="font-weight-bold">Sudah ada Perkembangan?</h6>
                <p class="ml-2">Tetap perbarui informasi dari perjuangan petisi ini</p>
                <button type="button" class="btn btn-primary ml-2" data-toggle="modal"
                    data-target="#formCreateProgress">Buat
                    Perkembangan</button>
            </div>
        @endif

    </div>
    </div>

    <div class="modal fade" id="formCreateProgress" tabindex="-1" aria-labelledby="formCreateProgressLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formCreateProgressLabel">Buat Perkembangan Petisimu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/petition/progress/{{ $petition->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="title" class="col-sm-3 offset-md-1 col-form-label">Judul</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="content" class="col-sm-3 offset-md-1 col-form-label">Isi Berita</label>
                            <div class="col-sm-7">
                                <textarea class="form-control" id="content" name="content" rows="10"
                                    placeholder="ketikkan berita terbaru"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-sm-3 offset-md-1 col-form-label">Gambar</label>
                            <div class="col-sm-7">
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="link" class="col-sm-3 offset-md-1 col-form-label">Tautan</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" id="link" name="link">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
