@extends('cms.perante')

@section('title' ,'Admin Index')
@section('title_min' ,'Admin ')

@section('style')

@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
                <a href="{{ route('admins.create') }}" type="submit" class="btn btn-primary">ADD NEW @yield('title_min')</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>email</th>
                    <th>first_name</th>

                    <th>mobile</th>
                    <th>address</th>
                    <th>date_of_birth</th>
                    <th>gender</th>
                    <th>city</th>

                    {{--  <th> Number of city</th>  --}}
                    <th > Setting</th>
                  </tr>
                </thead>
                <tbody>

                    @foreach (  $admins as  $admin )
                    <tr>
                        <td>{{ $admin->id }}</td>
                        <td>{{ $admin->email  }}</td>
                        <td>{{ $admin->user->first_name ?? "" }} {{ $admin->user->last_name ?? "" }}</td>

                        <td>{{ $admin->user->mobile ?? ""}}</td>
                        <td>{{ $admin->user->address  ?? ""}}</td>
                        <td>{{ $admin->user->date_of_birth ?? "" }}</td>
                        <td>{{ $admin->user->gender ?? "" }}</td>
                        <td>{{ $admin->user->city->name ?? "" }}</td>


                        {{--  <td> <span class="badge bg-info">{{ $City->cities_count}}</span></td>  --}}
                        <td><div class="btn group">
                            <a href="{{ route('recovery' ,$admin->id) }}" type="button" class="btn btn-info">Recovery</a>
                            <a type="button" onclick= "preformDestroy({{ $admin->id }} , this)"  class="btn btn-danger">delate</a>

                        </div></td>
                    </tr>

                    @endforeach


                </tbody>
              </table>
            </div>
            {{ $admins->links() }}


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
        confirmDestroy( '/cms/dashboard/delate/'+id , referance)
    }
</script>



@endsection
