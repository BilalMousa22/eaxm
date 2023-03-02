@extends('cms.perante')

@section('title' ,'Cuntey Edita')

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
                  <input type="text" class="form-control" value="{{ $cuntries->name }}" name=" name" id="name" placeholder="Country Name">
                </div>
                <div class="form-group">
                  <label for="code">Country code</label>
                  <input type="text" class="form-control" value="{{ $cuntries->code }}" name=" code" id="code" placeholder="Country code">
                </div>

              </div>


              <div class="card-footer">
                <button  type="button"  class="btn btn-primary"  onclick="preformUpdata( {{ $cuntries->id }})">save</button>
                <a href="{{ route('countries.index')}}" type="button" class="btn btn-primary">Go Bake</a>
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
        formData.append('code',document.getElementById('code').value);

        storeRoute('/cms/dashboard/update-countries/'+id , formData);
    }

</script>



@endsection


