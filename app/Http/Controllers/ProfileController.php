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
    public function get($slug)
    {
        $profile = Profile::where('slug', $slug)->first();
        return response()->json([
            "profile" => $profile
        ], 200);
    }
    public function new(CreateProfileRequest $request)
    {
        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $name = str_slug($request->title) . '.' . $image->getClientOriginalExtension();
        //     $destinationPath = public_path('/uploads');
        //     $imagePath = $destinationPath . "/" . $name;
        //     $image->move($destinationPath, $name);
        //     $profile->image = $name;
        // }
        $profile = new Profile();
        $image = $request->file('image');
        $imageName = time().'-'.str_slug($request->title).'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('uploads'), $imageName);

        $profile->title = $request->get('title');
        $profile->slug = Str::slug($request->get('title'));
        $profile->image = $imageName;
        $profile->description = $request->get('description');
        $profile->save();

        return response()->json([
            "profile" => $profile
        ], 200);
    }

    public function destroy($id)
    {
        Profile::where('id',$id)->delete();
    }

}
