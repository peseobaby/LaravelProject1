<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
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
            'name' => 'bail|required|',
            'email' => 'bail|required|email|',
            'password' => 'bail|required|min:3',
            'password_confirmation' => 'bail|required|same:password',
            'age' => 'required|num',
            'address' => 'required',
            'level' => 'required_without_all',
            'department' => 'required_without_all',
        ];
    }
    
    public function messages()
    {
        return [
            'name.required' =>  'Tên không để trống',
            'email.required' => 'Email không để trống',
            'email.email' => 'Email phải có định dạng @abc',
            'password.required' => 'Mật khẩu không để trống',
            'password_confirmation.required' => 'Không để trống phần này',
            'password_confirmation.same' => 'Không giống mật khẩu',
            'age.required' => ' điền tuổi',
            'address.required' => 'địa chỉ không được để trống',
            'level.required_without_all' => 'Chọn 1',
            'department.required_without_all' => 'Chọn 1',
        ];
    }
}
