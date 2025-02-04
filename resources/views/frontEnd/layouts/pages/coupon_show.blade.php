@extends('frontEnd.layouts.master')
@section('title', 'Coupon')
@section('content')
    <section class="createpage-section bg-light">
        <div class="container">
            <div class="row">
                @foreach($coupons as $coupon)
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-header bg-primary ">
                            <p class="text-white">Last Date : {{$coupon->expiry_date}}</p>
                        </div>
                        <div class="card-body">
                            <div class="text-left">
                                <p>{{$coupon->name}}</p>
                                <h5>Use Code : {{$coupon->coupon_code}}</h5>
                                <h6 class="my-2">Buy Amount : {{$coupon->buy_amount}}</h6>
                                <h6>Discount : {{$coupon->amount}} {{$coupon->amount == 1 ? '%' : 'Tk'}}</h6>
                                
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
