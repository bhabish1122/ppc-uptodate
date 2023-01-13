@extends('admin.main.app')
@push('style')

@endpush
@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="text-capitalize">Edit Notice</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
          <li class="breadcrumb-item active text-capitalize"> Notice</li>
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
                <a href="{{route('admin.notice.index')}}">
                  <i class="fas fa-arrow-left" title="Click to go back"></i>
                </a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.notice.update',$notices->id)}}">
                @method('PATCH')
                @csrf
                <div class="card-body">
                  
                  <div class="form-group">
                    <label for="page">Page <code>*</code></label>
                    <select class="form-control rounded-0" id="page" name="page"> 
                      <option disabled>Select Notice </option>
                      <option value="1" {{$notices->page == 1 ? 'selected' : ''}}>General Notice</option>
                      <option value="2" {{$notices->page == 2 ? 'selected' : ''}}>Procurement Notice</option>
                      <!-- <option value="3">Posting Notice</option>
                      <option value="4">Publication</option>
                      <option value="5">Circular</option> -->
                      <option value="6" {{$notices->page == 6 ? 'selected' : ''}}>Bulletin Notice Board</option>
                    </select>
                    @error('page')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group" id="contract_div">
                    <label for="contract_id">Contract ID <code>*</code></label>
                    <input type="text" class="form-control" id="contract_id" placeholder="Add New contract ID" value="{{$notices->contract_id}}" name="contract_id" autocomplete="off">
                    @error('contract_id')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="title">Title <code>*</code></label>
                    <input type="text" class="form-control" id="title" placeholder="Add New Title" value="{{$notices->title}}" name="title" autocomplete="off">
                    @error('title')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="photo" class="d-block">File <code> JPEG / JPG / PDF / Excel / Doc / PPt File only</code>{{$notices->image}}</label>
                    <input type="file" class="" id="photo" name="photo" >
                    @error('photo')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group" id="date_div">
                    <label for="date">Date <code>*</code></label>
                    <input type="date" class="form-control" id="date" placeholder="Add Date" value="{{$notices->date}}" name="date"  autocomplete="off">
                    @error('date')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  
                  {{-- <div class="form-group" id="remark_div" v-if="form.page == '3'">
                    <label for="remark">Remark <code>*</code></label>
                    <textarea  id="remark" class="ckeditor" name="remark"></textarea>
                    @error('remark')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div> --}}
                  <div class="form-group" id="description_div">
                    <label for="description">Description <code>*</code></label>
                    <textarea  id="description" class="ckeditor" name="description">{{$notices->description}}</textarea>
                    @error('description')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group" id="status_div">
                    <!-- <label for="status">Status <code>*</code></label> -->
                    <div class="custom-control custom-switch">
                      <input class="custom-control-input" type="checkbox" name="status" id="status" value="1" {{$notices->status == 1 ? 'checked' : ''}} autocomplete="off">
                      <label class="custom-control-label" for="status">File Open/Close</label>
                    </div>
                    
                    @error('status')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <!-- <label for="is_top">Is Top <code>*</code></label> -->
                    <div class="custom-control custom-switch">
                      <input class="custom-control-input" type="checkbox" value="1" name="is_top" id="is_top" {{$notices->is_top == 1 ? 'checked' : ''}}>
                      <label class="custom-control-label" for="is_top">Text Scroll on Home Page</label>
                    </div>
                    
                    @error('is_top')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  
                  <div class="form-group" id="ispop_div">
                    <!-- <label for="is_pop">Is pop <code>*</code></label> -->
                    <div class="custom-control custom-switch">
                      <input class="custom-control-input" type="checkbox" name="is_pop" id="is_pop" value="1" {{$notices->is_pop == 1 ? 'checked' : ''}} autocomplete="off">
                      <label class="custom-control-label" for="is_pop">Model Popup on Page Load</label>
                    </div>
                    
                    @error('is_pop')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <!-- contract_id,is_top,status -->
                  <div class="form-group" id="duration_div">
                    <label for="duration">Duration <code>End Date</code></label>
                    <input type="date" class="form-control" id="duration" placeholder="Add number of days" v-model="form.duration" name="duration" :class="{ 'is-invalid': form.errors.has('duration') }" autocomplete="off">
                    @error('duration')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update Notice</button>
                </div>
            
                </div>
                <!-- /.card-body -->
                
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
<script type="text/javascript">
  $(document).ready(function(){
    searchFunction()
  });

  function searchFunction(){
    Pace.start();
    var page = $('#page').val();
    if(page == 1){
      $('#contract_div').hide();
      $('#remark_div').hide();
      $('#status_div').hide();
      $('#duration_div').hide();

    }
    if(page == 2){
      $('#contract_div').show();
      $('#description_div').hide();
      $('#status_div').show();
      $('#ispop_div').hide();
      $('#duration_div').show();
    }
    if(page == 6){
      $('#contract_div').hide();
      $('#date_div').hide();
      $('#remark_div').hide();
      $('#status_div').hide();
      $('#ispop_div').hide();
      $('#description_div').show();
      $('#duration_div').show();

    }
   
  }

  $("body").on("change","#page", function(event){
    searchFunction()
 
  });
</script>


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