@extends('admin.main.app')
@push('style')

@endpush
@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="text-capitalize">Edit Useful Link</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
          <li class="breadcrumb-item active text-capitalize"> Useful Link</li>
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
                <a href="{{route('admin.useful_link.index')}}">
                  <i class="fas fa-arrow-left" title="Click to go back"></i>
                </a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.useful_link.update',$useful_links->id)}}">
                @method('PATCH')
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                        <label for="title">Title <code>*</code></label>
                        <input type="text" class="form-control" id="title" placeholder="Add New Title" value="{{$useful_links->title}}"  name="title" autocomplete="off">
                         @error('title')
                        <span class="text-danger font-italic" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                         <label for="title_en">Title En<code>*</code></label>
                          <input type="text" class="form-control" id="title_en" placeholder="Add New Title" value="{{$useful_links->title_en}}"  name="title_en" autocomplete="off">
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
                    <label for="link">Link <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="link" placeholder="Add New Name" value="{{$useful_links->link}}"  name="link" autocomplete="off">
                    @error('link')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  
            
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update Useful Link</button>
                </div>
              </form>
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