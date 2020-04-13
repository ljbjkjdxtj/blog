<?php

namespace App\Http\Controllers;

use App\Article;
use App\Article_label;
use App\Block;
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
    public function index(Request $request){
        if($request->has('board')){
            $articles = Article::where('block_id',$request->board)->where('isDelete','0')->orderBy('updated_at','desc')->simplePaginate(6);
        }else {
            $articles = Article::where('isDelete', '0')->orderBy('updated_at', 'desc')->simplePaginate(6);
        }
        $boards = Block::all();
        return view('index')->with([
            'articles' => $articles,
            'boards' => $boards
        ]);
    }

    public function archives(){
        $boards = Block::all();
        return view('archives')->with([
            'boards' => $boards
        ]);
    }

    public function detail(Request $request){
        $article = Article::where('id',$request->id)->get();
        $labels = Article_label::where('article_id',$request->id)->with('labels')->get();
        $boards = Block::all();

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
            'labels' => $labels,
            'boards' => $boards
        ]);
    }

    public function gustBook(){
        $boards = Block::all();
        return view('gustbook')->with([
            'boards' => $boards
        ]);
    }

    public function link(){
        $boards = Block::all();
        return view('link')->with([
            'boards' => $boards
        ]);
    }

    public function search(Request $request){
        $title = $request->keyword;
        $boards = Block::all();
        $articles = Article::where('title',$title)
            ->orWhere('title','like','%'.$title.'%')
            ->where('isDelete','0')
            ->get();
        return view('search')->with([
            'boards' => $boards,
            'articles' => $articles,
            'keyword' => $title
        ]);
    }

    public function update(){
        $boards = Block::all();
        return view('update')->with([
            'boards' => $boards
        ]);
    }

}
