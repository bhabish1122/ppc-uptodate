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
                <a href="{{ route('admin.document.create')}}" class="btn btn-sm btn-primary text-capitalize rounded-0" data-toggle="tooltip" data-placement="top" title="Add Document ">Add <i class="fas fa-user-plus fa-fw"></i> </a>
            
              </div>
              <div class="col-md-3">
                <select class="form-control rounded-0" name="page" id="page"> 
                  <option value="0">Select Document Page </option>
                  <option value="1"> Acts</option>
                  <option value="2"> Regulations</option>
                  <option value="3"> Directory</option>
                  <option value="4"> Nirdeshika</option>
                  <option value="6"> Download</option>
                  {{-- <option value="7"> Yearly Budget</option> --}}
                  <option value="8"> Red Book</option>
                  <option value="9"> Bid</option>
                  <option value="10"> Economic Survey</option>
                  <option value="11"> Reports related to Rights to Information</option>
                  <option value="12"> Medium Term Expenditure Framework</option>
                  <option value="5"> Other</option>

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
                    <th>Title</th>
                    <th class="text-left">Type</th>
                    <th class="text-left">File</th>
                    <th class="text-left">Link</th>
                    <th>Status</th>
                    <th>Created At</th>
                  </tr>
                </thead>
          
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
    var page = $('#page').val(),
    search = $('#search').val();

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
          "url": "{{route('admin.getDocumentList')}}",
          "data": {
            page: page,
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
          {data: 'title', name: 'title'},
          {data: 'type', name: 'type'},
          {data: 'image', name: 'image'},
          {data: 'link', name: 'link',searchable: false,orderable:false},
          {data: 'is_active', name: 'is_active',searchable: false,orderable:false},
          {data: 'created_at', name: 'created_at'},
           
        ]
    });
   
  }

  $("body").on("change","#page", function(event){
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