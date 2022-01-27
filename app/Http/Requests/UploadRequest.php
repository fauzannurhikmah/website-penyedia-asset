<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\FileType;

class UploadRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|exists:categories,id',
            'tags' => 'required',
            'software' => 'required|exists:software,id',
            'render' => 'required|exists:renders,id',
            'licensing' => 'required|boolean',
            'file' => 'required|mimes:zip,c4d,obj,3ds',
            'preview' => 'required|mimes:jpg,png,jpeg|max:2048',
        ];
    }
}
