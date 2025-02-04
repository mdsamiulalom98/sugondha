@extends('frontEnd.layouts.master') @section('title', 'Customer Checkout') @push('css')
<link rel="stylesheet" href="{{ asset('public/frontEnd/css/select2.min.css') }}" />
@endpush @section('content')
<section class="chheckout-section">
    @php
        $subtotal = Cart::instance('shopping')->subtotal();
        $subtotal = str_replace(',', '', $subtotal);
        $subtotal = str_replace('.00', '', $subtotal);
        $shipping = Session::get('shipping') ? Session::get('shipping') : 0;
        $coupon = Session::get('coupon_amount') ? Session::get('coupon_amount') : 0;

        $discount = Session::get('discount') ? Session::get('discount') : 0;
        $results = Session::get('claim_discounts') ? Session::get('claim_discounts') : 0;

        $cart = Cart::instance('shopping')->content();

    @endphp
    <div class="container">
        <div class="row">
            <div class="col-sm-6 cus-order-2">
                <div class="checkout-shipping">
                    <form action="{{ route('customer.ordersave') }}" method="POST" data-parsley-validate="" class="order__place">
                        @csrf
                        <input type="hidden" name="order_source" id="order_source" style="display:none" value="1">
                        <div class="card">
                            <div class="card-header">
                                <h6 class = "check-position">Fill in the details and click on the "Confirm Order" button
                                    </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group mb-3">
                                            <label for="name"><i class="fa-solid fa-user"></i> Full Name *</label>
                                            <input type="text" id="name"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name') }}" placeholder="" required />
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->
                                    <div class="col-sm-12">
                                        <div class="form-group mb-3">
                                            <label for="phone"><i class="fa-solid fa-phone"></i> Mobile Number *</label>
                                            <input type="text" minlength="11" id="phone" maxlength="11"
                                                class="form-control @error('phone') is-invalid @enderror" name="phone"
                                                value="{{ old('phone') }}" placeholder="" required />
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->
                                    <div class="col-sm-12">
                                        <div class="form-group mb-3">
                                            <label for="address"><i class="fa-solid fa-map"></i> Full Address  *</label>
                                            <input type="address" id="address"
                                                class="form-control @error('address') is-invalid @enderror"
                                                name="address" placeholder="" value="{{ old('address') }}" required />
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group mb-3">
                                            <label for="area"><i class="fa-solid fa-truck"></i> Delivary Area  *</label>
                                            <select type="area" id="area"
                                                class="form-control @error('area') is-invalid @enderror" name="area"
                                                required>
                                                <option value="">Select Delivery Area</option>
                                                @foreach ($shippingcharge as $key => $value)
                                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('area')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- col-end -->
                                    <div class="col-sm-12">
                                        <div class="radio_payment">
                                            <label id="payment_method">Payment Method</label>
                                        </div>
                                        <div class="payment-methods">
                                           
                                            <div class="form-check p_cash payment_method" data-id="cod">
                                                <input class="form-check-input" type="radio" name="payment_method"
                                                    id="inlineRadio1" value="Cash On Delivery" checked required />
                                                <label class="form-check-label" for="inlineRadio1">
                                                    Cash On Delivery
                                                </label>
                                            </div>
                                            @if ($bkash_gateway)
                                                <div class="form-check p_bkash payment_method" data-id="bkash">
                                                    <input class="form-check-input" type="radio"
                                                        name="payment_method" id="inlineRadio2" value="bkash"
                                                        required />
                                                    <label class="form-check-label" for="inlineRadio2">
                                                        Bkash
                                                    </label>
                                                </div>
                                            @endif
                                            @if ($shurjopay_gateway)
                                                <div class="form-check p_shurjo payment_method" data-id="nagad">
                                                    <input class="form-check-input" type="radio" name="payment_method"
                                                        id="inlineRadio3" value="shurjopay" required />
                                                    <label class="form-check-label" for="inlineRadio3">
                                                        Nagad
                                                    </label>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                   <div class="col-sm-12">
                                        <div class="form-group">
                                            <button class="order_place" id="orderButton" type="submit">Confirm Order</button>
                                          <div id="countdown"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- card end -->

                    </form>
                </div>
            </div>
            <!-- col end -->
            <div class="col-sm-6 cust-order-1">
                <div class="cart_details table-responsive-sm">
                    <div class="card">
                        <div class="card-header">
                            <h5>Order Information</h5>
                        </div>
                        <div class="card-body cartlist">
                            <table class="cart_table table table-bordered table-striped text-center mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 20%;">Delete</th>
                                        <th style="width: 40%;">Product</th>
                                        <th style="width: 20%;">Amount</th>
                                        <th style="width: 20%;">Price</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach (Cart::instance('shopping')->content() as $value)
                                        <tr>
                                            <td>
                                                <a class="cart_remove" data-id="{{ $value->rowId }}"><i
                                                        class="fas fa-trash text-danger"></i></a>
                                            </td>
                                            <td class="text-left">
                                                <a href="{{ route('product', $value->options->slug) }}"> <img
                                                        src="{{ asset($value->options->image) }}" />
                                                    {{ Str::limit($value->name, 20) }}</a>
                                                @if ($value->options->product_size)
                                                    <p>Size: {{ $value->options->product_size }}</p>
                                                @endif
                                                @if ($value->options->product_color)
                                                    <p>Color: {{ $value->options->product_color }}</p>
                                                @endif
                                            </td>
                                            <td class="cart_qty">
                                                <div class="qty-cart vcart-qty">
                                                    <div class="quantity">
                                                        <button class="minus cart_decrement"
                                                            data-id="{{ $value->rowId }}">-</button>
                                                        <input type="text" value="{{ $value->qty }}" readonly />
                                                        <button class="plus cart_increment"
                                                            data-id="{{ $value->rowId }}">+</button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span>৳ </span><strong>{{ $value->price }}</strong>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="3" class="text-end px-4">Total</th>
                                        <td class="px-4">
                                            <span id="net_total"><span>৳
                                                </span><strong>{{ $subtotal }}</strong></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="text-end px-4">Delivery Charge</th>
                                        <td class="px-4">
                                            <span id="cart_shipping_cost"><span>৳
                                            </span><strong>{{ $shipping }}</strong></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="text-end px-4">Discount</th>
                                        <td class="px-4">
                                            <span id="cart_shipping_cost"><span>৳
        </span><strong>{{ $discount + $coupon + 
            (($subtotal + $shipping - ($discount + $coupon)) * $results / 100
        )}}</strong></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="text-end px-4">TOTAL</th>
                                        <td class="px-4">
                                            <span id="grand_total"><span>৳
                                               <span>
                                            <strong>
                                                 {{
                                                    intval(
                                                        ($subtotal + $shipping - ($discount + $coupon)) - 
                                                        (($subtotal + $shipping - ($discount + $coupon)) * $results / 100)
                                                    )
                                                }}
                                            </strong>
                                        </span>

                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                            <form
                                action="@if (Session::get('coupon_used')) {{ route('customer.coupon_remove') }} @else {{ route('customer.coupon') }} @endif"
                                class="checkout-coupon-form" method="POST">
                                @csrf
                                <div class="coupon">
                                    <input type="text" name="coupon_code"
                                        placeholder=" @if (Session::get('coupon_used')) {{ Session::get('coupon_used') }} @else Apply Coupon @endif"
                                        class="border-0 shadow-none form-control" />
                                    <input type="submit"
                                        value="@if (Session::get('coupon_used')) remove @else apply @endif "
                                        class="border-0 shadow-none btn btn-theme" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <button type="button" class="cliam__exam" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@Claim Exam Discount">Claim Exam Discount</button>
            </div>
            <!-- col end -->
            
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Get Discount Based on Exam Result!</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
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
                </div>
            
        </div>
    </div>
