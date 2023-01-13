@extends('web.main.app')
@push('seo_title') {{ __('lang.national_pride_project')}} |  @endpush
@push('css')
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/web/css/drop-accordance.main.css">
@endpush
@section('content')
	<div class="container">
		<div class="horizontal">
			<div class="verticals ten offset-by-one">
				<ol class="breadcrumb breadcrumb-fill2 style4">
					<li><a href="{{ route('web.welcome') }}"><i class="fa fa-home"></i></a></li>
					<li class="active">{{ __('lang.national_pride_project')}}</li>
				</ol>
			</div>
		</div>
	</div>

	<div class="clearfix mb-3"></div>
	
	<div class="site-content">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
						@foreach ($data_lists as $key=>$element)
						<div class="panel panel-default">
							<div class="panel-heading" role="tab" id="heading{{$key+1}}">
								<h4 class="panel-title">
									<a class="collapsed"  role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$key+1}}" aria-expanded="true" aria-controls="collapse{{$key+1}}">
										{{$element->title}}
									</a>
								</h4>
							</div>
							<div id="collapse{{$key+1}}" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading{{$key+1}}">
								<div class="panel-body">
									{!! $element->description !!}

									<a class="effect1" href="{{$element->link}}" target="_blank">
									  {{ __('lang.explose_more')}}
									  <span class="bg"></span>
									</a>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
	
@endsection
@push('js')
<script type="text/javascript">
	(function($) {
		'use strict';
		
		jQuery(document).on('ready', function(){
		
				$('a.page-scroll').on('click', function(e){
					var anchor = $(this);
					$('html, body').stop().animate({
						scrollTop: $(anchor.attr('href')).offset().top - 50
					}, 1500);
					e.preventDefault();
				});		

		}); 	

					
	})(jQuery);
</script>
@endpush