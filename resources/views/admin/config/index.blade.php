@extends('admin.main.app')
@push('style')
@endpush
@section('content')
<?php $page = substr((Route::currentRouteName()), 6, strpos(str_replace('admin.','',Route::currentRouteName()), ".")); ?>
<section class="content-header"></section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-12 connectedSortable">
        <!-- main page load here-->
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-md-2">
                <a href="{{ route('admin.config.create')}}" class="btn btn-sm btn-primary text-capitalize rounded-0" data-toggle="tooltip" data-placement="top" title="Add Config">Add <i class="fas fa-user-plus fa-fw"></i> </a>
            
              </div>
              {{-- <div class="col-md-8">
                <input type="text" class="form-control" id="" name="search" placeholder="Search by title">
              </div> --}}
              {{-- <div class="col-md-2">
                <button type="button" name="reset" id="reset" class="btn btn-warning">Reset</button>
              </div> --}}
            </div>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="table-responsive col-md-12">
         
              <table class="table table-bordered table-hover">
                <thead class="table-primary text-center">                  
                  <tr>
                    <th>Action</th>
                    <th width="10">SN</th>
                    <th class="text-left">Title</th>
                    <th class="text-left">Office</th>
                    <th class="text-left">Address</th>
                    <th class="text-left">Title Np</th>
                    <th class="text-left">Office Np</th>
                    <th class="text-left">Address Np</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Created At</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                  @foreach ($configs as $key => $config)
                  <tr>
                    <td>
                      <a href="{{route('admin.config.edit',$config->id)}}" class="btn btn-sm btn-outline-info"  data-placement="top"title="Update"><i class="fas fa-edit"></i></a> 
                      <form action="{{route('admin.config.destroy',$config->id)}}" method="post" class="d-inline-block delete-confirm"  data-placement="top" title="Permanent Delete">
                      @csrf
                      @method('DELETE') 
                      <button class="btn btn-sm btn-outline-danger" type="submit"><i class="fa fa-trash"></i></button>
                      </form>
                    </td>
                    
                    <td>{{$key+1}}</td>
                    <td class="text-left">{{$config->title}}</td>
                    <td class="text-left">{{$config->office}}</td>
                    <td class="text-left">{{$config->address}}</td>
                    <td class="text-left">{{$config->title_np}}</td>
                    <td class="text-left">{{$config->office_np}}</td>
                    <td class="text-left">{{$config->address_np}}</td>
                    <td><img src="{{URL::to('/')}}/image/config/{{$config->image_enc}}" width="50" height="50"></td>
                    @if($config->is_active == 0)
                    <td>Inactive <a href="{{route('admin.config.status',[$config->id,$config->is_active])}}"  title="Click to Publish"><i class="nav-icon fas fa-times-circle text-danger"></i></a></td>
                    @else
                    <td>Active <a href="{{route('admin.config.status',[$config->id,$config->is_active])}}" title="Click to Unpublish"><i class="nav-icon fas fa-check-circle text-success"></i></a></td>
                    @endif

                    <td>
                      {{$config->created_at->format('H:i:s')}}
                      <span class="badge badge-warning text-danger">{{$config->created_at->format('Y/m/d')}}</span>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
             
            </div>
          </div>
        </div>
        <!-- /.card -->
      </section>
    </div>
  </div><!-- /.container-fluid -->
</section>
@endsection
@push('javascript')
  <script>
    $('.delete-confirm').on('click', function (e) {
      event.preventDefault();
      const url = $(this).attr('action');
      var token = `{{ csrf_token() }}`;
      Swal.fire({
        title: 'Are you sure?',
        text: 'This record and it`s details will be permanantly deleted!',
        icon: 'warning',
        dangerMode: true,
        closeOnClickOutside: false,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then(function(value) {
        if(value.isConfirmed){
          $.ajax({
            url: url,
            type: "POST",
            data: {
              _token: token,
              '_method': 'DELETE',
            },
            success: function (data) {
              Swal.fire({
                title: "Success!",
                text: data.message+"\n Click OK",
                icon: "success",
                showConfirmButton: false,
              }).then(location.reload(true));
              
            },
            error: function (data) {
              Swal.fire({
                title: 'Opps...',
                text: data.message+"\n Please refresh your page",
                type: 'error',
                timer: '1500'
              });
            }
          });
        }else{
          Swal.fire({
            title: 'Cancel',
            text: "Data is safe.",
            icon: "success",
            type: 'info',
            timer: '1500'
          });
        }
      });
    });
  </script> 


@endpush