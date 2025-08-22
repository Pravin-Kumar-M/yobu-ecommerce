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
                    <h2 class="h5 no-margin-bottom">Dashboard</h2>
                </div>
            </div>

            @include('Admin.pageContent')


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