@extends('admin.main.app')
@push('style')
@endpush
@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6 pl-1">
        <h1 class="text-capitalize">Add Document </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
          <li class="breadcrumb-item active text-capitalize">Document </li>
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
                <a href="{{route('admin.document.index')}}">
                  <i class="fas fa-arrow-left" title="Click to go back"></i>
                </a>
              </div>
              <!-- /.card-header -->
              <form role="form" enctype="multipart/form-data" method="POST" action="{{route('admin.document.store')}}">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="page">Document Type<code>*</code></label>
                    <select class="form-control rounded-0" id="page" name="page"> 
                      <option value="">Select Document/Type </option>
                      <option value="1"> Acts</option>
                      <option value="2"> Regulations</option>
                      <option value="3"> Directory</option>
                      <option value="4"> Nirdeshika</option>
                      <option value="6"> Download</option>
                      {{-- <option value="7"> Yearly Budget</option> --}}
                      {{-- <option value="8"> Red Book</option>
                      <option value="9"> Bid</option>
                      <option value="10"> Economic Survey</option>
                      <option value="11"> Reports related to Rights to Information</option>
                      <option value="12"> Medium Term Expenditure Framework</option> --}}
                      <option value="5"> Other</option>
                    </select>
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
                    <label for="photo" class="d-block">File <code>* PDF / Excel / Doc / PPt File only</code></label>
                    <input type="file" class="" id="photo" name="photo">
                    @error('photo')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="remark">Remark <code>*</code></label>
                    <textarea  id="remark" class="ckeditor"  name="remark"></textarea>
                    @error('remark')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Add Document </button>
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