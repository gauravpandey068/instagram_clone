<?php

namespace App\Http\Controllers\post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Post $post){
        //validate the data
        $this->validate($request, array(
            'comment' => 'required|max:255'
        ));
        //store the data
        $post->comments()->create([
            'comment' => $request->comment,
            'user_id' => $request->user()->id,
        ]);

        return redirect()->back();
    }
}
