@extends('admin.main.app')
@push('style')

@endpush
@section('content')
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="text-capitalize">Edit Core Person</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
          <li class="breadcrumb-item active text-capitalize"> Core Person</li>
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
                <a href="{{route('admin.core_person.index')}}">
                  <i class="fas fa-arrow-left" title="Click to go back"></i>
                </a>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.core_person.update',$core_persons->id)}}">
                @method('PATCH')
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <div class="row">
                    <div class="col-md-6">
                    <label for="name">Name <code>*</code></label>
                    <input type="text" class="form-control" id="name" placeholder="Add New Name" value="{{$core_persons->name}}" name="name"  autocomplete="off">
                    @error('name')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="col-md-6">
                      <label for="name_en">Name En<code>*</code></label>
                      <input type="text" class="form-control" id="name_en" placeholder="Add New Name" value="{{$core_persons->name_en}}"  name="name_en" autocomplete="off">
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
                    <input type="text" class="form-control" id="designation" placeholder="Add Designation" value="{{$core_persons->designation}}" name="designation" autocomplete="off">
                    @error('designation')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="col-md-6">
                    <label for="designation_en">Designation En <code>*</code></label>
                    <input type="text" class="form-control" id="designation_en" placeholder="Add Designation" value="{{$core_persons->designation_en}}" name="designation_en" autocomplete="off">
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
                    <img id="blah" src="{{URL::to('/')}}/image/core_person/{{$core_persons->image_enc}}" onclick="document.getElementById('imgInp').click();" alt="your image" class="img-thumbnail mix" style="width: 175px;height: 140px" data-url="{{URL::to('/')}}/image/core_person/{{$core_persons->image}}" />
                    <input type='file' class="d-none image" id="imgInp" name="photo" />
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
                    <input type="text" class="form-control" id="phone" placeholder="Add Phone or mobile number" value="{{$core_persons->phone}}"  name="phone" autocomplete="off">
                    @error('phone')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="fax">Fax </label>
                    <input type="text" class="form-control" id="fax" placeholder="Add Fax" value="{{$core_persons->fax}}" name="fax" autocomplete="off">
                  </div>
                  <div class="form-group">
                    <label for="email">Email Address <code>*</code></label>
                    <input type="text" class="form-control" id="email" placeholder="Add Email Address" value="{{$core_persons->email}}" name="email" autocomplete="off">
                    @error('email')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                
                  <div class="form-group">
                    <label for="from_date">Joined Date <code>*</code></label>
                    <input type="text" class="form-control" id="from_date" placeholder="Add Joined Date" value="{{$core_persons->from_date}}" name="from_date" autocomplete="off">
                    @error('from_date')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="to_date">End date of work tenure</label>
                    <input type="text" class="form-control" id="to_date" placeholder="Add End date of work tenure" value="{{$core_persons->to_date}}"  name="to_date"  autocomplete="off">
                    @error('to_date')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="description">Description <code>*</code></label>
                    <textarea id="description" class="ckeditor" name="description">{{$core_persons->description}}</textarea>
                    @error('description')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="sort_id">Sort Order <code>only for ordering (ascending order)</code></label>
                    <input type="number" class="form-control" id="sort_id" placeholder="Enter only number" value="{{$core_persons->sort_id}}" name="sort_id" autocomplete="off">
                    @error('sort_id')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  
                  <div class="form-group">
                    <label for="status">Status <code> Current Working / Retired / Transfered / Other</code></label>
                    <select class="form-control rounded-0" id="status" name="status"> 
                      <option value="0">Select Post </option>
                      <option value="1" {{$core_persons->status == 1 ? 'selected' : ''}}>Current Working</option>
                      <option value="2" {{$core_persons->status == 2 ? 'selected' : ''}}>Retired</option>
                      <option value="3" {{$core_persons->status == 3 ? 'selected' : ''}}>Transfered</option>
                      <option value="4" {{$core_persons->status == 4 ? 'selected' : ''}}>Other</option>
                    </select>
                    @error('is_front')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="department">Department <code> </code></label>
                    <input type="text" class="form-control" id="department" placeholder="Enter Department" name="department" value="{{$core_persons->department}}" autocomplete="off">
                    @error('department')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="facebook">Facebook Link <code> </code></label>
                    <input type="url" class="form-control" id="facebook" placeholder="Enter Facebook Link" value="{{$core_persons->facebook}}" name="facebook" autocomplete="off">
                     @error('facebook')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="twitter">Twitter Link <code> </code></label>
                    <input type="url" class="form-control" id="twitter" placeholder="Enter Twitter Link" value="{{$core_persons->twitter}}" name="twitter" autocomplete="off">
                    @error('twitter')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="youtube">Youtube Link <code> </code></label>
                    <input type="url" class="form-control" id="youtube" placeholder="Enter Youtube Link" value="{{$core_persons->youtube}}" name="youtube" autocomplete="off">
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
                      <option value="1" {{$core_persons->is_front == 1 ? 'selected' : ''}}>Mantri</option>
                      <option value="2" {{$core_persons->is_front == 2 ? 'selected' : ''}}>Sachib</option>
                      <option value="3" {{$core_persons->is_front == 3 ? 'selected' : ''}}>Prabakta</option>
                      <option value="4" {{$core_persons->is_front == 4 ? 'selected' : ''}}>Suchana Adhikari</option>
                      <option value="5" {{$core_persons->is_front == 5 ? 'selected' : ''}}>Gunaso Officer</option>
                    </select>
                    @error('is_front')
                    <span class="text-danger font-italic" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-switch">
                      <input class="custom-control-input" type="checkbox" name="is_m_v" id="is_m_v" autocomplete="off" {{$core_persons->is_m_v == 1 ? 'checked' : ''}} value="1">
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
                      <input class="custom-control-input" type="checkbox" name="is_employee" id="is_employee" {{$core_persons->is_employee == 1 ? 'checked' : ''}} autocomplete="off" value="1">
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
                      <input class="custom-control-input" type="checkbox" name="is_sachibalaya" id="is_sachibalaya" {{$core_persons->is_sachibalaya == 1 ? 'checked' : ''}}  autocomplete="off" value="1">
                      <label class="custom-control-label" for="is_sachibalaya">Make ON to show on Sachibalaya</label>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" :disabled="state.isSending">Update Core Person</button>
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
@endpush