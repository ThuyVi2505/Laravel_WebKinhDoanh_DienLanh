<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class CategoryRequest extends FormRequest
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
                    'cat_name' => ['required', 'max:50', 'min:4', 'unique:categories'],
                    'cat_slug' => [''],
                    'isActive' => [''],
                    'parent_id'=> ['nullable','integer','not_in:'.$this->id,]
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'cat_name' => ['max:50', 'min:4', 'unique:categories,cat_name,' . $this->id],
                    'cat_slug' => [''],
                    'isActive' => [''],
                    'parent_id' => ['']
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
            'cat_name.required' => 'Tên danh mục bắt buộc nhập',
            'cat_name.max' => 'Tên danh mục chỉ được tối đa :max kí tự',
            'cat_name.min' => 'Tên danh mục phải có ít nhất :min kí tự',
            'cat_name.unique' => 'danh mục *:input* đã tồn tại',
            'parent_id.integer' => 'Trường parent_id phải là một số nguyên dương (vd: 1,2,3)',
            'parent_id.not_in' => 'parent_id không được chiếu tới chính nó',
            'parent_id.exists' => 'parent_id này không tồn tại trong danh mục',
            ''
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $response = new Response([
            'title' => request()->isMethod('post') ? 'Thêm danh mục mới' : 'Cập nhật danh mục',
            'success' => false,
            'message' => "Xảy ra lỗi",
            'error' => $validator->errors(),
        ], status: Response::HTTP_UNPROCESSABLE_ENTITY);
        throw (new ValidationException($validator, $response));
    }
}
