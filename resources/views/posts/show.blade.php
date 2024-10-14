@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>
    <p><small class="text-muted">By {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}</small></p>

    @auth
        @if(Auth::id() == $post->user_id)
            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
            </form>
        @endif
    @endauth

    <hr>

    <h3>Comments</h3>
    @auth
        <form action="{{ route('comments.store', $post->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <textarea name="content" class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Comment</button>
        </form>
    @endauth

    @foreach($post->comments as $comment)
        <div class="card mt-3">
            <div class="card-body">
                <p>{{ $comment->content }}</p>
                <p><small class="text-muted">By {{ $comment->user->name }} on {{ $comment->created_at->format('M d, Y') }}</small></p>
                @auth
                    @if(Auth::id() == $comment->user_id)
                        <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    @endif
                @endauth
            </div>
        </div>
    @endforeach
</div>
@endsection