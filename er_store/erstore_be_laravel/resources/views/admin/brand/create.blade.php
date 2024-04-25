@extends('admin.layouts.admin')
@section('title', 'Quản lý danh mục')
@section('admin_content')
<div class="container-fluid">
    <div class="card mx-2 my-2">
      <div class="card-header py-0 pt-2 align-middle">
        <div class="float-start">
            <h3 class="text-darkcyan fw-bold">THÊM THƯƠNG HIỆU</h3>
        </div>
      </div>
    </div>
  <div class="card mx-2 border-0">
    <div class="card-header bg-white border-bottom border-4">
      <a class="btn btn-outline-primary btn-sm fw-bold float-end" href="{{route('brand.index')}}">
        <i class="fa-solid fa-clipboard-list me-2"></i>
        Xem danh sách
      </a>
    </div>
    <div class="container">
    <form action="{{route('brand.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="mb-3">
              <label for="brand_name" class="form-label fw-bold text-uppercase" style="color: #008080">Tên thương hiệu <span class="text-danger">*</span></label>
              <input type="text" class="form-control @error('brand_name') is-invalid @enderror" id="brand_name" name="brand_name" placeholder="Phải có ít nhất 4 kí tự">
              @error('brand_name')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="py-3">
                <label for="isActive" class="form-label fw-bold me-5 text-uppercase" style="color: #008080">Trạng thái:</label>
                <div class="form-check form-check-inline me-3">
                    <input class="form-check-input" type="radio" name="isActive" id="isBlock" value="0" checked>
                    <label class="form-check-label" for="isBlock">KHÓA</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="isActive" id="isShow" value="1">
                    <label class="form-check-label" for="isShow">KÍCH HOẠT</label>
                </div>
            </div>
            {{-- Hình ảnh --}}
            <div class="form-group">
                <label for="thumnail" class="form-label fw-bold text-uppercase" style="color: #008080">Hình ảnh <span class="text-danger">*</span></label>
                <div class="d-flex" style="height: 140px">
                    <div class="w-100 me-2">
                        <input type="file" accept=".jpeg, .png, .jpg" class="form-control h-100 @error('thumnail') is-invalid @enderror" id="image" name="thumnail" onchange="preview()" accept="image/*" />
                        @error('thumnail')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="" style="width:180px;">
                        <img id="frame" src="{{asset('assets/images/no_image.jpg')}}" class="me-2 rounded card-img-bottom object-fit-contain border border-2 border-info" style="height: 140px; width:180px;">
                        <div class="btn btn-danger mt-2 w-100" onclick="clearImage()" style="height: 40px;cursor: pointer;">
                            <label class="form-label text-white" style="cursor: pointer;"><i class="fa-solid fa-circle-xmark me-2"></i> Xóa ảnh</label>
                        </div>
                    </div>
                    
                </div>
                <div class="mt-1 ms-3 d-flex" style="height: 40px; width: 40px;">
                    {{-- <div class="btn btn-danger mx-1 rounded-circle" onclick="clearImage()">
                        <label class="form-label text-white" for=""><i class="fa-solid fa-circle-xmark"></i></label>
                    </div> --}}
                    {{-- <div class="btn btn-secondary mx-1 w-100">
                        <label class="form-label text-white" for="image"><i class="fa-solid fa-arrow-up-from-bracket"></i></label>
                        <input type="file" accept=".jpeg, .png, .jpg" class="form-control d-none" id="image" name="thumnail" onchange="preview()" accept="image/*" />
                    </div> --}}
                </div>
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