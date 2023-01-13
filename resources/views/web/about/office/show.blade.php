@extends('web.main.app')
@push('seo_title') {{$page_title ? $page_title.' | ' : ''}}  @endpush
@push('css')
<link rel="stylesheet" href="{{URL::to('/')}}/web/css/jquery.fancybox.min.css">
@endpush
@section('content')
	<div class="container">
		<div class="horizontal">
			<div class="verticals ten offset-by-one">
				<ol class="breadcrumb breadcrumb-fill2 style4">
					<li><a href="{{ route('web.welcome') }}"><i class="fa fa-home"></i></a></li>
					<li>{{ __('lang.about')}}</li>
					<li class="active">{{$page_title}}</li>
				</ol>
			</div>
		</div>
	</div>

	<div class="clearfix mb-3"></div>
	@forelse($data_lists as $element)
	<div class="site-half mt-0 pt-0" data-aos="fade-up" data-aos-delay="200">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="no-gutters align-items-stretch">
						<div data-aos="fade-up" data-aos-delay="100">
							<h2 class="site-section-heading text-uppercase font-secondary mb-5">{{$element->name}} ({{$element->contact_no}})</h2>
							{{$element->office}}
							{!!  $element->description !!}
							<div>
								{!!  $element->division_work !!}
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 mt-sm-4 mt-xs-4">
					<div class="mb-5" data-aos="fade-up" data-aos-delay="300">
						<div class="user-profile-container">
							@if($element->image == "null")
							<div class="user-profile" style="background-image: url('{{URL::to('/')}}/image/noimage.jpg');">
								<b class="bg-dark px-3 rounded-top">{{$element->name}}</b>
							</div>
							@else
							<div class="user-profile" style="background-image: url('{{URL::to('/')}}/image/division_section/{{$element->image_enc}}');">
								<b class="bg-dark px-3 rounded-top">{{$element->name}}</b>
							</div>
							
							@endif
							<ul class="user-info px-4 text-center">
								<li>
									<h4>{{$element->designation}}</h4>
								</li>
							</ul>
						</div>
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
	<script src="{{URL::to('/')}}/web/js/jquery.fancybox.min.js"></script>
@endpush