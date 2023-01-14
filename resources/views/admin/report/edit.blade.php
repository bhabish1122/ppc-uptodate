@extends('admin.main.app')
@push('style')

@endpush
@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="text-capitalize">Edit Report</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
          <li class="breadcrumb-item active text-capitalize"> Report</li>
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
                <a href="{{route('admin.report.index')}}">
                  <i class="fas fa-arrow-left" title="Click to go back"></i>
                </a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.report.update',$reports->id)}}">
                @method('PATCH')
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <div class="form-group">
                      <label for="page">Page <code>*</code></label>
                      <select class="form-control rounded-0" id="page" name="page"> 
                        <option disabled>Select Report </option>
                        <option value="6" {{$reports->page == 6 ? 'selected' : ''}}>Monthly Report</option>
                        <option value="1" {{$reports->page == 1 ? 'selected' : ''}}>Quaterly Progress Report</option>
                        <option value="7" {{$reports->page == 7 ? 'selected' : ''}}>Semi-annual Report</option>
                        <option value="2" {{$reports->page == 2 ? 'selected' : ''}}>Yearly Report</option>
                        <option value="15" {{$reports->page == 15 ? 'selected' : ''}}>Additional Planning</option>
                        <option value="16" {{$reports->page == 16 ? 'selected' : ''}}>Midterm Review</option>
                        {{-- <option value="8" {{$reports->page == 8 ? 'selected' : ''}}>Chemical inspection report</option>
                        <option value="9" {{$reports->page == 9 ? 'selected' : ''}}>Self-publishing on Right to Information</option>
                        <option value="10" {{$reports->page == 10 ? 'selected' : ''}}>Budgeted implementation action plan</option>
                        <option value="11" {{$reports->page == 11 ? 'selected' : ''}}>Performance Agreement</option>
                        <option value="12" {{$reports->page == 12 ? 'selected' : ''}}>Audit Report (Final)</option>
                        <option value="13" {{$reports->page == 13 ? 'selected' : ''}}>Internal Audit Report</option>
                        <option value="14" {{$reports->page == 14 ? 'selected' : ''}}>Consolidated Financial Statements</option> --}}
                      </select>
                      @error('page')
                      <span class="text-danger font-italic" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    
                    <div class="form-group">
                      <label for="title">Title<code>*</code></label>
                      <input type="text" class="form-control" id="title" placeholder="Add New Name" value="{{$reports->title}}"  name="title" autocomplete="off">
                      @error('title')
                      <span class="text-danger font-italic" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="photo" class="d-block">File <code> * PDF / Excel / Doc / PPt File only</code>{{$reports->image}}</label>
                    {{-- <img id="blah" src="{{URL::to('/')}}/file/report/{{$reports->image_enc}}" onclick="document.getElementById('imgInp').click();" alt="your image" class="img-thumbnail mix" style="width: 175px;height: 140px" data-url="{{URL::to('/')}}/image/report/{{$reports->image}}" /> --}}
                    <input type='file' class=" image" id="imgInp" name="photo" />
                    @error('photo')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="description">Description <code>*</code></label>
                    <textarea  id="description" class="ckeditor"  name="description">{{strip_tags($reports->description)}}</textarea>
                    @error('description')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    
                  </div>
                  
                 
               
            
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update Report</button>
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