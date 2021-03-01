<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function member()
    {
        $query = request('query');
        $posts = Post::where("title","like","%$query%")->latest()->paginate(10);
        return view('post.index', compact('posts'));
    }
}
