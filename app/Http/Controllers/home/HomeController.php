<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function myPost(Request $request)
    {
        $posts = auth()->user()->posts;
        return view('home.profile', compact('posts'));
    }

    public function changeProfile(Request $request)
    {
        //validate the form data
        if (auth()->user()->email == $request->email) {
            $request->validate([
                'name' => 'required|max:100',
                'email' => 'required|email|max:255',
            ]);
        } else {
            $request->validate([
                'name' => 'required|max:100',
                'email' => 'required|email|max:255|unique:users',
            ]);
        }
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->back();

    }

    public function changePassword(Request $request)
    {
        //validate the form data
        $request->validate([
            'password' => 'required|min:6',
        ]);

        $user = Auth::user();
        $user->password = bcrypt($request->password);

        $user->save();

        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function updateProfilePic(Request $request)
    {
        //validate
        $request->validate([
            'profile_pic' => 'required|image|mimes:jpeg,png,jpg|max:6048',
        ]);
        $image_path = $request->file('profile_pic')->store('profiles', 'public');

        $user = Auth::user();

        $user->profile_pic = $image_path;

        $user->save();

        return redirect()->back();
    }
}

