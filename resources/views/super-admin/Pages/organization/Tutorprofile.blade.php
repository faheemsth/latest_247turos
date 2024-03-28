@extends('layouts.main')
@section('title', 'Users')
@section('content')
<!-- push external head elements to head -->
@push('head')
        <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/webicons/css/all.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
            <link href="{{ URL::asset('assets/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    @endpush
    <style>
    .select2-container {
        width: 100% !important;
    }
    .bachset {
    background-color: white !important
    border: 1px solid rgb(59 59 59 / 61%) !important;
    }
    .minlitem{
        min-width:170px;
    }
    table tr th{
        min-width:150px;

    }
</style>

<div class="container">
    <div class="row">
        @if (session('success'))
        <div class="alert alert-success mt-4">
            {{ session('success') }}
        </div>
        @endif

        @if (session('failed'))
        <div class="alert alert-danger mt-4">
            {{ session('failed') }}
        </div>
        @endif
        <div class="col-lg-3 col-md-4 col-8">
            <div class="card mt-n5">
                <div class="card-body p-lg-2 p-xl-4 px-4">
                    <div class="text-center">
                        <div class="profile-user">

                            @if (!empty($tutor->image) && file_exists(public_path(!empty($tutor) ? $tutor->image : '')))
                            <img src="{{ asset($tutor->image) }}"
                                 style="width: 150px;
    border-radius: 50%;
    height: 150px;"
                                alt="user-profile-image">
                            @else

                            @if($tutor->gender == 'Male')
                            <img src="{{ asset('assets/images/male.jpg') }}"

                                alt="user-profile-image"  style="width: 150px;
    border-radius: 50%;
    height: 150px;">
                            @elseif($tutor->gender == 'Female')
                            <img src="{{ asset('assets/images/female.jpg') }}"

                                alt="user-profile-image"  style="width: 150px;
    border-radius: 50%;
    height: 150px;">
                            @else
                            <img src="{{ asset('assets/images/default.png') }}"

                                alt="user-profile-image"  style="width: 150px;
    border-radius: 50%;
    height: 150px;">
                            @endif
                            @endif


                            <div class="avatar-xs p-0 mt-2 rounded-circle profile-photo-edit">
                            </div>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </div>
                        <h5 class="fs-17 mb-1">{{ $tutor->first_name }} {{ $tutor->last_name }}</h5>
                        <p class="text-muted mb-0">Tutor</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9 col-md-8 col-12">
            <div class="card mt-xxl-n5">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0 " style=" overflow: scroll;
    flex-wrap: nowrap;" role="tablist">
                        <li class="nav-item minlitem" role="presentation" >
                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab"
                                aria-selected="true">
                                <i class="fas fa-home"></i>
                                Personal Details
                            </a>
                        </li>
                      @if(!empty($complaintUser) && $complaintUser->count() > 0)
                            <li class="nav-item minlitem" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#warning" role="tab"
                                    aria-selected="false" tabindex="-1">
                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                    Complaint
                                </a>
                            </li>
                      @endif

                    </ul>
                </div>
                <div class="card-body p-md-4 px-2">
                    <div class="tab-content">
                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                            <form action="{{ url('tutor/update/') . '/' . $tutor->id }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="first_name" class="form-label">First
                                                Name</label>
                                            <input type="text" name="first_name" class="form-control bachset "
                                                value="{{ $tutor->first_name }}" d="first_name"
                                                placeholder="Enter your FullName" value="{{ $tutor->email }}"
                                                name="first_name" >
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="first_name" class="form-label">Last
                                                Name</label>
                                            <input type="text" name="last_name" class="form-control bachset"
                                                value="{{ $tutor->last_name }}" d="first_name"
                                                placeholder="Enter your FullName" value="{{ $tutor->email }}"
                                                name="first_name" >
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="ceo_name" class="form-label">Email</label>
                                            <input type="text" class="form-control bachset" value="{{ $tutor->email }}"
                                                name="email" id="email"
                                                placeholder="Enter your Name of the Head of Institution/CEO/Owner"
                                                value="Mr ABC">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="contact" class="form-label">Contact
                                                Number</label>
                                            <input type="text" class="form-control bachset" value="{{ $tutor->phone }}"
                                                name="phone" id="phone" placeholder="Enter your phone number"
                                                value="12345678">
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <!--end col-->

                                    <!--end col-->
                                    <!--end col-->

                                    <!--end col-->

                                    <!--end col-->



                                    <div class="col-8">
                                        <label class="me-1">Gender :<span style="color:red">*</span></label>
                                        <div class="mb-3 col-md-10 gap-4 d-flex">
                                            <div>
                                                <input class="form-check-input bachset" type="radio" value="Male" {{
                                                    $tutor->gender === 'Male' ? 'checked' : '' }} name="gender"
                                                value="male">
                                                <label class="form-check-label">Male</label>
                                            </div>
                                            <div>
                                                <input class="form-check-input bachset" type="radio" value="Female" {{
                                                    $tutor->gender === 'Female' ? 'checked' : '' }} name="gender"
                                                value="female">
                                                <label class="form-check-label">Female</label>
                                            </div>
                                            <div>
                                                <input class="form-check-input bachset" type="radio" value="Other" {{ $tutor->gender === 'Other' ? 'checked' : '' }} name="gender">
                                                <label class="form-check-label">Others</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="zipcodeInput bachset" class="form-label">Biography
                                            </label>
                                            {{-- <input type="text" class="form-control" id="profile_description"
                                                value="" name="profile_description" placeholder="Enter Province*"
                                                value="Frderal"> --}}
                                            <textarea name="profile_description" class="form-control"
                                                id="profile_description" cols="60"
                                                rows="3">{{ $tutor->profile_description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="mb-3 pb-2">
                                            <label for="description" class="form-label">Address</label>
                                            <textarea class="form-control" value="" name="address" id="address"
                                                placeholder="Enter your description"
                                                rows="3">{{ $tutor->address }}</textarea>
                                        </div>
                                    </div>


                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="countryInput" class="form-label">Postcode
                                            </label>
                                            <input type="text" class="form-control bachset" value="{{ $tutor->zipcode }}"
                                                name="zipcode" id="zipcode" placeholder="District" value="ICT">
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="countryInput bachset" class="form-label">Status</label>
                                            <select class="form-select w-75" name="status" id="updated_user_status">
                                                <option value="Pending" {{ $tutor->status=='Pending'?'selected':'' }}>Pending</option>
                                                <option value="Active" {{ $tutor->status=='Active'?'selected':'' }}>Active</option>
                                                <option value="InActive" {{ $tutor->status=='InActive'?'selected':'' }}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit"
                                                class="py-2 px-3 bg-primary border-0 rounded-3 text-white">Update</button>
                                            <button type="button"
                                                class="ms-2 py-2 px-3  border-0 rounded-3">Cancel</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </form>
                        </div>

                        <div class="tab-pane" id="programs" role="tabpanel">

                            <div class="card">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="table-responsive">
                                                <table class="table table-borderless align-middle mb-0">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th scope="col">Degree Title</th>
                                                            <th scope="col">Institute</th>
                                                            <th scope="col">Grade</th>
                                                            <th scope="col">Type</th>
                                                            <th scope="col">Completed Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @isset($tutor_qualifications)
                                                        @foreach ($tutor_qualifications as $item)
                                                        <tr>
                                                            <td>{{ $item->degree_title != null ? $item->degree_title :
                                                                '--' }}
                                                            </td>
                                                            <td>{{ $item->institute != null ? $item->institute : '--' }}
                                                            </td>
                                                            @php
                                                            $grade = '--';
                                                            if ($item->grade) {
                                                            if ($item->grade == 1) {
                                                            $grade = 'A+';
                                                            } elseif ($item->grade == 2) {
                                                            $grade = 'B+';
                                                            } else {
                                                            $grade = 'C+';
                                                            }
                                                            }
                                                            @endphp
                                                            <td>{{ $grade }}</td>
                                                            <td>{{ $item->type != null ? $item->type : '--' }}</td>
                                                            <td>{{ $item->degree_completed != null ?
                                                                $item->degree_completed : '--' }}
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        @endisset
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end card-body-->

                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane" id="documents" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4">
                                        <h5 class="card-title flex-grow-1 mb-0">Documents</h5>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="table-responsive">
                                                <table class="table table-borderless align-middle mb-0">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th scope="col">File Name</th>
                                                            <th scope="col">Files</th>
                                                            <th scope="col">Expiry Date</th>
                                                            <th scope="col">Status</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @isset($tutor_application)
                                                        @isset($tutor_application->user_id)
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar-sm">
                                                                        <div
                                                                            class="avatar-title bg-primary-subtle text-primary rounded fs-20">
                                                                            <i class="ri-attachment-line"></i>

                                                                        </div>
                                                                    </div>
                                                                    <div class="ms-3 flex-grow-1">
                                                                        <h6 class="fs-15 mb-0"><a
                                                                                href="javascript:void(0)">Tutor Id</a>
                                                                        </h6>
                                                                    </div>
                                                                </div>

                                                            </td>
                                                            <td >
                                                                @php $extension =
                                                                strtolower(pathinfo(storage_path($tutor_application->user_id),
                                                                PATHINFO_EXTENSION)); @endphp
                                                                @if (in_array($extension, ['png', 'jpg', 'jpeg', 'gif',
                                                                'bmp', 'svg', 'webp', 'ico', 'raw']))
                                                                @if (!empty($tutor_application->user_id) &&
                                                                file_exists(public_path(!empty($tutor_application->user_id)
                                                                ? $tutor_application->user_id : '')))
                                                                <button type="button" class="btn btn-default"
                                                                    onclick="getimage('{{ asset($tutor_application->user_id) }}')">
                                                                    <img src="{{ asset($tutor_application->user_id) }}"
                                                                        width="50" height="50" />
                                                                </button>
                                                                @endif
                                                                @elseif (in_array($extension, ['pdf']))
                                                                <button type="button" class="btn btn-default "
                                                                onclick="getpdf('{{ asset($tutor_application->user_id) }}')">
                                                                    @if ($extension == 'pdf')
                                                                    <img src="{{ asset('assets\document_images\pdf.png') }}"
                                                                        width="50" height="50" />
                                                                    @endif
                                                                </button>
                                                                @elseif (in_array($extension, ['docx']))
                                                                <button type="button" class="btn btn-default "
                                                                onclick="getdocx('{{ asset($tutor_application->user_id) }}')">
                                                                    <img src="{{ asset('assets\document_images\word.jpg') }}"
                                                                        width="50" height="50" />
                                                                </button>
                                                                @endif
                                                            </td>

                                                            <td>{{ $tutor_application->user_id_expiry }}</td>
                                                            <td>
                                                                @if ($tutor_application->user_id_status == 'pending')
                                                                <a href="javascript:void(0);"
                                                                    class="badge bg-warning-subtle text-warning"
                                                                    id="user_id">Pending</a>
                                                                @elseif($tutor_application->user_id_status ==
                                                                'accepted')
                                                                <a href="javascript:void(0);"
                                                                    class="badge bg-success-subtle text-success"
                                                                    id="user_id">Accepted</a>
                                                                @else
                                                                <a href="javascript:void(0);"
                                                                    class="badge bg-danger-subtle text-danger"
                                                                    id="user_id">Rejected</a>
                                                                @endif
                                                                <span class="user_id"></span>
                                                            </td>
                                                            <td>
                                                                <a style="cursor:pointer"
                                                                    onclick="updateDoc({{ $tutor_application->id }},'user_id')"
                                                                    class="link-success fs-20" tooltip="Add File"><i
                                                                        class="ri-edit-box-line" style="font-size:22px;"></i></a>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar-sm">
                                                                        <div
                                                                            class="avatar-title bg-primary-subtle text-primary rounded fs-20">
                                                                            <i class="ri-attachment-line"></i>

                                                                        </div>
                                                                    </div>
                                                                    <div class="ms-3 flex-grow-1">
                                                                        <h6 class="fs-15 mb-0"><a
                                                                                href="javascript:void(0)">Tutor
                                                                                Selfie</a>
                                                                        </h6>
                                                                    </div>
                                                                </div>

                                                            </td>
                                                            <td>
                                                                @php $extension =
                                                                strtolower(pathinfo(storage_path($tutor_application->selfie),
                                                                PATHINFO_EXTENSION)); @endphp
                                                                @if (in_array($extension, ['png', 'jpg', 'jpeg', 'gif',
                                                                'bmp', 'svg', 'webp', 'ico', 'raw']))
                                                                @if (!empty($tutor_application->selfie) &&
                                                                file_exists(public_path(!empty($tutor_application->selfie)
                                                                ? $tutor_application->selfie : '')))
                                                                <button type="button" class="btn btn-default"
                                                                onclick="getimage('{{ asset($tutor_application->selfie) }}')">
                                                                    <img src="{{ asset($tutor_application->selfie) }}"
                                                                        width="50" height="50" />
                                                                </button>
                                                                @endif
                                                                @elseif (in_array($extension, ['pdf']))
                                                                <button type="button" class="btn btn-default"
                                                                onclick="getpdf('{{ asset($tutor_application->selfie) }}')">
                                                                    @if ($extension == 'pdf')
                                                                    <img src="{{ asset('assets\document_images\pdf.png') }}"
                                                                        width="50" height="50" />
                                                                    @endif
                                                                </button>
                                                                @elseif (in_array($extension, ['docx']))
                                                                <button type="button" class="btn btn-default"
                                                                onclick="getdocx('{{ asset($tutor_application->selfie) }}')">
                                                                    <img src="{{ asset('assets\document_images\word.jpg') }}"
                                                                        width="50" height="50" />
                                                                </button>
                                                                @endif
                                                            </td>
                                                            <td>--</td>
                                                            <td>
                                                                @if ($tutor_application->selfie_status == 'pending')
                                                                <a href="javascript:void(0);"
                                                                    class="badge bg-warning-subtle text-warning"
                                                                    id="selfie">Pending</a>
                                                                @elseif($tutor_application->selfie_status == 'accepted')
                                                                <a href="javascript:void(0);"
                                                                    class="badge bg-success-subtle text-success"
                                                                    id="selfie">Accepted</a>
                                                                @else
                                                                <a href="javascript:void(0);"
                                                                    class="badge bg-danger-subtle text-danger"
                                                                    id="selfie">Rejected</a>
                                                                @endif
                                                                <span class="selfie"></span>
                                                            </td>
                                                            <td>
                                                                <a style="cursor:pointer"
                                                                    onclick="updateDoc({{ $tutor_application->id }},'selfie')"
                                                                    class="link-success fs-20" tooltip="Add File"><i
                                                                        class="ri-edit-box-line" style="font-size:22px;"></i></a>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar-sm">
                                                                        <div
                                                                            class="avatar-title bg-primary-subtle text-primary rounded fs-20">
                                                                            <i class="ri-attachment-line"></i>

                                                                        </div>
                                                                    </div>
                                                                    <div class="ms-3 flex-grow-1">
                                                                        <h6 class="fs-15 mb-0"><a
                                                                                href="javascript:void(0)">Address
                                                                                Proof</a>
                                                                        </h6>
                                                                    </div>
                                                                </div>

                                                            </td>
                                                            <td>
                                                                @php $extension =
                                                                strtolower(pathinfo(storage_path($tutor_application->address_proof),
                                                                PATHINFO_EXTENSION)); @endphp
                                                                @if (in_array($extension, ['png', 'jpg', 'jpeg', 'gif',
                                                                'bmp', 'svg', 'webp', 'ico', 'raw']))
                                                                @if (!empty($tutor_application->address_proof) &&
                                                                file_exists(public_path(!empty($tutor_application->address_proof)
                                                                ? $tutor_application->address_proof : '')))
                                                                <button type="button" class="btn btn-default "
                                                                onclick="getimage('{{ asset($tutor_application->address_proof) }}')">
                                                                    <img src="{{ asset($tutor_application->address_proof) }}"
                                                                        width="50" height="50" />
                                                                </button>
                                                                @endif
                                                                @elseif (in_array($extension, ['pdf']))
                                                                <button type="button" class="btn btn-default"
                                                                onclick="getpdf('{{ asset($tutor_application->address_proof) }}')">
                                                                    @if ($extension == 'pdf')
                                                                    <img src="{{ asset('assets\document_images\pdf.png') }}"
                                                                        width="50" height="50" />
                                                                    @endif
                                                                </button>
                                                                @elseif (in_array($extension, ['docx']))
                                                                <button type="button" class="btn btn-default"
                                                                onclick="getdocx('{{ asset($tutor_application->address_proof) }}')">
                                                                    <img src="{{ asset('assets\document_images\word.jpg') }}"
                                                                        width="50" height="50" />
                                                                </button>
                                                                @endif
                                                            </td>
                                                            <td>{{ $tutor_application->address_proof_expiry }}</td>
                                                            <td>
                                                                @if ($tutor_application->address_proof_status ==
                                                                'pending')
                                                                <a href="javascript:void(0);"
                                                                    class="badge bg-warning-subtle text-warning"
                                                                    id="addressproof">Pending</a>
                                                                @elseif($tutor_application->address_proof_status ==
                                                                'accepted')
                                                                <a href="javascript:void(0);"
                                                                    class="badge bg-success-subtle text-success"
                                                                    id="addressproof">Accepted</a>
                                                                @else
                                                                <a href="javascript:void(0);"
                                                                    class="badge bg-danger-subtle text-danger"
                                                                    id="addressproof">Rejected</a>
                                                                @endif
                                                                <span class="addressproof"></span>
                                                            </td>
                                                            <td>
                                                                <a style="cursor:pointer"
                                                                    onclick="updateDoc({{ $tutor_application->id }},'addressproof')"
                                                                    class="link-success fs-20" tooltip="Add File"><i
                                                                        class="ri-edit-box-line" style="font-size:22px;"></i></a>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar-sm">
                                                                        <div
                                                                            class="avatar-title bg-primary-subtle text-primary rounded fs-20">
                                                                            <i class="ri-attachment-line"></i>

                                                                        </div>
                                                                    </div>
                                                                    <div class="ms-3 flex-grow-1">
                                                                        <h6 class="fs-15 mb-0"><a
                                                                                href="javascript:void(0)">Enhaced
                                                                                DBS</a>
                                                                        </h6>
                                                                    </div>
                                                                </div>

                                                            </td>
                                                            <td>
                                                                @php $extension =
                                                                strtolower(pathinfo(storage_path($tutor_application->enhaced_dbs),
                                                                PATHINFO_EXTENSION)); @endphp
                                                                @if (in_array($extension, ['png', 'jpg', 'jpeg', 'gif',
                                                                'bmp', 'svg', 'webp', 'ico', 'raw']))
                                                                @if (!empty($tutor_application->enhaced_dbs) &&
                                                                file_exists(public_path(!empty($tutor_application->enhaced_dbs)
                                                                ? $tutor_application->enhaced_dbs : '')))
                                                                <button type="button" class="btn btn-default"
                                                                onclick="getimage('{{ asset($tutor_application->enhaced_dbs) }}')">
                                                                    <img src="{{ asset($tutor_application->enhaced_dbs) }}"
                                                                        width="50" height="50" />
                                                                </button>
                                                                @endif
                                                                @elseif (in_array($extension, ['pdf']))
                                                                <button type="button" class="btn btn-default"
                                                                    onclick="getpdf(`{{ asset($tutor_application->enhaced_dbs) }}`)">
                                                                    @if ($extension == 'pdf')
                                                                    <img src="{{ asset('assets\document_images\pdf.png') }}"
                                                                        width="50" height="50" />
                                                                    @endif
                                                                </button>
                                                                @elseif (in_array($extension, ['docx']))
                                                                <button type="button" class="btn btn-default"
                                                                onclick="getdocx('{{ asset($tutor_application->enhaced_dbs) }}')">
                                                                    <img src="{{ asset('assets\document_images\word.jpg') }}"
                                                                        width="50" height="50" />
                                                                </button>
                                                                @endif
                                                            </td>
                                                            <td>{{ $tutor_application->enhaced_dbs_expiry }}</td>
                                                            <td>
                                                                @if ($tutor_application->enhaced_dbs_status ==
                                                                'pending')
                                                                <a href="javascript:void(0);"
                                                                    class="badge bg-warning-subtle text-warning"
                                                                    id="enhaced_dbs">Pending</a>
                                                                @elseif($tutor_application->enhaced_dbs_status ==
                                                                'accepted')
                                                                <a href="javascript:void(0);"
                                                                    class="badge bg-success-subtle text-success"
                                                                    id="enhaced_dbs">Accepted</a>
                                                                @else
                                                                <a href="javascript:void(0);"
                                                                    class="badge bg-danger-subtle text-danger"
                                                                    id="enhaced_dbs">Rejected</a>
                                                                @endif
                                                                <span class="enhaced_dbs"></span>
                                                            </td>
                                                            <td>
                                                                <a style="cursor:pointer"
                                                                    onclick="updateDoc({{ $tutor_application->id }},'enhaced_dbs')"
                                                                    class="link-success fs-20" tooltip="Add File"><i
                                                                        class="ri-edit-box-line" style="font-size:22px;"></i></a>
                                                            </td>

                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <div class="d-flex align-items-center">
                                                                    <div class="avatar-sm">
                                                                        <div
                                                                            class="avatar-title bg-primary-subtle text-primary rounded fs-20">
                                                                            <i class="ri-attachment-line"></i>

                                                                        </div>
                                                                    </div>
                                                                    <div class="ms-3 flex-grow-1">
                                                                        <h6 class="fs-15 mb-0"><a
                                                                                href="javascript:void(0)">CV</a>
                                                                        </h6>
                                                                    </div>
                                                                </div>

                                                            </td>
                                                            <td>
                                                                @php $extension =
                                                                strtolower(pathinfo(storage_path($tutor_application->cv),
                                                                PATHINFO_EXTENSION)); @endphp
                                                                @if (in_array($extension, ['png', 'jpg', 'jpeg', 'gif',
                                                                'bmp', 'svg', 'webp', 'ico', 'raw']))
                                                                @if (!empty($tutor_application->cv) &&
                                                                file_exists(public_path(!empty($tutor_application->cv) ?
                                                                $tutor_application->cv : '')))
                                                                <button type="button" class="btn btn-default"
                                                                onclick="getimage('{{ asset($tutor_application->cv) }}')">
                                                                    <img src="{{ asset($tutor_application->cv) }}"
                                                                        width="50" height="50" />
                                                                </button>
                                                                @endif
                                                                @elseif (in_array($extension, ['pdf']))
                                                                <button type="button" class="btn btn-default"
                                                                onclick="getpdf('{{ asset($tutor_application->cv) }}')">
                                                                    @if ($extension == 'pdf')
                                                                    <img src="{{ asset('assets\document_images\pdf.png') }}"
                                                                        width="50" height="50" />
                                                                    @endif
                                                                </button>
                                                                @elseif (in_array($extension, ['docx']))
                                                                <button type="button" class="btn btn-default"
                                                                onclick="getdocx('{{ asset($tutor_application->cv) }}')">
                                                                    <img src="{{ asset('assets\document_images\word.jpg') }}"
                                                                        width="50" height="50" />
                                                                </button>
                                                                @endif
                                                            </td>
                                                            <td>--</td>
                                                            <td>
                                                                @if ($tutor_application->cv_status == 'Pending')
                                                                <a href="javascript:void(0);"
                                                                    class="badge bg-warning-subtle text-warning"
                                                                    id="cv">Pending</a>
                                                                @elseif($tutor_application->cv_status == 'accepted')
                                                                <a href="javascript:void(0);"
                                                                    class="badge bg-success-subtle text-success"
                                                                    id="cv">Accepted</a>
                                                                @else
                                                                <a href="javascript:void(0);"
                                                                    class="badge bg-danger-subtle text-danger"
                                                                    id="cv">Rejected</a>
                                                                @endif
                                                                <span class="cv"></span>
                                                            </td>
                                                            <td>
                                                                <a style="cursor:pointer"
                                                                    onclick="updateDoc({{ $tutor_application->id }},'cv')"
                                                                    class="link-success fs-20" tooltip="Add File"><i
                                                                        class="ri-edit-box-line" style="font-size:22px;"></i></a>
                                                            </td>
                                                        </tr>
                                                        @endisset
                                                        @endisset
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="availability" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4">
                                        <h5 class="card-title flex-grow-1 mb-0">Availability</h5>

                                    </div>

                                </div>
                            </div>
                        </div>
                        <!--end tab-pane-->









                        <div class="tab-pane" id="warning" role="tabpanel">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4">
                                        <h5 class="card-title flex-grow-1 mb-0">Complaint</h5>

                                    </div>
                                    <div class="row">
                                        <form action="{{ url('complaint/stages/submit') }}" method="POST" class="col-lg-12">
                                            @csrf
                                            <input type="hidden" value="{{$tutor->id}}" name="id">
                                            <div class="table-responsive">
                                                <div class="col-lg-12 px-0 px-md-2">
                                                <div class="mb-3">
                                                    <label for="zipcodeInput" class="form-label">Comment's
                                                    </label>

                                                    <textarea name="complaint_message" class="bachset form-control" required
                                                        id="profile_description" cols="60"
                                                        rows="3">{{ $tutor->complaint_message }}</textarea>
                                                   </div>
                                                </div>
                                                <div class="col-lg-4 px-0 px-md-2">
                                                    <div class="mb-3">
                                                        <label for="countryInput bachset" class="form-label">Stage's</label>
                                                        <select class="form-select w-75" name="complaint_stage" id="updated_user_status" required>
                                                             <!--<option value="">Select Stage</option>-->
                                                             <option value="Default" {{ $tutor->complaint_stage=='Default'?'selected':'' }}>Default</option>
                                                            <option value="Personal inform" {{ $tutor->complaint_stage=='Personal inform'?'selected':'' }}>Personal inform</option>
                                                            <option value="Disclaimer" {{ $tutor->complaint_stage=='Disclaimer'?'selected':'' }}>Disclaimer</option>
                                                            <option value="Blocked" {{ $tutor->complaint_stage=='Blocked'?'selected':'' }}>Blocked</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>



                                         <div class="col-lg-12 px-0 px-md-2">
                                               <div class="hstack gap-2 justify-content-end">
                                                  <button type="submit" class="py-2 px-3 bg-primary border-0 rounded-3 text-white">Update</button>
                                               </div>
                                         </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    <script src="{{ URL::asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>


<script>

    function getdocx(docx) {
        alert(docx);
        $('#docxappend').attr('src', 'https://view.officeapps.live.com/op/view.aspx?src='+docx);
        $('#DocxModal').modal('show');
    }
    function getpdf(pdf) {

        $('#pdfappend').attr('src', pdf);
        $('#pdfModal').modal('show');
    }
    function getimage(image) {
        $('#imagappend').attr('src', image);
        $('#imgModal').modal('show');
    }
</script>

@endsection