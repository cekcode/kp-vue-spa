<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
use Illuminate\Support\Str;
use App\Http\Requests\CreateKategoriRequest;

class KategoriController extends Controller
{
    public function all()
    {
        
        $kategoris = Kategori::with('perans')->get();
        return response()->json([
            "kategoris" => $kategoris
        ], 200);
    }

    public function new(CreateKategoriRequest $request)
    {
        $kategori = new Kategori;
        $kategori->title = $request->title;
        $kategori->slug = Str::slug($request->get('title'));
        $kategori->save();
        $kategori->perans()->sync($request->peran_id);
        
        return response()->json([
            "kategori" => $kategori
        ], 200);

    }

    public function destroy($id)
    {
        Kategori::where('id',$id)->delete();
    }
}
