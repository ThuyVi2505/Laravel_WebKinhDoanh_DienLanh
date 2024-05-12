@extends('admin.layouts.admin')
@section('title', 'Quản lý danh mục')
@section('admin_content')
<div class="container-fluid">
    <div class="card mx-2 my-2">
      <div class="card-header py-0 pt-2 align-middle">
        <div class="float-start">
            <h3 class="text-darkcyan fw-bold">Thông số kỹ thuật</h3>
        </div>
        <div class="float-end">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page"><a class="btn btn-sm btn-success" href="{{ route('attribute.index') }}"><i class="fa-solid fa-rotate"></i></a></li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  <div class="card mx-2 border-0">
    <div class="card-header bg-white">
      <a class="btn btn-primary btn-sm fw-bold float-end" href="{{route('attribute.create')}}">
        <i class="fa-solid fa-circle-plus me-2"></i>
        Thêm mới
      </a>
    </div>
    <form id="search-form" action="" method="GET" class="px-5 py-1 border-bottom border-top border-3">
      <div class="d-flex justify-content-start align-item-center">
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
      <table class="table table-hover table-sm">
        <thead class="text-center align-middle text-uppercase table-light">
          <tr>
            <th width="30%" class="text-start">Tên thông số kỹ thuật</th>
            <th width="15%">Ngày tạo</th>
            <th width="15%">Ngày cập nhật</th>
            <th width="10%" class="text-start">Action</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          @forelse($attributes as $value => $attr)
          <tr>
            {{-- <th scope="row" class="text-center border">{{$value+1}}</th> --}}
            <td class="px-3">
                    <a class="card-title text-decoration-none text-primary fw-bold text-uppercase">{{ $attr->key }}</a>
            </td>
            <td class="text-center">
              @if($attr->created_at!='')
              <small class="text-black">{{ $attr->created_at->format('H:i:s d/m/Y') }}</small><br><small class="text-primary">({{ $attr->created_at->diffForHumans() }})</small>
              @endif
            </td>
            <td class="text-center">
                @if($attr->updated_at!='')
                <small class="text-black">{{ $attr->updated_at->format('H:i:s d/m/Y') }}</small><br><small class="text-primary">({{ $attr->updated_at->diffForHumans() }})</small>
                @endif
            </td>
            <td class="">
                <a href="{{ route('attribute.edit',['attribute'=> $attr->id]) }}"  class="btn btn-edit rounded-circle">
                    <i class="fa-solid fa-pen-to-square text-primary" data-bs-toggle="tooltip" title="Sửa"></i>
                </a>
                <a class="btn rounded-circle btn-delete" data-id="{{$attr->id}}" data-name="{{$attr->key}}">
                  <i class="fa-solid fa-trash-can text-danger" data-bs-toggle="tooltip" title="Xóa"></i>
                </a>
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
        {!!$attributes->appends($_GET)->links('admin.layouts.pagination.admin-pagination')!!}
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
{{-- @include('admin.category.modals.create-modal') --}}
{{-- script --}}
@include('admin.attribute.script.script')
@endsection