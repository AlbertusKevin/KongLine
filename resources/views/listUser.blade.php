@extends('layout.navbarOnly')

@section('content')
<div class="container">
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