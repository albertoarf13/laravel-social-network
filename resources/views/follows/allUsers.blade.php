@extends('layouts/app')

@section('content')

    <h1>All Users</h1>

    @foreach($usersArray as $user)

        <div class="card card-body">
            
            <div>
                <h3>{{$user->name}}</h3>
            </div>

            <?php

                $a = DB::select('SELECT * 
                                    FROM follows 
                                    WHERE follower_id = '.Auth::user()->id.'
                                    AND followee_id = '.$user->id);

                $following = count($a) > 0;
            ?>

            @if($following)
                <div>
                    <form method="POST" action="http://localhost/lsapp/public/follows/{{$user->id}}">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-secondary">Unfollow</button>
                    </form>
                </div>
            @endif

            @if(!$following && $user->id != Auth::user()->id)
            <div>
                <form method="GET" action="http://localhost/lsapp/public/follows/{{$user->id}}">
                    <button type="submit" class="btn btn-primary">Follow</button>
                </form>
            </div>
            @endif

        </div>

    @endforeach

@endsection


