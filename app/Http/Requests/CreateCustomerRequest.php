<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCustomerRequest extends FormRequest
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
            'name' => 'required|min:3',
            'email' => 'required|unique:customer|email',
            'dob' => 'required|date|before:today',
            'image' => 'image'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Không được để trống',
            'name.min' => 'Cần ít nhất 3 ký tự',
            'email.required' => 'Không được để trống',
            'email.unique' => 'Email đã đăng ký',
            'email.email' => 'Sai định dạng',
            'dob.required' => 'Không được để trống',
            'dob.date' => 'Sai định dạng',
            'dob.before' => 'Ngày sinh không được quá ngày hiện tại',
            'image.image' => 'Không đúng định dạng file (jpeg, png, bmp, gif, or svg)'
        ];
    }
}
