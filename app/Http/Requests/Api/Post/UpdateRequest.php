<?php

namespace App\Http\Requests\Api\Post;

use App\Models\Post;
use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check() && $this->getPost()->isAuthor(Auth::user());
    }

    public function rules()
    {
        return [
            'title' => [
                'sometimes',
                'required',
                'string',
            ],
            'text' => [
                'sometimes',
                'required',
                'string',
            ],
        ];
    }

    public function getPost(): Post
    {
        return $this->route('post');
    }
}
