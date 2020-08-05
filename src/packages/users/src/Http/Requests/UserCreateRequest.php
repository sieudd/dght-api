<?php

namespace GGPHP\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'email' => 'required|email|unique:users,email',
            'full_name' => 'required|string',
            'division_id' => 'required|exists:divisions,id',
            'birthday' => 'sometimes|date|before:today',
            'gender' => 'sometimes|string|in:' . $genderValues,
            'id_card' => 'sometimes|string|min:9',
        ];
    }
}
