@extends('web.main.app')
@push('seo_title') {{$page_title ? $page_title.' | ' : ''}} {{ $sub_title ? $sub_title.' | ' : '' }} @endpush
@push('css')
@endpush
@section('content')
	<div class="container">
		<div class="horizontal">
			<div class="verticals ten offset-by-one">
				<ol class="breadcrumb breadcrumb-fill2 style4">
					<li><a href="{{ route('web.welcome') }}"><i class="fa fa-home"></i></a></li>
					<li>{{ __('lang.notice')}}</li>
					<li>{{$page_title}}</li>
				</ol>
			</div>
		</div>
	</div>

	<div class="clearfix mb-3"></div>

	@forelse ($data_list as $element)
	<div class="site-half mt-0 pt-0 mb-4" data-aos="fade-up" data-aos-delay="200">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="no-gutters align-items-stretch">
						<div data-aos="fade-up" data-aos-delay="100">
							<h2 class="site-section-heading text-uppercase font-secondary mb-4">{{$element->title}} </h2>
							<small>{{ Date('j F, Y',strtotime($element->date)) }}</small>
							<div>
								{!! $element->description !!}
							</div>
						</div>
					</div>
					<div class="float-right">
						<a class="effect1" href="{{URL::to('/')}}/files/notice/{{$element->image_enc}}" target="_blank">
							{{ __('lang.download')}}
							<span class="bg"></span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	@empty
	<div class="py-5"></div>
	@endforelse
@endsection
@push('js')
@endpush