@php $total = 0 @endphp
@if(session('cart'))
    @foreach((array) session('cart') as $id => $details)
    @php $total += $details['price'] * $details['quantity'] @endphp
    <div class="card item-cart mt-2">
    @if(!request()->routeIs('clientCheckout'))
        <button class="btn btn-danger btn-sm" data-id="{{ $id }}" onclick="deleteItem({{ $id }}, $(this), 'mobile')" style="position:absolute;z-index:9;right:0;"><i class="bi bi-trash"></i></button>
    @endif
        <div class="card-body">
            <h6 class="font-bold">{!! str_replace('-', ' ', ucwords($details['title'])) !!}</h6>
            <div class="row">
                <div class="col-6">
                    <label for="price">Price</label>
                    <p id="price" class="font-bold">${{ $details['price']}}</p>
                </div>
                <div class="col-6">
                    <label for="subtotal">Sub Total</label>
                    <p class="font-bold">$<span class="product-subtotal">{{$details['price'] * $details['quantity']}}</span></p>
                </div>
                <div class="col-12">
                    <label for="quantity">Quantity : {{request()->routeIs('clientCheckout') ? 'x'.$details['quantity'] : ''}}</label>
                    @if(!request()->routeIs('clientCheckout'))
                        <div id="input_div" class="mt-2">
                            <input type="button" value="-" onclick="minus($(this))" class="btn btn-outline-primary">
                            <input type="text" value="{{ $details['quantity'] }}" id="count" data-id="{{ $id }}" data-price="{{$details['price']}}" class="count btn btn-outline-primary font-secondary" disabled>
                            <input type="button" value="+" onclick="plus($(this))" data-stock="{{ $details['product_stock'] }}" data-quantity="{{ $details['quantity'] }}" class="btn btn-outline-primary">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
@endif

<div class="card mt-3 mb-4">
    <div class="card-body">
        <h5 class="font-secondary"><strong>Total : $<span class="cart-total">{{ $total}}</span></strong></h5>
        @if(!request()->routeIs('clientCheckout'))
            <div class="d-flex justify-content-between mt-3 font-secondary">
                <a href="{{ url('/') }}" class="btn btn-sm btn-outline-secondary">
                    <span class="d-flex align-items-center gap-1">
                        <i class="bi bi-arrow-left"></i> Continue Shopping
                    </span>
                </a>
                <a href="/checkout" class="btn btn-sm btn-primary">CheckOut</a>
            </div>
        @endif
    </div>
</div>