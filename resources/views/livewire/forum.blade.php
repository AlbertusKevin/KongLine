<div>
    <div class="row" wire:poll.10ms="mount">
        <div class="card col-md-3" style="margin: 15px 0 0 -150px">
            @if (Auth::check())
                @if (auth()->user()->role == 'admin' || auth()->user()->role == 'campaigner')
                    <a href="/inputforum" class="btn btn-primary" style="margin: 20px 0 0 10px">Tambah Forum</a><br>
                @endif
            @endif
        </div>
        <div class="card col-md-12" style="margin: 15px -200px 0 10px; padding: 0 0 0 0">
            @if (filled($forum))
                @foreach ($forum as $f)
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-2" style="margin-right: -50px;">
                                <img src="{{ $f->user->photoProfile }}"
                                    style="border-radius: 50%; margin: 30px 0 0 35px;" width="100px" height="100px"
                                    alt="images">
                            </div>
                            <div class="col-md-10">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $f->title }}</h5>
                                    <p class="card-text" style="margin-top: -15px;"><small
                                            class="text-muted">{{ $f->user->name }}</small></p>
                                    <p class="card-text" style="margin-top: -15px;">{{ $f->content }}</p>
                                    <div class="row">
                                        @if ($f->likes->count() == 0)
                                            <form wire:submit.prevent="like">
                                                <button wire:click="getIdForum({{ $f->id }})"
                                                    class="btn btn-outline-light" class="col-md-2"
                                                    style="color: black;"><img src="/images/app/icons/love.png"
                                                        width="35px"
                                                        style="margin-right: 10px;">{{ $f->likes->count() }}
                                                    likes</button>
                                            </form>
                                        @else
                                            @if (Auth::check())
                                                @if ($f->likes->where('idParticipant', '=', auth()->user()->id)->first() != null)
                                                    <form wire:submit.prevent="unlike">
                                                        <button wire:click="getIdForum({{ $f->id }})"
                                                            class="btn btn-outline-light" class="col-md-2"
                                                            style="color: black;"><img
                                                                src="/images/app/icons/unlove.png" width="35px"
                                                                style="margin-right: 10px;">{{ $f->likes->count() }}
                                                            likes</button>
                                                    </form>
                                                @else
                                                    <form wire:submit.prevent="like">
                                                        <button wire:click="getIdForum({{ $f->id }})"
                                                            class="btn btn-outline-light" class="col-md-2"
                                                            style="color: black;"><img src="/images/app/icons/love.png"
                                                                width="35px"
                                                                style="margin-right: 10px;">{{ $f->likes->count() }}
                                                            likes</button>
                                                    </form>
                                                @endif
                                            @else
                                                <a href="/forumerror" class="btn" style="margin: 1px"><img
                                                        src="/images/app/icons/love.png"
                                                        width="35px">{{ $f->likes->count() }}
                                                    likes</a>
                                            @endif
                                        @endif
                                        <a href="/forum/{{ $f->id }}" class="btn"
                                            style="margin: 4px 0 0 10px">{{ $f->comments->count() }} Comment</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                No forum to show
            @endif
        </div>
    </div>
</div>
