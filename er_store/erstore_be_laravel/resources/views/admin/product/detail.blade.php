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
            <a class="btn btn-outline-primary btn-sm fw-bold float-end" href="{{route('product.index')}}">
                <i class="fa-solid fa-clipboard-list me-2"></i>
                Xem danh sách
            </a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="">
                        <h6 class="text-uppercase fw-bold text-black text-decoration-underline">Thông tin cơ bản:</h6>
                        <ul class="list-style-none">
                            <li><span>Tên:</span> {{$productDetail->prod_name}} {{$productDetail->prod_model}}</li>
                            <li><span>Danh mục:</span>{{$productDetail->category->parent_id != null ? $productDetail->category->parent->cat_name.' ':''}}{{$productDetail->category->cat_name}}</li>
                            <li><span>Thương hiệu:</span> {{$productDetail->brand->brand_name}}</li>
                            <li class="text-{{$productDetail->isActive==1?"success":"danger"}}"><span>Trạng thái:</span > <i class="fa-solid fa-circle-{{$productDetail->isActive==1?'check':'xmark'}} me-1"></i> {{$productDetail->isActive?"Kích hoạt":"Khóa"}}</li>
                            <li><span>Giá bán:</span>{{ number_format($productDetail->prod_price, 0, ',', '.')}} <span class="fw-normal text-danger">(Giảm giá: {{$productDetail->sale->percent}}%)</span></li>
                            <li><span>Số lượng tồn kho:</span> {{$productDetail->prod_stock}}</li>
                            <li class="text-lowercase"><span>Ngày tạo:</span> {{$productDetail->created_at->format('H:i:s')}} ngày {{$productDetail->created_at->format('d/m/Y')}}</li>
                        <li class="text-lowercase"><span>Ngày cập nhật:</span> {{$productDetail->updated_at->format('H:i:s')}} ngày {{$productDetail->updated_at->format('d/m/Y')}}</li>
                            <li><span>Mô tả:</li>
                            <p>{{$productDetail->prod_description}}</p>
                        </ul>
                    </div>
                </div>
                <div class="col-12 col-lg-6">
                    <h6 class="text-uppercase fw-bold text-black text-decoration-underline mb-3">Thông số kỹ thuật:</h6>
                    <div class="">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row" class="fw-normal">Model:</th>
                                    <td class="text-uppercase">{{$productDetail->prod_model}}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="fw-normal">Loại sản phẩm:</th>
                                    <td>{{$productDetail->category->parent_id != null ? $productDetail->category->parent->cat_name.' ':''}}{{$productDetail->category->cat_name}}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="fw-normal">Thương hiệu:</th>
                                    <td class="text-uppercase">{{$productDetail->brand->brand_name}}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="fw-normal">Xuất xứ:</th>
                                    <td>{{$productDetail->origin_country}}</td>
                                </tr>
                                <tr>
                                    <th scope="row" class="fw-normal">Thời gian bảo hành:</th>
                                    <td>{{$productDetail->guarantee_period}} tháng</td>
                                </tr>
                                @foreach($attributes as $attribute)
                                    <tr>
                                        <th scope="row" class="fw-normal">{{$attribute->key}}:</th>
                                        <td>{{ $productDetail->attributes->where('id', $attribute->id)->first()->pivot->value ?? '' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <h6 class="text-uppercase fw-bold text-black text-decoration-underline">Hình ảnh sản phẩm:</h6>
                <div class="ps-2 row" id="img-div" style="border-radius:5px">
                    @forelse ($productDetail->images as $item)
                    <div class="img-div px-0" style="width:130px;height:100px">
                        <img id="" src="{{asset('storage/uploads/Product/'.$productDetail->id.'/'.$item->image) }}" class="gallery-item rounded card-img-bottom object-fit-contain border border-1 border-primary w-100 h-100 p-1"/>
                        @if ($productDetail->images->count()>2)
                        <button class="btn-img-delete bg-danger rounded-circle border-0" data-product-id="{{$productDetail->id}}" data-img-id="{{$item->id}}" data-img-name="{{$item->image}}"><i class="fa-solid fa-x text-white"></i></button>
                        @endif
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
<!-- style -->
<style>
    .img-div{
        position: relative;
        margin: 5px;
    }
    .btn-img-delete{
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
@include('admin.product.script.script')
@endsection