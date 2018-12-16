<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CreateProfileRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        return [
            "title" => "required|min:3|max:100|unique:profile,title,'.$request->id",
            "image" => "mimes:jpeg,png,jpg,gif",
            "description" => "required"
        ];
    }
}
