<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use App\Http\Requests\ImageRequest;
use App\Models\{Product, Image};

class ImageController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadImage_Product(ImageRequest $request, $id)
    {
        $dataCreate = $request->all();

        $prod = Product::findOrFail($id);
        if ($request->hasFile('images')) {
            $allowedfileExtension = ['jped', 'jpg', 'png'];
            $files = $request->file('images');
            foreach ($files as $key => $file) {
                $ext = $file->getClientOriginalExtension();
                $check = in_array($ext, $allowedfileExtension);
                if ($check) {
                    date_default_timezone_set("Asia/Ho_Chi_Minh");
                    $file_name = date('Hisdmy') . $key . '.' . $ext;
                    $file->move(public_path() . '/uploads/images/product/' . $prod->prod_slug . '/', $file_name);
                    $urlImage = asset('uploads/images/product/' . $prod->prod_slug . '/' . $file_name);

                    $image = new Image();
                    $image->prod_id = $prod->id;
                    $image->image = $urlImage;
                    $image->save();
                }
            };
            // prod resource
            // re-type prod respond api
            $arr = [
                'title' => "Thêm ảnh cho sản phẩm",
                'success' => true,
                'message' => "Thêm ảnh thành công",
            ];
        }
        else{
            // prod resource
        // re-type prod respond api
        $arr = [
            'title' => "Thêm ảnh cho sản phẩm",
            'success' => false,
            'message' => "Thêm thất bại, chưa chọn file ảnh",
        ];
        }

        return response()->json($arr, status: Response::HTTP_CREATED);
    }
}
