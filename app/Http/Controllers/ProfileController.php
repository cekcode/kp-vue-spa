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

    public function update($id,Request $request)
    {
        $dt = Profile::find($id);
        if($request->file('image') !== null){
            $image = $request->file('image');
            $imageName = time().'-'.str_slug($request->title).'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $dt->image = $imageName;
        }
        $dt->slug = Str::slug($request->get('title'));
        $dt->title = $request->title;
        $dt->description = $request->description;
        $dt->save();
        return response()->json([
            "profile" => $dt
        ], 200);
    }

    public function destroy($id)
    {
        Profile::where('id',$id)->delete();
    }

}
