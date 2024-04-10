<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**/
    public function register(Request $request): JsonResponse
    {
        // Validate incoming request
        $request->validate([
            'name' => '',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);
        if(is_null($request->name)){
            $name = explode('@', $request->email)[0];
        }
        else{
            $name = $request->name;
        }
        // Create the user
        $user = User::create([
            'name' => $name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // Generate token for the user
        $token = $user->createToken('user_register_token')->plainTextToken;

        // Set token expiration time (optional)
        $user->tokens()->where('tokenable_id', $user->id)->update(['expires_at' => now()->addDays(3)]);

        return response()->json(['message' => 'Đăng ký tài khoản thành công', 'user' => $user, 'access_token' => $token], status: JsonResponse::HTTP_CREATED);
    }
    /**/
    public function login(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        $user = User::where('email',  $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            if(!$user){
                return response()->json([
                    'message' => ['Tài khoản người dùng không tồn tại trên hệ thống'],
                ], status: JsonResponse::HTTP_UNAUTHORIZED);
            }
            return response()->json([
                'message' => ['Email hoặc mật khẩu không chính xác'],
            ], status: JsonResponse::HTTP_UNAUTHORIZED);
        }

        $user->tokens()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Đăng nhập thành công',
            'name' => $user->name,
            'email' => $user->email,
            'access_token' => $user->createToken('user_login_token')->plainTextToken,
        ]);
    }
    /**/
    public function logout(Request $request)
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
