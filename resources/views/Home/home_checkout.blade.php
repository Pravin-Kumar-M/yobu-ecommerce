<!DOCTYPE html>
<html lang="en">

<head>
    @include ('Home.home_headSection')

    <style>
        .checkout__input>input {
            color: black;
        }
    </style>
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
                        <h4>Check Out</h4>
                        <div class="breadcrumb__links">
                            <a href="{{url('/')}}">Home</a>
                            <a href="{{url('shop')}}">Shop</a>
                            <span>Check Out</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form action="{{ url('confirm_order') }}" method="POST" id="paymentForm">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <h6 class="coupon__code"><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click
                                    here</a> to enter your code</h6>
                            <h6 class="checkout__title">Billing Details</h6>
                            <input type="hidden" name="customImage" id="customImageInput">

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>First Name<span>*</span></p>
                                        <input type="text" name="first_name" value="{{ Auth::check() ? Auth::user()->name : '' }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" name="last_name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input type="text" name="country" required>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" placeholder="Street Address" class="checkout__input__add" name="address" required>

                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text" name="city" required>
                            </div>
                            <div class="checkout__input">
                                <p>Country/State<span>*</span></p>
                                <input type="text" name="state" required>
                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text" name="zip_code" required>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" name="phone" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text" name="email" value="{{ Auth::check() ? Auth::user()->email : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="acc">
                                    Create an account?
                                    <input type="checkbox" id="acc">
                                    <span class="checkmark"></span>
                                </label>
                                <p>Create an account by entering the information below. If you are a returning customer
                                    please login at the top of the page</p>
                            </div>
                            <div class="checkout__input">
                                <p>Account Password<span>*</span></p>
                                <input type="text">
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="diff-acc">
                                    Note about your order, e.g, special noe for delivery
                                    <input type="checkbox" id="diff-acc">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input">
                                <p>Order notes<span>*</span></p>
                                <input type="text"
                                    placeholder="Notes about your order, e.g. special notes for delivery.">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Your order</h4>
                                <div class="checkout__order__products">
                                    <b>Product</b> <span><b>Total</b></span>
                                </div>

                                @php $subtotal = 0; @endphp

                                <ul class="checkout__total__products">
                                    @foreach ($carts as $cart)
                                    @php
                                    $lineTotal = $cart->product->store_price * $cart->quantity;
                                    $subtotal += $lineTotal;
                                    @endphp
                                    <li class="d-flex justify-content-between align-items-center">
                                        <div>
                                            {{-- Show custom image if exists, otherwise default product image --}}
                                            @if($cart->custom_image)
                                            <img src="{{ asset($cart->custom_image) }}" alt="custom image" style="width: 40px; height: 40px; object-fit: cover; margin-right: 8px;">
                                            @else
                                            <img src="{{ asset($cart->product->image) }}" alt="product image" style="width: 40px; height: 40px; object-fit: cover; margin-right: 8px;">
                                            @endif

                                            {{ $cart->product->name }} × {{ $cart->quantity }}
                                        </div>
                                        <span>$ {{ number_format($lineTotal, 2) }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                                @if($cart->custom_image)
                                <span class="badge bg-warning text-dark ms-2">Customized</span>
                                @endif


                                <ul class="checkout__total__all">
                                    <li>Subtotal <span>$ {{ number_format($subtotal, 2) }}</span></li>
                                    <li>Total <span>$ {{ number_format($subtotal, 2) }}</span></li>
                                </ul>

                                <!-- Payment Options -->
                                <div class="checkout__input__checkbox">
                                    <label for="visa">
                                        Stripe Payment
                                        <input type="radio" name="payment_method" value="visa" id="visa" required>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Paypal Payment
                                        <input type="radio" name="payment_method" value="paypal" id="paypal">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                                <div class="checkout__input__checkbox">
                                    <label for="cash_on_delivery" style="color: #aaa; cursor: not-allowed;">
                                        Cash on Delivery
                                        <input type="radio" name="payment_method" value="cash_on_delivery" id="cash_on_delivery" disabled>
                                        <span class="checkmark"></span>
                                        <small style="display: inline; color: #dc3545;">(we are working on it)</small>
                                    </label>
                                </div>

                                <button type="submit" class="site-btn">PLACE ORDER</button>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->


    @include ('Home.home_footer')

    <script>
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            const method = document.querySelector('input[name="payment_method"]:checked')?.value;

            if (!method) {
                e.preventDefault();
                alert('Please select a payment method!');
                return;
            }

            // Change form action based on selected method
            if (method === 'visa') {
                this.action = "{{ url('stripe_payment/stripe') }}";
            } else if (method === 'paypal') {
                this.action = "{{ url('paypal_payment/paypal') }}"; // This should match your route
            } else {
                this.action = "{{ url('confirm_order') }}";
            }
        });
    </script>





</body>


</html>