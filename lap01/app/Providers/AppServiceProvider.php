<?php

namespace App\Providers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*',function ($view){
            $product_count = Product::all()->count();
            $customer_count = Customer::all()->count();
            $order_count =Order::all()->count();
            $view->with('product_count',$product_count)->with('customer_count',$customer_count)->with('order_count',$order_count);
        });
    }
}
