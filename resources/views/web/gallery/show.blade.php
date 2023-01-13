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
					<li><a href="{{route('web.welcome')}}"><i class="fa fa-home"></i></a></li>
					<li><a href="{{ route('web.gallery.folder') }}">{{ __('lang.gallery')}}</a></li>
					<li class="active">{{$page_title}}</li>
				</ol>
			</div>
		</div>
	</div>

	<div class="clearfix mb-3"></div>
	
	<div class="site-section pt-0">
		<div class="container">
			<div class="row mb-5">
				<div class="col-md-12 text-center" data-aos="fade">
					<span class="caption d-block mb-2 font-secondary font-weight-bold">Photo {{ __('lang.gallery')}}</span>
					<h2 class="site-section-heading text-uppercase text-center font-secondary">{{$page_title}}</h2>
				</div>
			</div>
			<div class="row">
				@forelse ($data_list as $key=>$element)
				<div class=" m-4" data-aos="fade-up" data-aos-delay="{{ $key == 0 ? '' : $key+1 }}00">
					<a href="{{URL::to('/')}}/image/gallery_has_image/{{$element->image_enc}}" data-fancybox="gallery" data-caption="{{$element->image}}">
						<img src="{{URL::to('/')}}/image/gallery_has_image/thumbnail/{{$element->image_enc}}" alt="Image" class="img-fluid">
					</a>
				</div>
				@empty
				@endforelse
				
			</div>
			<div class="d-flex justify-content-center">
				{{$data_list->render("pagination::bootstrap-4")}}
			</div>
		</div>
	</div>
@endsection
@push('js')
	<script src="{{URL::to('/')}}/web/js/jquery.fancybox.min.js"></script>
@endpush