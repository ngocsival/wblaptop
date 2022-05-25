@extends('admin.admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm vận chuyển
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        @include('admin.alert')
                        <form>
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputFile">Chọn thành phố</label>
                                <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                                    <option value="">------*Chọn thành phố*------</option>
                                    @foreach($city as $val_city)
                                    <option value="{{$val_city->matp}}">{{$val_city->name_tp}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Chọn quận huyện</label>
                                <select name="province" id="province" class="form-control input-sm m-bot15 choose province">
                                    <option value="">------*Chọn quận huyện*------</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Chọn xã phường thị trấn</label>
                                <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                    <option value="">------*Chọn xã phường thị trấn*------</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Phí vận chuyển</label>
                                <input type="text" name="fee_ship"  class="form-control fee_ship" id="fee_ship" placeholder="Tên thương hiệu">
                            </div>
                            <button type="button" name="add_delivery" class="btn btn-info add_delivery">Thêm phí vận chuyện</button>
                        </form>
                    </div>
                </div>
                <div id="load_delivery">

                </div>
            </section>

        </div>
@endsection

