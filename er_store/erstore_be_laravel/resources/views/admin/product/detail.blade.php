@extends('admin.layouts.admin')
@section('title', 'Quản lý danh mục')
@section('admin_content')
<div class="container-fluid">
    <div class="card mx-2 my-2">
      <div class="card-header py-0 pt-2 align-middle">
        <div class="float-start">
            <h3 class="text-darkcyan fw-bold text-uppercase"><span class="text-black fw-normal">SẢN PHẨM:</span> {{$productDetail->prod_name}}</h3>
        </div>
      </div>
    </div>
    <div class="card mx-2 border-0">
        <div class="card-header bg-white border-bottom border-4">
            <a class="btn btn-outline-primary btn-sm fw-bold float-end" href="{{route('category.index')}}">
                <i class="fa-solid fa-clipboard-list me-2"></i>
                Xem danh sách
            </a>
        </div>
        <div class="card-body">
            <div class="">
                <div class="">
                    <h6 class="text-uppercase fw-bold text-black text-decoration-underline">Thông tin danh mục:</h6>
                    <ul class="list-style-none">
                        <li><span>Tên:</span> {{$productDetail->prod_name}}</li>
                        <li><span>Trạng thái:</span> {{$productDetail->isActive?"Kích hoạt":"Khóa"}}</li>
                        <li><span>Giá bán:</span>{{ number_format($productDetail->prod_price, 0, ',', '.')}}</li>
                        <li><span>Số lượng tồn kho:</span> {{$productDetail->prod_stock}}</li>
                        <li><span>Ngày tạo:</span> {{$productDetail->created_at->format('H:i:s d/m/y')}}</li>
                        <li><span>Ngày cập nhật:</span> {{$productDetail->updated_at->format('H:i:s d/m/y')}}</li>
                    </ul>
                </div>
                <div class="mt-4">
                    <h6 class="text-uppercase fw-bold text-black text-decoration-underline">Hình ảnh sản phẩm:</h6>
                    <div class="border border-3 d-flex" style="border-radius:5px">
                        @forelse ($productDetail->images as $item)
                        <div class="img-div" style="width:150px;height:150px">
                            <img id="" src="{{asset('storage/uploads/Product/'.$productDetail->id.'/'.$item->image) }}" class="gallery-item rounded card-img-bottom object-fit-contain border border-1 border-primary"/>
                            <button class="btn-delete bg-danger rounded-circle border-0"><i class="fa-solid fa-x text-white"></i></button>
                        </div>
                        @empty
                            <div class="">
                                <p>Sản phẩm chưa có hình ảnh</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
            
            
        </div>
    </div>
</div>
<!-- style -->
<style>
    .img-div{
        position: relative;
        width: 150px;
        height: 150px;
        margin: 10px;
    }
    .btn-delete{
        position: absolute;
        top: 5px;
        right: 5px;
    }
  li{
    padding-top: 5px;
    text-transform: uppercase;
  }
  li span{
    margin-right: 5px;
    text-transform: none;
    font-weight: bold;
    color: #008080;
  }
</style>
{{-- script --}}
@include('admin.category.script.script')
@endsection