<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfilesController extends Controller
{
    //

    public function profile($id){

        $user = User::find($id);
        $profile_info = $user->profile;

        return view('profile')->with('user', $user)->with('profile_info', $profile_info);

    }
}
