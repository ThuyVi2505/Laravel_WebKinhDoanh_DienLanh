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
    {{-- <div class="card-header bg-white border-bottom border-4">
      <a class="btn btn-primary btn-sm fw-bold float-end" href="{{route('brand.create')}}">
        <i class="fa-solid fa-circle-plus me-2"></i>
        Thêm mới
      </a>
    </div> --}}
    {{-- <div class="card-header bg-white">
      <h5 class="fw-bold float-start text-secondary">
        Số lượng: {{$all_count}}
      </h5>
    </div> --}}
    <div class="table-responsive" id="div-table">
      
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
@include('admin.brand.script.script')
@endsection