</section>
@endsection
@push('script')
<script src="{{ asset('public/frontEnd/') }}/js/parsley.min.js"></script>
<script src="{{ asset('public/frontEnd/') }}/js/form-validation.init.js"></script>
<script src="{{ asset('public/frontEnd/') }}/js/select2.min.js"></script>

@if(session('cool_down'))
<script>
    let countdownTime = new Date("{{ session('cool_down') }}").getTime();
    let interval = setInterval(function () {
        let now = new Date().getTime();
        let distance = countdownTime - now;

        // Calculate time remaining
        let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display countdown
        document.getElementById("orderButton").innerHTML = 
            "Please Wait: " + minutes + "m " + seconds + "s";

        // Disable the button during the countdown
        let orderButton = document.getElementById("orderButton");
        orderButton.disabled = true;

        // When the countdown expires
        if (distance < 0) {
            clearInterval(interval);
            document.getElementById("orderButton").innerHTML = "Order Now button is ready!";
            orderButton.innerHTML = "Confirm Order";
            orderButton.disabled = false;
        }
    }, 1000);
</script>
@endif

<script>
    $(document).ready(function() {
        $(".select2").select2();
    });
</script>

<script>
    $("#area").on("change", function() {
        var id = $(this).val();
        $.ajax({
            type: "GET",
            data: {
                id: id
            },
            url: "{{ route('shipping.charge') }}",
            dataType: "html",
            success: function(response) {
                $(".cartlist").html(response);
            },
        });
    });
