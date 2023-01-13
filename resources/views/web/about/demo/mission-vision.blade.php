@extends('web.main.app')
@push('seo_title') Mission & Vision | @endpush
@section('content')
  <div class="container">
    <div class="horizontal">
      <div class="verticals ten offset-by-one">
        <ol class="breadcrumb breadcrumb-fill2 style4">
          <li><a href="{{ route('web.welcome') }}"><i class="fa fa-home"></i></a></li>
          <li><a href="javascript:void(0);">About</a></li>
          <li class="active">Mission & Vision</li>
        </ol>
      </div>
    </div>
  </div>
  <div class="clearfix mb-3"></div>

  <!-- member -->
  <div class="site-section mt-0 pt-0">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-3 text-center mb-5" data-aos="fade-up" data-aos-delay="100">
          <img src="{{URL::to('/')}}/web/images/person_2.jpg" alt="Image" class="img-fluid rounded w-50 mb-4">
          <h2 class="h5 text-uppercase">Person Name</h2>
          <span class="d-block mb-4">DG</span>
        </div>
        <div class="col-md-3 text-center mb-5" data-aos="fade-up" data-aos-delay="200">
          <img src="{{URL::to('/')}}/web/images/person_3.jpg" alt="Image" class="img-fluid rounded w-50 mb-4">
          <h2 class="h5 text-uppercase">Person Name</h2>
          <span class="d-block mb-4">DDG</span> 
        </div>
        <div class="col-md-3 text-center mb-5" data-aos="fade-up" data-aos-delay="300">
          <img src="{{URL::to('/')}}/web/images/person_4.jpg" alt="Image" class="img-fluid rounded w-50 mb-4">
          <h2 class="h5 text-uppercase">Person Name</h2>
          <span class="d-block mb-4">DDG</span>
        </div>
        <div class="col-md-3 text-center mb-5" data-aos="fade-up" data-aos-delay="400">
          <img src="{{URL::to('/')}}/web/images/person_1.jpg" alt="Image" class="img-fluid rounded w-50 mb-4">
          <h2 class="h5 text-uppercase">Person Name</h2>
          <span class="d-block mb-4">DDG</span> 
        </div>
      </div>
      <!-- vision -->
      <div class="no-gutters align-items-stretch">
        <div data-aos="fade-up" data-aos-delay="100">
          <span class="caption d-block mb-2 font-secondary font-weight-bold">Vision</span>
          <h2 class="site-section-heading text-uppercase font-secondary mb-5">Department of Water Resource & Irrigation</h2>
            <ol class="gradient-list">
              <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
              <li>Aenean tincidunt elit at ipsum cursus, vitae interdum nulla suscipit.</li>
              <li>Curabitur in orci vel risus facilisis accumsan.</li>
              <li>Morbi eleifend tortor lacinia sapien sagittis, quis pellentesque felis egestas.</li>
              <li>Aenean viverra dui quis leo lacinia fringilla.</li>
              <li>Sed varius lectus ac condimentum egestas.</li>
              <li>Maecenas faucibus lorem nec lorem posuere, a rhoncus velit porttitor.</li>
            </ol>
        </div>
      </div>
      <!-- mission -->
      <div class="no-gutters align-items-stretch">
        <div data-aos="fade-up" data-aos-delay="100">
          <span class="caption d-block mb-2 font-secondary font-weight-bold">Mission</span>
          <h2 class="site-section-heading text-uppercase font-secondary mb-5">Department of Water Resource & Irrigation</h2>
            <ol class="gradient-list">
              <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
              <li>Aenean tincidunt elit at ipsum cursus, vitae interdum nulla suscipit.</li>
              <li>Curabitur in orci vel risus facilisis accumsan.</li>
              <li>Morbi eleifend tortor lacinia sapien sagittis, quis pellentesque felis egestas.</li>
              <li>Aenean viverra dui quis leo lacinia fringilla.</li>
              <li>Sed varius lectus ac condimentum egestas.</li>
              <li>Maecenas faucibus lorem nec lorem posuere, a rhoncus velit porttitor.</li>
            </ol>
        </div>
      </div>
    </div>  
  </div>

@endsection
@push('js')
@endpush