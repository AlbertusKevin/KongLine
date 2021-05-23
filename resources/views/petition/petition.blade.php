@extends($navbar)

@section('title')
    Petition List
@endsection

@section('content')
    @include('layout.message')
    <div class="container">
        <div class="row">
            @if ($user->role == 'campaigner')
                <div class="col-md-3 mt-3 pl-3">
                    <h4 class="mb-4">Mau buat petisimu sendiri?</h4>
                    <a href="/petition/create" type="button" class="btn btn-create-petition text-center">Ajukan Petisi</a>
                </div>
                <div class="col-md-9">
                @else
                    <div class="col-md-12">
            @endif
            <h2 class="mt-3 petition-page-title">Daftar Petisi</h2>
            <hr>
            <p class="petition-page-subtitle">Lihat Petisi yang Sedang Berlangsung di Website</p>

            <div class="text-center mt-5">
                <button href="/petition" type="button"
                    class="btn btn-primary petition-type rounded-pill">Berlangsung</button>
                <button href="/petition" type="button" class="btn btn-light petition-type rounded-pill ml-3">Telah
                    Menang</button>
                <button href="/petition" type="button" class="btn btn-light petition-type rounded-pill ml-3">Mencapai
                    Target</button>
                @if ($user->role == 'participant' || $user->role == 'campaigner')
                    <button href="/petition" type="button" class="btn btn-light petition-type rounded-pill ml-3">Ikut
                        Serta</button>
                @endif
                @if ($user->role == 'campaigner')
                    <button type="button" class="btn btn-light petition-type rounded-pill ml-3">Petisi Saya</button>
                @endif
            </div>

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
            <div id="petition-list">
                @if (count($petitionList) == 0)
                    <div class="card mb-3 ml-auto mr-auto mt-5" style="max-width: 650px;">
                        <div class="row no-gutters">
                            <div class="col-md-12 text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Belum ada petisi pada daftar ini</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @foreach ($petitionList as $list)
                    @if ($list->status != 'not_confirmed')
                        <div class="card mb-3 ml-auto mr-auto mt-5" style="max-width: 650px;">
                            <div class="row no-gutters">
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><a
                                                href="/petition/{{ $list->id }}">{{ $list->title }}</a>
                                        </h5>
                                        @if ($list->status == 1)
                                            <small class="text-muted">Hingga
                                                {{ date_format(date_create($list->deadline), 'M d, Y') }}</small>
                                        @endif
                                        <p class="card-text petition-description">{{ $list->purpose }}</p>
                                        <p class="card-text"><small class="text-muted">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-flag-fill mr-2" viewBox="0 0 16 16">
                                                    <path
                                                        d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12.435 12.435 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A19.626 19.626 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a19.587 19.587 0 0 0 1.349-.476l.019-.007.004-.002h.001" />
                                                </svg><b>{{ number_format($list->signedCollected) }} dari
                                                    {{ number_format($list->signedTarget) }} Orang</b>
                                                telah
                                                menandatangani petisi ini</small></p>
                                    </div>
                                </div>
                                <div class="col-md-4 p-2">
                                    <img src="{{ $list->photo }}" alt="Gambar dari petisi '{{ $list->title }}'"
                                        class="img-list-petition">
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    </div>


@endsection
