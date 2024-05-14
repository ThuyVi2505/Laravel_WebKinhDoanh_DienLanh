<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use App\Models\Brand;
use App\Http\Resources\BrandResource;

class BrandController extends Controller
{
    /**
     * Construct
     */
    public function __construct()
    {
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll(Request $request)
    {
        $query = Brand::query();

        if ($request->has('id')) {
            $query->where('id', $request->id);
        }
        if ($request->has('isActive')) {
            $query->where('isActive', $request->isActive);
        }

        if ($request->has('brand_name')) {
            $query->where('brand_name', 'like', '%' . $request->brand_name . '%');
        }

        $all = $query->get();

        $allResc = BrandResource::collection($all);
        // re-type brand respond api
        $arr = [
            // 'title' => "Danh sách thương thiệu",
            'success' => true,
            'message' => "Lấy dữ liệu thành công",
            'record_count' => $all->count(),
            'data' => $allResc
        ];

        return response()->json($arr, status: Response::HTTP_OK);
    }
    /**
     * get record by id
     * @param App\Http\Requests\brand\addBrandRequest $request
     * @param \Illuminate\Http\Response
     * @param int $id
     * 
     */
    public function getById($id)
    {
        $brand = Brand::find($id);
        if (!$brand) {
            $err = [
                'success' => false,
                'message' => "Không tìm thấy...",
            ];
            return response()->json($err, status: Response::HTTP_NOT_FOUND);
        }
        // brand resource
        $Resc = new BrandResource($brand);
        // re-type brand respond api
        $arr = [
            'success' => true,
            'message' => "Lấy thông tin thành công",
            'data' => $Resc
        ];

        return response()->json($arr, status: Response::HTTP_OK);
    }
    /**
     * Store create a new record
     * @param \Illuminate\Http\Request
     * @param App\Http\Requests\brand\addBrandRequest $request
     * @param \Illuminate\Http\Response
     * 
     */
    public function store(BrandRequest $request)
    {
        $dataCreate = $request->all();

        $brand = new Brand($dataCreate);
        $brand->brand_name = $request->brand_name;
        $brand->brand_slug = Str::slug($request->brand_name);
        $brand->isActive = is_null($request->isActive) ? 0 : $request->isActive;
        $brand->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $brand->updated_at = Carbon::now('Asia/Ho_Chi_Minh');

        if ($request->hasfile('thumnail')) {

            $file = $request->file('thumnail');
            $ext = $file->getClientOriginalExtension();
            date_default_timezone_set("Asia/Ho_Chi_Minh");
            $file_name = Str::slug($request->brand_name, '-') . '_' . date('Hisdmy') . '.' . $ext;
            $file->storeAs('public/uploads/Brand', $file_name);
            $brand->thumnail = $file_name;
        }

        $brand->save($dataCreate);

        // brand resource
        $Resc = new BrandResource($brand);
        // re-type brand respond api
        $arr = [
            'success' => true,
            'message' => "Thêm thành công",
            'data' => $Resc
        ];
        return response()->json($arr, status: Response::HTTP_CREATED);
    }
    /**
     * update record
     * @param \Illuminate\Http\Request
     * @param App\Http\Requests\brand\addBrandRequest $request
     * @param \Illuminate\Http\Response
     * @param int $id
     * 
     */
    public function update(BrandRequest $request, $id)
    {
        $brand = Brand::find($id);
        if (is_null($brand)) {
            $err = [
                'success' => false,
                'message' => "Không tìm thấy...",
            ];
            return response()->json($err, status: Response::HTTP_NOT_FOUND);
        }
        $dataUpdate = $request->all();

        if ($request->brand_name != $brand->brand_name) {
            $brand->brand_name = $request->brand_name;
            $brand->brand_slug = Str::slug($request->brand_name);
        }
        if (!is_null($request->isActive)) {
            $brand->isActive = $request->isActive;
        }
        // $brand->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $brand->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
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
            $brand->thumbail = $file_name;
        }
        $brand->update($dataUpdate);
        // brand resource
        $Resc = new BrandResource($brand);
        // re-type brand respond api
        $arr = [
            'title' => "Cập nhật thương hiệu",
            'success' => true,
            'message' => "Cập nhật thành công",
            'datsa' => $Resc
        ];
        return response()->json($arr, status: Response::HTTP_OK);
    }
    /**
     * delete record
     * @param App\Http\Requests\brand\addBrandRequest $request
     * @param \Illuminate\Http\Response
     * @param int $id
     * 
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        if (is_null($brand)) {
            $err = [
                'success' => false,
                'message' => "Không tìm thấy...",
            ];
            return response()->json($err, status: Response::HTTP_NOT_FOUND);
        }
        if($brand->products->count()<=0){
            // Xóa hình ảnh của brand từ thư mục public
            if ($brand->thumnail != null) {
                $old_image_exist = storage_path('app/public/uploads/Brand/' . $brand->thumnail);
                if (File::exists($old_image_exist)) {
                    unlink($old_image_exist);
                }
            }

            // Xóa brand khỏi cơ sở dữ liệu
            $brand->delete();
            $arr = [
                'success' => true,
                'message' => "Xóa thành công",
            ];
        }
        else{
            $arr = [
                'success' => false,
                'message' => "Xóa thất bại",
            ];
        }
        return response()->json($arr, status: Response::HTTP_OK);
    }
}
