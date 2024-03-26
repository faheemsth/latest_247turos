@extends('layouts.main')
@section('title', 'Users')

<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css" rel="stylesheet" />
MDB
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"></script>

@push('head')
    <link rel="stylesheet" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/webicons/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script type="text/javascript" src="../js/languages/ro.js"></script>
@endpush
@section('content')
    <div class="page-header">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <div class="page-header-title">
                    <i class="ik ik-users bg-blue"></i>
                    <div class="d-inline">
                        <h5>{{ __('Newsletter') }}</h5>
                        <span>{{ __('List of Newsletter') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <nav class="breadcrumb-container" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">{{ __('Settings') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ url('newsletter') }}">{{ __('Newsletter') }}</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="#">{{ __('Create') }}</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <!-- start message area-->
            @include('include.message')
            <!-- end message area-->
            <div class="col-md-12  user-table-data">
                <div class="card p-3">
                    <div class="card-header justify-content-between">
                        <h3>{{ __('Blogs') }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="col-md-12 col-lg-12">
                            <form action="{{ url('Newsletter/Send') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Subject</label>
                                    <input type="text" name="Subject" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="name">Content</label>
                                    <div id="editor" style="height: 300px"></div>
                                    <input type="hidden" name="content" id="editor-content-blog" required>
                                </div>
                                <button type="submit" class="btn btn-primary px-2 py-2" style="height: max-content;">
                                    Submit
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script></script>
    <script>
        $(document).ready(function() {
            var froalaEditor = new Quill('div#editor', {
                theme: 'snow'
            });

            $('form').submit(function(event) {
                const editorContent = froalaEditor.root.innerHTML;
                $(`#editor-content-blog`).val(editorContent);
            });
        });
    </script>

@endsection
