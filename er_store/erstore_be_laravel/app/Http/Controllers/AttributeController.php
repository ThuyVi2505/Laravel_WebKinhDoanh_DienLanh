<?php

namespace App\Http\Controllers;
use App\Models\Attribute;

use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index(){
        $count = Attribute::count();
        $attributes = Attribute::orderBy('created_at','desc')->paginate(20);
        return view('admin.attribute.index')->with(compact('attributes'));
    }

    public function create(){
        return view('admin.attribute.create');
    }

    public function store(Request $request){
        $request->validate(
            [
                'key' => ['required','unique:attributes'],
            ],
            [
                'key.required' => 'Trường này bắt buộc nhập',
                'key.unique' => 'Trường tên *:input* đã tồn tại',
            ],
        );
        $data = new Attribute();
        $data->key = $request->key;
        $data->save();

        return back()->with('success', 'Thêm thành công');
    }
    public function edit($id){
        $data = Attribute::find($id);
        return view('admin.attribute.edit')->with(compact('data'));
    }

    public function update(Request $request, $id){
        $request->validate(
            [
                'key' => ['required','unique:attributes,key,'.$id],
            ],
            [
                'key.required' => 'Trường này bắt buộc nhập',
                'key.unique' => 'Trường tên *:input* đã tồn tại',
            ],
        );
        $data = Attribute::find($id);
        $data->key = $request->key;
        $data->update();

        return back()->with('success', 'Cập nhật');
    }
    public function delete(Request $request)
     {
         $data = Attribute::find($request->id);
         $data->delete();
         return response()->json(['status' => 'success']);
     }
}
