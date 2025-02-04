@extends('frontEnd.layouts.master') @section('title', 'Claim Exam') @push('css')
<link rel="stylesheet" href="{{ asset('public/frontEnd/css/select2.min.css') }}" />
@endpush
@section('content')

<section class="question__page">
    <div class="container_question">
        <div class="row">
            <div class="col-sm-12">
                <div class="exam_timing">
                    <h5>সময় : ২৫ মিনিট</h5>
                    <h4>প্রতিটি প্রশ্নের জন্য ২ পয়েন্ট করে</h4>
                </div>
                <div class="question__page__header">

                    <div class="time__duration">
                        <button id="time__duration__btn">Start Exam Now</button>
                    </div>

                    <div class="question__parent">
                        @php
                            $questions = Session::get('questions');
                            $current_question_index = Session::get('current_question_index', 0);
                            $question_count = count($questions);

                            $percentage =
                                $question_count > 0 ? round(($current_question_index / $question_count) * 100, 2) : 0;
                        @endphp
                        <div class="progress">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $percentage }}%"
                                aria-valuenow="{{ $percentage }}" aria-valuemin="0"
                                aria-valuemax="{{ $percentage }}"></div>
                        </div>

                        <div class="answer-alert success" style="display: none;">
                            <i class="fa fa-check"></i>
                            <span>সঠিক উত্তর </span>
                        </div>
                        <div class="answer-alert failure " style="display: none;">
                            <i class="fa fa-times"></i>
                            <span>ভুল উত্তর </span>
                        </div>



                        @if (isset($current_question))
                            <div class="questions__part"
                                style="background-color: {{ $current_question_index ? '#153e5803' : '#fff' }};">
                                <div class="main_question">
                                    <strong>{{ $current_question_index + 1 }}.
                                        {{ $current_question->question }}</strong>
                                </div>
                                <input type="hidden" name="questions[{{ $current_question_index }}][id]"
                                    value="{{ $current_question->id }}">
                                <div class="options_parts">
                                    <div class="option_one option-part-item">
                                        <input class="form-check-input" type="radio"
                                            name="questions[{{ $current_question_index }}][answer]"
                                            id="option_{{ $current_question_index }}_1"
                                            value="{{ $current_question->option_1 }}" />
                                        <label class="form-check-label" for="option_{{ $current_question_index }}_1"
                                            data-option-id="{{ $current_question->id }}"
                                            data-option-value="{{ $current_question->option_1 }}">
                                            <span>ক</span> {{ $current_question->option_1 }}
                                        </label>
                                    </div>

                                    <div class="option_two option-part-item">
                                        <input class="form-check-input" type="radio"
                                            name="questions[{{ $current_question_index }}][answer]"
                                            id="option_{{ $current_question_index }}_2"
                                            value="{{ $current_question->option_2 }}" />
                                        <label class="form-check-label" for="option_{{ $current_question_index }}_2"
                                            data-option-id="{{ $current_question->id }}"
                                            data-option-value="{{ $current_question->option_2 }}">
                                            <span>খ</span> {{ $current_question->option_2 }}
                                        </label>
                                    </div>

                                    <div class="option_three option-part-item">
                                        <input class="form-check-input" type="radio"
                                            name="questions[{{ $current_question_index }}][answer]"
                                            id="option_{{ $current_question_index }}_3"
                                            value="{{ $current_question->option_3 }}" />
                                        <label class="form-check-label" for="option_{{ $current_question_index }}_3"
                                            data-option-id="{{ $current_question->id }}"
                                            data-option-value="{{ $current_question->option_3 }}">
                                            <span>গ</span>{{ $current_question->option_3 }}
                                        </label>
                                    </div>

                                    <div class="option_four option-part-item">
                                        <input class="form-check-input" type="radio"
                                            name="questions[{{ $current_question_index }}][answer]"
                                            id="option_{{ $current_question_index }}_4"
                                            value="{{ $current_question->option_4 }}" />
                                        <label class="form-check-label" for="option_{{ $current_question_index }}_4"
                                            data-option-id="{{ $current_question->id }}"
                                            data-option-value="{{ $current_question->option_4 }}">
                                            <span>ঘ</span> {{ $current_question->option_4 }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($current_question_index < 9)
                            <button type="button" disabled class="submit__question" id="next-btn">Next Question <i
                                    class="fa fa-arrow-right mx-2"></i></button>
                        @else
                            <button type="button" class="submit__question" id="submit__question">Submit</button>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('script')
<script src="{{ asset('public/frontEnd/') }}/js/parsley.min.js"></script>
<script src="{{ asset('public/frontEnd/') }}/js/form-validation.init.js"></script>
<script src="{{ asset('public/frontEnd/') }}/js/select2.min.js"></script>


@if (session('claim_discount'))
    <script>
        let countdownTime = new Date("{{ session('claim_discount') }}").getTime();
        let interval = setInterval(function() {
            let now = new Date().getTime();
            let distance = countdownTime - now;

            // Calculate time remaining
            let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((distance % (1000 * 60)) / 1000);
            // Display countdown
            document.getElementById("time__duration__btn").innerHTML =
                "Exam Duration: " + minutes + "m " + seconds + "s";

            // Disable the button during the countdown
            let orderButton = document.getElementById("submit__question");
            orderButton.disabled = false;

            // When the countdown expires
            if (distance < 0) {
                clearInterval(interval);
                document.getElementById("time__duration__btn").innerHTML = "Time Expired!";
                orderButton.innerHTML = "Exam time is up";
                orderButton.disabled = true;

                $.ajax({
                    url: "{{ route('clearClaimDiscount') }}",
                    type: 'GET',
                    success: function(response) {
                        console.log('Claim discount cleared.');
                    }
                });

            }
        }, 1000);
    </script>
@endif

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Handle next button click
        $(document).on('click', '#next-btn', function(e) {
            $.ajax({
                url: "{{ route('next.question') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('.question__parent').html(response.updatedHtml);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Handle next button click
        $(document).on('click', '#submit__question', function(e) {
            $.ajax({
                url: "{{ route('exam.validation') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    $('.question__parent').html(response.updatedHtml);
                    toastr.success(response.message, 'Success');
                    setTimeout(function() {
                        let baseUrl = "{{ url()->route('result.success') }}";
                        let redirectUrl = baseUrl + "?id=" + response.data.id;

                        window.location.href = redirectUrl;
                    }, 3000);
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Handle option click
        $('.question__parent').on('click', 'label', function() {
            $('.form-check-label').addClass('notouch');
            let selectedOption = $(this).data('option-value');
            let questionId = "{{ $current_question->id }}"; // Current question ID
            let optionId = $(this).data('option-id'); // Selected option ID
            $('.submit__question').removeAttr('disabled');

            $.ajax({
                url: "{{ route('check.answer') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    question_id: questionId,
                    option_id: optionId,
                    selected_option: selectedOption
                },
                success: function(response) {
                    if (response.correct) {
                        // Add class for correct answer
                        $('.form-check-label[data-option-value="' + selectedOption + '"]')
                            .addClass(
                                'correct');
                        $('.answer-alert.success').show();
                    } else {
                        // Add class for incorrect answer
                        $('.form-check-label[data-option-value="' + selectedOption + '"]')
                            .addClass(
                                'incorrect');
                        $('.answer-alert.failure').show();
                        // Optionally, highlight the correct answer
                        $('.form-check-label[data-option-value="' + response
                                .correct_option_id + '"]')
                            .addClass('correct');
                    }
                }
            });
        });
    });
</script>
@endpush
