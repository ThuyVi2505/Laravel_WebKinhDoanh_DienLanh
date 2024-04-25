<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display list of resource
     * 
     * @param none
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category_parent = Category::with('children', 'products')->whereNull('parent_id')->orderBy('created_at','desc')->get();
        return view('admin.category.index')->with(compact('category_parent'));
    }
    public function show($id){
        $cat_detail = Category::with('products')->find($id);
        return view('admin.category.detail')->with((compact('cat_detail')));
    }
    /**
     * Display view of form create new record
     * 
     * @param none
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category_parent = Category::whereNull('parent_id')->get();
        return view('admin.category.create')->with(compact('category_parent'));
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
                'cat_name' => ['required', 'max:50', 'min:4', 'unique:categories'],
                'cat_slug' => [''],
                'isActive' => [''],
                'parent_id' => ['nullable', 'integer']
            ],
            [
                'cat_name.required' => 'Tên danh mục bắt buộc nhập',
                'cat_name.max' => 'Tên danh mục chỉ được tối đa :max kí tự',
                'cat_name.min' => 'Tên danh mục phải có ít nhất :min kí tự',
                'cat_name.unique' => 'danh mục *:input* đã tồn tại',
                // 'parent_id.integer' => 'Trường parent_id phải là một số nguyên dương (vd: 1,2,3)',
            ],
        );
        $parent_id = $request->input('parent_id') ?: null;
        $query = Category::create([
            'cat_name' => $request->cat_name,
            'cat_slug' => Str::slug($request->cat_name),
            'parent_id' => $parent_id,
            'isActive' => $request->isActive,
            'created_at'=> Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'=> Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
        return back()->with('success', 'Thêm thành công');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data_cat = Category::find($id);
        $category_parent = Category::whereNull('parent_id')->get();
        return view('admin.category.edit')->with(compact('data_cat', 'category_parent'));;
    }
    public function update($id, Request $request){
        $request->validate(
            [
                'cat_name' => ['required', 'max:50', 'min:4', 'unique:categories,cat_name,' . $id],
                'cat_slug' => [''],
                'isActive' => [''],
                'parent_id' => ['nullable', 'integer']
            ],
            [
                'cat_name.required' => 'Tên danh mục bắt buộc nhập',
                'cat_name.max' => 'Tên danh mục chỉ được tối đa :max kí tự',
                'cat_name.min' => 'Tên danh mục phải có ít nhất :min kí tự',
                'cat_name.unique' => 'danh mục *:input* đã tồn tại',
                // 'parent_id.integer' => 'Trường parent_id phải là một số nguyên dương (vd: 1,2,3)',
            ],
        );
        $parent_id = $request->input('parent_id') ?: null;
        $query = Category::find($id)->update([
            'cat_name' => $request->cat_name,
            'cat_slug' => Str::slug($request->cat_name),
            'parent_id' => $parent_id,
            'isActive' => $request->isActive,
            // 'created_at'=> Carbon::now('Asia/Ho_Chi_Minh'),
            'updated_at'=> Carbon::now('Asia/Ho_Chi_Minh'),
        ]);
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
          $data =Category::find($request->id);
          $data->isActive = !$data->isActive;
          $data->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
          $data->update();
          return response()->json(['status' => 'success']);
      }

    public function delete(Request $request)
     {
         $data = Category::find($request->id);
         $data->delete();
         return response()->json(['status' => 'success']);
     }
}
