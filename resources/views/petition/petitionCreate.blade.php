@extends('layout.app')
@section('title')
    New Petition
@endsection

@section('content')
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
                            placeholder="Judul Event">
                    </div>
                    <div class="form-group mb-5">
                        <label for="category">Kategori</label>
                        <select class="form-control" id="category" name="category" aria-describedby="category">
                            @foreach ($listCategory as $category)
                                <option value="{{ $category->id }}">{{ $category->description }}</option>
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
                            aria-describedby="targetPerson">
                    </div>
                    <div class="form-group mb-5">
                        <label for="signedTarget">Target Jumlah Tandatangan</label>
                        <input type="text" class="form-control" id="signedTarget" name="signedTarget"
                            aria-describedby="signedTarget">
                    </div>
                    <div class="form-group mb-5">
                        <label for="deadline">Batas Waktu</label>
                        <input type="date" class="form-control" id="deadline" name="deadline" aria-describedby="deadline"
                            placeholder="pilih waktu">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="purpose">Deskripsi</label>
                        <textarea class="form-control" id="purpose" name="purpose" rows="10"
                            placeholder="Tuliskan deskripsi atau tujuan event ini" aria-describedby="purpose"></textarea>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="check-terms-agreement">
                        <label for="check-terms-agreement">Setuju dengan Syarat & Ketentuan
                            YukBisaYuk</label>
                    </div>
                    <button type="submit" class="btn btn-new-petition">Ajukan Event</button>
                </div>
            </div>
        </form>
    </div>

@endsection
