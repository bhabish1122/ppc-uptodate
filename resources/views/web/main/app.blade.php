<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @if(app()->getLocale() == 'en')
    <title>@stack('seo_title') {{ $config ? $config->title.', ' : ''}} {{ $config ? $config->office.', ' : '' }},
        {{ $config ? $config->address : '' }}</title>
    @else
    <title>@stack('seo_title') {{ $config ? $config->title_np.', ' : ''}} {{ $config ? $config->office_np.', ' : '' }},
        {{ $config ? $config->address_np : '' }}</title>
    @endif
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Techware Pvt. Ltd.">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel='shortcut icon' type='image/x-icon' href="{{URL::to('/')}}/web/favicon.ico" />
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,700|Work+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::to('/')}}/web/fonts/icomoon/style.css">

    <link rel="stylesheet" href="{{URL::to('/')}}/web/css/bootstrap.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/web/css/magnific-popup.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/web/css/jquery-ui.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/web/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/web/css/owl.theme.default.min.css">
    {{-- <link rel="stylesheet" href="{{URL::to('/')}}/web/css/bootstrap-datepicker.css"> --}}
    <link rel="stylesheet" href="{{URL::to('/')}}/web/css/animate.css">

    <link rel="stylesheet" href="{{URL::to('/')}}/web/plugin/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/web/fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="{{URL::to('/')}}/web/css/aos.css">

    <link rel="stylesheet" href="{{URL::to('/')}}/web/css/style.css">
    <link rel="stylesheet" href="{{URL::to('/')}}/web/css/style.main.css">
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v13.0&appId=2026034011047670&autoLogAppEvents=1"
        nonce="8OTfnwvH"></script>


    {{-- <link rel="stylesheet" href="{{URL::to('/')}}/web/css/fixed-right.main.css"> --}}

    @stack('css')
</head>


