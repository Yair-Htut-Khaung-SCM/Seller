<?php

namespace App\Http\Controllers;

use App\Enums\GeneralType;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
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
        $request['purpose'] = $this->path;
        $post = $this->postService->savePost($request,$this->path);
        return redirect(route($this->path.'.show', $post->id));
    }

    public function edit($id)
    {
        $post = $this->postService->getPostById($id);
        $manufacturers = $this->manufacturerService->getAll();
        $build_types = $this->buildTypeService->getAll();
        $plate_divisions = $this->plateDivisionService->getAll();

        if ((($post->is_published == 1 && $post->purpose == $this->path) || ($post->is_published == 0 && $post->purpose == $this->path)) && $post->user_id == Auth::user()->id) {
            return view($this->view .'.edit', compact('post', 'manufacturers', 'build_types', 'plate_divisions'));
        }
        abort(403);
    }
    public function update(PostUpdateRequest $request, $id)
    {
        $post = $this->postService->updatePost($request, $id, $this->path);
        return redirect(route($this->path . '.show', $post->id));
    }

    public function show($id)
    {
        $post = $this->postService->getPostById($id);
        $profile_image = $this->profileImageService->getAll();

        $userbuy = $this->userService->getAll();
        $users = $this->userService->getAll();

        if (!empty($post) && Auth::user()) {
            $similar_posts = $this->postService->getSimilarPost($post, $this->path); //get buy or sale from $this->path
            if (($post->is_published == 1 && $post->purpose == $this->path) || ($post->is_published == 0 && $post->purpose == $this->path) && $post->user_id == Auth::user()->id) {
                return view($this->view .'.show', compact('post', 'similar_posts', 'profile_image', 'userbuy', 'users'));
            }

        } elseif (!empty($post) && !Auth::user()) {
            $similar_posts = $this->postService->getSimilarPost($post, $this->path);

            if (($post->is_published == 1 && $post->purpose == $this->path)) {
                return view($this->view .'.show', compact('post', 'similar_posts', 'profile_image', 'userbuy', 'users'));
            }
            abort(404);
        }
        elseif(empty($post)){
            abort(404);
        }
        abort(404);
    }

    public function destroy(Post $post)
    {
        $post = $this->postService->deletePost($post);
        return redirect(route($this->path.'.index'));
    }

    public function buyPostBrandNew(Request $request)
    {
        $manufacturers = $this->manufacturerService->getAll();
        $build_types = $this->buildTypeService->getAll();
        $profile_image = $this->profileImageService->getAll();
        $users = $this->userService->getAll();
        $posts = $this->postService->getBrandNewPost($request, GeneralType::PURPOSE_BUY);

        return view('buys.brand_new', compact('posts', 'manufacturers', 'build_types',  'profile_image', 'users'));
    }

    public function salePostBrandNew(Request $request)
    {
        $manufacturers = $this->manufacturerService->getAll();
        $build_types = $this->buildTypeService->getAll();
        $profile_image = $this->profileImageService->getAll();
        $users = $this->userService->getAll();
        $posts = $this->postService->getBrandNewPost($request, GeneralType::PURPOSE_SALE);

        return view('posts.brand_new', compact('posts', 'manufacturers', 'build_types',  'profile_image', 'users'));
    }

    public function buyPostBuildType(Request $request)
    {
        $manufacturers = $this->manufacturerService->getAll();
        $build_types = $this->buildTypeService->getAll();
        $profile_image = $this->profileImageService->getAll();
        $users = $this->userService->getAll();
        $build_type_count = $this->buildTypeService->getCount();

        $posts = $this->postService->getBuildTypePost($request, GeneralType::PURPOSE_BUY);

        return view('buys.build_type', compact('posts', 'manufacturers', 'build_types',  'profile_image', 'users', 'build_type_count'));
    }

    public function salePostBuildType(Request $request)
    {
        $manufacturers = $this->manufacturerService->getAll();
        $build_types = $this->buildTypeService->getAll();
        $profile_image = $this->profileImageService->getAll();
        $users = $this->userService->getAll();
        $build_type_count = $this->buildTypeService->getCount();

        $posts = $this->postService->getBuildTypePost($request, GeneralType::PURPOSE_SALE);

        return view('buys.build_type', compact('posts', 'manufacturers', 'build_types',  'profile_image', 'users', 'build_type_count'));
    }

    public function buyPostManufacturer(Request $request)
    {
        $manufacturers = $this->manufacturerService->getAll();
        $build_types = $this->buildTypeService->getAll();
        $profile_image = $this->profileImageService->getAll();
        $users = $this->userService->getAll();
        $manufacturer_count = $this->manufacturerService->getCount();

        $posts = $this->postService->getManufauturerPost($request, GeneralType::PURPOSE_BUY);

        return view('buys.manufacturer', compact('posts', 'manufacturers', 'build_types',  'profile_image', 'users', 'manufacturer_count'));
    }

    public function salePostManufacturer(Request $request)
    {
        $manufacturers = $this->manufacturerService->getAll();
        $build_types = $this->buildTypeService->getAll();
        $profile_image = $this->profileImageService->getAll();
        $users = $this->userService->getAll();
        $manufacturer_count = $this->manufacturerService->getCount();

        $posts = $this->postService->getManufauturerPost($request, GeneralType::PURPOSE_SALE);

        return view('buys.manufacturer', compact('posts', 'manufacturers', 'build_types',  'profile_image', 'users', 'manufacturer_count'));
    }

    public function buyPostLatest(Request $request)
    {
        $manufacturers = $this->manufacturerService->getAll();
        $build_types = $this->buildTypeService->getAll();
        $users = $this->userService->getAll();
        $profile_image = $this->profileImageService->getAll();

        $posts = $this->postService->getLatestPost(GeneralType::PURPOSE_BUY);
        return view('buys.latest', compact('posts', 'manufacturers', 'build_types', 'profile_image', 'users'));
    }

    public function salePostLatest(Request $request)
    {
        $manufacturers = $this->manufacturerService->getAll();
        $build_types = $this->buildTypeService->getAll();
        $users = $this->userService->getAll();
        $profile_image = $this->profileImageService->getAll();

        $posts = $this->postService->getLatestPost(GeneralType::PURPOSE_SALE);
        return view('posts.latest', compact('posts', 'manufacturers', 'build_types', 'profile_image', 'users'));
    }
}