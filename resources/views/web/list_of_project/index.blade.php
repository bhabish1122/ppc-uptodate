@extends('web.main.app')
@push('seo_title') {{ __('lang.list_of_project')}} |  @endpush
@push('css')
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/web/css/print.main.css">
@endpush
@section('content')
	<div class="container">
		<div class="horizontal">
			<div class="verticals ten offset-by-one">
				<ol class="breadcrumb breadcrumb-fill2 style4">
					<li><a href="{{ route('web.welcome') }}"><i class="fa fa-home"></i></a></li>
					<li class="active">{{ __('lang.list_of_project')}}</li>
				</ol>
			</div>
		</div>
	</div>

	<div class="clearfix mb-3"></div>
	
	<div class="site-section pt-0" data-aos="fade-up">
		<div class="container">
			<button onclick="PrintDiv('printTable')" target="_blank" class="btn btn-md btn-outline-dark" data-toggle="tooltip" data-placement="right" data-html="true" title="<small>{{ __('lang.download')}}</small>"><i class="fa fa-download"></i></button>
			<div class="table-responsive" id="printTable">
				<table class="table table-hover table-striped table-bordered">
					<thead class="bg-dark text-light text-center">
						<tr>
							<th>{{ __('lang.sn') }}</th>
							<th>आयोजना/योजना/परियोजना/कार्यालयको नाम</th>
							<th>Name of Projects/Programmes/Schemes/Office</th>
							<th width="10%" class="print-0">Detail</th>
						</tr>
					</thead>
					<tbody class="text-center">
						{{-- put model box for on click btn --}}
						@forelse($list_of_projects as $key=>$list_of_project)
						<tr data-toggle="tooltip" data-placement="right" data-html="true" title="<small>{!! Str::limit(strip_tags($list_of_project->description, 100)) !!}</small>">
							<td>{{$key+1}}</td>
							<td class="text-left">{{$list_of_project->title_np}}</td>
							<td class="text-left" >{{$list_of_project->title}}</td>
							<td class="print-0">
								@if ($list_of_project->description)
								<a href="{{ route('web.list-of-projects-programmes.show', $list_of_project->slug) }}" class="btn btn-sm btn-outline-info" title="Explore" target="_blank" >
									<i class="fas fa-info"></i>
								</a>
								@endif
								@if ($list_of_project->link)
								<a href="{{$list_of_project->link}}" class="btn btn-sm btn-outline-danger" title="More Info" target="_blank" >
									<i class="fas fa-link"></i>
								</a>
								@endif
							</td>
						</tr>
						@empty
						@endforelse
					</tbody>
				</table> 
			</div>
		</div>
	</div>
@endsection
@push('js')
<script src="{{URL::to('/')}}/web/js/print.main.js"></script>
@endpush