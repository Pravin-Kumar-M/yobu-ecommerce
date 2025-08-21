<!DOCTYPE html>
<html lang="en">

<head>
    @include('Admin.headTag')
</head>

<body>
    @include('Admin.header')

    <div class="d-flex align-items-stretch">
        @include('Admin.sidebar')

        <div class="page-content w-100">
            <div class="page-header">
                <div class="container-fluid">
                    <h2 class="h5 no-margin-bottom">Edit Categories</h2>
                </div>
            </div>
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card shadow-sm rounded-3">
                            <div class="card-body bg-white text-dark">
                                <h5 class="card-title text-center mb-4">Edit Category</h5>
                                <form action="{{ url('update_category', $data->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="category" class="form-label text-dark">Category Name :</label>
                                        <input type="text" name="category" id="category" value="{{ $data->category_name }}" class="form-control text-dark" placeholder="Enter category name" required>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ url('view_category') }}" class="btn btn-secondary">Back</a>
                                        <button type="submit" class="btn btn-success">Update Category</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('admincss/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('admincss/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admincss/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('admincss/js/charts-home.js') }}"></script>
    <script src="{{ asset('admincss/js/front.js') }}"></script>


</body>

</html>