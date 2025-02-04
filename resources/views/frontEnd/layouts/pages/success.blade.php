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
            <p>Thanks, you scored <strong>{{$results}}</strong> points out of <strong>{{$totalPossiblePoints}}</strong>. You get <strong>{{$results}}</strong>% discount!</p>
            <div class="button-groups mt-3">
                <a href="{{route('home')}}" class="btn continue-shopping">Go to home page</a href="{{route('home')}}">
            </div>
        </div>
    </div>
@endsection
