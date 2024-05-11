<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $data_brand = Brand::query()
            ->when($request->status != null, function ($query) use ($request) {
                return $query->where('isActive', ($request->status=="kichhoat"?1:0));
            })
            ->when($request->searchBox != null, function ($query) use ($request) {
                return $query->where('brand_name', 'like', '%' . $request->searchBox . '%');
            })
            ->orderBy('brand_name', 'asc')
            ->paginate(10);
        return view('admin.brand.index', compact('data_brand'));
    }
    public function show($id){
        $brand_detail = Brand::with('products')->find($id);
        return view('admin.brand.detail')->with((compact('brand_detail')));
    }

    public function create()
    {
        return view('admin.brand.create');
    }
    /**
     * Save record to database
     * 
     * @param none
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'brand_name' => ['required', 'max:50', 'min:2', 'unique:brands'],
                'brand_slug' => [''],
                'isActive' => [''],
                // 'thumnail' => [''],
                'thumnail' => ['required', 'mimes:jpeg,png,jpg'],
            ],
            [
                'brand_name.required' => 'Tên thương hiệu bắt buộc nhập',
                'brand_name.max' => 'Tên thương hiệu chỉ được tối đa :max kí tự',
                'brand_name.min' => 'Tên thương hiệu phải có ít nhất :min kí tự',
                'brand_name.unique' => 'Thương hiệu *:input* đã tồn tại',
                'thumnail.required' => 'Hình ảnh bắt buộc phải có',
                'thumnail.mimes' => 'Phải chọn file có đuôi .jpeg|png|jpg|svg',
            ],
        );
        $file_url=null;
        if ($request->hasfile('thumnail')) {

            $file = $request->file('thumnail');
            $ext = $file->getClientOriginalExtension();
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $file_name = Str::slug($request->brand_name, '-') . '_' . date('Hisdmy') . '.' . $ext;
            $file->storeAs('public/uploads/Brand', $file_name);
            $file_url = $file_name;
        }
        $query = Brand::create([
            'brand_name' => $request->brand_name,
            'brand_slug' => Str::slug($request->brand_name),
            'thumnail' => $file_url,
            'isActive' => $request->isActive,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        return back()->with('success', 'Thêm thành công');
    }
    public function edit($id)
    {
        $brand_detail = Brand::find($id);
        return view('admin.brand.edit')->with(compact('brand_detail'));
    }
    public function update($id, Request $request){
        $request->validate(
            [
                'brand_name' => ['required', 'max:50', 'min:2', 'unique:brands,brand_name,'.$id],
                'brand_slug' => [''],
                'isActive' => [''],
                // 'thumnail' => [''],
                'thumnail' => ['mimes:jpeg,png,jpg'],
            ],
            [
                'brand_name.required' => 'Tên thương hiệu bắt buộc nhập',
                'brand_name.max' => 'Tên thương hiệu chỉ được tối đa :max kí tự',
                'brand_name.min' => 'Tên thương hiệu phải có ít nhất :min kí tự',
                'brand_name.unique' => 'Thương hiệu *:input* đã tồn tại',
                // 'thumnail.required' => 'Hình ảnh bắt buộc phải có',
                'thumnail.mimes' => 'Phải chọn file có đuôi .jpeg|png|jpg|svg',
            ],
        );
        $file_url=null;
        $brand = Brand::find($id);
        if ($request->hasfile('thumnail')) {
            if ($brand->thumbail != null) {
                $old_image_exist = storage_path('app/public/uploads/Brand/'. $brand->id .'/'. $brand->thumnail);
                if (File::exists($old_image_exist)) {
                    unlink($old_image_exist);
                }
            }

            $file = $request->file('thumnail');
            $ext = $file->getClientOriginalExtension();
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $file_name = Str::slug($request->brand_name, '-') . '_' . date('Hisdmy') . '.' . $ext;
            $file->storeAs('public/uploads/Brand', $file_name);
            $file_url = $file_name;
        }
        $query = $brand->update([
            'brand_name' => $request->brand_name,
            'brand_slug' => Str::slug($request->brand_name),
            'isActive' => $request->isActive,
            'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at' => Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        if($file_url){
            $brand->update([
                'thumnail' => $file_url,
            ]);
        }
       
        return back()->with('success', 'Cập nhật thành công');
    }

    public function delete(Request $request)
    {
        $data = Brand::find($request->id);
        if ($data->thumnail != null) {
            $old_image_exist = storage_path('app/public/uploads/Brand/' . $data->thumnail);
            if (File::exists($old_image_exist)) {
                unlink($old_image_exist);
            }
        }

        $data->delete();
        return response()->json(['status' => 'success']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        $data = Brand::find($request->id);
        $data->isActive = !$data->isActive;
        $data->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $data->update();
        return response()->json(['status' => 'success']);
    }
}
