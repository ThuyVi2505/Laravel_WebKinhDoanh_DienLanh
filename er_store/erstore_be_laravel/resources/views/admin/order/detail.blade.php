@extends('admin.layouts.admin')
@section('title', 'Quản lý danh mục')
@section('admin_content')
<div class="container-fluid">
    <div class="card mx-2 my-2">
      <div class="card-header py-0 pt-2 align-middle">
        <div class="float-start">
            <h3 class="text-darkcyan fw-bold text-uppercase"><span class="text-black fw-normal">Đơn hàng:</span> {{$order->code}}</h3>
        </div>
      </div>
    </div>
    <div class="card mx-2 border-0">
        <div class="card-header bg-white border-bottom border-4">
            <a class="btn btn-outline-primary btn-sm fw-bold float-end" href="{{route('order.index')}}">
                <i class="fa-solid fa-clipboard-list me-2"></i>
                Xem danh sách
            </a>
        </div>
        <div class="card-body">
            <div class="">
                <div class="">
                    <h6 class="text-uppercase fw-bold text-black text-decoration-underline">Thông tin đơn hàng:</h6>
                    <ul class="list-style-none">
                        <li><span>Mã đơn hàng:</span> {{$order->code}}</li>
                        {{-- <li><span>Tổng tiền:</span> {{ number_format($order->total_amount, 0, ',', '.')}}</li> --}}
                        <li class="text-lowercase"><span>Ngày tạo:</span> {{$order->created_at->format('H:i:s')}} ngày {{$order->created_at->format('d/m/Y')}}</li>
                        <li><span>Địa chỉ vận chuyển:</span> {{ $order->address_ship}}</li>
                    </ul>
                </div>
                <div class="">
                    <h6 class="text-uppercase fw-bold text-black text-decoration-underline">Thông tin khách hàng:</h6>
                    <ul class="list-style-none">
                        <li><span>Tên khách hàng:</span> {{$user->name}}</li>
                        <li><span>Email:</span> {{$user->email}}</li>
                        <li><span>Số điện thoại liên lạc:</span> 
                            @if($user->phone!='')
                            {{substr($user->phone, 0, 3) . ' ' . substr($user->phone, 3, 3) . ' ' . substr($user->phone, 6)}}
                            {{-- {{$user->phone}} --}}
                            @else
                            <p class="text-danger">...</p>
                            @endif
                        </li>
                    </ul>
                </div>
                <div class="mt-4">
                    <h6 class="text-uppercase fw-bold text-black text-decoration-underline">Chi tiết đơn hàng:</h6>
                    <table class="table mt-4 table-sm">
                        <thead class="text-center align-middle table-light">
                          <tr class="text-center align-middle text-uppercase table-warning text-secondary">
                            <th>#</th>
                            <th class="text-start">Tên sản phẩm</th>
                            <th class="">Đơn giá</th>
                            <th class="">Số lượng</th>
                            <th class="">Tổng tiền</th>
                          </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            @forelse($order_details as $value => $item)
                            <tr>
                              <td class="text-center">{{$value+1}}</td>
                              <td class="">
                                <div class="d-flex align-items-center">
                                    <div class=" me-3">
                                        <img id="" src="{{ $item->product->images->first()->image==null ? 
                                                                asset('assets/images/no_image.jpg') 
                                                                : asset('storage/uploads/Product/'.$item->product->id.'/'.$item->product->images->first()->image) }}" class="gallery-item rounded card-img-bottom object-fit-contain border border-1" style="height: 50px; width:80px;" />
                                    </div>
                                    <div class="">
                                        <a class="card-title text-decoration-none text-primary fw-bold">{{ $item->product->prod_name }} {{$item->product->prod_model}}</a>
                                    </div>
                                </div>
                              </td>
                              <td class="">
                                  <div class="text-center">
                                      <a class="card-title text-decoration-none text-dark">{{ number_format($item->price, 0, ',', '.')}}</a>
                                      <p class="card-text text-danger">(đã giảm {{$item->percent_sale}}%)</p>
                                  </div>
                              </td>
                              <td class="">
                                  <div class="text-center">
                                      <a class="card-title text-decoration-none text-dark">{{ $item->quantity }}</a>
                                  </div>
                              </td>
                              <td class="">
                                  <div class="text-center">
                                      <a class="card-title text-decoration-none text-dark">{{ number_format($item->total_price, 0, ',', '.')}}</a>
                                  </div>
                              </td>
                            </tr>
                            @empty
                            <tr class="align-middle">
                              <td class="text-center" colspan="10">
                              Không có dữ liệu
                              </td>
                            </tr>
                            @endforelse
                            <tr class="bg-light">
                                <td class="" colspan="4">
                                    <div class="text-center">
                                        <a class="card-title text-decoration-none text-dark fw-bold">TỔNG TIỀN ĐƠN HÀNG:</a>
                                    </div>
                                </td>
                                <td class="">
                                    <div class="text-center">
                                        <a class="card-title text-decoration-none text-success fw-bold">{{ number_format($order->total_amount, 0, ',', '.')}}</a>
                                    </div>
                                </td>
                              </tr>
                          </tbody>
                      </table>
                </div>
            </div>
            
            
        </div>
    </div>
</div>
<!-- style -->
<style>
  li{
    padding-top: 5px;
    /* text-transform: uppercase; */
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