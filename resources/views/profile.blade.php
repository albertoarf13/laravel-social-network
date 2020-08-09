@extends('./layouts/app')

@section('content')

    <?php

        $profile_exists = count((array)$profile_info) > 0 ;

    ?>



    <h1>Profile</h1>

    <div class="card card-body">
        <h2 style="margin-bottom: 1em;">{{$user->name}}</h2>

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

    </div>



@endsection
