<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BuyPostController extends Controller
{
    public function index()
    {
        $posts = Post::where('purpose','=','buy')->paginate(10);

        return view('admin.buyposts.index', compact('posts'));
    }

    public function update($id)
    {
        return redirect()->route('admin.buy.post.index')->with('error', 'This action is unavailable.');
    }

    public function destroy($id)
    {
        return redirect()->route('admin.buy.post.index')->with('error', 'This action is unavailable.');
    }
}
