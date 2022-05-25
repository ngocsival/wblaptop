@extends('admin.admin_layout')
@section('admin_content')
<div class="row">
    <p style="color: red; text-align: center;font-size: 24px">Thống kê đơn hàng doanh số</p>
    <form autocomplete="off">
        @csrf
        <div class="col-md-2">
            <p>Từ ngày:<input type="text" id="datepicker" class="form-control"></p>
            <input style="margin-top: 10px" type="button" id="btn-dashboard-filter" class="btn btn-primary btn-sm" value="Lọc kết quả">
        </div>
        <div class="col-md-2">
            <p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>
        </div>
        <div class="col-md-2">
            <p>Lọc theo:
                <select id="dashboard-filter" class="dashboard-filter form-control">
                    <option value="">Chọn</option>
                    <option value="7ngay">7 ngày qua</option>
                    <option value="thangtruoc">tháng trước</option>
                    <option value="thangnay">tháng này</option>
                    <option value="365ngayqua">365 ngày qua</option>
                </select>
            </p>
        </div>
    </form>
    <div class="col-md-12">
        <div id="chart" style="height: 250px"></div>
    </div>
</div>
<div class="row">
    <p style="color: red; text-align: center;font-size: 24px">Thống kê truy cập</p>
    <table class="table table-bordered table-dark" style="background-color: black">
        <thead>
        <tr>
            <th scope="col">Đang online</th>
            <th scope="col">Tổng tháng trước</th>
            <th scope="col">Tổng tháng này</th>
            <th scope="col">Tổng một năm</th>
            <th scope="col">Tổng truy cập</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">{{$visitor_count}}</th>
            <td>362</td>
            <td>124</td>
            <td>986</td>
            <td>24201</td>
        </tr>
        </tbody>
    </table>
</div>
<div class="row">
    <div  class="col-md-4 col-xs-12">
        <p style="text-align:center;color: red;font-size: 20px">Thống kê tổng hợp</p>
        <div id="donut"></div>
    </div>
    <div  class="col-md-4 col-xs-12">
        <p style="text-align:center;color: red;font-size: 20px">Thống kê lượt xem sản phẩm</p>
        @foreach($product_views as $value_viewproduct)
            <p style="color: #2a2727">Lượt xem của sản phẩm <a style="color: black" href="{{url('/chi-tiet-san-pham/'.$value_viewproduct->product_id)}}">{{$value_viewproduct->product_name}}</a>: {{$value_viewproduct->product_view}} lượt xem</p>
        @endforeach
    </div>
</div>
@endsection
