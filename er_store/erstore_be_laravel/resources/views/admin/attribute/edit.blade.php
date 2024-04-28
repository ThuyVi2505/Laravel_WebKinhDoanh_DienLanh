@extends('admin.layouts.admin')
@section('title', 'Quản lý danh mục')
@section('admin_content')
<div class="container-fluid">
    <div class="card mx-2 my-2">
      <div class="card-header py-0 pt-2 align-middle">
        <div class="float-start">
            <h3 class="text-darkcyan fw-bold">CẬP NHẬT THÔNG SỐ KỸ THUẬT</h3>
        </div>
      </div>
    </div>
  <div class="card mx-2 border-0">
    <div class="card-header bg-white border-bottom border-4">
      <a class="btn btn-outline-primary btn-sm fw-bold float-end" href="{{route('attribute.index')}}">
        <i class="fa-solid fa-clipboard-list me-2"></i>
        Xem danh sách
      </a>
    </div>
    <div class="container">
    <form action="{{ route('attribute.update',['attribute'=> $data->id]) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="card-body">
            <div class="mb-3">
              <label for="key" class="form-label fw-bold text-uppercase" style="color: #008080">Tên<span class="text-danger">*</span></label>
              <input type="text" class="form-control @error('key') is-invalid @enderror" id="key" name="key" placeholder="Phải có ít nhất 4 kí tự" value="{{$data->key}}">
              @error('key')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
        </div>
        <div class="card-footer">
            {{-- <button type="button" class="btn btn-outline-secondary fw-bold" style="width:100px" data-bs-dismiss="modal">HỦY</button> --}}
            <button type="submit" class="btn btn-primary fw-bold" style="width:200px">LƯU</button>
        </div>
    </form>
</div>
</div>
<script>
    function clearImage() {
        document.getElementById('image').value = null;
        frame.src = "{{asset('assets/images/no_image.jpg')}}";
    }
</script>

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
<script src="{{asset('assets/js/image_preview.js')}}"></script>
@include('admin.category.script.script')
@endsection