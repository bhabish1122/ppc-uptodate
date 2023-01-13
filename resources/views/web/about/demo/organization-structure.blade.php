@extends('web.main.app')
@push('seo_title') {{ __('lang.organizational_structure')}} | @endpush
@section('content')
  <div class="container">
    <div class="horizontal">
      <div class="verticals ten offset-by-one">
        <ol class="breadcrumb breadcrumb-fill2 style4">
          <li><a href="{{route('web.welcome')}}"><i class="fa fa-home"></i></a></li>
          <li><a href="#">{{ __('lang.about')}}</a></li>
          <li class="active">{{ __('lang.organizational_structure')}}</li>
        </ol>
      </div>
    </div>
  </div>

  <div class="clearfix mb-3"></div>
  
  <div class="site-section pt-0" data-aos="fade">
    <div class="container">
      <div class="row">
        <div class="col-lg-10">
          <div id="panzoom" style="text-align: center">
            <img src="{{URL::to('/')}}/web/images/organizational_chart.jpg" class="img-fluid">
          </div>
        </div>
        <div class="col-lg-2">
          <input type="range" class="zoom-range w-100">
          <button class="zoom-in btn btn-block btn-outline-info">Zoom In</button>
          <button class="zoom-out btn btn-block btn-outline-info">Zoom Out</button>
          <button class="reset btn btn-block btn-outline-danger">Reset</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('js')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.panzoom/2.0.6/jquery.panzoom.min.js"></script>
  <script type="text/javascript">
    $("#panzoom").panzoom({
      $zoomIn: $(".zoom-in"),
      $zoomOut: $(".zoom-out"),
      $zoomRange: $(".zoom-range"),
      $reset: $(".reset"),
      contain: 'invert',
    });
  </script>
@endpush