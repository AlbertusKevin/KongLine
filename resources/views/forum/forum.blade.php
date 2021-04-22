@extends('layout.app')

@section('content')
<script src="{{ URL::asset('js/plus.js') }}"></script>
    @if(session()->has('message'))
        <div class="alert alert-danger">{{ session()->get('message') }}</div>
    @endif
    @if (session()->has('success'))
    <div class="alert alert-success" id="toastclose">{{ session()->get('success') }}</div>
    @endif

<div class="container">
    @livewire('forum', ['forum' => $forum ?? null, ''])
</div>

<script>
    
</script>
@endsection