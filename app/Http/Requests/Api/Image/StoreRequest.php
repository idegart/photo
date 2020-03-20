<?php

namespace App\Http\Requests\Api\Image;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::check();
    }

    public function rules()
    {
        return [
            'file' => [
                'required', 'file', 'image',
            ],
            'title' => [
                'required', 'string',
            ]
        ];
    }

    public function getFile(): UploadedFile
    {
        return $this->file('file');
    }
}
