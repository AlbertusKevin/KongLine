@extends('layout.app')

@section('content')
    @include('layout.message')
    <div class="container-fluid contain d-flex align-items-center justify-content-center h-100">
        <div class="outer">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-20 w-35">
                    <div class="shadow p-5 bg-white round">
                        <form method="POST" action="{{ route('postRegister') }}">
                            {{ csrf_field() }}
                            <h4 class="text-center font-weight-bold mb-4 "> Daftar Akun Baru </h4>
                            <input type="text" id="authFormFName" name="firstname" class="form-control mb-2 "
                                placeholder="Nama Depan" autofocus required>
                            <input type="text" id="authFormLName" name="lastname" class="form-control mb-2 "
                                placeholder="Nama Belakang" autofocus>
                            <input type="email" id="authForm" name="email" class="form-control mb-2" placeholder="E-mail"
                                autofocus required>
                            <input type="password" id="authForm" name="password" class="form-control mb-3"
                                placeholder="Password" autofocus required>
                            <button class="btn-blue font-weight-bold mb-3" type="submit"> DAFTAR </button>
                            <p class="text-center">Sudah memiliki akun? <a href="/login" class="text-blue">Masuk</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

<style>
    .contain {
        overflow: hidden;
        position: relative;
        left: 0%;
        top: 0%;
        width: 100%;
        height: 100vh;
        animation: animate 16s ease-in-out infinite;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }

    .outer {
        position: absolute;
        left: 0%;
        top: 0%;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5)
    }

    @keyframes animate {

        0%,
        100% {
            background-image: url(images/auth/bg1.jpg);
        }

        25% {
            background-image: url(images/auth/bg2.jpg);
        }

        50% {
            background-image: url(images/auth/bg3.jpg);
        }

        75% {
            background-image: url(images/auth/bg4.jpg);
        }
    }

</style>
