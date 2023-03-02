@extends('cms.perante')

@section('title' ,'Cuntey Index')
@section('title_min' ,'Cuntey ')

@section('style')

@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
                <a href="{{ route('countries.create') }}" type="submit" class="btn btn-primary">ADD NEW @yield('title_min')</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Country Name</th>
                    <th>Country Code</th>
                    <th> Number of city</th>
                    <th > Setting</th>
                  </tr>
                </thead>
                <tbody>

                    @foreach (  $cuntries as  $country )
                    <tr>
                        <td>{{ $country->id }}</td>
                        <td>{{ $country->name }}</td>
                        <td>{{ $country->code }}</td>

                        <td> <span class="badge bg-info">{{ $country->cities_count}}</span></td>
                        <td><div class="btn group">
                            <a href="{{ route('countries.edit' ,$country->id) }}" type="button" class="btn btn-info">eadit</a>
                            <a type="button" onclick= "preformDestroy({{ $country->id }} , this)"  class="btn btn-danger">delate</a>

                        </div></td>
                    </tr>

                    @endforeach


                </tbody>
              </table>
            </div>
            {{ $cuntries->links() }}


          </div>
          <!-- /.card -->



        <!-- /.col -->
      </div>

    </div><!-- /.container-fluid -->
  </section>

@endsection

@section('js')
<script>
    function preformDestroy(id , referance){
        confirmDestroy( '/cms/dashboard/countries/'+id , referance)
    }
</script>



@endsection
