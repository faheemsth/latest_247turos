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
    <style>
        .blogimg{
            width:20%;
        }
       .blogcont>p[data-f-id]{
            display:none !important;
        }
        #isPasted {
    height: 50px !important;
    overflow: hidden;
        }
        @media only screen and (max-width:1030px){
                .blog-title-heading{
                font-size: 3rem !important;
             }
             .blogimg{
        width:30%;
    }
}

        @media only screen and (max-width:768px){
            .blog-title-heading{
        font-size: 2.2rem !important;
    }
    .blogimg{
        width:35%;
    }

        }
        @media only screen
       and (max-width : 430px){
    .blogimg{
        width:55%;
    }
    .blog-title-heading{
        font-size: 1.8rem !important;

    }
    .card-box-btn a {
    width: 85%;
    margin-left: 8%;
}
}
    </style>
    <div class="container-fluid mt-5">
        <div class="row justify-content-center text-center py-md-4  ">
            <img src="./assets/images/Group 162.png" alt="" class="blogimg img-fluid">
            <p class="fs-2 px-sm-3 pb-4 fw-bolder blog-title-heading" id="text-color">Your go-to guide for education advice.</p>
        </div>
    </div>
    <div class="container blog-category-container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10 category">

                <div class="blog-category mx-3 mx-md-0">

                    <div class="card-box card-box-first">

                        <div class="card-box-circle">
                            <img src="./assets/images/Group (2).png" alt="" class="card-box-img">
                        </div>

                        <div class="card-box-content">
                            <h5 class=" fs-2">For Parents</h5>
                            <p>Discover current expert guidance for aiding your teenager's studies and wellbeing.</p>
                        </div>

                        <div class="card-box-btn">
                            <a href="{{ url('blogs?category=parent') }}" class="button btn fw-bold ">Visit the Parents Blog</a>
                        </div>

                    </div>
                </div>

                <div class="blog-category  mx-3 mx-md-0">

                    <div class="card-box card-box-mid">

                        <div class="card-box-circle">
                            <img src="./assets/images/Group (3).png" alt="" class="card-box-img">
                        </div>

                        <div class="card-box-content ">
                            <h5 class="fs-2">For Students</h5>
                            <p>Receive study tips, revision hacks, and careers advice to aid you in achieving your utmost potential at school and beyond.
                            </p>
                        </div>

                        <div class="card-box-btn">
                            <a href="{{ url('blogs?category=students') }}" class="button btn mt-3 mt-md-0   fw-bold " >Visit the Students Blog</a>
                        </div>

                    </div>

                </div>
                <div class="last-blog-category  mx-3 mx-md-0">
                    <div class="card-box ">
                        <div class="card-box-circle">
                            <img src="./assets/images/Group (4).png" alt="" class="card-box-img">
                        </div>
                        <div class="card-box-content">
                            <h5 class="fs-2">For Tutors</h5>
                            <p>Keep informed with 247Tutors' latest news and valuable tips from fellow tutors to support your students effectively.</p>
                        </div>

                        <div class="card-box-btn">
                            <a href="{{ url('blogs?category=tutors') }}" class="button btn mt-3 mt-md-0 fw-bold ">Visit the Tutor Blog</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>

    </div>


    <div class="container">
        <h1 class="text-center pt-5 my-5 fw-bold" id="text-color">Featured</h1>



        <div class="row blogs">
            @forelse ($blogs as $blog)
                <div class="col-12 col-md-6 col-lg-4">
                    <a href="{{url('single-post').'/'.$blog->id}}" class="text-decoration-none">
                    <div class="card border-0  mx-3 mx-md-0 ">
                        <img src="{{ asset($blog->image) }}" alt="">
                        <div class="card-body ps-0 blogcont">
                            <p class="my-1 text-secondary">
                                @isset($blog->slug)
                                {{-- Display the truncated content --}}
                                {{ \Illuminate\Support\Str::limit($blog->slug, 40, $end='...') }}
                            @endisset
                            </p>
                            <p class="p3 fw-bold fs-5">

                                @isset($blog->title)
                                {{-- Display the truncated content --}}
                                {{ \Illuminate\Support\Str::limit($blog->title, 55, $end='...') }}
                            @endisset
                            </p>
                            <p class="my-1 blogpara">
                                <small>
                                    @php
                                        $string = strip_tags($blog->content);
                                        if (strlen($string) > 200) {
                                            // truncate string
                                            $stringCut = substr($string, 0, 200);
                                            $endPoint = strrpos($stringCut, ' ');

                                            // if the string doesn't contain any space then it will cut without word basis.
                                            $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                            $string .= '... <a href="' . url('single-post') . '/' . $blog->id . '">Read More</a>';
                                        }
                                        echo $string;
                                    @endphp

                                </small>
                            </p>
                        </div>
                    </div>
                    </a>
                </div>
            @empty
            @endforelse
        </div>
    </div>
    </div>
    <div class="row mx-0">
        <div class="col text-center py-5">
            <h1 id="text-color" class="my-4"> <strong>Over a 100+
                    Tutor  <br> are Available to Teach you</strong> </h1>
            <a href="{{ route ('findTutor') }}" id="find-tutor">Find a Tutor</a>
        </div>

    </div>
    <script>
        var botmanWidget = {
            aboutText: '247Tutors',
            title:'Chat Support',
            mainColor:'#0096FF',
            bubbleBackground:'#0096FF',
            introMessage: "✋ Hi! I'm from 247tutors.com"
        };
       </script>

       <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
@endsection
