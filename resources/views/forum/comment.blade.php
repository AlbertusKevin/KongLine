@extends($navbar)

@section('content')
    <div class="container">
        @livewire('comment', ['forum' => $forum])
    </div>
@endsection
