@extends('web.main.app')
@push('seo_title')   @endpush
@push('css')
@endpush
@section('content')
	<div class="container">
		<div class="horizontal">
			<div class="verticals ten offset-by-one">
				<ol class="breadcrumb breadcrumb-fill2 style4">
					<li><a href="{{ route('web.welcome') }}"><i class="fa fa-home"></i></a></li>
					<li class="active">Title</li>
				</ol>
			</div>
		</div>
	</div>

	<div class="clearfix mb-3"></div>
	
	
@endsection
@push('js')
@endpush