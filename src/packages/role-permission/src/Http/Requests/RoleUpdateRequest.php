<?php

namespace GGPHP\RolePermission\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleUpdateRequest extends FormRequest
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
            'name' => [
                Rule::unique('roles')->ignore($this->id),
            ],
            'user_id' => 'array',
            'user_id.*' => [
                Rule::unique('model_has_roles', 'model_id')->ignore($this->route('id'), 'role_id')->where(function ($query) {
                    $query->where(['model_type' => 'GGPHP\Users\Models\User']);
                }),
            ],
        ];
    }
}