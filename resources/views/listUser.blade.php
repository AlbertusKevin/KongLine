@extends('layout.navbarOnly')

@section('content')
<div class="container">
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Nama</th>
            <th scope="col">Status</th>
            <th scope="col">Email</th>
          </tr>
        </thead>
        <tbody>
            @if (count($users) == 0)
                <tr>
                    <td colspan="3">There is no Data</td>
                </tr>
            @endif
            @foreach ($users as $user)
                @if ($user->role != 'admin')
                    <tr>
                        <td>
                            {{ $user->name}}
                        </td>
                        <td>
                            {{ $user->role}}
                        </td>
                        <td>
                            {{ $user->email}}
                        </td>
                    </tr>
                @endif
            @endforeach
          
        </tbody>
      </table>
</div>
@endsection