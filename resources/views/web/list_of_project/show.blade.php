@extends('web.main.app')
@push('seo_title') {{ __('lang.list_of_project').' | ' }} {{$sub_title ? $sub_title.' | ' : ''}} @endpush
@push('css')
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/web/css/print.main.css">
@endpush
@section('content')
	<div class="container">
		<div class="horizontal">
			<div class="verticals ten offset-by-one">
				<ol class="breadcrumb breadcrumb-fill2 style4">
					<li><a href="{{ route('web.welcome') }}"><i class="fa fa-home"></i></a></li>
					<li>{{ __('lang.list_of_project')}}</li>
					<li class="active">{{Str::limit($sub_title, 90)}}</li>
				</ol>
			</div>
		</div>
	</div>

	<div class="clearfix mb-3"></div>

	@forelse ($list_of_projects as $element)
	<div class="site-section pt-0" data-aos="fade-up">
		<div class="container">
			<button onclick="PrintDiv('printTable')" target="_blank" class="btn btn-md btn-outline-dark mb-3" data-toggle="tooltip" data-placement="right" data-html="true" title="<small>{{ __('lang.download')}}</small>"><i class="fa fa-download"></i></button>
			<div class="row" id="printTable">
				<div class="col-lg-12">
					<div class="no-gutters align-items-stretch">
						<div data-aos="fade-up" data-aos-delay="100">
							<h2 class="site-section-heading text-uppercase font-secondary mb-4">{{$element->title}} </h2>
							<div>
								{!! $element->description !!}
							</div>
						</div>
					</div>
					@if ($element->link)
					<div class="float-right print-0">
						<a class="effect1" href="{{$element->link}}" target="_blank">
							Visit Site
							<span class="bg"></span>
						</a>
					</div>
					@endif
				</div> 
			</div>
		</div>
	</div>
	@empty
	<div class="py-5"></div>
	@endforelse
@endsection
@push('js')
<script src="{{URL::to('/')}}/web/js/print.main.js"></script>
@endpush