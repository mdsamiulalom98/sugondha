@extends('frontEnd.layouts.master') 
@section('title', $generalsetting->meta_title) 
@push('seo')
<meta name="app-url" content="" />
<meta name="robots" content="index, follow" />
<meta name="description" content="{{$generalsetting->meta_description}}" />
<meta name="keywords" content="{{$generalsetting->meta_keyword}}" />
<!-- Open Graph data -->
<meta property="og:title" content="{{$generalsetting->meta_title}}" />
<meta property="og:type" content="website" />
<meta property="og:url" content="" />
<meta property="og:image" content="{{ asset($generalsetting->white_logo) }}" />
<meta property="og:description" content="{{$generalsetting->meta_description}}" />
@endpush 
@push('css')
<link rel="stylesheet" href="{{ asset('public/frontEnd/css/owl.carousel.min.css') }}" />
<link rel="stylesheet" href="{{ asset('public/frontEnd/css/owl.theme.default.min.css') }}" />
@endpush 
@section('content')
<section class="slider-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-slider-container">
                    <div class="main_slider owl-carousel">
                        @foreach ($sliders as $key => $value)
                            <div class="slider-item">
                               <a href="{{$value->link}}">
                                    <img src="{{ asset($value->image) }}" alt="" />
                               </a>
                            </div>
                            <!-- slider item -->
                        @endforeach
                    </div>
                </div>
            </div>
            
            <div class="col-sm-12">
                <div class="headline-wrapper">
                    @foreach($newsticker as $key=>$value)
                    <marquee direction="left">
                    {{$value->news}}
                    </marquee>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- slider end -->
