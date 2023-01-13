@extends('admin.main.app')
@push('style')
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
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
                <a href="{{ route('admin.notice.create')}}" class="btn btn-sm btn-primary text-capitalize rounded-0" data-toggle="tooltip" data-placement="top" title="Add Notice">Add <i class="fas fa-user-plus fa-fw"></i> </a>
            
              </div>
              <div class="col-md-3">
                <select class="form-control rounded-0" name="notice_idSearch" id="notice_idSearch"> 
                  <option value="0">Select Notice Page</option>
                  <option value="1">General Notice</option>
                  <option value="2">Procurement Notice</option>
                  <!-- <option value="3">Posting Notice</option> -->
                  <!-- <option value="4">Publication</option> -->
                  <!-- <option value="5">Circular</option> -->
                  <option value="6">Bulletin Notice Board</option>
                </select>
              </div>
              <div class="col-md">
                
              </div>
             
            </div>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="table-responsive col-md-12">
         
              <table class="table table-bordered table-hover yajra-datatable" id="yajra-datatable">
                <thead class="table-primary text-center">  
                  <tr>
                    <th>Action</th>
                    <th width="10">SN</th>
                    <th>Page</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Remark</th>
                    <th>Description</th>
                    <th>File</th>
                    <th>Link</th>
                    <th>Status</th>
                    <th>Created At</th>
                  </tr>                

                </thead>
                {{-- <tbody class="text-center">
                  @foreach ($core_persons as $key => $core_person)
                  
                  <tr>
                    <td>
                      <a href="{{route('admin.core_person.edit',$core_person->id)}}" class="btn btn-sm btn-outline-info"  data-placement="top"title="Update"><i class="fas fa-edit"></i></a> 
                      <form action="{{route('admin.core_person.destroy',$core_person->id)}}" method="post" class="d-inline-block delete-confirm"  data-placement="top" title="Permanent Delete">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-sm btn-outline-danger" type="submit"><i class="fa fa-trash"></i></button>
                      </form>
                    </td>
                    
                    <td>{{$key+1}}</td>
                    <td class="text-left">{{$core_person->name}}</td>
                    <td class="text-left">{{$core_person->name_en}}</td>
                    <td class="text-left">{{$core_person->designation}}</td>
                    <td class="text-left">{{$core_person->designation_en}}</td>
                    <td class="text-left">{{$core_person->department}}</td>
                    <td class="text-left">{{$core_person->department}}</td>
                    <td class="text-left">{{$core_person->address_np}}</td>
                    <td><img src="{{URL::to('/')}}/image/core_person/{{$core_person->image_enc}}" width="50" height="50"></td>
                    <td class="text-left">{{$core_person->is_employee == 1  ? 'Yes' : 'No'}}</td>
                    <td class="text-left">{{$core_person->is_sachibalaya == 1  ? 'Yes' : 'No'}}</td>
                    @if($core_person->is_active == 0)
                    <td>Inactive <a href="{{route('admin.core_person.status',[$core_person->id,$core_person->is_active])}}"  title="Click to Publish"><i class="nav-icon fas fa-times-circle text-danger"></i></a></td>
                    @else
                    <td>Active <a href="{{route('admin.core_person.status',[$core_person->id,$core_person->is_active])}}" title="Click to Unpublish"><i class="nav-icon fas fa-check-circle text-success"></i></a></td>
                    @endif

                    <td>
                      {{$core_person->created_at->format('H:i:s')}}
                      <span class="badge badge-warning text-danger">{{$core_person->created_at->format('Y/m/d')}}</span>
                    </td>
                  </tr>
                  @endforeach
                </tbody> --}}
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
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    searchFunction()
  });

  function searchFunction(){
    Pace.start();
    var notice_idSearch = $('#notice_idSearch').val(),
    search = $('#search').val();
    // console.log(notice_idSearch);

    var table = $('.yajra-datatable').DataTable({
        processing: true,
        destroy: true,
        // stateSave: true,
        lengthMenu: [
            [10, 100, 250,-1],
            [10, 100, 250,'All'],
        ],
        "language": {
          processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '
        },
        serverSide: true,
        "ajax": {
          "url": "{{route('admin.getNoticeList')}}",
          "data": {
            notice_idSearch: notice_idSearch,
          }
        },
        columns: [
          {
              data: 'action', 
              name: 'action', 
              searchable: false,
              orderable: false 
          },

          {data: 'DT_RowIndex', name: 'DT_RowIndex',searchable: false,orderable:false},
          {data: 'page', name: 'page'},
          {data: 'title', name: 'title'},
          {data: 'date', name: 'date'},
          {data: 'remark', name: 'remark'},
          {data: 'description', name: 'description'},
          {data: 'image', name: 'image',searchable: false,orderable:false},
          {data: 'link', name: 'ext',searchable: false,orderable:false},
          {data: 'is_active', name: 'is_active',searchable: false,orderable:false},
          {data: 'created_at', name: 'created_at'},
           
        ]
    });
   
  }
  $('#reset').click(function(){
    $('#shift_data').val('');
    $('#class_data').val('');
    $('#section_data').val('');
    searchFunction();
  });

