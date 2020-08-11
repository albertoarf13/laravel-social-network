<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Auth;
use App\Profile;

class ProfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['profile']]);
    }


    public function profile($id){

        $user = User::find($id);
        $profile_info = $user->profile;
        $postsArray = $user->posts;

        /*if(count((array)$profile_info) > 0){
            return count((array)$profile_info);
        }else{
            return count((array)$profile_info);
        }*/

        return view('profile')->with('user', $user)->with('profile_info', $profile_info)->with('postsArray', $postsArray);

    }

    public function editProfile(){

        $user = auth()->user();

        $profile_info = $user->profile;

        return view('profile/editProfile')->with('user', $user)->with('profile_info', $profile_info);

    }

    public function update(Request $request, $id)
    {

        //Update profile
        $profile = Profile::where('user_id', $id)->first();

        $profile->bio = $request->bio;
        $profile->instagram = $request->instagram;
        $profile->website = $request->website;
        $profile->pais = $request->pais;

        $profile->save();


        //Update user email
        $user = User::find(auth()->user()->id);
        $email = $request->email;
        
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){

            $user->email = $request->email;
            $user->save();
            return redirect('http://localhost/lsapp/public/editProfile')->with('success', 'Profile updated');
            
        }else{

            return redirect('http://localhost/lsapp/public/editProfile')->with('error', 'Email is not valid');

        }



    }
}
