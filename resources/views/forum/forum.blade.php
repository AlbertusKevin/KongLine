@extends('layout.app')

@section('content')
<div class="container">
    @livewire('forum', ['forum' => $forum ?? null])
</div>
@endsection
