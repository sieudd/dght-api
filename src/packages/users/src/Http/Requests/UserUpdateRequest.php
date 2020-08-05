<?php

namespace GGPHP\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
        $genderValues = implode(',', config('constants.GENDER_VALUES.COLLECTIONS'));

        return [
            'email' => 'email|unique:users,email,' . $this->route('user'),
            'full_name' => 'string',
            'birthday' => 'nullable|date|before:today',
            'gender' => 'nullable|string|in:' . $genderValues,
            'id_card' => 'nullable|string|min:9',
        ];
    }
}
