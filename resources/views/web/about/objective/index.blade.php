@extends('web.main.app')
@push('seo_title') {{ __('lang.objective')}} | @endpush
@section('content')
  <div class="container">
    <div class="horizontal">
      <div class="verticals ten offset-by-one">
        <ol class="breadcrumb breadcrumb-fill2 style4">
          <li><a href="{{ route('web.welcome') }}"><i class="fa fa-home"></i></a></li>
          <li><a href="javascript:void(0);">{{ __('lang.about')}}</a></li>
          <li class="active">{{ __('lang.objective')}}</li>
        </ol>
      </div>
    </div>
  </div>
  
  <div class="clearfix mb-3"></div>

  <!-- objective -->
  <div class="site-half mt-0 pt-0" data-aos="fade-up" data-aos-delay="200">
    <div class="container">
      <div class="row no-gutters align-items-stretch">
        @if($objectives)
        @foreach($objectives as $objective)
        <div class="col-lg-12 ml-lg-auto py-5">
          <span class="caption d-block mb-2 font-secondary font-weight-bold">{{ __('lang.objective')}}</span>
          <h2 class="site-section-heading text-uppercase font-secondary mb-5">{{$objective->title}}</h2>
          <p>{!!$objective->description!!}</p>

        </div>
        @endforeach
        @endif
      </div>
    </div>
  </div>
@endsection
@push('js')
@endpush