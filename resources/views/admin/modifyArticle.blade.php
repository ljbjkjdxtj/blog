<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="/editor/css/editormd.css" />
    <!--select多选-->
    <link rel="stylesheet" href="/multipleSelect/mutiple.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body style="background-color: #f1f2f7">
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">修改文章</strong>
                        </div>
                        <div class="card-body">

                                <div class="col-lg-12" style=" z-index:2">

                                    <div>
                                    <div class="form-group row">
                                        <label class="col-sm-1 form-control-label">题目</label>
                                        <div class="col-sm-10">
                                            <input id="title" type="text" value="{{$article['title']}}" placeholder="Title" class="form-control form-control-success">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-1 form-control-label">版块</label>
                                        <div class="col-sm-10">
                                            <div class="form-group">
                                                <select class="form-control" id="board_id" value="{{$article['block_id']}}">
                                                    @foreach($boards as $board)
                                                        @if($article['block_id'] == $board['id'])
                                                        <option value="{{$board['id']}}" selected>{{$board['block']}}</option>
                                                        @endif
                                                        @if($article['block_id'] != $board['id'])
                                                                <option value="{{$board['id']}}">{{$board['block']}}</option>
                                                            @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row" style="z-index:5">
                                        <label class="col-sm-1 form-control-label" for="label">标签</label>
                                        <div id="label" class="mySelect col-sm-10"  style="width: 100%;z-index:5;"></div>

                                    </div>

                                        <div class="form-group row">
                                            <label for="file" class="col-sm-1 form-control-label">封面</label>

                                            <div class="col-sm-4" style="width:240px;height:auto;">
                                                <div class="fileinput-new thumbnail img-raised">
                                                    <img style="width:100%;height:auto;" onclick="upload()" id="preview" src="{{$article['picture']}}" rel="nofollow" alt="...">
                                                </div>
                                                <p id="isUpload" hidden>no</p>
                                            </div>

                                            <input type="file" id="file" onchange="showImg(this)" hidden/>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-1 form-control-label">类型</label>
                                            <div class="col-sm-10">
                                                <div class="form-group">
                                                    <select class="form-control" id="type">
                                                        @if($article['type'] == '原创')
                                                            <option value="原创" selected>原创</option>
                                                            <option value="转载">转载</option>
                                                        @endif
                                                            @if($article['type'] != '原创')
                                                                <option value="原创">原创</option>
                                                                <option value="转载" selected>转载</option>
                                                            @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-1 form-control-label">可见性</label>
                                            <div class="col-sm-10">
                                                <div class="form-group">
                                                    <select class="form-control" id="isDelete">
                                                        @if($article['isDelete'] == '0')
                                                            <option value="0" selected>公开</option>
                                                            <option value="2">私密</option>
                                                        @endif
                                                        @if($article['isDelete'] == '2')
                                                                <option value="0">公开</option>
                                                                <option value="2" selected>私密</option>
                                                            @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div style="margin-top: 20px;">
                                    <div id="test-editormd" class="form-group row" style="z-index:3;">
                                        &nbsp;&nbsp;&nbsp;&nbsp;

                                        <textarea style="display:none;" id="content" >{{$article['content']}}</textarea>

                                    </div>
                                    </div>


                                    <div class="form-group row d-flex justify-content-end">
                                        <div class="">
                                            <button onclick="submit()" class="btn btn-primary">提交</button>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        </div>
                                    </div>
                                </div>


                        </div>
                    </div>
                </div>


            </div>
        </div><!-- .animated -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.js"></script>
    <script src="/editor/editormd.js"></script>
    <script src="/multipleSelect/select.js"></script>
    <script type="text/javascript">
        var testEditor;
        var label_result = [];
        $(function() {
            testEditor = editormd("test-editormd", {
                width   : "100%",
                height  : 640,
                syncScrolling : "single",
                path    : "/editor/lib/",
                theme           : "night",
                editorTheme     : "neo",
                previewTheme    : "night",
            });
        });

        function upload(){
            $('#file').click();
        }

        function showImg(obj) {
            var file=$(obj)[0].files[0];    //获取文件信息
            var imgdata='';
            if(file){
                var reader=new FileReader();  //调用FileReader
                reader.readAsDataURL(file); //将文件读取为 DataURL(base64)
                reader.onload=function(evt){   //读取操作完成时触发。
                    $("#preview").attr('src',evt.target.result)  //将img标签的src绑定为DataURL
                };
                $('#isUpload').text('yes')
            }
        }

        //获取路由参数
        function getUrlParam(name) {
            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
            var r = window.location.search.substr(1).match(reg);  //匹配目标参数
            if (r != null) return unescape(r[2]); return null; //返回参数值
        }

        $(document).ready(function() {

            $.ajax({
                url:'/admin/getArticleLabels',
                dataType:"text",
                data:{
                    'id':getUrlParam('id')
                },
                success:function(data) {
                    var arr = eval("(" + data + ")");
                    var nowChecked = arr;
                    label_result = arr;
                    if(arr.length == 0){
                        nowChecked = [];
                    }

                    $.ajax({
                        url:'/admin/getAllLabels',
                        dataType:"text",
                        success:function(data){
                            var arr = eval("("+data+")");
                            console.log(arr)
                            var mySelect= $("#label").mySelect({
                                mult:true,//true为多选,false为单选
                                option:arr,
                                onChange:function(res){//选择框值变化返回结果
                                    console.log(res)
                                    label_result = res;
                                }
                            });
                            mySelect.setResult(nowChecked);
                        }
                    })
                }
            })

        })
        function submit() {

            var title = $("#title").val()
            var type = $("#type").val()
            var content = $("#content").val()
            var board_id = $("#board_id").val()
            var label = label_result
            var isDelete = $("#isDelete").val()

            if($("#isUpload").text() === 'yes') {
                console.log('yes')
                var myform = new FormData();
                myform.append('file', $("#file")[0].files[0]);

                $.ajax({
                    url: '/admin/uploadImg',
                    data: myform,
                    async: false,
                    contentType: false,
                    processData: false,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    method: "POST",
                    dataType: "text",
                    success: function (data) {
                        var address = data;
                        if (data != "文件类型错误") {
                            $.ajax({
                                url: '/admin/article',
                                data: {
                                    'id':getUrlParam('id'),
                                    'title': title,
                                    'type': type,
                                    'newcontent': content,
                                    'board_id': board_id,
                                    'label': label.toString(),
                                    'isDelete': isDelete,
                                    'picture': address,
                                    'isUpload':'yes'
                                },
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                method: "PUT",
                                dataType: "text",
                                success: function (data) {
                                    window.location.href='/detail?id='+getUrlParam('id');
                                }
                            })
                        } else {
                            alert(data);
                        }
                    },
                });
            }else{
                //文件没上传
                $.ajax({
                    url: '/admin/article',
                    data: {
                        'id':getUrlParam('id'),
                        'title': title,
                        'type': type,
                        'newcontent': content,
                        'board_id': board_id,
                        'label': label.toString(),
                        'isDelete': isDelete,
                        'isUpload':'no'
                    },
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    method: "PUT",
                    dataType: "text",
                    success: function (data) {
                        window.location.href='/detail?id='+getUrlParam('id');
                    }
                })
            }
        }
    </script>

</body>
</html>
