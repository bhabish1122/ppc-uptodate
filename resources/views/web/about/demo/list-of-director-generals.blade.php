@extends('web.main.app')
@push('seo_title') {{ __('lang.list_of_director_generals')}} | @endpush
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
            <tr>
              <th rowspan="2" style="width: 20px;vertical-align: inherit;">{{ __('lang.sn') }}</th>
              <th colspan="2">Tenure</th>
              <th rowspan="2" style="vertical-align: inherit;">Name of DG</th>
              <th rowspan="2" style="vertical-align: inherit;" width="200">Remark</th>
            </tr>
            <tr>
              <th class="text-center" width="150">From</th>
              <th class="text-center" width="150">To</th>
            </tr>
          </thead>
          <tbody class="text-center">
            <tr>
              <td>1</td>
              <td>2016/01/10</td>
              <td>2016/01/10</td>
              <td class="text-left">Person Name</td>
              <td class="text-danger font-weight-bolder">
                Retired
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td>2016/01/10</td>
              <td>2016/01/10</td>
              <td class="text-left">Person Name</td>
              <td class="text-info font-weight-bolder">
                Transfer
              </td>
            </tr>
            <tr>
              <td>2</td>
              <td>2016/01/10</td>
              <td>2016/01/10</td>
              <td class="text-left">Person Name</td>
              <td class="text-success font-weight-bolder">
                Currently Acting
              </td>
            </tr>
          </tbody>
        </table> 
      </div>
    </div>
  </div>
@endsection
@push('js')
@endpush