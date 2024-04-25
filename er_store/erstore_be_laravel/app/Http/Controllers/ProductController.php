<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $allProduct = Product::orderBy('created_at','desc')->get();
        return view('admin.product.index')->with(compact('allProduct'));
    }


    /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
      public function changeStatus(Request $request)
      {
          $data =Product::find($request->id);
          $data->isActive = !$data->isActive;
          $data->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
          $data->update();
          return response()->json(['status' => 'success']);
      }
}
