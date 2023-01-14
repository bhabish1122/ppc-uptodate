<div class="site-navbar-wrap js-site-navbar" id="navsticky">
  <div class="site-navbar">
    <div class=" menu-gradient">
      <nav class="site-navigation" role="navigation">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-md-3">
                <a href="#" class="site-menu-toggle js-menu-toggle text-black">
                  <span class="icon-menu h3 text-light"></span>
                </a>
              </div>
             
              <ul class="site-menu js-clone-nav d-none p-0 d-lg-flex justify-content-between">
                <li class="{{ (request()->is('/')) ? 'active' : '' }}"><a href="{{route('web.welcome')}}">{{ __('lang.home')}}</a></li>
                
                <li class="has-children {{ (request()->is('about/*')) ? 'active' : '' }}">
                  <a href="javascript:void(0);" >{{ __('lang.about')}}</a>
                  <ul class="dropdown arrow-top">
                    <li class="{{ (request()->is('about/background')) ? 'active' : '' }}">
                      <a href="{{ route('web.about.background') }}">{{ __('lang.background')}}</a>
                    </li>  
                    <li class="{{ (request()->is('about/mission-vision')) ? 'active' : '' }}">
                      <a href="{{ route('web.about.mission-vision') }}">{{ __('lang.mission_vision')}}</a>
                    </li>  
                    <li class="{{ (request()->is('about/our-objective')) ? 'active' : '' }}">
                      <a href="{{ route('web.about.objective') }}">{{ __('lang.our_objective')}}</a></li>  
                    <li class="{{ (request()->is('about/organization-structure')) ? 'active' : '' }}">
                      <a href="{{ route('web.about.organization-structure') }}">{{ __('lang.organizational_structure')}}</a>
                    </li>  
                    <!-- <li class="{{ (request()->is('about/list-of-director-generals')) ? 'active' : '' }}">
                      <a href="{{ route('web.about.list-of-director-generals') }}">{{ __('lang.list_of_director_generals')}}</a>
                    </li> -->  
                    <li class="{{ (request()->is('about/section-detail')) ? 'active' : '' }}">
                      <a href="{{ route('web.about.section-detail') }}">{{ __('lang.section_detail')}}</a>
                    </li>
                    <li class="{{ (request()->is('about/office')) ? 'active' : '' }}">
                      <a href="{{ route('web.about.office.index') }}">{{ __('lang.office')}}</a>
                    </li>  
                  </ul>
                </li>
                <!-- <li class="{{ (request()->is('contact')) ? 'active' : '' }}"><a href="{{ route('web.contact') }}">{{ __('lang.directorate_bibagh')}}</a>
                </li> -->
                <!-- <li class="{{ (request()->is('year-program-&-budget')) ? 'active' : '' }}"><a href="{{ route('web.year-program-&-budget.index') }}">{{ __('lang.year_program_budget')}}</a>
                </li> -->

                          {{-- PLMBIS --}}
                {{-- <li class="{{ (request()->is('about/organization-structure')) ? 'active' : '' }}">
                      <a href="http://p1.plmbis.gov.np/login">{{ __('PLMBIS')}}</a>
                  </li>  --}}

                <li class="has-children {{ (request()->is('document/*')) ? 'active' : '' }}">
                  <a href="javascript:void(0);">{{ __('lang.document')}}</a>
                  <ul class="dropdown arrow-top">
                    <li><a href="{{ route('web.document.index', 'act') }}">{{ __('lang.act')}}</a></li>
                    <li><a href="{{ route('web.document.index', 'regulation') }}">{{ __('lang.regulation')}}</a></li>  
                    <li><a href="{{ route('web.document.index', 'act_rule') }}">{{ __('lang.act_rule')}}</a></li>  
                    <li><a href="{{ route('web.document.index', 'nirdeshika') }}">{{ __('lang.nirdeshika')}}</a></li>
                    {{-- <li><a href="{{ route('web.document.index', 'red-book') }}">{{ __('lang.red-book')}}</a></li> 
                    <li><a href="{{ route('web.document.index', 'bid') }}">{{ __('lang.bid')}}</a></li> 
                    <li><a href="{{ route('web.document.index', 'economicsurvey') }}">{{ __('lang.economicsurvey')}}</a></li> 
                    <li><a href="{{ route('web.document.index', 'reportrighttoinfo') }}">{{ __('lang.reportrighttoinfo')}}</a></li> 
                    <li><a href="{{ route('web.document.index', 'mediumexpenditure') }}">{{ __('lang.mediumexpenditure')}}</a></li>  --}}
                    <li><a href="{{ route('web.document.index', 'other') }}">{{ __('lang.other')}}</a></li> 

                  </ul>
                </li>
                <li class="has-children {{ (request()->is('report/*')) ? 'active' : '' }}">
                  <a href="javascript:void(0);" >{{ __('lang.report')}}/{{__('lang.publication')}}</a>
                  <ul class="dropdown arrow-top">
                    <!-- <li><a href="{{ route('web.report.index', 'pre-feasibility') }}">{{ __('lang.pre_feasibility')}}</a></li>
                    <li><a href="{{ route('web.report.index', 'feasibility') }}">{{ __('lang.feasibility')}}</a></li> 
                    <li><a href="{{ route('web.report.index', 'detail-feasibility') }}">{{ __('lang.detail_feasibility')}}</a></li> -->
                    <li><a href="{{ route('web.report.index', 'monthly-report') }}">{{ __('lang.monthly_report')}}</a></li>                   
                    <li><a href="{{ route('web.report.index', 'quaterly-report') }}">{{ __('lang.quaterly_report')}}</a></li>
                    <li><a href="{{ route('web.report.index', 'semi-annual-report') }}">{{ __('lang.semi_report')}}</a></li>                   
                    <li><a href="{{ route('web.report.index', 'yearly-report') }}">{{ __('lang.yearly_report')}}</a></li>    
                    <li><hr style="background-color:white"></li>     
                    <li><a href="{{ route('web.report.index', 'additional planning') }}">{{__('lang.additional planning')}}</a></li> 
                    <li><a href="{{ route('web.report.index', 'midterm review') }}"">{{__('lang.midterm review')}}</a></li>             
                    
                    {{-- <li><a href="{{ route('web.report.index', 'jinsi') }}">{{ __('lang.jinsi')}}</a></li>                   
                    <li><a href="{{ route('web.report.index', 'suchanako') }}">{{ __('lang.suchanako')}}</a></li>                   
                    <li><a href="{{ route('web.report.index', 'budget') }}">{{ __('lang.budget')}}</a></li>                   
                    <li><a href="{{ route('web.report.index', 'karya') }}">{{ __('lang.karya')}}</a></li>                   
                    <li><a href="{{ route('web.report.index', 'lekha') }}">{{ __('lang.lekha')}}</a></li>                   
                    <li><a href="{{ route('web.report.index', 'aantarik') }}">{{ __('lang.aantarik')}}</a></li>                   
                    <li><a href="{{ route('web.report.index', 'ek') }}">{{ __('lang.ek')}}</a></li>                    --}}
                  </ul>
                </li> 

                <li class="has-children {{ (request()->is('notice/*')) ? 'active' : '' }}">
                  <a href="javascript:void(0);" >{{ __('lang.notice')}}</a>
                  <ul class="dropdown arrow-top">
                    <li><a href="{{ route('web.notice.index', 'general-notice') }}">{{ __('lang.general_notice')}}</a></li>  
                    <li><a href="{{ route('web.notice.index', 'procurement-notice') }} ">{{ __('lang.procurement_notice')}}</a></li>  
                    <!-- <li><a href="{{ route('web.notice.index', 'posting-notice') }} ">{{ __('lang.posting_notice')}}</a></li>  
                    <li><a href="{{ route('web.notice.index', 'publication') }} ">{{ __('lang.publication')}}</a></li>  
                    <li><a href="{{ route('web.notice.index', 'circular') }} ">{{ __('lang.circular')}}</a></li> -->  
                    <li><a href="{{ route('web.notice.index', 'bulletine-notice-board') }} ">{{ __('lang.bulletin_notice_board')}}</a></li> 
                    <!-- <li><a href="{{ route('web.notice.index', 'covid-notice-board') }} ">{{ __('lang.covid_notice_board')}}</a></li>   -->
                  </ul>
                </li> 

                  <li class="has-children  {{ (request()->is('notice/*')) ? 'active' : '' }}">
                    <a href="javascript:void(0);" >{{__('lang.important form')}}</a>
                    <ul class="dropdown arrow-top">
                      <li><a href="{{ route('web.importantform.index','daily-form') }}">{{ __('lang.daily form')}}</a></li>  
                      <li><a href="{{ route('web.importantform.index','other') }}">{{ __('lang.other')}}</a></li>  
                      <li><a href="{{ route('web.importantform.index','information-collection-form') }}"">{{__('lang.information collection form')}}</a></li>     
                    </ul>
                  </li>
                {{-- Bill Sarwajanikaran --}}
                {{-- <li class="{{ (request()->is('/bill')) ? 'active' : '' }}">
                      <a href="{{ route('web.about.bill') }}">{{ __('lang.bill')}}</a>
                    </li>  --}}

                {{-- <li class="{{ (request()->is('gallery*')) ? 'active' : '' }}"><a href="{{ route('web.gallery.folder') }}">{{ __('lang.download')}}</a></li>
                <li class="{{ (request()->is('list-of-projects-programmes')) ? 'active' : '' }}"><a href="{{ route('web.list-of-projects-programmes') }}">{{ __('lang.nagarik_wodapatra')}} </a></li>
                <li class="has-children {{ (request()->is('gallery/*')) ? 'active' : '' }}">
                  <a href="javascript:void(0);" >{{ __('lang.forms')}}</a>
                  <ul class="dropdown arrow-top">
                    <li><a href="{{ route('web.gallery.folder', 'general-gallery') }}">{{ __('lang.form.sujab')}}</a></li>  
                    <li><a href="{{ route('web.gallery.folder', 'general-gallery') }}">{{ __('lang.form.gulaso')}}</a></li>  
                    <li><a href="{{ route('web.gallery.folder', 'general-gallery') }}">{{ __('lang.form.ujuri')}}</a></li>  
                      
                  </ul>
                </li> --}}
                <li class="has-children {{ (request()->is('gallery/*')) ? 'active' : '' }}">
                  <a href="javascript:void(0);" >{{ __('lang.gallery')}}</a>
                  <ul class="dropdown arrow-top">
                    <li><a href="{{ route('web.gallery.folder') }}">{{ __('lang.image_gallery')}}</a></li>  
                    <li><a href="{{ route('web.gallery.video.index') }} ">{{ __('lang.video_gallery')}}</a></li>  
                  </ul>
                </li>        
                <!-- <li class="{{ (request()->is('gallery*')) ? 'active' : '' }}"><a href="{{ route('web.gallery.folder') }}">{{ __('lang.gallery')}}</a></li> -->
                <li class="{{ (request()->is('contact')) ? 'active' : '' }}"><a href="{{ route('web.contact') }}">{{ __('lang.contact')}}</a></li>
                <li class=" d-md-none">
                  <a href="{{-- route('lang.change','en') --}}" class="lang" id="en">
                    {{-- <img src="{{URL::to('/')}}/web/images/en.png" class="img-fluid lang" id="en"> --}}
                    English
                  </a>
                </li>
                <li class="d-md-none">
                  <a href="{{-- route('lang.change','np') --}}" class="lang" id="np">
                    {{-- <img src="{{URL::to('/')}}/web/images/np.png" class="img-fluid lang" id="np"> --}}
                    
                    नेपाली
                  </a>
                </li>
                <li>
                  <a href="#search">
                    <i class="fa fa-search"></i> 
                    <span class="d-md-none">{{ __('lang.search')}}</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
    </div>
  </div>
