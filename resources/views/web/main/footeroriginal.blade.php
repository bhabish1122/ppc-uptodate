<footer class="container-fluid site-footer pb-3">
  <div class="slant-footer"></div>
  <div class="container">
    <div class="row">
      <div class="col-md-8 mb-4 mb-md-0">
        <div class="row mb-4">
          @if ($usefullinks->count())
          <div class="col-md-6">
            <h3 class="footer-heading mb-4 text-white">{{ __('lang.useful_link')}}</h3>
            <ul class="list-unstyled footer-list-main">
              @foreach($usefullinks as $link)
              <li><a href="{{$link->link}}" target="_blank">{{$link->title}}</a></li>
              @endforeach
            </ul>
          </div>
          @endif
          @if ($quickmenus->count())
          <div class="col-md-6">
            <h3 class="footer-heading mb-4 text-white">{{ __('lang.quick_menu')}}</h3>
            <ul class="list-unstyled">
              @foreach($quickmenus as $menu)
              <li><a href="{{$menu->link}}">{{$menu->title}}</a></li>
              @endforeach
            </ul>
          </div>
          @endif
        </div>
      </div>
      @if ($contacts->count())
      <div class="col-md-4 mb-4 mb-md-0">
        <h3 class="footer-heading mb-4 text-white">{{ __('lang.contact_us')}}</h3>
        <ul class="p-0 list-unstyled">
          @foreach($contacts as $contact)
          <li>
            {!! $contact->address !!}                   
          </li>
          @if ($contact->email)
          <li class="media">
            <div class="media-left mr-2">
              <i class="fa fa-envelope"></i>
            </div>
            <div class="media-body">
              @php
                $email_value  = $contact->email;
                $email_list = explode(",", $email_value);
              @endphp
              @foreach ($email_list as $email_item)
              <a href="mailto:{{$email_item}}" title="Mail Address">
               {{$email_item}}
              </a>
              @endforeach
            </div>
          </li>
          @endif
          @if ($contact->phone)
          <li class="media">
            <div class="media-left mr-2">
              <i class="fa fa-phone"></i>
            </div>
            <div class="media-body">
              @php
                $phone_value  = $contact->phone;
                $phone_list = explode(",", $phone_value);
              @endphp
              @foreach ($phone_list as $key=>$phone_item)
              <a href="tel:{{$phone_item}}" title="Give us call">
                {{$phone_item}}
              </a>
              @endforeach
            </div>
          </li>
          @endif
          @endforeach
        </ul>
      </div>
      @endif
    </div>
    <div class="row text-center">
      @if ($contacts)
      <div class="col-md-12">
        @foreach($contacts as $contact)
        <a href="{{$contact->facebook}}" class="pb-2 pr-2 pl-0"><i class="fab fa-facebook-f"></i></a>
        <a href="{{$contact->twitter}}" class="p-2"><i class="fab fa-twitter"></i></a>
        <a href="{{$contact->googleplus}}" class="p-2"><i class="fab fa-google-plus-g"></i></a>
        <a href="{{$contact->youtube}}" class="p-2"><i class="fab fa-youtube"></i></a>
        @endforeach
      @endif
      </div>
      <div class="col-md-12">
        <p class="">
          {{ __('lang.copyright')}} &copy; <script>document.write(new Date().getFullYear());</script> {{ __('lang.all_right')}} {{ __('lang.o_c_m_c_m')}}.<br>
          Under Construction
        </p>
        {{-- <span class="footer-counter">
            <a href="https://www.hitwebcounter.com" target="_blank">
            <img src="https://hitwebcounter.com/counter/counter.php?page=7760998&style=0008&nbdigits=9&type=ip&initCount=0" title="Free Counter" Alt="web counter"   border="0" /></a>                                               
        </span> --}}
      </div>
    </div>
  </div>
</footer>