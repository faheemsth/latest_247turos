@extends('layouts.app')
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
        .sizefont {
            font-size: 3rem;
            font-weight: 700;
        }

        .sizefontp {
            font-size: 1rem;
        }
    </style>

    <div class="container-fluid my-5 mx-3">
        <div class="row">
            <div class="col-6 my-3">
                <h1 class="sizefont">Tutor Code of Conduct</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-11">
                <div class="px-3">
                    <h2>
                        Introduction
                    </h2>
                    <p class="sizefontp">
                        This Code of Conduct acts as a framework for the ethical and professional behavior of tutors on the
                        GoStudent Platform. Its main goals are to safeguard students' well-being, ensure their safety, and
                        address any potential misconduct by tutors.
                    </p>
                    <p class="sizefontp">
                        Tutors, holding positions of trust, authority, and influence, often serve as mentors or role models.
                        Thus, they must maintain high standards of care, integrity, and professionalism in their
                        interactions with students.
                    </p>
                    <p class="sizefontp">
                        Upon registration on the GoStudent Platform, tutors pledge to uphold the principles outlined in this
                        Code of Conduct, crucial for maintaining the platform's quality, safety, and reputation.
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-11">
                <ul style="list-style: none;" class="ps-3">
                    <li class="pb-1">
                        <h3>General Conduct</h3>
                        <ul>
                            <li class="py-2">
                                <span style="font-size: 1.1rem;color:rgb(61, 58, 58);font-weight: 500;">Professional Appearance:</span> GoStudent is a young and vibrant organization and we expect tutors to maintain a professional and friendly manner in all interactions, whether with students, parents, guardians, fellow tutors, or GoStudent staff.
                            </li>
                            <li class="py-2">
                                <span style="font-size: 1.1rem;color:rgb(61, 58, 58);font-weight: 500;">Professional Appearance:</span> GoStudent is a young and vibrant organization and we expect tutors to maintain a professional and friendly manner in all interactions, whether with students, parents, guardians, fellow tutors, or GoStudent staff.
                            </li>
                            <li class="py-2">
                                <span style="font-size: 1.1rem;color:rgb(61, 58, 58);font-weight: 500;">Professional Appearance:</span> GoStudent is a young and vibrant organization and we expect tutors to maintain a professional and friendly manner in all interactions, whether with students, parents, guardians, fellow tutors, or GoStudent staff.
                            </li>
                            <li class="py-2">
                                <span style="font-size: 1.1rem;color:rgb(61, 58, 58);font-weight: 500;">Professional Appearance:</span> GoStudent is a young and vibrant organization and we expect tutors to maintain a professional and friendly manner in all interactions, whether with students, parents, guardians, fellow tutors, or GoStudent staff.
                            </li>
                            <li class="py-2">
                                <span style="font-size: 1.1rem;color:rgb(61, 58, 58);font-weight: 500;">Professional Appearance:</span> GoStudent is a young and vibrant organization and we expect tutors to maintain a professional and friendly manner in all interactions, whether with students, parents, guardians, fellow tutors, or GoStudent staff.
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
