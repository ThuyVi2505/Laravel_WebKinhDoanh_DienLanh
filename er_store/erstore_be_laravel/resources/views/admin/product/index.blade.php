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
    <div class="card-header bg-white border-bottom border-4 d-flex justify-content-between align-items-center">
      <div class="">
        {{-- <a class="btn btn-outline-secondary btn-sm fw-bold" href="">
          <i class="fa-solid fa-file-arrow-up me-2"></i>
          Nhập Excel
        </a>
        <a class="btn btn-outline-success btn-sm fw-bold" href="">
          <i class="fa-solid fa-file-arrow-down me-2"></i>
          Xuất Excel
        </a> --}}
      </div>
      <div class="">
        <a class="btn btn-primary btn-sm fw-bold" href="{{route('product.create')}}">
          <i class="fa-solid fa-circle-plus me-2"></i>
          Thêm mới
        </a>
      </div>
    </div>
    <div class="table-responsive" id="div-table">
      <table class="table table-hover">
        <thead class="text-center align-middle text-uppercase table-light">
          <tr>
            <th width="50%">Tên sản phẩm</th>
            <th width="20%">Giá bán gốc</th>
            <th width="5%">Số lượng tồn</th>
            <th width="20%">Thuộc danh mục</th>
            <th width="10%">Thuộc thương hiệu</th>
            {{-- <th width="10%">Ngày<br>tạo</th>
            <th width="10%">Ngày<br>cập nhật</th> --}}
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
                        <p class="card-text text-danger d-flex justify-content-start align-items-center">
                          Giảm %: <input type="number" min="0" max="100" step="1" class="ms-1 form-control form-control-sm border-0 fw-bold text-danger text-center change-sale" style="width:60px;" name="sale_percent" value="{{ $product->sale->percent }}" data-id="{{$product->id}}">
                        </p>
                    </div>
                </div>
            </td>
            <td class="text-center">
              <div class="text-center">
                <a class="card-title text-decoration-none text-black a-price" data-id="{{$product->id}}" onclick="toggleInput(this)">{{ number_format($product->prod_price, 0, ',', '.')}}</a>
                <input type="text" class="form-control form-control-sm border-0 text-danger w-100 change-price" name="price" value="{{ $product->prod_price }}" data-id="{{$product->id}}" hidden>
              </div>
            </td>
            <td class="text-center">
                {{$product->prod_stock}}
            </td>
            <td class="text-center">
                <select class="form-select form-select-sm w-auto change-category" id="cat_id" name="cat_id" data-id="{{$product->id}}">
                  @foreach($category_list as $item)
                      <option value="{{$item->id}}" class="text-uppercase fw-bold {{$item->hasAnyChild()?'bg-light':''}}" {{$item->hasAnyChild()?'disabled':''}}>{{$item->cat_name}}</option>
                      @foreach($item->children as $child)
                          <option value="{{$child->id}}" {{$child->id == $product->category->id?'selected':''}}>{{$item->cat_name}} {{$child->cat_name}}</option>
                      @endforeach
                  @endforeach
                </select>
                {{-- {{$product->category->parent_id != null ? $product->category->parent->cat_name.' ':''}}{{$product->category->cat_name}} --}}
            </td>
              <td class="text-center">
                <select class="form-select form-select-sm w-auto change-brand" id="brand_id" name="brand_id" data-id="{{$product->id}}">
                  @foreach($brand_list as $item)
                      <option value="{{$item->id}}" {{$item->id == $product->brand->id?'selected':''}} class="text-uppercase">{{$item->brand_name}}</option>
                  @endforeach
                </select>
                {{-- {{$product->brand->brand_name}} --}}
              </td>
            {{-- <td class="text-center">
              @if($product->created_at!='')
              <small class="text-black">{{ $product->created_at->format('H:i:s d/m/Y') }}</small><br><small class="text-primary">({{ $product->created_at->diffForHumans() }})</small>
              @endif
            </td>
            <td class="text-center">
                @if($product->updated_at!='')
                <small class="text-black">{{ $product->updated_at->format('H:i:s d/m/Y') }}</small><br><small class="text-primary">({{ $product->updated_at->diffForHumans() }})</small>
                @endif
            </td> --}}
            <td class="text-center">
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
                @if(!$product->hasOrderDetails())
                <a class="btn rounded-circle btn-delete" data-id="{{$product->id}}" data-name="{{$product->prod_name}}">
                  <i class="fa-solid fa-trash-can text-danger" data-bs-toggle="tooltip" title="Xóa"></i>
                </a>
                @endif
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
      <div class="">
        {!!$allProduct->appends($_GET)->links('admin.layouts.pagination.admin-pagination')!!}
      </div>
      {{-- <table class="table" id="myTable">
        <thead>
          <tr>
            <th>#</th>
            <th>tên</th>
            <th>lớp</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>A</td>
            <td>1</td>
          </tr>
          <tr>
            <td>1</td>
            <td>A</td>
            <td>1</td>
          </tr>
          <tr>
            <td>1</td>
            <td>A</td>
            <td>1</td>
          </tr>
          <tr>
            <td>1</td>
            <td>A</td>
            <td>1</td>
          </tr>
        </tbody>
      </table> --}}
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
