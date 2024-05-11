@extends('admin.layouts.admin')
@section('title', 'Quản lý khách hàng')
@section('admin_content')
<div class="container-fluid">
    <div class="card mx-2 my-2">
      <div class="card-header py-0 pt-2 align-middle">
        <div class="float-start">
            <h3 class="text-darkcyan fw-bold text-uppercase">Thông tin khách hàng</h3>
        </div>
        <div class="float-end">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page"><a class="btn btn-sm btn-success" href="{{ route('user.index') }}"><i class="fa-solid fa-rotate"></i></a></li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  <div class="card mx-2 border-0">
    <form id="search-form" action="" method="GET" class="px-5 py-1 border-bottom border-top border-3">
      <div class="d-flex justify-content-start align-item-center">
        <!-- search box name-->
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
            <th width="10%">Tên người dùng</th>
            <th width="20%">Email</th>
            <th width="5%">Số điện thoại</th>
            <th width="10%">Ngày tạo</th>
            {{-- <th width="10%">Ngày<br>cập nhật</th> --}}
            {{-- <th width="10%">Trạng<br>thái</th> --}}
            <th width="5%">Action</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          @forelse($users as $value => $user)
          <tr>
            {{-- <th scope="row" class="text-center border">{{$value+1}}</th> --}}
            <td class="px-3">
              <div class="">
                <a class="card-title text-decoration-none text-primary fw-bold text-uppercase">{{ $user->name }}</a>
              </div>
            </td>
            <td class="text-center">
              <div class="">
                <a class="card-title text-decoration-none text-black">{{ $user->email }}</a>
              </div>
            </td>
            <td class="text-center">
              @if($user->phone!='')
                {{substr($user->phone, 0, 3) . ' ' . substr($user->phone, 3, 3) . ' ' . substr($user->phone, 6)}}
                {{-- {{$user->phone}} --}}
              @else
                <p class="text-danger">...</p>
              @endif
            </td>
            <td class="text-center">
              @if($user->created_at!='')
              <small class="text-black">{{ $user->created_at->format('H:i:s d/m/Y') }}</small><br><small class="text-primary">({{ $user->created_at->diffForHumans() }})</small>
              @endif
            </td>
            {{-- <td class="text-center">
                @if($user->updated_at!='')
                <small class="text-black">{{ $user->updated_at->format('H:i:s d/m/Y') }}</small><br><small class="text-primary">({{ $user->updated_at->diffForHumans() }})</small>
                @endif
            </td> --}}
            {{-- <td class="text-center">
                <a class="btn btn-sm fw-bold btn-outline-{{$user->isActive==1?'success':'danger'}} change-status" style="width:120px;height:30px;" data-id="{{$user->id}}" data-name="{{$user->genre_name}}">
                    <i class="fa-solid fa-circle-{{$user->isActive==1?'check':'xmark'}} me-1"></i>
                    {{$user->isActive==1?'Kích hoạt':'Khóa'}}
                </a>
            </td> --}}
            <td class="text-center">
                <a href="{{ route('user.detail',['user'=> $user->id]) }}" class="btn rounded-circle btn-view-detail">
                  <i class="fa-solid fa-eye" data-bs-toggle="tooltip" title="Chi tiết"></i>
                </a>
                {{-- <a href="{{ route('user.edit',['user'=> $user->id]) }}" class="btn btn-edit rounded-circle">
                    <i class="fa-solid fa-pen-to-square text-primary" data-bs-toggle="tooltip" title="Sửa"></i>
                </a> --}}
                {{-- <a class="btn rounded-circle btn-delete" data-id="{{$user->id}}" data-name="{{$user->prod_name}}">
                  <i class="fa-solid fa-trash-can text-danger" data-bs-toggle="tooltip" title="Xóa"></i>
                </a> --}}
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
        {!!$users->appends($_GET)->links('admin.layouts.pagination.admin-pagination')!!}
      </div>
    </div>
</div>
</div>
<!-- style -->
<style>
  .btn-view-detail:hover {
      border: 1px solid #000000;
  }
  /* .btn-delete:hover {
      border: 1px solid #dc3545;
  }

  .btn-edit:hover {
      border: 1px solid #0d6efd;
  } */
</style>
{{-- modal --}}
{{-- script --}}
@include('admin.user.script.script')
@endsection
