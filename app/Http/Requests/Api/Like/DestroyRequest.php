<?php

namespace App\Http\Requests\Api\Like;

use App\Models\Like;
use Auth;
use Illuminate\Foundation\Http\FormRequest;

class DestroyRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check() && $this->getLike()->isAuthor(Auth::user());
    }

    public function rules()
    {
        return [
            //
        ];
    }

    public function getLike(): Like
    {
        return $this->route('like');
    }
}
