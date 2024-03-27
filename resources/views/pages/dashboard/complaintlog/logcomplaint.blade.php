@extends('layouts.main')
@section('title', 'Complaint Logs')
@section('content')
    <!-- push external head elements to head -->
    @push('head')
        <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/webicons/css/all.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @endpush
    <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8 col-md-6 col-12">
                    <div class="page-header-title">
                        <i class="fa-solid fa-box-tissue bg-blue" style="margin-right:10px;"></i>
                        <div class="d-inline">
                            <h5>{{ __('Complaints') }}</h5>
                            <span>{{ __('List of Complaint Logs') }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12 mt-4 mt-md-0">
                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">{{ __('Complaint Logs') }}</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- start message area-->
            @include('include.message')
            <!-- end message area-->
            <div class="col-md-12 user-table-data  col-12 pe-0 pe-md-2">

                <div class="card p-md-3 p-2">
                    <div class="card-header justify-content-between">
                        <h3>{{ __('Complaints') }}</h3>
                    </div>

                    <div class=" mt-4  px-0 pe-md-4 d-flex justify-content-between">
                        <h3 class="col-auto  d-none d-md-inline-block">{{ __('') }}</h3>
                        <div
                            class="col-12 col-md-6 col-lg-6 col-xl-5 d-flex px-0 justify-content-between align-items-center gap-2">
                            <select name="status" id="status" class="col-md-6 select2 form-select">
                                <option value="">All Search</option>
                                <option value="website"
                                    {{ !empty($_GET['status']) && $_GET['status'] == 'website' ? 'selected' : '' }}>Website</option>
                                <option value="admin"
                                    {{ !empty($_GET['status']) && $_GET['status'] == 'admin' ? 'selected' : '' }}>Admin
                                </option>
                                <option value="tutor"
                                    {{ !empty($_GET['status']) && $_GET['status'] == 'tutor' ? 'selected' : '' }}>Tutor</option>
                                <option value="organization"
                                    {{ !empty($_GET['status']) && $_GET['status'] == 'organization' ? 'selected' : '' }}>Organization</option>
                            </select>
                            <input type="text" id="serach" name="serach" value="{{ $_GET['serach'] ?? '' }}"
                                class="form-control" placeholder="Search">

                        </div>

                    </div>
                    <div class="card-body" style="overflow: scroll;">

                        <div class="container mt-2  custom-table px-1 ">
                            <table id="user_table" class="table table-bordered">
                                <thead class="student-table-details">
                                    <tr>
                                        <th>#Ticket No</th>
                                        <th>Complainer</th>
                                        <th>Subject</th>
                                        <th>Position</th>
                                        <th>Booking Id</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($Complaints->count() > 0)
                                        @foreach ($Complaints as $Complaint)
                                            <tr>
                                                <td><a onclick="freeMeetmodal('{{ $Complaint->id }}','{{ $Complaint->status }}')"
                                                        style="cursor: pointer;font-size:20px;color:blue;">{{ $Complaint->TicketID }}</a>
                                                </td>
                                                <td>{{ optional(App\Models\User::find($Complaint->user_id))->username == ''?optional(App\Models\User::find($Complaint->user_id))->first_name.' '.optional(App\Models\User::find($Complaint->user_id))->last_name:optional(App\Models\User::find($Complaint->user_id))->username }}
                                                </td>
                                                <td>{{ $Complaint->subject }}</td>
                                                <td>{{ $Complaint->type }}</td>
                                                <td>
                                                    @if (empty($Complaint->booking_id))
                                                        N/A
                                                    @else
                                                        {{ $Complaint->booking_id }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($Complaint->status == 'Pending')
                                                        <span
                                                            class="badge badge-warning px-3">{{ $Complaint->status }}</span>
                                                    @elseif($Complaint->status == 'Processing')
                                                        <span
                                                            class="badge badge-danger px-2">{{ $Complaint->status }}</span>
                                                    @else
                                                        <span
                                                            class="badge badge-success px-2">{{ $Complaint->status }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($Complaint->created_at)->format('F j, Y \a\t g:i A') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                        <!--<div>-->
                                        <!--    <div>-->
                                        <!--        {!! $Complaints->links('pagination.custom') !!}-->
                                        <!--    </div>-->
                                        <!--</div>-->
                                    @else
                                        <tr>
                                            <td class="text-center" colspan="6">Record not found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade zoomIn" id="demo_meeting_modal" tabindex="-1" aria-labelledby="update_doc_modal"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0">
                <div class="modal-header p-3 bg-info-subtle">
                    <h5 class="modal-title" id="update_doc_modal_title">Complaint Detail's</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row mt-4">
                        <div class="col-12">
                            <table>
                                <tbody id="AppendData">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <form action="{{ url('complaint/Update') }}" method="POST"
                        class="hstack gap-2 justify-content-end d-flex">
                        @csrf
                        <input type="hidden" id="Tutorid" name="Tutorid">
                        <select class="form-select " name="status" id="updated_user_status">
                            <option value="Pending" selected>Pending</option>
                            <option value="Processing">Processing</option>
                            <option value="Completed">Completed</option>
                        </select>

                        <button type="submit" class="btn btn-success" id="add-btn">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script src="{{ asset('plugins/select2/dist/js/select2.min.js') }}"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
        <script>
            function freeMeetmodal(id, status) {
                $('#Tutorid').val(id)
                $('#updated_user_status').val(status);
                $.ajax({
                    url: "/get/interview",
                    method: "GET",
                    data: {
                        id: id
                    },
                    success: function(html) {
                        $("#AppendData").html(html);
                        $('#demo_meeting_modal').modal('show');

                    },

                });
            }
        </script>

        <script>
            $(document).ready(function() {
                const fetch_data = (page, status, seach_term) => {
                    if (status === undefined) {
                        status = "";
                    }
                    if (seach_term === undefined) {
                        seach_term = "";
                    }
                    $.ajax({
                        url: "Complaintlogs/?page=" + page + "&status=" + status + "&seach_term=" +
                            seach_term,
                        success: function(data) {
                            $('tbody').html('');
                            $('tbody').html(data);
                        }
                    })
                }

                $('body').on('keyup', '#serach', function() {
                    var status = $('#status').val();
                    var seach_term = $('#serach').val();
                    var page = $('#hidden_page').val();
                    fetch_data(page, status, seach_term);
                });

                $('body').on('change', '#status', function() {
                    var status = $('#status').val();
                    var seach_term = $('#serach').val();
                    var page = $('#hidden_page').val();
                    fetch_data(page, status, seach_term);
                });

                $('body').on('click', '.pager a', function(event) {
                    event.preventDefault();
                    var page = $(this).attr('href').split('page=')[1];
                    $('#hidden_page').val(page);
                    var serach = $('#serach').val();
                    var seach_term = $('#status').val();
                    fetch_data(page, status, seach_term);
                });
            });
        </script>
    @endpush
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection
