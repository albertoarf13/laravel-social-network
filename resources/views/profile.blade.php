@extends('./layouts/app')

@section('content')

    <?php

        $profile_exists = count((array)$profile_info) > 0 ;

    ?>



    <h1>Profile</h1>

    <div class="card card-body">
        <h2 style="margin-bottom: 1em;">{{$user->name}}</h2>

        <div style="display: flex; margin-bottom: 3em;">
            <span style="margin-right: 3em"><strong>{{$profile_info->postCount}}</strong> posts</span>
            <span style="margin-right: 3em"><strong>{{$profile_info->followerCount}}</strong> followers</span>
            <span style="margin-right: 3em"><strong>{{$profile_info->followingCount}}</strong> following</span>
        </div>

        @if($profile_exists)

            <table class="table">
                <tr>
                    <th>Bio:</th>
                    <td style="white-space: pre-wrap;">@if(isset($profile_info['bio'])) {{$profile_info->bio}} @endif</td>
                </tr>
                <tr>
                    <th>Instagram:</th>
                    <td>@if(isset($profile_info['instagram'])) {{$profile_info->instagram}} @endif</td>
                </tr>
                <tr>
                    <th>Website:</th>
                    <td>@if(isset($profile_info['website'])) {{$profile_info->website}} @endif</td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td>{{$user->email}}</td>
                </tr>

            </table>

        @endif

        <small>Joined on: {{date('d-m-Y', strtotime($user->created_at))}}</small>

        <section id="posts" style="margin-top: 3em;">

            <h2>User's posts</h2>

            @foreach($postsArray as $post)

                <div class="card card-body">
                    <h2><a href="http://localhost/lsapp/public/posts/{{$post->id}}" >{{$post->title}}</a></h2>
                    <p>{{$post->body}}</p>
                    <small>{{date('d-m-Y', strtotime($post->created_at))}}</small>
                    <small><a href="http://localhost/lsapp/public/profile/{{$post->user_id}}">{{$post->name}}</a></small>
                </div>

            @endforeach

            @if(count($postsArray) < 1)

                <p style="margin-top: 3em">No posts found</p>

            @endif

        </section>

    </div>



@endsection
