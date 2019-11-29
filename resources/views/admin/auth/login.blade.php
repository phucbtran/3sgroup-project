<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Đăng nhập | 3SGroup</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{asset('assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('assets/adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/adminlte/dist/css/AdminLTE.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('assets/adminlte/plugins/iCheck/square/blue.css')}}">
  <!-- toastr -->
  <link rel="stylesheet" href="{{ asset('assets/toastr/toastr.css') }}">
  <!-- common -->
  <link rel="stylesheet" href="{{asset('assets/adminlte/common-css/style.css')}}">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#">
        3SGroup
    </a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <h3 class="login-box-msg">Đăng nhập</h3>

    <form action="{{ route('login.login') }}" method="post" id="form-login">
      {{ csrf_field() }}
      <div class="form-group has-feedback">
        <input value="{{ old('email') }}" type="text" class="form-control" name="email" placeholder="Email" maxlength="100">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback form-password">
        <input value="{{ old('password') }}" type="password" name="password" class="form-control" placeholder="Mật khẩu" maxlength="100">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Đăng nhập</button>
          <input style="display:none;" type="text" id="backButton" value="0"/>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{asset('assets/adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('assets/adminlte/plugins/iCheck/icheck.min.js')}}"></script>
<!-- validation -->
<script src="{{asset("assets/adminlte/bower_components/form-validation/jquery.form.min.js")}}"></script>
<script src="{{asset("assets/adminlte/bower_components/form-validation/jquery.validate.min.js")}}"></script>
{{-- toastr --}}
<script src="{{ asset('assets/toastr/toastr.min.js') }}"></script>
<script src="{{asset('assets/adminlte/common-js/validation/login.js')}}"></script>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
</script>

@if ($msg)
    <script>
        toastr.error("{{$msg}}")
    </script>
@endif

</body>
</html>
