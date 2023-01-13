@extends('web.main.app')
@push('seo_title') {{ __('lang.home')}} | @endpush
@push('css')
<style>
.gradient-bg {
    background: linear-gradient(to right, #56CCF2, #245eba);
    /* background: linear-gradient(150deg, #f731db, #4600f1 100%); */
}

.gradient-bg:hover {
    background: #0F3460;
}

.card1 {
    border: none;
    border-radius: 0;
    padding: 30px 15px;
}

h5 {

    color: #f8f9fa;
}

.card1 {
    border: 1px solid blue;
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;

}

.text-light {
    color: #f8f9fa !important;
}

.text-center {
    text-align: center !important;
}
</style>
<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/web/css/footertest.css">

<link rel="stylesheet" type="text/css" href="{{URL::to('/')}}/web/css/popup.main.css">
@endpush
@section('content')
<!-- slider -->



<!-- SLIDER MAINSLIDER ABOUT ONE TWO -->
<div class="container">
    <div class="row mt-2">
        <div class="col-md-9">
            <!-- slider -->
            @if($sliders->count())
            <div class="slide-one-item home-slider owl-carousel">
                @foreach($sliders as $slider)
                <div class="site-blocks-cover inner-page overlay" id="slidersize"
                    {{-- style="background-image: url({{URL::to('/')}}/image/slider/{{$slider->image_enc}});" --}}
                    data-aos="fade" data-stellar-background-ratio="0.5">
                    @if(Session()->get('APP_BAND') != 'low')
                        <img src="{{URL::to('/')}}/image/slider/{{$slider->image_enc}}" class="img-fluids"
                        style="z-index:1;">
                    @endif
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
            @endif
            <!--  End slider -->
            <!-- main slider top (about mantralaya)  -->
            @foreach($abouts as $about)
            <div class="no-gutters align-items-stretch bg-light mb-2 mt-2">
                <div class="px-3 pb-4 main-about-text" data-aos="fade-up" data-aos-delay="100">
                    <h2 class="site-section-heading text-uppercase font-secondary mb-1 pt-1">{{$about->title}}</h2>
                    {!! substr($about->description,0,2550) !!}...
                    <div class="float-right text-dark">
                        <a class="float-right text-dark" href="{{ route('web.aboutUs.detail') }}"
                            style="margin-top:-12px; margin-right:15px;">
                            <span class="fade00">
                                {{ __('lang.explose_more')}}<i class="fa fa-arrow-right"></i>
                                <span class="bg"></span>
                            </span>

                        </a>

                    </div>
                </div>
            </div>
            @endforeach

             <!-- tab section(notice) -->
             <div class="cointainer-fluid mt-1 mb-2">
                <div class="col-md-12">
                    <div class="site-sction py-0 ">
                        <div class="container">
                            <div class="row">
                                <div
                                    class="col-md-{{$rastriyagorkhaayojans->count() ? '8' : '12'}} col-lg-{{$rastriyagorkhaayojans->count() ? '8' : '12'}} px-0">
                                    <div class="tile" id="tile-1" data-aos="fade-up" data-aos-delay="100">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-justified overflow-auto" role="tablist">
                                            <div class="slider"></div>
                                            <li class="nav-item">
                                                <a class="nav-link active" id="general-1" data-toggle="tab"
                                                    href="#general" role="tab" aria-controls="general"
                                                    aria-selected="false">{{ __('lang.notice')}}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="procurement-2" data-toggle="tab"
                                                    href="#procurement" role="tab" aria-controls="procurement"
                                                    aria-selected="true">{{ __('lang.procurement_notice')}}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="notice-board-6" data-toggle="tab"
                                                    href="#notice-board" role="tab" aria-controls="notice-board"
                                                    aria-selected="false">{{ __('lang.bulletin_notice_board')}}</a>
                                            </li>
                                        </ul>
                                        <!-- Tab panes -->
                                        <div class="tab-content">
                                            <div class="tab-pane fade" id="procurement" role="tabpanel"
                                                aria-labelledby="procurement">
                                                <div class="no-gutters align-items-stretch mt-4 table-responsive">
                                                    <table class="table table-hover table-striped table-bordered">
                                                        <thead class="bg-dark text-light text-center">
                                                            <tr>
                                                                <td width="15%">{{ __('lang.date_s')}}</td>
                                                                <td width="15%">{{ __('lang.contract_id')}}</td>
                                                                <td class="text-left">{{ __('lang.notice')}}</td>
                                                                <td width="10%">{{ __('lang.download')}}</td>
                                                                <td width="5%">{{ __('lang.status')}}</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="text-center">
                                                            @forelse ($procurement_notice as
                                                            $key=>$procurement_list)
                                                            <tr data-toggle="tooltip" data-placement="right"
                                                                data-html="true"
                                                                title="<small>{{$procurement_list->title}}</small>">
                                                                <td><small>{{ Date('j M, Y',strtotime($procurement_list->date)) }}</small>
                                                                </td>
                                                                <td>{{$procurement_list->contract_id}}</td>
                                                                <td class="text-left">{{ $procurement_list->title }}
                                                                </td>
                                                                <td class="text-danger">
                                                                    <a href="{{URL::to('/')}}/files/notice/{{$procurement_list->image_enc}}"
                                                                        target="_blank" class="text-danger">
                                                                        <i class="fas fa-file-pdf fa-2x"></i>
                                                                        {{-- {{ __('lang.download')}} --}}
                                                                    </a>
                                                                </td>
                                                                <td
                                                                    class="{{ $procurement_list->status == 0 ? 'text-danger' : 'text-success' }}">
                                                                    <i
                                                                        class="fas fa-arrow-circle-{{ $procurement_list->status == 0 ? 'down' : 'up' }} fa-2x"></i>
                                                                </td>
                                                            </tr>
                                                            @empty
                                                            <tr>
                                                                <td colspan="5">Update Coming Soon</td>
                                                            </tr>
                                                            @endforelse
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="bg-order-main">
                                                    <div class="float-right bg-order">
                                                        <a class="fade00"
                                                            href="{{ route('web.notice.index', 'procurement-notice') }}">
                                                            {{ __('lang.explose_more')}}
                                                            <i class="fa fa-arrow-right"></i>

                                                            <span class="bg"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show active" id="general" role="tabpanel"
                                                aria-labelledby="general-tab">
                                                <div class="no-gutters align-items-stretch mt-4">
                                                    @forelse ($general_notice as $key=>$general_list)
                                                    <div data-aos="fade-up" data-aos-delay="{{$key+1}}00">
                                                        <div class="coupon bg-light rounded px-3 mb-3 d-flex justify-content-between border-dark coupon-shadow"
                                                            data-toggle="tooltip" data-placement="right"
                                                            data-html="true"
                                                            title="{!! $general_list->image_enc ? '<small>'.__('lang.download').'</small>' : '' !!}">
                                                            <div class="py-2 w-100 justify-content-start">
                                                                <div class="d-block mr-2">
                                                                    <h3 class="lead" data-toggle="tooltip"
                                                                        data-placement="top" data-html="true"
                                                                        title="<small>{{$general_list->title}}</small>">
                                                                        {{$general_list->title}}</h3>

                                                                    <div class="float-right">
                                                                        <a class="fade00"
                                                                            href="{{ route('web.notice.show', ['general-notice', $general_list->slug ]) }}">
                                                                            {{ __('lang.read_more')}}
                                                                            <i class="fa fa-arrow-right"></i>

                                                                            <span class="bg"></span>
                                                                        </a>
                                                                    </div>
                                                                    <small>{{ Date('j F, Y', strtotime($general_list->date)) }}</small>
                                                                </div>
                                                            </div>
                                                            <div class="kanan">
                                                                <span class="download-section"></span>
                                                            </div>
                                                            @if ($general_list->image_enc)
                                                            <a href="{{URL::to('/')}}/files/notice/{{$general_list->image_enc}}"
                                                                target="_blank"
                                                                class="d-flex align-items-center text-danger text-center">
                                                                <div class="m-3 w-100">
                                                                    <i class="fas fa-file-pdf fa-2x"></i>
                                                                    {{-- {{ __('lang.download')}} --}}
                                                                </div>
                                                            </a>
                                                            @else
                                                            <a href="javascript:void(0)"
                                                                class="d-flex align-items-center text-muted text-center">
                                                                <div class="m-3 w-100">
                                                                    <i class="fas fa-file-pdf fa-2x"></i>
                                                                </div>
                                                            </a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    @empty
                                                    <div class="py-5"></div>
                                                    @endforelse
                                                </div>
                                                <div class="bg-order-main">

                                                    <div class="float-right bg-order">
                                                        <a class="fade00"
                                                            href="{{ route('web.notice.index', 'general-notice') }}">
                                                            {{ __('lang.explose_more')}}
                                                            <i class="fa fa-arrow-right"></i>

                                                            <span class="bg"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="notice-board" role="tabpanel"
                                                aria-labelledby="notice-board-tab">
                                                <div class="no-gutters align-items-stretch mt-4">
                                                    @forelse ($bulletin_noticeboards as $key=>$bulletine_list)
                                                    <div data-aos="fade-up" data-aos-delay="{{$key+1}}00">
                                                        <div class="coupon bg-light rounded px-3 mb-3 d-flex justify-content-between border-dark coupon-shadow"
                                                            data-toggle="tooltip" data-placement="right"
                                                            data-html="true"
                                                            title="<small>{{ __('lang.download')}}</small>">
                                                            <div class="py-2 w-100 justify-content-start">
                                                                <div class="d-block mr-2">
                                                                    <h3 class="lead" data-toggle="tooltip"
                                                                        data-placement="top" data-html="true"
                                                                        title="<small>{{$bulletine_list->title}}</small>">
                                                                        {{$bulletine_list->title}}</h3>

                                                                    <div class="float-right">
                                                                        <a class="fade00"
                                                                            href="{{ route('web.notice.show', ['covid-notice-board', $bulletine_list->slug ]) }}">
                                                                            {{ __('lang.read_more')}}
                                                                            <i class="fa fa-arrow-right"></i>

                                                                            <span class="bg"></span>
                                                                        </a>
                                                                    </div>
                                                                    <small>{{ Date('j F, Y', strtotime($bulletine_list->date)) }}</small>
                                                                </div>
                                                            </div>
                                                            <div class="kanan">
                                                                <span class="download-section"></span>
                                                            </div>
                                                            <a href="{{URL::to('/')}}/files/notice/{{$bulletine_list->image_enc}}"
                                                                target="_blank"
                                                                class="d-flex align-items-center text-danger text-center">
                                                                <div class="m-3 w-100">
                                                                    <i class="fas fa-file-pdf fa-2x"></i>
                                                                    {{-- {{ __('lang.download')}} --}}
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    @empty
                                                    <div class="py-5"></div>
                                                    @endforelse
                                                </div>
                                                <div class="bg-order-main">

                                                    <div class="float-right bg-order">
                                                        <a class="fade00"
                                                            href="{{ route('web.notice.index', 'bulletine-notice-board') }}">
                                                            {{ __('lang.explose_more')}}
                                                            <i class="fa fa-arrow-right"></i>

                                                            <span class="bg"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-3 col-xs-12 pl-0 container fbiframe">
                    facebook embeed
                    <iframe
                        src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FTechwarepvtltd%2F&tabs=timeline&width=180&height=400&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId"
                        width="420px" height="400" style="border:none;overflow:hidden" scrolling="no" frameborder="0"
                        allowfullscreen="true"
                        allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                    </iframe>
                </div> -->
            </div>
            <!-- end of tab section(notice) -->



        <!-- block section -->
        <div class="block-grid container">
            <div class="row">
                <div class="col-md mb-3 col-6">
                    <div class="card1 text-center gradient-bg text-light">
                    <i class="fa fa-2x fa-bullseye"></i>
                        <h5 class="fs-6" style="color:#f8f9fa;"> <a href="{{ route('web.about.objective') }}"
                                class="text-light"> {{ __('lang.our_objective')}}
                            </a>
                        </h5>
                    </div>
                </div>
                <div class="col-md mb-3 col-6">
                    <div class="card1 text-center gradient-bg text-light">
                        <i class="fa fa-2x fa-list"></i>
                        <h5 class="fs-6" style="color:#f8f9fa;"> <a href="{{ route('web.about.section-detail') }}"
                                class="text-light"> {{ __('lang.section_detail')}}
                            </a>
                        </h5>
                    </div>
                </div>
                <div class="col-md mb-3 col-12">
                    <div class="card1 text-center gradient-bg text-light">
                    <i class="fas fa-2x fa-building"></i>
                        <h5 class="fs-6" style="color:#f8f9fa;"> <a href="{{ route('web.about.office.index') }}"
                                class="text-light"> {{ __('lang.office')}}
                            </a>
                        </h5>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md mb-3 col-6">
                    <div class="card1 text-center gradient-bg text-light">
                    <i class="fas fa-2x fa-balance-scale"></i>
                        <h5 class="fs-6" style="color:#f8f9fa;"> <a href="{{ route('web.document.index', 'act') }}"
                                class="text-light"> {{ __('lang.act')}}
                            </a>
                        </h5>
                    </div>
                </div>
                <div class="col-md mb-3 col-6">
                    <div class="card1 text-center gradient-bg text-light">
                        <i class="fa fa-2x fa-gavel"></i>
                        <h5 class="fs-6" style="color:#f8f9fa;"> <a
                                href="{{ route('web.document.index', 'regulation') }}" class="text-light">
                                {{ __('lang.regulation')}}
                            </a>
                        </h5>
                    </div>
                </div>
                <div class="col-md mb-3 col-6">
                    <div class="card1 text-center gradient-bg text-light">
                        <i class="fa fa-2x fa-book"></i>
                        <h5 class="fs-6" style="color:#f8f9fa;"> <a href="{{ route('web.document.index', 'act_rule') }}"
                                class="text-light">
                                {{ __('lang.act_rule')}}
                            </a>
                        </h5>
                    </div>
                </div>
                <div class="col-md mb-3 col-6">
                    <div class="card1 text-center gradient-bg text-light">
                    <i class="fa fa-2x fa-book"></i>
                        <h5 class="fs-6" style="color:#f8f9fa;"> <a
                                href="{{ route('web.document.index', 'nirdeshika') }}" class="text-light">
                                {{ __('lang.nirdeshika')}}
                            </a>
                        </h5>
                    </div>
                </div>

            </div>
            <div class="row">
                <!-- <div class="col-md mb-3 col-6">
                                <div class="card1 text-center gradient-bg text-light">
                                    <i class="fa fa-3x fa-comments"></i>
                                    <h5 class="fs-6" style="color:#f8f9fa;"> <a href="{{ route('web.report.index', 'quaterly-report') }}" class="text-light"> {{ __('lang.quaterly_report')}}
                                        </a>
                                    </h5>
                                </div>
                            </div> -->
                <div class="col-md mb-3 col-6">
                    <div class="card1 text-center gradient-bg text-light">
                        <i class="fa fa-2x fa-file-alt"></i>
                        <h5 class="fs-6" style="color:#f8f9fa;"> <a
                                href="{{ route('web.report.index', 'yearly-report') }}" class="text-light">
                                {{ __('lang.yearly_report')}}
                            </a>
                        </h5>
                    </div>
                </div>
                <div class="col-md mb-3 col-6">
                    <div class="card1 text-center gradient-bg text-light">
                        <i class="fa fa-2x fa-bell-slash"></i>
                        <h5 class="fs-6" style="color:#f8f9fa;"> <a
                                href="{{ route('web.notice.index', 'general-notice') }}" class="text-light">
                                {{ __('lang.general_notice')}}
                            </a>
                        </h5>
                    </div>
                </div>
                <div class="col-md mb-3 col-12">
                    <div class="card1 text-center gradient-bg text-light">
                        <i class="fa fa-2x fa-bell"></i>
                        <h5 class="fs-6" style="color:#f8f9fa;"> <a
                                href="{{ route('web.notice.index', 'procurement-notice') }}" class="text-light">
                                {{ __('lang.procurement_notice')}}
                            </a>
                        </h5>
                    </div>
                </div>

            </div>
            <div class="row">


                <div class="col-md mb-3 col-12">
                    <div class="card1 text-center gradient-bg text-light">
                        <i class="fa fa-2x fa-map-marker"></i>
                        <h5 class="fs-6" style="color:#f8f9fa;"> <a
                                href="{{ route('web.notice.index', 'notice-board') }}" class="text-light">
                                {{ __('lang.notice_board')}}
                            </a>
                        </h5>
                    </div>
                </div>

            </div>
        </div>
        <!-- end of block section -->



    </div>
    <!--   cards right-->
    <div class="col-md-3">
        <!-- slider card -->
        @if ($mantri)
        <div class="position-relative mb-2 text-center" style="border:1px solid #D8D9CF;">
            @if(Session()->get('APP_BAND') != 'low')
                <img src="{{ url($mantri->image_enc ? 'image/core_person/thumbnail/'.$mantri->image_enc : 'image/noimage.png') }}"
                alt="{{ $mantri->name }}" style="padding-top: 10px;" class="img-fluid mx-auto w-75 rounded" id="p1">
            @endif
            <div class="position-relative w-100 p-2">
                <h6 class="text-center p-0 m-0 fs-6">
                    <a href="{{ route('web.about.list-of-director-generals.show',$mantri->id) }}"
                        class="showToolTip text-primary" title="Click to view detail">
                        @if(app()->getLocale() == 'en')
                        {{ $mantri->name_en }}
                        @else
                        {{ $mantri->name }}
                        @endif
                    </a>
                </h6>
                <p class="text-dark text-center p-0 m-0 fs-6">
                    @if(app()->getLocale() == 'en')
                    {{$mantri->designation_en}}
                    @else
                    {{ $mantri->designation}}
                    @endif
                </p>
                <a href="{{ route('web.sachibalaya') }}" class="text-white btn btn-primary">
                    <i class="fa fa-users"></i> {{ __('lang.sachibalaya') }}
                </a>

            </div>
            <ul class="list-group my-0 ml-1 main-social" style="z-index: 0;">
                <li class="list-group-item p-1">
                    <a href="{{ $mantri->facebook ? $mantri->facebook : 'javascript:void(0)' }}"
                        class="text-primary" target="_blank">
                        <i class="fab fa-facebook"></i>
                    </a>
                </li>
                <li class="list-group-item p-1">
                    <a href="{{ $mantri->twitter ? $mantri->twitter : 'javascript:void(0)' }}"
                        class="text-info" target="_blank">
                        <i class="fab fa-twitter"></i>
                    </a>
                </li>
                <li class="list-group-item p-1">
                    <a href="{{ $mantri->youtube ? $mantri->youtube : 'javascript:void(0)' }}"
                        class="text-danger" target="_blank">
                        <i class="fab fa-youtube"></i>
                    </a>
                </li>
            </ul>
        </div>
        @endif
        @if ($sachib)
        <div class="position-relative mb-2 text-center" style="border:1px solid #D8D9CF;">
            @if(Session()->get('APP_BAND') != 'low')
                <img src="{{ url($sachib->image_enc ? 'image/core_person/thumbnail/'.$sachib->image_enc : 'image/noimage.png') }}"
                alt="{{ $sachib->name }}" style="padding-top: 10px;" class="img-fluid mx-auto w-75 rounded">
            @endif
            <div class="position-relative w-100 p-2">
                <h6 class="text-center p-0 m-0 fs-6">
                    <a href="{{ route('web.about.list-of-director-generals.show',$sachib->id) }}"
                        class="showToolTip text-primary" title="Click to view detail">
                        @if(app()->getLocale() == 'en')
                        {{ $sachib->name_en }}
                        @else
                        {{ $sachib->name }}
                        @endif
                    </a>
                </h6>
                <p class="text-dark text-center p-0 m-0 fs-6">
                    @if(app()->getLocale() == 'en')
                    {{ $sachib->designation_en }}
                    @else
                    {{ $sachib->designation }}
                    @endif
                </p>
                <p class="text-dark text-center p-0 m-0 fs-6">
                {{$sachib->phone}}
                </p>
            </div>
        </div>
        @endif

        <!-- eend of slider card -->

        <!-- main slider top-->

        @if(count($prabakta_suchana_adhikari))
        @if ($prabakta_suchana_adhikari)
        @forelse ($prabakta_suchana_adhikari as $c=>$cores_sub_record)
        <div class="position-relative mb-2 text-center" style="border:1px solid #D8D9CF;">
            @if(Session()->get('APP_BAND') != 'low')
                <img src="{{ url($cores_sub_record->image_enc ? 'image/core_person/thumbnail/'.$cores_sub_record->image_enc : 'image/noimage.png') }}"
                alt="{{ $cores_sub_record->name }}" style="padding-top: 10px;" class="img-fluid mx-auto w-75 rounded">
            @endif
            <div class="position-relative w-100 p-2">
                <h6 class="text-center p-0 m-0 fs-6">
                    <a href="{{ route('web.about.list-of-director-generals.show',$cores_sub_record->id) }}"
                        class="showToolTip text-primary" title="Click to view detail">
                        @if(app()->getLocale() == 'en')
                        {{$cores_sub_record->name_en}}
                        @else
                        {{ $cores_sub_record->name }}
                        @endif
                    </a>
                </h6>
                <p class="text-dark text-center p-0 m-0 fs-6">
                @if(app()->getLocale() == 'en')
                    {{ $cores_sub_record->designation_en }}
                @else
                    {{ $cores_sub_record->designation }}
                @endif
                </p>
                <p class="text-dark text-center p-0 m-0 fs-6">
                {{$cores_sub_record->phone}}
                </p>
            </div>
        </div>
        @empty

        @endforelse
        @endif
        @endif

        <!-- end main slider card one-->

        <!-- about side card two ram krishna-->
        <!-- @if ($sachib)
        <div class="position-relative mb-2 text-center" style="border:1px solid #D8D9CF;">
            @if(Session()->get('APP_BAND') != 'low')
                <img src="{{ url($sachib->image_enc ? 'image/core_person/thumbnail/'.$sachib->image_enc : 'image/noimage.png') }}"
                alt="{{ $sachib->name }}" class="img-fluid mx-auto w-75 rounded">
            @endif
            <div class="position-relative w-100 p-2">
                <h6 class="text-center p-0 m-0 fs-6">
                    <a href="{{ route('web.about.list-of-director-generals.show',$sachib->id) }}"
                        class="showToolTip text-primary" title="Click to view detail">
                        {{ $sachib->name }}
                    </a>
                </h6>
                <p class="text-dark text-center p-0 m-0 fs-6">{{ $sachib->designation }}</p>
            </div>
        </div>
        @endif -->


        <!-- about side card two-->
        <!-- fb embeed -->
         
        @if(isset($contacts[0]->facebook_embeded)) 
        {!! $contacts[0]->facebook_embeded !!}
        @endif 
        @if(isset($contacts[0]->twitter_embeded)) 
        {!! $contacts[0]->twitter_embeded !!}
        @endif       
        <!-- <div class="fb-page" data-href="https://www.facebook.com/Techwarepvtltd" data-tabs="timeline" data-width="" data-height="" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Techwarepvtltd" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Techwarepvtltd">Techware Pvt. Ltd.</a></blockquote></div> -->

        <!-- <div class="framei"> 

        <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FTechwarepvtltd%2F&tabs=timeline&width=1000&height=210&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" height="210" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
        </div> -->
    </div>
</div>

</div>
<!-- SLIDER MAINSLIDER ABOUT ONE TWO -->

<!-- tab section -->
<!-- end  tab section -->




<!-- gallery -->
@if ($galleryhasimages->count())
        <div class="container site-section py-1">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 block-13 nav-direction-white" data-aos="fade-up">
                        <div class="text-center">
                            <!-- <span
                                class="caption d-block mb-2 font-secondary font-weight-bold">{{ __('lang.gallery')}}</span> -->
                            <h2 class="site-section-heading text-uppercase text-center font-secondary">
                                {{ __('lang.image_gallery')}}</h2>
                        </div>
                        <div class="nonloop-block-13 owl-carousel">
                            @foreach($galleryhasimages as $gallery)
                            <div class="media-image">
                                @if(Session()->get('APP_BAND') != 'low')
                                    <img src="{{URL::to('/')}}/image/gallery_has_image/thumbnail/{{$gallery->image_enc}}"" alt="
                                    {{$gallery->title}}" class="img-fluid h-100">
                                @endif
                            </div>
                            @endforeach
                        </div>
                        <div class="float-right">
                            <a class="fade00" href="{{ route('web.gallery.folder') }}">
                                {{ __('lang.explose_more')}}
                                <i class="fa fa-arrow-right"></i>

                                <span class="bg"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

<!-- footer -->
<div class="container">

</div>
<!-- INCREASE DECREACE -->

<!-- INCREASE DECREASE -->










{{-- modal --}}
@if ($notice_pop_bulletine)
<div id="myModal" class="modal fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content draggable-handler">
            {{-- <div class="modal-header">
        </div> --}}
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                @if ($notice_pop_bulletine->image_enc == Null)
                <h3>{{$notice_pop_bulletine->title}}</h3>
                {!! $notice_pop_bulletine->description !!}
                @else
                <h3>{{$notice_pop_bulletine->title}}</h3>
                @if ($notice_pop_bulletine->ext == 'pdf')
                <iframe src="{{URL::to('/')}}/files/notice/{{$notice_pop_bulletine->image_enc}}" height="500px"
                    width="100%"></iframe>
                @else
                @if(Session()->get('APP_BAND') != 'low')
                    <img src="{{URL::to('/')}}/files/notice/{{$notice_pop_bulletine->image_enc}}" class="img-fluid" style="height:90vh; width:100%;">
                @endif
                @endif
                @endif
            </div>
        </div>
    </div>
</div>
@endif
{{-- /.modal --}}
@endsection
@push('js')
<script type="text/javascript">
$("#tile-1 .nav-tabs a").click(function() {
    var position = $(this).parent().position();
    var width = $(this).parent().width();
    $("#tile-1 .slider").css({
        "left": +position.left,
        "width": width
    });
});
var actWidth = $("#tile-1 .nav-tabs").find(".active").parent("li").width();
var actPosition = $("#tile-1 .nav-tabs .active").position();
$("#tile-1 .slider").css({
    "left": +actPosition.left,
    "width": actWidth
});
</script>

{{-- <script src="{{URL::to('/')}}/web/js/jquery-ui.min.js"></script> --}}
<script type="text/javascript">
function loadFrame() {
    $('#myModal').modal('show');
    // $('#myModal').drags();
};
window.onload = setTimeout(loadFrame, 500);
</script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous"
    src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v13.0&appId=348090100205477&autoLogAppEvents=1"
    nonce="JQ9L0ki4"></script>
@endpush