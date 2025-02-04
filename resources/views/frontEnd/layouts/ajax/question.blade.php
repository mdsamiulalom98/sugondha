@php
    $questions = Session::get('questions');
    $current_question_index = Session::get('current_question_index', 0);
    $question_count = count($questions);

    $percentage = $question_count > 0 ? round(($current_question_index / $question_count) * 100, 2) : 0;
@endphp
<div class="progress">
    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $percentage }}%"
        aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="{{ $percentage }}"></div>
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
    <div class="questions__part" style="background-color: {{ $current_question_index ? '#153e5803' : '#fff' }};">
        <div class="main_question">
            <strong>{{ $current_question_index + 1 }}.
                {{ $current_question->question }}</strong>
        </div>
        <input type="hidden" name="questions[{{ $current_question_index }}][id]" value="{{ $current_question->id }}">
        <div class="options_parts">
            <div class="option_one option-part-item">
                <input class="form-check-input" type="radio" name="questions[{{ $current_question_index }}][answer]"
                    id="option_{{ $current_question_index }}_1" value="{{ $current_question->option_1 }}" />
                <label class="form-check-label" for="option_{{ $current_question_index }}_1"
                    data-option-id="{{ $current_question->id }}"
                    data-option-value="{{ $current_question->option_1 }}">
                    <span>ক</span> {{ $current_question->option_1 }}
                </label>
            </div>

            <div class="option_two option-part-item">
                <input class="form-check-input" type="radio" name="questions[{{ $current_question_index }}][answer]"
                    id="option_{{ $current_question_index }}_2" value="{{ $current_question->option_2 }}" />
                <label class="form-check-label" for="option_{{ $current_question_index }}_2"
                    data-option-id="{{ $current_question->id }}"
                    data-option-value="{{ $current_question->option_2 }}">
                    <span>খ</span> {{ $current_question->option_2 }}
                </label>
            </div>

            <div class="option_three option-part-item">
                <input class="form-check-input" type="radio" name="questions[{{ $current_question_index }}][answer]"
                    id="option_{{ $current_question_index }}_3" value="{{ $current_question->option_3 }}" />
                <label class="form-check-label" for="option_{{ $current_question_index }}_3"
                    data-option-id="{{ $current_question->id }}"
                    data-option-value="{{ $current_question->option_3 }}">
                    <span>গ</span>{{ $current_question->option_3 }}
                </label>
            </div>

            <div class="option_four option-part-item">
                <input class="form-check-input" type="radio" name="questions[{{ $current_question_index }}][answer]"
                    id="option_{{ $current_question_index }}_4" value="{{ $current_question->option_4 }}" />
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
    <button type="button" disabled class="submit__question" id="submit__question">Submit</button>
@endif
