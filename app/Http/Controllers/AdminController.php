<?php

namespace App\Http\Controllers;

use App\Article;
use App\Block;
use App\Label;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
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
        $articleNum = Article::where('isDelete','0')->count();
        $privacyArticleNum = Article::where('isDelete','2')->count();
        $boardNum = Block::where('isDelete','0')->count();
        $labelNum = Label::where('isDelete','0')->count();

        // 本周数据
        $data = [];
        $this_week = [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()];
        $data['customer_this_week'] =  Article::whereBetween('created_at', $this_week)->get();


        return view('admin.index')->with([
            'articleNum' => $articleNum,
            'privacyArticleNum' => $privacyArticleNum,
            'boardNum' => $boardNum,
            'labelNum' => $labelNum
        ]);
    }

    public function board(){
        $boards = Block::where('isDelete','0')->get()->each(function ($item){
            $item['articles'] = Article::where('block_id',$item['id'])->count();
        })->paginate(10);
        return view('admin.board')->with('boards',$boards);
    }

    public function addBoard(Request $request){
        $boardName = $request->boardName;
        $board = new Block();
        $board->block = $boardName;
        $board->save();
        return response()->json(['message' => '保存成功'], Response::HTTP_CREATED);
    }

    public function modifyBoard(Request $request){
        $boardName = $request->boardName;
        $boardId = $request->boardId;

        Block::where('id',$boardId)->update([
            'block' => $boardName
        ]);

        return response()->json(['message' => '修改成功'], Response::HTTP_CREATED);
    }

    public function deleteBoard(Request $request){
        $boardId = $request->id;

        Block::where('id',$boardId)->update([
            'isDelete' => '1'
        ]);

        return response()->json(['message' => '删除成功'], Response::HTTP_CREATED);
    }

    //TODO:获取某版块的文章
    public function getBoardArticles(Request $request){
        $boardId = $request->boardId;

    }

    public function label(){
        $labels = Label::where('isDelete','0')->paginate(20);
        return view('admin.label')->with('labels',$labels);
    }

    public function addLabel(Request $request){
        $labelName = $request->labelName;
        $label = new Label();
        $label->label = $labelName;
        $label->save();
        return response()->json(['message' => '保存成功'], Response::HTTP_CREATED);
    }

    public function modifyLabel(Request $request){
        $labelName = $request->labelName;
        $labelId = $request->labelId;

        Label::where('id',$labelId)->update([
            'label' => $labelName
        ]);

        return response()->json(['message' => '修改成功'], Response::HTTP_CREATED);
    }

    public function deleteLabel(Request $request){
        $id = $request->id;

        Label::where('id',$id)->update([
            'isDelete' => '1'
        ]);

        return response()->json(['message' => '删除成功'], Response::HTTP_CREATED);
    }

}
