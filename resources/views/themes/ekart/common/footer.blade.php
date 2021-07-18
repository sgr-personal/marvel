<body>
    <footer class="footer-area">
        <div class="footer-big">
            <div class="container">
                <div class="row">
                    <div class="col-md-3 ">
                        <div class="footer-widget d-flex justify-content-center">
                            <div class="widget-about">
                                <div class="col-12 d-flex justify-content-center">
                                    <a href="{{ route('home') }}"><img src="{{ _asset(Cache::get('web_logo')) }}" alt="Logo"></a>
                                </div>
                                @if(trim(Cache::get('android_app_url', '')) != '')
                                <!-- <div class="col-12">
                                    <div class="google-apple1">
                                        <a target="_blank" href="{{ Cache::get('android_app_url', 'https://play.google.com') }}">
                                            <img src="{{ _asset(Cache::get('google_play', theme('images/google1.png'))) }}" alt="Google Play Store">
                                        </a>
                                    </div>
                                </div> -->
                                @endif
                                @if(Cache::has('social_media') && is_array(Cache::get('social_media')) && count(Cache::get('social_media')))
                                <div class="col-12 mt-2">
                                    <div class="row d-flex justify-content-center">
                                        <div class="social-button">
                                            <ul>
                                                @foreach(Cache::get('social_media') as $i => $c)
                                                <li class="social-icon">
                                                    <a href="{{ $c->link }}" target="_blank"><em class="fab {{ $c->icon }}"></em></a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="footer-widget text-center d-flex justify-content-center">
                            <div class="footer-menu no-padding">
                                <h4 class="footer-widget-title  m-0"> {{ __('msg.customer_services') }}</h4>
                                <ul>
                                    <li><a href="{{ route('page', 'about') }}"> {{ __('msg.about_us')}}</a>
                                    <li><a href="{{ route('page', 'faq') }}">{{ __('msg.faq')}}</a>
                                    <li><a href="{{ route('page', 'privacy-policy') }}">{{ __('msg.privay_policy')}}</a>
                                    <li><a href="{{ route('page', 'tnc') }}"> {{ __('msg.terms_and_conditions')}}</a>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="footer-widget text-center d-flex justify-content-center">
                            <div class="footer-menu  no-padding">
                                <h4 class="footer-widget-title  m-0">{{ __('msg.contact_us')}}</h4>
                                <ul>
                                    @if(trim(Cache::get('whatsapp_number', '')) != '')
                                    <li><a class="noHover">{{ __('msg.whatsApp_us', ['number' => Cache::get('whatsapp_number')]) }}</a></li>
                                    @endif
                                    @if(trim(Cache::get('support_number', '')) != '')
                                    <li><a class="noHover">{{ __('msg.call_us', ['number' => Cache::get('support_number')])}}</a></li>
                                    @endif
                                    @if(trim(Cache::get('support_timings', '')) != '')
                                    <li><a class="noHover">Hours: {{ Cache::get('support_timings') }}</a></li>
                                    @endif
                                    @if(trim(Cache::get('support_email', '')) != '')
                                    <li><a class="noHover">{{ __('msg.email_id', ['email' => Cache::get('support_email')])}}</a></li>
                                    @endif
                                    @php
                                    $store_address = str_ireplace("<br>", ' ',  Cache::get('store_address') );
                                    @endphp
                                    @if(trim(Cache::get('store_address', '')) != '')
                                    <li><a class="noHover">{{ __('msg.store_address')}} {{ $store_address }}</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="footer-widget">
                            <div class="footer-menu  no-padding">
                                <h4 class="footer-widget-title  m-0 row justify-content-center"> {{ __('msg.newsletter')}}</h4>
                                <div class="row justify-content-center mt-2">
                                    <em class="far fa-envelope-open fa-3x envelope mb-2"></em>
                                </div>
                                <h5 class="mt-2 d-flex justify-content-center subscribeletter">{{ __('msg.subscribe_to_our_newsletter') }}</h5>
                                <div class="well1">
                                    <form action="{{ route('newsletter') }}" method="POST" class="ajax-form">
                                        @csrf
                                        <div class="formResponse"></div>
                                        <div class="input-group">
                                            <input class="btn btn-lg border border-info" name="email" id="email" type="email" placeholder="Enter Your Email.." required>
                                            <button class="btn btn-lg" type="submit" name="submit" value="submit"><em class="fas fa-paper-plane"></em></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="line-footer">
                            <hr>
                            <div class="text-center">
                            <p class="copyright-text">{{__('msg.copyright')}} &copy; {{date('Y')}} {{__('msg.made')}}
                                    <a target="_blank" href="https://Niktechsolution.com/" class="companyname"> Niktechsolution</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/8.2.7/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/8.2.7/firebase-analytics.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.2.7/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.2.7/firebase-firestore.js"></script>

<script>
  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  var firebaseConfig = {
      apiKey: "AIzaSyCQGdU2x6xHU3K6oo2rKTkBRkfmAH13424",
      authDomain: "marvel-319817.firebaseapp.com",
      projectId: "marvel-319817",
      storageBucket: "marvel-319817.appspot.com",
      messagingSenderId: "7848686543",
      appId: "1:7848686543:web:4d5d29a21c9b65e82a98ba",
      measurementId: "G-KNR6T952VG"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();
</script>
</html>
