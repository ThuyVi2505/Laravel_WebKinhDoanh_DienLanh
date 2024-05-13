<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    public function login_form(){
        return view('admin.auth.login');
    }
    public function login_submit(Request $request)
    {
        $data = $request->all();

        $request->validate(
            [
                'email' => 'required|email|max:255',
                'password' => 'required|min:8',
            ],
            [
                'email.required' => 'Email không được bỏ trống',
                'email.email' => 'Sai định dạng mail.',
                'email.max' => 'Email chỉ được tối đa 255 kí tự',
                'password.required' => 'Mật khẩu không được bỏ trống',
                'password.min' => 'Mật khẩu cần ít nhất 8 kí tự'
            ]
        );

        if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công!!!');
        } else {
            return back()->with('error', 'Sai thông tin đăng nhập!!!');
        }
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login_form');
    }
}
