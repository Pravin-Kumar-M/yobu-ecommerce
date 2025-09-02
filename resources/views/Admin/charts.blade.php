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
                    <h2 class="h5 no-margin-bottom">Charts Dashboard</h2>
                </div>
            </div>

            <!-- charts -->
            <section>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="line-chart block chart">
                                <div class="title"><strong>Line Chart Example</strong></div>
                                <canvas id="lineChartCustom1"></canvas>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="lin-chart block chart">
                                <div class="title"><strong>Line Chart Example</strong></div>
                                <div class="line-chart chart margin-bottom-sm">
                                    <canvas id="lineChartCustom2"></canvas>
                                </div>
                                <div class="line-chart chart">
                                    <canvas id="lineChartCustom3"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="chart block">
                                <div class="title"> <strong>Bar Chart Example</strong></div>
                                <div class="bar-chart chart margin-bottom-sm">
                                    <canvas id="barChartCustom1"></canvas>
                                </div>
                                <div class="bar-chart chart">
                                    <canvas id="barChartCustom2"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="bar-chart block chart">
                                <div class="title"><strong>Bar Chart Example</strong></div>
                                <div class="bar-chart chart">
                                    <canvas id="barChartCustom3"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="pie-chart chart block">
                                <div class="title"><strong>Pie Chart Example</strong></div>
                                <div class="pie-chart chart margin-bottom-sm">
                                    <canvas id="pieChartCustom1"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="doughnut-chart chart block">
                                <div class="title"><strong>Pie Chart Example</strong></div>
                                <div class="doughnut-chart chart margin-bottom-sm">
                                    <canvas id="doughnutChartCustom1"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="polar-chart chart block">
                                <div class="title"><strong>Polar Chart Example</strong></div>
                                <div class="polar-chart chart margin-bottom-sm">
                                    <canvas id="polarChartCustom"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="radar-chart chart block">
                                <div class="title"><strong>Radar Chart Example</strong></div>
                                <div class="radar-chart chart margin-bottom-sm">
                                    <canvas id="radarChartCustom"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
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
    <script src="{{asset('admincss/js/charts-custom.js')}}"></script>

    <script src="{{asset('admincss/js/front.js')}}"></script>


</body>

</html>