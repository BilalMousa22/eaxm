@extends('cms.perante')

@section('title' ,'City Index')
@section('title_min' ,'City ')

@section('style')

@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
                <a href="{{ route('cities.create') }}" type="submit" class="btn btn-primary">ADD NEW @yield('title_min')</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>City Name</th>
                    <th>Street</th>
                    <th>Country Name</th>
                    {{--  <th> Number of city</th>  --}}
                    <th > Setting</th>
                  </tr>
                </thead>
                <tbody>

                    @foreach (  $cities as  $city )
                    <tr>
                        <td>{{ $city->id }}</td>
                        <td>{{ $city->name }}</td>
                        <td>{{ $city->street }}</td>
                        <td>{{ $city->country->name ?? null }}</td>

                        {{--  <td> <span class="badge bg-info">{{ $City->cities_count}}</span></td>  --}}
                        <td><div class="btn group">
                            <a href="{{ route('cities.edit' ,$city->id) }}" type="button" class="btn btn-info">eadit</a>
                            <a type="button" onclick= "preformDestroy({{ $city->id }} , this)"  class="btn btn-danger">delate</a>

                        </div></td>
                    </tr>

                    @endforeach


                </tbody>
              </table>
            </div>
            {{ $cities->links() }}


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
        confirmDestroy( '/cms/dashboard/cities/'+id , referance)
    }
</script>



@endsection
