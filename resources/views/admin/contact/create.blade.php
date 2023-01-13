@extends('admin.main.app')
@push('style')
@endpush
@section('content')
<?php $page = substr((Route::currentRouteName()), 6, strpos(str_replace('admin.','',Route::currentRouteName()), ".")); ?>
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6 pl-1">
        <h1 class="text-capitalize">Add Contact</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
          <li class="breadcrumb-item active text-capitalize">Contact Page</li>
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
                <a href="{{route('admin.contact.index')}}">
                  <i class="fas fa-arrow-left" title="Click to go back"></i>
                </a>
              </div>

              <form role="form" enctype="multipart/form-data" method="POST" action="{{route('admin.contact.store')}}">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <div class="row">
                    <div class="col-md-6">
                    <label for="address">Address <code>*</code></label>
                    <textarea id="address" class="ckeditor" name="address"></textarea>
                    @error('address')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <label for="address_en">Address En<code>*</code></label>
                    <textarea  id="address_en" class="ckeditors" name="address_en"></textarea>
                    @error('address_en')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                    <div class="col-md-6">
                    <label for="phone">Phone <code>* seperate by ','</code></label>
                    <input type="text" class="form-control" id="phone" placeholder="Enter here..." name="phone" autocomplete="off">
                    @error('phone')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <label for="phone_en">Phone En<code>* seperate by ','</code></label>
                    <input type="text" class="form-control" id="phone_en" placeholder="Enter here..." name="phone_en" autocomplete="off">
                    @error('phone_en')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  </div>
                  </div>
                  <div class="form-group">
                    <label for="email">Email <code>* for multiple email seperate by ','</code></label>
                    <input type="text" class="form-control" id="email" placeholder="Enter here..." name="email" autocomplete="off">
                    @error('email')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="facebook">Facebook <code>* https://www.facebook.com/Your_Page_Redirect</code></label>
                    <input type="text" class="form-control" id="facebook" placeholder="Enter here..." name="facebook" autocomplete="off">
                    @error('facebook')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="twitter">Twitter <code>* https://www.twitter.com/Your_Page_Redirect</code></label>
                    <input type="text" class="form-control" id="twitter" placeholder="Enter here..." name="twitter" autocomplete="off">
                    @error('twitter')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="googleplus">GooglePlus <code>* https://www.googleplus.com/Your_Page_Redirect</code></label>
                    <input type="text" class="form-control" id="googleplus" placeholder="Enter here..." name="googleplus" autocomplete="off">
                    @error('googleplus')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="youtube">Youtube <code>* https://www.youtube.com/Your_Page_Redirect</code></label>
                    <input type="text" class="form-control" id="youtube" placeholder="Enter here..." name="youtube" autocomplete="off">
                    @error('youtube')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="map">Map <code>* </code></label>
                    <input type="text" class="form-control" id="map" placeholder="Put <iframe src='Your_Page_Redirect_Path'>" name="map" autocomplete="off">
                      @error('map')
                      <span class="text-danger font-italic" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="facebook_embeded">Facebook Page Embeded <code>* </code></label>
                    <input type="text" class="form-control" id="facebook_embeded" placeholder="Put <iframe src='Your_Page_Redirect_Path'>" name="facebook_embeded" autocomplete="off">
                      @error('facebook_embeded')
                      <span class="text-danger font-italic" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="twitter_embeded">Twitter Page Embeded <code>* </code></label>
                    <input type="text" class="form-control" id="twitter_embeded" placeholder="Put <iframe src='Your_Page_Redirect_Path'>" name="twitter_embeded"  autocomplete="off">
                      @error('twitter_embeded')
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