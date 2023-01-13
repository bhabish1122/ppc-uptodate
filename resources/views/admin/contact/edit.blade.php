@extends('admin.main.app')
@push('style')

@endpush
@section('content')
<?php $page = substr((Route::currentRouteName()), 6, strpos(str_replace('admin.','',Route::currentRouteName()), ".")); ?>
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="text-capitalize">Edit Contact</h1>
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
          <div class="col-8">
            <div class="card card-primary">
              <div class="card-header">
                <a href="{{route('admin.contact.index')}}">
                  <i class="fas fa-arrow-left" title="Click to go back"></i>
                </a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.contact.update',$contacts->id)}}">
                @method('PATCH')
                @csrf
          

                <div class="card-body">
                  <div class="form-group">
                    <div class="row">
                    <div class="col-md-6">
                    <label for="address">Address <code>*</code></label>
                    <textarea id="address" class="ckeditor" name="address">{{$contacts->address}}</textarea>
                    @error('address')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <label for="address_en">Address En<code>*</code></label>
                    <textarea  id="address_en" class="ckeditors" name="address_en">{{$contacts->address_en}}</textarea>
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
                    <input type="text" class="form-control" id="phone" placeholder="Enter here..." name="phone" autocomplete="off" value="{{$contacts->phone}}">
                    @error('phone')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <label for="phone_en">Phone En<code>* seperate by ','</code></label>
                    <input type="text" class="form-control" id="phone_en" placeholder="Enter here..." name="phone_en" autocomplete="off" value="{{$contacts->phone_en}}">
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
                    <input type="text" class="form-control" id="email" placeholder="Enter here..." name="email" autocomplete="off" value="{{$contacts->email}}">
                    @error('email')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="facebook">Facebook <code>* https://www.facebook.com/Your_Page_Redirect</code></label>
                    <input type="text" class="form-control" id="facebook" placeholder="Enter here..." name="facebook" autocomplete="off" value="{{$contacts->facebook}}">
                    @error('facebook')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="twitter">Twitter <code>* https://www.twitter.com/Your_Page_Redirect</code></label>
                    <input type="text" class="form-control" id="twitter" placeholder="Enter here..." name="twitter" autocomplete="off" value="{{$contacts->twitter}}">
                    @error('twitter')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="googleplus">GooglePlus <code>* https://www.googleplus.com/Your_Page_Redirect</code></label>
                    <input type="text" class="form-control" id="googleplus" placeholder="Enter here..." name="googleplus" autocomplete="off" value="{{$contacts->googleplus}}">
                    @error('googleplus')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="youtube">Youtube <code>* https://www.youtube.com/Your_Page_Redirect</code></label>
                    <input type="text" class="form-control" id="youtube" placeholder="Enter here..." name="youtube" autocomplete="off" value="{{$contacts->youtube}}">
                    @error('youtube')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="map">Map <code>* </code></label>
                    <input type="text" class="form-control" id="map" placeholder="Put <iframe src='Your_Page_Redirect_Path'>" name="map" autocomplete="off" value="{{$contacts->map}}">
                      @error('map')
                      <span class="text-danger font-italic" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="facebook_embeded">Facebook Page Embeded <code>* </code></label>
                    <input type="text" class="form-control" id="facebook_embeded" placeholder="Put <iframe src='Your_Page_Redirect_Path'>" name="facebook_embeded" autocomplete="off" value="{{$contacts->facebook_embeded}}">
                      @error('facebook_embeded')
                      <span class="text-danger font-italic" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="twitter_embeded">Twitter Page Embeded <code>* </code></label>
                    <input type="text" class="form-control" id="twitter_embeded" placeholder="Put <iframe src='Your_Page_Redirect_Path'>" name="twitter_embeded"  autocomplete="off" value="{{$contacts->twitter_embeded}}">
                      @error('twitter_embeded')
                      <span class="text-danger font-italic" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror 
                  </div>

                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update Contact</button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-4">
            <div class="box box-default position-relative">
              <div class="box-body">
                {{-- <div class="callout callout-success">
                  <h5>Title : {{form.title}}</h5>
                  <h5>Office : {{form.office}}</h5>
                  <h5>Address : {{form.address}}</h5>
                  <h5>Title : {{form.title_np}}</h5>
                  <h5>Office : {{form.office_np}}</h5>
                  <h5>Address : {{form.address_np}}</h5>
                  <img :src="updateImage(form.image_enc)" class="img-thumbnail" v-show="state.isDisplay">
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


{{-- <script type="text/javascript">
  function readURL(input) {
    alert('ll');
      if (input.target.files[0]) {
          var reader = new FileReader();
          console.log(reader);
          
          reader.onload = function (e) {
              $('#category-img-tag').attr('src', e.target.result);
          }
          
          reader.readAsDataURL(input.target.files[0]);
      }
  }

  $("#cat_image").change(function(){
    alert('ll');
      readURL(this);
  });
</script> --}}

@endpush