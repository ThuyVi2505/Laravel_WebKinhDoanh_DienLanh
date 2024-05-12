@extends('admin.layouts.admin')
@section('title', 'Quản lý danh mục')
@section('admin_content')
<div class="container-fluid">
    <div class="card mx-2 my-2">
      <div class="card-header py-0 pt-2 align-middle">
        <div class="float-start">
            <h3 class="text-darkcyan fw-bold text-uppercase"><span class="text-black fw-normal">Khách hàng:</span> {{$userDetail->name}}</h3>
        </div>
      </div>
    </div>
    <div class="card mx-2 border-0">
        <div class="card-header bg-white border-bottom border-4">
            <a class="btn btn-outline-primary btn-sm fw-bold float-end" href="{{route('user.index')}}">
                <i class="fa-solid fa-clipboard-list me-2"></i>
                Xem danh sách
            </a>
        </div>
        <div class="card-body">
            <div class="">
                <div class="">
                    <h6 class="text-uppercase fw-bold text-black text-decoration-underline">Thông tin khách hàng:</h6>
                    <ul class="list-style-none">
                        <li><span>Tên:</span> {{$userDetail->name}}</li>
                        <li><span>Email cá nhân:</span> {{$userDetail->email}}</li>
                        <li>
                            <span>Số điện thoại liên lạc:</span> 
                            @if($userDetail->phone!='')
                            {{$userDetail->phone}}
                            @else
                            ...
                            @endif
                        </li>
                        {{-- <li><span>Trạng thái:</span> {{$userDetail->isActive?"Kích hoạt":"Khóa"}}</li> --}}
                        <li class="text-lowercase"><span>Ngày tạo:</span> {{$userDetail->created_at->format('H:i:s')}} ngày {{$userDetail->created_at->format('d/m/Y')}}</li>
                        <li class="text-lowercase"><span>Ngày cập nhật:</span> {{$userDetail->updated_at->format('H:i:s')}} ngày {{$userDetail->updated_at->format('d/m/Y')}}</li>
                    </ul>
                </div>
                <div class="">
                    <h6 class="text-uppercase fw-bold text-black text-decoration-underline">Địa chỉ:</h6>
                    <ul class="list-style-none">
                        @forelse($address as $key => $addr)
                        <li><span>Địa chỉ {{$key+1}}:</span> {{$addr->number}} {{$addr->street}}, {{$addr->ward}}, {{$addr->district}}, {{$addr->city}}</li>
                        @empty
                        <p>Chưa có địa chỉ</p>
                        @endforelse
                    </ul>
                </div>
                <div class="mt-4">
                    <h6 class="text-uppercase fw-bold text-black text-decoration-underline">Đơn hàng:</h6>
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr class="text-center align-middle text-uppercase table-warning">
                                <th width="5%"></th>
                                <th width="20%">Mã đơn hàng</th>
                                <th width="20%">Ngày tạo</th>
                                <th width="20%">Địa chỉ đặt hàng</th>
                                <th width="20%">Tổng tiền đơn hàng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $value => $order)
                            <!-- parent row -->
                            <tr class="align-middle parent-row" id="order-item{{$order->id}}">
                                <td class="text-center"><button class="toggle-btn btn bg-none border-0 cursor-pointer p-0 m-0" style="font-size: 20px;"></button></td> <!-- Plus button -->
                                <td class="px-3">
                                    <div class="">
                                        <a class="card-title text-decoration-none text-primary fw-bold">{{ $order->code }}</a>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @if($order->created_at!=null)
                                    <small>{{ $order->created_at->format('H:i:s d/m/Y') }}</small><br><small class="text-info fw-bold">({{ $order->created_at->diffForHumans() }})</small>
                                    @endif
                                </td>
                                <td>
                                    <a class="card-title text-decoration-none text-black">{{$order->address_ship}}</a>
                                </td>
                                <td class="text-center">
                                    <a class="card-title text-decoration-none text-black">{{ number_format($order->total_amount, 0, ',', '.')}}</a>
                                </td>
                            </tr>
                            <!-- child row -->
                            <tr class="child-row align-middle bg-light">
                                <td class=""></td>
                                <td class="" colspan="4">
                                    <a class="card-title text-decoration-none text-secondary fw-bold text-uppercase">Chi tiết đơn hàng</a>
                                    <table class="table table-white">
                                        <thead class="text-center align-middle table-light">
                                          <tr>
                                            <th>#</th>
                                            <th class="text-start">Tên sản phẩm</th>
                                            <th class="">Đơn giá</th>
                                            <th class="">Số lượng</th>
                                            <th class="">Tổng tiền</th>
                                          </tr>
                                        </thead>
                                        <tbody class="table-group-divider">
                                          @forelse($order->order_details as $value => $item)
                                          <tr>
                                            <td class="text-center border">{{$value+1}}</td>
                                            <td class="">
                                                <a class="card-title text-decoration-none text-dark text-uppercase">{{ $item->product->prod_name }} {{ $item->product->prod_model }}</a>
                                            </td>
                                            <td class="">
                                                <div class="text-center">
                                                    <a class="card-title text-decoration-none text-dark">{{ number_format($item->price, 0, ',', '.')}}</a>
                                                    <p class="card-text text-danger">(giảm {{$item->percent_sale}}%)</p>
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
                                        </tbody>
                                      </table>
                                </td>
                            </tr>
                            @empty
                            <tr class="align-middle">
                                <td class="text-center" colspan="4">
                                    Chưa có đơn hàng
                                </td>
                            </tr>
                            @endforelse
                             {{-- ưuhduw --}}
                        </tbody>
                    </table>
                    <div class="">
                        {!!$orders->appends($_GET)->links('admin.layouts.pagination.admin-pagination')!!}
                    </div>
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
@include('admin.user.script.script')
@endsection