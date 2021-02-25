@extends('layout.app')

@section('content')

{{-- Untuk search dan sort --}}
<div class="jumbotron-donation"> 
    <div class="container p-5 mb-10">
        <h1 class="font-weight-bold text-white row">Donasi</h1>
        <h3 class="text-white row">Salurkan bantuan anda, bantu mereka yang memerlukan</h3>
        <div class="form-group row">
            <input class="col-9 transparent text-white" type="text" placeholder="Cari event yang ingin anda ikuti untuk berdonasi">
            {{-- <button type="submit" class="col img-thumbnail mr-3" style="background-image: url({{ asset('img/searchButton.png') }}); max-width:3.5%; height:auto; background-repeat: no-repeat; background-size:38px 40px"></button> --}}
            <button type="submit" class="col-0 button-search mr-4 text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
            </button>
            <div class="dropdown transparent text-white col-2 ml-0 ">
                <button class="btn dropdown-toggle text-white border" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Sort By:
                </button>
                <div class="dropdown-menu transparent text-white" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Waktu</a>
                    <a class="dropdown-item" href="#">Terkumpul</a>
                    <a class="dropdown-item" href="#">Sisa Target</a>
                    <a class="dropdown-item" href="#">Ikut Serta</a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Untuk Card Donation --}}
