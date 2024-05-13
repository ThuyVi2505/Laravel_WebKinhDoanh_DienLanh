@extends('admin.layouts.admin')
@section('title', 'Quản lý thương hiệu')
@section('admin_content')
<div class="container-fluid">
    {{-- Title breadcrumb --}}
    <div class="card border-0 my-2">
        <div class="card-header py-0 pt-2 align-middle border-0">
          <div class="float-start">
              <h3 class="text-darkcyan"><i class="fa-solid fa-ranking-star me-2"></i>Thống kê</h3>
          </div>
          <div class="float-end align-middle">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page"><a class="btn btn-sm btn-primary" href="{{ route('admin.dashboard') }}" title="Tải lại trang"><i class="fa-solid fa-rotate"></i></a></li>
              </ol>
            </nav>
          </div>
        </div>
    </div>
    <div class="card border-0 px-3">
        {{-- content count --}}
        <div class="row">
            <div class="col-12 col-lg-9 col-md-8">
                <div class="row row-cols-1 row-cols-sm-2">
                    {{-- order in today --}}
                    <div class="mb-2">
                        <h6 class="text-uppercase fw-bold text-secondary text-decoration-none">Đơn hàng ngày:</h6>
                        <div class="rounded border border-3 div-more p-3">
                            <i class="fa-solid fa-calendar-week text-secondary icon-more" style="width:30px;height:30px;"></i>
                            <a class="d-flex align-items-center a-more" href="{{ route('order.index', ['start_date' => $nowDate, 'end_date' =>$nowDate]) }}"><i class="fa-regular fa-circle-info me-1" style="width:20px;height:20px;"></i>Chi tiết</a>
                            <div class="d-flex justify-content-center align-items-center px-5 ms-2 mt-3">
                                <a class="fw-bold text-decoration-none text-secondary" style="font-size: 20px">{{ number_format($order_in_today->order_count, 0, ',', ',')}}<span class="ms-2 fw-normal">đơn</span></a>
                            </div>
                            <div class="d-flex justify-content-center align-items-center">
                                <a class="fw-bold text-decoration-none text-danger" style="font-size: 25px">{{ number_format($order_in_today->total_amount_sum, 0, ',', ',')}}<span class="ms-1 fw-normal text-secondary">&#8363;</span></a>
                            </div>
                        </div>
                    </div>
                    {{-- order in week --}}
                    <div class="mb-2">
                        <h6 class="text-uppercase fw-bold text-secondary text-decoration-none">Đơn hàng tuần:</h6>
                        <div class="rounded border border-3 div-more p-3">
                            <i class="fa-solid fa-calendar-day text-secondary icon-more" style="width:30px;height:30px;"></i>
                            <a class="d-flex align-items-center a-more" href="{{ route('order.index', ['start_date' => $startDate, 'end_date' =>$nowDate]) }}"><i class="fa-regular fa-circle-info me-1" style="width:20px;height:20px;"></i>Chi tiết</a>
                            <div class="d-flex justify-content-center align-items-center px-5 ms-2 mt-3">
                                <a class="fw-bold text-decoration-none text-secondary" style="font-size: 20px">{{ number_format($order_in_week->order_count, 0, ',', ',')}}<span class="ms-2 fw-normal">đơn</span></a>
                            </div>
                            <div class="d-flex justify-content-center align-items-center">
                                <a class="fw-bold text-decoration-none text-danger" style="font-size: 25px">{{ number_format($order_in_week->total_amount_sum, 0, ',', ',')}}<span class="ms-1 fw-normal text-secondary">&#8363;</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- order in year --}}
                <div class="my-2">
                    <h6 class="text-uppercase fw-bold text-secondary text-decoration-none">Doanh thu năm:</h6>
                    <div class="rounded border border-3">
                        <div class="p-3">
                            <select class="form-select" style="width:200px;" name="yearChart" id="yearChart">
                                @for($y = 2023;$y<=date("Y", strtotime($nowDate));$y++)
                                <option value="{{$y}}" {{$y == date("Y", strtotime($nowDate))?'selected':''}}>Năm {{$y}}</option>
                                @endfor
                            </select>
                        </div>
                        {{-- <div class="chart-order-year p-3 pt-0"> --}}
                            <canvas id="orderChart" class="p-3 pt-0"></canvas>
                        {{-- </div> --}}
                    </div>

                </div>
            </div>
            <div class="col-12 col-lg-3 col-md-4">
                {{-- user count --}}
                <div class="mb-3">
                    <h6 class="text-uppercase fw-bold text-secondary text-decoration-none">KHÁCH HÀNG:</h6>
                    <div class="rounded border border-3 div-more p-3">
                        <i class="fa-solid fa-users text-secondary icon-more" style="width:25px;height:25px;"></i>
                        <a class="d-flex align-items-center a-more" href="{{route('user.index')}}"><i class="fa-regular fa-circle-info me-1" style="width:20px;height:20px;"></i>Chi tiết</a>
                        <div class="d-flex justify-content-center align-items-center p-3">
                            <a class="fw-bold text-decoration-none text-darkcyan" style="font-size: 40px">{{ number_format($count_user, 0, ',', ',')}}</a>
                        </div>
                    </div>
                </div>
                {{-- product count --}}
                <div class="mb-3">
                    <h6 class="text-uppercase fw-bold text-secondary text-decoration-none">SẢN PHẨM:</h6>
                    <div class="rounded border border-3 div-more p-3">
                        <i class="fa-solid fa-boxes-packing text-secondary icon-more" style="width:25px;height:25px;"></i>
                        <a class="d-flex align-items-center a-more" href="{{route('product.index')}}"><i class="fa-regular fa-circle-info me-1" style="width:20px;height:20px;"></i>Chi tiết</a>
                        <div class="d-flex justify-content-center align-items-center p-3">
                            <a class="fw-bold text-decoration-none text-darkcyan" style="font-size: 40px">{{ number_format($count_product, 0, ',', ',')}}</a>
                        </div>
                    </div>
                </div>
                {{-- brand count --}}
                <div class="mb-3">
                    <h6 class="text-uppercase fw-bold text-secondary text-decoration-none">THƯƠNG HIỆU:</h6>
                    <div class="rounded border border-3 div-more p-3">
                        <i class="fa-solid fa-list-ul text-secondary icon-more" style="width:25px;height:25px;"></i>
                        <a class="d-flex align-items-center a-more" href="{{route('brand.index')}}"><i class="fa-regular fa-circle-info me-1" style="width:20px;height:20px;"></i>Chi tiết</a>
                        <div class="d-flex justify-content-center align-items-center p-3">
                            <a class="fw-bold text-decoration-none text-darkcyan" style="font-size: 40px">{{ number_format($count_brand, 0, ',', ',')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- style -->
<style>
  .div-more{
    position: relative;
  }
  .a-more{
    position: absolute;
    top: 10px;
    right: 10px;
    text-decoration: none
  }
  .icon-more{
    position: absolute;
    top: 10px;
    left: 10px;
  }
</style>
{{-- script --}}
<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const yearChart = document.getElementById('yearChart');
    const ctx = document.getElementById('orderChart').getContext('2d');
    let lineChart
    document.addEventListener('DOMContentLoaded', function() {
        // Load data for default year
        
        fetchData(yearChart.value);

        
    });
    $(document).on('change', '#yearChart', function(e) {
                e.preventDefault();
                fetchData(this.value);
    });
    
    function fetchData(year) {
            var url = "{{route('getOrderChartData', ':year')}}";
            url = url.replace(':year', year);
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const labels = data.map(item => item.month);
                    const totalRevenue = data.map(item => item.total_revenue);
                    const totalOrder = data.map(item => item.total_orders);

                    if (lineChart) {
                        lineChart.destroy(); // Xóa biểu đồ cũ trước khi vẽ biểu đồ mới
                    }
                    lineChart = new Chart(ctx, {
                    data: {
                        labels: labels,
                        datasets: [
                            {
                                type: 'line',
                                label: 'Doanh thu',
                                data: totalRevenue,
                                backgroundColor: 'rgba(247, 29, 29, 0.5)',
                                borderColor: 'rgba(247, 29, 29, 1)',
                                borderWidth: 1,
                                yAxisID: 'y',
                            },
                            {
                                type: 'bar',
                                label: 'Số đơn hàng',
                                data: totalOrder,
                                backgroundColor: 'rgba(14, 212, 176, 0.5)',
                                borderColor: 'rgba(14, 212, 176, 1)',
                                borderWidth: 1,
                                yAxisID: 'y1',
                            }
                        ],
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                labels: {
                                    usePointStyle: true,
                                },
                                position: 'top'
                            },
                            title: {
                                display: true,
                                text: 'Doanh thu năm',
                                font: {
                                    size: 20,
                                },
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false
                            },
                        },
                        hover: {
                            mode: 'index',
                            intersec: false
                        },
                        scales: {
                            x: {
                                display: true,
                                title: {
                                    display: true,
                                    text: 'Tháng',
                                }
                            },
                            y: {
                                beginAtZero: true,
                                    // type: 'linear',
                                    // display: true,
                                title: {
                                    display: true,
                                    text: 'Đơn vị (vnd)',
                                },
                                position: 'left',
                                ticks: {
                                    color: 'rgba(247, 29, 29, 1)'
                                }
                            },
                            y1: {
                                beginAtZero: true,
                                    // type: 'linear',
                                    // display: true,
                                title: {
                                    display: true,
                                    text: 'Số hóa đơn',
                                },
                                position: 'right',
                                ticks: {
                                    color: 'rgba(14, 212, 176, 1)'
                                },
                                grid: {
                                    drawOnChartArea: false, // only want the grid lines for one axis to show up
                                },
                            },
                        }
                    }
                });
            });
        }
</script>
@include('admin.product.script.script')
@endsection
