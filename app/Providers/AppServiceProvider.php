<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\Post;
use App\Models\Order;
use App\Models\Video;
use App\Models\Customers;
use App\Models\Icons;
use App\Models\Contact;
use App\Models\CatePost;
use App\Models\Slider;

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
        //
        view()->composer('*', function ($view) {
            $min_price = Product::min('product_price');
            $max_price = Product::max('product_price');
            $product_count = Product::all()->count();
            $post_count = Post::all()->count();
            $order_count  = Order::all()->count();
            $video_count = Video::all()->count();
            $customer_count = Customers::all()->count();
            $icons = Icons::where('category', 'icon')->orderBy('id_icons', 'DESC')->get();
            $doitac = Icons::where('category', 'doitac')->orderBy('id_icons', 'DESC')->get();
            $contact_footer = Contact::where('info_id', 2)->get();
            $post_footer = Post::where('cate_post_id', 5)->get();
            $category_post = CatePost::where('cate_post_id', '<>', 5)->orderBy('cate_post_id', 'DESC')->get();
            $slider = Slider::orderBy('slider_id', 'DESC')->where('slider_status', '0')->take(4)->get();
            if (Session()->get('customer_id')) {
                $customer = Customers::where('customer_id', Session()->get('customer_id'))->first();
                $customer_name = $customer->customer_name;
            } else {
                $customer_name = '';
            }
            $view->with(compact(
                'min_price',
                'max_price',
                'product_count',
                'order_count',
                'post_count',
                'customer_count',
                'video_count',
                'icons',
                'doitac',
                'contact_footer',
                'post_footer',
                'category_post',
                'slider',
                'customer_name'
            ));
        });
    }
}
