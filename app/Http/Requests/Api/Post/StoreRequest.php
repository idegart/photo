<?php

namespace App\Http\Requests\Api\Post;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'title' => [
                'required',
                'string',
            ],
            'text' => [
                'required',
                'string',
            ],
        ];
    }
}
