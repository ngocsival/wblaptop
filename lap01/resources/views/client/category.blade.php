@extends('layout')
@section('home_content')
    <div class="features_items"><!--features_items-->
        @foreach($data_category_name as $value)
            <h2 class="title text-center">{{$value->category_name}}</h2>
        @endforeach
        <div class="row">
            <div class="col-sm-4">
                <lable for="amount">Sắp Xếp Theo</lable>
                <form action="">
                    @csrf
                    <select name="sort" id="sort" class="form-control">
                        <option value="{{Request::url()}}?sort_by=none">--Lọc Theo--</option>
                        <option value="{{Request::url()}}?sort_by=tang_dan">--Giá Tăng Dần--</option>
                        <option value="{{Request::url()}}?sort_by=giam_dan">--Giá Giảm Dần--</option>
                        <option value="{{Request::url()}}?sort_by=kytu_az">Lọc theo từ A->Z</option>
                        <option value="{{Request::url()}}?sort_by=kytu_za">Lọc theo từ Z->A</option>
                    </select>
                </form>
            </div>
        </div>
        @foreach($data_categoryshow as $value)
            <div class="col-sm-4">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <img src="{{url('public/upload/product/'.$value->product_image)}}" alt="" />
                            <h2>{{number_format($value->product_price).' VNĐ'}}</h2>
                            <p>{{$value->product_name}}</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ</a>
                        </div>
                    </div>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="#"><i class="fa fa-plus-square"></i>Thêm vào yêu thích</a></li>
                            <li><a href="#"><i class="fa fa-plus-square"></i>Mua hàng</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

