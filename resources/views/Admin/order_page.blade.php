<!DOCTYPE html>
<html>

<head>
    @include('Admin.headTag')
</head>

<body>

    @include('Admin.header')

    <div class="d-flex align-items-stretch">

        <!-- Sidebar Navigation-->
        @include('Admin.sidebar')
        <!-- Sidebar Navigation end-->

        <!-- Page Content -->
        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">
                    <h2 class="h5 no-margin-bottom">View Order Page</h2>
                </div>
            </div>

            <div class="container">
                <div class="table-responsive">

                    <table class="table table-bordered ">
                        <thead class="bg-light text-dark">
                            <th>S.No</th>
                            <th>Product Name</th>
                            <th>Product Image</th>
                            <th>Quantity</th>
                            <th>Total Amount</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Country</th>
                            <th>State</th>
                            <th>City</th>
                            <th>Address</th>
                            <th>Zip code</th>
                            <th>Mobile Number</th>
                            <th>email</th>
                            <th>Payment Method</th>
                            <th>order status</th>
                            <th>Change status</th>
                        </thead>

                        @foreach ($order as $orders)

                        <tbody class="text-light">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$orders->product->name}}</td>
                            <td>
                                @if ($orders->custom_image)
                                <img src="{{ asset($orders->custom_image) }}" alt="custom_image" class="img-fluid" style="max-width: 100px;">
                                @elseif ($orders->product && $orders->product->image)
                                <img src="{{ asset($orders->product->image) }}" alt="product_image" class="img-fluid" style="max-width: 100px;">
                                @else
                                <span class="text-danger">No image available</span>
                                @endif

                            </td>
                            <td>{{$orders->quantity}}</td>
                            <td>{{$orders->total_amount}}</td>
                            <td>{{$orders->first_name}}</td>
                            <td>{{$orders->last_name}}</td>
                            <td>{{$orders->country}}</td>
                            <td>{{$orders->state}}</td>
                            <td>{{$orders->city}}</td>
                            <td>{{$orders->address}}</td>
                            <td>{{$orders->zip_code}}</td>
                            <td>{{$orders->phone}}</td>
                            <td>{{$orders->email}}</td>
                            <td>{{$orders->payment_method}}</td>
                            <td>
                                @if($orders->order_status == 'in progress')
                                <span class="text-danger">{{$orders->order_status}}</span>
                                @else
                                <span>{{$orders->order_status}}</span>

                                @endif
                            </td>
                            <td class="d-flex" style="gap: 10px;">
                                <a href="{{url('on_the_way', $orders->id)}}" class="btn btn-primary btn-sm">On the way</a>
                                <a href="{{url('delivered', $orders->id)}}" class="btn btn-success btn-sm">Delivered</a>
                            </td>


                        </tbody>

                        @endforeach
                    </table>
                </div>
            </div>


            <!-- Page Content end-->

        </div>
        <!-- JavaScript files-->
        <script src="{{asset('admincss/vendor/jquery/jquery.min.js')}}"></script>
        <script src="{{asset('admincss/vendor/popper.js/umd/popper.min.js')}}"> </script>
        <script src="{{asset('admincss/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('admincss/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
        <script src="{{asset('admincss/vendor/chart.js/Chart.min.js')}}"></script>
        <script src="{{asset('admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
        <script src="{{asset('admincss/js/charts-home.js')}}"></script>
        <script src="{{asset('admincss/js/front.js')}}"></script>

</body>

</html>