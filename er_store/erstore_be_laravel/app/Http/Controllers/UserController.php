<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User, Order, Address};

class UserController extends Controller
{
    //
    public function index(){
        $users = User::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.user.index')->with(compact('users'));
    }
    
    public function show($id){
        $userDetail = User::find($id);
        $orders = Order::where('user_id',$id)->orderBy('created_at','desc')->paginate(5);
        $address = Address::where('user_id',$id)->orderBy('created_at','desc')->get();
        return view('admin.user.detail')->with(compact('userDetail','orders','address'));
    }
}
