<!-- Create Modal -->
<div class="modal fade" id="createCat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header" style="background-color:#008080">
          <h1 class="modal-title text-white fs-5" id="staticBackdropLabel">THÊM MỚI DANH MỤC</h1>
          <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{route('category.store')}}" method="POST">
            @csrf
            <div class="modal-body">
                <div class="mb-3">
                  <label for="cat_name" class="form-label fw-semibold">Tên danh mục <span class="text-danger">*</span></label>
                  <input type="text" class="form-control @error('cat_name') is-invalid @enderror" id="cat_name" name="cat_name" placeholder="Phải có ít nhất 4 kí tự">
                  @error('cat_name')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="parent_id" class="form-label fw-semibold">Chọn danh mục cha</label>
                  <select class="form-select" id="parent_id" name="parent_id" aria-label="Default select example">
                    <option value="" selected>Đây là danh mục cha</option>
                    @foreach($category_parent as $cat)
                    <option value="{{$cat->id}}">{{$cat->cat_name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="mb-3">
                    <label for="isActive" class="form-label fw-semibold me-5">Kích hoạt</label>
                    <div class="form-check form-check-inline me-3">
                        <input class="form-check-input" type="radio" name="isActive" id="isBlock" value="0" checked>
                        <label class="form-check-label" for="isBlock">KHÓA</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="isActive" id="isShow" value="1">
                        <label class="form-check-label" for="isShow">KÍCH HOẠT</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary fw-bold" style="width:100px" data-bs-dismiss="modal">HỦY</button>
                <button type="submit" class="btn btn-primary fw-bold" style="width:200px">LƯU</button>
            </div>
        </form>
      </div>
    </div>
  </div>