@extends('admin.template')
@section('styles')
@section('title', 'Danh sách user')
@endsection
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              User
          </h1>
          <ol class="breadcrumb">
              <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
              <li><a href="#">User</a></li>
              <li class="active">Danh sách</li>
          </ol>
      </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Danh sách user</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="data-tables-list" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>Quyền</th>
                                <th>Trạng thái</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['full_name'] }}</td>
                                    <td>{{ $item['email'] }}</td>
                                    <td>
                                        @if($item['role_id'] == 0)
                                            <span class="label label-success" title="view">{{ config('const.role.admin') }}</span>
                                        @else
                                            <span class="label label-warning">{{ config('const.role.sub_admin') }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item['status'] == 0)
                                            <span class="label label-success">{{ config('const.status_name.active') }}</span>
                                        @elseif($item['status'] == 1)
                                            <span class="label label-danger">{{ config('const.status_name.inactive') }}</span>
                                        @endif
                                    </td>
                                    <td class="btn-act">
                                        <button href="#" onclick="showDialogUpdate('update', '{{ $item->id }}', '{{ $item->full_name }}', '{{ $item->email }}', '{{ $item->role_id }}', '{{ $item->status }}');"
                                                class="btn btn-primary edit-record">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button href="#" onclick="showDialogDelete({{ $item->id }});" class="btn btn-danger btn-delete-user"><i class="fa fa-remove"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            </tfoot>
                        </table>
                        <!-- Modal confirm delete -->
                        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span></button>
                                        <h4 class="modal-title">Xác nhận</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>Bạn có chắc chắn muốn xoá không?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <form method="POST" id="form-delete">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Huỷ</button>
                                            <button class="btn btn-danger">Đồng ý</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal edit user -->
                        <div class="modal fade" id="modal-update-user" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span></button>
                                        <h4 class="modal-title" id="modal-update-title"></h4>
                                    </div>
                                    <div class="modal-footer">
                                        <form method="POST" id="form-update">
                                            {{ csrf_field() }}
                                            {{ method_field('POST') }}
                                            <div class="form-group row">
                                                <!-- Date Time Start -->
                                                <label class="control-label col-md-3 required " for="datetime_start">Họ Tên: </label>
                                                <div class="controls controlsDisplay col-md-7">
                                                    <div>
                                                        <input type="text" name="full_name" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <!-- Date Time Start -->
                                                <label class="control-label col-md-3 required " for="datetime_start">Email: </label>
                                                <div class="controls controlsDisplay col-md-7">
                                                    <div>
                                                        <input type="email" name="email" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <!-- Date Time Start -->
                                                <label class="control-label col-md-3 required" for="datetime_start">Mật khẩu: </label>
                                                <div class="controls controlsDisplay col-md-7">
                                                    <div>
                                                        <input type="password" name="password" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <!-- Date Time Start -->
                                                <label class="control-label col-md-3 required " for="datetime_start">Nhập lại mật khẩu:</label>
                                                <div class="controls controlsDisplay col-md-7">
                                                    <div>
                                                        <input type="password" name="password_confirm" class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="control-label col-md-3">Trạng thái: </label>
                                                <div class="controls controlsDisplay col-md-7">
                                                    <select class="form-control" name="status">
                                                        <option value="0">{{ config('const.status_name.active') }}</option>
                                                        <option value="1">{{ config('const.status_name.inactive') }}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="control-label col-md-3">Quyền: </label>
                                                <div class="controls controlsDisplay col-md-7">
                                                    <select class="form-control" name="role_id">
                                                        <option value="1">{{ config('const.role.sub_admin') }}</option>
                                                        <option value="0">{{ config('const.role.admin') }}</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="controls col-md-10">
                                                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Huỷ</button>
                                                    <input class="btn btn-success pull-right" type="submit" id="btn-submit-update">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
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

    <script>
        function showDialogDelete(id) {
            $('#form-delete').attr('action', '/admin/user/xoa/' + id);
            $('#confirm-delete').modal('toggle');
        }

        function showDialogUpdate(typeModal, id, fullName, email, roleId, status) {
            if (typeModal === 'update') {
                $('#modal-update-title').text('Cập nhật user');
                $('#btn-submit-update').val('Cập nhật');
            } else {
                $('#modal-update-title').text('Thêm user');
                $('#btn-submit-update').val('Thêm');
            }
            $('#form-update').attr('action', '/admin/user/cap-nhat/' + id);
            $('#modal-update-user').modal('toggle');
        }
    </script>
@endsection
