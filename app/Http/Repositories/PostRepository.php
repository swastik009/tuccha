<?php
/**
 * Created by PhpStorm.
 * User: Swastik
 * Date: 7/11/2019
 * Time: 10:35 PM
 */

namespace App\Http\Repositories;
use App\Post;


class PostRepository
{

    public function getAllPostWithUser(){
        /*pagination of 5 needs lazy loading at the frontend*/
        $query = Post::orderBy('id','desc')->with('user')->paginate(5);
        return $query;
    }
}