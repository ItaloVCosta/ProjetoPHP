<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{

    public function list()
    {
        return Post::all();
    }

    public function insert(Request $req)
    {
        $post = new Post;
        $post->id=$req->id;
        $post->title=$req->title;
        $post->slug=$req->slug;
        $post->save();
        return ["Result"=> "Data has been saved"];
    }

    
}
