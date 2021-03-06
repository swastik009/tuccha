<?php
/**
 * Created by PhpStorm.
 * User: Swastik
 * Date: 7/11/2019
 * Time: 10:35 PM
 */

namespace App\Http\Repositories;
use App\Post;
use App\Http\Repositories\ImageUpload;
use Illuminate\Http\Request;

class PostRepository
{
    protected $picUploader;


    public function __construct(ImageUpload $imageUpload)
    {
        $this->picUploader = $imageUpload;
    }


    public function getParticularPost($id){

        return Post::where('id',$id)->first();
    }

    public function getAllPostWithUserId(){
        /*pagination of 5 needs lazy loading at the frontend*/
        $query = Post::orderBy('id','desc')->with('user')->paginate(5);
        return $query;
    }

    public function createPostWithUserId(Request $request){

        try {
            Post::create([
                'title' => $request->title,
                'description' => $request->description,
                'cover_pic' => $this->picUploader->uploader($request->cover_pic),
                'user_id' => $request->user_id
            ]);
         return 'successfully stored';
        }catch (\Illuminate\Database\QueryException $e){
            return ($e->getMessage());
        }

    }

    public function updatePost(Request $request, $id){

        try {
            Post::where('id',$id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'cover_pic' => $this->picUploader->uploader($request->cover_pic),
            ]);
            return 'successfully updated';
        }catch (\Illuminate\Database\QueryException $e){
            return ($e->getMessage());
        }

    }

    public function deletePost($id){
        try {
            Post::destroy($id);
            return 'successfully deleted';
        }catch (\Illuminate\Database\QueryException $e){
            return ($e->getMessage());
        }
    }


}