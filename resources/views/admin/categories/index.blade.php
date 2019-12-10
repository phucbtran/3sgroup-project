@extends('admin.template')
@section('title', 'Danh mục')
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              Danh mục
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
                        <a href="#" data-toggle="modal" data-target="#modal-add-category" class="btn btn-primary pull-right">
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
                                <th>Vị trí</th>
                                <th>Trạng thái</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($categories as $item)
                                <tr class="{{ isset($item->parent) ? '' : 'highlight-cat-parent' }}">
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ isset($item->parent) ? $item->parent->name : '-' }}</td>
                                    <td>{{ $item->num_sort }}</td>
                                    <td>
                                        @if($item->status == 0)
                                            <span class="label label-success">{{ config('const.status_name.active') }}</span>
                                        @elseif($item->status == 1)
                                            <span class="label label-danger">{{ config('const.status_name.inactive') }}</span>
                                        @endif
                                    </td>
                                    <td class="btn-act">
                                        <button href="#" onclick="showDialogUpdate('{{ $item->id }}', '{{ $item->name }}', '{{ isset($item->parent) ? $item->parent->id : '' }}', '{{ $item->num_sort }}', '{{ $item->status }}');"
                                                class="btn btn-primary btn-xs edit-record">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button href="#" onclick="showDialogDelete({{ $item->id }});" class="btn btn-danger btn-xs btn-delete-user"><i class="fa fa-remove"></i></button>
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

                        <!-- Modal edit category -->
                        <div class="modal fade" id="modal-update-category" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form method="POST" id="form-update" class="form-horizontal">
                                    {{ csrf_field() }}
                                    {{ method_field('POST') }}
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span></button>
                                            <h4 class="modal-title">Cập nhật danh mục</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <!-- Date Time Start -->
                                                    <label class="col-sm-3 control-label" for="datetime_start">Tên danh mục<span class="lbl-required">*</span>:</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="name" class="form-control" id="form-name" maxlength="500">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <!-- Date Time Start -->
                                                    <label class="col-sm-3 control-label" for="datetime_start">Danh mục cha: </label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="cat_parent_id" id="form-cat_parent_id">
                                                            <option value="">-- Chọn danh mục --</option>
                                                            @foreach ($parentCategories as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <!-- Date Time Start -->
                                                    <label class="col-sm-3 control-label" for="datetime_start">Vị trí<span class="lbl-required">*</span>:</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" name="num_sort" class="form-control" id="form-num_sort" maxlength="10">
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

                        <!-- Modal add category -->
                        <div class="modal fade" id="modal-add-category" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form action="{{ route('categories.store') }}" method="POST" id="form-add-category" class="form-horizontal">
                                    {{ csrf_field() }}
                                    {{ method_field('POST') }}
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span></button>
                                            <h4 class="modal-title">Thêm danh mục</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <!-- Date Time Start -->
                                                    <label class="col-sm-3 control-label" for="datetime_start">Tên danh mục<span class="lbl-required">*</span>:</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="name" class="form-control" id="form-add-name" maxlength="500">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <!-- Date Time Start -->
                                                    <label class="col-sm-3 control-label" for="datetime_start">Danh mục cha: </label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="cat_parent_id" id="form-add-cat_parent_id">
                                                            <option value="">-- Chọn danh mục --</option>
                                                            @foreach ($parentCategories as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <!-- Date Time Start -->
                                                    <label class="col-sm-3 control-label" for="datetime_start">Vị trí<span class="lbl-required">*</span>:</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" name="num_sort" class="form-control" id="form-add-num_sort" maxlength="10">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Trạng thái: </label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="status" id="form-add-status">
                                                            <option value="0">{{ config('const.status_name.active') }}</option>
                                                            <option value="1">{{ config('const.status_name.inactive') }}</option>
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
    <script src="{{asset('assets/adminlte/common-js/validation/category.js')}}"></script>

    <script>
        $(function () {
            $('#data-tables-list').DataTable({
                'paging'      : true,
                'lengthChange': true,
                'searching'   : false,
                'ordering'    : false,
                'info'        : true,
                'autoWidth'   : false,
            });
        })
    </script>

    <script>
        function showDialogDelete(id) {
            $('#form-delete').attr('action', '/admin/danh-muc/xoa/' + id);
            $('#confirm-delete').modal('toggle');
        }

        function showDialogUpdate(id, name, parentId, numSort, status) {
            resetModal();
            $('#form-name').val(name);
            $('#form-cat_parent_id').val(parentId);
            $('#form-num_sort').val(numSort);
            $('#form-status').val(status);
            $('#form-update').attr('action', '/admin/danh-muc/cap-nhat/' + id);

            $('#modal-update-category').modal('toggle');
        }

        function resetModal() {
            $('#form-name').val('');
            $('#form-cat_parent_id').val('');
            $('#form-num_sort').val();
            $('#form-status').val('');
            $('#form-update').attr('action', '');
            $('#modal-update-category').find('em.invalid').remove();
        }
    </script>
@endsection
