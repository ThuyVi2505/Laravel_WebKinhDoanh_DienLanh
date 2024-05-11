@extends('admin.layouts.admin')
@section('title', 'Quản lý thương hiệu')
@section('admin_content')
<div class="container-fluid">
    <div class="card mx-2 my-2">
      <div class="card-header py-0 pt-2 align-middle">
        <div class="float-start">
            <h3 class="text-darkcyan fw-bold">THƯƠNG HIỆU</h3>
        </div>
        <div class="float-end">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page"><a class="btn btn-sm btn-success" href="{{ route('brand.index') }}"><i class="fa-solid fa-rotate"></i></a></li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  <div class="card mx-2 border-0">
    <div class="card-header bg-white">
      <a class="btn btn-primary btn-sm fw-bold float-end" href="{{route('brand.create')}}">
        <i class="fa-solid fa-circle-plus me-2"></i>
        Thêm mới
      </a>
    </div>
    <form id="search-form" action="" method="GET" class="px-5 py-1 border-bottom border-top border-3">
      <div class="d-flex justify-content-start align-item-center">
        <!-- status filter -->
        <div class="mb-3 me-2">
          <label for="status" class="form-label fw-semibold text-secondary">Trạng thái</label>
          <select class="form-select rounded" name="status" id="status-filter" style="border-color: darkcyan;width:auto;">
            <option value="">Tất cả</option>
            <option value="kichhoat" {{Request::get('status')=='kichhoat'?'selected':''}}>KÍCH HOẠT</option>
            <option value="khoa" {{Request::get('status')=='khoa'?'selected':''}}>KHÓA</option>
          </select>
        </div>
        <!-- search box -->
        <div class="mb-3 me-2 w-100">
          <label for="searchBox" class="form-label fw-semibold text-secondary">Từ khóa</label>
          <div class="input-group w-auto my-auto rounded" style="border: solid 1px darkcyan;background: darkcyan;">
            <span class="input-group-text border-0" style="background: white;"><i class="fas fa-search" style="color:darkcyan;"></i></span>
            <input type="text" class="form-control border-0" name="searchBox" id="searchBox" value="{{ request()->input('searchBox') }}" placeholder="Nhập từ khóa để tìm kiếm&hellip;">
          </div>
        </div>
      </div>
      <div class="float-end mx-2">
        <button type="submit" class="btn btn-sm btn-primary fw-bold shadow" style="border: solid 2px darkcyan; background:darkcyan;">Lọc danh sách</button>
      </div>
    </form>
    <div class="table-responsive" id="div-table">
      <table class="table table-hover">
        <thead class="text-center align-middle text-uppercase table-light">
          <tr>
            <th width="30%" colspan="2">Tên thương hiệu</th>
            <th width="10%">Số lượng sản phẩm</th>
            <th width="15%">Ngày<br>tạo</th>
            <th width="15%">Ngày<br>cập nhật</th>
            <th width="15%">Trạng<br>thái</th>
            <th width="15%">Action</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          @forelse($data_brand as $value => $brand)
          <tr>
            {{-- <th scope="row" class="text-center border">{{$value+1}}</th> --}}
            <td class="px-3" colspan="2">
                <div class="d-flex align-items-center">
                    <div class=" me-3">
                        <img id="" src="{{ $brand->thumnail==null ? 
                                                asset('assets/images/no_image.jpg') 
                                                : asset('storage/uploads/Brand/'.$brand->thumnail) }}" class="gallery-item rounded card-img-bottom object-fit-contain border border-1" style="height: 50px; width:80px;" />
                    </div>
                    <div class="">
                        <a class="card-title text-decoration-none text-primary fw-bold text-uppercase">{{ $brand->brand_name }}</a>
                        <p class="card-text text-secondary d-none d-lg-block">#{{ $brand->brand_slug }}</p>
                    </div>
                </div>
            </td>
            <td class="text-center">
              {{$brand->products->count()}}
            </td>
            <td class="text-center">
              @if($brand->created_at!='')
              <small class="text-black">{{ $brand->created_at->format('H:i:s d/m/Y') }}</small><br><small class="text-primary">({{ $brand->created_at->diffForHumans() }})</small>
              @endif
            </td>
            <td class="text-center">
                @if($brand->updated_at!='')
                <small class="text-black">{{ $brand->updated_at->format('H:i:s d/m/Y') }}</small><br><small class="text-primary">({{ $brand->updated_at->diffForHumans() }})</small>
                @endif
            </td>
            <td class="text-center align-middle">
                <a class="btn btn-sm fw-bold btn-outline-{{$brand->isActive==1?'success':'danger'}} change-status" style="width:120px;height:30px;" data-id="{{$brand->id}}" data-name="{{$brand->genre_name}}">
                    <i class="fa-solid fa-circle-{{$brand->isActive==1?'check':'xmark'}} me-1"></i>
                    {{$brand->isActive==1?'Kích hoạt':'Khóa'}}
                </a>
            </td>
            <td class="">
                <a href="{{ route('brand.detail',['brand'=> $brand->id]) }}" class="btn rounded-circle btn-view-detail">
                  <i class="fa-solid fa-eye" data-bs-toggle="tooltip" title="Chi tiết"></i>
                </a>
                <a href="{{ route('brand.edit',['brand'=> $brand->id]) }}" class="btn btn-edit rounded-circle">
                    <i class="fa-solid fa-pen-to-square text-primary" data-bs-toggle="tooltip" title="Sửa"></i>
                </a>
                @if(!$brand->products->count()>0)
                <a class="btn rounded-circle btn-delete" data-id="{{$brand->id}}" data-name="{{$brand->brand_name}}">
                  <i class="fa-solid fa-trash-can text-danger" data-bs-toggle="tooltip" title="Xóa"></i>
                </a>
                @endif
            </td>
          </tr>
          @empty
          <tr class="align-middle">
            <td class="text-center" colspan="4">
            Không có dữ liệu
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
      <div class="">
        {!!$data_brand->appends($_GET)->links('admin.layouts.pagination.admin-pagination')!!}
      </div>
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
@include('admin.brand.script.script')
@endsection
