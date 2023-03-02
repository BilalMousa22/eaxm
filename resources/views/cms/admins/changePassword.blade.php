@extends('cms.perante')

@section('title' , 'Change Password')

@section('main-title' , 'Change Password ')

@section('sub-title' , 'Change Password')

@section('styles')

@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Change Password</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
              <div class="card-body">
                <div class="row">

                <div class="form-group col-md-6">
                  <label for="password">Current Password </label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Enter Name of Contry">
                </div>

                <div class="form-group col-md-6">
                    <label for="new_password">New Password </label>
                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter Name of Contry">
                  </div>

                  <div class="form-group col-md-6">
                    <label for="new_password_confirmation">Confirmation Password </label>
                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="Enter Name of Contry">
                  </div>

              </div>


          </div>

              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" onclick="changePassword()" class="btn btn-primary">Change Password</button>
                {{-- <a href="{{ route('categories.index') }}" type="button" class="btn btn-info">Return Back</a> --}}

              </div>
            </form>
          </div>
          <!-- /.card -->


        </div>
        <!--/.col (left) -->


        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>

@endsection


@section('js')
  <script>
    function changePassword(){

      let formData = new FormData();
      formData.append('password',document.getElementById('password').value);
      formData.append('new_password',document.getElementById('new_password').value);
      formData.append('new_password_confirmation',document.getElementById('new_password_confirmation').value);

      store('/cms/admin/update_password' , formData);
    }

  </script>
@endsection