<body class="data">
    {{-- <div id="overlayer"></div> --}}
    {{-- <div class="loader">
    <div class="d-flex align-items-center loader-np">
      <img src="{{URL::to('/')}}/web/images/flag.gif" class="img-fluid w-25 pr-3">
    <img src="{{URL::to('/')}}/web/images/icon-dwri.png" class="img-fluid w-25">
    </div>
    </div> --}}
    <!-- scroll to top -->
    <div class="arrow-btn">
        <button  onclick="window.scrollTo(0, 0);"  title="Go to top"
            class="fas fa-angle-double-up arrow-btn text-center"></button>
        <!-- <a scrollto href="#scroll"> <span class="fas fa-angle-double-up"> </span> </a> -->
    </div>

    <div class="site-wrap" id="scroll">
        <div class="site-mobile-menu">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div> <!-- .site-mobile-menu -->

        <!-- header top -->
        <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script type="text/javascript">
        $(function () {
            $(".font-button").bind("click", function () {
                var size = parseInt($('body').css("font-size"));
                if ($(this).hasClass("plus")) {
                    size = size + 2;
                } else {
                    size = size - 2;
                    if (size <= 10) {
                        size = 10;
                    }
                }
                $('body').css("font-size", size);
            });
        });
    </script> -->

        <div class="sizeadjust">
            <div class="sizeadjus">
                <div class="toppppp">

                    <div class="d-none d-md-block d-lg-block col-md-12 col-sm-12 text-right pb-1  ">

                        <a href="{{ route('web.LangChange','en') }}" class="button12 imgContainerntn">
                            En
                        </a>

                        <a href="{{ route('web.LangChange','np') }}" class="button12 imgContainerntn">
                            Ne
                        </a>

                        @if(Session()->get('APP_BAND')=='low')
                        <a href="{{ route('web.BandChange','normal') }}" class="button12 imgContainerntn">Normal
                            bandwidth</a>
                        @else
                        <a href="{{ route('web.BandChange','low') }}" class="button12 imgContainerntn">Reduce
                            bandwidth</a>
                        @endif
                        <!-- <a href="#" onclick="changeFont('decrease')" title="Decrease Font Size" class="button12">A- </a>
                        <a href="#" onclick="changeFont('original')" title="Original Font Size" class="button12">A </a>
                        <a href="#" onclick="changeFont('increase')" title="Increase Font Size" class="button12">A+ </a> -->

                        <button type="button" value="decrease" title="Decrease Font Size"
                            class="button12 decreaseFont">A- </button>
                        <button type="button" value="normal" title="Original Font Size" class="button12 normalFont">A
                        </button>
                        <button type="button" value="increase" title="Increase Font Size"
                            class="button12 increaseFont">A+ </button>
                    </div>

                </div>
            </div>
        </div>


        <div class="header-holder p-0">
            <div class="container-fluid">


                <div class="row">
                    <div class="col-sm-9 notice-block">
                        <div class="position-relative">
                            <div class="row">
                                <div class="col-md-2 flash-box">
                                    <p class="title">{{ __('lang.recent_notice')}}</p>
                                </div>
                                <div class="col-md-10">
                                    {{-- <ul class="marquee marquee-v" id="marquee-v">
                      @foreach ($notice_top as $marquee_list)
                      <li><a href="{{ route('web.notice.show', ['recent-notice', $marquee_list->slug ]) }}">{{$marquee_list->title}}</a>
                                    </li>
                                    @endforeach
                                    </ul> --}}
                                    <div class="marquee overflow-hidden">
                                        <ul class="list-inline m-0">
                                            @foreach ($notice_top as $marquee_list)
                                            <li class="list-inline-item mr-4">
                                                {{-- <img src="{{URL::to('/')}}/web/images/np.png" class="img-fluid
                                                mr-2"> --}}
                                                <small><i class="fas fa-bullhorn mr-2 text-warning"></i></small>
                                                <a class="text-light"
                                                    href="{{ route('web.notice.show', ['recent-notice', $marquee_list->slug ]) }}">
                                                    {{$marquee_list->title}}
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 main-d-sm-none p-0 pr-4">
                        <ul class="list-unstyled m-0 float-right top-p-nav">
                            <li class="list-inline-item top-nav {{ (request()->is('download*')) ? 'active' : '' }}">
                                <a href="{{ route('web.download.index') }}" class="top-nav-menu">
                                    {{ __('lang.download')}}
                                </a>
                            </li>
                            <li
                                class="list-inline-item top-nav {{ (request()->is('nagarik-wodapatra')) ? 'active' : '' }}">
                                <a href="{{ route('web.nagarik-wodapatra.index') }}" class="top-nav-menu">
                                    {{ __('lang.citizen_charter')}}
                                </a>
                            </li>
                            <li class="list-inline-item top-nav {{ (request()->is('form')) ? 'active' : '' }}">
                                <a href="{{ route('web.form.index') }}" class="top-nav-menu">
                                    {{ __('lang.forms')}}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- <div class="col-sm-1 main-d-sm-none">
                        <ul class="list-unstyled my-0 float-right">
                            <li class="list-inline-item">
                                <a href="{{ route('web.LangChange','en') }}" class="text-light">
                                    <span>En</span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="{{ route('web.LangChange','np') }}" class="text-light">
                                    <span>Ne</span>
                                </a>
                            </li>
                        </ul>
                    </div> -->
                </div>
            </div>
        </div>

        <!-- logo & flag -->
        <div class="logo-bg">
            {{-- <div class="position-absolute bg-img-top w-100">
        <img src="{{URL::to('/')}}/web/images/mt-everest.jpg" alt="" class="img-fluid w-100">
        </div> --}}
        <div class="container py-3">
            <div class="row">
                <!-- <div id="pulllogo" class="col-12 col-sm-4 col-md-2" style="text-align: center;">
                    <a href="{{route('web.welcome')}}"><img src="{{URL::to('/')}}/image/config/{{ isset($config->image_enc) ? $config->image_enc : '' }}" class="img-fluid logo-main"></a>

                </div>
                <div id="pullcontent" class="col-12 col-sm-8 col-md-8" style="text-align: center;">
                    <div class="site-info ">
                        @if(app()->getLocale() == 'en')
                        <span class="text-site-color">
                            
                            <h6 class="font-weight-bold m-0">{{ isset($config->title) ? $config->title : '' }}</h6>
                            <h5 class="font-weight-bold my-1" style="color:black;">{{ isset($config->office) ? $config->office : '' }}</h5>
                            <h6 class="font-weight-bold m-0">{{ isset($config->address) ? $config->address : '' }}</h6>
                        </span>
                        @else
                        <span class="text-site-color">
                            <h6 class="font-weight-bold m-0">{{ isset($config->title_np) ? $config->title_np : '' }}</h6>
                            <h5 class="font-weight-bold my-1" style="color:black;">{{ isset($config->office_np) ? $config->office_np : '' }}</h5>
                            <h6 class="font-weight-bold m-0">{{ isset($config->address_np) ? $config->address_np : '' }}</h6>
                        </span>
                        @endif
                    </div>
                </div>
                <div id="pullgif" class="col-12 col-md-2 d-none d-md-block d-lg-block " style="text-align: center;">
                    <img src="{{URL::to('/')}}/web/images/flag.gif" class="img-fluid logo-main-flag float-right">
                </div> -->
                <div id="pulllogo" class="col-12 col-sm-2 col-md-2" style="text-align: center;">
                    <a href="{{route('web.welcome')}}"><img src="{{URL::to('/')}}/image/config/{{ isset($config->image_enc) ? $config->image_enc : '' }}" class="img-fluid logo-main"></a>

                </div>
                <div id="pullcontent" class="col-12 col-sm-4 col-md-4" style="text-align: center;">
                    <div class="site-info ">
                        @if(app()->getLocale() == 'en')
                        <span class="text-site-color">
                            
                            <h6 class="font-weight-bold m-0">{{ isset($config->title) ? $config->title : '' }}</h6>
                            <h5 class="font-weight-bold my-1" style="color:black;">{{ isset($config->office) ? $config->office : '' }}</h5>
                            <h6 class="font-weight-bold m-0">{{ isset($config->address) ? $config->address : '' }}</h6>
                        </span>
                        @else
                        <span class="text-site-color">
                            <h6 class="font-weight-bold m-0">{{ isset($config->title_np) ? $config->title_np : '' }}</h6>
                            <h5 class="font-weight-bold my-1" style="color:black;">{{ isset($config->office_np) ? $config->office_np : '' }}</h5>
                            <h6 class="font-weight-bold m-0">{{ isset($config->address_np) ? $config->address_np : '' }}</h6>
                        </span>
                        @endif
                    </div>
                </div>
                <div id="pullgif" class="col-12 col-md-2 d-none d-md-block d-lg-block " style="text-align: center;">
                    <img src="{{URL::to('/')}}/web/images/flag.gif" class="img-fluid logo-main-flag float-right">
                </div>
                <div id="pullwomen" class="col-12 col-md-4 d-none d-md-block d-lg-block">
               <a href="../files/document/brochure.pdf" target="_blank">अन्तराष्ट्रिय नारा : "UNITE! ACTIVISM TO END VIOLENCE AGAINIST WOMEN &GIRLS! राष्ट्रिय नाराः"सभ्य समाजको पहिचानः लैङ्गिक हिंसा विरुद्धको अभियान"</a>
            </div>







                <!-- <div class="col-8 my-auto" style="text-align: center;">
                    <h2 class="my-0 site-logo">
                        <a href="{{route('web.welcome')}}"
                            class="font-weight-bold text-uppercase d-flex align-items-center">
                            Logo
                            {{-- <img src="{{URL::to('/')}}/web/images/logo-{{app()->getLocale()}}.png"
                            class="img-fluid"> --}}
                            @if ($config)
                            <img src="{{URL::to('/')}}/image/config/{{ $config->image_enc }}"
                                class="img-fluid logo-main">
                            @if(app()->getLocale() == 'en')
                            <span class="text-site-color">
                                <h6 class="font-weight-bold m-0">{{ $config->title }}</h6>
                                <h5 class="font-weight-bold my-1" style="color:black;">{{ $config->office }}</h5>
                                <h6 class="font-weight-bold m-0">{{ $config->address }}</h6>
                            </span>
                            @else
                            <span class="text-site-color">
                                <h6 class="font-weight-bold m-0">{{ $config->title_np }}</h6>
                                <h5 class="font-weight-bold my-1" style="color:black;">{{ $config->office_np }}</h5>
                                <h6 class="font-weight-bold m-0">{{ $config->address_np }}</h6>
                            </span>
                            @endif
                            @else
                            <img src="{{URL::to('/')}}/web/images/logo-sn.png" class="img-fluid">
                            @endif
                        </a>
                    </h2>
                </div>
                <div class="col-4 my-auto d-none d-md-block d-lg-block">
                    <img src="{{URL::to('/')}}/web/images/flag.gif" class="img-fluid logo-main-flag float-right">
                </div> -->
            </div>
        </div>

    </div>
    <div class="container-fluid text-center col-sm-12 d-md">


        <div class="d-md-none text-center pb-1  ">
            <div class="col-sm-12">
                <a href="{{ route('web.LangChange','en') }}" class="button12">
                    <span>En</span>
                </a>

                <a href="{{ route('web.LangChange','np') }}" class="button12">
                    <span>Ne</span>
                </a>


                <button type="button" value="decrease" title="Decrease Font Size" class="button12 decreaseFont">A-
                </button>
                <button type="button" value="normal" title="Original Font Size" class="button12 normalFont">A </button>
                <button type="button" value="increase" title="Increase Font Size" class="button12 increaseFont">A+
                </button>
            </div>
            <div class="col-sm-12">
                @if(Session()->get('APP_BAND')=='low')
                <a href="{{ route('web.BandChange','normal') }}" class="button12 imgContainerntn">Normal
                    bandwidth</a>
                @else
                <a href="{{ route('web.BandChange','low') }}" class="button12 imgContainerntn">Reduce
                    bandwidth</a>
                @endif
            </div>


        </div>
    </div>
    <!-- Menu navbar-->
    @include('web.main.navbar')

    <!-- content -->
    @yield('content')

    <!-- footer -->
    @include('web.main.footer')


    {{-- <nav class="social z-index-4">
      <ul>
        <li id="twitter">
          <a href="#">Twitter
            <i class="fa fa-twitter"></i>
          </a>
        </li>
      </ul>
      <ul>
        <li id="instagram">
          <a href="#">Instagram
            <i class="fa fa-instagram"></i>
          </a>
        </li>
      </ul>
      <ul>
        <li id="facebook">
          <a href="#">Facebook
            <i class="fa fa-facebook"></i>
          </a>
        </li>
      </ul>
    </nav> --}}
    </div>



    <script src="{{URL::to('/')}}/web/js/jquery-3.3.1.min.js"></script>
    <script src="{{URL::to('/')}}/web/js/jquery-migrate-3.0.1.min.js"></script>
    <script src="{{URL::to('/')}}/web/js/jquery-ui.js"></script>
    <script>
    $(window).load(function() {
        $(".loader").delay(500).fadeOut("slow");
        $("#overlayer").delay(500).fadeOut("slow");
        // counter link disable
        $('.footer-counter > a').click(function() {
            return false
        })
    });
    </script>
    <script src="{{URL::to('/')}}/web/js/popper.min.js"></script>
    <script src="{{URL::to('/')}}/web/js/bootstrap.min.js"></script>
    <script src="{{URL::to('/')}}/web/js/jquery.marquee-1.3.1.min.js"></script>
    {{-- <script src="{{URL::to('/')}}/web/js/jquery.marquee.min.js"></script> --}}
    <script src="{{URL::to('/')}}/web/js/owl.carousel.min.js"></script>
    <script src="{{URL::to('/')}}/web/js/jquery.stellar.min.js"></script>

    <script src="{{URL::to('/')}}/web/js/jquery.waypoints.min.js"></script>
    {{-- <script src="{{URL::to('/')}}/web/js/jquery.animateNumber.min.js"></script> --}}
    <script src="{{URL::to('/')}}/web/js/aos.js"></script>

    <script src="{{URL::to('/')}}/web/js/main.js"></script>

    <!-- search -->
    <script type="text/javascript">
    $(function() {
        $('a[href="#search"]').on('click', function(event) {
            event.preventDefault();
            $('#search').addClass('open');
            $('#search > form > input[type="text"]').focus();
        });

        $('#search, #search button.close').on('click keyup', function(event) {
            console.log(this);
            if (event.target.className == 'close' || event.keyCode == 27) {
                // event.target == this || 
                $(this).removeClass('open');
            }
        });

        //Do not include! This prevents the form from submitting for DEMO purposes only!
        // $('form').submit(function(event) {
        //     event.preventDefault();
        //     return false;
        // });
    });
    </script>
    <script type="text/javascript">
    $("body").on("click", ".lang", function(event) {
        lang = $(event.target).attr('id');
        $.ajax({
            type: "get",
            dataType: "json",
            url: "{{URL::route('setLang')}}",
            data: {
                lang: lang,
            },
            success: function(e) {}
        });
    });
    </script>
    <script type="text/javascript">
    $('.marquee').marquee({
        //speed in milliseconds of the marquee
        duration: 15000,
        //gap in pixels between the tickers
        gap: 30,
        //time in milliseconds before the marquee will start animating
        delayBeforeStart: 0,
        //'left' or 'right'
        direction: 'left',
        //true or false - should the marquee be duplicated to show an effect of continues flow
        duplicated: true,
        pauseOnHover: true,
        delayBeforeStart: 0,
    });
    </script>

    <!-- @if(Session()->get('APP_BAND')=='low')


        <script type="text/javascript" >
            document.getElementById("p1").remove();
                // $("img").attr("src","");
                // $(this).find('img').fadeToggle('slow');
        </script>
        @endif -->
    <!-- <script type="text/javascript"  charset="utf-8">
    $(document).ready( function() { $("img").removeAttr("src"); } );
</script>
 -->
    <script type="text/javascript">
    $(document).ready(function() {
        $(".increaseFont,.decreaseFont,.normalFont").click(function() {
            var type = $(this).val();
            var bodyFontSize = localStorage.getItem('bodyFontSize');

            var curFontSize = $('.data').css('font-size');
            if (type == 'increase') {
                $('.data').css('font-size', parseInt(curFontSize) + 1);
                $('a').css('font-size', parseInt(curFontSize) + 1);
                $('h2').css('font-size', parseInt(curFontSize) + 1);
                $('p').css('font-size', parseInt(curFontSize) + 1);
                $('h1').css('font-size', parseInt(curFontSize) + 1);
                $('h3').css('font-size', parseInt(curFontSize) + 1);
                $('h4').css('font-size', parseInt(curFontSize) + 1);
                $('h5').css('font-size', parseInt(curFontSize) + 1);
                $('h6').css('font-size', parseInt(curFontSize) + 1);
                $('a.button12.imgContainerntn').css('font-size', parseInt(10));
            } else if (type == 'decrease') {
                $('.data').css('font-size', parseInt(curFontSize) - 1);
                $('a').css('font-size', parseInt(curFontSize) - 1);
                $('h2').css('font-size', parseInt(curFontSize) - 1);
                $('p').css('font-size', parseInt(curFontSize) - 1);
                $('h1').css('font-size', parseInt(curFontSize) - 1);
                $('h3').css('font-size', parseInt(curFontSize) - 1);
                $('h4').css('font-size', parseInt(curFontSize) - 1);
                $('h5').css('font-size', parseInt(curFontSize) - 1);
                $('h6').css('font-size', parseInt(curFontSize) - 1)
                $('a.button12.imgContainerntn').css('font-size', parseInt(10));
            } else {

                $('.data').css('font-size', parseInt(16));
                $('a').css('font-size', parseInt(16));
                $('a.text-light').css('font-size', parseInt(20));
                $('span').css('font-size', parseInt(20));
                $('h2').css('font-size', parseInt(32));
                $('p').css('font-size', parseInt(16));
                $('h1').css('font-size', parseInt(36));
                $('h3').css('font-size', parseInt(28));
                $('h3.lead').css('font-size', parseInt(20));
                $('h4').css('font-size', parseInt(24));
                $('h5').css('font-size', parseInt(20));
                $('h6').css('font-size', parseInt(16))
                $('a.button12.imgContainerntn').css('font-size', parseInt(10));

            }

            // alert($('.data').css('font-size'));
        });
    });
    </script>

    
    

    @stack('js')
</body>

</html>