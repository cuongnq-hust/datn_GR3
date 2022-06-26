<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;


session_start();

class AuthController extends Controller
{
    //
    public function register_auth()
    {
        return view('admin.custom_auth.register');
    }
    public function register(Request $request)
    {
        $this->validation($request);
        $data = $request->all();
        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_password = md5($data['admin_password']);
        $admin->save();
        return Redirect::to('/register-auth')->with('message', 'Đăng ký thành công');
    }
    public function validation($request)
    {
        return $this->validate($request, [
            'admin_name' => 'required',
            'admin_email' => 'required|email',
            'admin_phone' => 'required',
            'admin_password' => 'required',

        ]);
    }
    public function login_auth(){
        return view('admin.custom_auth.login_auth');
    }
    public function login(Request $request){
        $this->validate($request, [
            'admin_email' => 'required',
            'admin_password' => 'required',
        ]);
        // $data = $request->all();
        if(Auth::attempt(['admin_email' => $request->admin_email,'admin_password' => $request->admin_password])){
            return Redirect('/dashboard');
        }else{
            return Redirect('/login-auth')->with('message', 'Tài Khoản Hoặc Mật Khẩu Sai');
        }
    }
    public function logout_auth(){
        Auth::logout();
        return Redirect('/login-auth')->with('message', 'Đăng Xuất Auth Thành Công');
    }
}
