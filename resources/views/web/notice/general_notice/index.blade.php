@extends('web.main.app')
@push('seo_title') {{$page_title ? $page_title.' | ' : ''}}  @endpush
@push('css')
@endpush
@section('content')
	<div class="container">
		<div class="horizontal">
			<div class="verticals ten offset-by-one">
				<ol class="breadcrumb breadcrumb-fill2 style4">
					<li><a href="{{ route('web.welcome') }}"><i class="fa fa-home"></i></a></li>
					<li>{{ __('lang.notice')}}</li>
					<li class="active">{{$page_title}}</li>
				</ol>
			</div>
		</div>
	</div>

	<div class="clearfix mb-3"></div>

	<div class="site-half mt-0 pt-0" data-aos="fade-up" data-aos-delay="200">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="no-gutters align-items-stretch">
						@forelse ($data_list as $key=>$element)
						<div data-aos="fade-up" data-aos-delay="{{$key+1}}00">
							<div class="coupon bg-light rounded px-3 mb-3 d-flex justify-content-between border-dark coupon-shadow" data-toggle="tooltip" data-placement="{{ $element->image_enc ? 'right' : '' }}" data-html="true" title="<small>{{ __('lang.download') }}</small>">
								<div class="py-3 w-100 justify-content-start">
									<div class="d-block mr-2">
										{{-- <span class="badge badge-success">Valid</span> --}}
										<h3 class="lead">{{$element->title}}</h3>
										<!-- <div class="text-muted mb-0">
											{!! $element->description,0,50,"......" !!}
										</div> -->
										<div class="float-right">
											<a class="fade00" href="{{ route('web.notice.show', [$page, $element->slug ]) }}">
												{{ __('lang.read_more')}}
												<span class="bg"></span>
											</a>
										</div>
										<small>{{ Date('j F, Y',strtotime($element->date)) }}</small>
										{{-- <small>{{ $element->created_at->format('Y-m-d') }}</small> --}}
										{{-- <small>{{ date('Y-m-d') == $element->date ? $element->created_at->diffForHumans() : $element->date->diffForHumans() }}</small> --}}
									</div>
								</div>
								<div class="kanan">
									<span class="download-section"></span>
								</div>
								@php
								$excl_ext = array('xlsm','xlsx','xltx','xltm','xls','xlsxm');
								$doc_ext = array('doc','docx','dot','dotx');
								$ppt_ext = array('pptx','ppt');
								@endphp
								@if ($element->ext == 'pdf')
								<a href="{{URL::to('/')}}/files/notice/{{$element->image_enc}}" target="_blank" class="d-flex align-items-center text-danger text-center">
									<div class="m-3 w-100">
										<i class="fas fa-file-pdf fa-2x"></i> 
										<!-- {{ __('lang.download')}} -->
									</div>
								</a>
								@endif
								@if (in_array($element->ext, $doc_ext))
								<a href="{{URL::to('/')}}/files/notice/{{$element->image_enc}}" class="d-flex align-items-center text-center" download>
									<div class="m-3 w-100">
										<i class="fas fa-file-word fa-2x text-primary"></i> 
									</div>
								</a>
								@endif
								@if (in_array($element->ext, $ppt_ext))
								<a href="{{URL::to('/')}}/files/notice/{{$element->image_enc}}" class="d-flex align-items-center text-center" download>
									<div class="m-3 w-100">
										<i class="fas fa-file-powerpoint fa-2x text-warning"></i> 
									</div>
								</a>
								@endif
								@if (in_array($element->ext, $excl_ext))
								<a href="{{URL::to('/')}}/files/notice/{{$element->image_enc}}" class="d-flex align-items-center text-center" download>
									<div class="m-3 w-100">
										<i class="fas fa-file-excel fa-2x text-success"></i> 
									</div>
								</a>
								@endif
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
	</div>
@endsection
@push('js')
@endpush