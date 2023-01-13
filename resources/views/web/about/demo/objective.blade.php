@extends('web.main.app')
@push('seo_title') Objective | @endpush
@section('content')
  <div class="container">
    <div class="horizontal">
      <div class="verticals ten offset-by-one">
        <ol class="breadcrumb breadcrumb-fill2 style4">
          <li><a href="{{ route('web.welcome') }}"><i class="fa fa-home"></i></a></li>
          <li><a href="javascript:void(0);">About</a></li>
          <li class="active">Objective</li>
        </ol>
      </div>
    </div>
  </div>
  
  <div class="clearfix mb-3"></div>

  <!-- objective -->
  <div class="site-half mt-0 pt-0" data-aos="fade-up" data-aos-delay="200">
    <div class="container">
      <div class="row no-gutters align-items-stretch">
        <div class="col-lg-12 ml-lg-auto py-5">
          <span class="caption d-block mb-2 font-secondary font-weight-bold">Objective</span>
          <h2 class="site-section-heading text-uppercase font-secondary mb-5">Department of Water Resource & Irrigation</h2>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus aliquid eius facilis voluptatem eligendi magnam accusamus vel commodi asperiores sint rem reprehenderit nobis nesciunt veniam qui fugit doloremque numquam quod.</p>

          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consectetur tempora distinctio ipsam nesciunt recusandae repellendus asperiores amet.</p>  
        </div>
      </div>
    </div>
  </div>
@endsection
@push('js')
@endpush