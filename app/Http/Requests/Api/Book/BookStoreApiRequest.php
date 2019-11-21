<?php

namespace App\Http\Requests\Api\Book;

use Illuminate\Foundation\Http\FormRequest;

class BookStoreApiRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "title"             =>  "required|string",
            "count_page"        =>  "required|number|min:1|max:150",
            "annotation"        =>  "required|string",
            // "picture"        =>  "https://lorempixel.com/50/50/people/?46307",
            "author_name"       =>  "required|string|min:2",
            "author_lastname"   =>  "required|string|min:2",
        ];
    }
}
