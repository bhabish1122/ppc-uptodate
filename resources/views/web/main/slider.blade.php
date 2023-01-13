@if($sliders->count())
<div class="container mt-1">
    <div class="row" id="ht">
        <div class="col-md-9 container">
            <div class="slide-one-item home-slider owl-carousel">
                @foreach($sliders as $slider)
                <div class="site-blocks-cover inner-page overlay" id="slidersize"
                    {{-- style="background-image: url({{URL::to('/')}}/image/slider/{{$slider->image_enc}});" --}}
                    data-aos="fade" data-stellar-background-ratio="0.5">
                    <img src="{{URL::to('/')}}/image/slider/{{$slider->image_enc}}" class="img-fluids"
                        style="z-index:1;">
                    <div class="container position-absolute" style="top: 0;z-index:9;">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-8 text-center carousel-caption d-none d-md-block" data-aos="fade">
                                <h4 class="text-light font-secondary font-weight-bold text-uppercase">{{$slider->title}}
                                </h4>
                            </div>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-3 pl-0" >
            @if ($slider_person)
            <div class="position-relative mb-2 text-center" style="border:1px solid #D8D9CF;">
                <img src="{{ url($slider_person->image_enc ? 'image/core_person/thumbnail/'.$slider_person->image_enc : 'image/noimage.png') }}" alt="{{ $slider_person->name }}" class="img-fluid mx-auto w-75 rounded">
                <div class="position-relative w-100 p-2">
                    <h6 class="text-center p-0 m-0 fs-6">
                        <a href="{{ route('web.about.list-of-director-generals.show',$slider_person->id) }}" class="showToolTip text-primary" title="Click to view detail">
                            {{ $slider_person->name }}
                        </a>
                    </h6>
                    <p class="text-dark text-center p-0 m-0 fs-6">{{ __('lang.minister')}}</p>
                        <a href="{{ route('web.sachibalaya') }}" class="text-white btn btn-primary">
                        <i class="fa fa-users"></i> {{ __('lang.sachibalaya') }}
                    </a>

                </div>
                <ul class="list-group my-0 ml-1 main-social" style="z-index: 0;">
                    <li class="list-group-item p-1">
                        <a href="{{ $slider_person->facebook ? $slider_person->facebook : 'javascript:void(0)' }}"
                            class="text-primary" target="_blank">
                            <i class="fab fa-facebook"></i>
                        </a>
                    </li>
                    <li class="list-group-item p-1">
                        <a href="{{ $slider_person->twitter ? $slider_person->twitter : 'javascript:void(0)' }}"
                            class="text-info" target="_blank">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li class="list-group-item p-1">
                        <a href="{{ $slider_person->youtube ? $slider_person->youtube : 'javascript:void(0)' }}"
                            class="text-danger" target="_blank">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </li>
                </ul>
            </div>
            @endif
             @if ($slider_top_person)
            <div class="position-relative mb-2 text-center" style="border:1px solid #D8D9CF;">
                <img src="{{ url($slider_top_person->image_enc ? 'image/core_person/thumbnail/'.$slider_top_person->image_enc : 'image/noimage.png') }}" alt="{{ $slider_top_person->name }}" class="img-fluid mx-auto w-75 rounded">
                <div class="position-relative w-100 p-2">
                    <h6 class="text-center p-0 m-0 fs-6">
                        <a href="{{ route('web.about.list-of-director-generals.show',$slider_top_person->id) }}" class="showToolTip text-primary" title="Click to view detail">
                            {{ $slider_top_person->name }}
                        </a>
                    </h6>
                    <p class="text-dark text-center p-0 m-0 fs-6">{{ $slider_top_person->designation }}</p>
                </div>
            </div>
            @endif
            <!-- <div class="position-relative mb-2 text-center" style="border:1px solid #D8D9CF;">
                <img src="{{URL::to('/')}}/image/a.jpg" alt="SACHIP" class="img-fluid mx-auto w-75 rounded">
                <div class="position-relative w-100 p-2">
                    <h6 class="text-center p-0 m-0 fs-6">
                        <a href="#" class="showToolTip text-primary" title="Click to view detail">
                            Shyam Bhattrai
                        </a>
                    </h6>
                    <p class="text-dark text-center p-0 m-0 fs-6">{{ __('lang.secretary')}}</p>
                </div>
            </div> -->
        </div>
        <!-- <div class="col-md-2 " style="margin-left:-43px;" >
            @if ($slider_person)
            <div class="card m-0 p-0">
                <a href="{{ route('web.about.list-of-director-generals.show',$slider_person->id) }}" style="z-index:1">
                    <img src="{{ url($slider_person->image_enc ? 'image/core_person/thumbnail/'.$slider_person->image_enc : 'image/noimage.png') }}"
                        class="card-img-top" alt="{{ $slider_person->name }}">
                </a>
                <ul class="list-group my-0 main-social" style="z-index: 0;">
                    <li class="list-group-item p-1">
                        <a href="{{ $slider_person->facebook ? $slider_person->facebook : 'javascript:void(0)' }}"
                            class="text-primary" target="_blank">
                            <i class="fab fa-facebook"></i>
                        </a>
                    </li>
                    <li class="list-group-item p-1">
                        <a href="{{ $slider_person->twitter ? $slider_person->twitter : 'javascript:void(0)' }}"
                            class="text-info" target="_blank">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li class="list-group-item p-1">
                        <a href="{{ $slider_person->youtube ? $slider_person->youtube : 'javascript:void(0)' }}"
                            class="text-danger" target="_blank">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </li>
                </ul>
                <div class="card-body text-center">
                    <h6 class="card-title font-weight-bold text-primary">
                        <a href="{{ route('web.about.list-of-director-generals.show',$slider_person->id) }}"
                            class="text-hover-a slidertest"> {{ $slider_person->name }}</a>
                    </h6>
                    <small class="d-block font-weight-bold">{{ $slider_person->designation }}</small>
                    <a href="{{ route('web.sachibalaya') }}" class="text-white btn btn-primary">
                        <i class="fa fa-users"></i> {{ __('lang.sachibalaya') }}
                    </a>
                </div>
            </div>
            @endif
            @if ($slider_person)
            <div class="card m-0 p-0">
                <a href="{{ route('web.about.list-of-director-generals.show',$slider_person->id) }}" style="z-index:1">
                    <img src="{{ url($slider_person->image_enc ? 'image/core_person/thumbnail/'.$slider_person->image_enc : 'image/noimage.png') }}"
                        class="card-img-top" alt="{{ $slider_person->name }}">
                </a>
                <div class="card-body text-center">
                    <h6 class="card-title font-weight-bold text-primary">
                        <a href="{{ route('web.about.list-of-director-generals.show',$slider_person->id) }}"
                            class="text-hover-a slidertest"> {{ $slider_person->name }}</a>
                    </h6>
                    <small class="d-block font-weight-bold">{{ $slider_person->designation }}</small>
                </div>
            </div>
            @endif
        </div> -->
    </div>
</div>
<!-- {{-- <div class="slant-1"></div> --}} -->
@endif