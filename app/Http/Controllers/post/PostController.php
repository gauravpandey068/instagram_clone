<?php

namespace App\Http\Controllers\post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('home.index', compact('posts'));
    }

    public function store(Request $request)
    {
        //validate form data
        $request->validate([
            'caption' => 'required|max:500',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:6048',
        ]);
        //save image
        $image_path = $request->file('image')->store('uploads', 'public');
        //store in database
        auth()->user()->posts()->create([
            'caption' => $request->caption,
            'image' => $image_path,
        ]);
        //redirect to home page
        return redirect()->route('home')->with('success', 'Post created successfully');
    }

    public function show(Request $request, Post $post)
    {
        return view('home.post', compact('post'));
    }
    //edit post


    //delete post
    public function destroy(Request $request, Post $post)
    {
        if (auth()->user()->id !== $post->user_id) {
            return redirect()->back()->with('error', 'Unauthorized Page');
        }
        //delete image
        Storage::delete('public/' . $post->image);
        $post->delete();
        return redirect()->route('home');
    }
}
