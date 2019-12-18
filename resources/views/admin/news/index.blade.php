@extends('admin.template')
@section('styles')
@section('title', 'Danh sách tin tức')
@endsection
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              Tin tức
          </h1>
          <ol class="breadcrumb">
              <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
              <li><a href="#">Tin tức</a></li>
              <li class="active">Danh sách</li>
          </ol>
      </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Danh sách tin</h3>
                        <a href="{{ route('news.store') }}" class="btn btn-primary pull-right">
                            <i class="fa fa-plus"></i>&nbsp;Thêm
                        </a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="data-tables-list" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tiêu đề</th>
                                <th>Hình ảnh</th>
                                <th>Trạng thái</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($news as $item)
                                <tr>
                                    <td>{{ $item['id'] }}</td>
                                    <td>{{ $item['title_name'] }}</td>
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
                                    <a href="/admin/tin-tuc/cap-nhat/{{ $item['id'] }}?page={{$curentPage}}" class="btn btn-primary edit-record">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <button href="#" onclick="showDialogDelete({{ $item->id }});" class="btn btn-danger btn-delete-user"><i class="fa fa-remove"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                            <div  style="float:right" class="dataTables_paginate paging_simple_numbers" id="data-tables-list_paginate">
                                <ul class="pagination">
                                    <li class="paginate_button previous @if($curentPage == 1) disabled @endif" id="data-tables-list_previous"><a href="@if($curentPage == 1)javascript:void(0)@else{{$prePage}}@endif" aria-controls="data-tables-list" data-dt-idx="0" tabindex="0">Previous</a></li>
                                    @for($i=1; $i<=$totalPage; $i++)
                                <li class="paginate_button @if($curentPage == $i) active @endif"><a href="/admin/tin-tuc?page={{$i}}" aria-controls="data-tables-list" data-dt-idx="1" tabindex="0">{{ $i }}</a></li>
                                    @endfor
                                <li class="paginate_button next @if($curentPage == $totalPage) disabled @endif" id="data-tables-list_next"><a href="@if($curentPage == $totalPage)javascript:void(0)@else{{$nextPage}}@endif" aria-controls="data-tables-list" data-dt-idx="4" tabindex="0">Next</a></li>
                                </ul>
                            </div>
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
                'paging'      : false,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : false,
                'info'        : false,
                'autoWidth'   : false,
                'orderable'   :false
            })
        })
    </script>
    <script>
        function showDialogDelete(id) {
            $('#form-delete').attr('action', '/admin/tin-tuc/xoa/' + id);
            $('#confirm-delete').modal('toggle');
        }
    </script>
@endsection
