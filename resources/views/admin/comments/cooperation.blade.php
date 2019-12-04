@extends('admin.template')
@section('title', 'Liên hệ')
@section('styles')
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Liên hệ
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
                <li><a href="#">Liên hệ</a></li>
                <li class="active">Danh sách</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Danh sách liên hệ</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="data-tables-list" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Thời gian</th>
                                    <th>Họ tên</th>
                                    <th>Email</th>
                                    <th>SĐT</th>
                                    <th>Tiêu đề</th>
                                    <th>Nội dung</th>
                                    <th>Xoá</th>
                                </tr>
                                </thead>
                                <tbody id="detail-data-table">
                                    @foreach($contacts as $contact)
                                        <tr>
                                            <td>{{ $contact->created_at->format('Y/m/d H:i:s') }}</td>
                                            <td>{{ $contact->full_name }}</td>
                                            <td>{{ $contact->email }}</td>
                                            <td>{{ $contact->phone }}</td>
                                            <td>{{ $contact->title }}</td>
                                            <td>{{ $contact->content }}</td>
                                            <td>
                                                <button href="#" data-toggle="modal" data-target="#confirmDelete{{ $contact->id }}" class="btn btn-danger btn-delete-user"><i class="fa fa-remove"></i></button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="confirmDelete{{ $contact->id }}" role="dialog" tabindex="-1">
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
                                                                <form action="{{ route('contact.remove', $contact->id) }}" method="POST">
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
            $('#data-tables-list').DataTable({
                'paging'      : true,
                'lengthChange': true,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
        })
    </script>
@endsection
