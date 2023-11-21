<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Enums\GeneralType;
use App\Services\Admin\PostService;

class BuyPostController extends Controller
{
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index()
    {
        $posts = $this->postService->getDetail(GeneralType::purpose_buy);
        return view('admin.buyposts.index', compact('posts'));
    }

    public function update($id)
    {
        return redirect()->route('admin.buy.index')->with('error', 'This action is unavailable.');
    }

    public function destroy($id)
    {
        return redirect()->route('admin.buy.index')->with('error', 'This action is unavailable.');
    }
}
