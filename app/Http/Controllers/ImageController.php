<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        $image = $request->file('image');
        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('uploads'), $imageName);

        return response()->json([
            "url" => $imageName
        ], 200);
    } 
}
