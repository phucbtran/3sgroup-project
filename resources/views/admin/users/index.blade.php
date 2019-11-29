@extends('admin.template')
@section('styles')
@section('title', 'Danh sách user')
@endsection
@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        List User
        <small></small>
      </h1>
      <p class="pull-right">
        <a href="javascript:void(0);"
        data-toggle="modal" data-target="#addUser"
        class="btn btn-success btn-sm ad-click-event">
          <i class="fa fa-plus"></i>
          Thêm User
        </a>
      </p>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- /.box-header -->
      <div class="box-body">
        <table id="example" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th width="">Họ tên</th>
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
                    <span class="label label-success" title="view">Admin</span>
                @else
                    <span class="label label-danger">SubAdmin</span>
                @endif
              </td>
              <td>
                @if($item['status'] == 1)
                    <span class="label label-success">Active</span>
                @elseif($item['status'] == 0)
                    <span class="label label-danger">Inactive</span>
                @endif
              </td>
              <td class="btn-act">
                  <button  href="#" data-toggle="modal" data-target="#editUser_{{ $item->id }}" type="button" class="btn btn-primary edit-record">
                      <i class="fa fa-edit"></i>
                  </button>
                  <button href="#" data-toggle="modal" data-target="#confirmDelete{{ $item->id }}" type="button" class="btn btn-danger del-record" alt="3986"><i class="fa fa-remove"></i></button>
              </td>
            </tr>
            <!-- Modal confirm delete -->
            <div class="modal fade" id="confirmDelete{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel{{ $item->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span></button>
                      <h4 class="modal-title">Are you want to delete !</h4>
                    </div>
                    <div class="modal-footer">
                        <form action="/admin/users/{{ $item['id'] }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="button" class="btn btn-outline-dark" data-dismiss="modal">No</button>
                            <button class="btn btn-danger">Yes</button>
                        </form>
                    </div>
                </div>
                </div>
            </div> 

            <!-- Modal edit user -->
            <div class="modal fade" id="editUser_{{ $item['id'] }}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title">Edit user</h4>
                    </div>
                    <div class="modal-footer">
                        <form action="/admin/users/{{ $item['id'] }}/update" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                            <div class="form-group row">
                                    <!-- Date Time Start -->
                                    <label class="control-label col-md-3 required " for="datetime_start">Họ Tên: </label>
                                    <div class="controls controlsDisplay col-md-7">
                                        <div>
                                            <input data-validation="length" value="{{ $item['full_name'] }}"  data-validation-length="3-100" type="text" name="user[full_name]" placeholder="" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <!-- Date Time Start -->
                                    <label class="control-label col-md-3 required " for="datetime_start">Email: </label>
                                    <div class="controls controlsDisplay col-md-7">
                                        <div>
                                            <input value="{{ $item['email'] }}" value="{{ $item['email'] }}" data-validation="email" type="text" name="user[email]" placeholder="" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <!-- Date Time Start -->
                                    <label class="control-label col-md-3 required " for="datetime_start">Mật khẩu: </label>
                                    <div class="controls controlsDisplay col-md-7">
                                        <div>
                                            <input value="" data-validation="length"  data-validation-length="5-50" type="password" id="user_password" name="user[password]" placeholder="" class="form-control">
                                        </div>
                                    </div>
                                </div>  

                                <div class="form-group row">
                                    <!-- Date Time Start -->
                                    <label class="control-label col-md-3 required " for="datetime_start">Xác nhận mật khẩu:</label>
                                    <div class="controls controlsDisplay col-md-7">
                                        <div>
                                        <input value="" data-validation="confirm_password_df" type="password" name="password_confirm" placeholder="" class="form-control">
                                        </div>
                                    </div>
                                </div>    

                                <div class="form-group row">
                                    <label class="control-label col-md-3">Trạng thái: </label>
                                    <div class="controls controlsDisplay col-md-7">
                                        <select class="form-control" name="user[status]">    
                                            <option value="0" @if($item['status']==0) selected @endif>Inactive</option>
                                            <option value="1" @if($item['status']==1) selected @endif>Active</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="control-label col-md-3">Quyền: </label>
                                    <div class="controls controlsDisplay col-md-7">
                                        <select class="form-control" name="user[role_id]">    
                                            <option value="0" @if($item['role_id']==0) selected @endif>Admin</option>
                                            <option value="1" @if($item['role_id']==1) selected @endif>SubAdmin</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                <div class="controls col-md-10">
                                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">No</button>
                                    <input class="btn btn-success pull-right" type="submit" value="Edit">
                                </div>
                                </div>     
                        </form>
                    </div>
                </div>
                </div>
            </div> 
            @endforeach
          </tfoot>
        </table>
      </div>
      <!-- /.box-body -->
    </section>
    <!-- /.content -->
  </div>
<!-- Modal add user -->
    <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Add user</h4>
            </div>
            <div class="modal-footer">
                <form action="/admin/users/create" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <div class="form-group row">
                        <!-- Date Time Start -->
                        <label class="control-label col-md-3 required " for="datetime_start">Họ Tên: </label>
                        <div class="controls controlsDisplay col-md-7">
                            <div>
                                <input value="{{old('user.full_name')}}" data-validation="length" value="{{ $item['full_name'] }}"  data-validation-length="3-100" type="text" name="user[full_name]" placeholder="" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <!-- Date Time Start -->
                        <label class="control-label col-md-3 required " for="datetime_start">Email: </label>
                        <div class="controls controlsDisplay col-md-7">
                            <div>
                                <input value="{{old('user.email')}}" value="{{ $item['email'] }}" data-validation="email" type="text" name="user[email]" placeholder="" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <!-- Date Time Start -->
                        <label class="control-label col-md-3 required " for="datetime_start">Mật khẩu: </label>
                        <div class="controls controlsDisplay col-md-7">
                            <div>
                                <input value="{{old('user.password')}}" data-validation="length"  data-validation-length="5-50" type="password" id="user_password" name="user[password]" placeholder="" class="form-control">
                            </div>
                        </div>
                    </div>  

                    <div class="form-group row">
                        <!-- Date Time Start -->
                        <label class="control-label col-md-3 required " for="datetime_start">Xác nhận mật khẩu:</label>
                        <div class="controls controlsDisplay col-md-7">
                            <div>
                            <input value="{{old('user.password')}}" data-validation="confirm_password_df" type="password" name="password_confirm" placeholder="" class="form-control">
                            </div>
                        </div>
                    </div>    

                    <div class="form-group row">
                        <label class="control-label col-md-3">Trạng thái: </label>
                        <div class="controls controlsDisplay col-md-7">
                            <select class="form-control" name="user[status]">    
                                <option value="0">Inactive</option>
                                <option value="1">Active</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-md-3">Quyền: </label>
                        <div class="controls controlsDisplay col-md-7">
                            <select class="form-control" name="user[role_id]">    
                                <option value="0">Admin</option>
                                <option value="1">SubAdmin</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="controls col-md-10">
                            <button type="button" class="btn btn-outline-dark" data-dismiss="modal">No</button>
                            <input class="btn btn-success pull-right" type="submit" value="Add">
                        </div>
                    </div>     
                </form>
            </div>
        </div>
        </div>
    </div> 
@endsection
@section('scripts')
<script>
  $(function () {
    $('#example').DataTable()
  })
</script>
@endsection