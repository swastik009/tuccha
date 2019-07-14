<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Http\Resources\PostResource;
use App\Http\Repositories\PostRepository;
class PostController extends Controller
{



    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
       $this->middleware('auth:api')->only(['store ','update','destroy']);
        $this->postRepository = $postRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = $this->postRepository->getAllPostWithUserId();
        return PostResource::collection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $query = $this->postRepository->createPostWithUserId($request);
        return json_encode($query);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $query = $this->postRepository->getParticularPost($id);
        return json_encode($query);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $query = $this->postRepository->updatePost($request,$id);
        return json_encode($query);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $query = $this->postRepository->deletePost($id);
        return json_encode($query);
    }
}
