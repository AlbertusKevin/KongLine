@extends('layout.app')

@section('content')
<script src="{{ URL::asset('js/plus.js') }}"></script>
    @include('layout.message')
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

    <section class="container mt-5">
        <div class="row">
            <h2 class="col">Donasi</h2>
            <div class="col text-right align-self-center">
                <a class="link-button" href="/donation"> Lihat Selengkapnya <svg xmlns="http://www.w3.org/2000/svg"
                        width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
                        <path fill-rule="evenodd"
                            d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
                    </svg></a>
            </div>
        </div>
        <div class="row">
            @foreach ($donasi as $d)
                <div class="card col-md-4 m-2" style="padding: 0; ">
                    <div style="position:relative;">
                        <img src="{{ $d->photo }}" class="card-img-top " alt="donation picture">
                        <p class="donate-count">{{ $d->participatedonation->count() }} Donatur</p>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $d->title }}</p>
                        <h5 class="card-title">{{ $d->users->name }}</h5>
                        <a href="#" class=" w-100 btn btn-primary"> Detail </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="container mt-5">
        <div class="row">
            <h2 class="col">Petisi</h2>
            <div class="col text-right align-self-center">
                <a class="link-button" href="/petition"> Lihat Selengkapnya <svg xmlns="http://www.w3.org/2000/svg"
                        width="16" height="16" fill="currentColor" class="bi bi-chevron-double-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M3.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L9.293 8 3.646 2.354a.5.5 0 0 1 0-.708z" />
                        <path fill-rule="evenodd"
                            d="M7.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L13.293 8 7.646 2.354a.5.5 0 0 1 0-.708z" />
                    </svg></a>
            </div>
        </div>
        <div class="row">
            @foreach ($petisi as $p)
                <div class="card col-md-4 m-2" style="padding: 0; ">
                    <div style="position:relative;">
                        <img src="{{ $p->photo }}" class="card-img-top" alt="petition picture">
                        <p class="donate-count">{{ $p->signedCollected }} Partisipan</p>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $p->title }}</p>
                        <h5 class="card-title">{{ $p->users->name }}</h5>
                        <a href="/petition/{{ $p->id }}" class=" w-100 btn btn-primary"> Detail </a>
                    </div>
                </div>
            @endforeach
        </div>
        </div>

        @if ($user->role != ADMIN && $user->role != GUEST)
            <button id="btnopenchat" class="open-button" onclick="openChat()">Chat</button>
            <button id="btnclosechat" class="open-button" onclick="closeChat()" style="display:block;">Chat</button>

            <div id="myChat">
                @livewire('message', ['users' => $users, 'messages' => $messages ?? null])
            </div>
        @endif
        <!-- <div class="card" style="width: 18rem;"> -->
        <!-- </div> -->

    </section>

@endsection
