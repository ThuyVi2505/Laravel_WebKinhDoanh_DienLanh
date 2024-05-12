<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Image;
use App\Models\SaleProd;
use App\Models\Attribute;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // $allProduct = Product::orderBy('created_at', 'desc')->paginate(10);
        $allProduct = Product::query()
            ->when($request->category != null, function ($query) use ($request) {
                // $cat = Category::find($request->category)->first();
                // if($cat->parent_id != null){
                //     return $query->where('cat_id', $request->category);
                // }
                // else{
                //     $child = Category::where('parent_id', $request->category)->get();
                //     for
                // }
                $query->where('cat_id', $request->category)
                    ->orWhereIn('cat_id', function ($query) use ($request) {
                        $query->select('id')
                            ->from('categories')
                            ->where('parent_id', $request->category);
                    });
            })
            ->when($request->brand != null, function ($query) use ($request) {
                return $query->where('brand_id', $request->brand);
            })
            ->when($request->status != null, function ($query) use ($request) {
                return $query->where('isActive', ($request->status=="kichhoat"?1:0));
            })
            ->when($request->searchBox != null, function ($query) use ($request) {
                return $query
                ->where('prod_name', 'like', '%' . $request->searchBox . '%')
                ->orWhere('prod_model', 'like', '%' . $request->searchBox . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $brand_list = Brand::orderBy('brand_name', 'asc')->get();
        $category_list = Category::where('parent_id', null)->orderBy('cat_name', 'asc')->get();
        return view('admin.product.index')->with(compact('allProduct','brand_list','category_list'));
    }
    public function show($id)
    {
        $productDetail = Product::find($id);
        $attributes = $productDetail->attributes()->wherePivotNotNull('value')->orderBy('created_at','asc')->get();
        // $attributes = Attribute::where($product);
        return view('admin.product.detail')->with(compact('productDetail', 'attributes'));
    }

    public function create()
    {
        $attributes = Attribute::all();
        $category_list = Category::where('parent_id', null)->orderBy('cat_name', 'asc')->get();
        $brand_list = Brand::orderBy('brand_name', 'asc')->get();
        return view('admin.product.create')->with(compact('attributes', 'category_list', 'brand_list'));
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'prod_name' => ['required', 'max:255', 'min:4'],
                'prod_model' => ['required', 'max:255', 'min:6', 'unique:products'],
                'prod_slug' => [''],
                'prod_price' => ['required', 'integer'],
                'prod_stock' => ['required', 'integer','between:0,1000'],
                'prod_description' => [''],
                'origin_country' => [''],
                'guarantee_period' => [''],
                'brand_id' => ['required'],
                'cat_id' => ['required'],
                'isActive' => [''],
                'sale_percent' => [''],
                'images.*' => ['required', 'image', 'mimes:jpg,png,jpeg']
            ],
            [
                'prod_name.required' => 'Tên mặt hàng bắt buộc nhập',
                'prod_name.max' => 'Tên mặt hàng chỉ được tối đa :max kí tự',
                'prod_name.min' => 'Tên mặt hàng phải có ít nhất :min kí tự',

                'prod_model.required' => 'Model mặt hàng bắt buộc nhập',
                'prod_model.max' => 'Model mặt hàng chỉ được tối đa :max kí tự',
                'prod_model.min' => 'model mặt hàng phải có ít nhất :min kí tự',
                'prod_model.unique' => 'Model Mặt hàng này *:input* đã tồn tại',

                'prod_price.required' => 'Giá mặt hàng bắt buộc nhập',
                'prod_stock.required' => 'Số lượng mặt hàng bắt buộc nhập',
                'prod_price.integer' => 'Phải là một số nguyên dương (vd: 1,2,3)',
                'prod_stock.integer' => 'Phải là một số nguyên dương (vd: 1,2,3)',
                'prod_stock.between' => 'Phải nằm trong khoảng từ 0 đến 1000',

                'brand_id.required' => 'Thương hiệu bắt buộc chọn',
                'cat_id.required' => 'Danh mục bắt buộc chọn'
            ],
        );
        $prod = new Product();
        $prod->prod_name = $request->prod_name;
        $prod->prod_model = $request->prod_model;
        $prod->prod_slug = Str::slug($request->prod_name)."-".Str::slug($request->prod_model);
        $prod->isActive = is_null($request->isActive) ? 0 : $request->isActive;
        $prod->prod_price = $request->prod_price;
        $prod->prod_stock = $request->prod_stock;
        $prod->prod_description = $request->prod_description;
        $prod->brand_id = $request->brand_id;
        $prod->cat_id = $request->cat_id;
        $prod->origin_country = $request->origin_country;
        $prod->guarantee_period = $request->guarantee_period;
        $prod->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $prod->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $prod->save();
        // Upload images and associate with product
        // $prod = Product::find(33);

        if ($request->hasFile('images')) {
            $allowedfileExtension = ['jped', 'jpg', 'png'];
            $files = $request->file('images');
            foreach ($files as $key => $file) {
                $ext = $file->getClientOriginalExtension();
                $check = in_array($ext, $allowedfileExtension);
                if ($check) {
                    date_default_timezone_set("Asia/Ho_Chi_Minh");
                    $file_name = Str::slug($request->prod_name, '-') . '_' . date('Hisdmy') . $key  . '.' . $ext;
                    $file->storeAs('public/uploads/Product/' . $prod->id . '/', $file_name);
                    // $file->move(public_path() . '/uploads/images/product/'.$prod->prod_slug.'/', $file_name);
                    $urlImage = $file_name;

                    $image = new Image();
                    $image->prod_id = $prod->id;
                    $image->image = $urlImage;
                    $image->save();
                }
            };
        }
        if (!is_null($request->sale_percent)) {
            $sale = new SaleProd();
            $sale->product_id = $prod->id;
            $sale->percent = $request->sale_percent;
            $sale->save();
        } else {
            $sale = new SaleProd();
            $sale->product_id = $prod->id;
            $sale->percent = 0;
            $sale->save();
        }
        // foreach ($request->input('attributes', []) as $attributeId => $value) {
        //     if ($value != null) {
        //         $prod->attributes()->attach($attributeId, ['value' => $value]);
        //     }
        // }
        $attributes = $request->input('attributes', []);
        $values = $request->input('values', []);

        foreach ($attributes as $key => $attributeId) {
            if ($attributeId !== null && $values[$key] !== null) {
                $prod->attributes()->attach($attributeId,['value' => $values[$key]]);
            }
        }
        
        return back()->with('success', 'Thêm thành công');
    }
    public function edit($id)
    {
        $productDetail = Product::find($id);
        $attributes = Attribute::all();
        $category_list = Category::where('parent_id', null)->orderBy('cat_name', 'asc')->get();
        $brand_list = Brand::orderBy('brand_name', 'asc')->get();
        return view('admin.product.edit')->with(compact('productDetail', 'attributes', 'category_list', 'brand_list'));
    }
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'prod_name' => ['required', 'max:255', 'min:4'],
                'prod_model' => ['required', 'max:255', 'min:6', 'unique:products,prod_name,' . $id],
                'prod_slug' => [''],
                'prod_price' => ['required', 'integer'],
                'prod_stock' => ['required', 'integer','between:0,1000'],
                'origin_country' => [''],
                'guarantee_period' => [''],
                'brand_id' => ['required'],
                'cat_id' => ['required'],
                'isActive' => [''],
                'sale_percent' => [''],
                'images.*' => ['image', 'mimes:jpg,png,jpeg']
            ],
            [
                'prod_name.required' => 'Tên mặt hàng bắt buộc nhập',
                'prod_name.max' => 'Tên mặt hàng chỉ được tối đa :max kí tự',
                'prod_name.min' => 'Tên mặt hàng phải có ít nhất :min kí tự',

                'prod_model.required' => 'Model mặt hàng bắt buộc nhập',
                'prod_model.max' => 'Model mặt hàng chỉ được tối đa :max kí tự',
                'prod_model.min' => 'model mặt hàng phải có ít nhất :min kí tự',
                'prod_model.unique' => 'Model Mặt hàng này *:input* đã tồn tại',

                'prod_price.required' => 'Giá mặt hàng bắt buộc nhập',
                'prod_stock.required' => 'Số lượng mặt hàng bắt buộc nhập',
                'prod_price.integer' => 'Trường prod_price phải là một số nguyên dương (vd: 1,2,3)',
                'prod_stock.integer' => 'Trường prod_stock phải là một số nguyên dương (vd: 1,2,3)',
                'prod_stock.between' => 'Phải nằm trong khoảng từ 0 đến 1000',

                'brand_id.required' => 'Thương hiệu bắt buộc chọn',
                'cat_id.required' => 'Danh mục bắt buộc chọn'
            ],
        );
        $prod = Product::find($id);
        $prod->prod_name = $request->prod_name;
        $prod->prod_slug = Str::slug($request->prod_name)."-".Str::slug($request->prod_model);
        $prod->prod_model = $request->prod_model;
        $prod->isActive = is_null($request->isActive) ? 0 : $request->isActive;
        $prod->prod_price = $request->prod_price;
        $prod->prod_stock = $request->prod_stock;
        $prod->prod_description = $request->prod_description;
        $prod->brand_id = $request->brand_id;
        $prod->cat_id = $request->cat_id;
        $prod->origin_country = $request->origin_country;
        $prod->guarantee_period = $request->guarantee_period;
        // $prod->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $prod->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $prod->update();
        // Upload images and associate with product
        // $prod = Product::find(33);

        if ($request->hasFile('images')) {
            $allowedfileExtension = ['jped', 'jpg', 'png'];
            $files = $request->file('images');
            foreach ($files as $key => $file) {
                $ext = $file->getClientOriginalExtension();
                $check = in_array($ext, $allowedfileExtension);
                if ($check) {
                    date_default_timezone_set("Asia/Ho_Chi_Minh");
                    $file_name = Str::slug($request->prod_name, '-') . '_' . date('Hisdmy') . $key  . '.' . $ext;
                    $file->storeAs('public/uploads/Product/' . $prod->id . '/', $file_name);
                    // $file->move(public_path() . '/uploads/images/product/'.$prod->prod_slug.'/', $file_name);
                    $urlImage = $file_name;

                    $image = new Image();
                    $image->prod_id = $prod->id;
                    $image->image = $urlImage;
                    $image->save();
                }
            };
        }
        if (!is_null($request->sale_percent)) {
            $sale = SaleProd::where('product_id',$prod->id)->first();
            $sale->percent = $request->sale_percent;
            $sale->update();
        } else {
            $sale = SaleProd::where('product_id',$prod->id)->first();
            $sale->percent = 0;
            $sale->update();
        }

        $attributes = $request->input('attributes', []);
        $values = $request->input('values', []);
        foreach ($attributes as $key => $attributeId) {
            if ($attributeId !== null && $values[$key] !== null) {
                $prod->attributes()->syncWithoutDetaching([$attributeId=>['value' => $values[$key]]]);
            }
            
        }
        // Lấy danh sách các attribute_id của các thuộc tính cũ
        $existingAttributeIds = $prod->attributes->pluck('id')->toArray();
        // Xóa các giá trị của các thuộc tính đã bị loại bỏ
        $removedAttributeIds = array_diff($existingAttributeIds, $attributes);
        foreach ($removedAttributeIds as $removedAttributeId) {
            $prod->attributes()->detach($removedAttributeId);
        }
        // foreach ($request->input('attributes', []) as $attributeId => $value) {
        //     if ($value != '') {
        //         $prod->attributes()->syncWithoutDetaching([$attributeId => ['value' => $value]]);
        //     } else {
        //         $prod->attributes()->detach($attributeId);
        //     }
        // }
        return back()->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        $data = Product::find($request->id);
        $data->isActive = !$data->isActive;
        $data->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $data->update();
        return response()->json(['status' => 'success']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeBrand(Request $request)
    {
        $data = Product::find($request->id);
        $data->brand_id = $request->brand_id;
        $data->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $data->update();
        return response()->json(['status' => 'success']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeCategory(Request $request)
    {
        $data = Product::find($request->id);
        $data->cat_id = $request->cat_id;
        $data->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $data->update();
        return response()->json(['status' => 'success']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeSalePercent(Request $request)
    {
        $sale = SaleProd::where('product_id',$request->id)->first();
        $sale->percent = $request->percent;
        $sale->update();
        $data = Product::find($request->id);
        $data->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $data->update();
        return response()->json(['status' => 'success']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changePrice(Request $request)
    {
        $data = Product::find($request->id);
        $data->prod_price = $request->price;
        $data->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $data->update();
        return response()->json(['status' => 'success']);
    }
    public function delete(Request $request)
    {
        $data = Product::find($request->id);
        // if (Storage::exists($imagePath)) {
        Storage::deleteDirectory('public/uploads/Product/' . $data->id);
        // }

        $data->delete();
        return response()->json(['status' => 'success']);
    }
    public function deleteImg(Request $request)
    {
        $img = Image::find($request->imgId);
        // if (Storage::exists($imagePath)) {
        // Storage::deleteDirectory('public/uploads/Product/' . $data->id);
        // }
        $img->delete();
            $old_image_exist = storage_path('app/public/uploads/Product/'.$request->productId.'/'. $request->imgName);
            if (File::exists($old_image_exist)) {
                unlink($old_image_exist);
            }
        return response()->json(['status' => 'success']);
    }
}
