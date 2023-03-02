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
                  <input type="text" class="form-control"  value="{{$compnies->user->name}}"  name=" name_compny" id="name_compny" placeholder="name_compny">
                </div>

                <div class="form-group col-md-6 ">
                    <label for="email">email</label>
                    <input type="email" class="form-control"   value="{{$compnies->email}}"  name=" email" id="email" placeholder="email">
                  </div>
                <div class="form-group col-md-6 ">
                    <label for="dirction">dirction</label>
                    <input type="text" class="form-control"   value="{{$compnies->user->dirction}}"  name=" dirction" id="dirction" placeholder="password">
                  </div>


                  <div class="form-group col-md-6 ">
                    <label for="status">status</label>
                    <select  class="form-control"  name=" status" id="status" placeholder="status">
                        <option @if($compnies->user->status == "inactive" )selected @endif value="inactive">inactive</option>
                        <option @if($compnies->user->status == "active" )selected @endif value="active">active</option>
                    </select>
                  </div>











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




        storeRoute('/cms/dashboard/update-compnies/'+id ,formData);
    }

</script>



@endsection

