<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{


    public function __construct()
    {
        $this->middleware('checkLogin', [
            'except' => ['getLoginView', 'login']
        ]);
    }

    /**
     * 获取登录页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLoginView(){
//        $user_brief = collect([
//            ['admin','lj_nobug@foxmail.com','199905081234lj_:'],
//        ]);
//
//        $result = $user_brief->mapSpread(function($name,$email,$pwd){
//            return [
//                'name' => $name,
//                'email' =>$email,
//                'password' => bcrypt($pwd)
//            ];
//        })->mapInto(User::class)->each(function($user){
//            $user->save();
//        });
        return view('admin.login');
    }

    public function login(Request $request){
        $email = $request->email;
        $password = $request->password;

        //获取用户信息
        $user = User::where('email',$email)->first();
        //数据库中取的密码
        $pass = $user->password;

        if (Hash::check($password, $pass)) {
            Auth::login($user);
            return redirect('/admin/index');
        }else{
            return redirect('/admin/login')
                ->with('message','密码错误')
                ->withInput();
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/admin/login');
    }

    public function index(){

        return view('admin.index');
    }
}
