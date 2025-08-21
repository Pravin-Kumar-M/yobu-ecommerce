<!DOCTYPE html>
<html lang="en">

<head>
    @include ('Home.home_headSection')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <style>
        /* Card Styling */
        .payment-card {
            border: 1px solid #ddd;
            transition: 0.3s;
            cursor: pointer;
        }

        .payment-card:hover {
            border-color: #0d6efd;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .payment-card.active {
            border: 2px solid #198754;
            background-color: #f8fff8;
        }

        /* Add Method Section */
        .add-method {
            padding: 20px;
            text-align: center;
            border: 2px dashed #bbb;
            border-radius: 8px;
            transition: 0.3s;
        }

        .add-method:hover {
            border-color: #0d6efd;
            background-color: #f1f8ff;
        }

        /* Secure Box */
        .secure-box {
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            border-left: 2px solid #198754;
        }
    </style>
</head>

<body>
    <!-- Page Preloader -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    @include ('Home.home_header')

    <div class="container mt-5 mb-5">
        <div class="card p-3">
            <div class="card-header">
                <h2 class="mb-1">Payment Methods</h2>
                <p class="text-muted">Manage your payment methods securely. All payment information is encrypted and protected.</p>
                <p class="text-success"><i class="fas fa-lock me-1"></i> SSL Secured & PCI Compliant</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Saved Methods -->
                    <div class="col-lg-7">
                        <h5 class="mb-3">Saved Methods <small class="text-muted">(3 methods)</small></h5>

                        <div class="payment-card p-3 mb-3 active rounded d-flex align-items-center justify-content-between">
                            <div>
                                <i class="fab fa-cc-visa card-icon text-primary me-2 fa-lg"></i>
                                <strong>•••• •••• •••• 4242</strong><br>
                                <small class="text-muted">John Doe • Expires 12/25</small>
                            </div>
                            <span class="badge bg-success">Default</span>
                        </div>

                        <div class="payment-card p-3 mb-3 rounded d-flex align-items-center justify-content-between">
                            <div>
                                <i class="fab fa-cc-mastercard card-icon text-danger me-2 fa-lg"></i>
                                <strong>•••• •••• •••• 8888</strong><br>
                                <small class="text-muted">John Doe • Expires 09/26</small>
                            </div>
                        </div>

                        <div class="payment-card p-3 mb-3 rounded d-flex align-items-center justify-content-between">
                            <div>
                                <i class="fab fa-paypal card-icon text-primary me-2 fa-lg"></i>
                                <strong>PayPal</strong><br>
                                <small class="text-muted">john.doe@example.com</small>
                            </div>
                        </div>

                        <div class="add-method">
                            <i class="fas fa-plus-circle fa-2x mb-2 text-secondary"></i>
                            <p class="mb-0">Add New Payment Method</p>
                            <small class="text-muted">Credit card, PayPal, or digital wallet</small>
                        </div>
                    </div>

                    <!-- Quick Options -->
                    <div class="col-lg-5">
                        <h5 class="mb-3">Quick Payment Options</h5>
                        <div class="list-group mb-4">
                            <a href="#" class="list-group-item list-group-item-action">
                                <i class="fab fa-apple-pay me-2"></i> Apple Pay
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <i class="fab fa-google-pay me-2"></i> Google Pay
                            </a>
                            <a href="#" class="list-group-item list-group-item-action">
                                <i class="fab fa-paypal me-2"></i> PayPal
                            </a>
                        </div>

                        <div class="secure-box">
                            <h6><i class="fas fa-shield-alt text-success me-2"></i> Your payments are secure</h6>
                            <ul class="mb-0 p-3">
                                <li>256-bit SSL encryption</li>
                                <li>No card info stored on our servers</li>
                                <li>PCI DSS Level 1 compliant</li>
                                <li>Fraud monitoring & protection</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>

    @include ('Home.home_footer')

</body>

</html>