<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        // get all category list
        $all = Category::where('isActive', 1)->get();
        // category resource
        $allResc = CategoryResource::collection($all);
        // re-type category respond api
        $arr = [
            'title' => "Danh sách danh mục loại sản phẩm",
            'success' => true,
            'message' => "Lấy danh sách thành công",
            'record_total' => $all->count(),
            'data' => $allResc
        ];

        return response()->json($arr, status: Response::HTTP_OK);
    }
    /**
     * get record by id
     * @param App\Http\Requests\category\addcategoryRequest $request
     * @param \Illuminate\Http\Response
     * @param int $id
     * 
     */
    public function getById($id)
    {
        $cat = Category::find($id);
        if (is_null($cat)) {
            $err = [
                'success' => false,
                'message' => "Không tìm thấy danh mục này...",
            ];
            return response()->json($err, status: Response::HTTP_NOT_FOUND);
        }
        // category resource
        $Resc = new CategoryResource($cat);
        // re-type category respond api
        $arr = [
            'success' => true,
            'message' => "Lấy thông tin danh mục thành công",
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
    public function store(CategoryRequest $request)
    {
        $dataCreate = $request->all();

        $category = new Category($dataCreate);
        $category->cat_name = $request->cat_name;
        $category->cat_slug = Str::slug($request->cat_name);
        $category->isActive = is_null($request->isActive) ? 0 : $request->isActive;
        
        $category->parent_id = is_null($request->parent_id)?null:$request->parent_id;
        $category->created_at = Carbon::now('Asia/Ho_Chi_Minh');
        $category->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
        $category->save($dataCreate);

        // category resource
        $Resc = new CategoryResource($category);
        // re-type category respond api
        $arr = [
            'title' => "Thêm danh mục mới",
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
