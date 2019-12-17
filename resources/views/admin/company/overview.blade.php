@extends('admin.template')
@section('title', 'Tổng quan về công ty')
@section('styles')
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{asset("assets/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css")}}">
@endsection
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              Tổng quan về công ty
          </h1>
          <ol class="breadcrumb">
              <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
              <li><a href="#">Giới thiệu</a></li>
              <li class="active">Tổng quan về công ty</li>
          </ol>
      </section>

      <!-- Main content -->
      <section class="content">
          <form role="form" action="{{ route('company.overview.update', $company->id) }}" method="post" enctype="multipart/form-data" id="form-update-overview">
              {{ csrf_field() }}
              {{ method_field('POST') }}
              <div class="row">
                  <!-- left column -->
                  <div class="col-md-6">
                      <!-- general form elements -->
                      <div class="box box-primary">
                          <div class="box-header with-border">
                              <h3 class="box-title">Thông tin liên hệ</h3>
                          </div>
                          <!-- /.box-header -->
                          <!-- form start -->
                          <div class="box-body">
                              <div class="form-group">
                                  <label for="email">Email<span class="lbl-required">*</span></label>
                                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email', $company->email) }}" maxlength="500">
                              </div>
                              <div class="form-group">
                                  <label for="phone">Số điện thoại<span class="lbl-required">*</span></label>
                                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Số điện thoại" value="{{ old('phone', $company->phone) }}" maxlength="50">
                              </div>
                              <div class="form-group">
                                  <label for="facebook">Facebook</label>
                                  <input type="text" class="form-control" id="facebook" name="facebook" placeholder="Facebook" value="{{ old('facebook', $company->facebook) }}" maxlength="1024">
                              </div>
                              <div class="form-group">
                                  <label for="address">Địa chỉ<span class="lbl-required">*</span></label>
                                  <input type="text" class="form-control" id="address" name="address" placeholder="Địa chỉ" value="{{ old('address', $company->address) }}" maxlength="500">
                              </div>
                              <div class="form-group">
                                  <label for="map_api">Google map<span class="lbl-required">*</span></label>
                                  <input type="text" class="form-control" id="map_api" name="map_api" placeholder="Google map" value="{{ old('map_api', $company->map_api) }}" maxlength="1024">
                              </div>
                              <div class="form-group">
                                  <label for="logo_dir_path">Logo<span class="lbl-required">*</span></label>
                                  <div class="input-group input-image" name="logo_dir_path">
                                      <input type="text" class="form-control" placeholder='Chọn hình ảnh...' value="{{ old('logo_name', $company->logo_name) }}" name="logo_name">
                                      <span class="input-group-btn">
                                          <button class="btn btn-default btn-choose" type="button">Choose</button>
                                      </span>
                                  </div>
                                  <input type="hidden" name="old_logo_dir_path" value="{{ old('old_logo_dir_path', $company->logo_dir_path) }}">
                                  <img class="img-responsive pad" src="{{ asset($company->logo_dir_path) }}" alt="Logo" >
                              </div>
                          </div>
                          <!-- /.box-body -->
                      </div>
                      <!-- /.box -->
                  </div>
                  <!--/.col (left) -->
                  <!-- right column -->
                  <div class="col-md-6">
                      <!-- Horizontal Form -->
                      <div class="box box-info">
                          <div class="box-header with-border">
                              <h3 class="box-title">Thông tin giới thiệu</h3>
                          </div>
                          <!-- /.box-header -->
                          <!-- form start -->
                          <div class="box-body pad">
                              <div class="form-group">
                                  <label for="head_description">Mô tả 1<span class="lbl-required">*</span></label>
                                  <textarea class="textarea" placeholder="Mô tả 1" name="head_description" id="head_description"
                                            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                      {{ old('head_description', $company->head_description) }}
                                  </textarea>
                              </div>
                              <div class="form-group">
                                  <label for="detail_description">Mô tả 2<span class="lbl-required">*</span></label>
                                  <textarea class="textarea" placeholder="Mô tả 2" name="detail_description" id="detail_description"
                                            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                      {{ old('detail_description', $company->detail_description) }}
                                  </textarea>
                              </div>
                              <div class="form-group">
                                  <label for="logo_dir_path">Hình ảnh<span class="lbl-required">*</span></label>
                                  <div class="input-group input-image" name="img_detail_dir_path">
                                      <input type="text" class="form-control" placeholder='Chọn hình ảnh...' value="{{ old('img_detail_name', $company->img_detail_name) }}"/>
                                      <span class="input-group-btn">
                                          <button class="btn btn-default btn-choose" type="button">Choose</button>
                                      </span>
                                  </div>
                                  <input type="hidden" name="old_logo_dir_path" value="{{ old('old_img_detail_dir_path', $company->img_detail_dir_path) }}">
                                  <img class="img-responsive pad" src="{{ asset($company->img_detail_dir_path) }}" alt="Logo" >
                              </div>
                          </div>
                          <!-- /.box-body -->
                          <div class="box-footer">
                              <button type="submit" class="btn btn-primary pull-right">Cập nhật</button>
                          </div>
                          <!-- /.box-footer -->
                      </div>
                      <!-- /.box -->
                  </div>
                  <!--/.col (right) -->
              </div>
              </form>
          <!-- /.box-body -->
      </section>
    <!-- /.content -->
  </div>
@endsection
@section('scripts')
    <!-- CK Editor -->
    <script src="{{asset("assets/adminlte/bower_components/ckeditor/ckeditor.js")}}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{asset("assets/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js")}}"></script>
    <!-- Common form upload -->
    <script src="{{asset("assets/adminlte/common-js/upload.js")}}"></script>
    <!-- Validation -->
    <script src="{{asset("assets/adminlte/common-js/validation/introduce.js")}}"></script>
    <script>
        $(function () {
            $('.textarea').wysihtml5()
        });
    </script>
@endsection
