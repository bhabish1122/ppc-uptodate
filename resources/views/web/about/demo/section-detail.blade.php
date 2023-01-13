@extends('web.main.app')
@push('seo_title') {{ __('lang.section_detail')}} | @endpush
@section('content')
  <div class="container">
    <div class="horizontal">
      <div class="verticals ten offset-by-one">
        <ol class="breadcrumb breadcrumb-fill2 style4">
          <li><a href="{{route('web.welcome')}}"><i class="fa fa-home"></i></a></li>
          <li><a href="#">{{ __('lang.about')}}</a></li>
          <li class="active">{{ __('lang.section_detail')}}</li>
        </ol>
      </div>
    </div>
  </div>

  <div class="clearfix mb-3"></div>

  <div class="site-section pt-0" data-aos="fade-up">
    <div class="container d-flex justify-content-center">
      <iframe src="{{URL::to('/')}}/web/file/file.pdf" height="600px" width="800px" scrolling="auto"></iframe>
    </div>
  </div>
@endsection
@push('js')
@endpush