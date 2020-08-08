<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Follow;
use App\User;
use Illuminate\Support\Facades\DB;

class FollowsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function allUsers(){

        $usersArray = User::all();

        return view('follows/allUsers')->with('usersArray', $usersArray);
    }

    public function store($followee_id){


        $follow = new Follow;
        $follow->follower_id = auth()->user()->id;
        $follow->followee_id = $followee_id;
        $follow->save();

        return redirect('http://localhost/lsapp/public/follows/allUsers');


    }

    public function destroy($followee_id)
    {
        //
        $follower_id = auth()->user()->id;

        $follow = Follow::where([
            ['follower_id','=',$follower_id],
            ['followee_id','=',$followee_id]
        ]);

        $follow->delete();

        return redirect('http://localhost/lsapp/public/follows/allUsers');
    }
}
