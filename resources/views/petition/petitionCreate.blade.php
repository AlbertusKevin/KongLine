@extends('layout.app')
@section('title')
    Buat Petisi
@endsection

@section('content')
    @include('layout.message')
    <div class="container">
        <form action="/petition/create" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mt-5 mb-5">
                <div class="col-md-10 offset-md-2 mb-5">
                    <h5 class="font-weight-bold">Pengajuan Event Petisi</h5>
                </div>
                <div class="col-md-5 offset-md-2">
                    <div class="form-group mb-5">
                        <label for="title">Judul Event</label>
                        <input type="text" class="form-control" id="title" name="title" aria-describedby="title"
                            placeholder="Judul Event" value="{{ old('title') }}">
                    </div>
                    <div class="form-group mb-5">
                        <label for="category">Kategori</label>
                        <select class="form-control" id="category" name="category" aria-describedby="category">
                            @foreach ($listCategory as $category)
                                <option {{ $category->id == old('category') ? 'selected' : '' }}
                                    value="{{ $category->id }}">{{ $category->description }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-5">
                        <label for="targetPerson">Target Petisi</label>
                        <input type="text" class="form-control" id="targetPerson" name="targetPerson"
                            placeholder="Kepada pihak mana petisi ini ditujukan" aria-describedby="targetPerson"
                            value="{{ old('targetPerson') }}">
                    </div>
                    <div class="form-group mb-5">
                        <label for="photo">Foto</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input choose-file" id="photo" name="photo">
                            <label class="custom-file-label" for="photo">Foto event petisi</label>
                        </div>
                    </div>
                    <div class="form-group mb-5 text-center">
                        <img src="{{ DEFAULT_FILE_PREVIEW }}" alt="" class="img-thumbnail img-preview">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="purpose">Deskripsi</label>
                        <textarea class="form-control" id="purpose" name="purpose" rows="10"
                            placeholder="Tuliskan deskripsi atau tujuan event ini"
                            aria-describedby="purpose">{{ old('purpose') }}</textarea>
                    </div>
                    <small class="text-muted" id="valid-length">Minimal 300 karakter</small>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="check-terms-agreement"
                            name="check-terms-agreement" {{ old('check-terms-agreement') == 'on' ? 'checked' : '' }}>
                        <label for="check-terms-agreement">Setuju dengan Syarat & Ketentuan
                            YukBisaYuk</label>
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-secondary verify-profile" data-toggle="modal"
                            data-target="#verification-petition"
                            {{ old('check-terms-agreement') == 'on' ? '' : 'disabled' }}>Verifikasi Profil</button>
                        <button type="submit" class="btn btn-secondary new-petition"
                            {{ old('check-terms-agreement') == 'on' ? '' : 'disabled' }}>Ajukan Event</button>
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
