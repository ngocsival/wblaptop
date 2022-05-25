<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Statistic;
use App\Models\Visitors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
session_start();

class AdminController extends Controller
{
    public function Authlogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return redirect('dashboard');
        }
        else{
            return redirect('admin')->send();
        }
    }
    public function index(){
        return view('admin.admin_login');
    }
    public function show_dashboard(Request $request){
        $this->Authlogin();
        $user_ip_address = $request->ip();
        $visitors_current = Visitors::where('ip_address',$user_ip_address)->get();
        $visitor_count = $visitors_current->count();
        if($visitor_count<1){
            $visitors = new Visitors();
            $visitors->ip_address = $user_ip_address;
            $visitors->date_visitor= Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
            $visitors->save();
        }
        $product_view['product_views'] = DB::table('tbl_product')->orderBy('product_view','DESC')->get();
        $product_count = Product::all()->count();
        $customer_count = Customer::all()->count();
        $order_count =Order::all()->count();


        return view('admin.dashboard',$product_view)->with(compact('visitor_count','product_count','customer_count','order_count'));
    }
    public function dashboard(Request $request){
        $username = $request->admin_email;
        $password = md5($request->admin_password);
        $result = DB::table('tbl_admin')->where('admin_email',$username)->where('admin_password',$password)->first();
        if($result) {
            Session::put('admin_name',$result->admin_name);
            Session::put('admin_id',$result->admin_id);
            return redirect('dashboard');
        }
        else{
            Session::put('message','Tài khoản hoặc mật khẩu sai!');
            return redirect('admin');
        }
    }
    public function log_out(){
        $this->Authlogin();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return view('admin.admin_login');
    }
    public function filter_by_date(Request $request){
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $get = Statistic::whereBetween('order_date',[$from_date,$to_date])->orderBy('order_date','ASC')->get();
        foreach ($get as $key =>$val){
            $chart_data[] = array(
                'period'=>$val->order_date,
                'order'=>$val->total_order,
                'sales'=>$val->sales,
                'profit'=>$val->profit,
                'quantity'=>$val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }
    public function dashboard_filter(Request $request){
//        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y H:i:s');
        //toDateString hàm giúp đúng định dạng ngày giống csdl
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dauthang_truoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoithang_truoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        if($request->dashboard_value=='7ngay'){
            $get = Statistic::whereBetween('order_date',[$sub7days,$now])->orderBy('order_date','ASC')->get();
        }elseif ($request->dashboard_value == 'thangtruoc'){
            $get = Statistic::whereBetween('order_date',[$dauthang_truoc,$cuoithang_truoc])->orderBy('order_date','ASC')->get();
        }elseif ($request->dashboard_value == 'thangnay'){
            $get = Statistic::whereBetween('order_date',[$dauthangnay,$now])->orderBy('order_date','ASC')->get();
        }else{
            $get = Statistic::whereBetween('order_date',[$sub365days,$now])->orderBy('order_date','ASC')->get();
        }
        foreach ($get as $key =>$val){
            $chart_data[] = array(
                'period'=>$val->order_date,
                'order'=>$val->total_order,
                'sales'=>$val->sales,
                'profit'=>$val->profit,
                'quantity'=>$val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }
    public function days_order(Request $request){
        $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(30)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = Statistic::whereBetween('order_date',[$sub30days,$now])->orderBy('order_date','ASC')->get();

        foreach ($get as $key =>$val){
            $chart_data[] = array(
                'period'=>$val->order_date,
                'order'=>$val->total_order,
                'sales'=>$val->sales,
                'profit'=>$val->profit,
                'quantity'=>$val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }
}
