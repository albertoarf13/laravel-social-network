@extends('layouts/app')

@section('content')



    <div class="card card-body">
        <form method="POST" action="http://localhost/lsapp/public/posts/{{$post['id']}}">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input name="title" class="form-control" value="{{$post['title']}}"><br>
            </div>

            <div class="form-group">
                <label for="body">Body</label>
                <textarea name="body" class="form-control" >{{$post['body']}}</textarea><br>
            </div>

            <button type="submit">Submit</button>
        </form>
    </div>



@endsection


