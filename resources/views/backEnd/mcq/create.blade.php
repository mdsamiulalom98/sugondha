@extends('backEnd.layouts.master')
@section('title', 'MCQ')
@section('css')
    <link href="{{ asset('public/backEnd') }}/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/backEnd') }}/assets/css/switchery.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/backEnd') }}/assets/libs/summernote/summernote-lite.min.css" rel="stylesheet"
        type="text/css" />
@endsection
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <a href="{{ route('mcq.index') }}" class="btn btn-primary rounded-pill">Manage</a>
                    </div>
                    <h4 class="page-title">MCQ</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('mcq.store') }}" method="POST" class="row"
                            data-parsley-validate="" enctype="multipart/form-data">
                            @csrf

                         <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <label for="subject_id" class="form-label">Subject *</label>
                                <select class="form-control select2 @error('subject_id') is-invalid @enderror"
                                    name="subject_id" value="{{ old('subject_id') }}" id="subject_id" required>
                                    <option value="">Select..</option>
                                    @foreach ($subject as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('subject_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- col end -->

                        <div class="col-sm-6">
                            <div class="form-group mb-3">
                                <label for="topic_id" class="form-label">Topic </label>
                                <select class="form-control select2 @error('topic_id') is-invalid @enderror"
                                    id="topic_id" name="topic_id" data-placeholder="Choose ...">
                                    <optgroup>
                                        <option value="">Select..</option>
                                    </optgroup>
                                </select>
                                @error('topic_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- col end -->
                            <div class="col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="question" class="form-label">Question *</label>
                                    <input type="text" class="form-control @error('question') is-invalid @enderror"
                                        name="question" value="{{ old('question') }}" id="question" required="">
                                    @error('question')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group mb-3">
                                    <label for="option_1" class="form-label">Option 1 *</label>
                                    <input type="text" class="form-control @error('option_1') is-invalid @enderror"
                                        name="option_1" value="{{ old('option_1') }}" id="option_1" required="">
                                    @error('option_1')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group mb-3">
                                    <label for="option_2" class="form-label">Option 2 *</label>
                                    <input type="text" class="form-control @error('option_2') is-invalid @enderror"
                                        name="option_2" value="{{ old('option_2') }}" id="option_2" required="">
                                    @error('option_2')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> 
                            <div class="col-sm-4">
                                <div class="form-group mb-3">
                                    <label for="option_3" class="form-label">Option 3 *</label>
                                    <input type="text" class="form-control @error('option_3') is-invalid @enderror"
                                        name="option_3" value="{{ old('option_3') }}" id="option_3" required="">
                                    @error('option_3')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                             <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="option_4" class="form-label">Option 4 *</label>
                                    <input type="text" class="form-control @error('option_4') is-invalid @enderror"
                                        name="option_4" value="{{ old('option_4') }}" id="option_4" required="">
                                    @error('option_4')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="right_option" class="form-label">Right Option *</label>
                                    <input type="text" class="form-control @error('right_option') is-invalid @enderror"
                                        name="right_option" value="{{ old('right_option') }}" id="right_option" required="">
                                    @error('right_option')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col-end -->
                            <div class="col mb-3">
                                <div class="form-group">
                                    <label for="status" class="d-block">Status</label>
                                    <label class="switch">
                                        <input type="checkbox" value="1" name="status" checked>
                                        <span class="slider round"></span>
                                    </label>
                                    @error('status')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- col end -->
                            <div>
                                <input type="submit" class="btn btn-success" value="Submit">
                            </div>

                        </form>

                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col-->
        </div>
    </div>
@endsection


@section('script')
    <script src="{{ asset('public/backEnd/') }}/assets/libs/parsleyjs/parsley.min.js"></script>
    <script src="{{ asset('public/backEnd/') }}/assets/js/pages/form-validation.init.js"></script>
    <script src="{{ asset('public/backEnd/') }}/assets/libs/select2/js/select2.min.js"></script>
    <script src="{{ asset('public/backEnd/') }}/assets/js/pages/form-advanced.init.js"></script>
    <script src="{{ asset('public/backEnd/') }}/assets/js/switchery.min.js"></script>
    <script>
        $(document).ready(function() {
            var elem = document.querySelector('.js-switch');
            var init = new Switchery(elem);
        });
        // category to sub
        $("#subject_id").on("change", function() {
            var ajaxId = $(this).val();
            if (ajaxId) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('ajax-subject-topic') }}?subject_id=" + ajaxId,
                    success: function(res) {
                        if (res) {
                            $("#topic_id").empty();
                            $("#topic_id").append('<option value="0">Choose...</option>');
                            $.each(res, function(key, value) {
                                $("#topic_id").append('<option value="' + key + '">' +
                                    value + "</option>");
                            });
                        } else {
                            $("#topic_id").empty();
                        }
                    },
                });
            } else {
                $("#topic_id").empty();
            }
        });
    </script>

    <script src="{{ asset('public/backEnd/') }}/assets/libs//summernote/summernote-lite.min.js"></script>

    <script>
        $(".summernote").summernote({
            placeholder: "Enter Your Text Here",
        });
    </script>

@endsection
