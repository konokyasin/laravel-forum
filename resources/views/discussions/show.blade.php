@extends('layouts.app')

@section('content')


    @foreach($discussions as $discussion)
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                       <h5 class="font-weight-bold text-info"><i class="fa fa-user mr-1 text-danger"></i>{{ $discussion->author->name }}</h5>
                    </div>
                    <div>
                        <a href="{{ route('discussions.index', $discussion->slug) }}" class="btn btn-success btn-sm">View</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="font-weight-bold text-center">
                    {{ $discussion->title }}
                </div>
                <hr>
                {!! $discussion->content !!}
                @if($discussion->bestReply)
                    <div class="card my-4 text-white bg-success">
                        <div class="card-header d-flex justify-content-between">
                             <div>
                                 <h5 class="font-weight-bold text-white"><i class="fa fa-user mr-1 text-danger"></i>{{ $discussion->bestReply->owner->name }}</h5>
                             </div>
                            <div class="font-weight-bold">
                                BEST REPLY
                            </div>
                        </div>
                        <div class="card-body">
                            {!! $discussion->bestReply->contents !!}
                        </div>
                    </div>
                @endif
            </div>
        </div>

        @foreach($discussion->replies()->paginate(3) as $reply)
            <div class="card my-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h5 class="font-weight-bold text-info"><i class="fa fa-user mr-1 text-danger"></i>{{ $reply->owner->name }}</h5>
                        </div>
                        <div>
                            @if(auth()->user()->id === $discussion->user_id)
                                <form action="{{ route('discussions.best-reply', [ 'discussion' => $discussion->slug, 'reply' => $reply->id ]) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-dark">Mark as best reply</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {!! $reply->contents !!}
                </div>
            </div>
        @endforeach
        {{ $discussion->replies()->paginate(3)->links() }}

        <div class="card my-4">
            <div class="card-header">
                Add a reply
            </div>
            <div class="card-body">
                @auth
                    <form action="{{ route('replies.store', $discussion->slug) }}" method="post" >
                        @csrf
                        <input type="hidden" name="contents" id="contents">
                        <trix-editor input="contents"></trix-editor>
                        <button type="submit" class="btn btn-success btn-sm my-2">
                           Add Reply
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-info text-white">Sign in to add a reply</a>
                @endauth
            </div>
        </div>
    @endforeach
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css">
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
@endsection



