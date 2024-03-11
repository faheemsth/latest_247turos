@extends('pages.dashboard.appstudent')


@section('content')
    @if (Auth::check())
        @if (Auth::user()->role_id == '4')
            @include('layouts.studentnav')
        @elseif (Auth::user()->role_id == '3')
            @include('layouts.tutornav')
        @elseif (Auth::user()->role_id == '5')
            @include('layouts.parentnav')
        @elseif (Auth::user()->role_id == '1' || Auth::user()->role_id == '2')
            @include('layouts.navbar')
        @endif
    @else
        @include('layouts.navbar')
    @endif
    <script src="{{ asset('js/jsdelivrcore.js') }}"></script>
    <script src="{{ asset('js/jsdelivr.js') }}"></script>
    <div class="container">
        <div class="row justify-content-center my-5 py-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header py-3" style="background-color: rgb(131, 199, 248) ;font-size: 20px; ">{{ __('Verify Your Email Address') }}</div>

                    <div class="card-body py-5">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                        <form class="d-inline" method="POST" action="{{ route('user.verification') }}">
                            @csrf
                            <button type="submit"
                                class="btn px-4 py-2 my-3 align-baseline" style="background-color: rgba(171, 254, 16, 1);">{{ __('click here to request another') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('pages.dashboard.appstudent')

@section('content')
    @if (Auth::check())
        @if (Auth::user()->role_id == '4')
            @include('layouts.studentnav')
        @elseif (Auth::user()->role_id == '3')
            @include('layouts.tutornav')
        @elseif (Auth::user()->role_id == '5')
            @include('layouts.parentnav')
        @elseif (Auth::user()->role_id == '1' || Auth::user()->role_id == '2')
            @include('layouts.navbar')
        @endif
    @else
        @include('layouts.navbar')
    @endif

    <style>
        .icon {
            font-size: 40px;
        }
    </style>


<div class="container mt-3 ">
    <div class="row justify-content-center align-items-center text-center mt-4 pt-4">

        <div class="col">
            <h1 class="fw-bold" style="color: rgba(0, 150, 255, 1)">Hello, <span class="text-dark">Ahsan Shoukat</span></h1>
        </div>

    </div>
    <div class="container  p-5 ">
        <div class="row border  mx-5" style="box-shadow: 0px 0px 5px 2px rgb(216, 207, 207)">
            <div class="col-6 text-center px-5 my-5 " style="border-right: 1px solid rgb(163, 163, 163);"><img src="{{ asset('assets/images/student-char.png') }}" alt="" width="160px">
                <h2 class="pt-3">I am a student</h2>
                <p class="px-5">Have lessons, message your tutor or watch your lessons back</p>
            </div>
            <div class="col-6 text-center p-5 mt-4">
                <h2 class="py-2 fw-bold">We've emailed you a log in link</h2>
                <p class="py-3">Click on the link in the email in the next 24 hours and you'll be logged straight into your account -no password needed</p>
                <p>Didn't get it? Check you've typed yhe email adress you signed up with</p>
            </div>
        </div>
    </div>
</div>

@endsection

