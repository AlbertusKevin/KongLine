@extends('layout.app')

@section('content')

<div class="container">
    <h2 class="mt-3">Daftar Petisi</h2>
    <hr>
    <p>Lihat Petisi yang Sedang Berlangsung</p>
    <div class="text-center mt-5">
        <button type="button" class="btn btn-primary rounded-pill">Berlangsung</button>
        <button type="button" class="btn btn-light rounded-pill ml-3">Telah Menang</button>
        <button type="button" class="btn btn-light rounded-pill ml-3">Ikut Serta</button>
    </div>
    <form class="form-inline my-2 my-lg-0 justify-content-center">
        <input class="form-control mr-sm-2 w-50 mt-5" type="search" placeholder="Search" aria-label="Search">
        <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle mt-5">Sort By</button>
    </form>
    <div class="card mb-3 ml-auto mr-auto mt-5" style="max-width: 650px;">
        <div class="row no-gutters">
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio odit minima quis sit in velit dignissimos inventore quos soluta impedit, vel nisi corporis modi aspernatur iure suscipit asperiores aliquam animi non voluptatem enim id accusantium distinctio? Temporibus totam cumque consequatur.</p>
              <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
          </div>
          <div class="col-md-4">
            <img src="img/petition1.png" alt="petition 1">
          </div>
        </div>
    </div>

    <div class="card mb-3 ml-auto mr-auto mt-5" style="max-width: 650px;">
        <div class="row no-gutters">
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
          </div>
          <div class="col-md-4">
            <img src="img/petition2.png" alt="petition 2">
          </div>
        </div>
    </div>

    <div class="card mb-3 ml-auto mr-auto mt-5" style="max-width: 650px;">
        <div class="row no-gutters">
          <div class="col-md-8">
            <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              <p class="card-text"><small class="text-muted"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-flag-fill" viewBox="0 0 16 16">
                <path d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12.435 12.435 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A19.626 19.626 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a19.587 19.587 0 0 0 1.349-.476l.019-.007.004-.002h.001"/>
              </svg>Last updated 3 mins ago</small></p>
            </div>
          </div>
          <div class="col-md-4">
            <img src="img/petition3.png" alt="petition 3">
          </div>
        </div>
    </div>
</div>

@endsection