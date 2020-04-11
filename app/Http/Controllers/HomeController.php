<?php

namespace App\Http\Controllers;

use App\Article;
use App\Article_label;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $articles = Article::where('isDelete','0')->simplePaginate(6);
        return view('index')->with('articles',$articles);
    }

    public function archives(){
        return view('archives');
    }

    public function detail(Request $request){
        $article = Article::where('id',$request->id)->get();
        $labels = Article_label::where('article_id',$request->id)->with('labels')->get();

        //如果文章不存在
        if(count($article) == 0 || $article[0]['isDelete'] == '1'){
            abort(404);
            return;
        }
        //如果未登录且访问私密文章
        if(!Auth::check() && $article[0]['isDelete'] == '2'){
            abort(404);
            return;
        }
        return view('detail')->with([
            'article' => $article[0],
            'labels' => $labels
        ]);
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
