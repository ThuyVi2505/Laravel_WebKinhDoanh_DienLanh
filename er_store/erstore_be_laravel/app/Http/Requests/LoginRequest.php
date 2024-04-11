<?php
namespace App\Http\Requests;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
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
        return [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ];
    }
    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Email bắt buộc phải nhập',
            'email.email' => 'Email chưa đúng định dạng',
            'password.required' => 'Mật khẩu bắt buộc phải nhập',
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        $response = new Response([
            'status_code' => Response::HTTP_UNPROCESSABLE_ENTITY,
            'message' => "Xảy ra lỗi",
            'error' => $validator->errors(),
        ], status: Response::HTTP_UNPROCESSABLE_ENTITY);
        throw (new ValidationException($validator, $response));
    }
}
