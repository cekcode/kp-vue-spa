<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\Http\Requests\CreateProfileRequest;
use Illuminate\Support\Str;

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
        $profile = new Profile();
        $profile->title = $request->get('title');
        $profile->slug = Str::slug($request->get('title'));
        $profile->image = $request->get('image');
        $profile->description = $request->get('description');
        $profile->save();
        return response()->json([
            "profile" => $profile
        ], 200);
    }
}
