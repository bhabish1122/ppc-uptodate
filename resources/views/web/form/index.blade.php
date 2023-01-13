@extends('web.main.app')
@push('seo_title') {{$page_title ? $page_title.' | ' : ''}}  @endpush
@push('css')
<link rel="stylesheet" href="{{URL::to('/')}}/admin/plugins/toastr/toastr.min.css">
@endpush
@section('content')
	<div class="container">
		<div class="horizontal">
			<div class="verticals ten offset-by-one">
				<ol class="breadcrumb breadcrumb-fill2 style4">
					<li><a href="{{ route('web.welcome') }}"><i class="fa fa-home"></i></a></li>
					<li class="active">{{$page_title}}</li>
				</ol>
			</div>
		</div>
	</div>

	<div class="clearfix mb-3"></div>

	<div class="site-half mt-0 pt-0" data-aos="fade-up" data-aos-delay="200">
		<div class="container">
			<form class="contact-form my-2" method="POST" action="{{ route('web.form.store') }}">
				@csrf
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<select class="form-control" id="form_type" name="form_type">
								<option>Suggestion type</option>
								<option value="1">{{ __('lang.form.sujab')}}</option>
								<option value="2">{{ __('lang.form.gulaso')}}</option>
								<option value="3">{{ __('lang.form.ujuri')}}</option>
							</select>
						</div>
					</div>
					<div class="form-field col-lg-6">
						<input id="name" name="name" class="input-text js-input" type="text" required>
						<label class="label" for="name">Your Name</label>
					</div>

					<div class="form-field col-lg-6 ">
						<input id="phone" name="phone" class="input-text js-input" type="text" required>
						<label class="label" for="phone">Contact Number</label>
					</div>
					<div class="form-field col-lg-12">
						<input id="description" name="description" class="input-text js-input" type="text" required>
						<label class="label" for="description">Description</label>
					</div>
					<div class="form-field col-lg-12">
						<input class="btn btn-outline-danger px-5" type="submit" value="Submit">
					</div>
				</div>
			   </form>
		</div>
		{{-- <div class="container">
			<div class="row">
				<div class="col-md-4 text-center">
					<div class="card mb-4 box-shadow">
						<a href="" class="card-body hov-box">
							<i class="fas fa-shield-alt fa-4x com-icon"></i>
							<div class="card-title pricing-card-title">{{ __('lang.form.sujab')}}</div>
						</a>
					</div>
				</div>
				<div class="col-md-4 text-center">
					<div class="card mb-4 box-shadow hov-box">
						<div class="card-body">
							<i class="fas fa-cloud fa-4x com-icon"></i>
							<div class="card-title pricing-card-title">{{ __('lang.form.gulaso')}}</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 text-center">
					<div class="card mb-4 box-shadow hov-box">
						<div class="card-body">
							<i class="fas fa-cloud fa-4x com-icon"></i>
							<div class="card-title pricing-card-title">{{ __('lang.form.ujuri')}}</div>
						</div>
					</div>
				</div>

			</div>
		</div> --}}
	</div>
@endsection
@push('js')
<script src="{{URL::to('/')}}/admin/plugins/toastr/toastr.min.js"></script>
<script>
  @if(Session::has('message'))
  var type = "{{ Session::get('alert-type') }}";
  switch(type){
    case 'info':
    toastr.info("{!! Session::get('message') !!}");
    break;

    case 'warning':
    toastr.warning("{!! Session::get('message') !!}");
    break;

    case 'success':
    toastr.success("{!! Session::get('message') !!}");
    break;

    case 'error':
    toastr.error("{!! Session::get('message') !!}");
    break;
  }
  @endif
</script>
@endpush