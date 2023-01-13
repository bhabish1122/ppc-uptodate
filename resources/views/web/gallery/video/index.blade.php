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
				<div class="table-responsive" id="printTable">
				  <table class="table table-hover table-striped table-bordered">
				    <thead class="bg-dark text-light text-center">
				      <tr>
				        <th width="5%">{{ __('lang.sn') }}</th>
				        <th>{{ __('lang.title') }}</th>
				        <th>{{ __('lang.date_s') }}</th>
				        <th>{{ __('lang.video') }}</th>
				      </tr>
				    </thead>
				    <tbody class="text-center">
				      @forelse($data_lists as $key=>$element)
				      <tr>
				        <td class=" align-middle">{{$key+1}}</td>
				        <td class=" align-middle">{{ $element->title }}</td>
				        <td class=" align-middle">{{ $element->created_at->diffForHumans() }}</td>
				        <td class=" align-middle">
				        	<a class="btn btn-sm btn-outline-danger" href="{{ $element->link }}" data-fancybox="gallery" data-caption="{{$element->title}}"><i class="fas fa-link"></i></a>
				        </td>
				      </tr>
				      @empty
				      @endforelse
				    </tbody>
				  </table> 
				</div>
				{{-- <div class=" m-4" data-aos="fade-up" data-aos-delay="{{ $key == 0 ? '' : $key+1 }}00">
					<a href="{{URL::to('/')}}/image/gallery_has_image/{{$element->image_enc}}" data-fancybox="gallery" data-caption="{{$element->image}}">
						<img src="{{URL::to('/')}}/image/gallery_has_image/thumbnail/{{$element->image_enc}}" alt="Image" class="img-fluid">
					</a>
				</div> --}}
				
			<div class="d-flex justify-content-center">
				{{$data_lists->render("pagination::bootstrap-4")}}
			</div>
		</div>
	</div>
@endsection
@push('js')
	<script src="{{URL::to('/')}}/web/js/jquery.fancybox.min.js"></script>
@endpush