@extends('layout.app')

@section('content')
<div class="container">
    @livewire('message', ['users' => $users, 'messages' => $messages])
</div>
@endsection
