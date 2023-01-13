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
						<table class="table table-hover table-striped table-bordered">
							<thead class="bg-dark text-light text-center">
								<tr>
									<td width="5%">{{ __('lang.sn') }}</td>
									<td width="15%">{{ __('lang.date_s')}}</td>
									<td class="text-left">{{ __('lang.notice')}} {{ __('lang.title')}}</td>
									<td width="10%">{{ __('lang.download')}}</td>
									<td>{{ __('lang.remark')}}</td>
								</tr>
							</thead>
							<tbody class="text-center">
								@forelse ($data_list as $key=>$element)
								<tr>
									<td>{{$key+1}}</td>
									<td>{{ Date('j M, Y',strtotime($element->date)) }}</td>
									<td class="text-left">{{$element->title}}</td>
									<td data-toggle="tooltip" data-placement="top" data-html="true" title="<small>Click to {{ __('lang.download')}}</small>">
										@php
										$excl_ext = array('xlsm','xlsx','xltx','xltm','xls','xlsxm');
										$doc_ext = array('doc','docx','dot','dotx');
										$ppt_ext = array('pptx','ppt');
										@endphp
										@if ($element->ext == 'pdf')
										<a href="{{URL::to('/')}}/files/notice/{{$element->image_enc}}" target="_blank" class="text-danger text-center">
												<i class="fas fa-file-pdf fa-2x"></i> 
												{{-- {{ __('lang.download')}} --}}
										</a>
										@endif
										@if (in_array($element->ext, $doc_ext))
										<a href="{{URL::to('/')}}/files/notice/{{$element->image_enc}}" class="text-center" download>
												<i class="fas fa-file-word fa-2x text-primary"></i> 
										</a>
										@endif
										@if (in_array($element->ext, $ppt_ext))
										<a href="{{URL::to('/')}}/files/notice/{{$element->image_enc}}" class="text-center" download>
												<i class="fas fa-file-powerpoint fa-2x text-warning"></i> 
										</a>
										@endif
										@if (in_array($element->ext, $excl_ext))
										<a href="{{URL::to('/')}}/files/notice/{{$element->image_enc}}" class="text-center" download>
												<i class="fas fa-file-excel fa-2x text-success"></i> 
										</a>
										@endif
									</td>
									<td class="text-left">
										{!! $element->remark !!}
									</td>
								</tr>
								@empty
								<tr>
									<td colspan="5">Update Coming Soon</td>
								</tr>
								@endforelse
							</tbody>
						</table>
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