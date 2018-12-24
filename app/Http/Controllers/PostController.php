<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Kategori;
use App\Peran;
use Illuminate\Support\Str;
use App\Http\Requests\CreatePostRequest;

class PostController extends Controller
{
    public function all()
    {
        $posts = Post::all();
        
        return response()->json([
            "posts" => $posts
        ], 200);
    }

    public function getkategori($id)
    {   
        $kategoris = Peran::where('id', $id)->with('kategoris')->get();
        return response()->json([
            "kategoris" => $kategoris
        ], 200);
    }
}
