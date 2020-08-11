@extends('./layouts/app')

@section('content')

    <?php

        $profile_exists = count((array)$profile_info) > 0 ;

    ?>



    <h1>Profile</h1>

    <div class="card card-body">
        <h2 style="margin-bottom: 1em;">{{$user->name}}</h2>

        @if($profile_exists)

            
        <form method="POST" action="http://localhost/lsapp/public/editProfile/{{Auth::user()->id}}" >
        @csrf
 
            <table class="table">

                <tr>

                    <th>Bio:</th>
                    <td style="white-space: pre-wrap;">
                        <textarea name="bio">@if(isset($profile_info['bio'])) {{$profile_info->bio}} @endif</textarea>
                    </td>
                
                </tr>
                <tr>

                    <th>Instagram:</th>
                    <td>
                        <input name="instagram" value="@if(isset($profile_info['instagram'])) {{$profile_info->instagram}} @endif">
                    </td>

                </tr>
                <tr>

                    <th>Website:</th>
                    <td>
                        <input name="website" value="@if(isset($profile_info['website'])) {{$profile_info->website}} @endif">
                    </td>

                </tr>
                <tr>

                    <th>Country:</th>
                    <td>
                        <input name="pais" value="@if(isset($profile_info['pais'])) {{$profile_info->pais}} @endif">
                    </td>

                </tr>
                <tr>

                    <th>Email:</th>
                    <td>
                        <input name="email" value="{{$user->email}}">
                    </td>

                </tr>

            </table>

            <button type="submit" class="btn btn-primary" style="width: 14em; margin-bottom: 2em;">Save changes</button>

        </form>

            

            

        @endif

        <br><small>Joined on: {{date('d-m-Y', strtotime($user->created_at))}}</small>

    </div>



@endsection
