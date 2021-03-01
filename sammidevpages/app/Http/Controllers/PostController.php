<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        return view('post.index', [
            'posts' => Post::latest()->paginate(6)
        ]);
    }

    public function show(Post $post)
    {
        $posts = Post::where('category_id', $post->category_id)->latest()->limit(6)->get();
        return view('post.show', compact('post', 'posts'));
    }

    public function create()
    {
        return view('post.create', [
            'post' => new Post(),
            'categories' => Category::get()

        ]);
    }

    public function store(PostRequest $request)
    {

        $request->validate([
            'thumbnail' => 'image|mimes:jpeg,png,jpg,bitmap,svg|max:2048'
        ]);

        $attr = $request->all();

        $slug = \Str::slug(request('title'));

        $attr['slug'] = $slug;

        if (request()->file('thumbnail')) {
            $thumbnail = request()->file('thumbnail')->store("images/posts");
        }else{
            $thumbnail = null;
        }

        $attr['category_id'] = request('category');
        $attr['thumbnail'] = $thumbnail;

        $post = auth()->user()->posts()->create($attr);
        session()->flash('success', 'The post was created');
        return redirect('posts');
    }

    public function edit(Post $post)
    {
        return view('post.edit', [
            'post' => $post,
            'categories' => Category::get()
        ]);
    }

    public function update(PostRequest $request,  Post $post)
    {

        $request->validate([
            'thumbnail' => 'image|mimes:jpeg,png,jpg,bitmap,svg|max:2048'
        ]);

        $this->authorize('update', $post);

        if (request()->file('thumbnail')) {
            \Storage::delete($post->thumbnail);
        }

        $this->authorize('update', $post);

        $thumbnailUrl = request()->file('thumbnail')->store("images/posts");

        $attr = $request->all();

        $attr['category_id'] = request('category');
        $attr['thumbnail'] = $thumbnailUrl;

        $post->update($attr);

        session()->flash('success', 'The post was updated');
        return redirect('posts');
    }

    // public function destroy(Post $post)
    // {
    //      \Storage::delete($post->thumbnail);
    //     $this->authorize('updated', $post);
    //     if(auth()->user()->is($post->author)) {
    //         $post->delete();
    //         session()->flash('success', 'The post was deleted');
    //         return redirect('posts');
    //     }else {
    //         session()->flash('error', 'Itu bukan anggota keluarga kamu');
    //         return redirect('posts');
    //     }
    // }

    public function destroy(Post $post)
    {

        $this->authorize('delete', $post);
        $post->delete();
        session()->flash('error', 'The post was deleted');
        return redirect('posts');
    }
}
