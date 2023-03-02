@extends('cms.perante')

@section('title' ,'Admin Create')

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
                    <label for="name_compny">first-name</label>
                    <input type="text" class="form-control" name=" name_compny" id="name_compny" placeholder="name_compny">
                  </div>

                  <div class="form-group col-md-6 ">
                      <label for="email">email</label>
                      <input type="email" class="form-control"  name=" email" id="email" placeholder="email">
                    </div>
                  <div class="form-group col-md-6 ">
                      <label for="dirction">dirction</label>
                      <input type="text" class="form-control"  name=" dirction" id="dirction" placeholder="dirction">
                    </div>
                  <div class="form-group col-md-6 ">
                      <label for="dirction">password</label>
                      <input type="password" class="form-control"  name=" password" id="password" placeholder="password">
                    </div>

                    <div class="form-group col-md-6 ">
                      <label for="status">status</label>
                      <select  class="form-control"  name=" status" id="status" placeholder="status">
                          <option value="" >Status</option>
                          <option value="active" > active</option>
                          <option value="inactive" > inactive</option>
                      </select>
                    </div>

                    <select  class="form-control"  name=" compny_id" id=" compny_id" >
                      @foreach ( $compnies as $compny )
                      <option value="{{ $compny->user->id }}" > {{ $compny->user->name }}</option>
                      @endforeach

                   </select>











              <div class="card-footer">
                <button  type="button"  class="btn btn-primary"  onclick="preformUpdata({{$compnies->id}})">save</button>
                <a href="{{ route('compnies.index')}}" type="button" class="btn btn-primary">Go Bake</a>
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
        formData.append('name_compny',document.getElementById('name_compny').value);
        formData.append('email',document.getElementById('email').value);

        formData.append('status',document.getElementById('status').value);
        formData.append('dirction',document.getElementById('dirction').value);
        formData.append(' compny_id',document.getElementById('compny_id').value);





        storeRoute('/cms/dashboard/update-compnybranchs/'+id ,formData);
    }

</script>



@endsection

