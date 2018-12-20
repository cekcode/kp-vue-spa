<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Peran;
use Illuminate\Support\Str;
use App\Http\Requests\CreatePeranRequest;

class PeranController extends Controller
{
    public function all()
    {
        $perans = Peran::all();
        return response()->json([
            "perans" => $perans
        ], 200);
    }

    public function new(CreatePeranRequest $request)
    {
        $peran = new Peran();
        $peran->title = $request->get('title');
        $peran->slug = Str::slug($request->get('title'));
        $peran->save();

        return response()->json([
            "peran" => $peran
        ], 200);
    }

    public function destroy($id)
    {
        Peran::where('id',$id)->delete();
    }

    public function update($id,Request $request)
    {
        $this->validate($request, [
            'title' =>  'required'
        ]); 

        $dt = Peran::find($id);
        $dt->slug = Str::slug($request->title);
        $dt->title = $request->title;
        $dt->save();
        // return response()->json([
        //     "peran" => $dt
        // ], 200);
    }
}
