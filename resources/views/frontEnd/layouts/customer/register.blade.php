@extends('frontEnd.layouts.master')
@section('title','Customer Register')
@section('content')
<section class="auth-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-5">
                <div class="form-content">
                    <p class="auth-title"> Register </p>
                    <form action="{{route('customer.store')}}" method="POST"  data-parsley-validate="" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="name">Full Name *</label>
                            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Enter your full name " required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- col-end -->
                        <div class="form-group mb-3">
                            <label for="phone"> Mobile Number * </label>
                            <input type="number" id="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" placeholder="Enter your mobile number" required>
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="dob">Date Of Birth </label>
                            <input type="date" id="dob" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" placeholder="Your Birthday">
                            @error('dob')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="profession">Profession </label>
                            <input type="text" id="profession" class="form-control @error('profession') is-invalid @enderror" name="profession" value="{{ old('profession') }}" placeholder="Student / Business / Job / Housewife">
                            @error('profession')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="image">Profile Picture</label>
                            <input type="file" id="image" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}" placeholder="Enter your image picture">
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-4">
                            <label for="password"> Password * </label>
                            <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Choose a password " name="password" value="{{ old('password') }}" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- col-end -->
                        <button class="submit-btn mt-4">Submit</button>
                         <div class="register-now no-account">
                        <p> If have an account. <a href="{{route('customer.login')}}"><i data-feather="edit-3"></i> Login here </a></p>
                       
                    </div>
                        </div>
                     <!-- col-end -->
                     
                    
                     </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('script')
<script src="{{asset('public/frontEnd/')}}/js/parsley.min.js"></script>
<script src="{{asset('public/frontEnd/')}}/js/form-validation.init.js"></script>
<script>
    window.onload = function() {
        $("#page-overlays").show();
    };
</script>
@endpush