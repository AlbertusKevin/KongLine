@extends('layout.app')

@section('content')
<div class="container">
    @livewire('comment', ['forum' => $forum])
</div>
@endsection
