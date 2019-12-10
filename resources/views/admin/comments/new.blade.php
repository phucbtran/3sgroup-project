@extends('admin.template')
@section('title', 'Bình luận - Tin tức')
@section('styles')
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Bình luận - Tin tức
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                <li><a href="#">Bình luận</a></li>
                <li class="active">Tin tức</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title pull-left">Danh sách bình luận</h3>
                            <a href="#" data-toggle="modal" data-target="#confirm-delete-all"
                               class="btn btn-danger pull-right"
                               id="btn-delete-all">
                                <i class="fa fa-trash-o"></i>&nbsp;Xóa
                            </a>
                            <div class="modal fade" id="confirm-delete-all" role="dialog" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h3 class="modal-title">Xác nhận</h3>
                                        </div>
                                        <div class="modal-body">
                                            <p>Bạn có chắc chắn muốn xoá không?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('comments.remove_all') }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <div id="group-id-del"></div>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
                                            <button class="btn btn-danger">Đồng ý</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="data-tables-list" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Thời gian</th>
                                    <th>Họ tên</th>
                                    <th>Email</th>
                                    <th>SĐT</th>
                                    <th>Bài viết</th>
                                    <th>Nội dung</th>
                                    <th>Trạng thái</th>
                                    <th>Xoá</th>
                                </tr>
                                </thead>
                                <tbody id="detail-data-table">
                                @foreach($comments as $comment)
                                    <tr>
                                        <td>{{ $comment->id }}</td>
                                        <td>{{ $comment->created_at->format('Y/m/d H:i:s') }}</td>
                                        <td>{{ $comment->full_name }}</td>
                                        <td>{{ $comment->email }}</td>
                                        <td>{{ $comment->phone }}</td>
                                        <td>{{ isset($comment->news) ? $comment->news->title_name : '' }}</td>
                                        <td>{{ $comment->content }}</td>
                                        <td id="row-status-{{ $comment->id }}">
                                            @if($comment->status == 0)
                                                <a href="javascript:changeStatus('{{ $comment->id }}', '1');" class="label label-success">{{ config('const.status_name.active') }}</a>
                                            @elseif($comment->status == 1)
                                                <a href="javascript:changeStatus('{{ $comment->id }}', '0');" class="label label-danger">{{ config('const.status_name.inactive') }}</a>
                                            @endif
                                        </td>
                                        <td>
                                            <button href="#" data-toggle="modal" data-target="#confirmDelete{{ $comment->id }}" class="btn btn-danger btn-xs btn-delete-user"><i class="fa fa-remove"></i></button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="confirmDelete{{ $comment->id }}" role="dialog" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h3 class="modal-title">Xác nhận</h3>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Bạn có chắc chắn muốn xoá không?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{ route('comments.remove', $comment->id) }}" method="POST">
                                                                {{ csrf_field() }}
                                                                {{ method_field('DELETE') }}
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
                                                                <button class="btn btn-danger">Đồng ý</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('scripts')
    <script>
        $(function () {
            var table = $('#data-tables-list').DataTable({
                'paging'      : true,
                'lengthChange': true,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false,
                'columnDefs': [
                    {
                        'targets': 0,
                        'checkboxes': true
                    }
                ],
                'order': [[1, 'asc']]
            });

            $('#btn-delete-all').click(function () {
                var rows_selected = table.column(0).checkboxes.selected();

                // Iterate over all selected checkboxes
                $('#group-id-del').html('');
                $.each(rows_selected, function(index, rowId){
                    $('#group-id-del').append('<input type="hidden" name="id[]" value="'+ rowId +'">');
                });
            });
        });

        function changeStatus(id, status) {
            var url = '/admin/binh-luan/cap-nhat/' + id;
            var token = '{{csrf_token()}}';
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    'status': status,
                    '_method': 'POST',
                    _token: token,
                },
                success: function (msg) {
                    var html = '';
                    if (msg.msg === 'success') {
                        if (status === '0') {
                            html = '<a href="javascript:changeStatus('+ id +', \'1\');" class="label label-success">{{ config("const.status_name.active") }}</a>';
                        } else {
                            html = '<a href="javascript:changeStatus('+ id +', \'0\');" class="label label-danger">{{ config("const.status_name.inactive") }}</a>';
                        }
                        $('#row-status-' + id).html(html);
                    }
                }
            });
        }
    </script>
@endsection