</script>

<script>
    $("#area").on("change", function () {
        
        var id = $(this).val(); 
        var name = $("#name").val(); 
        var phone = $("#phone").val(); 
        var address = $("#address").val();
        var area = $("#area option:selected").val(); 
        if (id && name && phone && address && area) {
            $.ajax({
                type: "GET",
                data: {id,name,phone,address,area},
                url: "{{route('order.store.draft')}}",
                success: function (data) {
                    if (data) {
                        return data;
                    }
                },
            });
        }
    });
</script>


<script type="text/javascript">
    dataLayer.push({
        ecommerce: null
    }); // Clear the previous ecommerce object.
    dataLayer.push({
        event: "view_cart",
        ecommerce: {
            items: [
                @foreach (Cart::instance('shopping')->content() as $cartInfo)
                    {
                        item_name: "{{ $cartInfo->name }}",
                        item_id: "{{ $cartInfo->id }}",
                        price: "{{ $cartInfo->price }}",
                        item_brand: "{{ $cartInfo->options->brand }}",
                        item_category: "{{ $cartInfo->options->category }}",
                        item_size: "{{ $cartInfo->options->size }}",
                        item_color: "{{ $cartInfo->options->color }}",
                        currency: "BDT",
                        quantity: {{ $cartInfo->qty ?? 0 }}
                    },
                @endforeach
            ]
        }
    });
</script>
<script type="text/javascript">
    // Clear the previous ecommerce object.
    dataLayer.push({
        ecommerce: null
    });

    // Push the begin_checkout event to dataLayer.
    dataLayer.push({
        event: "begin_checkout",
        ecommerce: {
            items: [
                @foreach (Cart::instance('shopping')->content() as $cartInfo)
                    {
                        item_name: "{{ $cartInfo->name }}",
                        item_id: "{{ $cartInfo->id }}",
                        price: "{{ $cartInfo->price }}",
                        item_brand: "{{ $cartInfo->options->brands }}",
                        item_category: "{{ $cartInfo->options->category }}",
                        item_size: "{{ $cartInfo->options->size }}",
                        item_color: "{{ $cartInfo->options->color }}",
                        currency: "BDT",
                        quantity: {{ $cartInfo->qty ?? 0 }}
                    },
                @endforeach
            ]
        }
    });
</script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endpush
