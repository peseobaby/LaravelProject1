<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

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
        session()->put('user_id', request()->get('id'));
        return [
            'name' => 'bail|required|',
            'email' => 'bail|required|email',
            'age' => 'required',
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
            'age.required' => ' Điền tuổi',
            'address.required' => 'Địa chỉ không được để trống',
            'level.required_without_all' => 'Chọn 1',
            'department.required_without_all' => 'Chọn 1',
        ];
    }
}
