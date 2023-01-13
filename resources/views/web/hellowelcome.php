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

@include('web.main.slider')

<!-- link -->
<!-- <div class="site-section first-section {{$sliders->count() ? '' : 'mt-0'}}">
    <div class="container">
      <div class="row border-responsive">
        <div class="col-md col-lg mb-4 mb-lg-0 border-right" data-aos="fade-up" data-aos-delay="">
          <a href="{{ route('web.notice.index', 'general-notice') }}" class="text-center">
            <span class="far fa-sticky-note display-4 d-block mb-3 text-danger"></span>
            <h3 class="text-uppercase h4 mb-3">{{ __('lang.general_notice')}}</h3>
          </a>
        </div>
        <div class="col-md col-lg mb-4 mb-lg-0 border-right" data-aos="fade-up" data-aos-delay="">
          <a href="{{ route('web.notice.index', 'procurement-notice') }}" class="text-center">
            <span class="far fa-sticky-note display-4 d-block mb-3 text-danger"></span>
            <h3 class="text-uppercase h4 mb-3">{{ __('lang.procurement_notice')}}</h3>
          </a>
        </div>
        <div class="col-md col-lg mb-4 mb-lg-0 border-right" data-aos="fade-up" data-aos-delay="100">
          <a href="{{ route('web.report.all') }}" class="text-center">
            <span class="fas fa-chart-bar display-4 d-block mb-3 text-danger"></span>
            <h3 class="text-uppercase h4 mb-3">{{ __('lang.report')}}</h3>
          </a>
        </div>
        <div class="col-md col-lg mb-4 mb-lg-0 border-right" data-aos="fade-up" data-aos-delay="400">
          <a href="{{ route('web.notice.index', 'bulletine-notice-board') }}" class="text-center">
            <span class="fas fa-align-left display-4 d-block mb-3 text-danger"></span>
            <h3 class="text-uppercase h4 mb-3">{{ __('lang.bulletin_notice_board')}}</h3>
          </a>
        </div>
        <div class="col-md col-lg mb-4 mb-lg-0" data-aos="fade-up" data-aos-delay="500">
          <a href="{{ route('web.list-of-projects-programmes') }}" class="text-center">
            <span class="fas fa-tasks display-4 d-block mb-3 text-danger"></span>
            <h3 class="text-uppercase h4 mb-3">{{ __('lang.list_of_project_s')}}</h3>
          </a>
        </div>
      </div>
    </div>
  </div> -->

<!-- main slider top -->
@if(count($slider_top))
<div class="site-section pt-4 pb-1 main-n-m-t">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                @foreach($abouts as $about)
                <div class="no-gutters align-items-stretch bg-light mb-2">
                    <div class="pl-3 pb-4 main-about-text" data-aos="fade-up" data-aos-delay="100">
                        <h2 class="site-section-heading text-uppercase font-secondary mb-1 pt-1">{{$about->title}}</h2>
                        <!-- <span class="caption d-block mb-2 font-secondary font-weight-bold">{{ __('lang.sanchipta')}}</span> -->
                        {!! substr($about->description,0,2550) !!}...
                        <div class="float-right text-dark">
                            <!-- <a class='btn007' href='{{ route('web.aboutUs.detail') }}'>
                            {{ __('lang.explose_more')}}
                                <span class='line-1'></span>
                                <span class='line-2'></span>
                                <span class='line-3'></span>
                                <span class='line-4'></span>
                                <i class="fa fa-arrow-right"></i>
                            </a> -->
                            <a class="float-right text-dark" href="{{ route('web.aboutUs.detail') }}"
                                style="margin-top:-12px; margin-right:15px;">
                                <span class="fade00">
                                    {{ __('lang.explose_more')}}<i class="fa fa-arrow-right"></i>
                                    <span class="bg"></span>
                                </span>

                            </a>
                            <!-- <a class="float-right text-dark" href="{{ route('web.aboutUs.detail') }}">
                                <span class="fade00">
                                {{ __('lang.explose_more')}}<i class="fa fa-arrow-right"></i>
                                <span class="bg"></span>
                                </span>                               
                                
                            </a> -->
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="col-md-3 pl-0">
                @if ($cores)
                @forelse ($cores_subs->slice(0, 2) as $c=>$cores_sub_record)
                <div class="position-relative mb-2 text-center" style="border:1px solid #D8D9CF;">
                    <img src="{{ url($cores_sub_record->image_enc ? 'image/core_person/thumbnail/'.$cores_sub_record->image_enc : 'image/noimage.png') }}"
                        alt="{{ $cores_sub_record->name }}" class="img-fluid mx-auto w-75 rounded">
                    <div class="position-relative w-100 p-2">
                        <h6 class="text-center p-0 m-0 fs-6">
                            <a href="{{ route('web.about.list-of-director-generals.show',$cores_sub_record->id) }}"
                                class="showToolTip text-primary" title="Click to view detail">
                                {{ $cores_sub_record->name }}
                            </a>
                        </h6>
                        <p class="text-dark text-center p-0 m-0 fs-6">{{ $cores_sub_record->designation }}</p>
                    </div>
                </div>
                @empty

                @endforelse
                @endif

            </div>

        </div>
    </div>
