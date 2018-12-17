<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pelayanan;
use App\Http\Requests\CreatePelayananRequest;
use Illuminate\Support\Str;

class PelayananController extends Controller
{
    public function all()
    {
        $pelayanans = Pelayanan::all();
        return response()->json([
            "pelayanans" => $pelayanans
        ], 200);
    }

    public function new(CreatePelayananRequest $request)
    {
        $pelayanan = new Pelayanan();
        $pelayanan->title = $request->get('title');
        $pelayanan->slug = Str::slug($request->get('title'));
        $pelayanan->description = $request->get('description');
        $pelayanan->save();

        return response()->json([
            "pelayanan" => $pelayanan
        ], 200);
    }

    public function destroy($id)
    {
        Pelayanan::where('id',$id)->delete();
    }

    public function get($slug)
    {
        $pelayanan = Pelayanan::where('slug', $slug)->first();
        return response()->json([
            "pelayanan" => $pelayanan
        ], 200);
    }

    public function update($id,Request $request)
    {
        $this->validate($request, [
            'title' =>  'required',
            'description'  =>  'required'
        ]);

        $dt = Pelayanan::find($id);
        $dt->slug = Str::slug($request->title);
        $dt->title = $request->title;
        $dt->description = $request->description;
        $dt->save();
        return response()->json([
            "pelayanan" => $dt
        ], 200);
    }

}
