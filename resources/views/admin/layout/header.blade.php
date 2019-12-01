  <header class="main-header">
    <!-- Logo -->
    <a href="{{ route('dashboard') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b style="font-size:7px">3SGroup</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>3SGroup</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{asset('assets/img/no-avatar.gif')}}" class="user-image" alt="User Image">
                    <span class="hidden-xs">{{ Auth::user()->full_name }}</span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        <img src="{{asset('assets/img/no-avatar.gif')}}" class="img-circle" alt="User Image">
                        <p>
                            {{ Auth::user()->full_name }}
                            <small>{{ (Auth::user()->role == '0') ? config('const.role.admin') : config('const.role.sub_admin') }}</small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="#" data-toggle="modal" data-target="#modal-update-profile" class="btn btn-default btn-flat">Cập nhật thông tin</a>
                        </div>
                        <div class="pull-right">
                            <a href="{{ route('logout') }}" class="btn btn-default btn-flat">Đăng xuất</a>
                        </div>
                    </li>
                </ul>
            </li>
          <!-- Control Sidebar Toggle Button -->
        </ul>
      </div>
    </nav>
  </header>
  <!-- Modal edit user -->
  <div class="modal fade" id="modal-update-profile" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
          <form action="{{ route('profile.update') }}" method="POST" class="form-horizontal" id="form-profile">
              {{ csrf_field() }}
              {{ method_field('POST') }}
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span></button>
                      <h4 class="modal-title">Cập nhật thông tin cá nhân</h4>
                  </div>
                  <div class="modal-body">
                      <div class="box-body">
                          <div class="form-group">
                              <!-- Date Time Start -->
                              <label class="col-sm-3 control-label required" for="datetime_start">Họ Tên: </label>
                              <div class="col-sm-9">
                                  <input type="text" name="full_name" class="form-control" id="profile-full_name" maxlength="500"
                                         value="{{ Auth::user()->full_name }}">
                              </div>
                          </div>

                          <div class="form-group">
                              <!-- Date Time Start -->
                              <label class="col-sm-3 control-label" for="datetime_start">Mật khẩu: </label>
                              <div class="col-sm-9">
                                  <input type="password" name="password" class="form-control" id="profile-password" maxlength="500">
                              </div>
                          </div>

                          <div class="form-group">
                              <!-- Date Time Start -->
                              <label class="col-sm-3 control-label " for="datetime_start">Nhập lại mật khẩu:</label>
                              <div class="col-sm-9">
                                  <input type="password" name="password_confirm" class="form-control" id="profile-password_confirm" maxlength="500">
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
