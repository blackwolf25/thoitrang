@extends('admin_layout')
@section('admin_content')
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Cài đặt quyền hạn của các loại tài khoản</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Trang chủ</a></li>
              <li class="breadcrumb-item active">Phân quyền tài khoản</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <hr>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<section class="content">
    <div class="container-fluid">
      <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Thiết lập quyền hạn của các tài khoản sau:</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead style="text-align: center;">
                  <tr>
                    <th>STT</th>
                    <th>Tên tài khoản</th>
                    <th>Email</th>
                    <th>Quyền quản trị viên</th>
                    <th>Quyền cộng tác viên</th>
                    <th>Thiết lập quyền</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($admin as $key =>$user)
                      
                    <form action="{{URL::to('/assign-roles')}}" method="POST">
                    @csrf
                    
                    <tr>
                      <td></td>
                      <td> {{ $user->admin_name }} </td>
                      <td> {{ $user->admin_email}} 
                        <input type="hidden" name="admin_email" value=" {{ $user->admin_email}} ">
                      </td>
                      <td>
                        <input type="checkbox" name="admin_role" {{$user->hasRole('admin') ? 'cheched' : ''}}>
                      </td>
                      <td>
                        <input type="checkbox" name="staff_role" {{$user->hasRole('staff') ? 'cheched' : ''}}>
                      </td>
                      <td></td>
                    </tr>
                    </form>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
</section>
@endsection