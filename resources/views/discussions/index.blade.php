@extends('layouts.app')

@section('content')


    @foreach($discussions as $discussion)
        <div class="card mb-4">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <div>
                        <h5 class="font-weight-bold text-info"><i class="fa fa-user mr-1 text-danger"></i>{{ $discussion->author->name }}</h5>
                    </div>
                    <div>
                        <a href="{{ route('discussions.show', $discussion->slug) }}" class="btn btn-success btn-sm">View</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="font-weight-bold text-center">
                    {{ $discussion->title }}
                </div>
            </div>
        </div>
    @endforeach
    {{ $discussions->links() }}
@endsection
