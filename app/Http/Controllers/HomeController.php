<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        return view('index');
    }

    public function archives(){
        return view('archives');
    }

    public function detail(){
        return view('detail');
    }

    public function gustBook(){
        return view('gustbook');
    }

    public function link(){
        return view('link');
    }

    public function search(){
        return view('search');
    }

    public function update(){
        return view('update');
    }

}
