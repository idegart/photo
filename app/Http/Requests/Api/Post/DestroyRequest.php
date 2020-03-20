<?php

namespace App\Http\Requests\Api\Post;

use App\Models\Post;
use Auth;
use Illuminate\Foundation\Http\FormRequest;

class DestroyRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check() && $this->getPost()->isAuthor(Auth::user());
    }

    public function rules()
    {
        return [];
    }

    public function getPost(): Post
    {
        return $this->route('post');
    }
}