</div>
@endif
<!-- about -->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if(count($slider_top))
            <div class="site-section {{ $slider_top->count() ? 'pt-0 pb-2': 'pt-0 pb-2' }}">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 " style="background-color:#f8f9fa;">
                            @foreach($slider_top as $about)
                            <div class="no-gutters align-items-stretch">
                                <div class="main-about-text" data-aos="fade-up" data-aos-delay="100">
                                    <h2 class="site-section-heading text-uppercase font-secondary mb-1 pt-1">
                                        {{$about->name}}
                                    </h2>
                                    {!! substr($about->description,0,800) !!}
                                    <div class="float-right text-dark">
                                        <a class="fade00"
                                            href="{{ route('web.about.list-of-director-generals.show',$about->id) }}">
                                            {{ __('lang.explose_more')}}
                                            <i class="fa fa-arrow-right"></i>

                                            <span class="bg"></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="col-md-3 pl-2 pr-0 m-0 main-mt-sm-4 mt-xs-4">

                            @if (isset($cores_subs['2']))
                            <div class="position-relative mb-2 text-center" style="border:1px solid #D8D9CF;">
                                <img src="{{ url($cores_subs['2']->image_enc ? 'image/core_person/thumbnail/'.$cores_subs['2']->image_enc : 'image/noimage.png') }}"
                                    alt="{{ $cores_subs['2']->name }}" class="img-fluid mx-auto w-75 rounded">
                                <div class="position-relative w-100 p-2">
                                    <h6 class="text-center p-0 m-0 fs-6">
                                        <a href="{{ route('web.about.list-of-director-generals.show',$cores_subs['2']->id) }}"
                                            class="showToolTip text-primary" title="Click to view detail">
                                            {{ $cores_subs['2']->name }}
                                        </a>
                                    </h6>
                                    <p class="text-dark text-center p-0 m-0 fs-6">{{ $cores_subs['2']->designation }}
                                    </p>
                                </div>
                            </div>
                            @endif



                        </div>

                    </div>
                </div>
            </div>
            @endif

            <!-- tab -->
            <div class="cointainer-fluid mt-1">
                <div class="row">
                    <div class="col-md-9">
                        <div class="site-section py-0 ">
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
                                                        aria-selected="false">{{ __('lang.covid_notice_board')}}</a>
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
                                                    <div class="float-right">
                                                        <a class="fade00"
                                                            href="{{ route('web.notice.index', 'procurement-notice') }}">
                                                            {{ __('lang.explose_more')}}
                                                            <i class="fa fa-arrow-right"></i>

                                                            <span class="bg"></span>
                                                        </a>
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
                                                                <div class="py-3 w-100 justify-content-start">
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
                                                                        <i class="fas fa-file-pdf fa-3x"></i>
                                                                        {{-- {{ __('lang.download')}} --}}
                                                                    </div>
                                                                </a>
                                                                @else
                                                                <a href="javascript:void(0)"
                                                                    class="d-flex align-items-center text-muted text-center">
                                                                    <div class="m-3 w-100">
                                                                        <i class="fas fa-file-pdf fa-3x"></i>
                                                                    </div>
                                                                </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @empty
                                                        <div class="py-5"></div>
                                                        @endforelse
                                                    </div>
                                                    <div class="float-right">
                                                        <a class="fade00"
                                                            href="{{ route('web.notice.index', 'general-notice') }}">
                                                            {{ __('lang.explose_more')}}
                                                            <i class="fa fa-arrow-right"></i>

                                                            <span class="bg"></span>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="posting-notice" role="tabpanel"
                                                    aria-labelledby="posting-notice-tab">
                                                    <div class="no-gutters align-items-stretch mt-4 table-responsive">
                                                        <table class="table table-hover table-striped table-bordered">
                                                            <thead class="bg-dark text-light text-center">
                                                                <tr>
                                                                    <td width="5%">{{ __('lang.sn') }}</td>
                                                                    <td width="15%">{{ __('lang.date_s')}}</td>
                                                                    <td class="text-left">{{ __('lang.notice')}}
                                                                        {{ __('lang.title')}}</td>
                                                                    <td width="10%">{{ __('lang.download')}}</td>
                                                                    <td>{{ __('lang.remark')}}</td>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="text-center">
                                                                @forelse ($posting_notice as $key=>$posting_list)
                                                                <tr data-toggle="tooltip" data-placement="right"
                                                                    data-html="true"
                                                                    title="<small>{{$posting_list->title}}</small>">
                                                                    <td>{{$key+1}}</td>
                                                                    <td><small>{{ Date('j M, Y',strtotime($posting_list->date)) }}</small>
                                                                    </td>
                                                                    <td class="text-left">{{ $posting_list->title}}</td>
                                                                    <td class="text-danger">
                                                                        <a href="{{URL::to('/')}}/files/notice/{{$posting_list->image_enc}}"
                                                                            target="_blank" class="text-danger">
                                                                            <i class="fas fa-file-pdf fa-2x"></i>
                                                                            {{-- {{ __('lang.download')}} --}}
                                                                        </a>
                                                                    </td>
                                                                    <td class="text-left">
                                                                        {{$posting_list_remark}}
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
                                                    <div class="float-right">
                                                        <a class="fade00"
                                                            href="{{ route('web.notice.index', 'posting-notice') }}">
                                                            {{ __('lang.explose_more')}}
                                                            <i class="fa fa-arrow-right"></i>

                                                            <span class="bg"></span>
                                                        </a>
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
                                                                <div class="py-3 w-100 justify-content-start">
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
                                                                        <i class="fas fa-file-pdf fa-3x"></i>
                                                                        {{-- {{ __('lang.download')}} --}}
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        @empty
                                                        <div class="py-5"></div>
                                                        @endforelse
                                                    </div>
                                                    <div class="float-right">
                                                        <a class="fade00"
                                                            href="{{ route('web.notice.index', 'covid-notice-board') }}">
                                                            {{ __('lang.explose_more')}}
                                                            <i class="fa fa-arrow-right"></i>

                                                            <span class="bg"></span>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="regulation" role="tabpanel"
                                                    aria-labelledby="regulation-tab">
                                                    <div class="no-gutters align-items-stretch mt-4">
                                                        @forelse ($document_actregulation as $key=>$document_regulation)
                                                        <div data-aos="fade-up" data-aos-delay="{{$key+1}}00">
                                                            <div class="coupon bg-light rounded px-3 mb-3 d-flex justify-content-between border-dark coupon-shadow"
                                                                data-toggle="tooltip" data-placement="right"
                                                                data-html="true"
                                                                title="<small>{{ __('lang.download')}}</small>">
                                                                <div class="py-3 w-100 justify-content-start">
                                                                    <div class="d-block mr-2">
                                                                        <h3 class="lead" data-toggle="tooltip"
                                                                            data-placement="top" data-html="true"
                                                                            title="<small>{{$document_regulation->title}}</small>">
                                                                            {{ $document_regulation->title}}</h3>
                                                                       
                                                                        <small>{{ $document_regulation->created_at->diffForHumans() == '1 day ago' ? Date('j F, Y', strtotime($document_regulation->created_at)) : $document_regulation->created_at->diffForHumans() }}</small>
                                                                    </div>
                                                                </div>
                                                                <div class="kanan">
                                                                    <span class="download-section"></span>
                                                                </div>
                                                                <a href="{{URL::to('/')}}/files/document/{{$document_regulation->image_enc}}"
                                                                    target="_blank"
                                                                    class="d-flex align-items-center text-danger text-center">
                                                                    <div class="m-3 w-100">
                                                                        <i class="fas fa-file-pdf fa-3x"></i>
                                                                        <!-- {{ __('lang.download')}} -->
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        @empty
                                                        <div class="py-5"></div>
                                                        @endforelse
                                                    </div>
                                                    <div class="float-right">
                                                        <a class="fade00"
                                                            href="{{ route('web.document.index', 'acts-regulation') }}">
                                                            {{ __('lang.explose_more')}}
                                                            <i class="fa fa-arrow-right"></i>

                                                            <span class="bg"></span>
                                                        </a>
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="section" role="tabpanel"
                                                    aria-labelledby="section-tab">
                                                    <div class="no-gutters align-items-stretch mt-4">
                                                        <div class="row">
                                                            @forelse ($division_sections as $key=>$section_list)
                                                            <div class="col-md-6 mb-4">
                                                                <div class="media">
                                                                    <img src="{{URL::to('/')}}/image/division_section/thumbnail/{{$section_list->image_enc}}"
                                                                        class="img-fluid mr-3"
                                                                        alt="{{$section_list->title}}" width="25%">
                                                                    <div class="media-body para-m-0">
                                                                        <h5 class="mt-0 mb-1">{{$section_list->title}}
                                                                        </h5>
                                                                        {{-- {!!  substr($section_list->description,0, 70) !!} --}}
                                                                        @php
                                                                        $page = 0;
                                                                        if($section_list->page == 1){
                                                                        $page =
                                                                        'planning_program_and_co_ordination_division';
                                                                        }
                                                                        if($section_list->page == 2){
                                                                        $page = 'multipurpose_and_irrigation_division';
                                                                        }
                                                                        if($section_list->page == 3){
                                                                        $page =
                                                                        'water_induced_disaster_management_division';
                                                                        }
                                                                        if($section_list->page == 4){
                                                                        $page =
                                                                        'underground_water_and_geographical_division';
                                                                        }
                                                                        if($section_list->page == 5){
                                                                        $page = 'irrigation_management_division';
                                                                        }
                                                                        if($section_list->page == 6){
                                                                        $page = 'administration_section';
                                                                        }
                                                                        if($section_list->page == 7){
                                                                        $page = 'account_section';
                                                                        }
                                                                        if($section_list->page == 8){
                                                                        $page = 'act_law_consultation_section';
                                                                        }
                                                                        @endphp
                                                                        <div class="float-right">
                                                                            <a class="fade00"
                                                                                href="{{ route('web.division-section.index', $page) }}">
                                                                                {{ __('lang.explose_more')}}
                                                                                <i class="fa fa-arrow-right"></i>

                                                                                <span class="bg"></span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @empty
                                                            @endforelse
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="citizen-charter" role="tabpanel"
                                                    aria-labelledby="citizen-charter-tab">
                                                    <div class="no-gutters align-items-stretch mt-4">
                                                        @forelse ($citizen_charters as $key=>$citizen_charter)
                                                        <div data-aos="fade-up" data-aos-delay="{{$key+1}}00">
                                                            <div class="coupon bg-light rounded px-3 mb-3 d-flex justify-content-between border-dark coupon-shadow"
                                                                data-toggle="tooltip" data-placement="right"
                                                                data-html="true"
                                                                title="<small>{{ __('lang.download')}}</small>">
                                                                <div class="py-3 w-100 justify-content-start">
                                                                    <div class="d-block mr-2">
                                                                        <h3 class="lead" data-toggle="tooltip"
                                                                            data-placement="top" data-html="true"
                                                                            title="<small>{{$citizen_charter->title}}</small>">
                                                                            {{$citizen_charter->title}}</h3>
                                                                       
                                                                        {{-- <div class="float-right">
                                  <a class="fade00" href="">
                                    {{ __('lang.read_more')}}
                                                                        <i class="fa fa-arrow-right"></i>

                                                                        <span class="bg"></span>
                                                                        </a>
                                                                    </div> --}}
                                                                    <small>{{ $citizen_charter->created_at->diffForHumans() == '1 day ago' ? Date('j F, Y', strtotime($citizen_charter->created_at)) : $citizen_charter->created_at->diffForHumans() }}</small>
                                                                </div>
                                                            </div>
                                                            <div class="kanan">
                                                                <span class="download-section"></span>
                                                            </div>
                                                            <a href="{{URL::to('/')}}/files/document/{{$citizen_charter->image_enc}}"
                                                                target="_blank"
                                                                class="d-flex align-items-center text-danger text-center">
                                                                <div class="m-3 w-100">
                                                                    <i class="fas fa-file-pdf fa-3x"></i>
                                                                    {{-- {{ __('lang.download')}} --}}
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    @empty
                                                    <div class="py-5"></div>
                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($rastriyagorkhaayojans->count())
                                <div class="col-lg-4 main-mt-sm-4">
                                    <div class="mb-5" data-aos="fade-up" data-aos-delay="200">
                                        <h2 class="site-section-heading text-uppercase font-secondary mb-5">
                                            {{ __('lang.national_pride_project')}}</h2>
                                        <ul class="list-group list-group-flush flush-border list-arrow">
                                            @foreach($rastriyagorkhaayojans as $aayojan)
                                            <li class="list-group-item px-0" data-toggle="tooltip" data-placement="top"
                                                data-html="true" title="<small>{!! $aayojan->description !!}</small>">
                                                <a class="text-dark"
                                                    href="{{$aayojan->link ? $aayojan->link : 'javascript:void(0);'}}"
                                                    target="{{$aayojan->link ? '_blank' : '_self'}}">{!! $aayojan->title
                                                    !!}<i class="fas fa-chevron-right float-right"></i></a>
                                            </li>
                                            @endforeach
                                        </ul>
                                        <a class='animated-arrow float-right'
                                            href='{{ route('web.rastriyaAyojana.index') }}'>
                                            <span class='the-arrow -left'>
                                                <span class='shaft'></span>
                                            </span>
                                            <span class='main'>
                                                <span class='text'>
                                                    {{ __('lang.explose_more')}}
                                                </span>
                                                <span class='the-arrow -right'>
                                                    <span class='shaft'></span>
                                                </span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                @endif


                            </div>

                        </div>


                    </div>



                </div>
                <div class="col-md-3 col-xs-12 pl-0 container fbiframe">
                    <!-- facebook embeed -->
                    <iframe
                        src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FTechwarepvtltd%2F&tabs=timeline&width=180&height=400&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId"
                        width="420px" height="400" style="border:none;overflow:hidden" scrolling="no" frameborder="0"
                        allowfullscreen="true"
                        allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share">
                    </iframe>
                </div>
            </div>

        </div>

        <!-- DONT DELETE MEMBER INFO SECTION -->
        <!-- member info -->
        <!-- DYNAMIC MEMBER INFO  -->
        <!-- @if ($corepersons->count())
        <div class="site-section {{$galleryhasimages->count() ? 'bg-light py-1' : 'bg-light pb-5 pt-0'}}">
            <div class="container">
                <div class="row">
                    @foreach($corepersons as $key=>$coreperson)
                    <div class="col-md-4">
                        <div class="card pt-4 border-0 align-items-center text-center"
                            data-aos="fade-{{ $key == 0 ? 'right' : 'left'}}" data-aos-delay="{{ $key+1 }}00">
                            <img src="{{URL::to('/')}}/image/core_person/{{$coreperson->image_enc}}"
                                class="img-fluid main-img-spoke" alt="{{$coreperson->name}}">
                            <a href="{{ route('web.about.list-of-director-generals.show',$coreperson->id) }}"
                                class="card-body" data-toggle="tooltip" data-placement="top" data-html="true" title="<small>
                              {{$coreperson->name}}<br>
                              {{$coreperson->designation}}<br>
                              <b class='text-success'>Phone:</b> {{$coreperson->phone}}<br>
                              <b class='text-success'>Fax:</b> {{$coreperson->fax}}<br>
                              <b class='text-success'>Email:</b> {{$coreperson->email}}
                            </small>">
                                <h5 class="card-title">{{$coreperson->name}}</h5>
                                <p class="card-text mb-1">{{$coreperson->designation}}</p>
                                <h6 class="text-dark">{{$coreperson->phone}}</h6>
                                <h6 class="text-dark">{{$coreperson->email}}</h6>
                            </a>
                        </div>
                    </div>
                    {{-- <div class="col-md-4">
                <div class="blog-card text-dark" data-aos="fade-{{ $key == 0 ? 'right' : 'left'}}"
                    data-aos-delay="{{ $key+1 }}00" data-toggle="tooltip" data-placement="top" data-html="true"
                    title="<small>
                        {{$coreperson->name}}<br>
                        {{$coreperson->designation}}<br>
                        <b class='text-success'>Phone:</b> {{$coreperson->phone}}<br>
                        <b class='text-success'>Fax:</b> {{$coreperson->fax}}<br>
                        <b class='text-success'>Email:</b> {{$coreperson->email}}
                    </small>">
                    'alt' class for right
                    <div class="meta">
                        <a href="{{ route('web.about.list-of-director-generals.show',$coreperson->id) }}"
                            class="text-hover-a">
                            <div class="photo"
                                style="background-image: url({{URL::to('/')}}/image/core_person/{{$coreperson->image_enc}})">
                            </div>
                        </a>
                    </div>
                    <div class="description text-sm-center-main">
                        <h6 class="font-weight-bold">
                            <a
                                href="{{ route('web.about.list-of-director-generals.show',$coreperson->id) }}">{{$coreperson->name}}</a>
                        </h6>
                        <p>{{ $coreperson->designation }}</p>
                        <ul class="list-unstyled list">
                            <li class="mb-2 d-flex align-items-center"><i class="fa fa-phone mr-3 text-danger"></i>
                                {{ $coreperson->phone }}</li>
                            <li class="mb-2 d-flex align-items-center" data-toggle="tooltip" data-placement="left"
                                data-html="true" title="Fax"><i class="fa fa-fax mr-3 text-danger"></i>
                                {{ $coreperson->fax }}</li>
                            <li class="mb-2 d-flex align-items-center"><i
                                    class="far fa-paper-plane mr-3 text-danger"></i>{{ $coreperson->email}}</li>
                        </ul>
                    </div>
                </div>
            </div> --}}
            {{-- <div class="col-md-4">
                <div class="blog-card text-dark" data-aos="fade-{{ $key == 0 ? 'right' : 'left'}}"
            data-aos-delay="{{ $key+1 }}00" data-toggle="tooltip" data-placement="top" data-html="true" title="<small>
                {{$coreperson->name}}<br>
                {{$coreperson->designation}}<br>
                <b class='text-success'>Phone:</b> {{$coreperson->phone}}<br>
                <b class='text-success'>Fax:</b> {{$coreperson->fax}}<br>
                <b class='text-success'>Email:</b> {{$coreperson->email}}
            </small>">
            'alt' class for right
            <div class="meta">
                <a href="{{ route('web.about.list-of-director-generals.show',$coreperson->id) }}" class="text-hover-a">
                    <div class="photo"
                        style="background-image: url({{URL::to('/')}}/image/core_person/{{$coreperson->image_enc}})">
                    </div>
                </a>
            </div>
            <div class="description text-sm-center-main">
                <h6 class="font-weight-bold">
                    <a
                        href="{{ route('web.about.list-of-director-generals.show',$coreperson->id) }}">{{$coreperson->name}}</a>
                </h6>
                <p>{{ $coreperson->designation }}</p>
                <ul class="list-unstyled list">
                    <li class="mb-2 d-flex align-items-center"><i class="fa fa-phone mr-3 text-danger"></i>
                        {{ $coreperson->phone}}</li>
                    <li class="mb-2 d-flex align-items-center" data-toggle="tooltip" data-placement="left"
                        data-html="true" title="Fax"><i class="fa fa-fax mr-3 text-danger"></i> {{ $coreperson->fax }}
                    </li>
                    <li class="mb-2 d-flex align-items-center"><i
                            class="far fa-paper-plane mr-3 text-danger"></i>{{ $coreperson->email }}</li>
                </ul>
            </div>
        </div>
    </div> --}}
    @endforeach

