<?php

namespace GGPHP\Contribute\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContributeCreateRequest extends FormRequest
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
            'contributing_component' => 'required',
            'user_contributor.email' => 'email|unique:users,email',
        ];
    }
}
