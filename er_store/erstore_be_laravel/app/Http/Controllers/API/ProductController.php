<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Http\Requests\ProductRequest;
use App\Models\{Category, Image, Product, SaleProd};

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll(Request $request)
    {
        $query = Product::query();
        if($request->has('id')){
            $query->where('id', $request->id);
        }
        if ($request->has('isActive')) {
            $query->where('isActive', $request->isActive);
        }

        if ($request->has('prod_name')) {
            $query->where('prod_name', 'like', '%' . $request->prod_name . '%');
        }
        if ($request->has('prod_model')) {
            $query->where('prod_model', 'like', '%' . $request->prod_model . '%');
        }
        if ($request->has('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }
        if ($request->has('cat_id')) {
            $cat_list = Category::where('id',$request->cat_id)->orWhere('parent_id',$request->cat_id)->get()->pluck('id');
            $query->whereIn('cat_id', $cat_list);
        }

        $all = $query->get();
        // prod resource
        $allResc = ProductResource::collection($all);
        // re-type prod respond api
        $arr = [
            'success' => true,
            'message' => "Lấy dữ liệu thành công",
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
                'message' => "Không tìm thấy...",
            ];
            return response()->json($err, status: Response::HTTP_NOT_FOUND);
        }
        // prod resource
        $Resc = new ProductResource($prod);
        // re-type prod respond api
        $arr = [
            'success' => true,
            'message' => "Lấy thông tin thành công",
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
    // public function store(ProductRequest $request)
    // {
    //     $dataCreate = $request->all();

    //     $prod = new Product($dataCreate);
    //     $prod->prod_name = $request->prod_name;
    //     $prod->prod_slug = Str::slug($request->prod_name).'-'.Str::slug($request->prod_model);
    //     $prod->isActive = is_null($request->isActive) ? 0 : $request->isActive;
    //     $prod->prod_price = $request->prod_price;
    //     $prod->prod_stock = $request->prod_stock;
    //     $prod->origin_country = $request->origin_country;
    //     $prod->guarantee_period = $request->guarantee_period;
    //     $prod->created_at = Carbon::now('Asia/Ho_Chi_Minh');
    //     $prod->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
    //     $prod->save($dataCreate);
    //     // Upload images and associate with product
    //     // $prod = Product::find(33);

    //     if ($request->hasFile('images')) {
    //         $allowedfileExtension = ['jped', 'jpg', 'png'];
    //         $files = $request->file('images');
    //         foreach ($files as $key => $file) {
    //             $ext = $file->getClientOriginalExtension();
    //             $check = in_array($ext, $allowedfileExtension);
    //             if ($check) {
    //                 date_default_timezone_set("Asia/Ho_Chi_Minh");
    //                 $file_name = Str::slug($request->prod_name, '-') . '_' . date('Hisdmy') . $key  . '.' . $ext;
    //                 $file->storeAs('public/uploads/Product/'.$prod->id.'/', $file_name);
    //                 // $file->move(public_path() . '/uploads/images/product/'.$prod->prod_slug.'/', $file_name);
    //                 $urlImage = $file_name;

    //                 $image = new Image();
    //                 $image->prod_id = $prod->id;
    //                 $image->image = $urlImage;
    //                 $image->save();
    //             }
    //         };
    //     }
    //     if(!is_null($request->sale_percent)){
    //         $sale = new SaleProd();
    //         $sale->product_id = $prod->id;
    //         $sale->percent = $request->sale_percent;
    //         $sale->save();
    //     }
    //     else{
    //         $sale = new SaleProd();
    //         $sale->product_id = $prod->id;
    //         $sale->percent = 0;
    //         $sale->save();
    //     }
    //     // prod resource
    //     $Resc = new ProductResource($prod);
    //     // re-type prod respond api
    //     $arr = [
    //         'title' => "Thêm mặt mới",
    //         'success' => true,
    //         'message' => "Thêm thành công",
    //         'data' => $Resc
    //     ];
    //     return response()->json($arr, status: Response::HTTP_CREATED);
    // }

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
