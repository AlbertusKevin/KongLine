@extends('layout.navbarOnly')

@section('content')
<div class="container">
    <div class="text-center mt-5">
        <button href="/petisi" type="button" class="btn btn-primary petition-type rounded-pill">Berlangsung</button>
        <button href="/petisi" type="button" class="btn btn-light petition-type rounded-pill ml-3">Telah Menang</button>
        @if (Auth::check())
            @if (Auth::user()->role == 'participant' || Auth::user()->role == 'campaigner')
                <button href="/petisi" type="button" class="btn btn-light petition-type rounded-pill ml-3">Ikut
                    Serta</button>
            @endif
            @if (Auth::user()->role == 'campaigner')
                <button type="button" class="btn btn-light petition-type rounded-pill ml-3">Petisi Saya</button>
            @endif
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
                Sort By
            </button>
            <div class="dropdown-menu" aria-labelledby="sort-by">
                <a class="dropdown-item sort-petition font-weight-bold">None</a>
                <a class="dropdown-item sort-petition">Jumlah Tanda Tangan</a>
                <a class="dropdown-item sort-petition">Event Terbaru</a>
            </div>
        </div>
        
    <table class="table table-borderless">
        <thead style="background-color:#E2E2E2">
          <tr class="text-center font-weight-normal">
            <th scope="col">Tanggal Dibuat</th>
            <th scope="col">Nama</th>
            <th scope="col">Email</th>
            <th scope="col">Partisipasi Event</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
            @if (count($users) == 0)
                <tr>
                    <td colspan="3">There is no Data</td>
                </tr>
            @endif
            @for ($i = 0; $i < sizeof($users); $i++)
                {{-- @if ($users[$i]->role != 'admin') --}}
                    <tr>
                        <td class="text-center">
                            {{ $changeDateFormat[$i]}}
                        </td>
                        <td>
                            {{ $users[$i]->name}}
                        </td>
                        <td>
                            {{ $users[$i]->email}}
                        </td>
                        <td>
                            {{ $eventCount[$i]}}
                        </td>
                        <td>
                            {{ $users[$i]->status}}
                        </td>
                    </tr>
                {{-- @endif --}}
            @endfor
          
        </tbody>
      </table>
      
</div>
@endsection