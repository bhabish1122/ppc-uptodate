@extends('web.main.app')
@push('seo_title') {!! $data_list->name ? $data_list->name.' | ' : '' !!} @endpush
@push('css')
<link rel="stylesheet" href="{{URL::to('/')}}/web/css/jquery.fancybox.min.css">
@endpush
@section('content')
  <div class="container">
    <div class="horizontal">
      <div class="verticals ten offset-by-one">
        <ol class="breadcrumb breadcrumb-fill2 style4">
          <li><a href="{{route('web.welcome')}}"><i class="fa fa-home"></i></a></li>
          <li><a href="javascript:void(0);">{{ __('lang.about')}}</a></li>
          <li class="active">{!! $data_list->name !!} {!! $data_list->designation ? ' - '.$data_list->designation : '' !!}</li>
        </ol>
      </div>
    </div>
  </div>
  
  <div class="clearfix mb-3"></div>
  
  <div class="site-section pt-0" data-aos="fade-up">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          @if ($data_list->image_enc)
          <img src="{{ url('image/core_person/'.$data_list->image_enc) }}" class="img-fluid" alt="{{$data_list->name}}">
          @else
          <img src="{{ url('image/noimage.png') }}" class="img-fluid">
          @endif
        </div>
        <div class="col-md">
          <div class="description text-sm-center-main">
            <h3 class="font-weight-bold">
              {!! $data_list->name !!} 
              {!! $data_list->designation ? '<small>('.$data_list->designation.')</small>' : '' !!}
            </h3>
            <!-- <ul class="list-unstyled list">
              @if ($data_list->phone)
              <li class="mb-2 d-flex align-items-center"  data-toggle="tooltip" data-placement="left" data-html="true" title="Phone">
                <i class="fa fa-phone mr-3 text-danger"></i> 
                {!! $data_list->phone !!}
              </li>
              @endif
              @if ($data_list->fax)
              <li class="mb-2 d-flex align-items-center" data-toggle="tooltip" data-placement="left" data-html="true" title="Fax">
                <i class="fa fa-fax mr-3 text-danger"></i> 
                {!! $data_list->fax !!}
              </li>
              @endif
              @if ($data_list->email)
              <li class="mb-2 d-flex align-items-center"  data-toggle="tooltip" data-placement="left" data-html="true" title="Email">
                <i class="far fa-paper-plane mr-3 text-danger"></i> 
                {!! $data_list->email !!}
              </li>
              @endif
              @if ($data_list->from_date)
              <li class="mb-2 d-flex align-items-center"  data-toggle="tooltip" data-placement="left" data-html="true" title="Tenure">
                {{-- <i class="fas fa-handshake mr-3 text-danger"></i> --}}
                <i class="fas fa-briefcase mr-3 text-danger"></i>
                {!! $data_list->from_date !!}
                {!! $data_list->to_date ? ' - '.$data_list->to_date : ' <b class=ml-1> ( '.$data_list->status.' )</b>' !!}
              </li>
              @endif
            </ul> -->
          </div>
          <blockquote class="blockquote text-justify">
            {!! $data_list->description !!}
          </blockquote>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('js')
  <script src="{{URL::to('/')}}/web/js/jquery.fancybox.min.js"></script>
@endpush