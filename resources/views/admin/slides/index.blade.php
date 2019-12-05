@extends('admin.template')
@section('styles')
@section('title', 'Danh sách slide')
@endsection
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              Slide
          </h1>
          <ol class="breadcrumb">
              <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
              <li><a href="#">Slide</a></li>
              <li class="active">Danh sách</li>
          </ol>
      </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Danh sách slide</h3>
                        <a href="#" data-toggle="modal" data-target="#modal-add-slide" class="btn btn-primary pull-right">
                            <i class="fa fa-plus"></i>&nbsp;Thêm
                        </a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="data-tables-list" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Thứ tự hiển thị</th>
                                <th>Tiêu đề</th>
                                <th>Hình ảnh</th>
                                <th>Trạng thái</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($slides as $item)
                                <tr>
                                    <td>{{ $item['sort_num'] }}</td>
                                    <td>{{ $item['alt_description'] }}</td>
                                    <td>
                                        @if(!empty($item['img_dir_path']))
                                            <img src="{{ $item['img_dir_path'] }}" width="130" class="img-responsive center-block" />
                                        @else
                                            <img src="/assets/img/no-image.png" width="130" class="img-responsive center-block" />
                                        @endif
                                    </td>
                                    <td>
                                        @if($item['status'] == 1)
                                            <span class="label label-success">{{ config('const.status_name.active') }}</span>
                                        @elseif($item['status'] == 0)
                                            <span class="label label-danger">{{ config('const.status_name.inactive') }}</span>
                                        @endif
                                    </td>
                                    <td class="btn-act">
                                        <button href="#" data-toggle="modal" data-target="#modal-update-slide-{{ $item['id'] }}"
                                                class="btn btn-primary edit-record">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button href="#" onclick="showDialogDelete({{ $item->id }});" class="btn btn-danger btn-delete-user"><i class="fa fa-remove"></i></button>
                                    </td>
                                </tr>
                                <!-- Modal add or update slide -->
                                <div class="modal fade" id="modal-update-slide-{{ $item['id'] }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <form action="/admin/slides/cap-nhat/{{ $item['id'] }}" method="POST" class="form-horizontal" id="form-add" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            {{ method_field('POST') }}
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span></button>
                                                    <h4 class="modal-title">Thêm slide</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="box-body">
                                                        <div class="form-group row">
                                                            <!-- Date Time Start -->
                                                            <label class="col-sm-3 control-label" for="datetime_start">Tiêu đề <span class="lbl-required">*</span> </label>
                                                            <div class="col-sm-9">
                                                            <input type="text" value="{{ $item['alt_description'] }}" name="slide[alt_description]" class="form-control" id="form-alt_description" maxlength="500">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <!-- Date Time Start -->
                                                            <label class="col-sm-3 control-label" for="datetime_start">Cập nhật ảnh </label>
                                                            <div class="col-sm-9">
                                                                <input type="file" name="image" class="form-control" id="form-img_dir_path" maxlength="500">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <!-- Date Time Start -->
                                                            <label class="col-sm-3 control-label" for="datetime_start">Hình ảnh </label>
                                                            <div class="col-sm-9">
                                                            @if(!empty($item['img_dir_path']))
                                                                <img src="{{ $item['img_dir_path'] }}" height="100" class="img-responsive center-block" />
                                                            @else
                                                                <img src="/assets/img/no-image.png" height="100" class="img-responsive center-block" />
                                                            @endif                                                            
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="form-group row">
                                                            <label class="col-sm-3 control-label">Trạng thái </label>
                                                            <div class="col-sm-3">
                                                                <select class="form-control" name="slide[status]" id="form-status">
                                                                    <option value="1" @if($item['status == 1']) selected @endif>{{ config('const.status_name.active') }}</option>
                                                                    <option value="0" @if($item['status == 0']) selected @endif>{{ config('const.status_name.inactive') }}</option>
                                                                </select>
                                                            </div>
                                                            <label class="col-sm-3 control-label">Vị trí </label>
                                                            <div class="col-sm-3">
                                                            <input value="{{ $item['sort_num'] }}" type="number" name="slide[sort_num]" class="form-control" id="form-sort_num">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.box-footer -->
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Huỷ</button>
                                                    <input class="btn btn-success pull-right" type="submit" value="Cập nhật">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
                        <!-- Modal add or create slide -->
                        <div class="modal fade" id="modal-add-slide" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <form action="{{ route('slides.create') }}" method="POST" class="form-horizontal" id="form-add" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{ method_field('POST') }}
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span></button>
                                            <h4 class="modal-title">Thêm slide</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="box-body">
                                                <div class="form-group">
                                                    <!-- Date Time Start -->
                                                    <label class="col-sm-3 control-label" for="datetime_start">Tiêu đề <span class="lbl-required">*</span> </label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="slide[alt_description]" class="form-control" id="form-alt_description" maxlength="500">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <!-- Date Time Start -->
                                                    <label class="col-sm-3 control-label" for="datetime_start">Hình ảnh <span class="lbl-required">*</span> </label>
                                                    <div class="col-sm-9">
                                                        <input type="file" name="image" class="form-control" id="form-img_dir_path" maxlength="500">
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Trạng thái </label>
                                                    <div class="col-sm-3">
                                                        <select class="form-control" name="slide[status]" id="form-status">
                                                            <option value="1">{{ config('const.status_name.active') }}</option>
                                                            <option value="0">{{ config('const.status_name.inactive') }}</option>
                                                        </select>
                                                    </div>
                                                    <label class="col-sm-3 control-label">Vị trí </label>
                                                    <div class="col-sm-3">
                                                        <input type="number" name="slide[sort_num]" class="form-control" id="form-sort_num">
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
            $('#form-delete').attr('action', '/admin/slides/xoa/' + id);
            $('#confirm-delete').modal('toggle');
        }
    </script>
@endsection
