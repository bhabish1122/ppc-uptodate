@extends('web.main.app')
@push('seo_title') {{ $page_title }} |  @endpush
@section('content')
  <div class="container">
    <div class="horizontal">
      <div class="verticals ten offset-by-one">
        <ol class="breadcrumb breadcrumb-fill2 style4">
          <li><a href="{{route('web.welcome')}}"><i class="fa fa-home"></i></a></li>
          <li class="active">{{ $page_title }}</li>
        </ol>
      </div>
    </div>
  </div>

  <div class="clearfix mb-3"></div>

  <div class="site-section pt-0" data-aos="fade-up">
    <div class="container">
      <div class="row">
        @forelse ($data_lists as $key=>$element)
        <div class="col-md-6">
          <div data-aos="fade-up" data-aos-delay="{{$key+1}}00">
            <div class="coupon bg-light rounded px-3 mb-3 d-flex justify-content-between border-dark coupon-shadow" data-toggle="tooltip" data-placement="right" data-html="true" title="<small>{{ __('lang.download')}}</small>">
              <div class="py-3 w-100 justify-content-start">
                <div class="d-block mr-2">
                    {{ mb_substr($element->title,0,50,"......") }}</h3>
                  <small>{{ $element->created_at->diffForHumans() == '1 day ago' ? Date('j F, Y', strtotime($element->created_at)) : $element->created_at->diffForHumans() }}</small>
                </div>
              </div>
              <div class="kanan">
                <span class="download-section"></span>
              </div>
              <a href="{{URL::to('/')}}/files/document/{{$element->image_enc}}" target="_blank" class="d-flex align-items-center text-danger text-center">
                <div class="m-3 w-100">
                  <i class="fas fa-file-pdf fa-3x"></i> 
                  {{-- {{ __('lang.download')}} --}}
                </div>
              </a>
            </div>
          </div>
        </div>
        @empty
        <h3 class="py-5">Update coming soon...</h3>
        @endforelse
      </div>
      @if ($data_lists->hasPages())
      <div class="my-3">
        {{ $data_lists->links() }}
      </div>
      @endif
    </div>
  </div>
@endsection
@push('js')
@endpush