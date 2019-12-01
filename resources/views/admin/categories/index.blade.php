@extends('admin.template')
@section('title', 'Danh sách danh mục')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              User
          </h1>
          <ol class="breadcrumb">
              <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
              <li><a href="#">Danh mục</a></li>
              <li class="active">Danh sách</li>
          </ol>
      </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title pull-left">Danh sách danh mục</h3>
                        <a href="#" data-toggle="modal" data-target="#modal-add-user" class="btn btn-primary pull-right">
                            <i class="fa fa-plus"></i>&nbsp;Thêm
                        </a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="data-tables-list" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên danh mục</th>
                                <th>Danh mục cha</th>
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
                                        @if($item['role'] == 0)
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
                                        <button href="#" onclick="showDialogUpdate('{{ $item->id }}', '{{ $item->full_name }}', '{{ $item->email }}', '{{ $item->role }}', '{{ $item->status }}');"
                                                class="btn btn-primary edit-record">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button href="#" onclick="showDialogDelete({{ $item->id }});" class="btn btn-danger btn-delete-user"><i class="fa fa-remove"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
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
                                <form method="POST" id="form-update" class="form-horizontal">
                                    {{ csrf_field() }}
                                    {{ method_field('POST') }}
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span></button>
                                            <h4 class="modal-title">Cập nhật user</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <!-- Date Time Start -->
                                                    <label class="col-sm-3 control-label" for="datetime_start">Họ Tên<span class="lbl-required">*</span>: </label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="full_name" class="form-control" id="form-full_name" maxlength="500">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <!-- Date Time Start -->
                                                    <label class="col-sm-3 control-label" for="datetime_start">Email<span class="lbl-required">*</span>: </label>
                                                    <div class="col-sm-9">
                                                        <input type="email" name="email" class="form-control" id="form-email" maxlength="500">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <!-- Date Time Start -->
                                                    <label class="col-sm-3 control-label" for="datetime_start">Mật khẩu: </label>
                                                    <div class="col-sm-9">
                                                        <input type="password" name="password" class="form-control" id="form-password" maxlength="500">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <!-- Date Time Start -->
                                                    <label class="col-sm-3 control-label " for="datetime_start">Nhập lại mật khẩu:</label>
                                                    <div class="col-sm-9">
                                                        <input type="password" name="password_confirm" class="form-control" id="form-password_confirm" maxlength="500">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Trạng thái: </label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="status" id="form-status">
                                                            <option value="0">{{ config('const.status_name.active') }}</option>
                                                            <option value="1">{{ config('const.status_name.inactive') }}</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Quyền: </label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="role" id="form-role">
                                                            <option value="1">{{ config('const.role.sub_admin') }}</option>
                                                            <option value="0">{{ config('const.role.admin') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.box-footer -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Huỷ</button>
                                            <input class="btn btn-success pull-right" type="submit" value="Cập nhật">
                                            <input style="display:none;" type="text" id="backButton" value="0"/>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Modal edit user -->
                        <div class="modal fade" id="modal-add-user" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form action="{{ route('user.create') }}" method="POST" class="form-horizontal" id="form-add">
                                    {{ csrf_field() }}
                                    {{ method_field('POST') }}
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span></button>
                                            <h4 class="modal-title">Thêm user</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <!-- Date Time Start -->
                                                    <label class="col-sm-3 control-label" for="datetime_start">Họ Tên<span class="lbl-required">*</span>: </label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="full_name" class="form-control" id="add-full_name" maxlength="500">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <!-- Date Time Start -->
                                                    <label class="col-sm-3 control-label" for="datetime_start">Email<span class="lbl-required">*</span>: </label>
                                                    <div class="col-sm-9">
                                                        <input type="email" name="email" class="form-control" id="add-email" maxlength="500">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <!-- Date Time Start -->
                                                    <label class="col-sm-3 control-label" for="datetime_start">Mật khẩu<span class="lbl-required">*</span>: </label>
                                                    <div class="col-sm-9">
                                                        <input type="password" name="password" class="form-control" id="add-password" maxlength="500">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <!-- Date Time Start -->
                                                    <label class="col-sm-3 control-label " for="datetime_start">Nhập lại mật khẩu<span class="lbl-required">*</span>:</label>
                                                    <div class="col-sm-9">
                                                        <input type="password" name="password_confirm" class="form-control" id="add-password_confirm" maxlength="500">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Trạng thái: </label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="status" id="add-status">
                                                            <option value="0">{{ config('const.status_name.active') }}</option>
                                                            <option value="1">{{ config('const.status_name.inactive') }}</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Quyền: </label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="role" id="add-role">
                                                            <option value="1">{{ config('const.role.sub_admin') }}</option>
                                                            <option value="0">{{ config('const.role.admin') }}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.box-footer -->
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Huỷ</button>
                                            <input class="btn btn-success pull-right" type="submit" value="Thêm">
                                        </div>
                                    </div>
                                </form>
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
    <script src="{{asset('assets/adminlte/common-js/validation/user.js')}}"></script>

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

        function showDialogUpdate(id, fullName, email, role, status) {
            resetModal();
            $('#form-full_name').val(fullName);
            $('#form-email').val(email);
            $('#form-role').val(role);
            $('#form-status').val(status);
            $('#form-update').attr('action', '/admin/user/cap-nhat/' + id);

            $('#modal-update-user').modal('toggle');
        }

        function resetModal() {
            $('#form-full_name').val('');
            $('#form-email').val('');
            $('#form-role').val('');
            $('#form-status').val('');
            $('#form-update').attr('action', '');
        }
    </script>
@endsection
