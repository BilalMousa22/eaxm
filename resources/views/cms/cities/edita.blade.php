@extends('cms.perante')

@section('title' ,'City Edita')

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
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Country Name</label>
                  <input type="text" class="form-control" value="{{ $cities->name }}" name=" name" id="name" placeholder="Country Name">
                </div>
                <div class="form-group">
                  <label for="street">Street</label>
                  <input type="text" class="form-control" value="{{ $cities->street }}" name=" street" id="street" placeholder="Street">
                </div>

                <div class="form-group">
                    <label for="coutry_id">City code</label>


                    <select  class="form-control"  name=" cuntry_id" id="cuntry_id" >
                      @foreach ( $cuntries as $cuntry )
                      <option value="{{ $cuntry->id }}" > {{ $cuntry->name }}</option>
                      @endforeach

                   </select>




                 </div>

              </div>


              <div class="card-footer">
                <button  type="button"  class="btn btn-primary"  onclick="preformUpdata( {{ $cities->id }})">save</button>
                <a href="{{ route('cities.index')}}" type="button" class="btn btn-primary">Go Bake</a>
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
        formData.append('name',document.getElementById('name').value);
        formData.append('street',document.getElementById('street').value);
        formData.append('cuntry_id',document.getElementById('cuntry_id').value);


        storeRoute('/cms/dashboard/update-cities/'+id , formData);
    }

</script>



@endsection


