<?php

namespace App\Http\Controllers;

use App\Article;
use App\Article_label;
use App\Block;
use App\Label;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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

    public function article(){
        $articles = Article::where('isDelete','!=','1')->with('block')->paginate(10);
        return view('admin.article')->with('articles',$articles);
    }

    public function getAllLabels(){
        $labels = Label::where('isDelete','0')->get();
        $arr = [];
        $i = 0;

        foreach($labels as $item){
            $arr[$i]['label'] = $item['label'];
            $arr[$i]['value'] = $item['id'];
            $i = $i + 1;
        }
        return $arr;
    }

    public function getArticleLabels(Request $request){
        $id = $request->id;
        $arr = [];
        $i = 0;
        $labels = Article_label::where('article_id',$id)->with('labels')->get();
        foreach ($labels as $item){
            $arr[$i] = $item['labels'][0]['id'];
            $i = $i +1;
        }
        return $arr;
    }

    /**
     * 新增文章页面
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getNewArticle(){
        $boards = Block::where('isDelete','0')->get();
        return view('admin.newArticle')->with([
            'boards' => $boards
        ]);
    }

    //上传图片
    public function uploadPicture(Request $request){
        $type = $request->file('file')->getMimeType();
        if($type == 'image/jpeg' || $type == 'image/png'){
            $path = $request->file('file')->store('public/img');
            $temp=substr(Storage::url($path),1);
            $filename = explode('/', Storage::url($path));
            $address = "/storage/img/".$filename[3];
            return $address;
        }else{
            return "文件类型错误";
        }
    }

    public function addArticle(Request $request){

        $title = $request->title;
        $type = $request->type;
        $content = $request->newcontent;
        $picture = $request->picture;
        $board_id = $request->board_id;

        //标签
        $label = explode(',', $request->label);
        $isDelete = $request->isDelete;

        $article = new Article();
        $article->author = Auth::user()['name'];
        $article->title = $title;
        $article->type = $type;
        $article->content = $content;
        $article->picture = $picture;
        $article->block_id = $board_id;
        $article->isDelete = $isDelete;

        $article->save();
        $id = $article->id;

        if(count($label)){
            for($i = 0;$i < count($label); $i++){
                $newLabel = new Article_label();
                $newLabel->article_id = $id;
                $newLabel->label_id = $label[$i];
                $newLabel->save();
            }
        }

        return response()->json(['message' => '保存成功'], Response::HTTP_CREATED);

    }

    public function getModifyArticle(Request $request){
        $id = $request->id;
        $article = Article::where('id',$id)->get();
        $boards = Block::where('isDelete','0')->get();
        return view('admin.modifyArticle')->with([
            'article'=> $article[0],
            'boards' => $boards
        ]);
    }

    public function modifyArticle(Request $request){
        $id = $request->id;
        $title = $request->title;
        $type = $request->type;
        $content = $request->newcontent;
        $board_id = $request->board_id;
        Log::info($id);

        //标签
        $label = explode(',', $request->label);
        $isDelete = $request->isDelete;

        if($request->isUpload == 'no'){
            $article = Article::where('id',$id)->update([
                'title' => $title,
                'type' => $type,
                'content' => $content,
                'block_id' => $board_id,
                'isDelete' => $isDelete
            ]);
        }else{
            $article = Article::where('id',$id)->update([
                'title' => $title,
                'type' => $type,
                'content' => $content,
                'block_id' => $board_id,
                'isDelete' => $isDelete,
                'picture' => $request->picture
            ]);
        }

        if(count($label) == 0){
            Article_label::where('article_id',$id)->delete();
            return response()->json(['message' => '保存成功'], Response::HTTP_CREATED);
        }else{
            //获取现在有的标签id
            $now = [];
            $i = 0;
            $nowLabels = Article_label::where('article_id',$id)->with('labels')->get();
            foreach ($nowLabels as $item){
                $now[$i] = $item['labels'][0]['id'];
                $i = $i +1;
            }

            //前者有后者没有
            $cha = array_diff($now,$label);
            foreach($cha as $item){
                Article_label::where('article_id',$id)->where('label_id',$item)->delete();
            }

            $cha2 = array_diff($label,$now);

            foreach ($cha2 as $item) {
                if($item != '') {
                    $article_label = new Article_label();
                    $article_label->article_id = $id;
                    $article_label->label_id = $item;
                    $article_label->save();
                }
            }

            return response()->json(['message' => '保存成功'], Response::HTTP_CREATED);
        }


    }

    public function deleteArticle(Request $request){
        $id = $request->id;
        Article::where('id',$id)->update([
           'isDelete' => '1'
        ]);
        return response()->json(['message' => '删除成功'], Response::HTTP_CREATED);
    }

}
