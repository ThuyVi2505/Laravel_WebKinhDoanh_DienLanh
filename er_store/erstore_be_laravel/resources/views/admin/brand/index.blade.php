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
    <div class="card-header bg-white border-bottom border-4">
      <a class="btn btn-primary btn-sm fw-bold float-end" href="{{route('brand.create')}}">
        <i class="fa-solid fa-circle-plus me-2"></i>
        Thêm mới
      </a>
    </div>
    <div class="card-header bg-white">
      <h5 class="fw-bold float-start text-secondary">
        Số lượng: {{$all_count}}
      </h5>
    </div>
    <div class="table-responsive" id="div-table">
      <table class="table">
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
