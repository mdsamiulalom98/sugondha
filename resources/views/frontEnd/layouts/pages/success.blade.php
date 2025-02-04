@extends('frontEnd.layouts.master')
@section('title', 'Exam success')
@section('content')
 <div class="thank-you-container">
        <div class="thank-you-card">
            <div class="icon-container">
                <div class="check-icon">
                    <span>&#10003;</span>
                </div>
                <div class="particles"></div>
            </div>
            <h2 class="mb-2">Congratulations!</h2>
            <p>Thanks, you scored <strong>{{$data->gain_mark}}</strong> points out of <strong>{{$data->total_mark}}</strong>. You get <strong>{{$data->discount}}</strong>% discount!</p>
            <div class="button-groups mt-3">
                <a href="{{route('home')}}" class="btn continue-shopping">Go to home page</a href="{{route('home')}}">
            </div>
        </div>
    </div>
@endsection
