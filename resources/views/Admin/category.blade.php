<!DOCTYPE html>
<html lang="en">

<head>
    @include('Admin.headTag')

</head>

<body>
    @include('Admin.header')

    <div class="d-flex align-items-stretch">
        @include('Admin.sidebar')

        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">
                    <h2 class="h5 no-margin-bottom">Categories</h2>
                </div>
            </div>

            <form action="{{ url('add_category') }}" method="post" class="py-5">
                @csrf
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-10 col-sm-12">
                            <div class="card shadow border-0 rounded-4">
                                <div class="card-body p-5">
                                    <h2 class="text-center fw-bold mb-4 text-white">Add New Category</h2>
                                    <p class="text-center text-muted mb-4">
                                        Use the form below to add a new category to your collection.
                                    </p>

                                    <div class="row justify-content-center">
                                        <div class="col-md-8">
                                            <div class="d-flex align-items-center" style="gap: 10px;">
                                                <input type="text" name="category_name" id="categoryName"
                                                    class="form-control bg-white" placeholder="Enter category name" required>

                                                <button type="submit" class="btn btn-success">
                                                    Add Category
                                                </button>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="mt-5 table-responsive">
                                        <table class="table table-bordered table-hover text-center align-middle">
                                            <thead class="table-secondary text-dark">
                                                <tr>
                                                    <th>Category Name</th>
                                                    <th>Update</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($data as $data)
                                                <tr class="text-white">
                                                    <td>{{ $data->category_name }}</td>
                                                    <td>
                                                        <a href="{{url('edit_category',$data->id)}}" class="btn btn-info">Edit</a>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('delete_category', $data->id) }}"
                                                            class="btn btn-danger"
                                                            onclick="confirmDelete(event, this)">
                                                            Delete
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmDelete(event, element) {
            event.preventDefault();
            const url = element.getAttribute('href');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#17a2b8',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }
    </script>
</body>

</html>