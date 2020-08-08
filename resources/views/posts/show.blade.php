@extends('layouts/app')

@section('content')



    <div class="card card-body">
        <a href="http://localhost/lsapp/public/posts" class="btn btn-outline-primary" style="width:7em; margin-bottom:3em">Back</a>
        <h1>{{$post['title']}}</h1>
        <p>{{$post['body']}}</p>
        <hr>
        <small>{{$post['created_at']}}</small>
        <small>Created by: {{$user['name']}}</small>

        @if(!Auth::guest())
            @if(Auth::user()->id == $post['user_id'])

                <form method="GET" action="http://localhost/lsapp/public/posts/{{$post['id']}}/edit">
                    @csrf
                    <input type="submit" value="Edit" class="btn btn-outline-primary" style="width:7em; margin:1.5em 0em">
                </form>

                <form method="POST" action="http://localhost/lsapp/public/posts/{{$post['id']}}">
                    @method('DELETE')
                    @csrf
                    <input type="submit" value="Delete" class="btn btn-outline-danger" style="width:7em; margin-bottom:3em">
                </form>

                <hr>
                
            @endif
        @endif

        <form method="POST" action="http://localhost/lsapp/public/comments/{{$post['id']}}" style="margin-top: 3em;">
            @csrf
            <textarea name="comment" placeholder="Write a comment..." style="width: 100%; height:5em;"></textarea><br>
            <input type="submit" value="Comment" class="btn btn-primary" style="float:right;">
        </form>

        <div id="comments" >
            @foreach($comments as $comment)
                <div>

                    @if(Auth::user() && Auth::user()->id == $comment['user_id'])
                        <form method="POST" action="http://localhost/lsapp/public/comments/{{$comment->id}}">
                            @method('DELETE')
                            @csrf
                            <button type="Submit" style="float: right;">Delete</button>
                        </form>
                    @endif

                    <hr>
                    <small class="font-weight-bold"><a href="http://localhost/lsapp/public/profile/{{$comment->user->id}}">{{$comment->user->name}}</a></small><small>    {{date('d-m-Y', strtotime($comment->created_at))}}</small>
                    <p>{{$comment['comment']}}</p>
                    
                </div>

                
                
            @endforeach

        </div>

</div>



@endsection


