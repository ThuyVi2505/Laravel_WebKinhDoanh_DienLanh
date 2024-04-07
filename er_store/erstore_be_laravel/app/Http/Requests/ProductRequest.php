<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class ProductRequest extends FormRequest
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
                    'prod_name' => ['required', 'max:255', 'min:4', 'unique:products'],
                    'prod_slug' => [''],
                    'prod_price'=> ['required', 'integer'],
                    'prod_stock'=>['required','integer'],
                    'isActive' => [''],
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'prod_name' => ['max:255', 'min:4', 'unique:products,prod_name,'. $this->id],
                    'prod_slug' => [''],
                    'prod_price'=> ['required', 'integer'],
                    'prod_stock'=>['required','integer'],
                    'isActive' => [''],
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
            'prod_name.required' => 'Tên mặt hàng bắt buộc nhập',
            'prod_name.max' => 'Tên mặt hàng chỉ được tối đa :max kí tự',
            'prod_name.min' => 'Tên mặt hàng phải có ít nhất :min kí tự',
            'prod_name.unique' => 'Mặt hàng *:input* đã tồn tại',
            'prod_price.required' => 'Giá mặt hàng bắt buộc nhập',
            'prod_stock.required' => 'Số lượng mặt hàng bắt buộc nhập',
            'prod_price.integer' => 'Trường prod_price phải là một số nguyên dương (vd: 1,2,3)',
            'prod_stock.integer' => 'Trường prod_stock phải là một số nguyên dương (vd: 1,2,3)',
            'image' => ['nullable', 'mimes:jpeg,png,jpg,svg'],
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $response = new Response([
            'title' => request()->isMethod('post') ? 'Thêm mặt hàng mới' : 'Cập nhật mặt hàng',
            'success' => false,
            'message' => "Xảy ra lỗi",
            'error' => $validator->errors(),
        ], status: Response::HTTP_UNPROCESSABLE_ENTITY);
        throw (new ValidationException($validator, $response));
    }
}
