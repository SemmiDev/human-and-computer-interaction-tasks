<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Post $post)
    {
        // $posts = Post::with('author','category')->where('category_id', $post->category_id)->latest()->limit(10)->get();
        // return view('home', compact('posts'));

        $posts = Post::with('author','category')->latest()->limit(10)->get();
        return view('home', compact('posts'));
    }
}
