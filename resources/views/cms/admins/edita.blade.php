@extends('cms.perante')

@section('title' ,'Admin Edita')

@section('style')

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
              <h3 class="card-title">Quick Example</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
              <div class="card-body row">
                <div class="form-group col-md-6 ">
                  <label for="first_name">first-name</label>
                  <input type="text" class="form-control" value="{{$admins->user->first_name}}" name=" first_name" id="first_name" placeholder="first-name">
                </div>
                <div class="form-group col-md-6 ">
                  <label for="last_name">last-name</label>
                  <input type="text" class="form-control" value="{{$admins->user->last_name}}" name=" last_name" id="last_name" placeholder="last-name">
                </div>
                <div class="form-group col-md-6 ">
                    <label for="email">email</label>
                    <input type="email" class="form-control"  value="{{ $admins->email }}"   name=" email" id="email" placeholder="email">
                  </div>

                  <div class="form-group col-md-6 ">
                    <label for="mobile">mobile</label>
                    <input type="text" class="form-control" value="{{$admins->user->mobile}}" name=" mobile" id="mobile" placeholder="mobile">
                  </div>

                  <div class="form-group col-md-6 ">
                    <label for="address">address</label>
                    <input type="text" class="form-control"  value="{{$admins->user->address}}" name=" address" id="address" placeholder="address">
                  </div>

                  <div class="form-group col-md-6 ">
                    <label for="date_of_birth">date_of_birth</label>
                    <input type="date" class="form-control"  value="{{$admins->user->date_of_birth}}"  name=" date_of_birth" id="date_of_birth" placeholder="date_of_birth">
                  </div>
                  <div class="form-group col-md-6 ">
                    <label for="status">status</label>
                    <select  class="form-control"  name=" status" id="status" placeholder="status">

                        <option @if($admins->user->status == "inactive" )selected @endif value="inactive">inactive</option>
                        <option @if($admins->user->status == "active" )selected @endif value="active">active</option>

                        {{--  <option  selected >{{$admins->user->status}}</option>  --}}


                    </select>
                  </div>
                  <div class="form-group col-md-6 ">
                    <label for="gender">gender</label>
                    <select  class="form-control"  name=" gender" id="gender" placeholder="gender">
                        <option value="{{$admins->user->gender}}" >gender</option>
                        <option value="Male" > Male</option>
                        <option value="Famele" > Famele</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6 ">
                    <label for="image">image</label>
                    <input type="file" value="" class="form-control"  name=" image" id="image" placeholder="image">
                  </div>


                <div class="form-group col-md-12">
                  <label for="city_id">City</label>


                  <select  class="form-control"  name=" city_id" id="city_id" >
                    @foreach ( $cities as $city )
                    <option value="{{ $city->id }}" > {{ $city->name }}</option>
                    @endforeach

                 </select>




               </div>


              <div class="card-footer">
                <button  type="button"  class="btn btn-primary"  onclick="preformUpdata({{ $admins->id }})">save</button>
                <a href="{{ route('admins.index')}}" type="button" class="btn btn-primary">Go Bake</a>
              </div>
            </form>
          </div>


        </div>

      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

@endsection

@section('js')

<script>
    function preformUpdata(id){
        let formData = new FormData();
        formData.append('first_name',document.getElementById('first_name').value);
        formData.append('last_name',document.getElementById('last_name').value);
        formData.append('mobile',document.getElementById('mobile').value);
        formData.append('address',document.getElementById('address').value);
        formData.append('date_of_birth',document.getElementById('date_of_birth').value);
        formData.append('status',document.getElementById('status').value);
        formData.append('gender',document.getElementById('gender').value);
        formData.append('image',document.getElementById('image').files[0]);
        formData.append('email',document.getElementById('email').value);
        formData.append('city_id',document.getElementById('city_id').value);


        preformUpdata('/cms/dashboard/update-admins/'+id , formData);
    }

</script>



@endsection


