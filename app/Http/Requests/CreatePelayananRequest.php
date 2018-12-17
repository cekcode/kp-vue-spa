<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CreatePelayananRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        return [
            "title" => "required|min:3|max:100|unique:pelayananmedik,title,'.$request->id",
            "description" => "required"
        ];
    }
}
