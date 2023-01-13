@extends('admin.main.app')
@push('style')
@endpush
@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6 pl-1">
        <h1 class="text-capitalize">Add Useful Link</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
          <li class="breadcrumb-item active text-capitalize">Useful Link</li>
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
                <a href="{{route('admin.useful_link.index')}}">
                  <i class="fas fa-arrow-left" title="Click to go back"></i>
                </a>
              </div>
              <!-- /.card-header -->
              <form role="form" enctype="multipart/form-data" method="POST" action="{{route('admin.useful_link.store')}}">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                        <label for="title">Title <code>*</code></label>
                        <input type="text" class="form-control" id="title" placeholder="Add New Title" name="title" autocomplete="off">
                         @error('title')
                        <span class="text-danger font-italic" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                         <label for="title_en">Title En<code>*</code></label>
                          <input type="text" class="form-control" id="title_en" placeholder="Add New Title" name="title_en" autocomplete="off">
                          @error('title_en')
                          <span class="text-danger font-italic" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                    </div>
                  </div>
                  

                  <div class="form-group">
                    <label for="link">URL of Website <code>*</code></label>
                    <input type="text" class="form-control" id="link" placeholder="Enter here..." name="link"  autocomplete="off">
                    @error('link')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  
                  
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Add Useful Link</button>
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