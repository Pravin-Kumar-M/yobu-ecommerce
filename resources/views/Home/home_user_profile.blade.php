<!DOCTYPE html>
<html lang="en">

<head>
    @include ('Home.home_headSection')
    <style>
        body {
            background-color: #f8f9fa;
        }

        .profile-card {
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .profile-card img {
            border-radius: 50%;
            border: 4px solid #fff;
        }

        .order-history th {
            background-color: #0d6efd;
            color: white;
        }
    </style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    @include ('Home.home_header')


    <div class="container py-5">
        <div class="row">
            <!-- Profile Sidebar -->
            <div class="col-md-4">
                <div class="card profile-card text-center p-4">
                    <!-- <img src="https://via.placeholder.com/150" alt="Profile Picture" class="mx-auto mb-3" width="150"> -->
                    <h4 class="mb-0">{{$user->name}}</h4>
                    <small class="text-muted">{{$user->email}}</small>
                    <hr>
                    <p><strong>Address:</strong> 123 Main St, New York</p>
                    <p><strong>Phone:</strong> +1 234 567 890</p>
                    <a href="#" class="btn btn-primary btn-sm">Edit Profile</a>
                </div>
            </div>

            <!-- Profile Content -->
            <div class="col-md-8">
                <div class="card p-4 mb-4 profile-card">
                    <h5>Account Information</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quis lorem ut libero malesuada feugiat.</p>
                </div>

                <div class="card p-4 profile-card">
                    <h5>Order History</h5>
                    <table class="table table-striped order-history mt-3">
                        <thead>
                            <tr>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td>
                                    @if ($order->custom_image)
                                    <img src="{{ asset($order->custom_image) }}" alt="custom_image" class="img-fluid" width="80">
                                    @elseif ($order->product && $order->product->image)
                                    <img src="{{ asset($order->product->image) }}" alt="product_image" class="img-fluid" width="80">
                                    @endif
                                </td>
                                <td>{{ $order->product->name }}</td>
                                <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                <td>
                                    @php
                                    $statusClass = match($order->order_status) {
                                    'pending' => 'bg-secondary',
                                    'On the way' => 'bg-warning',
                                    'Delivered' => 'bg-success',
                                    'cancelled' => 'bg-danger',
                                    default => 'bg-primary',
                                    };
                                    @endphp
                                    <span class="badge {{ $statusClass }} text-white">
                                        {{ ucfirst($order->order_status) }}
                                    </span>
                                </td>
                                <td>${{ $order->total_amount }}</td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="container my-4">
        <h3 class="mb-4">Select Payment Method</h3>

        <form id="paymentForm">
            <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="paymentMethod" id="creditCard" value="creditCard" checked>
                <label class="form-check-label" for="creditCard">
                    Credit Card
                </label>
            </div>

            <div id="creditCardDetails" class="mb-4">
                <div class="mb-3">
                    <label for="cardNumber" class="form-label">Card Number</label>
                    <input type="text" class="form-control" id="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19" required>
                </div>
                <div class="row">
                    <div class="col-6 mb-3">
                        <label for="expiryDate" class="form-label">Expiry Date</label>
                        <input type="month" class="form-control" id="expiryDate" required>
                    </div>
                    <div class="col-6 mb-3">
                        <label for="cvv" class="form-label">CVV</label>
                        <input type="password" class="form-control" id="cvv" placeholder="123" maxlength="4" required>
                    </div>
                </div>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="paymentMethod" id="paypal" value="paypal">
                <label class="form-check-label" for="paypal">
                    PayPal
                </label>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="paymentMethod" id="bankTransfer" value="bankTransfer">
                <label class="form-check-label" for="bankTransfer">
                    Bank Transfer
                </label>
            </div>

            <div id="bankTransferDetails" class="d-none mb-4">
                <p>
                    Please transfer the amount to the following account:<br>
                    <strong>Account Name:</strong> Your Company Name<br>
                    <strong>Account Number:</strong> 1234567890<br>
                    <strong>Bank:</strong> Awesome Bank<br>
                    <strong>IFSC Code:</strong> ABCD0123456
                </p>
            </div>

            <button type="submit" class="btn btn-primary">Pay Now</button>
        </form>
    </div> -->

    <!-- 
    <script>
        const creditCardRadio = document.getElementById('creditCard');
        const paypalRadio = document.getElementById('paypal');
        const bankTransferRadio = document.getElementById('bankTransfer');

        const creditCardDetails = document.getElementById('creditCardDetails');
        const bankTransferDetails = document.getElementById('bankTransferDetails');

        const paymentRadios = document.querySelectorAll('input[name="paymentMethod"]');

        paymentRadios.forEach(radio => {
            radio.addEventListener('change', () => {
                if (creditCardRadio.checked) {
                    creditCardDetails.classList.remove('d-none');
                    bankTransferDetails.classList.add('d-none');
                } else if (bankTransferRadio.checked) {
                    creditCardDetails.classList.add('d-none');
                    bankTransferDetails.classList.remove('d-none');
                } else {
                    // For PayPal or others
                    creditCardDetails.classList.add('d-none');
                    bankTransferDetails.classList.add('d-none');
                }
            });
        });

        // Optional: handle form submission here
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Payment processing... 💸');
            // Add your payment logic here
        });
    </script> -->



    @include ('Home.home_footer')


</body>

</html>