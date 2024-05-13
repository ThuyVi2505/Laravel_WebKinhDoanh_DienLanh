<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function addAddress(Request $request){
        $data=$request->validate([
            'number' => 'required|string',
            'street' => 'required|string',
            'ward' => 'required|string',
            'district' => 'required|string',
            'city' => 'required|string',
        ]);
        $user = $request->user();
        if (!$user) {
            return response()->json([
                'message' => ['Tài khoản chưa đăng nhập'],
            ], status: JsonResponse::HTTP_UNAUTHORIZED);
        } // Retrieve authenticated user using access token

        $address = new Address($data);
        $address->user_id = $user->id;
        $address->number = $request->number;
        $address->street = $request->street;
        $address->ward = $request->ward;
        $address->district = $request->district;
        $address->city = $request->city;

        $address->save($data);
        $arr = [
            'success' => true,
            'message' => "Thêm thành công",
        ];
        return response()->json($arr, status: Response::HTTP_CREATED);
    }
    
    public function updateAddress(Request $request, $id){
        
        $user = $request->user();
        if (!$user) {
            return response()->json([
                'message' => ['Tài khoản chưa đăng nhập'],
            ], status: JsonResponse::HTTP_UNAUTHORIZED);
        } // Retrieve authenticated user using access token
        
        $address = Address::find($id);

        $data=$request->validate([
            'number' => 'required|string',
            'street' => 'required|string',
            'ward' => 'required|string',
            'district' => 'required|string',
            'city' => 'required|string',
        ]);

        $address->user_id = $user->id;
        $address->number = $request->number;
        $address->street = $request->street;
        $address->ward = $request->ward;
        $address->district = $request->district;
        $address->city = $request->city;

        $address->update($data);

        $arr = [
            'success' => true,
            'message' => "Cập nhật thành công",
        ];
        return response()->json($arr, status: Response::HTTP_CREATED);
    }
}