</script>
<script type="text/javascript">
  $("body").on("change","#notice_idSearch", function(event){
        Pace.start();
        searchFunction();
  });
  $('#search').keypress(function(event) {
    searchFunction();
  });
</script>

<script>
  function myFunction(el) {
    alert('ll');
    // console.log(el);

    event.preventDefault();
    const url = $(el).attr('data_url');
    var token = $('meta[name="csrf-token"]').attr('content');
    console.log(url,token);
    swal({
      title: 'Are you sure?',
      text: 'This record and it`s details will be permanantly deleted!',
      icon: 'warning',
      buttons: ["Cancel", "Yes!"],
      dangerMode: true,
      closeOnClickOutside: false,
    }).then(function(value) {
      if(value == true){
        $.ajax({
          url: url,
          type: "DELETE",
          data: {
            _token: token,
            '_method': 'DELETE',
          },
          success: function (data) {
            swal({
              title: "Success!",
              type: "success",
              text: data.message+"\n Click OK",
              icon: "success",
              showConfirmButton: false,
            }).then(location.reload(true));
            
          },
          error: function (data) {
            swal({
              title: 'Opps...',
              text: data.message+"\n Please refresh your page",
              type: 'error',
              timer: '1500'
            });
          }
        });
      }else{
        swal({
          title: 'Cancel',
          text: "Data is safe.",
          icon: "success",
          type: 'info',
          timer: '1500'
        });
      }
    });
   
  }
</script>

{{-- <script>
  $('.delete-confirm').on('click', function (e) {
    alert('ll');
    event.preventDefault();
    const url = $(this).attr('action');
    var token = $('meta[name="csrf-token"]').attr('content');
    swal({
      title: 'Are you sure?',
      text: 'This record and it`s details will be permanantly deleted!',
      icon: 'warning',
      buttons: ["Cancel", "Yes!"],
      dangerMode: true,
      closeOnClickOutside: false,
    }).then(function(value) {
      if(value == true){
        $.ajax({
          url: url,
          type: "POST",
          data: {
            _token: token,
            '_method': 'DELETE',
          },
          success: function (data) {
            swal({
              title: "Success!",
              type: "success",
              text: data.message+"\n Click OK",
              icon: "success",
              showConfirmButton: false,
            }).then(location.reload(true));
            
          },
          error: function (data) {
            swal({
              title: 'Opps...',
              text: data.message+"\n Please refresh your page",
              type: 'error',
              timer: '1500'
            });
          }
        });
      }else{
        swal({
          title: 'Cancel',
          text: "Data is safe.",
          icon: "success",
          type: 'info',
          timer: '1500'
        });
      }
    });
  });
</script> --}}

@endpush