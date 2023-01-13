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
					<li>{{ __('lang.division')}}</li>
					<li class="active">{{$page_title}}</li>
				</ol>
			</div>
		</div>
	</div>

	<div class="clearfix mb-3"></div>
	
	@forelse ($data_list as $element)
	<div class="site-half mt-0 pt-0" data-aos="fade-up" data-aos-delay="200">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="no-gutters align-items-stretch">
						<div data-aos="fade-up" data-aos-delay="100">
							<h2 class="site-section-heading text-uppercase font-secondary mb-5">{{$element->title}}</h2>
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
							<div class="user-profile" style="background-image: url('{{URL::to('/')}}/image/division_section/{{$element->image_enc}}');">
								<b class="bg-dark px-3 rounded-top">{{$element->name}}</b>
							</div>
							<ul class="user-info px-4 text-center">
								<li>
									<h4>{{$element->designation}}</h4>
								</li>
							</ul>
						</div>
					</div>
					@if ($core_persone_list->count())
					<div class="row justify-content-center">
						@foreach($core_persone_list as $key=>$coreperson)
						<div class="col-md-6 text-center mb-5" data-aos="fade-up" data-aos-delay="{{$key+1}}00">
							@if ($coreperson->image_enc)
							<a href="{{URL::to('/')}}/image/core_person/{{$coreperson->image_enc}}" data-fancybox="gallery" data-caption="{{$coreperson->name}} <br> {{$coreperson->designation}}">
								<img src="{{URL::to('/')}}/image/core_person/thumbnail/{{$coreperson->image_enc}}" alt="{{$coreperson->name}}" title="Click here" class="img-fluid rounded w-50 mb-4">
							</a>
							@endif
							<h2 class="h5 text-uppercase">{{$coreperson->name}}</h2>
							<small class="d-block mb-0">{{$coreperson->designation}}</small>
							<small class="d-block mb-4">{{$coreperson->division}}</small>
						</div>
						@endforeach
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
	@empty
	<div class="py-5"></div>
	@endforelse
	{{-- @if ($core_persone_list->count())
	<div class="site-section py-4">
	  <div class="container">
	    <div class="row justify-content-center">
	      @foreach($core_persone_list as $key=>$coreperson)
	      <div class="col-md-2 text-center mb-5" data-aos="fade-up" data-aos-delay="{{$key+1}}00">
	      	@if ($coreperson->image_enc)
	      	<a href="{{URL::to('/')}}/image/core_person/{{$coreperson->image_enc}}" data-fancybox="gallery" data-caption="{{$coreperson->name}} <br> {{$coreperson->from_date}} {{$coreperson->to_date ? '- '.$coreperson->to_date : ''}}">
	      		<img src="{{URL::to('/')}}/image/core_person/thumbnail/{{$coreperson->image_enc}}" alt="{{$coreperson->name}}" title="Click here" class="img-fluid rounded w-50 mb-4">
	      	</a>
	      	@endif
	      	<h2 class="h5 text-uppercase">{{$coreperson->name}}</h2>
	      	<span class="d-block mb-4">{{$coreperson->designation}}</span>
	      </div>
	      @endforeach
	    </div>
	  </div>
	</div>
	@endif --}}
@endsection
@push('js')
	<script src="{{URL::to('/')}}/web/js/jquery.fancybox.min.js"></script>
@endpush