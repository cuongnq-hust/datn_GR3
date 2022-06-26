<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\Order;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
use App\Models\Social;
use App\Models\SocialCustomers;
use App\Models\Statistic;
use App\Models\Video;
use App\Models\Visitors;
use App\Rules\Captcha;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Laravel\Socialite\Facades\Socialite;

class Admincontroller extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Auth::id();
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function index()
    {
        return view('admin.custom_auth.login_auth');
    }
    public function show_dashboard(Request $request)
    {
        $this->AuthLogin();
        $user_ip_address = $request->ip();

        $early_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $end_of_last_month = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $early_this_month = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $oneyears = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        $visitor_of_last_month = Visitors::whereBetween('date_visitor', [$early_last_month, $end_of_last_month])->get();
        $visitor_last_month_count = $visitor_of_last_month->count();
        $visitor_of_this_month = Visitors::whereBetween('date_visitor', [$early_this_month, $now])->get();
        $visitor_this_month_count = $visitor_of_this_month->count();
        $visitor_of_year = Visitors::whereBetween('date_visitor', [$oneyears, $now])->get();
        $visitor_year_count = $visitor_of_year->count();

        $visitor_current = Visitors::where('ip_address', $user_ip_address)->get();
        $visitor_count = $visitor_current->count();
        if ($visitor_count < 1) {
            $visitor = new Visitors();
            $visitor->ip_address = $user_ip_address;
            $visitor->date_visitor = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();;
            $visitor->save();
        }

        $visitor = Visitors::all();
        $visitor_total = $visitor->count();

        $product_count = Product::all()->count();
        $post_count = Post::all()->count();
        $order_count  = Order::all()->count();
        $video_count = Video::all()->count();
        $customer_count = Customers::all()->count();
        $product_views = Product::orderBy('product_views', 'DESC')->take(20)->get();
        $post_views = Post::orderBy('post_views', 'DESC')->take(20)->get();

        return view('admin.dashboard')->with(compact(
            'visitor_total',
            'visitor_count',
            'visitor_last_month_count',
            'visitor_this_month_count',
            'visitor_year_count',
            'product_count',
            'post_count',
            'order_count',
            'video_count',
            'customer_count',
            'product_views',
            'post_views',

        ));
    }
    public function logout()
    {
        $this->AuthLogin();
        Session()->put('admin_name', null);
        Session()->put('admin_id', null);
        return Redirect::to('/admin');
    }
    public function login_facebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook()
    {
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider', 'facebook')->where('provider_user_id', $provider->getId())->first();
        if ($account) {
            //login in vao trang quan tri  
            $account_name = Login::where('admin_id', $account->user)->first();
            Session()->put('admin_name', $account_name->admin_name);
            Session()->put('admin_id', $account_name->admin_id);
            return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công123');
        } else {

            $admin_login = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = Login::where('admin_email', $provider->getEmail())->first();

            if (!$orang) {
                $orang = Login::create([
                    'admin_name' => $provider->getName(),
                    'admin_email' => $provider->getEmail(),
                    'admin_password' => '',
                    'admin_phone' => '',
                ]);
            }
            $admin_login->login()->associate($orang);
            $admin_login->save();

            $account_name = Login::where('admin_id', $admin_login->user)->first();
            Session()->put('admin_name', $account_name->admin_name);
            Session()->put('admin_id', $account_name->admin_id);
            return Redirect()->to('/dashboard')->with('message', 'Đăng nhập Admin thành công');
        }
    }
    public function login_google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback_google()
    {
        $users = Socialite::driver('google')->stateless()->user();
        // return $users->id;
        $authUser = $this->findOrCreateUser($users, 'google');
        if ($authUser) {
            $account_name = Login::where('admin_id', $authUser->user)->first();
            Session()->put('admin_name', $account_name->admin_name);
            Session()->put('admin_normal', true);
            Session()->put('admin_id', $account_name->admin_id);
        } elseif ($customer_new) {
            $account_name = Login::where('admin_id', $authUser->user)->first();
            Session()->put('admin_name', $account_name->admin_name);
            Session()->put('admin_normal', true);
            Session()->put('admin_id', $account_name->admin_id);
        }
        return redirect()->to('/dashboard')->with('message', 'Đăng nhập Admin thành công');
    }


    public function findOrCreateUser($users, $provider)
    {
        $authUser = Social::where('provider_user_id', $users->id)->first();
        if ($authUser) {
            return $authUser;
        } else {
            $customer_new = new Social([
                'provider_user_id' => $users->id,
                'provider' => strtoupper($provider)
            ]);

            $orang = Login::where('admin_email', $users->email)->first();

            if (!$orang) {
                $orang = Login::create([
                    'admin_name' => $users->name,
                    'admin_email' => $users->email,
                    'admin_password' => '',
                    'admin_phone' => '',
                    'admin_status' => 1
                ]);
            }
            $customer_new->login()->associate($orang);
            $customer_new->save();
            return $customer_new;
        }
    }
    public function filter_by_day(Request $request)
    {
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $get = Statistic::whereBetween('order_date', [$from_date, $to_date])->orderBy('order_date', 'ASC')->get();
        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }
    public function dashboard_filter(Request $request)
    {
        $data = $request->all();
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();

        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
        $sub365days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        if ($data['dashboard_value'] == '7ngay') {
            $get = Statistic::whereBetween('order_date', [$sub7days, $now])->orderBy('order_date', 'ASC')->get();
        } elseif ($data['dashboard_value'] == 'thangtruoc') {
            $get = Statistic::whereBetween('order_date', [$dau_thangtruoc, $cuoi_thangtruoc])->orderBy('order_date', 'ASC')->get();
        } elseif ($data['dashboard_value'] == 'thangnay') {
            $get = Statistic::whereBetween('order_date', [$dauthangnay, $now])->orderBy('order_date', 'ASC')->get();
        } elseif ($data['dashboard_value'] == '365ngayqua') {
            $get = Statistic::whereBetween('order_date', [$sub365days, $now])->orderBy('order_date', 'ASC')->get();
        }
        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }
    public function days_order(Request $request)
    {
        $data = $request->all();
        $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->toDateString();
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $get = Statistic::whereBetween('order_date', [$sub30days, $now])->orderBy('order_date', 'ASC')->get();

        foreach ($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }
    public function login_customer_google()
    {
        config(['services.google.redirect' => env('GOOGLE_CLIENT_URL')]);
        return Socialite::driver('google')->redirect();
    }

    public function callback_customer_google()
    {
        config(['services.google.redirect' => env('GOOGLE_CLIENT_URL')]);
        $users = Socialite::driver('google')->stateless()->user();
        $authUser = $this->findOrCreateCustomer($users, 'google');
        if ($authUser) {
            $account_name = Customers::where('customer_id', $authUser->user)->first();
            Session()->put('customer_id', $account_name->customer_id);
            Session()->put('customer_picture', $account_name->customer_picture);
            Session()->put('customer_name', $account_name->customer_name);
        } elseif ($customer_new) {
            $account_name = Customers::where('customer_id', $authUser->user)->first();
            Session()->put('customer_id', $account_name->customer_id);
            Session()->put('customer_picture', $account_name->customer_picture);
            Session()->put('customer_name', $account_name->customer_name);
        }
        return redirect('/login-checkout')->with('message', 'Đăng nhập bằng tài khoản gooogle <span style="color:red">' . $account_name->customer_email . '</span> thành công');
    }
    public function findOrCreateCustomer($users, $provider)
    {
        $authUser = SocialCustomers::where('provider_user_id', $users->id)->first();
        if ($authUser) {
            return $authUser;
        } else {
            $customer_new = new SocialCustomers([
                'provider_user_id' => $users->id,
                'provider_user_email' => $users->email,
                'provider' => strtoupper($provider)
            ]);

            $customer = Customers::where('customer_email', $users->email)->first();

            if (!$customer) {
                $customer = Customers::create([
                    'customer_name' => $users->name,
                    'customer_picture' => $users->avatar,
                    'customer_email' => $users->email,
                    'customer_password' => '',
                    'customer_phone' => ''
                ]);
            }
            $customer_new->customers()->associate($customer);
            $customer_new->save();
            return $customer_new;
        }
    }
    public function login_customer_facebook()
    {
        config(['services.facebook.redirect' => env('FACEBOOK_CLIENT_REDIRECT')]);
        return Socialite::driver("facebook")->redirect();
    }
    public function callback_customer_facebook()
    {
        config(['services.facebook.redirect' => env('FACEBOOK_CLIENT_REDIRECT')]);
        $provider = Socialite::driver('facebook')->user();
        dd($provider);
        //     $account = Social::where('provider', 'facebook')->where('provider_user_id', $provider->getId())->first();
        //     if ($account) {
        //         //login in vao trang quan tri  
        //         $account_name = Login::where('admin_id', $account->user)->first();
        //         Session()->put('admin_name', $account_name->admin_name);
        //         Session()->put('login_nomar', true);
        //         Session()->put('admin_id', $account_name->admin_id);
        //         return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công123');
        //     } else {

        //         $admin_login = new Social([
        //             'provider_user_id' => $provider->getId(),
        //             'provider' => 'facebook'
        //         ]);

        //         $orang = Login::where('admin_email', $provider->getEmail())->first();

        //         if (!$orang) {
        //             $orang = Login::create([
        //                 'admin_name' => $provider->getName(),
        //                 'admin_email' => $provider->getEmail(),
        //                 'admin_password' => '',
        //                 'admin_phone' => '',
        //             ]);
        //         }
        //         $admin_login->login()->associate($orang);
        //         $admin_login->save();

        //         $account_name = Login::where('admin_id', $admin_login->user)->first();
        //         Session()->put('admin_name', $account_name->admin_name);
        //         Session()->put('admin_id', $account_name->admin_id);
        //         return Redirect()->to('/dashboard')->with('message', 'Đăng nhập Admin thành công456');
        //     }
    }
}
