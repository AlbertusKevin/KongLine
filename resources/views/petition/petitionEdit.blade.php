@extends('layout.app')
@section('title')
    Edit Petition
@endsection

@section('content')
    @include('layout.message')
    <div class="container">
        <form action="/petition/{{ $petition->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row mt-5 mb-5">
                <div class="col-md-10 offset-md-2 mb-5">
                    <h5 class="font-weight-bold">Pengajuan Event Petisi</h5>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group mb-5">
                        <label for="title">Judul Event</label>
                        <input type="text" class="form-control" id="title" name="title" aria-describedby="title"
                            placeholder="Judul Event" value="{{ $petition->title }}">
                    </div>
                    <div class="form-group mb-5">
                        <label for="category">Kategori</label>
                        <select class="form-control" id="category" name="category" aria-describedby="category">
                            @foreach ($listCategory as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->description }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-5">
                        <label for="photo">Foto</label>
                        <input type="file" class="form-control" id="photo" name="photo" aria-describedby="photo">
                    </div>
                    <div class="form-group mb-5">
                        <label for="targetPerson">Target Petisi</label>
                        <input type="text" class="form-control" id="targetPerson" name="targetPerson"
                            placeholder="Kepada pihak mana petisi ini ditujukan" aria-describedby="targetPerson"
                            value="{{ $petition->targetPerson }}">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="purpose">Deskripsi</label>
                        <textarea class="form-control" id="purpose" name="purpose" rows="10"
                            placeholder="Tuliskan deskripsi atau tujuan event ini"
                            aria-describedby="purpose">{{ $petition->purpose }}</textarea>
                        <small class="text-muted" id="valid-length">Max: 300 karakter</small>
                    </div>
                    <div class="form-group">
                        @if ($petition->status == NOT_CONFIRMED)
                            <button type="submit" class="btn btn-secondary new-petition">Perbarui Event</button>
                        @else
                            <button type="submit" class="btn btn-secondary new-petition">Ajukan Kembali</button>
                        @endif
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="modal fade" id="verification-petition" tabindex="-1" role="dialog" aria-labelledby="verification-petition"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="modal-title mb-3 font-weight-bold text-center" id="verification-petition">Verifikasi Data
                        Diri Anda</h5>
                    <form action="/event/create/verification" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="phone" placeholder="No Telp">
                        </div>
                        <div class="form-group text-right">
                            <button type="button" class="btn btn-primary verification-create">Verifikasi</button>
                            <button type="button" class="btn btn-secondary close-dismiss"
                                data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
