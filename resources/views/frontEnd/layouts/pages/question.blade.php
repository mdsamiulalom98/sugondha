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
                    
                    <form action="{{ route('exam.validation') }}" method="POST">
                        @csrf
                        <div class="question__parent">
                            @foreach($questions as $key => $value)
                                <div class="questions__part" 
                                    style="background-color: {{ $loop->even ? '#153e5803' : '#fff' }};">
                                    <div class="main_question">
                                        <strong>{{ $loop->iteration }}. {{ $value->question }}</strong>
                                    </div>
                                    <input type="hidden" name="questions[{{ $key }}][id]" value="{{ $value->id }}">
                                    <div class="options_parts">
                                        <div class="option_one">
                                            <input class="form-check-input" type="radio" 
                                                name="questions[{{ $key }}][answer]" 
                                                id="option_{{ $key }}_1" 
                                                value="{{ $value->option_1 }}" />
                                            <label class="form-check-label" for="option_{{ $key }}_1">
                                                a) {{ $value->option_1 }}
                                            </label>
                                        </div>

                                        <div class="option_one">
                                            <input class="form-check-input" type="radio" 
                                                name="questions[{{ $key }}][answer]" 
                                                id="option_{{ $key }}_2" 
                                                value="{{ $value->option_2 }}" />
                                            <label class="form-check-label" for="option_{{ $key }}_2">
                                                b) {{ $value->option_2 }}
                                            </label>
                                        </div>

                                        <div class="option_one">
                                            <input class="form-check-input" type="radio" 
                                                name="questions[{{ $key }}][answer]" 
                                                id="option_{{ $key }}_3" 
                                                value="{{ $value->option_3 }}" />
                                            <label class="form-check-label" for="option_{{ $key }}_3">
                                                c) {{ $value->option_3 }}
                                            </label>
                                        </div>

                                        <div class="option_one">
                                            <input class="form-check-input" type="radio" 
                                                name="questions[{{ $key }}][answer]" 
                                                id="option_{{ $key }}_4" 
                                                value="{{ $value->option_4 }}" />
                                            <label class="form-check-label" for="option_{{ $key }}_4">
                                                d) {{ $value->option_4 }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="submit" id="submit__question">Submit</button>
                    </form>
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


@if(session('claim_discount'))
<script>
    let countdownTime = new Date("{{ session('claim_discount') }}").getTime();
    let interval = setInterval(function () {
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
@endpush
