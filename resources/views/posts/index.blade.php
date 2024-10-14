@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Posts</h1>
    @auth
        <a href="{{ route('posts.create') }}" class="btn btn-primary">Create Post</a>
    @endauth
    <div class="row mt-3">
        @foreach($posts as $post)
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                    <p class="card-text"><small class="text-muted">By {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}</small></p>
                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection