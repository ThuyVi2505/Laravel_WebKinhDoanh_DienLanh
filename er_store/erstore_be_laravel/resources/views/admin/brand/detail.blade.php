@extends('admin.layouts.admin')
@section('title', 'Quản lý danh mục')
@section('admin_content')
<div class="container-fluid">
    <div class="card mx-2 my-2">
      <div class="card-header py-0 pt-2 align-middle">
        <div class="float-start">
            <h3 class="text-darkcyan fw-bold text-uppercase"><span class="text-black fw-normal">Thương hiệu:</span> {{$brand_detail->brand_name}}</h3>
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
        <div class="card-body">
            <div class="">
                <div class="">
                    <h6 class="text-uppercase fw-bold text-black text-decoration-underline">Thông tin thương hiệu:</h6>
                    <ul class="list-style-none">
                        <li><span>Tên:</span> {{$brand_detail->brand_name}}</li>
                        <li><span>Trạng thái:</span> {{$brand_detail->isActive?"Kích hoạt":"Khóa"}}</li>
                        <li><span>Ngày tạo:</span> {{$brand_detail->created_at->format('H:i:s d/m/y')}}</li>
                        <li><span>Ngày cập nhật:</span> {{$brand_detail->updated_at->format('H:i:s d/m/y')}}</li>
                    </ul>
                </div>
                <div class="mt-4">
                    <h6 class="text-uppercase fw-bold text-black text-decoration-underline">Sản phẩm thuộc thương hiệu:</h6>
                    <table class="table mt-4">
                        <thead class="table-light">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Thương hiệu</th>
                          </tr>
                        </thead>
                        <tbody class="table-group-divider">
                        @forelse($brand_detail->products as $value => $prod)
                          <tr>
                            <th scope="row">#</th>
                            <td class="align-middle">
                              <div class="d-flex align-items-center">
                                <div class=" me-3">
                                    <img id="" src="{{ $prod->images->first()->image==null ? 
                                                            asset('assets/images/no_image.jpg') 
                                                            : asset('storage/uploads/Product/'.$prod->id.'/'.$prod->images->first()->image)}}" class="gallery-item rounded card-img-bottom object-fit-contain border border-1" style="height: 50px; width:80px;" />
                                </div>
                                <div class="">
                                    <a class="card-title text-decoration-none text-primary fw-bold">{{ $prod->prod_name }}</a>
                                    <p class="card-text text-secondary d-none d-lg-block">#{{ $prod->prod_slug }}</p>
                                </div>
                            </div>
                            </td>
                            <td class="text-{{$prod->isActive?"success":"danger"}} align-middle">{{$prod->isActive?"Kích hoạt": "Khóa"}}</td>
                            @if(!$brand_detail->parent_id)
                            <td class="align-middle">{{$prod->brand->brand_name}}</td>
                            @endif
                            <td class="align-middle">{{$prod->brand->brand_name}}</td>
                          </tr>
                          @empty
                            <tr class="align-middle">
                                <td class="text-center" colspan="10">
                                Danh mục này chưa có sản phẩm nào
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                      </table>
                </div>
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
  li{
    padding-top: 5px;
    text-transform: uppercase;
  }
  li span{
    margin-right: 5px;
    text-transform: none;
    font-weight: bold;
    color: #008080;
  }
</style>
{{-- script --}}
@include('admin.brand.script.script')
@endsection