@extends('web.main.app')
@push('seo_title')   @endpush
@section('content')
  <!-- slider -->
  <div class="slide-one-item home-slider owl-carousel">
    
    <div class="site-blocks-cover inner-page overlay" style="background-image: url({{URL::to('/')}}/web/images/slide_1.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-6 text-center" data-aos="fade">
            <h2 class="text-light font-secondary font-weight-bold text-uppercase">Welcome to</h2>
          </div>
        </div>
      </div>
    </div>  

    <div class="site-blocks-cover inner-page overlay" style="background-image: url({{URL::to('/')}}/web/images/slide_2.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7 text-center" data-aos="fade">
            <h2 class="text-light font-secondary font-weight-bold text-uppercase">Department of Water Resource & Irrigation</h2>
          </div>
        </div>
      </div>
    </div> 
  </div>  

  <div class="slant-1"></div>

  <!-- background -->
  <div class="site-half first-section mt-0" data-aos="fade-up" data-aos-delay="200">
    <div class="container">
      <div class="row no-gutters align-items-stretch">
        <div class="col-lg-12 ml-lg-auto py-5">
          <span class="caption d-block mb-2 font-secondary font-weight-bold">{{ __('lang.background')}}</span>
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