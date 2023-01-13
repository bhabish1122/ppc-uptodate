@extends('admin.main.app')
@push('style')

@endpush
@section('content')
<?php $page = substr((Route::currentRouteName()), 6, strpos(str_replace('admin.','',Route::currentRouteName()), ".")); ?>
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="text-capitalize">Edit DivisionSection </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
          <li class="breadcrumb-item active text-capitalize">DivisionSection  Page</li>
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
                <a href="{{route('admin.division_section.index')}}">
                  <i class="fas fa-arrow-left" title="Click to go back"></i>
                </a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.division_section.update',$division_sections->id)}}">
                @method('PATCH')
                @csrf
            

                <div class="card-body">
                  
                  <div class="form-group">
                    <label for="name">Name of Office <code>*</code></label>
                    <input type="text" class="form-control" id="office" placeholder="Add New Title" name="office" autocomplete="off" value="{{$division_sections->title}}">
                     @error('office')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="name">Name of Division / Section Chief <code>*</code></label>
                    <input type="text" class="form-control" id="name" placeholder="Add New Title" name="name" autocomplete="off" value="{{$division_sections->name}}">
                     @error('name')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                     <label for="address">Address <code>*</code></label>
                    <input type="text" class="form-control" id="address" placeholder="Add New Address" name="address" autocomplete="off" value="{{$division_sections->address}}">
                     @error('address')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="contact_no">Contact No <code>*</code></label>
                    <input type="text" class="form-control" id="contact_no" placeholder="Add New Title" name="contact_no" autocomplete="off" value="{{$division_sections->contact_no}}">
                     @error('contact_no')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="email">Email <code>*</code></label>
                    <input type="text" class="form-control" id="email" placeholder="Add New Title" name="email" autocomplete="off" value="{{$division_sections->email}}">
                     @error('email')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                   <label for="designation">Designation of Division / Section Chief <code>*</code></label>
                    <input type="text" class="form-control" id="designation" placeholder="Add New Title" name="designation" autocomplete="off" value="{{$division_sections->designation}}">
                     @error('designation')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group col-md-5">
                     <label for="photo" class="d-block">Photo <code>* Jpeg/Jpg Only with maximum size of 1 MB</code></label>
                    <img id="blah" src="{{URL::to('/')}}/image/division_section/{{$division_sections->image_enc}}" onclick="document.getElementById('imgInp').click();" alt="your image" class="img-thumbnail mix" style="width: 175px;height: 140px" data-url="{{URL::to('/')}}/image/division_section/{{$division_sections->image}}" />

                    <div class="input-group my-2">
                      <input type='file' class="d-none image" id="imgInp" name="photo" />
                      <input type="text" name="field" class="d-none" id="field">
                    </div>
                    @error('photo')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  
                  <div class="form-group">
                   <label for="title">Objective of Division <code>*</code></label>
                    <input type="text" class="form-control" id="title" placeholder="Add New Title" name="title" autocomplete="off" value="{{$division_sections->title}}">
                     @error('title')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="description">Description of objectives <code>*</code></label>
                    <textarea  id="description" class="ckeditor"  name="description">{{$division_sections->description}}</textarea>
                    @error('description')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="division_work">Types of Work to be carried out by division <code>*</code></label>
                    <textarea  id="division_work" class="ckeditors"  name="division_work">{{$division_sections->division_work}}</textarea>
                    @error('division_work')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  
                </div>
                
                
            
               

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" :disabled="state.isSending">Update DivisionSection </button>
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