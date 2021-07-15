@if(Cache::has('offers') && is_array(Cache::get('offers')) && count(Cache::get('offers')))
    @foreach(Cache::get('offers') as $o)
        @if(isset($o->image) && trim($o->image) !== "")
            <section class="section-content banneradvertise spacingrm">
                <div class="container">
                    <article class="padding-bottom">
                        <img src="{{ $o->image }}" class="w-100" alt="offer">
                    </article>
                </div>
            </section>
        @endif
    @endforeach
@endif

{{-- @if(trim(Cache::get('android_app_url', '')) != '') --}}
<!---section advertise ---->
{{-- <section class="section-content padding-bottom mt-3 spacingrm">
    <div class="container">
        <div class="card advertisebanner pb-3">
            <div class="row mt-3">
                <div class="col-md-6 col-12">
                    <img src="{{ _asset(Cache::get('screenshots', theme('images/3.png'))) }}" class="w-100" alt="Google Play Store">
                </div>
                <div class="col-md-6 col-12">
                    <div class="buttonicon">
                        <h3 class="mb-2">{{__('msg.download')}}</h3>
                        <h3 class="mb-3">{{__('msg.eCart_app_now')}}</h3>
                        <p class="text-muted">{{__('msg.fast_simple_and_delightful')}}.</p>
                        <p class="text-muted">{{__('msg.all_it_takes_30_seconds_to_download')}}.</p>
                        @if(trim(Cache::get('android_app_url', '')) != '')
                            <div class="google-apple">
                                <a target="_blank" href="{{ Cache::get('android_app_url', '') }}"><img src="{{ _asset(Cache::get('google_play', theme('images/google1.png'))) }}" alt="Google Play Store"></a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
         </div>
    </div> --}}
{{-- </section> --}}
<!----section end advertise -->
{{-- @endif --}}