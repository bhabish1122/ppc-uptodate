@extends('admin.main.app')
@push('style')
@endpush
@section('content')
<?php $page = substr((Route::currentRouteName()), 6, strpos(str_replace('admin.','',Route::currentRouteName()), ".")); ?>
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6 pl-1">
        <h1 class="text-capitalize">Add Config</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
          <li class="breadcrumb-item active text-capitalize">Config Page</li>
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
                <a href="{{route('admin.config.index')}}">
                  <i class="fas fa-arrow-left" title="Click to go back"></i>
                </a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" enctype="multipart/form-data" method="POST" action="{{route('admin.config.store')}}">
                @csrf
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="title">Title En<code>*</code></label>
                        <input type="text" class="form-control" id="title" placeholder="Add New Title En" name="title" value="{{ old('title') }}" autocomplete="off">
                        @error('title')
                        <span class="text-danger font-italic" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="title_np">Title Np<code>*</code></label>
                        <input type="text" class="form-control" id="title_np" placeholder="Add New Title Np"  name="title_np" value="{{ old('title_np') }}" autocomplete="off">
                        @error('title_np')
                        <span class="text-danger font-italic" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="office">Office En<code>*</code></label>
                        <input type="text" class="form-control" id="office" placeholder="Add New Office En" name="office" value="{{ old('title_np') }}" autocomplete="off">
                        @error('office')
                        <span class="text-danger font-italic" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="office_np">Office Np<code>*</code></label>
                        <input type="text" class="form-control" id="office_np" placeholder="Add New Office Np" name="office_np"  value="{{ old('office_np') }}" autocomplete="off">
                        @error('office_np')
                        <span class="text-danger font-italic" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="address">Address En<code>*</code></label>
                        <input type="text" class="form-control" id="address" placeholder="Add New Address En" name="address"  value="{{ old('address') }}" autocomplete="off">
                        <has-error :form="form" field="address"></has-error>
                        @error('address')
                        <span class="text-danger font-italic" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="address_np">Address Np<code>*</code></label>
                        <input type="text" class="form-control" id="address_np" placeholder="Add New Address Np" name="address_np" value="{{ old('address') }}" autocomplete="off">
                        @error('address_np')
                        <span class="text-danger font-italic" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <div class="input-group ">
                    <div class="form-group">
                      <label for="photo" class="d-block">Photo <code>* Png Only with maximum size of 1 MB (90 x 90) </code></label>

                      <div class="input-group my-3">
                        <input type='file' class=" image" id="imgInp" name="photo" />
                        <input type="text" name="field" class="d-none" id="field">
                      </div>

                    </div>

                    @error('photo')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">

                  <button type="submit" class="btn btn-primary text-capitalize">Save</button>
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