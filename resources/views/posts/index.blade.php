@extends('layouts/app')

@section('content')

    <h1>Posts</h1>

    @foreach($postsArray as $post)

        <div class="card card-body">
        <h2><a href="http://localhost/lsapp/public/posts/{{$post->id}}" >{{$post->title}}</a></h2>
            <p>{{$post->body}}</p>
            <small>{{date('d-m-Y', strtotime($post->created_at))}}</small>
            <small><a href="http://localhost/lsapp/public/profile/{{$post->user_id}}">{{$post->name}}</a></small>
        </div>

    @endforeach

@endsection


