@extends('layout.app')

@section('content')
<link rel="stylesheet" href="{{ URL::asset('css/form.css') }}" />
<div class="testbox">
    <form action="/input" method="POST">
        {{ csrf_field() }}
        <h1>Buat Diskusi</h1>
        <div class="item">
            <input type="text" name="judul" placeholder="Masukkan judul" maxlength="255" required/>
        </div>
        <div class="item">
            <textarea rows="5" name="diskusi" placeholder="Masukkan deskripsi diskusi" required></textarea>
        </div>
        <div class="btn-block">
            <button type="submit" href="/">Send</button>
        </div>
    </form>
</div>
@endsection