@extends('admin.layouts.admin')
@section('title', 'Quản lý thương hiệu')
@section('admin_content')
<div class="container-fluid">
    <div class="card mx-2 my-2">
      <div class="card-header py-0 pt-2 align-middle">
        <div class="float-start">
            <h3 class="text-darkcyan fw-bold">SẢN PHẨM</h3>
        </div>
        <div class="float-end">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page"><a class="btn btn-sm btn-success" href="{{ route('product.index') }}"><i class="fa-solid fa-rotate"></i></a></li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  <div class="card mx-2 border-0">
    <div class="card-header bg-white border-bottom border-4">
      <a class="btn btn-primary btn-sm fw-bold float-end" href="{{route('product.create')}}">
        <i class="fa-solid fa-circle-plus me-2"></i>
        Thêm mới
      </a>
    </div>
    <div class="card-header bg-white">
      <h5 class="fw-bold float-start text-secondary">
        Số lượng: {{$allProduct->count()}}
      </h5>
    </div>
    <div class="table-responsive" id="div-table">
      <table class="table">
        <thead class="text-center align-middle text-uppercase table-light">
          <tr>
            <th width="50%">Tên sản phẩm</th>
            <th width="10%">Giá bán</th>
            <th width="5%">Số lượng tồn</th>
            <th width="5%">Thuộc danh mục</th>
            <th width="5%">Thuộc thương hiệu</th>
            <th width="10%">Ngày<br>tạo</th>
            <th width="10%">Ngày<br>cập nhật</th>
            <th width="10%">Trạng<br>thái</th>
            <th width="5%">Action</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          @forelse($allProduct as $value => $product)
          <tr>
            {{-- <th scope="row" class="text-center border">{{$value+1}}</th> --}}
            <td class="px-3">
                <div class="d-flex align-items-center">
                    <div class=" me-3">
                        <img id="" src="{{ $product->images->first()->image==null ? 
                                                asset('assets/images/no_image.jpg') 
                                                : asset('storage/uploads/Product/'.$product->id.'/'.$product->images->first()->image) }}" class="gallery-item rounded card-img-bottom object-fit-contain border border-1" style="height: 50px; width:80px;" />
                    </div>
                    <div class="">
                        <a class="card-title text-decoration-none text-primary fw-bold">{{ $product->prod_name }} {{$product->prod_model}}</a>
                        <p class="card-text text-secondary d-none d-lg-block">#{{ $product->prod_slug }}</p>
                    </div>
                </div>
            </td>
            <td class="text-center">
              {{ number_format($product->prod_price, 0, ',', '.')}}
              {{-- {{$product->prod_price}} --}}
            </td>
            <td class="text-center">
                {{$product->prod_stock}}
              </td>
              <td class="text-center">
                {{$product->category->cat_name}}
              </td>
              <td class="text-center">
                {{$product->brand->brand_name}}
              </td>
            <td class="text-center">
              @if($product->created_at!='')
              <small class="text-black">{{ $product->created_at->format('H:i:s d/m/Y') }}</small><br><small class="text-primary">({{ $product->created_at->diffForHumans() }})</small>
              @endif
            </td>
            <td class="text-center">
                @if($product->updated_at!='')
                <small class="text-black">{{ $product->updated_at->format('H:i:s d/m/Y') }}</small><br><small class="text-primary">({{ $product->updated_at->diffForHumans() }})</small>
                @endif
            </td>
            <td class="text-center align-middle">
                <a class="btn btn-sm fw-bold btn-outline-{{$product->isActive==1?'success':'danger'}} change-status" style="width:120px;height:30px;" data-id="{{$product->id}}" data-name="{{$product->genre_name}}">
                    <i class="fa-solid fa-circle-{{$product->isActive==1?'check':'xmark'}} me-1"></i>
                    {{$product->isActive==1?'Kích hoạt':'Khóa'}}
                </a>
            </td>
            <td class="">
                <a href="{{ route('product.detail',['product'=> $product->id]) }}" class="btn rounded-circle btn-view-detail">
                  <i class="fa-solid fa-eye" data-bs-toggle="tooltip" title="Chi tiết"></i>
                </a>
                <a href="{{ route('product.edit',['product'=> $product->id]) }}" class="btn btn-edit rounded-circle">
                    <i class="fa-solid fa-pen-to-square text-primary" data-bs-toggle="tooltip" title="Sửa"></i>
                </a>
                <a class="btn rounded-circle btn-delete" data-id="{{$product->id}}" data-name="{{$product->prod_name}}">
                  <i class="fa-solid fa-trash-can text-danger" data-bs-toggle="tooltip" title="Xóa"></i>
                </a>
                
            </td>
          </tr>
          @empty
          <tr class="align-middle">
            <td class="text-center" colspan="10">
            Không có dữ liệu
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
</div>
</div>
<!-- style -->
<style>
  .btn-view-detail:hover {
      border: 1px solid #000000;
      /* background-color: #dc3545; */
  }
  .btn-delete:hover {
      border: 1px solid #dc3545;
      /* background-color: #dc3545; */
  }

  .btn-edit:hover {
      border: 1px solid #0d6efd;
      /* background-color: #dc3545; */
  }
</style>
{{-- modal --}}
{{-- script --}}
@include('admin.product.script.script')
@endsection
