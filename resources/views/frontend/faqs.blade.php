@extends('layouts/app')
@section('content')
    @if (Auth::check())
        @if (Auth::user()->role_id == '4')
            @include('layouts.studentnav')
        @elseif (Auth::user()->role_id == '3')
            @include('layouts.tutornav')
        @elseif (Auth::user()->role_id == '5' || Auth::user()->role_id == '6'))
            @include('layouts.parentnav')
        @elseif (Auth::user()->role_id == '1' || Auth::user()->role_id == '2')
            @include('layouts.navbar')
        @endif
    @else
        @include('layouts.navbar')
    @endif
@php
    $faq = \App\Models\Page::where('page_name', 'faq')->first();
@endphp
<style>
@media only screen and (max-width:425px){
    .faq-wrapper .faq-design{
        border-radius: 80px 0px 80px 0px;

    }
}
</style>
    <div class="container-fluid">
        <div class="faq-wrapper py-4">
            <h2 class="text-center py-3 " style="font-size:3.4rem;" id="text-color">Our FAQs</h2>
            <div class="faq-design p-md-5 p-3">
                <p class="text-white " style="font-size: 22px;">
                    @isset($web_settings['faq_desc']) {{$web_settings['faq_desc'] ?? '' }} @endisset
                </p>
                <div>

                    <div class="accordion accordion-flush my-4 me-3" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    @isset($web_settings['accfirst_title']) {{ $web_settings['accfirst_title'] ?? '' }} @endisset
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body " style="text-align: justify;">
                                    <p class="text-dark" style="font-size: 15px;">
                                        @isset($web_settings['accfirst_desc'])
                                            {{-- Display the truncated content --}}
                                            {{ \Illuminate\Support\Str::limit($web_settings['accfirst_desc'], 599, $end='...') }}
                                        @endisset
                                            @if (strlen($web_settings['accfirst_desc']) > 599)
                                                <span id="more" style="display: none;">{{ substr($web_settings['accfirst_desc'], 599) }}</span>
                                                <button id="read-more-btn" class="btn bg-transparent" style="color:blue;">Read More</button>
                                            @endif
                                        </p>



                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                    aria-controls="flush-collapseTwo">
                                    @isset($web_settings['accsec_title']) {{ $web_settings['accsec_title'] ?? '' }} @endisset
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body " style="text-align: justify;">
                                    {{-- @isset($web_settings['accsec_desc']) {{ $web_settings['accsec_desc'] ?? '' }} @endisset --}}

                                    <p class="text-dark" style="font-size: 15px;">
                                        @isset($web_settings['accsec_desc'])
                                            {{-- Display the truncated content --}}
                                            {{ \Illuminate\Support\Str::limit($web_settings['accsec_desc'], 609, $end='...') }}
                                        @endisset
                                            @if (strlen($web_settings['accsec_desc']) > 609)
                                                <span id="moret" style="display: none;">{{ substr($web_settings['accsec_desc'], 609) }}</span>
                                                <button id="read-moret-btn" class="btn bg-transparent" style="color:blue;">Read More</button>
                                            @endif
                                        </p>

                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseThree" aria-expanded="false"
                                    aria-controls="flush-collapseThree">
                                    @isset($web_settings['accthird_title']) {{ $web_settings['accthird_title'] ?? '' }} @endisset
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body " style="text-align: justify;">
                                    <p class="text-dark" style="font-size: 15px;">
                                        @isset($web_settings['accthird_desc'])
                                            {{-- Display the truncated content --}}
                                            {{ \Illuminate\Support\Str::limit($web_settings['accthird_desc'], 600, $end='...') }}
                                        @endisset
                                            @if (strlen($web_settings['accthird_desc']) > 600)
                                                <span id="moreth" style="display: none;">{{ substr($web_settings['accthird_desc'], 600) }}</span>
                                                <button id="read-moreth-btn" class="btn bg-transparent" style="color:blue;">Read More</button>
                                            @endif
                                        </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapsefour" aria-expanded="false"
                                    aria-controls="flush-collapseThree">
                                    @isset($web_settings['accfour_title']) {{$web_settings['accfour_title'] ?? '' }} @endisset
                                </button>
                            </h2>
                            <div id="flush-collapsefour" class="accordion-collapse collapse"
                                aria-labelledby="flush-headingfour" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body " style="text-align: justify;">
                                    <p class="text-dark" style="font-size: 15px;">
                                        @isset($web_settings['accfour_desc'])
                                            {{-- Display the truncated content --}}
                                            {{ \Illuminate\Support\Str::limit($web_settings['accfour_desc'], 601, $end='...') }}
                                        @endisset
                                            @if (strlen($web_settings['accfour_desc']) > 601)
                                                <span id="moref" style="display: none;">{{ substr($web_settings['accfour_desc'], 601) }}</span>
                                                <button id="read-moref-btn" class="btn bg-transparent" style="color:blue;">Read More</button>
                                            @endif
                                        </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- FAQs Sec end  -->


    <!-- Find tutor section -->
    <div class="container-fluid px-0">
        <div class="container text-center py-5 mb-5">
            <h3 class="fa-2x fw-bold pb-4" id="text-color">Book a free meeting with a tutor today</h3>
            <a href="{{ route ('findTutor') }}" id="find-tutor">Find a Tutor</a>
        </div>
    </div>
    <!-- Find tutor section end-->
    <script>
        var botmanWidget = {
            aboutText: '247Tutors',
            title:'Chat Support',
            mainColor:'#0096FF',
            bubbleBackground:'#0096FF',
            introMessage: "✋ Hi! I'm from 247tutors.co.uk"
        };
       </script>
<script>
    document.getElementById('read-more-btn').addEventListener('click', function() {
        document.getElementById('more').style.display = 'inline';
        document.getElementById('read-more-btn').style.display = 'none';
    });
    document.getElementById('read-moret-btn').addEventListener('click', function() {
        document.getElementById('moret').style.display = 'inline';
        document.getElementById('read-moret-btn').style.display = 'none';
    });
    document.getElementById('read-moreth-btn').addEventListener('click', function() {
        document.getElementById('moreth').style.display = 'inline';
        document.getElementById('read-moreth-btn').style.display = 'none';
    });
    document.getElementById('read-moref-btn').addEventListener('click', function() {
        document.getElementById('moref').style.display = 'inline';
        document.getElementById('read-moref-btn').style.display = 'none';
    });
</script>
       <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
@endsection
