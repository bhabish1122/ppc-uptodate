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
                <a href="{{ route('admin.contact.create')}}" class="btn btn-sm btn-primary text-capitalize rounded-0" data-toggle="tooltip" data-placement="top" title="Add Contact">Add <i class="fas fa-user-plus fa-fw"></i> </a>
            
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
                    <th class="text-left">Address</th>
                    <th class="text-left">Address En</th>
                    <th>Phone</th>
                    <th>Phone En</th>
                    <th>Email</th>
                    <th>Social Link</th>
                    <th>Status</th>
                    <th>Created At</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                  @foreach ($contacts as $key => $contact)
                  <tr>
                    <td>
                      <a href="{{route('admin.contact.edit',$contact->id)}}" class="btn btn-sm btn-outline-info"  data-placement="top"title="Update"><i class="fas fa-edit"></i></a> 
                      <form action="{{route('admin.contact.destroy',$contact->id)}}" method="post" class="d-inline-block delete-confirm"  data-placement="top" title="Permanent Delete">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-sm btn-outline-danger" type="submit"><i class="fa fa-trash"></i></button>
                      </form>
                    </td>
                    
                    <td>{{$key+1}}</td>
                    <td class="text-left">{{strip_tags($contact->address)}}</td>
                    <td class="text-left">{{strip_tags($contact->address_en)}}</td>
                    <td class="text-left">{{$contact->phone}}</td>
                    <td class="text-left">{{$contact->phone_en}}</td>
                    <td class="text-left">{{$contact->email}}</td>
                    <td class="text-left">
                      <ul class="list-inline m-0">
                        <li class="list-inline-item">
                          <a href="{{$contact->facebook}}" target="_blank" title="Facebook">
                            <i class="fab fa-facebook"></i>
                          </a>
                        </li>
                        <li class="list-inline-item">
                          <a href="{{$contact->twitter}}" target="_blank" title="Twitter">
                            <i class="fab fa-twitter"></i>
                          </a>
                        </li>
                        <li class="list-inline-item">
                          <a href="{{$contact->googleplus}}" target="_blank" title="GooglePlus">
                            <i class="fab fa-google-plus"></i>
                          </a>
                        </li>
                        <li class="list-inline-item">
                          <a href="{{$contact->youtube}}" target="_blank" title="Youtube">
                            <i class="fab fa-youtube"></i>
                          </a>
                        </li>
                      </ul>
                    </td>
                    @if($contact->is_active == 0)
                    <td>Inactive <a href="{{route('admin.contact.status',[$contact->id,$contact->is_active])}}"  title="Click to Publish"><i class="nav-icon fas fa-times-circle text-danger"></i></a></td>
                    @else
                    <td>Active <a href="{{route('admin.contact.status',[$contact->id,$contact->is_active])}}" title="Click to Unpublish"><i class="nav-icon fas fa-check-circle text-success"></i></a></td>
                    @endif

                    <td>
                      {{$contact->created_at->format('H:i:s')}}
                      <span class="badge badge-warning text-danger">{{$contact->created_at->format('Y/m/d')}}</span>
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