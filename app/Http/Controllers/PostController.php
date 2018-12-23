<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use Illuminate\Support\Str;
use App\Http\Requests\CreatePostsRequest;

class PostController extends Controller
{
    public function all()
    {
        $posts = Posts::all();
        
        return response()->json([
            "posts" => $posts
        ], 200);
    }
}
