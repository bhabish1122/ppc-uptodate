@extends('admin.main.app')
@push('style')
@endpush
@section('content')
<?php $page = substr((Route::currentRouteName()), 6, strpos(str_replace('admin.','',Route::currentRouteName()), ".")); ?>
<section class="content-header"></section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-12 connectedSortable">
        <!-- main page load here-->
        <div class="card">
          <div class="card-header">
            <div class="row">
              <div class="col-md-2">
            
              </div>
             
            </div>
          </div><!-- /.card-header -->
          <div class="card-body">
            <div class="table-responsive col-md-12">
         
              <table class="table table-bordered table-hover">
                <thead class="table-primary text-center">                  
                  <tr>
                    <th width="10">SN</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Phone</th>
                    <th>Created At</th>
                  </tr>
                </thead>
                <tbody class="text-center">
                  @foreach ($posts as $key => $post)
                  <tr>
                    
                    <td>{{$key+1}}</td>
                    <td class="text-left">{{$post->name}}</td>
                    <td class="text-left">{{$post->description}}</td>
                    <td class="text-left">{{$post->phone}}</td>
                    <td>
                      {{$post->created_at->format("D M j Y") }} 
                      <span class="badge badge-warning text-danger">{{$post->created_at->diffForHumans()}}</span>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
             
            </div>
          </div>
          <div class="card-footer">
            {!! $posts->links("pagination::bootstrap-4") !!}            
          </div>
        </div>
        <!-- /.card -->
      </section>
    </div>
  </div><!-- /.container-fluid -->
</section>
@endsection
@push('javascript')


@endpush