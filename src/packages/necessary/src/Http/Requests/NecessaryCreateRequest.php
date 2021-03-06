<?php

namespace GGPHP\Necessary\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NecessaryCreateRequest extends FormRequest
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
            'name' => 'required|string|unique:necessaries,name',
            'unit' => 'required|string',
        ];
    }
}
