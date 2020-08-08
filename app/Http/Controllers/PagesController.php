<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'services']]);
    }
    
    public function about(){


        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        $feed_posts = $user->feed_posts();
    
        return view('pages/about')->with('feed_posts', $feed_posts);

    }

    public function index(){
        return view('pages/index');
    }

    public function services(){
        return view('pages/services');
    }
}
