<div>

    <div class="row" wire:poll.10ms="mount">
        @if(filled($forum))
            @foreach($forum as $f)
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $f->user->name }}</h5>
                            <p class="card-text">{{ $f->id }} - {{ $f->content }}</p>
                            
                                @if($f->likes->count() == 0)
                                <form wire:submit.prevent="like">
                                    <button wire:click="getIdForum({{ $f->id }})" class="btn btn-warning">like</button>
                                </form>
                                @else
                                    @foreach($f->likes as $like)
                                        @if($like->idParticipant == auth()->user()->id)
                                        <form wire:submit.prevent="unlike">
                                            <button wire:click="getIdForum({{ $f->id }})" class="btn btn-primary">unlike</button>
                                        </form>
                                        @else
                                        <form wire:submit.prevent="like">
                                            <button wire:click="getIdForum({{ $f->id }})" class="btn btn-warning">like</button>
                                            @break;
                                        </form>
                                        @endif
                                    @endforeach
                                @endif
                                <p>{{ $f->likes->count() }} like</p>
                                <a href="/forum/{{$f->id}}">Comment</a>
                                <p>{{ $f->comments->count() }} comment</p>
                            
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            No forum to show
        @endif
    </div>
</div>