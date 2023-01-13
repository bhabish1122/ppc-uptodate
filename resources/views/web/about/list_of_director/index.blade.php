@extends('web.main.app')
@push('seo_title') {{ __('lang.list_of_director_generals')}} |  @endpush
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
          <li class="active">{{ __('lang.list_of_director_generals')}}</li>
        </ol>
      </div>
    </div>
  </div>
  
  <div class="clearfix mb-3"></div>
  
  <div class="site-section pt-0" data-aos="fade-up">
    <div class="container">
      <div class="table-responsive">
        <table class="table table-hover table-striped table-bordered">
          <thead class="bg-dark text-light text-center">
            <tr class="vertical-align-middle">
              <th rowspan="2" width="5%">{{ __('lang.sn') }}</th>
              <th rowspan="2" width="30%">Name of Director General</th>
              <th rowspan="2" width="10%">Designation</th>
              <th width="10%" rowspan="2">Photo</th>
              <th colspan="2" width="30%">Tenure</th>
              <th rowspan="2">Remarks</th>
            </tr>
            <tr>
              <th class="text-center" width="150">From</th>
              <th class="text-center" width="150">To</th>
            </tr>
          </thead>
          <tbody class="text-center">
            @foreach($listofdirectors as $key=>$director)
            <tr class="vertical-align-middle">
              <td>{{$key+1}}</td>
              <td class="text-left">
                <a href="{{ route('web.about.list-of-director-generals.show',$director->id) }}">{{$director->name}}</a>
              </td>
              <td>{{$director->designation}}</td>
              <td>
                @if ($director->image_enc)
                  <a href="{{URL::to('/')}}/image/core_person/{{$director->image_enc}}" data-fancybox="gallery" data-caption="{{$director->name}} <br> {{$director->from_date}} {{$director->to_date ? '- '.$director->to_date : ''}}">
                    <img src="{{URL::to('/')}}/image/core_person/thumbnail/{{$director->image_enc}}" alt="{{$director->name}}" title="Click here" class="img-fluid">
                  </a>
                @endif
              </td>
              <td>{{$director->from_date}}</td>
              <td>{{$director->to_date}}</td>
              {{-- <td class="text-{{  $director->status == "1" ? "success" : ($director->status =="2" ? "danger" : "info") }} font-weight-bolder text-capitalize">
                {{  $director->status == "1" ? "current working" : ($director->status =="2" ? "retired" : "transferred") }}
              </td> --}}
              <td class="text-dark font-weight-bolder text-capitalize">
                {{$director->status}}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table> 
      </div>
    </div>
  </div>
@endsection
@push('js')
  <script src="{{URL::to('/')}}/web/js/jquery.fancybox.min.js"></script>
@endpush