<div class="container px-5">
    {{-- Foreach --}}
    <div class="row card-top">
        <div class="card col m-2" style="padding: 0; ">
            <div style="position:relative;">
                <img src="{{ asset('img/baby.png') }}" class="card-img-top" alt="donation picture">
                <p class="donate-count" >10 Donatur</p>
                <p class= "time-left"> xx hari lagi</p>
            </div>
            <div class="card-body">
                <p class="card-text title-donation">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <h5 class="card-title">User</h5>
                <div class="row d-flex justify-content-between">
                    <p class="font-weight-bold col  text-left pl-3 mb-0">Rp. 1.378.920,-</p>
                    <p class="font-weight-bold col text-right pl-1 mb-0">Rp. 1.378.920,-</p>
                </div>
                <div class="row  d-flex justify-content-between">
                    <p class="font-weight-light col text-left pl-3 mb-0">Terkumpul</p>
                    <p class="font-weight-light col text-right pl-1 mb-0">Menuju Target</p>
                </div>
            </div>
        </div>
        <div class="card col m-2" style="padding: 0; ">
            <div style="position:relative;">
                <img src="{{ asset('img/baby.png') }}" class="card-img-top" alt="donation picture">
                <p class="donate-count" >10 Donatur</p>
                <p class= "time-left"> xx hari lagi</p>
            </div>
            <div class="card-body">
                <p class="card-text title-donation">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <h5 class="card-title">User</h5>
                <div class="row d-flex justify-content-between">
                    <p class="font-weight-bold col  text-left pl-3 mb-0">Rp. 1.378.920,-</p>
                    <p class="font-weight-bold col text-right pl-1 mb-0">Rp. 1.378.920,-</p>
                </div>
                <div class="row  d-flex justify-content-between">
                    <p class="font-weight-light col text-left pl-3 mb-0">Terkumpul</p>
                    <p class="font-weight-light col text-right pl-1 mb-0">Menuju Target</p>
                </div>
            </div>
        </div>
        <div class="card col m-2" style="padding: 0; ">
            <div style="position:relative;">
                <img src="{{ asset('img/baby.png') }}" class="card-img-top" alt="donation picture">
                <p class="donate-count" >10 Donatur</p>
                <p class= "time-left"> xx hari lagi</p>
            </div>
            <div class="card-body">
                <p class="card-text title-donation">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <h5 class="card-title">User</h5>
                <div class="row d-flex justify-content-between">
                    <p class="font-weight-bold col  text-left pl-3 mb-0">Rp. 1.378.920,-</p>
                    <p class="font-weight-bold col text-right pl-1 mb-0">Rp. 1.378.920,-</p>
                </div>
                <div class="row  d-flex justify-content-between">
                    <p class="font-weight-light col text-left pl-3 mb-0">Terkumpul</p>
                    <p class="font-weight-light col text-right pl-1 mb-0">Menuju Target</p>
                </div>
            </div>
        </div>
        
    </div>
    <div class="row card-top-row-2">
        <div class="card col m-2" style="padding: 0; ">
            <div style="position:relative;">
                <img src="{{ asset('img/baby.png') }}" class="card-img-top" alt="donation picture">
                <p class="donate-count" >10 Donatur</p>
                <p class= "time-left"> xx hari lagi</p>
            </div>
            <div class="card-body">
                <p class="card-text title-donation">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <h5 class="card-title">User</h5>
                <div class="row d-flex justify-content-between">
                    <p class="font-weight-bold col  text-left pl-3 mb-0">Rp. 1.378.920,-</p>
                    <p class="font-weight-bold col text-right pl-1 mb-0">Rp. 1.378.920,-</p>
                </div>
                <div class="row  d-flex justify-content-between">
                    <p class="font-weight-light col text-left pl-3 mb-0">Terkumpul</p>
                    <p class="font-weight-light col text-right pl-1 mb-0">Menuju Target</p>
                </div>
            </div>
        </div>
        <div class="card col m-2" style="padding: 0; ">
            <div style="position:relative;">
                <img src="{{ asset('img/baby.png') }}" class="card-img-top" alt="donation picture">
                <p class="donate-count" >10 Donatur</p>
                <p class= "time-left"> xx hari lagi</p>
            </div>
            <div class="card-body">
                <p class="card-text title-donation">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <h5 class="card-title">User</h5>
                <div class="row d-flex justify-content-between">
                    <p class="font-weight-bold col  text-left pl-3 mb-0">Rp. 1.378.920,-</p>
                    <p class="font-weight-bold col text-right pl-1 mb-0">Rp. 1.378.920,-</p>
                </div>
                <div class="row  d-flex justify-content-between">
                    <p class="font-weight-light col text-left pl-3 mb-0">Terkumpul</p>
                    <p class="font-weight-light col text-right pl-1 mb-0">Menuju Target</p>
                </div>
            </div>
        </div>
        <div class="card col m-2" style="padding: 0; ">
            <div style="position:relative;">
                <img src="{{ asset('img/baby.png') }}" class="card-img-top" alt="donation picture">
                <p class="donate-count" >10 Donatur</p>
                <p class= "time-left"> xx hari lagi</p>
            </div>
            <div class="card-body">
                <p class="card-text title-donation">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <h5 class="card-title">User</h5>
                <div class="row d-flex justify-content-between">
                    <p class="font-weight-bold col  text-left pl-3 mb-0">Rp. 1.378.920,-</p>
                    <p class="font-weight-bold col text-right pl-1 mb-0">Rp. 1.378.920,-</p>
                </div>
                <div class="row  d-flex justify-content-between">
                    <p class="font-weight-light col text-left pl-3 mb-0">Terkumpul</p>
                    <p class="font-weight-light col text-right pl-1 mb-0">Menuju Target</p>
                </div>
            </div>
        </div>
        
    </div><div class="row card-top-row-2">
        <div class="card col m-2" style="padding: 0; ">
            <div style="position:relative;">
                <img src="{{ asset('img/baby.png') }}" class="card-img-top" alt="donation picture">
                <p class="donate-count" >10 Donatur</p>
                <p class= "time-left"> xx hari lagi</p>
            </div>
            <div class="card-body">
                <p class="card-text title-donation">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <h5 class="card-title">User</h5>
                <div class="row d-flex justify-content-between">
                    <p class="font-weight-bold col  text-left pl-3 mb-0">Rp. 1.378.920,-</p>
                    <p class="font-weight-bold col text-right pl-1 mb-0">Rp. 1.378.920,-</p>
                </div>
                <div class="row  d-flex justify-content-between">
                    <p class="font-weight-light col text-left pl-3 mb-0">Terkumpul</p>
                    <p class="font-weight-light col text-right pl-1 mb-0">Menuju Target</p>
                </div>
            </div>
        </div>
        <div class="card col m-2" style="padding: 0; ">
            <div style="position:relative;">
                <img src="{{ asset('img/baby.png') }}" class="card-img-top" alt="donation picture">
                <p class="donate-count" >10 Donatur</p>
                <p class= "time-left"> xx hari lagi</p>
            </div>
            <div class="card-body">
                <p class="card-text title-donation">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <h5 class="card-title">User</h5>
                <div class="row d-flex justify-content-between">
                    <p class="font-weight-bold col  text-left pl-3 mb-0">Rp. 1.378.920,-</p>
                    <p class="font-weight-bold col text-right pl-1 mb-0">Rp. 1.378.920,-</p>
                </div>
                <div class="row  d-flex justify-content-between">
                    <p class="font-weight-light col text-left pl-3 mb-0">Terkumpul</p>
                    <p class="font-weight-light col text-right pl-1 mb-0">Menuju Target</p>
                </div>
            </div>
        </div>
        <div class="card col m-2" style="padding: 0; ">
            <div style="position:relative;">
                <img src="{{ asset('img/baby.png') }}" class="card-img-top" alt="donation picture">
                <p class="donate-count" >10 Donatur</p>
                <p class= "time-left"> xx hari lagi</p>
            </div>
            <div class="card-body">
                <p class="card-text title-donation">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <h5 class="card-title">User</h5>
                <div class="row d-flex justify-content-between">
                    <p class="font-weight-bold col  text-left pl-3 mb-0">Rp. 1.378.920,-</p>
                    <p class="font-weight-bold col text-right pl-1 mb-0">Rp. 1.378.920,-</p>
                </div>
                <div class="row  d-flex justify-content-between">
                    <p class="font-weight-light col text-left pl-3 mb-0">Terkumpul</p>
                    <p class="font-weight-light col text-right pl-1 mb-0">Menuju Target</p>
                </div>
            </div>
        </div>
    </div>
    
      {{-- @endforeach --}}
    <nav>
        <ul class="pagination justify-content-center mt-3">
            <li class="page-item page-link page-link pagination-donation border text-white">Page x of xx</li>
            <li class="page-item"><a class="page-link pagination-donation border text-white" href="#">Next > </a></li>
            <li class="page-item"><a class="page-link pagination-donation border text-white" href="#">Last >> </a></li>
        </ul>
    </nav>
</div>
    
@endsection