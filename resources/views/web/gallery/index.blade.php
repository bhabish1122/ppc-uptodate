@extends('web.main.app')
@push('seo_title') {{ __('lang.gallery')}} |  @endpush
@push('css')
<link rel="stylesheet" href="{{URL::to('/')}}/web/css/gallery.main.css">
@endpush
@section('content')
	<div class="container">
		<div class="horizontal">
			<div class="verticals ten offset-by-one">
				<ol class="breadcrumb breadcrumb-fill2 style4">
					<li><a href="{{route('web.welcome')}}"><i class="fa fa-home"></i></a></li>
					<li class="active">{{ __('lang.gallery')}}</li>
				</ol>
			</div>
		</div>
	</div>
 	
 	<div class="clearfix mb-3"></div>
 	
 	<div class="site-section pt-0">
 		<div class='container'>
 			<div class="row">
 				@foreach($galleries as $gallery)
 				@php
 					$gallery_img_link = $gallery->galleryImage();
 					$img_show = $gallery_img_link->inRandomOrder()->limit(3)->get();
 					$count_img = $gallery_img_link->count();
 				@endphp
 				@if ($count_img)
 				<div class="col-lg-3">
 					<a href="{{ route('web.gallery.show', $gallery->slug) }}">
 						<div class='thumb album-thumb'>
 							<div class='thumb-container'>
 								<div class='images-container'>
 									@forelse ($img_show as $gallery_img)
 										{{-- expr --}}
	 									<img class='thumb-image' src='{{URL::to('/')}}/image/gallery_has_image/thumbnail/{{$gallery_img->image_enc}}'>
	 								@empty
	 									<img class='thumb-image' src='{{URL::to('/')}}/images/gallery_has_image/'>
 									@endforelse
 								</div>
 								<div class='photo-count'>
 									<div class='content'>
 										<div class='number'>{{$count_img}}</div>
 										{{-- <div class='label'>{{$gallery->title}}</div> --}}
 									</div>
 								</div>
 							</div>
 							<div class='title font-weight-bold'>
 								{{$gallery->title}}
 							</div>
 						</div>
 					</a>
 				</div>
 				@endif
 				@endforeach
 				<div class="d-flex justify-content-center">
 					{{$galleries->render("pagination::bootstrap-4")}}
 				</div>
 			</div>
 		</div>
 	</div>
@endsection
@push('js')
@endpush