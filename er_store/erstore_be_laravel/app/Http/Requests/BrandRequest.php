<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class BrandRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        switch (request()->method()) {
            case 'POST':
                return [
                    'brand_name' => ['required', 'max:50', 'min:4', 'unique:brands'],
                    'brand_slug' => [''],
                    'isActive' => [''],
                    // 'thumnail' => [''],
                    'thumnail' => ['required', 'mimes:jpeg,png,jpg'],
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'brand_name' => ['max:50', 'min:4', 'unique:brands,brand_name,'. $this->id],
                    'brand_slug' => [''],
                    'isActive' => [''],
                    // 'thumnail' => [''],
                    'thumnail' => ['nullable', 'mimes:jpeg,png,jpg'],
                ];
        }
    }
    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'brand_name.required' => 'Tên thương hiệu bắt buộc nhập',
            'brand_name.max' => 'Tên thương hiệu chỉ được tối đa :max kí tự',
            'brand_name.min' => 'Tên thương hiệu phải có ít nhất :min kí tự',
            'brand_name.unique' => 'Thương hiệu *:input* đã tồn tại',
            'thumnail.required' => 'Hình ảnh bắt buộc phải có',
            'thumnail.mimes' => 'Phải chọn file có đuôi .jpeg|png|jpg|svg',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $response = new Response([
            'title' => request()->isMethod('post') ? 'Thêm thương hiệu mới' : 'Cập nhật thương hiệu',
            'success' => false,
            'message' => "Xảy ra lỗi",
            'error' => $validator->errors(),
        ], status: Response::HTTP_UNPROCESSABLE_ENTITY);
        throw (new ValidationException($validator, $response));
    }
}
