@extends('layout.adminNavbar')

@section('title')
    Admin - Petition List
@endsection

@section('content')
    @include('layout.message')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="form-inline my-2 my-lg-0 justify-content-center">
                    <input class="form-control mr-sm-2 w-50 mt-5" id="search-petition" type="search" placeholder="Search"
                        aria-label="Search">
                    <input type="hidden" id="sort-by" value="None">
                    <input type="hidden" id="category-choosen" value="None">
                    <div class="dropdown mt-5 mr-2">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="sort-by" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Sort By:
                        </button>
                        <br>
                        <small class="text-muted" id="sort-label">None</small>
                        <div class="dropdown-menu" aria-labelledby="sort-by">
                            <a class="dropdown-item sort-petition font-weight-bold">None</a>
                            <a class="dropdown-item sort-petition">Jumlah Tanda Tangan</a>
                            <a class="dropdown-item sort-petition">Event Terbaru</a>
                        </div>
                    </div>
                    <div class="dropdown mt-5">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="category" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Category:
                        </button>
                        <br>
                        <small class="text-muted" id="category-label">None</small>
                        <div class="dropdown-menu" aria-labelledby="category">
                            <a class="dropdown-item category-petition font-weight-bold">None</a>
                            @foreach ($listCategory as $category)
                                <a class="dropdown-item category-petition">{{ $category->description }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="text-center mt-5">
                    <button href="/petition" type="button" class="btn btn-primary petition-type rounded-pill">Semua</button>
                    <button href="/petition" type="button"
                        class="btn btn-light petition-type rounded-pill ml-3">Berlangsung</button>
                    <button href="/petition" type="button" class="btn btn-light petition-type rounded-pill ml-3">Telah
                        Menang</button>
                    <button href="/petition" type="button"
                        class="btn btn-light petition-type rounded-pill ml-3">Dibatalkan</button>
                    <button href="/petition" type="button" class="btn btn-light petition-type rounded-pill ml-3">
                        Belum Valid</button>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12 text-center">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Tanggal Dibuat</th>
                            <th scope="col">Nama Petisi</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Target Tandatangan</th>
                            <th scope="col">Batas Waktu</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody id="petition-list">
                        @foreach ($petitionList as $petition)
                            <tr>
                                <td>{{ $petition->created_at }}</td>
                                <td><a href="/petition/{{ $petition->id }}">{{ $petition->title }}</a></td>
                                <td>{{ $petition->category }}</td>
                                <td>{{ $petition->signedTarget }}</td>
                                <td>{{ $petition->deadline }}</td>
                                <td>{{ $petition->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
