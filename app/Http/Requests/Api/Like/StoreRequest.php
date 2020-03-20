<?php

namespace App\Http\Requests\Api\Like;

use App\Models\Image;
use App\Models\Post;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'type' => [
                'required',
                Rule::in([ 'post', 'image' ]),
            ],
            'id' => [
                'required',
                Rule::exists($this->getTableOfType(), 'id')
            ],
        ];
    }

    public function getTableOfType(): ?string
    {
        return $this->getModelOfType()->getTable();
    }

    public function getModelOfType(): Model
    {
        switch ($this->input('type')) {
            case 'post': return new Post;
            case 'image': return new Image;
        }

        return null;
    }
}
