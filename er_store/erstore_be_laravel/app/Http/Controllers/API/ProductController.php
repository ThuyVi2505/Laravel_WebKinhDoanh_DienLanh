<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Http\Requests\ProductRequest;
use App\Models\{Product, ProductImage};

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        // get all prod list
        $all = Product::with('attributes')->get();
        // prod resource
        $allResc = ProductResource::collection($all);
        // re-type prod respond api
        $arr = [
            'title' => "Danh sách mặt hàng",
            'success' => true,
            'message' => "Lấy danh sách thành công",
            'record_total' => $all->count(),
            'data' => $allResc
        ];

        return response()->json($arr, status: Response::HTTP_OK);
    }
    /**
     * get record by id
     * @param App\Http\Requests\prod\addprodRequest $request
     * @param \Illuminate\Http\Response
     * @param int $id
     * 
     */
    public function getById($id)
    {
        $prod = Product::find($id);
        if (is_null($prod)) {
            $err = [
                'success' => false,
                'message' => "Không tìm thấy sản phẩm này...",
            ];
            return response()->json($err, status: Response::HTTP_NOT_FOUND);
        }
        // prod resource
        $Resc = new ProductResource($prod);
        // re-type prod respond api
        $arr = [
            'success' => true,
            'message' => "Lấy thông tin mặt hàng thành công",
            'data' => $Resc
        ];

        return response()->json($arr, status: Response::HTTP_OK);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $dataCreate = $request->all();

        $prod = new Product($dataCreate);
        $prod->prod_name = $request->prod_name;
        $prod->prod_slug = Str::slug($request->prod_name);
        $prod->isActive = is_null($request->isActive) ? 0 : $request->isActive;
        $prod->prod_price = $request->prod_price;
        $prod->prod_stock = $request->prod_stock;
        $prod->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $prod->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        // if ($request->hasfile('thumnail')) {

        //     $file = $request->file('thumnail');
        //     $ext = $file->getClientOriginalExtension();
        //     date_default_timezone_set("Asia/Ho_Chi_Minh");
        //     $file_name = Str::slug($request->prod_name, '-') . '_' . date('Hisdmy') . '.' . $ext;
        //     $file->move(public_path() . '/uploads/images/prod/', $file_name);
        //     // $path = $file->storeAs('public/uploads/ThuongHieu', $file_name);

        //     $prod->thumnail = asset('uploads/images/prod/' . $file_name);
        // }
        $prod->save($dataCreate);
        // return($prod->prod_name);
        // Upload images and associate with product
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {

                $ext = $file->getClientOriginalExtension();
                date_default_timezone_set("Asia/Ho_Chi_Minh");
                $file_name = Str::slug($prod->prod_name, '-') . '_' . date('Hisdmy') . '.' . $ext;
                $file->move(public_path() . '/uploads/images/product/'. $prod->prod_slug.'/', $file_name);
                $urlImage = asset('uploads/images/product/'. $prod->prod_name.'/', $file_name);
                
                $prod->productImages()->create([
                    'prod_id'=>$prod->id,
                    'image'=>$urlImage
                ]);
            };
            
        }

        // prod resource
        $Resc = new ProductResource($prod);
        // re-type prod respond api
        $arr = [
            'title' => "Thêm mặt mới",
            'success' => true,
            'message' => "Thêm thành công",
            'data' => $Resc
        ];
        return response()->json($arr, status: Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
