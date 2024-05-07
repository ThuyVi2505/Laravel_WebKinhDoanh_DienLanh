@extends('admin.layouts.admin')
@section('title', 'Quản lý danh mục')
@section('admin_content')
<div class="container-fluid">
    <div class="card mx-2 my-2">
      <div class="card-header py-0 pt-2 align-middle">
        <div class="float-start">
            <h3 class="text-darkcyan fw-bold">CẬP NHẬT SẢN PHẨM</h3>
        </div>
      </div>
    </div>
  <div class="card mx-2 border-0">
    <div class="card-header bg-white border-bottom border-4">
      <a class="btn btn-outline-primary btn-sm fw-bold float-end" href="{{route('product.index')}}">
        <i class="fa-solid fa-clipboard-list me-2"></i>
        Xem danh sách
      </a>
    </div>
    <div class="container">
    <form action="{{ route('product.update',['product'=> $productDetail->id]) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="card-body">
            <div class="row row-cols-1 row-cols-md-2">
                <div class="mb-3">
                    <label for="" class="mb-2 text-secondary fw-bold text-uppercase">Thông tin cơ bản:</label>
                    <div class="border px-3 py-3 border-2" style="border-radius:10px;">
                        <div class="row row-cols-1 row-cols-md-2">
                            <div class="mb-3">
                                <label for="prod_name" class="form-label fw-bold" style="color: #008080">Tên sản phẩm <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('prod_name') is-invalid @enderror" id="prod_name" name="prod_name" placeholder="Phải có ít nhất 4 kí tự" value="{{ $productDetail->prod_name }}">
                                @error('prod_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="prod_model" class="form-label fw-bold" style="color: #008080">Model sản phẩm <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('prod_model') is-invalid @enderror" id="prod_model" name="prod_model" placeholder="Phải có ít nhất 6 kí tự" value="{{ $productDetail->prod_model }}">
                                @error('prod_model')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row row-cols-1 row-cols-md-2">
                            <div class="mb-3">
                                <label for="prod_price" class="form-label fw-bold" style="color: #008080">Giá bán <span class="text-danger">*</span></label>
                                <input type="number" min="0" step="1000" class="form-control @error('prod_price') is-invalid @enderror" id="prod_price" name="prod_price" autocomplete="false" value="{{ $productDetail->prod_price }}">
                                @error('prod_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="prod_stock" class="form-label fw-bold" style="color: #008080">Số lượng tồn <span class="text-danger">*</span></label>
                                <input type="number" min="0" max="1000" step="1" class="form-control @error('prod_stock') is-invalid @enderror" id="prod_stock" name="prod_stock" placeholder="Phải nhỏ hơn 1000" value="{{ $productDetail->prod_stock }}">
                                @error('prod_stock')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row row-cols-1 row-cols-md-2">
                            <div class="mb-3">
                                <label for="origin_country" class="form-label fw-bold" style="color: #008080">Xuất xứ <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('origin_country') is-invalid @enderror" id="origin_country" name="origin_country" placeholder="ví dụ: Nhật bản, Mỹ,..." value="{{ $productDetail->origin_country }}">
                                @error('origin_country')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="guarantee_period" class="form-label fw-bold" style="color: #008080">Thời gian bảo hàng <span class="text-danger">*</span></label>
                                <input type="number" min="0" max="100" step="1" class="form-control @error('guarantee_period') is-invalid @enderror" id="guarantee_period" name="guarantee_period" placeholder="Tính theo tháng" value="{{ $productDetail->guarantee_period }}">
                                @error('guarantee_period')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="py-4">
                            <label for="isActive" class="form-label fw-bold me-4" style="color: #008080">Trạng thái:</label>
                            <div class="form-check form-check-inline me-3">
                                <input class="form-check-input" type="radio" name="isActive" id="isBlock" value="0" {{!$productDetail->isActive?'checked':''}}>
                                <label class="form-check-label" for="isBlock">KHÓA</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="isActive" id="isShow" value="1" {{$productDetail->isActive?'checked':''}}>
                                <label class="form-check-label" for="isShow">KÍCH HOẠT</label>
                            </div>
                        </div>
                    </div>
                    <label for="" class="mb-2 mt-3 text-secondary fw-bold text-uppercase">Sản phẩm thuộc:</label>
                    <div class="border px-3 py-3 border-2" style="border-radius:10px;">
                            <div class="mb-3">
                                <label for="cat_id" class="form-label fw-bold" style="color: #008080">Danh mục <span class="text-danger">*</span></label>
                                <select class="form-select @error('cat_id') is-invalid @enderror" id="cat_id" name="cat_id" aria-label="Default select example">
                                    <option value="" selected disabled>chọn danh mục</option>
                                    @foreach($category_list as $item)
                                        <option value="{{$item->id}}" class="text-uppercase fw-bold {{$item->hasAnyChild()?'bg-light':''}}" {{$item->hasAnyChild()?'disabled':''}}>{{$item->cat_name}}</option>
                                        @foreach($item->children as $child)
                                            <option value="{{$child->id}}" {{$productDetail->cat_id == $child->id?'selected':''}}>{{$item->cat_name}} {{$child->cat_name}}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                                @error('cat_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="brand_id" class="form-label fw-bold" style="color: #008080">Thương hiệu <span class="text-danger">*</span></label>
                                <div class="border px-2 @error('brand_id') is-invalid @enderror" style="border-radius:5px">
                                    @foreach($brand_list as $item)
                                    <label>
                                        <input type="radio" class="brand" id="brand_id" name="brand_id" value="{{$item->id}}" {{$productDetail->brand_id == $item->id?'checked':''}}>
                                        <img src="{{asset('storage/uploads/Brand/'.$item->thumnail)}}" class="me-2 my-2 p-2 border border-1" style="border-radius:10px" alt="Option 2" width="120px" height="80px">
                                    </label>
                                    @endforeach
                                </div>
                                @error('brand_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                    </div>
                    <label for="" class="mb-2 mt-3 text-secondary fw-bold text-uppercase">Giảm giá:</label>
                    <div class="border px-3 py-3 border-2" style="border-radius:10px;">
                            <div class="mb-3">
                                <label for="sale_percent" class="form-label fw-bold" style="color: #008080">Phần trăm giảm giá <span class="text-danger">(Không giảm thì nhập 0)</span></label>
                                <input type="number" max="100" min="0" step="1" class="form-control @error('sale_percent') is-invalid @enderror" id="sale_percent" name="sale_percent" placeholder="Nhập từ 0 đến 100" value="{{ $productDetail->sale->percent}}">
                                @error('sale_percent')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                    </div>
                    
                </div>
                <div class="mb-3">
                    <label for="" class="mb-2 text-secondary fw-bold text-uppercase">Thông số kỹ thuật:</label>
                    {{-- <div class="border px-3 py-3 border-2" style="border-radius:10px;">
                        @foreach($attributes as $attribute)
                        <label for="{{ 'attribute_'.$attribute->id }}" class="form-label fw-bold" style="color: #008080">{{ $attribute->key }}</label>
                        <input type="text" class="form-control mb-3" id="{{ 'attribute_'.$attribute->id }}" name="attributes[{{ $attribute->id }}]" placeholder="" value="{{ $productDetail->attributes->where('id', $attribute->id)->first()->pivot->value ?? '' }}">
                        @endforeach
                    </div> --}}
                    <div class="border px-3 py-3 border-2" style="border-radius:10px;">
                        <div class="d-flex justify-content-end align-items-center mb-2">
                            <a class="text-secondary me-3 text-decoration-none">Bấm vào đây để thêm thông số kỹ thuật <i class="fa-solid fa-arrow-right"></i></a>
                            <a onclick="addAttributeField()" class="btn btn-success py-0 px-0" style="width:30px;height:30px"><i class="fa-solid fa-plus"></i></a>
                        </div>
                        <hr>
                        <div id="attribute_fields">
                            <div class="attribute_field">
                                @foreach($productDetail->attributes as $key=>$attributeId)
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <select class="form-select" name="attributes[]" onchange="disableSelectedOptions()">
                                        <option disabled selected>Chọn thông số kỹ thuật</option>
                                        @foreach($attributes as $attribute)
                                            <option value="{{ $attribute->id }}" {{ $attributeId->id == $attribute->id ? 'selected' : '' }}>{{ $attribute->key }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="form-control mx-2 value" name="values[]" value="{{ $attributeId->pivot->value }}" placeholder="Nhập giá trị">
                                    <a type="button" class="btn btn-danger btn-sm" style="width:30px;height:30px;" onclick="removeAttributeField(this)"><i class="fa-solid fa-xmark"></i></a>
                                </div>
                                @endforeach
                            {{-- add content attribute here --}}
                            </div>
                        </div>
                        <script>
                            function addAttributeField() {
                                var attributeField = document.createElement('div');
                                attributeField.className = 'attribute_field';
                                attributeField.innerHTML = `
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <select class="form-select" name="attributes[]" onchange="disableSelectedOptions()">
                                            <option disabled selected>Chọn thông số kỹ thuật</option>
                                            @foreach($attributes as $attribute)
                                                <option value="{{ $attribute->id }}">{{ $attribute->key }}</option>
                                            @endforeach
                                        </select>
                                        <input type="text" class="form-control mx-2 value" name="values[]" placeholder="Nhập giá trị">
                                        <a type="button" class="btn btn-danger btn-sm" style="width:30px;height:30px;" onclick="removeAttributeField(this)"><i class="fa-solid fa-xmark"></i></a>
                                    </div>
                                `;
                                document.getElementById('attribute_fields').appendChild(attributeField);
                                disableSelectedOptions();
                            }
                            
                            function removeAttributeField(button) {
                                button.parentNode.remove();
                                disableSelectedOptions();
                            }
                            function disableSelectedOptions() {
                                var selects = document.getElementsByName("attributes[]");
                                var selectedValues = [];
                                for (var i = 0; i < selects.length; i++) {
                                    var selectedOption = selects[i].options[selects[i].selectedIndex];
                                    if (selectedOption.value !== "") {
                                        selectedValues.push(selectedOption.value);
                                    }
                                }
                                var options = document.querySelectorAll("select[name='attributes[]'] option");
                                options.forEach(function(option) {
                                    if (selectedValues.includes(option.value)) {
                                        option.hidden = true;
                                    } else {
                                        option.hidden = false;
                                    }
                                });
                            }
                            document.getElementById('product_form').addEventListener('submit', function() {
                                disableSelectedOptions();
                            });

                        </script>
                    </div>
                </div>

            </div>
            <div class="form-group mb-3 money">
                <label for="prod_description" class="mb-2 text-secondary fw-bold text-uppercase">Mô tả:</label>
                <textarea class="form-control" name="prod_description" id="prod_description" rows="5" placeholder="Viết mô tả sản phẩm" style="min-height: 140px; resize:none;">{{ $productDetail->prod_description}}</textarea>
            </div>
            {{-- Hình ảnh --}}
            <div class="form-group">
                <label for="images" class="form-label text-secondary fw-bold text-uppercase">Hình ảnh</label>
                <p class="text-danger mb-0">* Chọn ảnh khi cần thêm cho sản phẩm</p>
                <p class="text-danger mt-0">* Định dạng ảnh phải có đuôi: jpg, jpeg, png</p>
                <div class="d-flex" style="height: 140px">
                    <div class="w-100 me-2">
                        <input type="file" accept=".jpeg, .png, .jpg" class="form-control h-100 @error('images') is-invalid @enderror" id="images" multiple name="images[]" onchange="preview()" accept="image/*" />
                        @error('images')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    {{-- <div class="" style="width:180px;">
                        <img id="frame" src="{{asset('assets/images/no_image.jpg')}}" class="me-2 rounded card-img-bottom object-fit-contain border border-2 border-info" style="height: 140px; width:180px;">
                        <div class="btn btn-danger mt-2 w-100" onclick="clearImage()" style="height: 40px;cursor: pointer;">
                            <label class="form-label text-white" style="cursor: pointer;"><i class="fa-solid fa-circle-xmark me-2"></i> Xóa ảnh</label>
                        </div>
                    </div> --}}
                </div>
            </div>
            
        </div>
        <div class="card-footer">
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
    /* HIDE RADIO */
    [type=radio].brand { 
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* IMAGE STYLES */
    [type=radio].brand + img {
        cursor: pointer;
    }

    /* CHECKED STYLES */
    [type=radio].brand:checked + img {
        outline: 3px solid #dc3545;
    }
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
<!-- ckeditor -->
{{-- <script src="/ckeditor5-classic/ckeditor.js"></script> --}}
@include('admin.category.script.script')
@endsection