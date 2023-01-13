@extends('admin.main.app')
@push('style')
@endpush
@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6 pl-1">
        <h1 class="text-capitalize">Add Core Person</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
          <li class="breadcrumb-item active text-capitalize">Core Person</li>
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
                <a href="{{route('admin.core_person.index')}}">
                  <i class="fas fa-arrow-left" title="Click to go back"></i>
                </a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" enctype="multipart/form-data" method="POST" action="{{route('admin.core_person.store')}}">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <div class="row">
                    <div class="col-md-6">
                      <label for="name">Name <code>*</code></label>
                      <input type="text" class="form-control" id="name" placeholder="Add New Name" name="name"  autocomplete="off">
                      @error('name')
                      <span class="text-danger font-italic" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <div class="col-md-6">
                      <label for="name_en">Name En<code>*</code></label>
                      <input type="text" class="form-control" id="name_en" placeholder="Add New Name" name="name_en" autocomplete="off">
                      @error('name_en')
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
                    <label for="designation">Designation <code>*</code></label>
                    <input type="text" class="form-control" id="designation" placeholder="Add Designation" name="designation" autocomplete="off">
                    @error('designation')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <label for="designation_en">Designation En <code>*</code></label>
                    <input type="text" class="form-control" id="designation_en" placeholder="Add Designation"  name="designation_en" autocomplete="off">
                    @error('designation_en')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                  </div>
                  <div class="form-group">
                    <label for="photo" class="d-block">Photo <code> Jpeg/Jpg Only with maximum size of 1 MB</code></label>
                    <input type="file" id="photo" name="photo" >
                    @error('photo')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <!-- <div class="form-group">
                    <label for="division">Division/Section <code>*</code></label>
                    <input type="text" class="form-control" id="division" placeholder="Add Division" v-model="form.division" name="division" :class="{ 'is-invalid': form.errors.has('division') }" autocomplete="off">
                    <has-error :form="form" field="division"></has-error>
                  </div> -->
                  <div class="form-group">
                    <label for="phone">Phone <code>*</code></label>
                    <input type="text" class="form-control" id="phone" placeholder="Add Phone or mobile number" name="phone" autocomplete="off">
                    @error('phone')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="fax">Fax </label>
                    <input type="text" class="form-control" id="fax" placeholder="Add Fax" name="fax" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="email">Email Address <code>*</code></label>
                    <input type="text" class="form-control" id="email" placeholder="Add Email Address" name="email" autocomplete="off">
                    @error('email')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                
                  <div class="form-group">
                    <label for="from_date">Joined Date <code>*</code></label>
                    <input type="text" class="form-control" id="from_date" placeholder="Enter Joined Date" name="from_date" autocomplete="off">
                    @error('from_date')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="to_date">End date of work tenure</label>
                    <input type="text" class="form-control" id="to_date" placeholder="Enter End date of work tenure" name="to_date"  autocomplete="off">
                    @error('to_date')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="description">Description <code>*</code></label>
                    <textarea  id="description"  class="ckeditor" name="description"></textarea>
                    @error('description')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="sort_id">Sort Order <code>only for ordering (ascending order)</code></label>
                    <input type="number" class="form-control" id="sort_id" placeholder="Enter only number" name="sort_id" autocomplete="off">
                    @error('sort_id')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="status">Status <code> Current Working / Retired / Transfered / Other</code></label>
                    <select  class="form-control rounded-0" id="status"  name="status"> 
                      <option disabled>Select Status </option>
                      <option value="1">Current Working </option>
                      <option value="2">Retired</option>
                      <option value="3">Transfered</option>
                      <option value="4">Other</option>
                    </select>
                    
                    @error('status')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="department">Department <code> </code></label>
                    <input type="text" class="form-control" id="department" placeholder="Enter Department" name="department" autocomplete="off">
                    @error('department')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="facebook">Facebook Link <code> </code></label>
                    <input type="url" class="form-control" id="facebook" placeholder="Enter Facebook Link" name="facebook" autocomplete="off">
                    @error('facebook')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="twitter">Twitter Link <code> </code></label>
                    <input type="url" class="form-control" id="twitter" placeholder="Enter Twitter Link" name="twitter" autocomplete="off">
                    @error('twitter')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="youtube">Youtube Link <code> </code></label>
                    <input type="url" class="form-control" id="youtube" placeholder="Enter Youtube Link" name="youtube" autocomplete="off">
                    @error('youtube')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="is_front">Photo For <code>*</code></label>
                    <select class="form-control rounded-0" id="is_front" name="is_front"> 
                      <option value="0">Select Post </option>
                      <option value="1">Mantri</option>
                      <option value="2">Sachib</option>
                      <option value="3">Prabakta</option>
                      <option value="4">Suchana Adhikari</option>
                      <option value="5">Gunaso Officer</option>
                    </select>
                    @error('is_front')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <!-- <div class="form-group">
                    <div class="custom-control custom-switch">
                      <input class="custom-control-input" type="checkbox" name="is_top" id="is_top" value="1" v-model="form.is_top" autocomplete="off">
                      <label class="custom-control-label" for="is_top">Make ON if detail is of Secretary</label>
                    </div>
                    <has-error :form="form" field="is_top"></has-error>
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-switch">
                      <input class="custom-control-input" type="checkbox" name="is_front" id="is_front" value="1" v-model="form.is_front" autocomplete="off">
                      <label class="custom-control-label" for="is_front">Make ON (Image, max 2)</label>
                    </div>
                    <has-error :form="form" field="is_front"></has-error>
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-switch">
                      <input class="custom-control-input" type="checkbox" name="is_start" id="is_start" value="1" v-model="form.is_start" autocomplete="off">
                      <label class="custom-control-label" for="is_start">Make ON if detail is of Spokesperson or Information Officer(Image, max 3)</label>
                    </div>
                    <has-error :form="form" field="is_start"></has-error>
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-switch">
                      <input class="custom-control-input" type="checkbox" name="is_slider" id="is_slider" value="1" v-model="form.is_slider" autocomplete="off">
                      <label class="custom-control-label" for="is_slider">Make ON to show on slider top</label>
                    </div>
                    <has-error :form="form" field="is_slider"></has-error>
                  </div> -->
                  <div class="form-group">
                    <div class="custom-control custom-switch">
                      <input class="custom-control-input" type="checkbox" name="is_m_v" id="is_m_v" value="1" autocomplete="off">
                      <label class="custom-control-label" for="is_m_v">Make ON if you want to show in mission & vision page</label>
                    </div>
                    @error('is_m_v')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-switch">
                      <input class="custom-control-input" type="checkbox" name="is_employee" id="is_employee" value="1" autocomplete="off">
                      <label class="custom-control-label" for="is_employee">Make ON to show on employee list</label>
                    </div>
                    @error('is_employee')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-switch">
                      <input class="custom-control-input" type="checkbox" name="is_sachibalaya" id="is_sachibalaya" value="0"  autocomplete="off">
                      <label class="custom-control-label" for="is_sachibalaya">Make ON to show on Sachibalaya</label>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Add CorePerson</button>
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