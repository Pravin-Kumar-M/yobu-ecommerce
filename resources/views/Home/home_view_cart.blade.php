<!DOCTYPE html>
<html lang="en">

<head>
    @include ('Home.home_headSection')
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    @include ('Home.home_header')


    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shopping Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="{{url('/dashboard')}}">Home</a>
                            <a href="{{url('shop')}}">Shop</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <form action="{{ url('update_cart') }}" method="POST">
                        @csrf
                        <div class="shopping__cart__table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($carts as $cart)
                                    <tr>
                                        <td class="product__cart__item">
                                            <div class="product__cart__item__pic">
                                                @if($cart->custom_image)
                                                {{-- Show custom image if available --}}
                                                <img src="{{ asset($cart->custom_image) }}" alt="Custom Image" style="width: 100px; height: 100px;">
                                                @elseif($cart->product)
                                                {{-- Fallback to product image --}}
                                                <img src="{{ asset($cart->product->image) }}" alt="Product Image" style="width: 100px; height: 100px;">
                                                @else
                                                <p class="text-danger">Product not found</p>
                                                @endif
                                            </div>
                                            <div class="product__cart__item__text">
                                                <h6>{{ $cart->product->name ?? 'N/A' }}</h6>
                                                <h5 class="product-price">${{ number_format($cart->product->store_price ?? 0, 2) }}</h5>
                                            </div>
                                        </td>

                                        <td class="quantity__item">
                                            <div class="quantity">
                                                <div class="pro-qty-2">
                                                    <input type="number" name="quantities[{{ $cart->id }}]"
                                                        min="1"
                                                        max="{{ $cart->product->quantity ?? 1 }}"
                                                        value="{{ $cart->quantity }}">
                                                </div>
                                            </div>
                                        </td>

                                        <td class="cart__price">
                                            ${{ number_format(($cart->product->store_price ?? 0) * $cart->quantity, 2) }}
                                        </td>

                                        <td class="cart__close">
                                            <a href="{{ url('delete_cart', $cart->id) }}">
                                                <i class="fa fa-close"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            <p class="text-muted fs-5">No items in your cart</p>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>

                        <!-- continue and update cart -->
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="continue__btn">
                                    <a href="{{url('shop')}}">Continue Shopping</a>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="continue__btn update__btn">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-spinner"></i> Update cart</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Discount codes</h6>
                        <form action="#">
                            <input type="text" placeholder="Coupon code">
                            <button type="submit">Apply</button>
                        </form>
                    </div>
                    @php
                    $subtotal = 0;
                    @endphp
                    <div class="cart__total">
                        <h6>Cart total</h6>
                        @foreach($carts as $cart)
                        @php
                        $lineTotal = $cart->product->store_price * $cart->quantity;
                        $subtotal += $lineTotal;
                        @endphp
                        @endforeach
                        <ul>

                            <li>Subtotal <span>${{ number_format($subtotal, 2) }}</span></li>
                            <li>Total <span>${{ number_format($subtotal, 2) }}</span></li> <!-- If no shipping or tax, total is same as subtotal -->
                        </ul>
                        <a href="{{url('checkout')}}" class="primary-btn">Proceed to checkout</a>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

    @include ('Home.home_footer')




</body>

</html>