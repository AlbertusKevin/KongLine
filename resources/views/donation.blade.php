@extends('layout.app')

@section('content')

{{-- Untuk search dan sort --}}
<div style="background-image: url({{ asset('img/donationHome.png') }}); background-size:1440px 528px" class="mh-10"> 
        <div class="container p-5 mr-15">
                <h1 class="font-weight-bold text-white row">Donasi</h1>
                <h3 class="text-white row">Salurkan bantuan anda, bantu mereka yang memerlukan</h3>
                <div class="form-group row">
                    <input class="form-control text-white col-8" type="text" placeholder="Cari event yang ingin anda ikuti untuk berdonasi" style="background-color: transparent; color:white">
                    <button type="submit" class="col img-thumbnail mr-3" style="background-image: url({{ asset('img/searchButton.png') }}); max-width:3.5%; height:auto; background-repeat: no-repeat; background-size:38px 40px"></button>
                    <select class="form-control col-2" name="sort" id="sortType" style="background-color: transparent; color:white">
                        <option selected>Sort By:</option>
                        <option>Waktu</option>
                        <option>Terkumpul</option>
                        <option>Sisa Target</option>
                        <option>Ikut Serta</option>
                    </select>
                </div>
        </div>
</div>

{{-- Untuk Card Donation --}}
<div class="container px-5">
    {{-- Foreach --}}
    <div class="row">
        <div class="card col m-2" style="padding: 0; ">
            <div style="position:relative;">
              <img src="{{ asset('img/baby.png') }}" class="card-img-top" alt="donation picture">
              <p  class="donate-count" >10 Donatur</p>
              <p class="donate-count top"> xx hari lagi</p>
            </div>
            <div class="card-body">
              <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
              <h5 class="card-title">User</h5>
              <a href="#" class=" w-100 btn btn-primary">Donate</a>
            </div>
        </div>
        <div class="card col m-2" style="padding: 0; ">
            <div style="position:relative;">
                <img src="{{ asset('img/baby.png') }}" class="card-img-top" alt="donation picture">
                <p  class="donate-count" >10 Donatur</p>
            </div>
            <div class="card-body">
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <h5 class="card-title">User</h5>
                <a href="#" class=" w-100 btn btn-primary">Donate</a>
            </div>
        </div>
        <div class="card col m-2" style="padding: 0; ">
            <div style="position:relative;">
                <img src="{{ asset('img/baby.png') }}" class="card-img-top" alt="donation picture">
                <p  class="donate-count" >10 Donatur</p>
            </div>
            <div class="card-body">
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <h5 class="card-title">User</h5>
                <a href="#" class=" w-100 btn btn-primary">Donate</a>
            </div>
        </div>
    </div>
      {{-- @endforeach --}}
</div>
    
@endsection