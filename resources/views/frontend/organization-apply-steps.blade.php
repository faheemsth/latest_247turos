@extends('layouts.app')
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
    <style>
         .linkbtns{
        background-color: #ABFF00;
        color: #0096ff;
        border-radius: 5px;
    }
    @media only screen and (max-width:430px){
        .stepcard{
            margin:10px auto;
        }
        .org-card-content{
            display: flex ;
            flex-direction: column ;
            justify-content: center;
            align-items: center;
        }
    }
       @media screen and (min-device-width: 425px) and (max-device-width: 768px){
    .card-title{
        font-size: 17px !important;
    }
    .card-text{
         font-size: 15px !important;
    }
    }
    </style>
    <!-- Tutor apply step cards -->


    <div class="container">
        <div class="row pt-5 text-center">
            <div class="col">
                <h1 class="fw-bolder simple-title" id="text-color">it's simple</h1>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column  flex-md-row justify-content-center org-card-content mb-5 pb-5">

        <div class="card border-0 d-flex align-items-center text-center stepcard" style="width: 18rem; margin-top: 9%">
            <div
                style="
              width: 100px;
              background: #0096ff;
              padding: 20px;
              border-radius: 50%;
              height: 90px;
              text-align: center;
            ">
                <img src="{{ asset('assets/images/icons8-register-50 1.png') }}" class="card-img-top" style="width: 50px" />
            </div>
            <div class="card-body">
                <a href="{{ url('/select-user-type') }}" class="text-decoration-none">
                <h5 class="card-title p-1 linkbtns">
                    Get Started
                </h5></a>
                <p class="card-text">@isset($web_settings['org_one']) {{$web_settings['org_one'] ?? '' }} @endisset</p>
            </div>
        </div>
        {{-- <div class="card border-0 d-flex align-items-center text-center stepcard" style="width: 18rem; margin-top: 11%">
            <div
                style="
              width: 100px;
              background: #0096ff;
              padding: 20px;
              border-radius: 50%;
              height: 90px;
            ">
                <img src="{{ asset('assets/images/icons8-online-class-64 1.png') }}" class="card-img-top" style="width: 50px" />
            </div>
            <div class="card-body">
                <h5 class="card-title p-1" style="background-color: #0096ff; border-radius: 5px">
                    @isset($web_settings['st_two']) {{$web_settings['st_two'] ?? '' }} @endisset.
                </h5>
                <p class="card-text">
                    @isset($web_settings['st_three']) {{$web_settings['st_three'] ?? '' }} @endisset.
                </p>
            </div>
        </div> --}}
        <div class="card border-0 d-flex align-items-center text-center stepcard" style="width: 18rem; margin-top: 6.5%">
            <div
                style="
              width: 100px;
              background: #0096ff;
              padding: 20px;
              border-radius: 50%;
              height: 90px;
            ">
                <img src="{{ asset('assets/images/icons8-online-class-60 1.png') }}" class="card-img-top" style="width: 50px" />
            </div>
            <div class="card-body">
                <h5 class="card-title p-1 linkbtns text-dark" >
                    Take Free Demo
                </h5>
                <p class="card-text">
                    @isset($web_settings['org_three']) {{$web_settings['org_three'] ?? '' }} @endisset
                </p>
            </div>
        </div>
        <div class="card border-0 d-flex align-items-center text-center stepcard" style="width: 18rem; margin-top: 4%">
            <div
                style="
              width: 100px;
              background: #0096ff;
              padding: 20px;
              border-radius: 50%;
              height: 90px;
            ">
                <img src="{{ asset('assets/images/icons8-tuition-30 1.png') }}" class="card-img-top" style="width: 50px" />
            </div>
            <div class="card-body">
                <h5 class="card-title p-1 linkbtns text-dark" >
                    Start Tuition
                </h5>
                <p class="card-text">
                    @isset($web_settings['org_four']) {{$web_settings['org_four'] ?? '' }} @endisset
                </p>
            </div>
        </div>
    </div>
    {{-- @php
    $pathSegments = request()->segments();
    $headerfooter = \App\Models\Page::where('page_name', $pathSegments[0])->first();

    @endphp
    {!! $headerfooter->organization_apply_steps !!} --}}
    <!-- Tutor apply step cards end -->
    <script>
        var botmanWidget = {
            aboutText: '247Tutors',
            title:'Chat Support',
            mainColor:'#0096FF',
            bubbleBackground:'#0096FF',
            introMessage: "✋ Hi! I'm from 247tutors.co.uk"
        };
       </script>

       <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
@endsection
