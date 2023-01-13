@extends('web.main.app')
@push('seo_title') {{ __('lang.mission_vision')}} |  @endpush
@section('content')
  <div class="container">
    <div class="horizontal">
      <div class="verticals ten offset-by-one">
        <ol class="breadcrumb breadcrumb-fill2 style4">
          <li><a href="{{ route('web.welcome') }}"><i class="fa fa-home"></i></a></li>
          <li><a href="javascript:void(0);">{{ __('lang.about')}}</a></li>
          <li class="active">{{ __('lang.mission_vision')}}</li>
        </ol>
      </div>
    </div>
  </div>
  <div class="clearfix mb-3"></div>

  <!-- member -->
  <div class="site-section mt-0 py-0">
    <div class="container">
      <div class="row justify-content-center">
        @foreach ($core_persons as $key=>$person)
        <div class="col-md-{{$key == 0 ? '12' : '3'}} text-center mb-5" data-aos="fade-up" data-aos-delay="{{$key+1}}00">
          <img src="{{URL::to('/')}}/image/core_person/{{$person->image_enc}}" alt="Image" class="img-fluid rounded {{$key == 0 ? 'w-12' : 'w-50'}} mb-4">
          <h2 class="h5 text-uppercase">{{$person->name}}</h2>
          <span class="d-block mb-4">{{$person->designation}}</span>
        </div>
        @endforeach
      </div>
      <!-- vision -->
      @if(count($visions))
      <div class="no-gutters align-items-stretch">
        <div data-aos="fade-up" data-aos-delay="100">
          {{-- <span class="caption d-block mb-2 font-secondary font-weight-bold">Vision (दुरदृष्टि)</span> --}}
          <h2 class="site-section-heading text-uppercase font-secondary mb-5">{{ __('lang.vision')}}</h2>
            <ol class="gradient-list">
              @foreach($visions as $vision)
              <li>{!!$vision->description!!}</li>
              @endforeach
            </ol>
        </div>
      </div>
      @endif
      <!-- mission -->
      @if(count($missions))
      <div class="no-gutters align-items-stretch mt-5">
        <div data-aos="fade-up" data-aos-delay="100">
          {{-- <span class="caption d-block mb-2 font-secondary font-weight-bold">Goal and Mission (लक्ष्य तथा ध्येय)</span> --}}
          <h2 class="site-section-heading text-uppercase font-secondary mb-5">{{ __('lang.goal_and_mission')}}</h2>
            <ol class="gradient-list">
              @foreach($missions as $mission)
              <li>{!!$mission->description!!}</li>
              @endforeach
            </ol>
        </div>
      </div>
      @endif
    </div>  
  </div>

@endsection
@push('js')
@endpush