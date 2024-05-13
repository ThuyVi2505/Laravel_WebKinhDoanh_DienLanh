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
    public function getAll(Request $request)
    {
        $query = Category::query();

        if ($request->has('id')) {
            $query->where('id', $request->id);
        }
        if ($request->has('isActive')) {
            $query->where('isActive', $request->isActive);
        }

        if ($request->has('cat_name')) {
            $query->where('cat_name', 'like', '%' . $request->cat_name . '%');
        }

        $all = $query->get();

        // category resource
        $allResc = CategoryResource::collection($all);
        // re-type category respond api
        $arr = [
            // 'title' => "Danh sách danh mục loại sản phẩm",
            'success' => true,
            'message' => "Lấy dữ liệu thành công",
            'record_total' => $all->count(),
            'data' => $allResc
        ];

        return response()->json($arr, status: Response::HTTP_OK);
    }

}
