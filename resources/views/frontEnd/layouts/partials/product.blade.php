<div class="product_item_inner">
    @if ($value->old_price)
        <div class="discount">
            <p>- @php $discount=(((($value->old_price)-($value->new_price))*100) / ($value->old_price)) @endphp {{ number_format($discount, 0) }}%</p>
        </div>
    @endif
    <div class="pro_img">
        <a href="{{ route('product', $value->slug) }}">
            <img src="{{ asset($value->image ? $value->image->image : '') }}"
                alt="{{ $value->name }}" />
        </a>
    </div>
    <div class="pro_des">
        <div class="pro_name">
            <a href="{{ route('product', $value->slug) }}">{{ Str::limit($value->name, 80) }}</a>
        </div>
        <div class="pro_price">
            @if ($value->variable_count > 0 && $value->type == 0)
                <p>
                    ৳ {{ $value->variable->new_price }}
                    @if ($value->variable->old_price)
                        <del>৳ {{ $value->variable->old_price }}</del>
                    @endif
                    
                </p>
            @else
                <p>
                    ৳ {{ $value->new_price }}
                    @if ($value->old_price)
                        <del>৳ {{ $value->old_price }}</del>
                    @endif
                    
                </p>
            @endif
        </div>
        <div class="pro_btn">
            @if ($value->variable_count > 0 && $value->type == 0)
            <div class="cart_btn">
               <a href="{{ route('product', $value->slug) }}" data-id="{{ $value->id }}" class="addcartbutton">Buy Now</a>
            </div>
            @else
            <div class="cart_btn">
                <form action="{{ route('cart.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $value->id }}" />
                    <button type="submit">Buy Now</button>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>