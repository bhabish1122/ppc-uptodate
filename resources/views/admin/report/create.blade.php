@extends('admin.main.app')
@push('style')
@endpush
@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6 pl-1">
        <h1 class="text-capitalize">Add Report</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
          <li class="breadcrumb-item active text-capitalize">Report</li>
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
                <a href="{{route('admin.report.index')}}">
                  <i class="fas fa-arrow-left" title="Click to go back"></i>
                </a>
              </div>
              <!-- /.card-header -->
              <form role="form" enctype="multipart/form-data" method="POST" action="{{route('admin.report.store')}}">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="page">Page <code>*</code></label>
                    <select class="form-control rounded-0" id="page" name="page"> 
                      <option selected disabled>Select Report </option>
                      <option value="6">Monthly Report</option>
                      <option value="1">Quaterly Progress Report</option>
                      <option value="7">Semi-annual Report</option>
                      <option value="2">Yearly Report</option>
                      {{-- <option value="8">Chemical inspection report</option>
                      <option value="9">Self-publishing on Right to Information</option>
                      <option value="10">Budgeted implementation action plan</option>
                      <option value="11">Performance Agreement</option>
                      <option value="12">Audit Report (Final)</option>
                      <option value="13">Internal Audit Report</option>
                      <option value="14">Consolidated Financial Statements</option>
                    </select> --}}
                    @error('page')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="title">Title <code>*</code></label>
                    <input type="text" class="form-control" id="title" placeholder="Add New Title" name="title" autocomplete="off">
                     @error('title')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="photo" class="d-block">File <code> * PDF / Excel / Doc / PPt File only</code></label>
                    <input type="file" class="" id="photo" name="photo">
                    @error('photo')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="description">Description <code>*</code></label>
                    <textarea  id="description" class="ckeditor"  name="description"></textarea>
                    @error('description')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Add Report</button>
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

@endpush