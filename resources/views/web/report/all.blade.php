@extends('web.main.app')
@push('seo_title') {{ __('lang.report')}} |  @endpush
@push('css')
@endpush
@section('content')
	<div class="container">
		<div class="horizontal">
			<div class="verticals ten offset-by-one">
				<ol class="breadcrumb breadcrumb-fill2 style4">
					<li><a href="{{ route('web.welcome') }}"><i class="fa fa-home"></i></a></li>
					<li class="active">{{ __('lang.report')}}</li>
				</ol>
			</div>
		</div>
	</div>

	<div class="clearfix mb-3"></div>
	
	<div class="site-half mt-0 pt-0" data-aos="fade-up" data-aos-delay="100">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					@forelse ($data_list as $key=>$element)
					<div class="no-gutters align-items-stretch">
						<div data-aos="fade-up" data-aos-delay="{{$key+1}}00">
							<div class="coupon bg-light rounded px-3 mb-3 d-flex justify-content-between border-dark coupon-shadow" data-toggle="tooltip" data-placement="right" data-html="true" title="<small>{{ __('lang.download')}}</small>">
								<div class="py-3 d-flex w-100 justify-content-start">
									<div>
										<h3 class="lead">{{$element->title}}</h3>
										<div class="text-muted mb-0">
											{!! strip_tags(mb_substr($element->description,0,50,"......")) !!}
										</div>
										@php
										if($element->page = 1){
											$page == 'pre-feasibility';
										}
										if($element->page = 2){
											$page == 'feasibility';
										}
										if($element->page = 3){
											$page == 'detail-feasibility';
										}
										if($element->page = 4){
											$page == 'detail-design';
										}
										if($element->page = 5){
											$page == 'pipeline-project';
										}
										@endphp
										<div class="float-right">
											<a class="fade00" href="{{ route('web.report.show', [$page, $element->slug ]) }}">
												{{ __('lang.read_more')}}
												<span class="bg"></span>
											</a>
										</div>
										<small>{{$element->created_at->diffForHumans()}}</small>
									</div>
								</div>
								<div class="kanan">
									<span class="download-section"></span>
								</div>
								<a href="{{URL::to('/')}}/files/report/{{$element->image_enc}}" target="_blank" class="d-flex align-items-center text-danger text-center">
									<div class="m-3 w-100">
										<i class="fas fa-file-pdf fa-3x"></i> 
										<!-- {{ __('lang.download')}} -->
									</div>
								</a>
							</div>
						</div>
					</div>
					@empty
					<div class="py-5"></div>
					@endforelse
					<div class="d-flex justify-content-center">
						{{$data_list->render("pagination::bootstrap-4")}}
					</div>
				</div>
			</div>
		</div>
	</div>
	
@endsection
@push('js')
@endpush