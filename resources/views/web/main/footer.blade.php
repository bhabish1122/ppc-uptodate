<!-- The content of your page would go here. -->

@push('css')

@endpush
<footer class="text-center text-lg-start text-white container-fluid mt-2 pt-4" style="background-color: #182747">


    <!-- Section: Links  -->
    <section class="foot">
        <div class="container-fluid text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">

                <!-- Grid column -->

                <!-- Grid column -->
                <div class="foot col-md-3 col-lg-2 col-xl-2 mx-0 mb-4 footscroll" style="text-align: left;">
                    @if ($usefullinks->count())
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold">{{ __('lang.useful_link')}}</h6>
                    <hr class="mb-4 mt-0 d-inline-block mx-auto"
                        style="width: 60px; background-color: #1746A2; height: 2px" />
                    @foreach($usefullinks as $link)
                    <p>
                        <a href="{{$link->link}}" class="text-white footh" target="_blank">{{$link->title}}</a>
                    </p>
                    @endforeach

                    @endif
                </div>
                <!-- Grid column -->
                <div class="col-md-6  mr-auto mb-4" style="text-align: left;" id="ridmap">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold">{{ __('lang.location')}}</h6>
                    <hr class="mb-4 mt-0 d-inline-block mx-auto"
                        style="width: 60px; background-color: #1746A2; height: 2px" />


                    @if ($contacts)
                    @foreach($contacts as $contact)
                    {!! $contact->map !!}
                    @endforeach

                    @endif

                </div>

                <!-- Grid column -->
                <div class="col-md-3  mx-0 mb-md-0 mb-4" style="text-align: left;">
                    <!-- Links -->

                    <h6 class="text-uppercase fw-bold">{{ __('lang.contact_us')}}</h6>

                    <hr class="mb-4 mt-0 d-inline-block mx-auto"
                        style="width: 60px; background-color: #1746A2; height: 2px" />

                    @foreach($contacts as $contact)
                    <p>


                        <!-- <i class="fas fa-home mr-3"></i> -->
                        {!! $contact->address !!}
                    </p>
                    @endforeach


                    @if (isset($contact->email))

                    @php
                    $email_value = $contact->email;
                    $email_list = explode(",", $email_value);
                    @endphp
                    @foreach ($email_list as $email_item)
                    <p><a href="mailto:{{$email_item}}" title="Mail Address"></p><i class="fas fa-envelope mr-3"></i>
                    {{$email_item}}
                    </a>
                    @endforeach
                    @endif

                    @if (isset($contact->phone))
                    @php
                    $phone_value = $contact->phone;
                    $phone_list = explode(",", $phone_value);
                    @endphp
                    @foreach ($phone_list as $key=>$phone_item)
                    <p><a href="tel:{{$phone_item}}" title="Give us call"><i class="fas fa-phone mr-3"></i>
                            {{$phone_item}}
                        </a></p>
                    @endforeach
                    @endif





                    <!-- <p><a href=""><i class="fas fa-print mr-3"></i> +977 0000000</a></p> -->
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
    </section>
    <!-- Section: Links  -->


</footer>




<div class="bottomfoot container-fluid" style="background-color: #1746A2">

    <div class=" pt-3 pb-2">
        <div class="container-fluid text-white">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="row text-center" id="socialfoot">
                        <div class="col-md-12">
                            <a href="{{ isset($contact->facebook) ? $contact->facebook : '' }}" class="pb-2 pr-2 pl-0"><i class="fab fa-facebook-f"></i></a>
                            <a href="{{ isset($contact->twitter) ? $contact->twitter : '' }}" class="p-2"><i class="fab fa-twitter"></i></a>
                            <a href="{{ isset($contact->googleplus) ? $contact->googleplus : '' }}" class="p-2"><i class="fab fa-google-plus-g"></i></a>
                            <a href="{{ isset($contact->youtube) ? $contact->youtube : '' }}" class="p-2"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center smallfooter">
                    <p class="text-end m-0">
                        {{ __('lang.copyright')}} &copy; 
                        <script>document.write(new Date().getFullYear());
                    </script> 
                        {{ __('lang.all_right')}} <br>
                        {{ __('lang.o_c_m_c_m')}}.<br>
          Under Construction
                    </p>
                </div>
            </div>

        </div>
    </div>
</div>