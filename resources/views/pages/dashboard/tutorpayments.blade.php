@extends('layouts.app')
@section('content')
    <link href="{{ URL::asset('assets/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        /* Optional: Add some styling to the button */
        .paypal-button {
            background-color: #003087;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        /* Optional: Adjust the icon size */
        .paypal-icon {
            width: 30px;
            height: 30px;
            margin-right: 10px;
        }

        .texttitle {
            font-size: 3rem !important;
        }

        @media screen and (max-width: 425px) {
            .texttitle {
                font-size: 1.8rem !important;
            }
        }
    </style>
    @include('layouts.allnav')
    <div class="container  py-3">
        <div class="row mt-2">
            @if (session('failed'))
                <div class="alert alert-danger">
                    {{ session('failed') }}
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>



        <div class="container">
            <div class="row mt-4 mb-3 mx-lg-5 justify-content-between align-items-center">
                <div class="col-auto booking-table-details">
                    <h1 class="texttitle">Earnings</h1>
                </div>
                <div class="col-6">
                    <div class="row align-items-center justify-content-end">

                        @if (optional($wallet)->net_income > 10)
                            <div class="col-auto">


                                <button class="paypal-button mx-1 py-1" onclick="withdraw()">
                                    Withdrawn with<i class="fa-brands fa-cc-paypal"
                                        style="font-size:34px;margin-left:10px;"></i>
                                </button>

                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row py-2  mx-lg-5" style="border: 1px solid #bfb9b9;box-shadow: 1px 1px 3px #9b9b9b;">
                <div class="col-lg-4 text-center col-6" style="border-right: 1px solid gray;">
                    <h5 class="fw-bold">Pending</h5>
                    <h4>
                        @if (
                            (int) App\Models\PendingPayment::where('tutor_id', Auth::id())->sum('amount') ==
                                App\Models\PendingPayment::where('tutor_id', Auth::id())->sum('amount'))
                            £{{ App\Models\PendingPayment::where('tutor_id', Auth::id())->sum('amount') }}.00
                        @else
                            £{{ App\Models\PendingPayment::where('tutor_id', Auth::id())->sum('amount') }}
                        @endif
                    </h4>
                </div>
                <div class=" col-lg-4 text-center col-6" style="border-right: 1px solid gray;">
                    <h5 class="fw-bold">Net Income</h5>
                    <h4>
                        @if (!empty($wallet))
                            @if ((int) $wallet->net_income == $wallet->net_income)
                                £{{ $wallet->net_income }}.00
                            @else
                                £{{ $wallet->net_income }}
                            @endif
                        @else
                            £ 0.00
                        @endif
                    </h4>
                </div>
                <div class="col-lg-4 text-center col-6">
                    <h5 class="fw-bold">Withdrawn</h5>
                    <h4>
                        @if (!empty($wallet))
                            @if ((int) $wallet->withdrawn == $wallet->withdrawn)
                                £{{ $wallet->withdrawn }}.00
                            @else
                                £{{ $wallet->withdrawn }}
                            @endif
                        @else
                            £ 0.00
                        @endif
                    </h4>
                </div>

            </div>

        </div>


        <div class="row mt-5 mx-lg-5">
            <div class="col-12 booking-table-details ps-4">
                <h1 class="texttitle">Billing & Payments</h1>
            </div>
        </div>

        <!-- Filter section  -->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 col-12 col-lg-10 booking-filter">
                    <div class="row flex-wrap justify-content-center align-content-end">
                    </div>
                </div>
            </div>
        </div>
        <!-- Booking details table  -->
        <div class="row mb-4 d-flex justify-content-lg-center text-center">
            <div class="col-md-11 px-0 ">
                <div class="container mt-2 mt-md-5 custom-table px-3">
                    <table class="table table-bordered custom-table ">

                        <thead class="student-table-details">
                            <tr>
                                <th>Student</th>
                                <th>Tutor</th>
                                <th>Subject</th>
                                <th>Amount</th>
                                <th>Duration</th>
                                <th>Status</th>
                                <th>Completion Date</th>
                                <th>Payment Date</th>
                            </tr>
                        </thead>
                        <tbody id="ajaxbody">
                            @if ($bookings->count() > 0)
                                @foreach ($bookings as $booking)
                                    @php
                                        $date = date('Y-m-d', strtotime($booking->booking_date . ' +7 days'));
                                    @endphp
                                    <tr>
                                        <th class="text-capitalize">{{ optional($booking->student)->username }}</th>
                                        <th class="text-capitalize">{{ optional($booking->tutor)->username }}</th>
                                        <th class="text-capitalize">{{ optional($booking->subjects)->name }}</th>
                                        <td>
                                            @if ($booking->booking_fee !== 'Free')
                                                @if ((int) $booking->booking_fee == $booking->booking_fee)
                                                    £{{ $booking->booking_fee }}.00/hr
                                                @else
                                                    £{{ $booking->booking_fee }}/hr
                                                @endif
                                            @else
                                                {{ $booking->booking_fee }}
                                            @endif
                                        </td>
                                        <td>{{ $booking->duration }} minutes</td>
                                        <td>
                                            @if ($booking->request_refound != 1 && $booking->request_refound != 2)
                                                <span
                                                    class="badge
                                            @if ($booking->status == 'Completed') bg-success
                                            @elseif($booking->status == 'Scheduled')
                                            bg-info
                                            @elseif($booking->status == 'Cancelled By Tutor' || $booking->status == 'Cancelled By User')
                                            bg-danger
                                            @elseif($booking->status == 'Cancelled')
                                            bg-danger
                                            @elseif($booking->status == 'Pending')
                                            bg-warning @endif
                                            ">
                                                    {{ $booking->status }}
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">
                                                    @if ($booking->request_refound == '2')
                                                        {{ 'Paid Refund To User' }}
                                                    @else
                                                        {{ 'Request Refund' }}
                                                    @endif
                                                </span>
                                            @endif
                                        </td>
                                        <td>{!! date('d-m-Y', strtotime($booking->booking_date)) . '<br>' . date('h:i a', strtotime($booking->booking_time)) !!}</td>
                                        <td>{!! date('d-m-Y', strtotime($date)) !!}</td>

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8">Not Record Found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade zoomIn" id="withdraw_modal" tabindex="-1" aria-labelledby="update_doc_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header p-3 bg-info-subtle">
                    <h5 class="modal-title" id="update_doc_modal_title"> Add Amount In Wallet</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <form id="withdrawForm" action="{{ url('tutor/payout') }}" method="GET">
                    @csrf
                    <div class="modal-dialog">
                        <div class="modal-content" style="background-color: #003087;color:white">
                            <div class="modal-header">
                                <h5 class="modal-title" id="withdrawModalLabel">PayPal</h5>
                            </div>
                            <div class="modal-body">
                                <!-- Payment Withdraw Form -->
                                <div class="mb-3">
                                    <label for="withdrawAmount" class="form-label">Amount:</label>
                                    <input type="number" class="form-control" id="withdrawAmount" name="withdrawAmount"
                                        placeholder="Enter amount">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" id="withdrawBtn" class="btn btn-primary">Withdraw</button>
                                <span id="processing" style="display:none;">Processing...</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer"></div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal" id="updateSubjectModal">
        <div class="modal-dialog">
            <div class="modal-content" id="subjectmodalget">
            </div>
        </div>
    </div>
    <script src="{{ URL::asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        function withdraw() {
            $('#withdraw_modal').modal('show');
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#withdrawBtn').click(function(e) {
                e.preventDefault();
                $(this).prop('disabled', true);
                $('#withdrawBtn').hide();
                $('#processing').show();
                let formData = $('#withdrawForm').serialize();
                $.ajax({
                    url: $('#withdrawForm').attr('action'),
                    type: 'GET',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log(data)
                        if (data.status_code == 401) {
                            $('#withdrawBtn').show();
                            Swal.fire({
                                position: 'center',
                                icon: 'warning',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 2000,
                                showCloseButton: true
                            });
                        } else if (data.status_code == 501) {
                            $('#withdrawBtn').show();
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 2000,
                                showCloseButton: true
                            });
                        } else if (data.status_code == 200) {
                            $('#withdrawBtn').show();
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: data.message,
                                showConfirmButton: false,
                                timer: 2000,
                                showCloseButton: true
                            }).then(function() {
                                window.location.reload();
                            });
                        }
                    },
                    complete: function() {
                        $('#processing').hide();
                        $('#withdrawBtn').prop('disabled', false);
                    }
                });
            });
        });
    </script>
@endsection
