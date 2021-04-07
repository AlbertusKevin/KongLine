@if ($user->role != ADMIN)
    @extends('layout.app')
@else
    @extends('layout.adminNavbar')
@endif

@section('content')
    @include('layout.message')
    {{-- Untuk search dan sort --}}
    <div class="jumbotron-donation">
        <div class="container p-5">
            <h1 class="font-weight-bold text-white row">Donasi</h1>
            <h4 class="text-white row">Salurkan bantuan anda, bantu mereka yang memerlukan</h4>
            <div class="row">
                <input type="hidden" id="category-donation-selected" value="None">
                <input type="hidden" id="sort-donation-selected" value="None">
                <input class="col-md-8 transparent text-white mr-2" type="text" id="search-donation"
                    placeholder="Cari event yang ingin anda ikuti untuk berdonasi">
                <div class="dropdown transparent text-white mr-2">
                    <button class="btn dropdown-toggle text-white border" type="button" id="dropdown-sort"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Urutkan
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdown-sort">
                        <a class="dropdown-item sort-select-donation active">None</a>
                        <a class="dropdown-item sort-select-donation">Tenggat Waktu</a>
                        {{-- <a class="dropdown-item sort-select-donation">Sisa Target</a> --}}
                        <a class="dropdown-item sort-select-donation">Sedikit Terkumpul</a>
                        @if ($user->role == 'campaigner')
                            <a class="dropdown-item sort-select-donation">Donasi Saya</a>
                        @endif
                        @if ($user->role == 'campaigner' || $user->role == 'participant')
                            <a class="dropdown-item sort-select-donation">Ikut Serta</a>
                        @endif
                    </div>
                </div>
                <div class="dropdown transparent text-white">
                    <button class="btn dropdown-toggle text-white border" type="button" id="dropdown-category"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Kategori
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdown-category">
                        <a class="dropdown-item category-select-donation active">None</a>
                        @foreach ($categories as $category)
                            <a class="dropdown-item category-select-donation">{{ $category->description }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            @if ($user->role == CAMPAIGNER)
                <div class="row mt-3">
                    <a type="button" href="/donation/create" class="btn btn-create-donation">Ajukan Donasi</a>
                </div>
            @endif
        </div>
    </div>

    {{-- Untuk Card Donation --}}
    <div class="container px-5">
        <div class="row card-top" id="donation-list">
            @foreach ($donations as $donation)
                <div class="card col-md-4 p-2 mb-5" style="width: 18rem;">
                    <div style=" position:relative;">
                        <img src="{{ $donation->photo }}" class="img-donation card-img-top"
                            alt="{{ $donation->title }} donation's picture">
                        <p class="donate-count">{{ $donation->totalDonatur }} Donatur</p>
                        <p class="time-left">
                            @if (ceil((strtotime($donation->deadline) - time()) / (60 * 60 * 24)) > 0)
                            {{ ceil((strtotime($donation->deadline) - time()) / (60 * 60 * 24)) }}
                            hari lagi
                        @else
                            Selesai
            @endif
            </p>
        </div>
        <div class="card-body">
            <h5 class="card-title title-donation"><a href="/donation/{{ $donation->id }}">{{ $donation->title }}</a>
            </h5>
            <p class="card-text ">{{ $donation->name }}</p>
            <div class="row d-flex justify-content-between">
                <p class="font-weight-bold text-left pl-3">Rp.
                    {{ number_format($donation->donationCollected, 2, ',', '.') }}
                </p>
                <p class="font-weight-bold text-right">
                    @if ($donation->donationTarget - $donation->donationCollected >= 0)
                        Rp.
                        {{ number_format($donation->donationTarget - $donation->donationCollected, 2, ',', '.') }}
                    @else
                        Rp. {{ number_format($donation->donationTarget, 2, ',', '.') }}
                    @endif
                </p>
            </div>
            <div class="row  d-flex justify-content-between">
                <p class="font-weight-light text-left pl-3 mb-0">Terkumpul</p>
                @if ($donation->donationTarget - $donation->donationCollected >= 0)
                    <p class="font-weight-light text-right pl-1 mb-0">Menuju Target</p>
                @else
                    <p class="font-weight-light text-right pl-1 mb-0">Mencapai Target</p>
                @endif
            </div>
        </div>
    </div>
    @endforeach
    </div>
    {{-- <nav>
            <ul class="pagination justify-content-center mt-3">
                <li class="page-item page-link page-link pagination-donation border text-white">Page x of xx</li>
                <li class="page-item"><a class="page-link pagination-donation border text-white" href="#">Next > </a></li>
                <li class="page-item"><a class="page-link pagination-donation border text-white" href="#">Last >> </a></li>
            </ul>
        </nav> --}}
    </div>

@endsection
