<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\Http\Requests\CreateProfileRequest;

class ProfileController extends Controller
{
    public function all()
    {
        $profiles = Profile::all();
        return response()->json([
            "profiles" => $profiles
        ], 200);
    }
    public function get($id)
    {
        $profile = Profile::whereId($id)->first();
        return response()->json([
            "profile" => $profile
        ], 200);
    }
    public function new(CreateProfileRequest $request)
    {
        $profile = Profile::create($request->only(["title", "image", "description"]));

        return response()->json([
            "profile" => $profile
        ], 200);
    }
}
