@extends('cms.perante')

@section('title' ,'compny Index')
@section('title_min' ,'compny ')

@section('style')

@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
                <a href="{{ route('compnies.create') }}" type="submit" class="btn btn-primary">ADD NEW @yield('title_min')</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>email</th>
                    <th>status</th>
                    <th>name</th>


                    <th>dirction</th>


                    {{--  <th> Number of city</th>  --}}
                    <th > Setting</th>
                  </tr>
                </thead>
                <tbody>

                    @foreach (  $compnies as  $compny )
                    <tr>
                        <td>{{ $compny->id }}</td>
                        <td>{{ $compny->user->name  ?? ""  }}</td>
                        <td>{{ $compny->user->status  ?? ""  }}</td>
                        <td>{{ $compny->user->dirction  ?? ""  }}</td>
                        <td>{{ $compny->email ?? "" }}</td>


x
                        {{--  <td> <span class="badge bg-info">{{ $City->cities_count}}</span></td>  --}}
                        <td><div class="btn group">
                            <a href="{{ route('compnies.edit' ,$compny->id) }}" type="button" class="btn btn-info">eadit</a>
                            <a type="button" onclick= "preformDestroy({{ $compny->id }} , this)"  class="btn btn-danger">delate</a>

                        </div></td>
                    </tr>

                    @endforeach


                </tbody>
              </table>
            </div>
            {{ $compnies->links() }}


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
        confirmDestroy( '/cms/dashboard/compnies_branch/'+id , referance)
    }
</script>



@endsection
