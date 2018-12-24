<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CreatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function rules(Request $request)
    {
        return [
            "title" => "required|min:3|max:100|unique:posts,title,'.$request->id",
            "image" => "mimes:jpeg,png,jpg,gif",
            "description" => "required"
        ];
    }
}
