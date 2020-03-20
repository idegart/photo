<?php

namespace App\Http\Requests\Api\Image;

use App\Models\Image;
use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check() && $this->getImage()->isAuthor(Auth::user());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => [
                'sometimes',
                'required',
                'string'
            ]
        ];
    }

    public function getImage(): Image
    {
        return $this->route('image');
    }
}
