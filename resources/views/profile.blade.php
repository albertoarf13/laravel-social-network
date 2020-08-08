@extends('./layouts/app')

@section('content')

    <h1>Profile</h1>



    <div class="card card-body">
        <h2>{{$user->name}}</h2>

        <hr>

        <p>{{$user->email}}</p>
        <p>Joined on: {{date('d-m-Y', strtotime($user->created_at))}}</p>

    </div>



@endsection
