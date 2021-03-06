@extends('layout')
@section('home_content')
    <section id="do_action">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <?php
            $content = Cart::content();
            ?>
            <table class="table table-condensed">
                <thead>
                <tr class="cart_menu">
                    <td class="description">Tên sản phẩm</td>
                    <td class="image">Ảnh</td>
                    <td class="price">Giá</td>
                    <td class="quantity">Số lượng</td>
                    <td class="total">Tổng tiền</td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                @foreach($content as $value)
                <tr>
                    <td class="cart_description">
                        <h4><a href="">{{$value->name}}</a></h4>
                    </td>
                    <td class="">
                        <a href=""><img height="100px" width="100px" src="{{url('public/upload/product/'.$value->options->image)}}" alt=""></a>
                    </td>
                    <td class="cart_price">
                        <p>{{number_format($value->price).' VNĐ'}}</p>
                    </td>
                    <td class="cart_quantity">
                        <div class="cart_quantity_button">
                            <a class="cart_quantity_up" href=""> + </a>
                            <input class="cart_quantity_input" type="text" name="quantity" value="{{$value->qty}}" autocomplete="off" size="2">
                            <a class="cart_quantity_down" href=""> - </a>
                        </div>
                    </td>
                    <td class="cart_total">
                        <p class="cart_total_price">
                            {{number_format($subtotal = $value->price* $value->qty).' VNĐ'}}
                        </p>
                    </td>
                    <td class="cart_delete">
                        <a class="cart_quantity_delete" href="{{url('delete-cart/'.$value->rowId)}}"><i class="fa fa-times"></i></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        </section>
        <section id="do_action">
        <div class="container">
            <div class="heading">
                <h3>What would you like to do next?</h3>
                <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="chose_area">
                        <ul class="user_option">
                            <li>
                                <input type="checkbox">
                                <label>Use Coupon Code</label>
                            </li>
                            <li>
                                <input type="checkbox">
                                <label>Use Gift Voucher</label>
                            </li>
                            <li>
                                <input type="checkbox">
                                <label>Estimate Shipping & Taxes</label>
                            </li>
                        </ul>
                        <ul class="user_info">
                            <li class="single_field">
                                <label>Country:</label>
                                <select>
                                    <option>United States</option>
                                    <option>Bangladesh</option>
                                    <option>UK</option>
                                    <option>India</option>
                                    <option>Pakistan</option>
                                    <option>Ucrane</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>

                            </li>
                            <li class="single_field">
                                <label>Region / State:</label>
                                <select>
                                    <option>Select</option>
                                    <option>Dhaka</option>
                                    <option>London</option>
                                    <option>Dillih</option>
                                    <option>Lahore</option>
                                    <option>Alaska</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>

                            </li>
                            <li class="single_field zip-field">
                                <label>Zip Code:</label>
                                <input type="text">
                            </li>
                        </ul>
                        <a class="btn btn-default update" href="">Get Quotes</a>
                        <a class="btn btn-default check_out" href="">Continue</a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            <li>Tổng <span>{{cart::subtotal(0).' VNĐ'}}</span></li>
                            <li>Thuế <span>{{Cart::tax(0).' VNĐ'}}</span></li>
                            <li>Phí vận chuyển <span>Free</span></li>
                            <li>Thành tiền <span>{{cart::total(0).' VNĐ'}}</span></li>
                        </ul>
                        <?php
                        $customer_id = Session::get('customer_id');
                        if($customer_id != null){
                        ?>
                        <a class="btn btn-default check_out" href="{{url('checkout')}}">Thanh toán</a>
                        <?php
                        }
                        else{
                        ?>
                        <a class="btn btn-default check_out" href="{{url('login-checkout')}}">Thanh toán</a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
@endsection
