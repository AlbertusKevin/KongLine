<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>@yield('title')</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#"><img src="img/logo.png" width="75"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link active" href="{{ url('/') }}">Home</a>
                <a class="nav-link" href="{{ url('/') }}">About</a>
                <a class="nav-link" href="{{ url('/') }}">Mahasiswa</a>
                <a class="nav-link" href="{{ url('/') }}">Students</a>
                <a class="nav-link" href="{{ url('/') }}"><img src="img/profile.png"></a>
            </div>
            </div>
            </div>
        </div>
    </nav>

    @yield('container')
    <footer>
      <div class="container">
        <div class="row">
            <div class="col-12 col-sm-5">
                <img src="img/footer.png" width=170>
            </div>

            <div class="col-12 col-sm-3">
                <ul>
                    <li class="pb-2 font-weight-bold" style="list-style:none;">Tentang Campaign.Org</li>
                    <li class="pb-2" style="list-style:none;"><a class="footerlinks">About Us</a></li>
                    <li class="pb-2" style="list-style:none;"><a class="footerlinks">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-12 col-sm-2">
              <ul>
                  <li class="pb-2 font-weight-bold" style="list-style:none;">Bantuan</li>
                  <li class="pb-2" style="list-style:none;"><a class="footerlinks">Privasi</a></li>
                  <li class="pb-2" style="list-style:none;"><a class="footerlinks">Kebijakan</a></li>
              </ul>
          </div>
          <div class="col-12 col-sm-2">
            <ul>
                <li class="pb-2 font-weight-bold" style="list-style:none;">Ikuti Kami</li>
                <li class="pb-2" style="list-style:none;"><a class="footerlinks">Facebook</a></li>
                <li class="pb-2" style="list-style:none;"><a class="footerlinks">Twitter</a></li>
            </ul>
          </div>
        </div>
        <div class="row justify-content-center mt-5">
          Copyright 2021 YuBisaYu
        </div>
    </div>
  </footer>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
  </body>
</html>