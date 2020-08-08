<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;

class CommentsController extends Controller
{
    //

    public function store(Request $request, $post_id)
    {
        //
        $this->validate($request, [
            'comment' => 'required'
        ]);

        
        $comment = new Comment;
        $comment->comment = $request['comment'];
        $comment->user_id = auth()->user()->id;
        $comment->post_id = $post_id;
        $comment->save();
    

        return redirect('http://localhost/lsapp/public/posts/'.$post_id);
    }

    public function destroy($id){

        $comment = Comment::find($id);

        $post_id = $comment->post_id;

        $comment->delete();

        return redirect('http://localhost/lsapp/public/posts/'.$post_id);

    }
}
