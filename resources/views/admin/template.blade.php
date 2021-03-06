<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') | 3SGroup</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('assets/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/adminlte/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('assets/adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('assets/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets/adminlte/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('assets/adminlte/dist/css/skins/_all-skins.min.css')}}">
    <!-- notification CSS  -->
    <link rel="stylesheet" href="{{asset("assets/adminlte/bower_components/notifications/Lobibox.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/adminlte/bower_components/notifications/notifications.css")}}">
    <!-- common -->
    <link rel="stylesheet" href="{{asset('assets/adminlte/common-css/style.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
@yield('styles')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

@include('admin.layout.header')
  <!-- Left side column. contains the logo and sidebar -->
@include('admin.layout.sidebar')

  <!-- Content Wrapper. Contains page content -->
{{--content--}}
@yield('content')
{{--end--}}
  <!-- /.content-wrapper -->
@include('admin.layout.footer')
<input style="display:none;" type="text" id="back-button" value="0"/>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{asset('assets/adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('assets/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('assets/adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/adminlte/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<!-- SlimScroll -->
<script src="{{asset('assets/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('assets/adminlte/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/adminlte/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('assets/adminlte/dist/js/demo.js')}}"></script>
<!-- notification JS -->
<script src="{{asset("assets/adminlte/plugins/notifications/Lobibox.js")}}"></script>
<!-- validation -->
<script src="{{asset("assets/adminlte/bower_components/form-validation/jquery.form.min.js")}}"></script>
<script src="{{asset("assets/adminlte/bower_components/form-validation/jquery.validate.min.js")}}"></script>
<script src="{{asset('assets/adminlte/common-js/validation/profile.js')}}"></script>

<script>
    $(document).ready(function () {
        var backButton = $('#back-button');
        if (backButton.val() == "0") {
            //Check session
            @if (\Illuminate\Support\Facades\Session::has('msg_success'))
            Lobibox.notify('success', {
                msg: "{{ \Illuminate\Support\Facades\Session::get('msg_success') }}"
            });
            @elseif (\Illuminate\Support\Facades\Session::has('msg_fail'))
            Lobibox.notify('error', {
                msg: "{{ \Illuminate\Support\Facades\Session::get('msg_fail') }}"
            });
            @elseif (\Illuminate\Support\Facades\Session::has('msg_forbidden'))
            Lobibox.notify('error', {
                msg: "{{ \Illuminate\Support\Facades\Session::get('msg_forbidden') }}"
            });
            @elseif (!empty($errors->first()))
            Lobibox.notify('error', {
                msg: "{{ trans('message.edit.fail') }}"
            });
            @endif
            backButton.val('1');
        }
    });
</script>

@yield('scripts')
</body>
</html>
