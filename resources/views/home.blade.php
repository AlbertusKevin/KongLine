@extends('layout.app')

@section('content')

{{--  <div class="container">  --}}
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="img/donation1.png" class="d-block w-100" alt="img 1">
          </div>
          <div class="carousel-item">
            <img src="img/donation2.png" class="d-block w-100" alt="img 2">
          </div>
          <div class="carousel-item">
            <img src="img/donation3.png" class="d-block w-100" alt="img 3">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
{{--  </div>  --}}
  
  
  <section class= "container mt-5">
    <h2>Donasi</h2>
    <div class= "row">
      {{-- @foreach() --}}
      <div class="card col m-2" style="padding: 0; ">
        <div style="position:relative;">
          <img src="{{ asset('img/donation3.png') }}" class="card-img-top" alt="donation picture">
          <p  class="donate-count" >10 Donatur</p>
        </div>
        <div class="card-body">
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          <h5 class="card-title">User</h5>
          <a href="#" class=" w-100 btn btn-primary">Donate</a>
        </div>
      </div>
      <div class="card col m-2">
        <img src="{{ asset('img/donation3.png') }}" class="card-img-top" alt="donation picture">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
      <div class="card col m-2">
        <img src="{{ asset('img/donation3.png') }}" class="card-img-top" alt="donation picture">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
      {{-- @endforeach --}}
    </div>
    
  </section>
  
@endsection