</div>
<!-- search box -->
<div id="search">
  <button type="button" class="close">X</button>

  <form method="GET" action="{{ route('web.search.result') }}" autocomplete="off">
    @csrf
    <input type="text" name="title" placeholder="{{ __('lang.search')}}..."/>

    <div class="switch-list d-flex">
      <div class="custom-control custom-radio text-light mr-4">
        <input type="radio" id="notice" name="selected" value="1" class="custom-control-input" checked>
        <label class="custom-control-label" for="notice">{{ __('lang.notice')}}</label>
      </div>
      <div class="custom-control custom-radio text-light mr-4">
        <input type="radio" id="document" name="selected" value="2" class="custom-control-input">
        <label class="custom-control-label" for="document">{{ __('lang.document')}}</label>
      </div>
      <div class="custom-control custom-radio text-light mr-4">
        <input type="radio" id="report" name="selected" value="3" class="custom-control-input">
        <label class="custom-control-label" for="report">{{ __('lang.report')}}</label>
      </div>

    </div>
    <button type="submit" class="btn btn-outline-light d-inline-block">{{ __('lang.search')}}</button>
  </form>
</div>
<script>
// When the user scrolls the page, execute myFunction
window.onscroll = function() {myFunction()};

// Get the header
var header = document.getElementById("navsticky");

// Get the offset position of the navbar
var sticky = navsticky.offsetTop;

// Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
  if (window.pageYOffset > sticky) {
    navsticky.classList.add("sticky");
  } else {
    navsticky.classList.remove("sticky");
  }
}
</script>