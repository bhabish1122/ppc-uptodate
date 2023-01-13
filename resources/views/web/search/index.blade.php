@extends('web.main.app')
@push('seo_title') {{$search_title}} |  @endpush
@push('css')
@endpush
@section('content')
	<div class="container">
		<div class="horizontal">
			<div class="verticals ten offset-by-one">
				<ol class="breadcrumb breadcrumb-fill2 style4">
					<li><a href="{{ route('web.welcome') }}"><i class="fa fa-home"></i></a></li>
					<li>{{ __('lang.search_for')}}</li>
					<li class="active">{{$search_title}}</li>
				</ol>
			</div>
		</div>
	</div>

	<div class="clearfix mb-3"></div>
	
	<div class="site-half">
		<div class="container">
			<form class="pb-3" method="GET" action="{{ route('web.search.result') }}" autocomplete="off">
				@csrf
				<div class="row">
					<div class="col-md-10">
						<div class="form-group">
							<input type="text" class="form-control h-auto" name="title" id="title" value="{{$search_title}}" placeholder="{{ __('lang.search')}}...">
						</div>
						
						<div class="d-flex">
							<div class="custom-control custom-radio mr-4">
							  <input type="radio" id="notice1" name="selected" value="1" class="custom-control-input" {{$selected == '1' || $selected == 'null' ? 'checked': ''}}>
							  <label class="custom-control-label" for="notice1">{{ __('lang.notice')}}</label>
							</div>
							<div class="custom-control custom-radio mr-4">
							  <input type="radio" id="document1" name="selected" value="2" class="custom-control-input" {{$selected == '2' ? 'checked': ''}}>
							  <label class="custom-control-label" for="document1">{{ __('lang.document')}}</label>
							</div>
							<div class="custom-control custom-radio mr-4">
							  <input type="radio" id="report1" name="selected" value="3" class="custom-control-input" {{$selected == '3' ? 'checked': ''}}>
							  <label class="custom-control-label" for="report1">{{ __('lang.report')}}</label>
							</div>
						</div>
					</div>
					<div class="col-md-2">
						<button type="submit" class="btn btn-outline-danger btn-block">{{ __('lang.search')}}</button>
					</div>
				</div>
			</form>
			<ul class="list-main list-inline">
				@forelse ($search_result as $element)
				<li>
					<div class="d-flex flex-row">
						{{-- <i class="fa fa-check-circle checkicon"></i> --}}
						<div class="ml-2">
							{{-- <a href="{{URL::to('/')}}/" class="d-flex justify-content-between"> --}}
								<h4 class="mb-0">{{$element->title}}</h4>
							{{-- </a> --}}
							<div class="d-flex flex-row mt-1 text-black-50 date-time">
								@if ($element->image_enc)
								<div class="mr-4">
									<a href="{{URL::to('/')}}/files/{{$search_selected}}/{{$element->image_enc}}" class="text-danger" download>
										<i class="fas fa-download"></i>
										<span class="ml-2"><small>Download File</small></span>
									</a>
								</div>
								@endif
								<div>
									<i class="far fa-calendar-alt"></i>
									<span class="ml-2"><small>{{ Date('j F, Y',strtotime($element->created_at)) }}</small></span>
								</div>
							</div>
						</div>
					</div>
				</li>
				@empty
				<li>No Result found.</li>
				@endforelse
			</ul>
			<div class="d-flex justify-content-center">
				{{$search_result->render("pagination::bootstrap-4")}}
			</div>
		</div>
	</div>
	
@endsection
@push('js')
@endpush