@extends('admin.layouts.admin')
@section('title', 'Quản lý danh mục')
@section('admin_content')
<div class="container-fluid">
    <div class="card mx-2 my-2">
      <div class="card-header py-0 pt-2 align-middle">
        <div class="float-start">
            <h3 class="text-darkcyan fw-bold">CẬP NHẬT DANH MỤC</h3>
        </div>
        {{-- <div class="float-end">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active" aria-current="page"><a class="btn btn-sm btn-success" href="{{ route('category.index') }}"><i class="fa-solid fa-clipboard-list"></i></a></li>
            </ol>
          </nav>
        </div> --}}
      </div>
    </div>
  <div class="card mx-2 border-0">
    <div class="card-header bg-white border-bottom border-4">
      <a class="btn btn-outline-primary btn-sm fw-bold float-end" href="{{route('category.index')}}">
        <i class="fa-solid fa-clipboard-list me-2"></i>
        Xem danh sách
      </a>
    </div>
    <div class="container">
    <form action="{{ route('category.update',['category'=> $data_cat->id]) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="card-body">
            <div class="mb-3">
              <label for="cat_name" class="form-label fw-bold text-uppercase" style="color: #008080">Tên danh mục <span class="text-danger">*</span></label>
              <input type="text" class="form-control @error('cat_name') is-invalid @enderror" value="{{ $data_cat->cat_name }}" id="cat_name" name="cat_name" placeholder="Phải có ít nhất 4 kí tự">
              @error('cat_name')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="py-3">
                <label for="isActive" class="form-label fw-bold me-5 text-uppercase" style="color: #008080">Trạng thái:</label>
                <div class="form-check form-check-inline me-3">
                    <input class="form-check-input" type="radio" name="isActive" id="isBlock" value="0" {{!$data_cat->isActive?'checked':''}}>
                    <label class="form-check-label" for="isBlock">KHÓA</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="isActive" id="isShow" value="1" {{$data_cat->isActive?'checked':''}}>
                    <label class="form-check-label" for="isShow">KÍCH HOẠT</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="parent_id" class="form-label fw-bold text-uppercase" style="color: #008080">Chọn danh mục cha:</label>
                <div class="form-check form-check me-3">
                    <input class="form-check-input" type="radio" name="parent_id" id="isNull" value="0" {{$data_cat->parent_id==''?'checked':''}}>
                    <label class="form-check-label" for="isNull">Đây là danh mục cha</label>
                </div>
                @if(!$data_cat->children->count()>0)
                @foreach($category_parent as $cat)
                    @if($cat->id !=$data_cat->id)
                    <div class="form-check form-check me-3">
                        <input class="form-check-input" type="radio" name="parent_id" id="is{{$cat->cat_slug}}" value="{{$cat->id}}" {{ $data_cat->parent_id == $cat->id ? 'checked' : '' }}>
                        <label class="form-check-label" for="is{{$cat->cat_slug}}">Danh mục: {{$cat->cat_name}}</label>
                    </div>
                    @endif
                @endforeach
                @endif
            </div>
            
        </div>
        <div class="card-footer">
            {{-- <button type="button" class="btn btn-outline-secondary fw-bold" style="width:100px" data-bs-dismiss="modal">HỦY</button> --}}
            <button type="submit" class="btn btn-primary fw-bold" style="width:200px">LƯU</button>
        </div>
    </form>
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
{{-- script --}}
@include('admin.category.script.script')
@endsection