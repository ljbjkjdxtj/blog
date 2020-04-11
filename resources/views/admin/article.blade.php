@extends('layouts.admin')

@section('content')

    <div class="content">
        <div class="animated fadeIn">
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Article</strong>
                            <button type="button" class="btn btn-primary float-right" onclick="window.location.href='/admin/newArticle'">添加</button>
                        </div>
                        <div class="card-body">
                            @if(count($articles) == 0)
                                <div style="text-align: center">
                                    <h4>没有记录</h4>
                                </div>
                            @endif
                            @if(count($articles) != 0)
                            <table id="table" class="table table-striped table-bordered" style="text-align: center">
                                <thead>
                                <tr>
                                    <th>id</th>
                                    <th>题目</th>
                                    <th>标签名</th>
                                    <th>类型</th>
                                    <th>创建时间</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>


                                @foreach($articles as $article)
                                    <tr>
                                        <td>{{$article['id']}}</td>
                                        <td>{{$article['title']}}</td>
                                        <td>{{$article['block']['block']}}</td>
                                        <td>
                                            @if($article['type'] == '原创')
                                                <span class="badge badge-pill badge-primary">{{$article['type']}}</span>
                                            @endif
                                                @if($article['type'] == '转载')
                                                    <span class="badge badge-pill badge-success">{{$article['type']}}</span>
                                                @endif
                                        </td>
                                        <td>{{$article['created_at']->diffForHumans()}}</td>
                                        <td>
                                            @if($article['isDelete'] == '0')
                                                公开
                                            @endif
                                            @if($article['isDelete'] == '2')
                                                私密
                                            @endif
                                        </td>
                                        <td class="td-actions">
                                            <h4>
                                                <i class="fa fa-pencil" aria-hidden="true" title="修改" onclick="window.location.href='/admin/modifyArticle?id={{$article['id']}}'"></i>&nbsp;&nbsp;

                                                <i id="deleteBtn" class="fa fa-trash" aria-hidden="true" title="删除"  data-toggle="modal" data-target="#deleteModal" data-id="{{$article['id']}}"></i>
                                            </h4>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                                @endif
                            <div class="dataTables_paginate paging_simple_numbers float-right" id="bootstrap-data-table_paginate">
                                <ul class="pagination">
                                    {{$articles->links()}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div><!-- .animated -->
    </div>

    <!--addModal-->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New</h5>

                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="newLabelName" class="col-form-label">Label</label>
                            <input type="text" class="form-control" id="newLabelName">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="add()">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!--modifyModal-->
    <div class="modal fade" id="modifyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modify</h5>

                </div>
                <div class="modal-body">
                    <form>
                        <input type="text" id="modifyId" hidden>
                        <div class="form-group">
                            <label for="modifyLabelName" class="col-form-label">Label</label>
                            <input type="text" class="form-control" id="modifyLabelName">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="modify()">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- deleteModal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center">
                    <input type="text" name="deleteId" id="deleteId" hidden>
                    <h5>确认删除？</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="deleteLabel()">Save</button>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('javascript')
    <script>
        function add() {
            var labelName = $("#newLabelName").val()

            $.ajax({
                url: '/admin/label',
                data: {
                    'labelName':labelName
                },
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method: "POST",
                dataType: "text",
                success: function (data) {
                    window.location.reload();
                },
            })
        }

        $('#modifyModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id')
            var label = button.data('label')
            var modal = $(this)
            modal.find('#modifyId').val(id)
            modal.find('#modifyLabelName').val(label)
        })

        function modify(){
            var id = $("#modifyId").val()
            var label = $("#modifyLabelName").val()
            $.ajax({
                url: '/admin/label',
                data: {
                    'labelId': id,
                    'labelName':label
                },
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method: "PUT",
                dataType: "text",
                success: function (data) {
                    // alert(data)
                    window.location.reload();
                },
            })
        }


        $('#deleteModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-body input').val(id)
        })

        function deleteLabel(){
            var id = $("#deleteId").val()
            $.ajax({
                url: '/admin/article',
                data: {
                    'id': id
                },
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method: "DELETE",
                dataType: "text",
                success: function (data) {
                    // alert(data)
                    window.location.reload();
                },
            })
        }
    </script>
@endsection
