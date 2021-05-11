<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Local Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins" />
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>

    <style>
        body {
            font-family: 'Poppins';
        }

    </style>

    <title>@yield('title')</title>
</head>

<body>
    @include('sweetalert::alert')
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/"><img src="/img/logo.png" width="75"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end mr-5 pr-5" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link" href="{{ url('/donation') }}">Donasi</a>
                    <a class="nav-link" href="{{ url('/petition') }}">Petisi</a>
                    <a class="nav-link" href="{{ url('/forum') }}">Forum</a>
                    @if (Auth::check())
                        @if (auth()->user()->role == 'admin')
                            <a class="nav-link" href="{{ url('/inbox') }}">Service</a>
                        @endif
                        <div class="dropdown m-2 mr-2">
                            <div data-toggle="dropdown">
                                <img src="/img/profile.png">
                            </div>
                            <div class="dropdown-menu">
                                <a class="nav-link" href="{{ url('/profile') }}">Edit Profile</a>
                                <a class="nav-link" href="{{ url('/logout') }}">Logout</a>
                            </div>
                        </div>
                    @else
                        <div class="text-center">
                            <a type="button" class="btn btn-outline-info ml-1 mr-2" href="{{ url('/login') }}"> Login
                            </a>
                            <a type="button" class="btn btn-info mr-2" href="{{ url('/register') }}"> Daftar </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </nav>
    {{-- @include('layout.message') --}}
    @yield('content')
    <footer class="mt-5 pt-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-5">
                    <img src="/img/footer.png" width=170>
                </div>

                <div class="col-12 col-sm-3">
                    <ul>
                        <li class="pb-2 font-weight-bold" style="list-style:none;color:#03254C;">Tentang Campaign.Org
                        </li>
                        <li class="pb-2" style="list-style:none;"><a href="#" style="color:#03254C;"
                                class="text-decoration-none">About Us</a></li>
                        <li class="pb-2" style="list-style:none;"><a href="#" style="color:#03254C;"
                                class="text-decoration-none">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-12 col-sm-2">
                    <ul>
                        <li class="pb-2 font-weight-bold" style="list-style:none;color:#03254C;">Bantuan</li>
                        <li class="pb-2" style="list-style:none;"><a href="#" style="color:#03254C;"
                                class="text-decoration-none">Privasi</a></li>
                        <li class="pb-2" style="list-style:none;"><a href="#" style="color:#03254C;"
                                class="text-decoration-none">Kebijakan</a></li>
                    </ul>
                </div>
                <div class="col-12 col-sm-2">
                    <ul>
                        <li class="pb-2 font-weight-bold" style="list-style:none;color:#03254C;">Ikuti Kami</li>
                        <li class="pb-2" style="list-style:none;"><a href="#" style="color:#03254C;"
                                class="text-decoration-none">Facebook</a></li>
                        <li class="pb-2" style="list-style:none;"><a href="#" style="color:#03254C;"
                                class="text-decoration-none">Twitter</a></li>
                    </ul>
                </div>
            </div>
            <div class="row justify-content-center mt-5 font-weight-bold">
                <p style="color: #03254C;">Copyright 2021 YuBisaYu</p>
            </div>
        </div>
    </footer>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>

</html>

@livewireScripts
