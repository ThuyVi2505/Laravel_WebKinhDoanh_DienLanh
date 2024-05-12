@extends('admin.layouts.admin')
@section('title', 'Quản lý danh mục')
@section('admin_content')
<div class="container-fluid">
    <div class="card mx-2 my-2">
      <div class="card-header py-0 pt-2 align-middle">
        <div class="float-start">
            <h3 class="text-darkcyan fw-bold">DANH MỤC</h3>
        </div>
        <div class="float-end">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page"><a class="btn btn-sm btn-success" href="{{ route('category.index') }}"><i class="fa-solid fa-rotate"></i></a></li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  <div class="card mx-2 border-0">
    <div class="card-header bg-white border-bottom border-3">
      <a class="btn btn-primary btn-sm fw-bold float-end" href="{{route('category.create')}}">
        <i class="fa-solid fa-circle-plus me-2"></i>
        Thêm mới
      </a>
    </div>
    <div class="table-responsive" id="div-table">
      <table class="table table-hover">
        <thead class="text-center align-middle text-uppercase table-light">
          <tr>
            <th width="30%" colspan="2">Tên danh mục</th>
            <th width="10%">Số lượng sản phẩm</th>
            <th width="15%">Ngày<br>tạo</th>
            <th width="15%">Ngày<br>cập nhật</th>
            <th width="15%">Trạng<br>thái</th>
            <th width="15%">Action</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          @forelse($category_parent as $value => $cat)
          <tr>
            {{-- <th scope="row" class="text-center border">{{$value+1}}</th> --}}
            <td class="px-3" colspan="2">
                <div class="">
                    <a class="card-title text-decoration-none text-primary fw-bold text-uppercase">{{ $cat->cat_name }}</a>
                    <p class="card-text text-secondary d-none d-lg-block">#{{ $cat->cat_slug }}</p>
                </div>
            </td>
            <td class="text-center">
              {{-- {{$cat->products->count()}} --}}
            </td>
            <td class="text-center">
              @if($cat->created_at!='')
              <small class="text-black">{{ $cat->created_at->format('H:i:s d/m/Y') }}</small><br><small class="text-primary">({{ $cat->created_at->diffForHumans() }})</small>
              @endif
            </td>
            <td class="text-center">
                @if($cat->updated_at!='')
                <small class="text-black">{{ $cat->updated_at->format('H:i:s d/m/Y') }}</small><br><small class="text-primary">({{ $cat->updated_at->diffForHumans() }})</small>
                @endif
            </td>
            <td class="text-center align-middle">
                <a class="btn btn-sm fw-bold btn-outline-{{$cat->isActive==1?'success':'danger'}} change-status" style="width:120px;height:30px;" data-id="{{$cat->id}}" data-name="{{$cat->genre_name}}">
                    <i class="fa-solid fa-circle-{{$cat->isActive==1?'check':'xmark'}} me-1"></i>
                    {{$cat->isActive==1?'Kích hoạt':'Khóa'}}
                </a>
            </td>
            <td class="">
                <a href="{{ route('category.detail',['category'=> $cat->id]) }}" class="btn rounded-circle btn-view-detail">
                  <i class="fa-solid fa-eye" data-bs-toggle="tooltip" title="Chi tiết"></i>
                </a>
                <a href="{{ route('category.edit',['category'=> $cat->id]) }}"  class="btn btn-edit rounded-circle">
                    <i class="fa-solid fa-pen-to-square text-primary" data-bs-toggle="tooltip" title="Sửa"></i>
                </a>
                @if( !$cat->hasAnyChild())
                <a class="btn rounded-circle btn-delete" data-id="{{$cat->id}}" data-name="{{$cat->cat_name}}">
                  <i class="fa-solid fa-trash-can text-danger" data-bs-toggle="tooltip" title="Xóa"></i>
                </a>
                @endif
            </td>
          </tr>
          
          @if($cat->children()->count() >0)
          @foreach($cat->children as $child)
          <tr>
            <th scope="row" width='20px'></th>
            <td class="px-3">
              <div class="">
                  <a class="card-title text-decoration-none text-black fw-bold">{{ $child->cat_name }}</a>
                  <p class="card-text text-secondary d-none d-lg-block">#{{ $child->cat_slug }}</p>
              </div>
            </td>
            <td class="text-center">
              {{$child->products->count()}}
            </td>
            <td class="text-center">
              @if($child->created_at!='')
              <small class="text-black">{{ $child->created_at->format('H:i:s d/m/Y') }}</small><br><small class="text-primary">({{ $child->created_at->diffForHumans() }})</small>
              @endif
            </td>
            <td class="text-center">
                @if($child->updated_at!='')
                <small class="text-black">{{ $child->updated_at->format('H:i:s d/m/Y') }}</small><br><small class="text-primary">({{ $child->updated_at->diffForHumans() }})</small>
                @endif
            </td>
            <td class="text-center align-middle">
              <a class="btn btn-sm fw-bold btn-outline-{{$child->isActive==1?'success':'danger'}} change-status" style="width:120px;height:30px;" data-id="{{$child->id}}" data-name="{{$child->cat_name}}">
                  <i class="fa-solid fa-circle-{{$child->isActive==1?'check':'xmark'}} me-1"></i>
                  {{$child->isActive==1?'Kích hoạt':'Khóa'}}
              </a>
            </td>
            <td class="">
                <a href="{{ route('category.detail',['category'=> $child->id]) }}" class="btn rounded-circle btn-view-detail">
                  <i class="fa-solid fa-eye" data-bs-toggle="tooltip" title="Chi tiết"></i>
                </a>
                <a href="{{ route('category.edit',['category'=> $child->id]) }}" class="btn btn-edit rounded-circle">
                    <i class="fa-solid fa-pen-to-square text-primary" data-bs-toggle="tooltip" title="Sửa"></i>
                </a>
                @if(!$child->hasProducts())
                <a class="btn rounded-circle btn-delete" data-id="{{$child->id}}" data-name="{{$child->cat_name}}">
                  <i class="fa-solid fa-trash-can text-danger" data-bs-toggle="tooltip" title="Xóa"></i>
                </a>
                @endif
            </td>
          </tr>
          @endforeach
          @endif
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
{{-- @include('admin.category.modals.create-modal') --}}
{{-- script --}}
@include('admin.category.script.script')
@endsection