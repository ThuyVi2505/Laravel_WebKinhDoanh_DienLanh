<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**/
    public function getUserLogged(Request $request):JsonResponse
    {
        $user = $request->user();
        if (!$user) {
            return response()->json([
                'message' => ['Tài khoản chưa đăng nhập'],
            ], status: JsonResponse::HTTP_UNAUTHORIZED);
        } // Retrieve authenticated user using access token
        
        return response()->json($user);
    }
    /**/
    public function changePassword(Request $request):JsonResponse
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8',
        ]);

        $user = $request->user();

        // Check if the current password matches the user's password
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => ['Mật khẩu hiện tại không khớp'],
            ], status: JsonResponse::HTTP_UNAUTHORIZED);
        }

        // Update the user's password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json(['message' => 'Đổi mật khẩu thành công'],status: JsonResponse::HTTP_OK);
    }
    /**/
    public function updateProfile(Request $request){
        $request->validate([
            'name' => 'required',
            'phone' => 'min:10|max:12',
        ]);
        $user = $request->user();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->save();
        return response()->json(['message' => 'Cập nhật thông tin cá nhân thành công'],status: JsonResponse::HTTP_OK);
    }
}
