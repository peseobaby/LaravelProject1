<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
        ];
    }
     public function messages()
    {
        return [
            'password.required' => 'Mật khẩu không để trống',
            'password_confirmation.required' => 'Không để trống phần này',
            'password_confirmation.same' => 'Không giống mật khẩu',
        ];
    }
}
