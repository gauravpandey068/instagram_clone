<?php

namespace App\Http\Controllers\post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, Post $post)
    {
        if ($post->likedBy($request->user())) {
            // unlike
            $post->likes()->where('user_id', auth()->user()->id)->delete();
            return redirect()->back();
        } else {
            //like post
            $post->likes()->create([
                'user_id' => auth()->user()->id,
            ]);
        }

        return redirect()->back();
    }
}
