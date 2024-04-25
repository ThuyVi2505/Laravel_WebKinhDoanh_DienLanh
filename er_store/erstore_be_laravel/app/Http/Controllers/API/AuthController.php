<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Http\Requests\{LoginRequest, RegisterRequest};

class AuthController extends Controller
{
    protected function hash($string){
        return hash('sha256', $string . config('app.encryption_key'));
    }
    /**/
    public function register(RegisterRequest $request): JsonResponse
    {
        // Validate incoming request
        $request->all();
        if (is_null($request->name)) {
            $name = explode('@', $request->email)[0];
        } else {
            $name = $request->name;
        }
        // Create the user
        $user = User::create([
            'name' => $name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // Generate token for the user
        // $token = $user->createToken('user_register_token')->plainTextToken;

        // Set token expiration time (optional)
        // $user->tokens()->where('tokenable_id', $user->id)->update(['expires_at' => now()->addDays(3)]);

        return response()->json(['status_code'=>JsonResponse::HTTP_CREATED,'message' => 'Đăng ký tài khoản thành công', 'user' => $user], status: JsonResponse::HTTP_CREATED);
    }
    /**/
    public function login(LoginRequest $request): JsonResponse
    {
        // Validate incoming request
        $dataCreate = $request->all();

        $user = User::where('email',  $dataCreate['email'])->first();
        if (!$user || !Hash::check($dataCreate['password'], $user->password)) {
            return response()->json([
                'status_code' => JsonResponse::HTTP_UNAUTHORIZED,
                'message' => ['Email hoặc mật khẩu không chính xác'],
            ], status: JsonResponse::HTTP_UNAUTHORIZED);
        }

        $user->tokens()->delete();
        // $user->tokens()->where('tokenable_id', $user->id)->update(['expires_at' => now()->addDays(3)]);
        return response()->json([
            'status_code' => JsonResponse::HTTP_OK,
            'message' => 'Đăng nhập thành công',
            'auth_response' => [
                'name' => $user->name,
                'email' => $user->email,
                'access_token' => $user->createToken('user_login_token')->plainTextToken,
                // 'expires_at' => $user->expires_at
            ]
        ], status: JsonResponse::HTTP_OK);
    }
    /**/
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Đăng xuất tài khoản thành công'
            ],
            status: JsonResponse::HTTP_OK
        );
    }
}
