<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SellPostController extends Controller
{
    public function index()
    {
        //$posts = Post::all();
        $posts = Post::Where('purpose','=','sale')->paginate(10);

        return view('admin.posts.index', compact('posts'));
    }

    public function update($id)
    {
        return redirect()->route('admin.sell.post.index')->with('error', 'This action is unavailable.');
    }

    public function destroy($id)
    {
        return redirect()->route('admin.sell.post.index')->with('error', 'This action is unavailable.');
    }
}
