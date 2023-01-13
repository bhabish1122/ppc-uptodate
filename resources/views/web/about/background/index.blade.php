@extends('web.main.app')
@push('seo_title') {{ __('lang.background')}} |  @endpush
@section('content')
  <!-- slider --> 
  @if ($backgrounds_sliders->count())
  <div class="slide-one-item home-slider owl-carousel">
    @foreach ($backgrounds_sliders as $element)
    <div class="site-blocks-cover inner-page overlay" style="background-image: url({{URL::to('/')}}/image/background_slider/{{$element->image_enc}});" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-6 text-center" data-aos="fade">
            <h2 class="text-light font-secondary font-weight-bold text-uppercase">{{$element->title}}</h2>
          </div>
        </div>
      </div>
    </div>  
    @endforeach
  </div>  
  <div class="slant-1"></div>
  @else
  <div class="py-5"></div>
  <div class="py-3"></div>
  @endif


  <!-- background -->
  @if(count($backgrounds))
  <div class="site-half first-section mt-0" data-aos="fade-up" data-aos-delay="200">
    <div class="container">
      <div class="row no-gutters align-items-stretch">
        @foreach($backgrounds as $background)
        <div class="col-lg-12 ml-lg-auto py-5 text-justify">
          <span class="caption d-block mb-2 font-secondary font-weight-bold">{{ __('lang.background')}}</span>
          <h2 class="site-section-heading text-uppercase font-secondary mb-5">{{$background->title}}</h2>
          {!! $background->description !!}
        </div>
        @endforeach
      </div>
    </div>
  </div>
  @else
  <div class="py-5"></div>
  @endif
@endsection
@push('js')
@endpush