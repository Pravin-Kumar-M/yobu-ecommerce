<!DOCTYPE html>
<html lang="en">

<head>
    @include ('Home.home_headSection')
    <!-- Font Awesome -->
    <style>
        .text-gradient {
            background: linear-gradient(45deg, #ff9a9e, #fad0c4);
            -webkit-text-fill-color: transparent;
        }

        .coupon-box {
            background: linear-gradient(135deg, #fff8e1, #fff);
            border-left: 5px solid #ffc107;
            transition: 0.3s;
        }

        .coupon-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(255, 193, 7, 0.2);
        }

        .giftcard-box {
            background: linear-gradient(135deg, #e9f7ef, #fff);
            border-left: 5px solid #28a745;
            transition: 0.3s;
        }

        .giftcard-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(40, 167, 69, 0.2);
        }

        .balance-box {
            background: linear-gradient(135deg, #e0f7fa, #fff);
        }

        .list-group-item {
            transition: background-color 0.2s ease-in-out;
        }

        .list-group-item:hover {
            background-color: #f8f9fa;
        }

        .text-purple {
            color: #6f42c1;
        }
    </style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    @include ('Home.home_header')

    <div class="container my-5">
        <div class="card border-0 shadow-lg rounded-4 p-5 bg-white">
            <div class="d-flex align-items-center mb-4">
                <div>
                    <h2 class="fw-bold mb-0">Coupons & Gift Cards</h2>
                    <p class="text-muted small mb-0">Redeem discounts and manage your store credit</p>
                </div>
            </div>

            <div class="row g-4">
                <!-- Redeem Coupon -->
                <div class="col-lg-6">
                    <div class="coupon-box p-4 rounded-4 shadow-sm h-100">
                        <h5 class="fw-bold mb-2"><i class="fas fa-ticket-alt text-warning me-2"></i> Redeem Coupon</h5>
                        <p class="text-muted small">Enter your coupon code to get instant savings.</p>
                        <div class="input-group">
                            <input type="text" class="form-control rounded-start-pill" placeholder="Enter coupon code">
                            <button class="btn btn-warning rounded-end-pill fw-bold px-4">Apply</button>
                        </div>
                        <small class="text-success mt-2 d-block"><i class="fas fa-check-circle me-1"></i> Coupon applied at checkout</small>
                    </div>
                </div>

                <!-- Add Gift Card -->
                <div class="col-lg-6">
                    <div class="giftcard-box p-4 rounded-4 shadow-sm h-100">
                        <h5 class="fw-bold mb-2"><i class="fas fa-credit-card text-success me-2"></i> Add Gift Card</h5>
                        <p class="text-muted small">Redeem a gift card to add balance to your account.</p>
                        <div class="input-group">
                            <input type="text" class="form-control rounded-start-pill" placeholder="Gift card number">
                            <button class="btn btn-success rounded-end-pill fw-bold px-4">Redeem</button>
                        </div>
                        <small class="text-info mt-2 d-block"><i class="fas fa-info-circle me-1"></i> Balance stored in your account</small>
                    </div>
                </div>
            </div>

            <!-- Active Coupons -->
            <div class="mt-5">
                <h5 class="fw-bold mb-3"><i class="fas fa-tags text-primary me-2"></i> Active Coupons</h5>
                <div class="list-group shadow-sm rounded-4 overflow-hidden">
                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <span><strong class="text-dark">WELCOME10</strong> <small class="text-muted">10% off first order</small></span>
                        <span class="badge bg-success">Active</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <span><strong class="text-dark">FREESHIP</strong> <small class="text-muted">Free shipping over $50</small></span>
                        <span class="badge bg-success">Active</span>
                    </a>
                </div>
            </div>

            <!-- Gift Card Balance -->
            <div class="mt-5">
                <h5 class="fw-bold mb-3"><i class="fas fa-wallet text-purple me-2"></i> Gift Card Balance</h5>
                <div class="balance-box p-4 rounded-4 shadow-sm text-center">
                    <h3 class="fw-bold text-success mb-1">$75.00</h3>
                    <p class="text-muted mb-0">Available Store Credit</p>
                </div>
            </div>
        </div>
    </div>




    @include ('Home.home_footer')


</body>

</html>