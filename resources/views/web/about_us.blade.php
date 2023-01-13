@extends('web.main.app')
@push('seo_title') {{ __('lang.about')}} | @endpush
@push('css')
@endpush
@section('content')
	<div class="container">
		<div class="horizontal">
			<div class="verticals ten offset-by-one">
				<ol class="breadcrumb breadcrumb-fill2 style4">
					<li><a href="{{ route('web.welcome') }}"><i class="fa fa-home"></i></a></li>
					<li class="active">{{ __('lang.about')}}</li>
				</ol>
			</div>
		</div>
	</div>
	
	<div class="clearfix mb-3"></div>

	@forelse ($data_lists as $element)
	<div class="site-half mt-0 pt-0 mb-4" data-aos="fade-up" data-aos-delay="200">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="no-gutters align-items-stretch">
						<div data-aos="fade-up" data-aos-delay="100">
							<span class="caption d-block mb-2 font-secondary font-weight-bold">{{ __('lang.welcome') }}</span>
							<h2 class="site-section-heading text-uppercase font-secondary mb-4">{{$element->title}} </h2>
							<div class="text-justify">
								{!! $element->description !!}
							</div>
						</div>
					</div>
				</div>
				<!-- <div class="col-lg-4">
					<div class="no-gutters align-items-stretch mt-md-5">
						<div data-aos="fade-up" data-aos-delay="100">
							<img src="" class="img-fluid mt-md-5" alt="">
						</div>
					</div>
				</div> -->
			</div>
		</div>
	</div>
	@empty
	<div class="py-5"></div>
	@endforelse
	
@endsection
@push('js')
@endpush