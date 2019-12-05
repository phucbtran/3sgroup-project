@extends('admin.template')
@section('styles')
<!-- date-range-picker -->
<script src="{{asset('assets/adminlte/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{asset('assets/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- bootstrap datepicker -->
<script src="{{asset('assets/adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- bootstrap color picker -->
<script src="{{asset('assets/adminlte/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
<!-- bootstrap time picker -->
<script src="{{asset('assets/adminlte/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
@endsection
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Tin tức
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- /.box-header -->
      <div class="box box-info">
        <div class="box-body">
            <fieldset>
                <div id="legend">
                    <legend class="">Thêm mới</legend>
                </div>
                <form id="form-record" action="/admin/tin-tuc/them-moi" method="post" enctype="multipart/form-data" class="form-horizontal">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}

                    <div class="form-group row">
                        <!-- Date Time Start -->
                        <label class="control-label col-md-3 required " for="datetime_start">Tên tin tức:</label>
                        <div class="controls controlsDisplay col-md-7">
                            <div>
                                <input type="text" name="news[title_name]" placeholder="" class="form-control">
                            </div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <!-- Date Time Start -->
                        <label class="control-label col-md-3 required " for="datetime_start">Tiêu đề:</label>
                        <div class="controls controlsDisplay col-md-7">
                            <div>
                                <input type="text" name="news[meta_title]" placeholder="" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <!-- Avata -->
                        <label class="control-label col-md-3" for="avata">Hình ảnh</label>
                        <div class="controls col-md-7">
                            <input type="file" id="avata" name="image" placeholder="" class="form-control">
                        </div>
                    </div>    
   
                    <div class="form-group row">
                        <!-- Date Time Start -->
                        <label class="control-label col-md-3" for="datetime_start">Nội dung :</label>
                        <div class="controls controlsDisplay col-md-7">
                        <textarea id="content_ckeditor" name="news[content]" class="form-control" rows="3" placeholder="Enter ..."></textarea></div>
                    </div>

                    <div class="form-group row">
                      <label class="control-label col-md-3">Trạng thái: </label>
                      <div class="controls controlsDisplay col-md-7">
                        <select class="form-control" name="news[status]">                        
                          <option value="1">Active</option>
                          <option value="0">Inactive</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="controls col-md-10">
                          <a style="margin-left:10px;" href="/admin/tin-tuc" class="btn btn-info cancelBtt pull-right">Huỷ bỏ</a>
                          <input class="btn btn-success pull-right" type="submit" name="btn_submit" value="Thêm mới">
                      </div>
                    </div>           
                </form>
            </fieldset>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box-body -->
    </section>
    <!-- /.content -->
  </div>
@endsection
@section('scripts')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script> 
  // CKEDITOR.replace('content_ckeditor');    
  CKEDITOR.replace( 'content_ckeditor', {
  filebrowserBrowseUrl: '{{ asset('ckfinder/ckfinder.html') }}',
  filebrowserImageBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Images') }}',
  filebrowserFlashBrowseUrl: '{{ asset('ckfinder/ckfinder.html?type=Flash') }}',
  filebrowserUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
  filebrowserImageUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
  filebrowserFlashUploadUrl: '{{ asset('ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
} );
</script>

@endsection