<div class="home-category">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="category-title">
                    <h3>Top Categories</h3>
                </div>
                <div class="category-slider owl-carousel">
                    @foreach($categories as $key=>$value)
                    <div class="cat-item">
                        <div class="cat-img">
                            <a href="{{route('category',$value->slug)}}">
                                <img src="{{asset($value->image)}}" alt="">
                            </a>
                        </div>
                        <div class="cat-name">
                            <a href="{{route('category',$value->slug)}}">
                                {{$value->name}}
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<section class="homeproduct">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="section-title">
                <div class="best__deals_data">
                   <div class=""> <h3> <a href="{{route('bestdeals')}}">Deals of the Day</a></h3></div>
                   <div class="offer_ends"><div class=""><p>Offer Ends In :</p></div><div class="offer_timer" id="simple_timer"></div></div>
                </div>
                    <a href="{{route('bestdeals')}}" class="view__all__btn">View All</a>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="product_slider owl-carousel">
                    @foreach ($hotdeal_top as $key => $value)
                        <div class="product_item wist_item">
                            @include('frontEnd.layouts.partials.product')
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<section class="home-exam-section">
    <div class="container">
        <div class="row">
            @foreach($exam_banner as $ebaner)
            <div class="col-sm-4">
                <div class="exam-banner">
                    <a href="">
                        <img src="{{asset($ebaner->image)}}">
                    </a>
                </div>
            </div>
            @endforeach
            <div class="col-sm-4">
                <div class="home-exam">
                    <h4>Give exam and get discount</h4>
                    <form action="{{route('mcq.exam.start')}}" method="POST" id="examForm">
                      @csrf
                        <div class="col-sm-12">
                            <div class="form-group mb-3">
                                <label for="subject_id" class="form-label label__sec">Select Subject</label>
                                <select class="form-control border select2 @error('subject_id') is-invalid @enderror"
                                    name="subject_id" id="subject_id" required>
                                    <option value="">Select..</option>
                                    @foreach ($subjects as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group mb-3">
                                <label for="topic_id" class="form-label label__sec">Select Topic</label>
                                <select class="form-control border select2 @error('topic_id') is-invalid @enderror"
                                    name="topic_id" id="topic_id" required>
                                    <option value="">Select..</option>
                                </select>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="cliam__exam">Start</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="exam-result-wrapper ">
                    <div class="exam-result-slider owl-carousel">
                        @foreach($exam_results as $key => $value)
                        @php
                            $result = \App\Models\ExamResult::where('customer_id', $value->customer_id)->orderBy('gain_mark', 'DESC')->first();
                            if (!function_exists('custom_ordinal')) {
                                function custom_ordinal($number) {
                                    $suffixes = ['th', 'st', 'nd', 'rd'];
                                    $value = $number % 100;
                            
                                    if ($value >= 11 && $value <= 13) {
                                        return $number . $suffixes[0];
                                    }
                            
                                    switch ($number % 10) {
                                        case 1:
                                            return $number . $suffixes[1];
                                        case 2:
                                            return $number . $suffixes[2];
                                        case 3:
                                            return $number . $suffixes[3];
                                        default:
                                            return $number . $suffixes[0];
                                    }
                                }
                            }
                        @endphp

                        <div class="exam-result-item">
                            <div class="result-position">
                                <span>{{ custom_ordinal($key + 1) }}</span>
                            </div>
                    		<div class="result-image">
                    			<img src="{{ asset($value->customer->image ?? '') }}">
                    		</div>
                    		<div class="result-info">
                    			<div class="name">
                    				<h4>{{ $value->customer->name ?? '' }}</h4>                				
                    			</div>
                    			<div class="results">
                    				<div class="left">
                    					<p>
                    						<span>{{ $result->gain_mark }}</span>/<span>{{ $result->total_mark }}</span> numbers
                    					</p>
                    				</div>
                    				<div class="right">
                    					<p>
                    						{{ $result->discount }} % discount
                    					</p>
                    				</div>
                    			</div>
                    		</div>
                    		
                    	</div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@foreach ($homecategory as $homecat)
    <section class="homeproduct">
        <div class="container">
            <div class="row">
                @php
                    $subcategores = App\Models\Subcategory::where(['status' => 1, 'category_id' => $homecat->id, 'front_view'=>1])
                        ->orderBy('id', 'DESC')
                        ->select('id', 'name', 'slug','category_id','front_view')
                        ->limit(2)
                        ->get();
                @endphp
                <div class="col-sm-12">
                    <div class="section-title">
                        <h3><a href="{{route('category',$homecat->slug)}}">{{$homecat->name}} </a></h3>
                        <div class="view_all_section">
                            <div class="subcategory__menu">
                                @foreach($subcategores as $key=>$value)
                                    <li class="sub__menu"><a href="{{route('subcategory',$value->slug)}}">{{$value->name}}</a></li>
                                @endforeach
                            </div>
                           <div class="btn__view__all"> <a class="view__all__btn" href="{{route('category',$homecat->slug)}}" class="view_all">View All</a></div>
                        </div>
                    </div>
                </div>
                @php
                    $products = App\Models\Product::where(['status' => 1, 'category_id' => $homecat->id])
                        ->orderBy('id', 'DESC')
                        ->select('id', 'name', 'slug', 'new_price', 'old_price', 'type','category_id')
                        ->withCount('variable')
                        ->limit(12)
                        ->get();
                @endphp
                <div class="col-sm-12">
                    <div class="product_slider owl-carousel">
                        @foreach ($products as $key => $value)
                            <div class="product_item wist_item">
                               @include('frontEnd.layouts.partials.product')
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endforeach

   <div class="home-category mt-4">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="category-title">
                        <h3>Brands</h3>
                    </div>
                    <div class="category-slider owl-carousel">
                        @foreach($brands as $key=>$value)
                        <div class="brand-item">
                            <a href="{{route('brand',$value->slug)}}">
                                <img src="{{asset($value->image)}}" alt="">
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="footer-gap"></div>
   
@endsection 
@push('script')
<script src="{{ asset('public/frontEnd/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('public/frontEnd/js/jquery.syotimer.min.js') }}"></script>

<script>
    $(document).ready(function() {
        
        // main slider 
        $(".main_slider").owlCarousel({
            items: 1,
            loop: true,
            dots: false,
            autoplay: true,
            nav: true,
            autoplayHoverPause: false,
            margin: 0,
            mouseDrag: true,
            smartSpeed: 8000,
            autoplayTimeout: 3000,
            animateOut: "fadeOutDown",
            animateIn: "slideInDown",
            navText: ["<i class='fa-solid fa-angle-left'></i>",
                "<i class='fa-solid fa-angle-right'></i>"
            ],
        });

         $(".category-slider").owlCarousel({
            margin: 15,
            loop: true,
            dots: false,
            nav: false,
            autoplay: true,
            autoplayTimeout: 6000,
            autoplayHoverPause: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 3,
                },
                600: {
                    items: 3,
                },
                1000: {
                    items: 7,
                },
            },
        });

        $(".product_slider").owlCarousel({
            margin: 15,
            items: 5,
            loop: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 6000,
            autoplayHoverPause: true,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 2,
                    nav: false,
                },
                600: {
                    items: 5,
                    nav: false,
                },
                1000: {
                    items: 5,
                    nav: false,
                },
            },
        });
        $(".exam-result-slider").owlCarousel({
            margin: 15,
            items: 1,
            loop: true,
            dots: false,
            autoplay: true,
            autoplayTimeout: 6000,
            autoplayHoverPause: true,
        });
    });
</script>
<script>
    $("#simple_timer").syotimer({
        date: new Date(2015, 0, 1),
        layout: "hms",
        doubleNumbers: false,
        effectType: "opacity",

        periodUnit: "d",
        periodic: true,
        periodInterval: 1,
    });
</script>
@endpush
