@extends('admin.main.app')
@push('style')

@endpush
@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="text-capitalize">Edit Document </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
          <li class="breadcrumb-item active text-capitalize"> Document </li>
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
                <a href="{{route('admin.document.index')}}">
                  <i class="fas fa-arrow-left" title="Click to go back"></i>
                </a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.document.update',$documents->id)}}">
                @method('PATCH')
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <div class="form-group">
                      <label for="page">Document Type<code>*</code></label>
                      <select class="form-control rounded-0" id="page" name="page"> 
                        <option disabled>Select Document  </option>
                        <option value="1" {{$documents->page == 1 ? 'selected' : ''}}> Acts</option>
                        <option value="2" {{$documents->page == 2 ? 'selected' : ''}}> Regulations</option>
                        <option value="3" {{$documents->page == 3 ? 'selected' : ''}}> Directory</option>
                        <option value="4" {{$documents->page == 4 ? 'selected' : ''}}> Nirdeshika</option>
                        <option value="6" {{$documents->page == 6 ? 'selected' : ''}}> Download</option>
                        {{-- <option value="7" {{$documents->page == 7 ? 'selected' : ''}}> Yearly Budget</option> --}}
                        <option value="8" {{$documents->page == 8 ? 'selected' : ''}}> Red Book</option>
                        <option value="9" {{$documents->page == 9 ? 'selected' : ''}}> Bid</option>
                        <option value="10" {{$documents->page == 10 ? 'selected' : ''}}> Economic Survey</option>
                        <option value="11" {{$documents->page == 11 ? 'selected' : ''}}> Reports related to Rights to Information</option>
                        <option value="12" {{$documents->page == 12 ? 'selected' : ''}}> Medium Term Expenditure Framework</option>
                        <option value="5" {{$documents->page == 5 ? 'selected' : ''}}> Other</option>
                      </select>
                      @error('page')
                      <span class="text-danger font-italic" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    
                    <div class="form-group">
                      <label for="title">Title<code>*</code></label>
                      <input type="text" class="form-control" id="title" placeholder="Add New Name" value="{{$documents->title}}"  name="title" autocomplete="off">
                      @error('title')
                      <span class="text-danger font-italic" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="photo" class="d-block">File <code> * PDF / Excel / Doc / PPt File only</code>{{$documents->image}}</label>
                    {{-- <img id="blah" src="{{URL::to('/')}}/file/Document  /{{$documents->image_enc}}" onclick="document.getElementById('imgInp').click();" alt="your image" class="img-thumbnail mix" style="width: 175px;height: 140px" data-url="{{URL::to('/')}}/image/Document  /{{$documents->image}}" /> --}}
                    <input type='file' class=" image" id="imgInp" name="photo" />
                    @error('photo')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="remark">Remark <code>*</code></label>
                    <textarea  id="remark" class="ckeditor"  name="remark">{{strip_tags($documents->remark)}}</textarea>
                    @error('remark')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    
                  </div>
                  
                 
               
            
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update Document </button>
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