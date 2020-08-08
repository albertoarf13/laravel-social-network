<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$postsArray = Post::all();
        $postsArray = DB::select("SELECT posts.*, users.name 
                            FROM posts
                            JOIN users
                            ON posts.user_id = users.id
                            ORDER BY posts.created_at desc");

        //return $postsArray;

        /*
        $user = auth()->user();
        $postsArray = $user->posts;
        return $postsArray;*/

        return view('posts/index')->with('postsArray', $postsArray);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        $post = new Post;
        $post->title = $request['title'];
        $post->body = $request['body'];
        $post->user_id = auth()->user()->id;
        $post->save();

        return redirect('http://localhost/lsapp/public/posts')->with('success', 'Post created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post =  Post::find($id);

        $user_id = $post['user_id'];
        $user = User::find($user_id);

        $comments = $post->comments;

        return view('posts/show')->with('post', $post)->with('user', $user)->with('comments', $comments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        $user_id_logged_in = auth()->user()->id;

        if($user_id_logged_in != $post['user_id']){
            return redirect('http://localhost/lsapp/public/posts')->with('error','Unauthorized to edit post');
        }
        
        return view('posts/edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        $post = Post::find($id);
        $post->title = $request['title'];
        $post->body = $request['body'];
        $post->save();

        return redirect('http://localhost/lsapp/public/posts')->with('success', 'Post updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::find($id);
        $post->delete();

        return redirect('http://localhost/lsapp/public/posts');
    }
}
