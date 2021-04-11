@extends('layout.adminNavbar')

@section('title')
    Admin - Donation List
@endsection

@section('content')
    @include('layout.message')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="form-inline my-2 my-lg-0 justify-content-center">
                    <input class="form-control mr-sm-2 w-50 mt-5" id="search-donation" type="search" placeholder="Search"
                        aria-label="Search">
                    <input type="hidden" id="category-donation-selected" value="None">
                    <input type="hidden" id="sort-donation-selected" value="None">
                    <div class="dropdown mt-5 mr-2">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="sort-by" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            Sort By
                        </button>
                        <div class="dropdown-menu" aria-labelledby="sort-by">
                            <a class="dropdown-item sort-select-donation font-weight-bold">None</a>
                            <a class="dropdown-item sort-select-donation">Tenggat Waktu</a>
                            <a class="dropdown-item sort-select-donation">Sedikit Terkumpul</a>
                        </div>
                    </div>
                    <div class="dropdown mt-5">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdown-category"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Category
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdown-category">
                            <a class="dropdown-item category-select-donation font-weight-bold">None</a>
                            @foreach ($listCategory as $category)
                                <a class="dropdown-item category-select-donation">{{ $category->description }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="text-center mt-5">
                    <button href="/petition" type="button" class="btn btn-primary donation-type rounded-pill">Semua</button>
                    <button href="/petition" type="button"
                        class="btn btn-light donation-type rounded-pill ml-3">Berlangsung</button>
                    <button href="/petition" type="button"
                        class="btn btn-light donation-type rounded-pill ml-3">Selesai</button>
                    <button href="/petition" type="button"
                        class="btn btn-light donation-type rounded-pill ml-3">Dibatalkan</button>
                    <button href="/petition" type="button" class="btn btn-light donation-type rounded-pill ml-3">
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
                            <th scope="col">Nama Donasi</th>
                            <th scope="col">Kategori</th>
                            <th scope="col">Target Donasi</th>
                            <th scope="col">Batas Waktu</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody id="donation-list">
                        @foreach ($donationList as $donation)
                            <tr>
                                <td>{{ $donation->created_at }}</td>
                                <td><a href="/donation/{{ $donation->id }}">{{ $donation->title }}</a></td>
                                <td>{{ $donation->category }}</td>
                                <td>Rp. {{ number_format($donation->donationTarget, 2, ',', '.') }}</td>
                                <td>{{ $donation->deadline }}</td>
                                <td>{{ $donation->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
