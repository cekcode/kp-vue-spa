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

    public function new(CreatePostRequest $request)
    {
        $post = new Post;
        $image = $request->file('image');
        $imageName = time().'-'.str_slug($request->title).'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('uploads'), $imageName);

        $post->title = $request->title;
        $post->slug = Str::slug($request->get('title'));
        $post->image = $imageName;
        $post->status = $request->status;
        $post->description = $request->description;
        $post->save();
        $post->kategoris()->sync($request->kategori_id);
        
        return response()->json([
            "post" => $post
        ], 200);

    }
}
