@extends('web.main.app')
@push('seo_title') {{ __('lang.employee_list')}} |  @endpush
@section('content')
  <div class="container">
    <div class="horizontal">
      <div class="verticals ten offset-by-one">
        <ol class="breadcrumb breadcrumb-fill2 style4">
          <li><a href="{{route('web.welcome')}}"><i class="fa fa-home"></i></a></li>
          <li><a href="#">{{ __('lang.about')}}</a></li>
          <li class="active">{{ __('lang.employee_list')}}</li>
        </ol>
      </div>
    </div>
  </div>

  <div class="clearfix mb-3"></div>

  <div class="site-section pt-0" data-aos="fade-up">
    <div class="container">
      <div class="table-responsive" id="printTable">
        <table class="table table-hover table-striped table-bordered">
          <thead class="bg-dark text-light text-center">
            <tr>
              <th width="5%">{{ __('lang.sn') }}</th>
              <th width="10%">{{ __('lang.photo') }}</th>
              <th>{{ __('lang.full_name') }}</th>
              <th>{{ __('lang.designation') }}</th>
              <th>{{ __('lang.department') }}</th>
              <th>{{ __('lang.contact') }}</th>
              <th>{{ __('lang.email') }}</th>
            </tr>
          </thead>
          <tbody class="text-center">
            {{-- put model box for on click btn --}}
            @forelse($sectiondetails as $key=>$sectiondetail)
            <tr>
              <td class=" align-middle">{{$key+1}}</td>
              <td class=" align-middle">
                <a href="{{ route('web.about.list-of-director-generals.show',$sectiondetail->id) }}" class="text-hover-a">
                <img src="{{ url($sectiondetail->image_enc ? 'image/core_person/'.$sectiondetail->image_enc : 'image/noimage.png') }}" class="img-fluid" alt="{{ $sectiondetail->title }}">
              </a>
              </td>
              <td class="align-middle">
                <a href="{{ route('web.about.list-of-director-generals.show',$sectiondetail->id) }}" class="text-hover-a">
                {{ $sectiondetail->name }}
              </a>
            </td>
              <td class=" align-middle">{{ $sectiondetail->designation }}</td>
              <td class=" align-middle">{{ $sectiondetail->department }}</td>
              <td class=" align-middle">{{ $sectiondetail->phone }}</td>
              <td class=" align-middle">{{ $sectiondetail->email }}</td>
            </tr>
            @empty
            @endforelse
          </tbody>
        </table> 
        <div class="d-flex justify-content-center">
          {{$sectiondetails->render("pagination::bootstrap-4")}}
        </div>
      </div>
    </div>
  </div>
@endsection
@push('js')
@endpush