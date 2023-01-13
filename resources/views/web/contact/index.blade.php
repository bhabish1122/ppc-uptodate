@extends('web.main.app')
@push('seo_title') {{ __('lang.contact_us')}} |  @endpush
@push('css')
@endpush
@section('content')
	<div class="container">
		<div class="horizontal">
			<div class="verticals ten offset-by-one">
				<ol class="breadcrumb breadcrumb-fill2 style4">
					<li><a href="{{ route('web.welcome') }}"><i class="fa fa-home"></i></a></li>
					<li class="active">{{ __('lang.contact_us')}}</li>
				</ol>
			</div>
		</div>
	</div>

	<div class="clearfix mb-3"></div>
	
	<div class="site-section pt-0" data-aos="fade">
		<div class="container">
			<div class="row">
				@forelse ($contacts as $contact_list)
				<div class="col-md-12 col-lg-8 mb-5">
						{!! $contact_list->map !!}
				</div>
				<div class="col-lg-4">
					<div class="p-4 mb-3 bg-white" data-aos="fade-left">
						<h3 class="h5 text-black mb-3">{{ __('lang.contact_us')}}</h3>
						<p class="mb-0 font-weight-bold">{{ __('lang.address')}}</p>
						<p class="mb-4">{!! $contact_list->address !!}</p>

						<p class="mb-0 font-weight-bold">{{ __('lang.email')}}</p>
						<p class="mb-4 contact-link">
							@php
							$email_value  = $contact_list->email;
							$email_list = explode(",", $email_value);
							@endphp
							@foreach ($email_list as $email_item)
							<a href="mailto:{{$email_item}}" title="Mail Address">
								{{$email_item}}
							</a>
							@endforeach
						</p>

						<p class="mb-0 font-weight-bold">{{ __('lang.phone')}}</p>
						<p class="mb-0 contact-link">
							@php
							  $phone_value  = $contact_list->phone;
							  $phone_list = explode(",", $phone_value);
							@endphp
							@foreach ($phone_list as $key=>$phone_item)
							<a href="tel:{{$phone_item}}" title="Give us call">
							  {{$phone_item}}
							</a>
							@endforeach
						</p>
					</div>
				</div>
				@empty
				@endforelse
			</div>
		</div>
	</div>
	
@endsection
@push('js')
@endpush