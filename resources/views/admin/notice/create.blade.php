@extends('admin.main.app')
@push('style')
@endpush
@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6 pl-1">
        <h1 class="text-capitalize">Add Notice</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
          <li class="breadcrumb-item active text-capitalize">Notice</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-12 connectedSortable">
        <!-- main page load here-->
        <div class="row">
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <a href="{{route('admin.notice.index')}}">
                  <i class="fas fa-arrow-left" title="Click to go back"></i>
                </a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->


              <form role="form" enctype="multipart/form-data" method="POST" action="{{route('admin.notice.store')}}">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="page">Page <code>*</code></label>
                    <select  class="form-control rounded-0" id="page"  name="page"> 
                      <option disabled>Select Notice </option>
                      <option value="1">General Notice</option>
                      <option value="2">Procurement Notice</option>
                      <!-- <option value="3">Posting Notice</option> -->
                      <!-- <option value="4">Publication</option> -->
                      <!-- <option value="5">Circular</option> -->
                      <option value="6">Bulletin Notice Boarde</option>
                    </select>
                    @error('page')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group"  id="contract_div">
                    <label for="contract_id">Contract ID <code>*</code></label>
                    <input type="text" class="form-control" id="contract_id" placeholder="Add New contract ID" name="contract_id"  autocomplete="off">
                    @error('contract_id')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="title">Title <code>*</code></label>
                    <input type="text" class="form-control" id="title" placeholder="Add New Title"  name="title" autocomplete="off">
                    @error('title')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="photo" class="d-block">
                      File 
                      <code>* JPEG / JPG / PDF / Excel / Doc / PPt File only</code>
                    </label>
                    <input type="file" class="" id="photo" name="photo">
                    @error('photo')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group" id="date_div">
                    <label for="date">Date <code>*</code></label>
                    <input type="date" class="form-control" id="date" placeholder="Add Date" name="date" autocomplete="off">
                    @error('date')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  
                  <div class="form-group" id="remark_div">
                    <label for="remark">Remark <code>*</code></label>
                    <textarea class="ckeditor form-control" name="remark"></textarea>
                    @error('remark')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group" id="description_div" >
                    <label for="description">Description <code>*</code></label>
                    <textarea class="ckeditors" id="description" name="description"></textarea>
                    @error('description')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group" id="status_div">
                    <!-- <label for="status">Status <code>*</code></label> -->
                    <div class="custom-control custom-switch">
                      <input class="custom-control-input" type="checkbox" name="status" id="status" value="1" autocomplete="off">
                      <label class="custom-control-label" for="status">File Open/Close</label>
                    </div>
                    
                    @error('status')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <!-- <label for="is_top">Is Top <code>*</code></label> -->
                    <div class="custom-control custom-switch">
                      <input class="custom-control-input" type="checkbox" name="is_top" id="is_top" value="1" autocomplete="off">
                      <label class="custom-control-label" for="is_top">Text Scroll on Home Page</label>
                    </div>
                    
                    @error('is_top')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group" id="ispop_div">
                    <!-- <label for="is_pop">Is pop <code>*</code></label> -->
                    <div class="custom-control custom-switch">
                      <input class="custom-control-input" type="checkbox" name="is_pop" id="is_pop" value="1" autocomplete="off">
                      <label class="custom-control-label" for="is_pop">Modal Popup on Page Load</label>
                    </div>
                    
                    @error('is_pop')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group" id="duration_div">
                    <label for="duration">Duration <code>End Date</code></label>
                    <input type="date" class="form-control" id="duration" placeholder="Add number of days" name="duration" autocomplete="off">
                    @error('duration')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Add Notice</button>
                </div>
              </form>


              
            </div>
          </div>
          <div class="col-4">
            <div class="box box-default position-relative">
              <div class="box-body">
                 {{-- <div class="callout callout-success">
                  <h5>Title : form.title</h5>
                  <h5>Office : form.office</h5>
                  <h5>Address : form.address</h5>
                  <h5>Title : form.title_np</h5>
                  <h5>Office : form.office_np</h5>
                  <h5>Address : form.address_np</h5>
                  <img :src="imagePreview" class="img-thumbnail" v-show="showPreview"/>
                </div> --}} 
              </div>
            </div>
          </div>
        </div>
        <!-- /.card -->
      </section>
      <!-- /.Left col -->
      <!-- right col (We are only adding the ID to make the widgets sortable)-->
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
@endsection
@push('javascript')
<script>
  $('form').submit(function(){
       $(this).find(':submit').attr( 'disabled','disabled' ); 
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    searchFunction()
  });

  function searchFunction(){
    Pace.start();
    var page = $('#page').val();
    if(page == 1){
      $('#contract_div').hide();
      $('#remark_div').hide();
      $('#status_div').hide();
      $('#duration_div').hide();

    }
    if(page == 2){
      $('#contract_div').show();
      $('#description_div').hide();
      $('#status_div').show();
      $('#ispop_div').hide();
      $('#duration_div').show();
    }
    if(page == 6){
      $('#contract_div').hide();
      $('#date_div').hide();
      $('#remark_div').hide();
      $('#status_div').hide();
      $('#ispop_div').hide();
      $('#description_div').show();
      $('#duration_div').show();

    }
   
  }

  $("body").on("change","#page", function(event){
    searchFunction()
 
  });
</script>

@endpush