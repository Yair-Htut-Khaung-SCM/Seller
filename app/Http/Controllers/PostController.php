<?php

namespace App\Http\Controllers;

use App\Enums\GeneralType;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Services\Admin\PostService;
use App\Services\Admin\ManufacturerService;
use App\Services\Admin\BuildTypeService;
use App\Services\Admin\UserService;
use App\Services\Admin\PlateDivisionService;
use App\Services\ProfileImageService;

class PostController extends Controller
{
    private $path;
    private $view;

    public function __construct(PostService $postService, ManufacturerService $manufacturerService, BuildTypeService $buildTypeService, 
    UserService $userService, PlateDivisionService $plateDivisionService,ProfileImageService $profileImageService,Request $request)
    {
        $this->postService = $postService;
        $this->manufacturerService = $manufacturerService;
        $this->buildTypeService = $buildTypeService;
        $this->userService = $userService;
        $this->plateDivisionService = $plateDivisionService;
        $this->profileImageService = $profileImageService;
        $this->path = $request->segment(1); // get sale or buy resource
        $this->view = $this->path == "buy" ? 'buys' : 'posts';
    }
    public function index(Request $request)
    {
        $manufacturers = $this->manufacturerService->getAll();
        $build_types = $this->buildTypeService->getAll();
        $profile_image = $this->profileImageService->getAll();
        $users = $this->userService->getAll();

        $posts = $this->postService->getPost($request, $this->path);
        
        return view($this->view .'.index' , compact('posts', 'manufacturers', 'build_types', 'profile_image', 'users'));
    }

    public function create(Request $request)
    {
        $manufacturers = $this->manufacturerService->getAll();
        $build_types = $this->buildTypeService->getAll();
        $plate_divisions = $this->plateDivisionService->getAll();

        return view($this->view .'.create', compact('manufacturers', 'build_types', 'plate_divisions'));
    }
    public function store(PostStoreRequest $request)
    {
        //Create New Post
        $post = $this->postService->savePost($request);
        return redirect(route($this->path.'.show', $post->id));
    }

    public function edit($id)
    {
        $post = $this->postService->getPostById($id);
        $manufacturers = $this->manufacturerService->getAll();
        $build_types = $this->buildTypeService->getAll();
        $plate_divisions = $this->plateDivisionService->getAll();

        if ((($post->is_published == 1 && $post->purpose == GeneralType::PURPOSE_BUY) || ($post->is_published == 0 && $post->purpose == GeneralType::PURPOSE_BUY)) && $post->user_id == Auth::user()->id) {
            return view('buys.edit', compact('post', 'manufacturers', 'build_types', 'plate_divisions'));
        }
        abort(403);
    }
    public function update(PostUpdateRequest $request, $id)
    {
        $post = $this->postService->updatePost($request, $id);
        return redirect(route($this->path . '.show', $post->id));
    }

    public function show($id)
    {
        $post = $this->postService->getPostById($id);
        $profile_image = $this->profileImageService->getAll();

        $userbuy = $this->userService->getAll();
        $users = $this->userService->getAll();

        if (!empty($post) && Auth::user()) {
            $similar_posts = $this->postService->getSimilarPost($post);
            if (($post->is_published == 1 && $post->purpose == GeneralType::PURPOSE_BUY) || ($post->is_published == 0 && $post->purpose == GeneralType::PURPOSE_BUY) && $post->user_id == Auth::user()->id) {
                return view('buys.show', compact('post', 'similar_posts', 'profile_image', 'userbuy', 'users'));
            }

        } elseif (!empty($post) && !Auth::user()) {
            $similar_posts = $this->postService->getSimilarPost($post);

            if (($post->is_published == 1 && $post->purpose == GeneralType::PURPOSE_BUY)) {
                return view('buys.show', compact('post', 'similar_posts', 'profile_image', 'userbuy', 'users'));
            }
            abort(404);
        }
        elseif(empty($post)){
            abort(404);
        }
        abort(404);
    }

    public function destroy($id)
    {
        $post = $this->postService->deletePost($id);
        return redirect(route($this->path.'.index'));
    }
}