</div>
</div>
</div>
@endif -->

        <!-- HOME BLOCK SECTION -->
        <section class="mt-3">
            <div class="row">
                <div class="col-md-9">

                    <div class="block-grid">
                        <div class="row">
                            <div class="col-md mb-3 col-6">
                                <div class="card1 text-center gradient-bg text-light">
                                    <i class="fa fa-3x fa-comments"></i>
                                    <h5 class="fs-6" style="color:#f8f9fa;"> <a
                                            href="{{ route('web.about.objective') }}" class="text-light">
                                            {{ __('lang.our_objective')}}
                                        </a>
                                    </h5>
                                </div>
                            </div>
                            <!-- <div class="col-md mb-3 col-6">
                                <div class="card1 text-center gradient-bg text-light">
                                    <i class="fa fa-3x fa-comments"></i>
                                    <h5 class="fs-6" style="color:#f8f9fa;"> <a href="{{ route('web.about.organization-structure') }}" class="text-light"> {{ __('lang.organizational_structure')}}
                                        </a>
                                    </h5>
                                </div>
                            </div> -->
                            <div class="col-md mb-3 col-6">
                                <div class="card1 text-center gradient-bg text-light">
                                    <i class="fa fa-3x fa-comments"></i>
                                    <h5 class="fs-6" style="color:#f8f9fa;"> <a
                                            href="{{ route('web.about.section-detail') }}" class="text-light">
                                            {{ __('lang.section_detail')}}
                                        </a>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-md mb-3 col-6">
                                <div class="card1 text-center gradient-bg text-light">
                                    <i class="fa fa-3x fa-comments"></i>
                                    <h5 class="fs-6" style="color:#f8f9fa;"> <a
                                            href="{{ route('web.about.office.index') }}" class="text-light">
                                            {{ __('lang.office')}}
                                        </a>
                                    </h5>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md mb-3 col-6">
                                <div class="card1 text-center gradient-bg text-light">
                                    <i class="fa fa-3x fa-comments"></i>
                                    <h5 class="fs-6" style="color:#f8f9fa;"> <a
                                            href="{{ route('web.document.index', 'act') }}" class="text-light">
                                            {{ __('lang.act')}}
                                        </a>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-md mb-3 col-6">
                                <div class="card1 text-center gradient-bg text-light">
                                    <i class="fa fa-3x fa-comments"></i>
                                    <h5 class="fs-6" style="color:#f8f9fa;"> <a
                                            href="{{ route('web.document.index', 'regulation') }}" class="text-light">
                                            {{ __('lang.regulation')}}
                                        </a>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-md mb-3 col-6">
                                <div class="card1 text-center gradient-bg text-light">
                                    <i class="fa fa-3x fa-comments"></i>
                                    <h5 class="fs-6" style="color:#f8f9fa;"> <a
                                            href="{{ route('web.document.index', 'act_rule') }}" class="text-light">
                                            {{ __('lang.act_rule')}}
                                        </a>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-md mb-3 col-6">
                                <div class="card1 text-center gradient-bg text-light">
                                    <i class="fa fa-3x fa-comments"></i>
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
                                    <i class="fa fa-3x fa-comments"></i>
                                    <h5 class="fs-6" style="color:#f8f9fa;"> <a
                                            href="{{ route('web.report.index', 'yearly-report') }}" class="text-light">
                                            {{ __('lang.yearly_report')}}
                                        </a>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-md mb-3 col-6">
                                <div class="card1 text-center gradient-bg text-light">
                                    <i class="fa fa-3x fa-comments"></i>
                                    <h5 class="fs-6" style="color:#f8f9fa;"> <a
                                            href="{{ route('web.notice.index', 'general-notice') }}" class="text-light">
                                            {{ __('lang.general_notice')}}
                                        </a>
                                    </h5>
                                </div>
                            </div>
                            <div class="col-md mb-3 col-6">
                                <div class="card1 text-center gradient-bg text-light">
                                    <i class="fa fa-3x fa-comments"></i>
                                    <h5 class="fs-6" style="color:#f8f9fa;"> <a
                                            href="{{ route('web.notice.index', 'procurement-notice') }}"
                                            class="text-light"> {{ __('lang.procurement_notice')}}
                                        </a>
                                    </h5>
                                </div>
                            </div>

                        </div>
                        <div class="row">


                            <div class="col-md mb-3 col-6">
                                <div class="card1 text-center gradient-bg text-light">
                                    <i class="fa fa-3x fa-map-marker"></i>
                                    <h5 class="fs-6" style="color:#f8f9fa;"> <a
                                            href="{{ route('web.notice.index', 'covid-notice-board') }}"
                                            class="text-light"> {{ __('lang.covid_notice_board')}}
                                        </a>
                                    </h5>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-md-3 pl-0 pl-0">
                    <iframe
                        src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FTechwarepvtltd%2F&tabs=timeline&width=180&height=400&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId"
                        width="180" height="400" style="border:none;overflow:hidden" scrolling="no" frameborder="0"
                        allowfullscreen="true"
                        allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                </div>
            </div>
        </section>


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
                                <img src="{{URL::to('/')}}/image/gallery_has_image/thumbnail/{{$gallery->image_enc}}"" alt="
                                    {{$gallery->title}}" class="img-fluid h-100">
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
    </div>
    <!-- <div class="col-md-3 mt-5">
        @foreach($contacts as $contact)
        {!! $contact->facebook_embeded !!}
        {!! $contact->twitter_embeded !!}

        <a class="twitter-timeline" href="https://twitter.com/TwitterDev/lists/national-parks?ref_src=twsrc%5Etfw" data-height="350">A Twitter List by TwitterDev</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
      <div class="fb-page" data-href="https://www.facebook.com/Techwarepvtltd" data-tabs="timeline" data-width="" data-height="" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/Techwarepvtltd" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/Techwarepvtltd">Techware Pvt. Ltd.</a></blockquote></div>
        @endforeach
    </div> -->
</div>
</div>

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
                <img src="{{URL::to('/')}}/files/notice/{{$notice_pop_bulletine->image_enc}}" class="img-fluid">
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
window.onload = setTimeout(loadFrame, 5000);
</script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous"
    src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v13.0&appId=348090100205477&autoLogAppEvents=1"
    nonce="JQ9L0ki4"></script>
@endpush